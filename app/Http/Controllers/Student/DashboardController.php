<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\MasteryScore;
use App\Models\SkillDomain;
use App\Models\StudentSession;
use App\Services\XpService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(private readonly XpService $xpService) {}

    // -----------------------------------------------------------------------
    // GET /api/v1/student/dashboard
    // -----------------------------------------------------------------------
    public function index(Request $request): JsonResponse
    {
        $student = $request->user();
        $student->loadMissing(['streak', 'studentBadges.badge']);

        $streak = $student->streak;

        // Sessions completed today
        $sessionsCompletedToday = StudentSession::where('student_id', $student->id)
            ->whereDate('created_at', today())
            ->where('status', 'completed')
            ->count();

        // Domain progress
        $masteryScores = MasteryScore::where('student_id', $student->id)
            ->with('skill')
            ->get();

        $domains = SkillDomain::all()->map(function ($domain) use ($masteryScores) {
            $domainScores = $masteryScores->filter(fn ($ms) => $ms->skill?->domain_id === $domain->id);
            $avg = $domainScores->isEmpty() ? 0 : (int) round($domainScores->avg('score'));

            $lastAt = $domainScores->max('last_practiced_at');

            return [
                'id'             => $domain->id,
                'mastery_score'  => $avg,
                'last_activity_at' => $lastAt
                    ? \Carbon\Carbon::parse($lastAt)->toIso8601String()
                    : null,
            ];
        })->values();

        // Most recently earned badge
        $lastStudentBadge = $student->studentBadges()->with('badge')->latest('earned_at')->first();
        $recentBadge = $lastStudentBadge ? [
            'id'       => $lastStudentBadge->badge->id,
            'name'     => $lastStudentBadge->badge->name,
            'icon_url' => $lastStudentBadge->badge->icon_url,
        ] : null;

        return response()->json([
            'student_id'               => $student->id,
            'display_name'             => $student->display_name,
            'streak_days'              => $streak?->current_streak ?? 0,
            'sessions_completed_today' => $sessionsCompletedToday,
            'sessions_goal_today'      => 1,
            'current_level'            => $student->current_level ?? 1,
            'current_xp'               => $student->current_xp ?? 0,
            'xp_to_next_level'         => $this->xpService->xpToNextLevel($student->current_xp ?? 0),
            'domains'                  => $domains,
            'recent_badge'             => $recentBadge,
        ]);
    }
}
