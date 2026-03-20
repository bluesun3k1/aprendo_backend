<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\WeeklyMission;
use App\Models\StudentMission;
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
        $student->loadMissing(['streak', 'studentBadges.badge']);

        $streak = $student->streak;

        $badges = $student->studentBadges->map(fn ($sb) => [
            'id'          => $sb->badge->id,
            'name'        => $sb->badge->name,
            'description' => $locale === 'es' ? $sb->badge->description_es : $sb->badge->description_en,
            'icon_url'    => $sb->badge->icon_url,
            'earned'      => true,
            'earned_at'   => $sb->earned_at->toDateString(),
        ]);

        // Include un-earned badges too
        $earnedBadgeIds = $student->studentBadges->pluck('badge_id');
        $unearnedBadges = \App\Models\Badge::whereNotIn('id', $earnedBadgeIds)->get()->map(fn ($b) => [
            'id'          => $b->id,
            'name'        => $b->name,
            'description' => $locale === 'es' ? $b->description_es : $b->description_en,
            'icon_url'    => $b->icon_url,
            'earned'      => false,
            'earned_at'   => null,
        ]);

        $allBadges = $badges->merge($unearnedBadges)->values();

        // Weekly missions
        $weekStart = Carbon::now()->startOfWeek()->toDateString();
        $missions  = WeeklyMission::where('is_active', true)->get();

        $weeklyMissions = $missions->map(function ($mission) use ($student, $weekStart, $locale) {
            $sm = StudentMission::where('student_id', $student->id)
                ->where('mission_id', $mission->id)
                ->where('week_start', $weekStart)
                ->first();

            return [
                'id'        => $mission->id,
                'label'     => $locale === 'es' ? $mission->label_es : $mission->label_en,
                'progress'  => $sm?->progress ?? 0,
                'target'    => $mission->target,
                'completed' => $sm?->completed ?? false,
            ];
        });

        return response()->json([
            'points_total'    => $student->points_total,
            'streak'          => [
                'current' => $streak?->current_streak ?? 0,
                'best'    => $streak?->best_streak ?? 0,
                'history' => $streak?->history ?? [],
            ],
            'badges'          => $allBadges,
            'weekly_missions' => $weeklyMissions,
        ]);
    }
}
