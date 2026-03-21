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
        $student->loadMissing(['streak', 'studentBadges.badge', 'sessions']);

        $streak = $student->streak;

        // Earned badges with ISO timestamp
        $earnedBadgeIds = $student->studentBadges->pluck('badge_id');

        $earnedBadges = $student->studentBadges->map(fn ($sb) => [
            'id'          => $sb->badge->id,
            'name'        => $sb->badge->name,
            'description' => $locale === 'es' ? $sb->badge->description_es : $sb->badge->description_en,
            'icon_url'    => $sb->badge->icon_url,
            'earned'      => true,
            'earned_at'   => Carbon::parse($sb->earned_at)->toIso8601String(),
        ]);

        $unearnedBadges = \App\Models\Badge::whereNotIn('id', $earnedBadgeIds)->get()->map(fn ($b) => [
            'id'          => $b->id,
            'name'        => $b->name,
            'description' => $locale === 'es' ? $b->description_es : $b->description_en,
            'icon_url'    => $b->icon_url,
            'earned'      => false,
            'earned_at'   => null,
        ]);

        $allBadges = $earnedBadges->merge($unearnedBadges)->values();

        $totalSessions = $student->sessions->where('status', 'completed')->count();
        $totalXp       = $student->current_xp ?? 0;

        return response()->json([
            'badges'          => $allBadges,
            'streak_days'     => $streak?->current_streak ?? 0,
            'total_sessions'  => $totalSessions,
            'total_xp'        => $totalXp,
        ]);
    }
}
