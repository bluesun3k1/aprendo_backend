<?php

namespace App\Services;

use App\Models\DomainMilestone;
use App\Models\MasteryScore;
use App\Models\SkillDomain;
use App\Models\Student;
use App\Models\StudentMilestone;

class MilestoneUnlockService
{
    public function __construct(private readonly XpService $xpService) {}

    /**
     * Check and unlock all domain milestones across every domain for a student.
     * Called at session completion. Returns all newly unlocked milestones.
     */
    public function checkAllDomains(Student $student): array
    {
        $newly = [];
        $domainIds = SkillDomain::pluck('id');

        foreach ($domainIds as $domainId) {
            $newly = array_merge($newly, $this->checkDomain($student, $domainId));
        }

        return $newly;
    }

    /**
     * Check and unlock milestones for a single domain.
     * Backfills all thresholds the student has passed (handles score jumps).
     */
    public function checkDomain(Student $student, string $domainId): array
    {
        $domainScore = $this->computeDomainScore($student, $domainId);

        if ($domainScore === 0) {
            return [];
        }

        // IDs already unlocked for this student in this domain
        $unlockedIds = StudentMilestone::where('student_id', $student->id)
            ->whereHas('milestone', fn ($q) => $q->where('domain_id', $domainId))
            ->pluck('milestone_id');

        // All milestones in this domain whose threshold has been reached and not yet unlocked
        $toUnlock = DomainMilestone::where('domain_id', $domainId)
            ->where('threshold', '<=', $domainScore)
            ->whereNotIn('id', $unlockedIds)
            ->orderBy('threshold')
            ->get();

        $newly = [];
        foreach ($toUnlock as $milestone) {
            StudentMilestone::create([
                'student_id'          => $student->id,
                'milestone_id'        => $milestone->id,
                'unlocked_at'         => now(),
                'source_domain_score' => $domainScore,
            ]);

            // Award XP bonus if configured (non-zero)
            if ($milestone->reward_xp > 0) {
                $this->xpService->awardXp($student, $milestone->reward_xp);
                $student->refresh();
            }

            $newly[] = $milestone;
        }

        return $newly;
    }

    /**
     * Aggregate domain mastery from all skill mastery scores in that domain.
     * Uses the same averaging logic as DashboardController and SkillMapController.
     */
    public function computeDomainScore(Student $student, string $domainId): int
    {
        $scores = MasteryScore::where('student_id', $student->id)
            ->whereHas('skill', fn ($q) => $q->where('domain_id', $domainId))
            ->pluck('score');

        return $scores->isEmpty() ? 0 : (int) round($scores->avg());
    }
}
