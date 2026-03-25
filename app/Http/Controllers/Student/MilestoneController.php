<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\DomainMilestone;
use App\Models\SkillDomain;
use App\Models\StudentMilestone;
use App\Services\MilestoneUnlockService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MilestoneController extends Controller
{
    public function __construct(private readonly MilestoneUnlockService $milestoneService) {}

    // -----------------------------------------------------------------------
    // GET /api/v1/student/milestones
    //
    // Returns all domain milestones grouped by domain with unlock status.
    // Also includes the student's current domain score and next milestone progress.
    // -----------------------------------------------------------------------
    public function index(Request $request): JsonResponse
    {
        $student = $request->user();

        // All milestones unlocked by this student, keyed by milestone_id
        $unlocked = StudentMilestone::where('student_id', $student->id)
            ->with('milestone')
            ->get()
            ->keyBy('milestone_id');

        // All domain milestones grouped by domain_id, sorted by threshold
        $allMilestones = DomainMilestone::where('is_hidden', false)
            ->orderBy('domain_id')
            ->orderBy('threshold')
            ->get()
            ->groupBy('domain_id');

        $domains = SkillDomain::all()->map(function ($domain) use ($allMilestones, $unlocked, $student) {
            $domainScore = $this->milestoneService->computeDomainScore($student, $domain->id);
            $ladder      = $allMilestones[$domain->id] ?? collect();

            $milestoneItems = $ladder->map(function ($m) use ($unlocked, $domainScore) {
                $studentMilestone = $unlocked[$m->id] ?? null;
                $earned = $studentMilestone !== null;

                // Progress toward next unearned milestone
                $progress = ($earned || $m->threshold === 0)
                    ? 1.0
                    : round(min($domainScore / $m->threshold, 1.0), 2);

                return [
                    'id'                => $m->id,
                    'threshold'         => $m->threshold,
                    'name'              => $m->name,
                    'description'       => $m->description,
                    'icon'              => $m->icon,
                    'reward_xp'         => $m->reward_xp,
                    'celebration_level' => $m->celebration_level,
                    'earned'            => $earned,
                    'earned_at'         => $studentMilestone?->unlocked_at?->toIso8601String(),
                    'source_score'      => $studentMilestone?->source_domain_score,
                    'progress'          => $progress,
                ];
            })->values();

            // The next milestone the student has not yet earned
            $nextMilestone = $milestoneItems->firstWhere('earned', false);

            return [
                'domain_id'     => $domain->id,
                'domain_label'  => $domain->label_es,
                'domain_score'  => $domainScore,
                'next_milestone'=> $nextMilestone,
                'milestones'    => $milestoneItems,
            ];
        })->values();

        // Summary counts
        $totalEarned = $unlocked->count();
        $totalAvailable = DomainMilestone::where('is_hidden', false)->count();

        return response()->json([
            'total_earned'    => $totalEarned,
            'total_available' => $totalAvailable,
            'domains'         => $domains,
        ]);
    }
}
