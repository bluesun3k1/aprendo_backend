<?php

namespace App\Services;

use App\Models\CurriculumUnit;
use App\Models\MasteryScore;
use App\Models\Student;
use App\Models\StudentCurriculumTrack;
use App\Models\StudentUnitProgress;

class CurriculumTrackService
{
    /**
     * Return the student's active curriculum track record.
     */
    public function getActiveTrack(Student $student): ?StudentCurriculumTrack
    {
        return StudentCurriculumTrack::where('student_id', $student->id)
            ->where('status', 'active')
            ->with('track.units')
            ->first();
    }

    /**
     * Return the student's currently active unit progress record.
     */
    public function getActiveUnitProgress(Student $student): ?StudentUnitProgress
    {
        return StudentUnitProgress::where('student_id', $student->id)
            ->where('status', 'active')
            ->with('unit.unitSkills.skill')
            ->first();
    }

    /**
     * Checks whether mastery thresholds are met for the current active unit.
     * If so, marks it complete and unlocks the next unit.
     * Returns true if a unit was advanced.
     */
    public function checkAndAdvanceUnit(Student $student): bool
    {
        $activeProgress = $this->getActiveUnitProgress($student);
        if (!$activeProgress) {
            return false;
        }

        $unit      = $activeProgress->unit;
        $threshold = $unit->mastery_threshold ?? 65;
        $unitSkills = $unit->unitSkills()->pluck('skill_id');

        if ($unitSkills->isEmpty()) {
            return false;
        }

        $masteryScores = MasteryScore::where('student_id', $student->id)
            ->whereIn('skill_id', $unitSkills)
            ->get();

        // Require a score for every skill in the unit before advancing
        if ($masteryScores->count() < $unitSkills->count()) {
            return false;
        }

        if ($masteryScores->avg('score') < $threshold) {
            return false;
        }

        // Mark current unit complete with a mastery snapshot
        $snapshot = $masteryScores->mapWithKeys(fn ($ms) => [$ms->skill_id => $ms->score])->all();

        $activeProgress->update([
            'status'           => 'completed',
            'completed_at'     => now(),
            'mastery_snapshot' => $snapshot,
        ]);

        // Find the next locked unit in the same track
        $nextUnit = CurriculumUnit::where('curriculum_track_id', $unit->curriculum_track_id)
            ->where('sort_order', '>', $unit->sort_order)
            ->orderBy('sort_order')
            ->first();

        if ($nextUnit) {
            StudentUnitProgress::where('student_id', $student->id)
                ->where('curriculum_unit_id', $nextUnit->id)
                ->update(['status' => 'active', 'started_at' => now()]);

            return true;
        }

        // No more units — the whole track is complete
        StudentCurriculumTrack::where('student_id', $student->id)
            ->where('status', 'active')
            ->update(['status' => 'completed', 'completed_at' => now()]);

        return true;
    }

    /**
     * Return all unit progress rows for a student in their active track,
     * ordered by sort_order, with unit metadata eager-loaded.
     */
    public function getAllUnitProgress(Student $student): \Illuminate\Support\Collection
    {
        $activeTrack = $this->getActiveTrack($student);
        if (!$activeTrack) {
            return collect();
        }

        $unitIds = $activeTrack->track->units->pluck('id');

        return StudentUnitProgress::where('student_id', $student->id)
            ->whereIn('curriculum_unit_id', $unitIds)
            ->with('unit')
            ->get()
            ->sortBy(fn ($p) => $p->unit->sort_order)
            ->values();
    }
}
