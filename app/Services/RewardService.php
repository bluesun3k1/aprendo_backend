<?php

namespace App\Services;

use App\Models\Badge;
use App\Models\Student;
use App\Models\StudentBadge;
use App\Models\StudentMission;
use App\Models\Streak;
use App\Models\WeeklyMission;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class RewardService
{
    /**
     * Record a completed session and update streak, missions, and badges.
     * Returns array of newly unlocked badges.
     */
    public function recordSessionCompleted(Student $student, int $correctCount, int $totalActivities): array
    {
        $this->updateStreak($student);
        $this->updateMissions($student);
        $newBadges = $this->checkAndAwardBadges($student);

        return $newBadges;
    }

    /**
     * Update the student's streak.
     */
    public function updateStreak(Student $student): Streak
    {
        $streak = Streak::firstOrCreate(
            ['student_id' => $student->id],
            ['current_streak' => 0, 'best_streak' => 0, 'history' => [], 'last_activity_date' => null]
        );

        $today     = today()->toDateString();
        $yesterday = today()->subDay()->toDateString();

        // Already counted today
        if ($streak->last_activity_date?->toDateString() === $today) {
            return $streak;
        }

        $history = $streak->history ?? [];

        if ($streak->last_activity_date?->toDateString() === $yesterday) {
            $streak->current_streak += 1;
        } else {
            $streak->current_streak = 1;
        }

        if ($streak->current_streak > $streak->best_streak) {
            $streak->best_streak = $streak->current_streak;
        }

        // Keep last 30 days in history
        $history[] = $today;
        $history   = array_slice($history, -30);

        $streak->update([
            'current_streak'     => $streak->current_streak,
            'best_streak'        => $streak->best_streak,
            'last_activity_date' => $today,
            'history'            => $history,
        ]);

        return $streak;
    }

    /**
     * Update weekly mission progress.
     */
    private function updateMissions(Student $student): void
    {
        $weekStart = Carbon::now()->startOfWeek()->toDateString();

        $missions = WeeklyMission::where('is_active', true)->get();

        foreach ($missions as $mission) {
            if ($mission->mission_type !== 'sessions_completed') continue;

            $studentMission = StudentMission::firstOrCreate(
                ['student_id' => $student->id, 'mission_id' => $mission->id, 'week_start' => $weekStart],
                ['progress' => 0, 'completed' => false]
            );

            if ($studentMission->completed) continue;

            $studentMission->progress += 1;
            if ($studentMission->progress >= $mission->target) {
                $studentMission->completed = true;
            }
            $studentMission->save();
        }
    }

    /**
     * Check eligibility and award badges. Returns array of newly earned badges.
     */
    public function checkAndAwardBadges(Student $student): array
    {
        $student->loadMissing(['streak', 'studentBadges', 'sessions']);

        $earnedBadgeIds = $student->studentBadges->pluck('badge_id')->toArray();
        $allBadges      = Badge::all();
        $newBadges      = [];

        foreach ($allBadges as $badge) {
            if (in_array($badge->id, $earnedBadgeIds)) continue;

            if ($this->meetsCondition($student, $badge)) {
                $studentBadge = StudentBadge::create([
                    'student_id' => $student->id,
                    'badge_id'   => $badge->id,
                    'earned_at'  => now(),
                ]);
                $newBadges[] = $badge;
            }
        }

        return $newBadges;
    }

    private function meetsCondition(Student $student, Badge $badge): bool
    {
        $streak   = $student->streak;
        $sessions = $student->sessions;

        return match ($badge->trigger_type) {
            'first_session'   => $sessions->count() >= 1,
            'streak_3'        => ($streak?->current_streak ?? 0) >= 3,
            'streak_5'        => ($streak?->current_streak ?? 0) >= 5,
            'streak_10'       => ($streak?->current_streak ?? 0) >= 10,
            'sessions_5'      => $sessions->where('status', 'completed')->count() >= 5,
            'sessions_10'     => $sessions->where('status', 'completed')->count() >= 10,
            'points_100'      => $student->points_total >= 100,
            'points_500'      => $student->points_total >= 500,
            default           => false,
        };
    }
}
