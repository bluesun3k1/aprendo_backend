<?php

namespace App\Services;

use App\Models\Student;
use App\Models\StudentSession;
use App\Models\StudentSessionQueue;

class SessionQueueService
{
    public function __construct(
        private readonly SessionBuilderService  $sessionBuilder,
        private readonly CurriculumTrackService $trackService,
        private readonly PlacementService       $placementService,
    ) {}

    // -----------------------------------------------------------------------
    // Main entry point — called by SessionController::today()
    // -----------------------------------------------------------------------

    /**
     * Returns the StudentSession the student should play right now.
     * Builds a new session from the curriculum blueprint if not yet generated.
     */
    public function getActiveSession(Student $student): StudentSession
    {
        $queueItem = $this->activeQueueItem($student);

        // No active item → promote next queued one
        if (!$queueItem) {
            $queueItem = $this->promoteNextQueued($student);
        }

        // Queue empty → seed from current unit and try again
        if (!$queueItem) {
            $this->placementService->refillQueue($student);
            $queueItem = $this->activeQueueItem($student);
        }

        // Curriculum not seeded / no track → fall back to pure adaptive engine
        if (!$queueItem) {
            return app(AdaptiveEngineService::class)->getTodaySession($student);
        }

        // Already linked to a session that is not yet completed
        if ($queueItem->generated_session_id) {
            $session = StudentSession::find($queueItem->generated_session_id);
            if ($session && $session->status !== 'completed') {
                return $session;
            }
        }

        // Build the session from the blueprint and link it
        $session = $this->sessionBuilder->buildFromBlueprint($queueItem, $student);
        $queueItem->update(['generated_session_id' => $session->id]);

        return $session;
    }

    // -----------------------------------------------------------------------
    // Called by SessionController::complete()
    // -----------------------------------------------------------------------

    /**
     * Handles all post-session-completion queue logic.
     * Returns an array with flags the API response can expose.
     */
    public function onSessionComplete(StudentSession $session, Student $student): array
    {
        $result = [
            'unit_completed'     => false,
            'next_unit_unlocked' => false,
        ];

        // Mark the matching queue item completed
        $queueItem = StudentSessionQueue::where('generated_session_id', $session->id)->first();
        if ($queueItem) {
            $queueItem->update(['status' => 'completed', 'completed_at' => now()]);
        }

        // Check whether the active unit mastery threshold is now met
        $unitAdvanced = $this->trackService->checkAndAdvanceUnit($student->fresh());

        if ($unitAdvanced) {
            $result['unit_completed']     = true;
            $result['next_unit_unlocked'] = true;
        }

        // Keep the queue stocked with at least 2 upcoming items
        $this->ensureQueueHasItems($student->fresh(), 2);

        return $result;
    }

    // -----------------------------------------------------------------------
    // Queue management helpers
    // -----------------------------------------------------------------------

    public function getQueueForStudent(Student $student): \Illuminate\Support\Collection
    {
        return StudentSessionQueue::where('student_id', $student->id)
            ->whereIn('status', ['active', 'queued'])
            ->with('curriculumSession.unit')
            ->orderBy('queue_order')
            ->get();
    }

    private function ensureQueueHasItems(Student $student, int $minimum): void
    {
        $upcomingCount = StudentSessionQueue::where('student_id', $student->id)
            ->whereIn('status', ['queued', 'active'])
            ->count();

        if ($upcomingCount < $minimum) {
            $this->placementService->refillQueue($student);
        }
    }

    private function activeQueueItem(Student $student): ?StudentSessionQueue
    {
        return StudentSessionQueue::where('student_id', $student->id)
            ->where('status', 'active')
            ->with('curriculumSession')
            ->first();
    }

    private function promoteNextQueued(Student $student): ?StudentSessionQueue
    {
        $next = StudentSessionQueue::where('student_id', $student->id)
            ->where('status', 'queued')
            ->orderBy('queue_order')
            ->first();

        if ($next) {
            $next->update(['status' => 'active']);
        }

        return $next;
    }
}
