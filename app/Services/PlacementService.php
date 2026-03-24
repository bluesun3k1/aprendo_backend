<?php

namespace App\Services;

use App\Models\CurriculumTrack;
use App\Models\Student;
use App\Models\StudentCurriculumTrack;
use App\Models\StudentSessionQueue;
use App\Models\StudentUnitProgress;

class PlacementService
{
    /**
     * Ensures a student has an active curriculum track and at least one
     * active queue item. Safe to call on every login — idempotent.
     */
    public function ensureTrackAssigned(Student $student): void
    {
        $band  = $student->placement_band ?? 'middle';
        $track = CurriculumTrack::whereHas('gradeBand', fn ($q) => $q->where('code', $band))
            ->where('is_active', true)
            ->first();

        if (!$track) {
            return; // curriculum not seeded yet — fail silently
        }

        $studentTrack = StudentCurriculumTrack::firstOrCreate(
            ['student_id' => $student->id, 'curriculum_track_id' => $track->id],
            ['status' => 'active', 'started_at' => now()]
        );

        if ($studentTrack->wasRecentlyCreated) {
            $this->bootstrapUnitProgress($student, $track);
            $this->refillQueue($student);
        } elseif (!$this->hasActiveQueueItem($student)) {
            $this->refillQueue($student);
        }
    }

    /**
     * Create student_unit_progress rows for every unit in the track.
     * First unit → active, rest → locked.
     */
    public function bootstrapUnitProgress(Student $student, CurriculumTrack $track): void
    {
        $units = $track->units()->orderBy('sort_order')->get();

        foreach ($units as $index => $unit) {
            StudentUnitProgress::firstOrCreate(
                ['student_id' => $student->id, 'curriculum_unit_id' => $unit->id],
                [
                    'status'     => $index === 0 ? 'active' : 'locked',
                    'started_at' => $index === 0 ? now() : null,
                ]
            );
        }
    }

    /**
     * Add the next unqueued curriculum sessions from the active unit
     * into the student's queue until there are at least 3 upcoming items.
     */
    public function refillQueue(Student $student): void
    {
        $activeProgress = StudentUnitProgress::where('student_id', $student->id)
            ->where('status', 'active')
            ->with('unit.sessions')
            ->first();

        if (!$activeProgress) {
            return;
        }

        $sessions = $activeProgress->unit->sessions()->orderBy('sort_order')->get();

        $alreadyQueued = StudentSessionQueue::where('student_id', $student->id)
            ->whereIn('status', ['queued', 'active'])
            ->pluck('curriculum_session_id')
            ->filter()
            ->toArray();

        $maxOrder = (int) StudentSessionQueue::where('student_id', $student->id)
            ->max('queue_order');

        $added   = 0;
        $isFirst = !$this->hasActiveQueueItem($student);

        foreach ($sessions as $session) {
            if ($added >= 3) break;
            if (in_array($session->id, $alreadyQueued)) continue;

            $status = ($isFirst && $added === 0) ? 'active' : 'queued';

            StudentSessionQueue::create([
                'student_id'            => $student->id,
                'curriculum_session_id' => $session->id,
                'session_kind'          => $session->session_type === 'review' ? 'review' : 'core',
                'queue_order'           => ++$maxOrder,
                'status'                => $status,
                'available_at'          => now(),
            ]);

            $added++;
        }
    }

    // -----------------------------------------------------------------------

    private function hasActiveQueueItem(Student $student): bool
    {
        return StudentSessionQueue::where('student_id', $student->id)
            ->where('status', 'active')
            ->exists();
    }
}
