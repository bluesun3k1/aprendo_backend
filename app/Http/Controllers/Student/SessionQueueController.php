<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentSession;
use App\Services\SessionQueueService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SessionQueueController extends Controller
{
    public function __construct(
        private readonly SessionQueueService $sessionQueueService,
    ) {}

    private const DOMAIN_LABELS = [
        'reading'   => 'Lectura',
        'attention' => 'Atención',
        'reasoning' => 'Razonamiento',
        'math'      => 'Matemáticas',
        'memory'    => 'Memoria',
        'language'  => 'Lenguaje',
    ];

    // -----------------------------------------------------------------------
    // GET /api/v1/student/sessions
    // Optional query params:
    //   ?status=available          — flat list of playable sessions (§12 Option B)
    //   ?status=available&limit=N  — capped at N (default 5)
    // -----------------------------------------------------------------------
    public function queue(Request $request): JsonResponse
    {
        $student = $request->user();

        // Ensure a session is provisioned before reading the queue.
        // This makes GET /sessions a full drop-in replacement for GET /session/today:
        // a student who hits this endpoint cold will have their first session built
        // (from the curriculum blueprint or adaptive engine) before the list is returned.
        $this->sessionQueueService->getActiveSession($student);

        if ($request->query('status') === 'available') {
            return $this->availableSessions($request, $student);
        }

        $allSessions = StudentSession::where('student_id', $student->id)
            ->withCount('sessionActivities as total_activities')
            ->with(['attempts:id,session_id,activity_id'])
            ->orderBy('sequence_number')
            ->orderBy('created_at')
            ->get();

        $coreSessions  = $allSessions->where('session_type', 'core')->values();
        $bonusSessions = $allSessions->whereIn('session_type', ['bonus', 'review', 'practice'])->values();

        // current_session: oldest in_progress first; otherwise next unlocked pending core
        $inProgress = $coreSessions->where('status', 'in_progress')->sortBy('created_at')->values();

        $currentSession = null;
        $nextSessions   = collect();

        if ($inProgress->isNotEmpty()) {
            $currentSession = $inProgress->first();

            // Stacked in_progress sessions (newer ones) become the start of next_sessions
            $stacked    = $inProgress->skip(1)->values();
            $afterSlots = max(0, 3 - $stacked->count());

            $afterCurrent = $coreSessions
                ->where('status', 'pending')
                ->where('sequence_number', '>', $currentSession->sequence_number ?? 0)
                ->sortBy('sequence_number')
                ->take($afterSlots)
                ->values();

            $nextSessions = $stacked->merge($afterCurrent)->take(3)->values();
        } else {
            // Find next unlocked pending core session
            foreach ($coreSessions->where('status', 'pending')->sortBy('sequence_number') as $session) {
                if ($this->isCoreSessionUnlocked($session, $coreSessions)) {
                    $currentSession = $session;
                    break;
                }
            }

            if ($currentSession) {
                $nextSessions = $coreSessions
                    ->where('status', 'pending')
                    ->where('sequence_number', '>', $currentSession->sequence_number ?? 0)
                    ->sortBy('sequence_number')
                    ->take(3)
                    ->values();
            }
        }

        $completedSessions = $coreSessions
            ->where('status', 'completed')
            ->sortByDesc('completed_at')
            ->take(5)
            ->values();

        return response()->json([
            'current_session'    => $currentSession
                                        ? $this->formatQueueItem($currentSession, $coreSessions)
                                        : null,
            'next_sessions'      => $nextSessions->map(fn ($s) => $this->formatQueueItem($s, $coreSessions))->values(),
            'completed_sessions' => $completedSessions->map(fn ($s) => $this->formatQueueItem($s, $coreSessions))->values(),
            'bonus_sessions'     => $bonusSessions->map(fn ($s) => $this->formatQueueItem($s, $coreSessions))->values(),
        ]);
    }

    // -----------------------------------------------------------------------
    // GET /api/v1/student/sessions/{session_id}
    // -----------------------------------------------------------------------
    public function show(Request $request, string $sessionId): JsonResponse
    {
        $student = $request->user();
        $locale  = app()->getLocale();

        $session = StudentSession::where('id', $sessionId)
            ->where('student_id', $student->id)
            ->withCount('sessionActivities as total_activities')
            ->with(['attempts:id,session_id,activity_id', 'activities.skill'])
            ->firstOrFail();

        $activitiesCompleted = $session->attempts->pluck('activity_id')->unique()->count();

        $activities = $session->activities->map(
            fn ($a) => $this->formatActivity($a, $locale)
        )->values();

        return response()->json([
            'session_id'                 => $session->id,
            'status'                     => $session->status,
            'session_type'               => $session->session_type,
            'sequence_number'            => $session->sequence_number,
            'title'                      => $this->generateTitle($session),
            'estimated_duration_minutes' => $session->estimated_duration_minutes,
            'domains'                    => $session->domains ?? [],
            'activities_completed'       => $activitiesCompleted,
            'total_activities'           => $session->total_activities ?? 0,
            'activities'                 => $activities,
        ]);
    }

    // -----------------------------------------------------------------------
    // Helpers
    // -----------------------------------------------------------------------

    /**
     * Flat available-sessions list (§12 Option B).
     * Returns today's pending/in_progress session + available bonus sessions,
     * ordered by priority (in_progress first, then pending core, then bonus).
     */
    private function availableSessions(Request $request, $student): JsonResponse
    {
        $limit = min((int) ($request->query('limit', 5)), 20);

        $allSessions = StudentSession::where('student_id', $student->id)
            ->withCount('sessionActivities as total_activities')
            ->with(['attempts:id,session_id,activity_id'])
            ->whereIn('status', ['pending', 'in_progress'])
            ->orderByRaw("FIELD(status, 'in_progress', 'pending')")
            ->orderBy('sequence_number')
            ->orderBy('created_at')
            ->get();

        $coreSessions = StudentSession::where('student_id', $student->id)
            ->where('session_type', 'core')
            ->get();

        $sessions = $allSessions
            ->take($limit)
            ->map(fn ($s) => $this->formatQueueItem($s, $coreSessions))
            ->values();

        return response()->json(['sessions' => $sessions]);
    }

    private function isCoreSessionUnlocked(StudentSession $session, Collection $coreSessions): bool
    {
        if ($session->session_type !== 'core') {
            return true;
        }

        $seqNum = $session->sequence_number;

        if (!$seqNum || $seqNum <= 1) {
            return true;
        }

        return $coreSessions
            ->where('session_type', 'core')
            ->where('sequence_number', '<', $seqNum)
            ->every(fn ($s) => $s->status === 'completed');
    }

    private function formatQueueItem(StudentSession $session, Collection $coreSessions): array
    {
        $activitiesCompleted = $session->attempts->pluck('activity_id')->unique()->count();

        return [
            'session_id'                  => $session->id,
            'title'                       => $this->generateTitle($session),
            'status'                      => $session->status,
            'session_type'                => $session->session_type,
            'sequence_number'             => $session->sequence_number,
            'estimated_duration_minutes'  => $session->estimated_duration_minutes,
            'domains'                     => $session->domains ?? [],
            'activities_completed'        => $activitiesCompleted,
            'total_activities'            => $session->total_activities ?? 0,
            'is_resumable'                => $session->status === 'in_progress' && $activitiesCompleted > 0,
            'is_bonus'                    => $session->session_type !== 'core',
            'unlocked'                    => $this->isCoreSessionUnlocked($session, $coreSessions),
            'completed_at'                => $session->completed_at?->toIso8601String(),
        ];
    }

    private function generateTitle(StudentSession $session): string
    {
        $domainParts = collect($session->domains ?? [])
            ->map(fn ($d) => self::DOMAIN_LABELS[$d] ?? ucfirst($d))
            ->take(2)
            ->implode(' y ');

        $suffix = $domainParts ? " · {$domainParts}" : '';

        return match ($session->session_type) {
            'core'     => $session->sequence_number
                              ? "Sesión {$session->sequence_number}{$suffix}"
                              : "Sesión{$suffix}",
            'bonus'    => "Práctica extra{$suffix}",
            'review'   => "Repaso{$suffix}",
            'practice' => "Práctica{$suffix}",
            default    => "Sesión{$suffix}",
        };
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
