<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\MasteryScore;
use App\Models\Skill;
use App\Models\Student;
use App\Models\StudentSession;
use App\Models\LearningPath;
use App\Models\SessionActivity;
use Illuminate\Support\Collection;

class AdaptiveEngineService
{
    /**
     * Generate (or retrieve) today's session for a student.
     */
    public function getTodaySession(Student $student): StudentSession
    {
        // Return existing in-progress session from today
        $existing = $student->sessions()
            ->whereIn('status', ['pending', 'in_progress'])
            ->whereDate('created_at', today())
            ->first();

        if ($existing) {
            return $existing;
        }

        // Ensure learning path exists
        $learningPath = $student->learningPath ?? LearningPath::create(['student_id' => $student->id]);

        // Get mastery scores indexed by skill_id
        $masteryScores = MasteryScore::where('student_id', $student->id)
            ->with('skill')
            ->get()
            ->keyBy('skill_id');

        $activities = $this->selectActivities($student, $masteryScores);

        $domains = $activities
            ->map(fn ($a) => $a->skill->domain_id)
            ->unique()
            ->values()
            ->toArray();

        $session = StudentSession::create([
            'student_id'                  => $student->id,
            'learning_path_id'            => $learningPath->id,
            'status'                      => 'pending',
            'estimated_duration_minutes'  => $this->estimateDuration($activities),
            'domains'                     => $domains,
        ]);

        foreach ($activities as $index => $activity) {
            SessionActivity::create([
                'session_id'  => $session->id,
                'activity_id' => $activity->id,
                'order_index' => $index,
            ]);
        }

        return $session;
    }

    /**
     * Select activities using V1 composition rules.
     *
     * 50% weakest active skill
     * 30% on-level reinforcement
     * 20% stretch challenge
     */
    private function selectActivities(Student $student, Collection $masteryScores): Collection
    {
        $totalSlots = 6; // 3 + 2 + 1

        $weakestActivities   = $this->getActivitiesForWeakestSkill($student, $masteryScores, 3);
        $reinforceActivities = $this->getReinforcementActivities($student, $masteryScores, 2);
        $stretchActivities   = $this->getStretchActivities($student, $masteryScores, 1);

        return $weakestActivities
            ->merge($reinforceActivities)
            ->merge($stretchActivities)
            ->shuffle()
            ->take($totalSlots);
    }

    /**
     * 50% — activities from the weakest skill, at appropriate (or reduced) difficulty.
     */
    private function getActivitiesForWeakestSkill(
        Student $student,
        Collection $masteryScores,
        int $count
    ): Collection {
        if ($masteryScores->isEmpty()) {
            // No history — pull easy activities from all domains
            return Activity::with('skill')
                ->where('difficulty', 1)
                ->where('is_active', true)
                ->where('is_diagnostic', false)
                ->inRandomOrder()
                ->take($count)
                ->get();
        }

        $weakest = $masteryScores->sortBy('score')->first();
        $skill   = $weakest->skill;
        $diff    = $this->targetDifficulty($weakest->score, 'low');

        return Activity::with('skill')
            ->where('skill_id', $skill->id)
            ->where('difficulty', $diff)
            ->where('is_active', true)
            ->where('is_diagnostic', false)
            ->inRandomOrder()
            ->take($count)
            ->get();
    }

    /**
     * 30% — on-level reinforcement from average-mastery skills.
     */
    private function getReinforcementActivities(
        Student $student,
        Collection $masteryScores,
        int $count
    ): Collection {
        if ($masteryScores->isEmpty()) {
            return Activity::with('skill')
                ->where('difficulty', 1)
                ->where('is_active', true)
                ->where('is_diagnostic', false)
                ->inRandomOrder()
                ->take($count)
                ->get();
        }

        $avgScore    = $masteryScores->avg('score');
        $midScores   = $masteryScores->filter(fn ($ms) => abs($ms->score - $avgScore) < 20);
        $skillIds    = $midScores->pluck('skill_id');

        if ($skillIds->isEmpty()) {
            $skillIds = $masteryScores->pluck('skill_id');
        }

        return Activity::with('skill')
            ->whereIn('skill_id', $skillIds)
            ->where('difficulty', 2)
            ->where('is_active', true)
            ->where('is_diagnostic', false)
            ->inRandomOrder()
            ->take($count)
            ->get();
    }

    /**
     * 20% — stretch challenge from highest-performing domain, highest difficulty.
     */
    private function getStretchActivities(
        Student $student,
        Collection $masteryScores,
        int $count
    ): Collection {
        if ($masteryScores->isEmpty()) {
            return Activity::with('skill')
                ->where('difficulty', 2)
                ->where('is_active', true)
                ->where('is_diagnostic', false)
                ->inRandomOrder()
                ->take($count)
                ->get();
        }

        $strongest = $masteryScores->sortByDesc('score')->first();
        $skill     = $strongest->skill;
        $diff      = $this->targetDifficulty($strongest->score, 'high');

        return Activity::with('skill')
            ->where('skill_id', $skill->id)
            ->where('difficulty', $diff)
            ->where('is_active', true)
            ->where('is_diagnostic', false)
            ->inRandomOrder()
            ->take($count)
            ->get();
    }

    /**
     * Determine target difficulty based on mastery score and context.
     */
    private function targetDifficulty(int $score, string $context): int
    {
        if ($context === 'low') {
            if ($score < 40) return 1;
            if ($score < 70) return 2;
            return 2;
        }

        // high / stretch
        if ($score < 50) return 2;
        if ($score < 80) return 3;
        return 3;
    }

    private function estimateDuration(Collection $activities): int
    {
        // ~2 minutes per activity
        return max(5, $activities->count() * 2);
    }
}
