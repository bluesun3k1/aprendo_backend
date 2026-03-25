<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\MasteryScore;
use App\Models\SkillDomain;
use App\Models\StudentMission;
use App\Models\StudentSession;
use App\Services\XpService;
use Carbon\Carbon;
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

        $locale = str_contains($request->header('Accept-Language', 'es'), 'en') ? 'en' : 'es';
        $streak = $student->streak;

        // Sessions completed today
        $sessionsCompletedToday = StudentSession::where('student_id', $student->id)
            ->whereDate('created_at', today())
            ->where('status', 'completed')
            ->count();

        // Domain progress — with label (locale-aware) and trend (majority vote from skills)
        $masteryScores = MasteryScore::where('student_id', $student->id)
            ->with('skill')
            ->get();

        $domains = SkillDomain::all()->map(function ($domain) use ($masteryScores, $locale) {
            $domainScores = $masteryScores->filter(fn ($ms) => $ms->skill?->domain_id === $domain->id);
            $avg    = $domainScores->isEmpty() ? 0 : (int) round($domainScores->avg('score'));
            $lastAt = $domainScores->max('last_practiced_at');

            // Aggregate trend: majority vote across all skills in this domain
            $trendCounts = ['up' => 0, 'stable' => 0, 'down' => 0];
            foreach ($domainScores as $ms) {
                $t = $ms->trend ?? 'stable';
                $trendCounts[$t] = ($trendCounts[$t] ?? 0) + 1;
            }
            arsort($trendCounts);
            $domainTrend = array_key_first($trendCounts) ?? 'stable';

            return [
                'id'               => $domain->id,
                'label'            => $locale === 'en' ? $domain->label_en : $domain->label_es,
                'mastery_score'    => $avg,
                'trend'            => $domainTrend,
                'last_activity_at' => $lastAt
                    ? Carbon::parse($lastAt)->toIso8601String()
                    : null,
            ];
        })->values();

        // Today's active session (newest pending or in_progress)
        $todaySession     = StudentSession::where('student_id', $student->id)
            ->whereIn('status', ['pending', 'in_progress'])
            ->latest()
            ->first();

        $todaySessionData = null;
        if ($todaySession) {
            $totalActivities     = $todaySession->sessionActivities()->count();
            $activitiesCompleted = $todaySession->attempts()->where('completed', true)->count();
            $sessionDomains      = $todaySession->domains ?? [];

            // Build a readable title from sequence number + first domain label
            $firstDomainLabel = '';
            if (!empty($sessionDomains)) {
                $firstDomain = SkillDomain::find($sessionDomains[0]);
                if ($firstDomain) {
                    $firstDomainLabel = ' · ' . ($locale === 'en' ? $firstDomain->label_en : $firstDomain->label_es);
                }
            }
            $n = $todaySession->sequence_number ?? 1;
            if ($locale === 'en') {
                $title = $todaySession->session_type === 'bonus'
                    ? "Bonus session{$firstDomainLabel}"
                    : "Session {$n}{$firstDomainLabel}";
            } else {
                $title = $todaySession->session_type === 'bonus'
                    ? "Sesión bono{$firstDomainLabel}"
                    : "Sesión {$n}{$firstDomainLabel}";
            }

            $todaySessionData = [
                'session_id'                 => $todaySession->id,
                'title'                      => $title,
                'estimated_duration_minutes' => $todaySession->estimated_duration_minutes ?? 15,
                'total_activities'           => $totalActivities,
                'activities_completed'       => $activitiesCompleted,
                'status'                     => $todaySession->status,
                'domains'                    => $sessionDomains,
            ];
        }

        // Most recently earned badge — with description (locale-aware) and earned_at date
        $lastStudentBadge = $student->studentBadges()->with('badge')->latest('earned_at')->first();
        $recentBadge      = null;
        if ($lastStudentBadge) {
            $recentBadge = [
                'id'          => $lastStudentBadge->badge->id,
                'name'        => $lastStudentBadge->badge->name,
                'description' => $locale === 'en'
                    ? $lastStudentBadge->badge->description_en
                    : $lastStudentBadge->badge->description_es,
                'icon_url'    => $lastStudentBadge->badge->icon_url,
                'earned_at'   => Carbon::parse($lastStudentBadge->earned_at)->toDateString(),
            ];
        }

        // Weekly missions for the current week
        $weekStart      = now()->startOfWeek()->toDateString();
        $weeklyMissions = StudentMission::where('student_id', $student->id)
            ->where('week_start', $weekStart)
            ->with('mission')
            ->get()
            ->map(fn ($sm) => [
                'id'          => $sm->id,
                'mission_id'  => $sm->mission_id,
                'label'       => $locale === 'en' ? $sm->mission->label_en : $sm->mission->label_es,
                'progress'    => $sm->progress,
                'target'      => $sm->mission->target,
                'completed'   => $sm->completed,
                'completed_at' => $sm->completed_at?->toIso8601String(),
                'category'    => $sm->mission->category,
                'difficulty'  => $sm->mission->difficulty,
                'reward_xp'   => $sm->mission->reward_xp,
                'domain_id'   => $sm->mission->domain_id,
                'sort_order'  => $sm->mission->sort_order,
            ])
            ->sortBy('sort_order')
            ->values();

        return response()->json([
            'student_id'               => $student->id,
            'display_name'             => $student->display_name,
            'streak'                   => [
                'current' => $streak?->current_streak ?? 0,
                'best'    => $streak?->best_streak ?? 0,
            ],
            'sessions_completed_today' => $sessionsCompletedToday,
            'sessions_goal_today'      => 1,
            'current_level'            => $student->current_level ?? 1,
            'current_xp'               => $student->current_xp ?? 0,
            'xp_to_next_level'         => $this->xpService->xpToNextLevel($student->current_xp ?? 0),
            'domains'                  => $domains,
            'today_session'            => $todaySessionData,
            'recent_badge'             => $recentBadge,
            'weekly_missions'          => $weeklyMissions,
        ]);
    }
}
