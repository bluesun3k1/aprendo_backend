<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\CurriculumSession;
use App\Models\CurriculumSessionItem;
use App\Models\LearningPath;
use App\Models\SessionActivity;
use App\Models\Skill;
use App\Models\Student;
use App\Models\StudentSession;
use App\Models\StudentSessionQueue;

class SessionBuilderService
{
    /**
     * Build a real StudentSession from a queue item.
     * Selects activities per curriculum_session_item slot, applying
     * adaptive difficulty adjustment based on current mastery.
     */
    public function buildFromBlueprint(StudentSessionQueue $queueItem, Student $student): StudentSession
    {
        $band = $student->placement_band ?? 'middle';

        // No blueprint → fall back to adaptive engine
        if (!$queueItem->curriculum_session_id) {
            return $this->buildAdaptiveSession($student, $queueItem->session_kind);
        }

        $blueprint = CurriculumSession::with('items.skill')->find($queueItem->curriculum_session_id);

        if (!$blueprint || $blueprint->items->isEmpty()) {
            return $this->buildAdaptiveSession($student, $queueItem->session_kind);
        }

        // Resolve the set of skills the student has unlocked in the curriculum.
        // Used both as a guard in selectActivitiesForItem and as the fallback pool
        // when a specific skill slot has no activities (e.g. sparse content bank).
        $unlockedSkillIds = app(AdaptiveEngineService::class)->getUnlockedSkillIds($student);

        $activities = collect();
        $domains    = collect();

        foreach ($blueprint->items()->orderBy('sort_order')->get() as $item) {
            $selected = $this->selectActivitiesForItem($item, $student, $band, $unlockedSkillIds);

            // Per-slot fallback: when the exact skill has no suitable activities
            // (sparse content bank or locked skill), fill the slot from any unlocked
            // skill in the same domain at the same difficulty range.
            if ($selected->isEmpty() && $item->skill) {
                $selected = $this->fillSlotFromDomain(
                    $item->skill->domain_id,
                    $band,
                    $item->difficulty_min,
                    $item->difficulty_max,
                    $item->item_count,
                    $unlockedSkillIds,
                    $activities->pluck('id')->all()
                );
            }

            $activities = $activities->merge($selected);
            if ($item->skill) {
                $domains->push($item->skill->domain_id);
            }
        }

        $activities = $activities->unique('id')->values();

        if ($activities->isEmpty()) {
            return $this->buildAdaptiveSession($student, $queueItem->session_kind);
        }

        return $this->persistSession(
            $student,
            $activities,
            $domains->unique()->values()->all(),
            $queueItem->session_kind === 'review' ? 'review' : 'core',
            $blueprint->estimated_minutes
        );
    }

    /**
     * Fallback: delegate to AdaptiveEngineService when no blueprint is present.
     */
    public function buildAdaptiveSession(Student $student, string $sessionKind = 'core'): StudentSession
    {
        $engine = app(AdaptiveEngineService::class);

        return $sessionKind === 'bonus'
            ? $engine->generateBonusSession($student)
            : $engine->getTodaySession($student);
    }

    // -----------------------------------------------------------------------
    // Private helpers
    // -----------------------------------------------------------------------

    private function selectActivitiesForItem(
        CurriculumSessionItem $item,
        Student $student,
        string $band,
        array $unlockedSkillIds = []
    ): \Illuminate\Support\Collection {
        // Guard: if curriculum unlock data is present and this skill belongs to a
        // locked unit, return empty so the per-slot fallback can find an alternative.
        if (!empty($unlockedSkillIds) && !in_array($item->skill_id, $unlockedSkillIds, true)) {
            return collect();
        }

        $mastery = \App\Models\MasteryScore::where('student_id', $student->id)
            ->where('skill_id', $item->skill_id)
            ->where('grade_band', $band)
            ->value('score') ?? 0;

        $targetDiff = $item->selection_rule === 'adaptive'
            ? $this->adaptiveDifficulty($mastery, $item->difficulty_min, $item->difficulty_max)
            : (int) ceil(($item->difficulty_min + $item->difficulty_max) / 2);

        // Try exact target difficulty first
        $activities = Activity::with('skill')
            ->where('skill_id', $item->skill_id)
            ->where('difficulty', $targetDiff)
            ->where('grade_band', $band)
            ->where('is_active', true)
            ->where('is_diagnostic', false)
            ->inRandomOrder()
            ->take($item->item_count)
            ->get();

        // Widen to full allowed range if not enough
        if ($activities->count() < $item->item_count) {
            $activities = Activity::with('skill')
                ->where('skill_id', $item->skill_id)
                ->whereBetween('difficulty', [$item->difficulty_min, $item->difficulty_max])
                ->where('grade_band', $band)
                ->where('is_active', true)
                ->where('is_diagnostic', false)
                ->inRandomOrder()
                ->take($item->item_count)
                ->get();
        }

        return $activities;
    }

    /**
     * Per-slot fallback: find activities from any unlocked skill in the given domain
     * when the blueprint's specific skill has no suitable content.
     */
    private function fillSlotFromDomain(
        string $domainId,
        string $band,
        int $diffMin,
        int $diffMax,
        int $count,
        array $unlockedSkillIds,
        array $excludeIds = []
    ): \Illuminate\Support\Collection {
        $domainSkillIds = Skill::where('domain_id', $domainId)->pluck('id')->all();

        // Constrain to unlocked skills when the curriculum is active
        if (!empty($unlockedSkillIds)) {
            $domainSkillIds = array_values(array_intersect($domainSkillIds, $unlockedSkillIds));
        }

        if (empty($domainSkillIds)) {
            return collect();
        }

        return Activity::with('skill')
            ->whereIn('skill_id', $domainSkillIds)
            ->whereBetween('difficulty', [$diffMin, $diffMax])
            ->where('grade_band', $band)
            ->where('is_active', true)
            ->where('is_diagnostic', false)
            ->whereNotIn('id', $excludeIds)
            ->inRandomOrder()
            ->take($count)
            ->get();
    }

    private function adaptiveDifficulty(int $mastery, int $min, int $max): int
    {
        if ($mastery < 40) {
            $diff = $min;
        } elseif ($mastery < 70) {
            $diff = (int) round(($min + $max) / 2);
        } else {
            $diff = $max;
        }

        return max($min, min($max, $diff));
    }

    private function persistSession(
        Student $student,
        \Illuminate\Support\Collection $activities,
        array $domains,
        string $sessionType,
        int $estimatedMinutes
    ): StudentSession {
        $learningPath = LearningPath::firstOrCreate(['student_id' => $student->id]);

        $seqNum = StudentSession::where('student_id', $student->id)
            ->where('session_type', 'core')
            ->count() + 1;

        $session = StudentSession::create([
            'student_id'                 => $student->id,
            'learning_path_id'           => $learningPath->id,
            'status'                     => 'pending',
            'session_type'               => $sessionType,
            'sequence_number'            => $seqNum,
            'estimated_duration_minutes' => $estimatedMinutes,
            'domains'                    => $domains,
        ]);

        foreach ($activities->values() as $idx => $activity) {
            SessionActivity::create([
                'session_id'  => $session->id,
                'activity_id' => $activity->id,
                'order_index' => $idx + 1,
            ]);
        }

        return $session;
    }
}
