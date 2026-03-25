<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RewardsController extends Controller
{
    // -----------------------------------------------------------------------
    // GET /api/v1/student/rewards
    // -----------------------------------------------------------------------
    public function index(Request $request): JsonResponse
    {
        $student = $request->user();
        $locale  = app()->getLocale();
        $student->loadMissing(['streak', 'studentBadges.badge', 'sessions', 'studentMissions.mission']);

        $streak = $student->streak;

        // Earned badges with ISO timestamp
        $earnedBadgeIds = $student->studentBadges->pluck('badge_id');

        $earnedBadges = $student->studentBadges->map(fn ($sb) => [
            'id'                => $sb->badge->id,
            'name'              => $sb->badge->name,
            'description'       => $locale === 'es' ? $sb->badge->description_es : $sb->badge->description_en,
            'icon_url'          => $sb->badge->icon_url,
            'category'          => $sb->badge->category,
            'sort_order'        => $sb->badge->sort_order,
            'threshold_value'   => $sb->badge->threshold_value,
            'celebration_level' => $sb->badge->celebration_level,
            'is_hidden'         => (bool) $sb->badge->is_hidden,
            'earned'            => true,
            'earned_at'         => Carbon::parse($sb->earned_at)->toIso8601String(),
        ]);

        $unearnedBadges = \App\Models\Badge::whereNotIn('id', $earnedBadgeIds)
            ->where('is_hidden', false)
            ->get()
            ->map(fn ($b) => [
                'id'                => $b->id,
                'name'              => $b->name,
                'description'       => $locale === 'es' ? $b->description_es : $b->description_en,
                'icon_url'          => $b->icon_url,
                'category'          => $b->category,
                'sort_order'        => $b->sort_order,
                'threshold_value'   => $b->threshold_value,
                'celebration_level' => $b->celebration_level,
                'is_hidden'         => false,
                'earned'            => false,
                'earned_at'         => null,
            ]);

        $allBadges = $earnedBadges->merge($unearnedBadges)
            ->sortBy('sort_order')
            ->values();

        $totalSessions = $student->sessions->where('status', 'completed')->count();
        $totalXp       = $student->current_xp ?? 0;

        $weekStart      = now()->startOfWeek()->toDateString();
        $weeklyMissions = $student->studentMissions
            ->where('week_start', $weekStart)
            ->map(fn ($sm) => [
                'id'          => $sm->id,
                'mission_id'  => $sm->mission_id,
                'label'       => $locale === 'es' ? $sm->mission->label_es : $sm->mission->label_en,
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
            'badges'          => $allBadges,
            'streak_days'     => $streak?->current_streak ?? 0,
            'total_sessions'  => $totalSessions,
            'total_xp'        => $totalXp,
            'weekly_missions' => $weeklyMissions,
        ]);
    }
}
