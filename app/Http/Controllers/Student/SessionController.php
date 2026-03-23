<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Attempt;
use App\Models\StudentSession;
use App\Services\AdaptiveEngineService;
use App\Services\MasteryScoreService;
use App\Services\RewardService;
use App\Services\SessionQueueService;
use App\Services\XpService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function __construct(
        private readonly AdaptiveEngineService $adaptiveEngine,
        private readonly MasteryScoreService   $masteryService,
        private readonly RewardService         $rewardService,
        private readonly XpService             $xpService,
        private readonly SessionQueueService   $sessionQueueService,
    ) {}

    // -----------------------------------------------------------------------
    // GET /api/v1/student/session/today
    // -----------------------------------------------------------------------
    public function today(Request $request): JsonResponse
    {
        $student    = $request->user();
        $session    = $this->sessionQueueService->getActiveSession($student);
        $locale     = app()->getLocale();

        $activities = $session->activities()->with('skill')->get()->map(
            fn ($a) => $this->formatActivity($a, $locale)
        )->values();

        // Per Note 3: always 200 with activities array (empty if none)
        return response()->json([
            'session_id'                 => $session->id,
            'status'                     => $session->status,
            'estimated_duration_minutes' => $session->estimated_duration_minutes,
            'domains'                    => $session->domains ?? [],
            'activities'                 => $activities,
        ]);
    }

    // -----------------------------------------------------------------------
    // POST /api/v1/student/session/{session_id}/attempts/bulk
    // -----------------------------------------------------------------------
    public function bulkAttempt(Request $request, string $sessionId): JsonResponse
    {
        $student = $request->user();

        $request->validate([
            'attempts'                        => 'required|array|min:1',
            'attempts.*.activity_id'          => 'required|uuid',
            'attempts.*.type'                 => 'required|string',
            'attempts.*.response'             => 'required|array',
            'attempts.*.response_time_ms'     => 'nullable|integer',
            'attempts.*.hints_used'           => 'nullable|integer',
            'attempts.*.completed'            => 'nullable|boolean',
            'attempts.*.is_correct'           => 'nullable|boolean',
            'attempts.*.client_timestamp'     => 'nullable|date',
        ]);

        $session = StudentSession::where('id', $sessionId)
            ->where('student_id', $student->id)
            ->firstOrFail();

        if ($session->status === 'pending') {
            $session->update(['status' => 'in_progress']);
        }

        foreach ($request->attempts as $raw) {
            $activity = \App\Models\Activity::with('skill')->find($raw['activity_id']);
            if (!$activity) continue;

            $evaluation    = $this->masteryService->evaluateAttempt($activity, $raw['response']);
            $this->masteryService->updateMastery(
                $student, $activity, $evaluation['correct'], $raw['response_time_ms'] ?? 0
            );

            Attempt::create([
                'student_id'       => $student->id,
                'session_id'       => $session->id,
                'activity_id'      => $activity->id,
                'response'         => $raw['response'],
                'correct'          => $evaluation['correct'],
                'score_delta'      => $evaluation['correct'] ? $activity->difficulty * 5 : -3,
                'feedback_text'    => $evaluation['feedback_text'],
                'response_time_ms' => $raw['response_time_ms'] ?? 0,
                'hints_used'       => $raw['hints_used'] ?? 0,
                'completed'        => $raw['completed'] ?? true,
                'client_timestamp' => $raw['client_timestamp'] ?? null,
            ]);
        }

        return response()->json(['success' => true]);
    }

    // -----------------------------------------------------------------------
    // POST /api/v1/student/session/{session_id}/complete
    // -----------------------------------------------------------------------
    public function complete(Request $request, string $sessionId): JsonResponse
    {
        $student = $request->user();

        $request->validate([
            'completed_at' => 'nullable|date',
        ]);

        $session = StudentSession::where('id', $sessionId)
            ->where('student_id', $student->id)
            ->firstOrFail();

        $session->update([
            'status'       => 'completed',
            'completed_at' => $request->completed_at ?? now(),
        ]);

        // Calculate XP
        $attempts        = $session->attempts()->get();
        $totalActivities = $attempts->count();
        $correctCount    = $attempts->where('correct', true)->count();
        $avgDifficulty   = $totalActivities > 0
            ? $attempts->avg(fn ($a) => optional($a->activity)->difficulty ?? 2)
            : 2.0;

        $streak  = $this->rewardService->updateStreak($student);
        $streakDays = $streak->current_streak;

        $xpToAward = $this->xpService->calculateSessionXp(
            $correctCount,
            $totalActivities,
            (float) $avgDifficulty,
            $streakDays
        );

        $xpResult = $this->xpService->awardXp($student, $xpToAward);

        // Store xp_earned on the session
        $session->update(['xp_earned' => $xpResult['xp_awarded']]);

        // Check for new badges
        $this->rewardService->checkAndAwardBadges($student->fresh());

        // Check for grade-band advancement
        $freshStudent  = $student->fresh();
        $bandAdvanced  = $this->adaptiveEngine->promoteBandIfReady($freshStudent);
        $placementBand = $freshStudent->fresh()->placement_band;

        // Advance curriculum queue (marks queue item complete, checks unit mastery,
        // unlocks next unit if threshold met, and refills upcoming sessions)
        $queueResult = $this->sessionQueueService->onSessionComplete($session, $freshStudent->fresh());

        return response()->json([
            'success'            => true,
            'xp_awarded'         => $xpResult['xp_awarded'],
            'new_level'          => $xpResult['new_level'],
            'levelled_up'        => $xpResult['levelled_up'],
            'streak_days'        => $streakDays,
            'band_advanced'      => $bandAdvanced,
            'placement_band'     => $placementBand,
            'unit_completed'     => $queueResult['unit_completed'],
            'next_unit_unlocked' => $queueResult['next_unit_unlocked'],
        ]);
    }

    private function formatActivity(\App\Models\Activity $activity, string $locale): array
    {
        return [
            'id'                  => $activity->id,
            'type'                => $activity->type,
            'domain'              => $activity->skill->domain_id,
            'skill_id'            => $activity->skill_id,
            'skill_name'          => $activity->skill->name,
            'difficulty'          => $activity->difficulty,
            'instructions'        => $locale === 'es' ? $activity->instructions_es : $activity->instructions_en,
            'lesson_mood'         => $activity->lesson_mood,
            'mission_title'       => $activity->mission_title,
            'mission_description' => $activity->mission_description,
            'duration_seconds'    => $activity->duration_seconds,
            'content'             => $activity->content,
        ];
    }
}
