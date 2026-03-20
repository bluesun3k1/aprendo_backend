<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Attempt;
use App\Models\StudentSession;
use App\Services\AdaptiveEngineService;
use App\Services\MasteryScoreService;
use App\Services\RewardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function __construct(
        private readonly AdaptiveEngineService $adaptiveEngine,
        private readonly MasteryScoreService $masteryService,
        private readonly RewardService $rewardService,
    ) {}

    // -----------------------------------------------------------------------
    // GET /api/v1/student/session/today
    // -----------------------------------------------------------------------
    public function today(Request $request): JsonResponse
    {
        $student = $request->user();
        $session = $this->adaptiveEngine->getTodaySession($student);
        $locale  = app()->getLocale();

        $activities = $session->activities()->with('skill')->get()->map(
            fn ($a) => $this->formatActivity($a, $locale)
        );

        return response()->json([
            'session_id'                  => $session->id,
            'estimated_duration_minutes'  => $session->estimated_duration_minutes,
            'domains'                     => $session->domains ?? [],
            'activities'                  => $activities,
        ]);
    }

    // -----------------------------------------------------------------------
    // POST /api/v1/student/session/{session_id}/attempt
    // -----------------------------------------------------------------------
    public function attempt(Request $request, string $sessionId): JsonResponse
    {
        $student = $request->user();

        $request->validate([
            'activity_id'     => 'required|uuid',
            'type'            => 'required|string',
            'response'        => 'required|array',
            'response_time_ms'=> 'nullable|integer',
            'hints_used'      => 'nullable|integer',
            'completed'       => 'nullable|boolean',
        ]);

        $session = StudentSession::where('id', $sessionId)
            ->where('student_id', $student->id)
            ->firstOrFail();

        $activity = \App\Models\Activity::with('skill')->findOrFail($request->activity_id);

        // Mark session as in_progress
        if ($session->status === 'pending') {
            $session->update(['status' => 'in_progress']);
        }

        $evaluation   = $this->masteryService->evaluateAttempt($activity, $request->response);
        $masteryUpdate = $this->masteryService->updateMastery(
            $student,
            $activity,
            $evaluation['correct'],
            $request->response_time_ms ?? 0
        );

        $scoreDelta = $masteryUpdate['new_score'] - ($masteryUpdate['new_score'] - ($evaluation['correct'] ? max(5, $activity->difficulty * 5) : -3));

        $attempt = Attempt::create([
            'student_id'       => $student->id,
            'session_id'       => $session->id,
            'activity_id'      => $activity->id,
            'response'         => $request->response,
            'correct'          => $evaluation['correct'],
            'score_delta'      => $evaluation['correct'] ? $activity->difficulty * 5 : -3,
            'feedback_text'    => $evaluation['feedback_text'],
            'response_time_ms' => $request->response_time_ms ?? 0,
            'hints_used'       => $request->hints_used ?? 0,
            'completed'        => $request->completed ?? true,
        ]);

        return response()->json([
            'attempt_id'           => $attempt->id,
            'correct'              => $evaluation['correct'],
            'score_delta'          => $attempt->score_delta,
            'feedback_text'        => $evaluation['feedback_text'],
            'mastery_score_updated' => [
                'skill_id'  => $masteryUpdate['skill_id'],
                'new_score' => $masteryUpdate['new_score'],
                'trend'     => $masteryUpdate['trend'],
            ],
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
            'attempts.*.client_timestamp'     => 'nullable|date',
        ]);

        $session = StudentSession::where('id', $sessionId)
            ->where('student_id', $student->id)
            ->firstOrFail();

        $results = [];

        foreach ($request->attempts as $raw) {
            $activity     = \App\Models\Activity::with('skill')->find($raw['activity_id']);
            if (!$activity) continue;

            $evaluation   = $this->masteryService->evaluateAttempt($activity, $raw['response']);
            $masteryUpdate = $this->masteryService->updateMastery(
                $student, $activity, $evaluation['correct'], $raw['response_time_ms'] ?? 0
            );

            $attempt = Attempt::create([
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

            $results[] = [
                'attempt_id'           => $attempt->id,
                'correct'              => $evaluation['correct'],
                'score_delta'          => $attempt->score_delta,
                'feedback_text'        => $evaluation['feedback_text'],
                'mastery_score_updated' => [
                    'skill_id'  => $masteryUpdate['skill_id'],
                    'new_score' => $masteryUpdate['new_score'],
                    'trend'     => $masteryUpdate['trend'],
                ],
            ];
        }

        return response()->json($results);
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

        // Compute summary
        $attempts      = $session->attempts;
        $totalActivities = $attempts->count();
        $correctCount  = $attempts->where('correct', true)->count();
        $accuracy      = $totalActivities > 0 ? round(($correctCount / $totalActivities) * 100) : 0;
        $avgRtMs       = $totalActivities > 0 ? (int) $attempts->avg('response_time_ms') : 0;
        $pointsEarned  = $attempts->sum('score_delta');

        // Update student total points
        $student->increment('points_total', max(0, $pointsEarned));

        // Rewards
        $newBadges = $this->rewardService->recordSessionCompleted($student, $correctCount, $totalActivities);
        $streak    = $student->fresh()->streak ?? $this->rewardService->updateStreak($student);

        $badgesPayload = collect($newBadges)->map(fn ($b) => [
            'id'          => $b->id,
            'name'        => $b->name,
            'description' => app()->getLocale() === 'es' ? $b->description_es : $b->description_en,
            'icon_url'    => $b->icon_url,
        ]);

        return response()->json([
            'session_summary' => [
                'total_activities'       => $totalActivities,
                'correct'                => $correctCount,
                'accuracy_pct'           => $accuracy,
                'average_response_time_ms' => $avgRtMs,
                'domains_covered'        => $session->domains ?? [],
                'points_earned'          => max(0, $pointsEarned),
            ],
            'badges_unlocked' => $badgesPayload,
            'streak'          => [
                'current' => $streak->current_streak ?? 0,
                'best'    => $streak->best_streak ?? 0,
            ],
        ]);
    }

    private function formatActivity(\App\Models\Activity $activity, string $locale): array
    {
        return [
            'id'               => $activity->id,
            'type'             => $activity->type,
            'domain'           => $activity->skill->domain_id,
            'skill_id'         => $activity->skill_id,
            'skill_name'       => $activity->skill->name,
            'difficulty'       => $activity->difficulty,
            'instructions'     => $locale === 'es' ? $activity->instructions_es : $activity->instructions_en,
            'duration_seconds' => $activity->duration_seconds,
            'content'          => $activity->content,
        ];
    }
}
