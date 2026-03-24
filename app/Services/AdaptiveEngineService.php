<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\Attempt;
use App\Models\CurriculumUnitSkill;
use App\Models\MasteryScore;
use App\Models\Skill;
use App\Models\Student;
use App\Models\StudentSession;
use App\Models\StudentUnitProgress;
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

        // Mastery reads are scoped to the current band and only unlocked skills.
        // This prevents early-band scores from influencing middle-band activity
        // selection, and prevents locked-unit skills from appearing in sessions.
        $band             = $student->placement_band ?? 'middle';
        $unlockedSkillIds = $this->getUnlockedSkillIds($student);

        $masteryScores = MasteryScore::where('student_id', $student->id)
            ->where('grade_band', $band)
            ->with('skill')
            ->get()
            ->when(
                !empty($unlockedSkillIds),
                fn ($c) => $c->filter(fn ($ms) => in_array($ms->skill_id, $unlockedSkillIds))
            )
            ->keyBy('skill_id');

        $activities = $this->selectActivities($student, $masteryScores, $unlockedSkillIds);

        $domains = $activities
            ->map(fn ($a) => $a->skill->domain_id)
            ->unique()
            ->values()
            ->toArray();

        $sequenceNumber = StudentSession::where('student_id', $student->id)
            ->where('session_type', 'core')
            ->count() + 1;

        $session = StudentSession::create([
            'student_id'                  => $student->id,
            'learning_path_id'            => $learningPath->id,
            'status'                      => 'pending',
            'session_type'                => 'core',
            'sequence_number'             => $sequenceNumber,
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
    private function selectActivities(Student $student, Collection $masteryScores, array $unlockedSkillIds = []): Collection
    {
        $totalSlots = 6; // 3 + 2 + 1

        $weakestActivities   = $this->getActivitiesForWeakestSkill($student, $masteryScores, 3, $unlockedSkillIds);
        $reinforceActivities = $this->getReinforcementActivities($student, $masteryScores, 2, $unlockedSkillIds);
        $stretchActivities   = $this->getStretchActivities($student, $masteryScores, 1, $unlockedSkillIds);

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
        int $count,
        array $unlockedSkillIds = []
    ): Collection {
        $band = $student->placement_band ?? 'middle';

        if ($masteryScores->isEmpty()) {
            $q = Activity::with('skill')
                ->where('difficulty', 1)
                ->where('grade_band', $band)
                ->where('is_active', true)
                ->where('is_diagnostic', false);

            if (!empty($unlockedSkillIds)) {
                $q->whereIn('skill_id', $unlockedSkillIds);
            }

            return $q->inRandomOrder()->take($count)->get();
        }

        $weakest = $masteryScores->sortBy('score')->first();
        $skill   = $weakest->skill;
        $diff    = $this->targetDifficulty($weakest->score, 'low');

        return Activity::with('skill')
            ->where('skill_id', $skill->id)
            ->where('difficulty', $diff)
            ->where('grade_band', $band)
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
        int $count,
        array $unlockedSkillIds = []
    ): Collection {
        $band = $student->placement_band ?? 'middle';

        if ($masteryScores->isEmpty()) {
            $q = Activity::with('skill')
                ->where('difficulty', 1)
                ->where('grade_band', $band)
                ->where('is_active', true)
                ->where('is_diagnostic', false);

            if (!empty($unlockedSkillIds)) {
                $q->whereIn('skill_id', $unlockedSkillIds);
            }

            return $q->inRandomOrder()->take($count)->get();
        }

        $avgScore  = $masteryScores->avg('score');
        $midScores = $masteryScores->filter(fn ($ms) => abs($ms->score - $avgScore) < 20);
        $skillIds  = $midScores->pluck('skill_id');

        if ($skillIds->isEmpty()) {
            $skillIds = $masteryScores->pluck('skill_id');
        }

        return Activity::with('skill')
            ->whereIn('skill_id', $skillIds)
            ->where('difficulty', 2)
            ->where('grade_band', $band)
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
        int $count,
        array $unlockedSkillIds = []
    ): Collection {
        $band = $student->placement_band ?? 'middle';

        if ($masteryScores->isEmpty()) {
            $q = Activity::with('skill')
                ->where('difficulty', 2)
                ->where('grade_band', $band)
                ->where('is_active', true)
                ->where('is_diagnostic', false);

            if (!empty($unlockedSkillIds)) {
                $q->whereIn('skill_id', $unlockedSkillIds);
            }

            return $q->inRandomOrder()->take($count)->get();
        }

        $strongest = $masteryScores->sortByDesc('score')->first();
        $skill     = $strongest->skill;
        $diff      = $this->targetDifficulty($strongest->score, 'high');

        return Activity::with('skill')
            ->where('skill_id', $skill->id)
            ->where('difficulty', $diff)
            ->where('grade_band', $band)
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

    // -----------------------------------------------------------------------
    // Bonus sessions (§12 Option B)
    // -----------------------------------------------------------------------

    /**
     * Generate (or return existing) a bonus session for a student.
     * Called automatically when a core session is completed.
     */
    public function generateBonusSession(Student $student): StudentSession
    {
        // Return existing uncompleted bonus session (don't stack)
        $existing = StudentSession::where('student_id', $student->id)
            ->where('session_type', 'bonus')
            ->whereIn('status', ['pending', 'in_progress'])
            ->first();

        if ($existing) {
            return $existing;
        }

        $learningPath = $student->learningPath ?? LearningPath::create(['student_id' => $student->id]);

        // Exclude activities the student answered correctly in the last 7 days
        $recentlyCorrect = Attempt::where('student_id', $student->id)
            ->where('correct', true)
            ->where('created_at', '>=', now()->subDays(7))
            ->pluck('activity_id')
            ->unique()
            ->all();

        $band             = $student->placement_band ?? 'middle';
        $unlockedSkillIds = $this->getUnlockedSkillIds($student);

        $masteryScores = MasteryScore::where('student_id', $student->id)
            ->where('grade_band', $band)
            ->with('skill')
            ->get()
            ->when(
                !empty($unlockedSkillIds),
                fn ($c) => $c->filter(fn ($ms) => in_array($ms->skill_id, $unlockedSkillIds))
            )
            ->keyBy('skill_id');

        $activities = $this->selectBonusActivities($student, $masteryScores, $recentlyCorrect, $unlockedSkillIds);

        $domains = $activities
            ->map(fn ($a) => $a->skill->domain_id)
            ->unique()
            ->values()
            ->toArray();

        $session = StudentSession::create([
            'student_id'                 => $student->id,
            'learning_path_id'           => $learningPath->id,
            'status'                     => 'pending',
            'session_type'               => 'bonus',
            'sequence_number'            => null,
            'estimated_duration_minutes' => $this->estimateDuration($activities),
            'domains'                    => $domains,
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
     * 3-activity selection for bonus sessions:
     * - Focus on weakest domains
     * - Exclude recently-correct activities
     * - Diversify by activity type
     */
    private function selectBonusActivities(Student $student, Collection $masteryScores, array $excludeIds, array $unlockedSkillIds = []): Collection
    {
        $slots = 3;
        $band  = $student->placement_band ?? 'middle';

        if ($masteryScores->isEmpty()) {
            $q = Activity::with('skill')
                ->where('difficulty', 1)
                ->where('grade_band', $band)
                ->where('is_active', true)
                ->where('is_diagnostic', false)
                ->whereNotIn('id', $excludeIds);

            if (!empty($unlockedSkillIds)) {
                $q->whereIn('skill_id', $unlockedSkillIds);
            }

            return $q->inRandomOrder()->take($slots)->get();
        }

        // Mastery collection is already filtered to unlocked skills by caller.
        // Intersect explicitly as a safety net.
        $weakestSkillIds = $masteryScores->sortBy('score')->take(4)->pluck('skill_id');

        if (!empty($unlockedSkillIds)) {
            $weakestSkillIds = $weakestSkillIds->filter(fn ($id) => in_array($id, $unlockedSkillIds));
        }

        if ($weakestSkillIds->isEmpty() && !empty($unlockedSkillIds)) {
            $weakestSkillIds = collect($unlockedSkillIds);
        }

        $candidates = Activity::with('skill')
            ->whereIn('skill_id', $weakestSkillIds)
            ->where('grade_band', $band)
            ->where('is_active', true)
            ->where('is_diagnostic', false)
            ->whereNotIn('id', $excludeIds)
            ->inRandomOrder()
            ->take($slots * 4)
            ->get();

        $activities = $this->diversifyByType($candidates, $slots);

        // Fallback: pad from anywhere in the unlocked pool if weakest skills don't have enough
        if ($activities->count() < $slots) {
            $needed  = $slots - $activities->count();
            $usedIds = $activities->pluck('id')->merge($excludeIds)->all();

            $fq = Activity::with('skill')
                ->where('grade_band', $band)
                ->where('is_active', true)
                ->where('is_diagnostic', false)
                ->whereNotIn('id', $usedIds);

            if (!empty($unlockedSkillIds)) {
                $fq->whereIn('skill_id', $unlockedSkillIds);
            }

            $activities = $activities->merge($fq->inRandomOrder()->take($needed)->get());
        }

        return $activities;
    }

    /**
     * Shuffle activities so no two consecutive entries share the same type.
     */
    private function diversifyByType(Collection $activities, int $slots): Collection
    {
        $result   = collect();
        $lastType = null;
        $deferred = collect();

        foreach ($activities as $activity) {
            if ($result->count() >= $slots) break;

            if ($activity->type !== $lastType) {
                $result->push($activity);
                $lastType = $activity->type;
            } else {
                $deferred->push($activity);
            }
        }

        // Insert deferred items into remaining slots
        foreach ($deferred as $activity) {
            if ($result->count() >= $slots) break;
            $result->push($activity);
        }

        return $result->take($slots);
    }

    /**
     * Return the skill IDs from units the student has unlocked (active or completed).
     *
     * An empty return means no curriculum track has been assigned yet — callers
     * treat that as "no constraint" so the engine still works for students who
     * pre-date the curriculum system.
     */
    public function getUnlockedSkillIds(Student $student): array
    {
        $unlockedUnitIds = StudentUnitProgress::where('student_id', $student->id)
            ->whereIn('status', ['active', 'completed'])
            ->pluck('curriculum_unit_id');

        if ($unlockedUnitIds->isEmpty()) {
            return [];
        }

        return CurriculumUnitSkill::whereIn('curriculum_unit_id', $unlockedUnitIds)
            ->pluck('skill_id')
            ->unique()
            ->values()
            ->all();
    }

    private function estimateDuration(Collection $activities): int
    {
        // ~2 minutes per activity
        return max(5, $activities->count() * 2);
    }

    /**
     * Check if a student qualifies for band advancement.
     * Requires ≥5 practiced skills with average mastery ≥80.
     * Advances early→middle→upper. Returns true if band was advanced.
     */
    public function promoteBandIfReady(Student $student): bool
    {
        $bands        = ['early', 'middle', 'upper'];
        $currentBand  = $student->placement_band ?? 'middle';
        $currentIndex = array_search($currentBand, $bands, true);

        // Already at max band
        if ($currentIndex === false || $currentIndex >= count($bands) - 1) {
            return false;
        }

        // Only count mastery earned within the current band — cross-band scores
        // must not count toward advancement thresholds.
        $masteryScores = MasteryScore::where('student_id', $student->id)
            ->where('grade_band', $currentBand)
            ->get();

        // Require at least 5 distinct practiced skills before promoting
        if ($masteryScores->count() < 5) {
            return false;
        }

        if ($masteryScores->avg('score') < 80) {
            return false;
        }

        $nextBand = $bands[$currentIndex + 1];
        $student->update(['placement_band' => $nextBand]);

        return true;
    }
}
