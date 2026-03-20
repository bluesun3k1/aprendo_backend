<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\MasteryScore;
use App\Models\SkillDomain;
use App\Models\StudentSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // -----------------------------------------------------------------------
    // GET /api/v1/student/dashboard
    // -----------------------------------------------------------------------
    public function index(Request $request): JsonResponse
    {
        $student = $request->user();
        $student->loadMissing(['school', 'streak', 'studentBadges.badge']);

        $streak = $student->streak;

        // Today's session (or most recently pending)
        $todaySession = StudentSession::where('student_id', $student->id)
            ->whereDate('created_at', today())
            ->first();

        // Domain progress: average mastery per domain
        $masteryScores = MasteryScore::where('student_id', $student->id)
            ->with('skill')
            ->get();

        $domains = SkillDomain::all();

        $domainProgress = $domains->map(function ($domain) use ($masteryScores) {
            $domainScores = $masteryScores->filter(fn ($ms) => $ms->skill?->domain_id === $domain->id);
            $avg = $domainScores->isEmpty() ? 0 : (int) round($domainScores->avg('score'));
            $trend = $this->dominantTrend($domainScores);

            return [
                'domain'           => $domain->id,
                'overall_mastery'  => $avg,
                'trend'            => $trend,
            ];
        })->values();

        // Last badge earned
        $lastStudentBadge = $student->studentBadges()->with('badge')->latest('earned_at')->first();
        $lastBadge = $lastStudentBadge ? [
            'id'       => $lastStudentBadge->badge->id,
            'name'     => $lastStudentBadge->badge->name,
            'icon_url' => $lastStudentBadge->badge->icon_url,
        ] : null;

        return response()->json([
            'student' => [
                'id'           => $student->id,
                'display_name' => $student->display_name,
                'grade'        => $student->grade,
                'school_name'  => $student->school?->name,
            ],
            'streak' => [
                'current' => $streak?->current_streak ?? 0,
                'best'    => $streak?->best_streak ?? 0,
            ],
            'today_session' => $todaySession ? [
                'session_id'                 => $todaySession->id,
                'estimated_duration_minutes' => $todaySession->estimated_duration_minutes,
                'completed'                  => $todaySession->status === 'completed',
                'domains'                    => $todaySession->domains ?? [],
            ] : null,
            'domain_progress' => $domainProgress,
            'last_badge'      => $lastBadge,
            'points_total'    => $student->points_total,
        ]);
    }

    private function dominantTrend($scores): string
    {
        if ($scores->isEmpty()) return 'stable';

        $counts = $scores->countBy('trend');
        return $counts->sortDesc()->keys()->first() ?? 'stable';
    }
}
