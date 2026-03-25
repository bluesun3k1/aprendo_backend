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
     * Update weekly mission progress after a session is completed.
     *
     * @param  Student  $student
     * @param  int      $correctCount      Correct answers in this session
     * @param  int      $totalActivities   Total activities in this session
     * @param  array    $sessionDomains    Domain IDs present in this session
     * @param  int      $streakDays        Current streak after the session
     * @return array    Newly completed StudentMission models (with 'mission' relation loaded)
     */
    public function updateMissions(
        Student $student,
        int $correctCount = 0,
        int $totalActivities = 0,
        array $sessionDomains = [],
        int $streakDays = 0
    ): array {
        $weekStart = Carbon::now()->startOfWeek()->toDateString();
        $missions  = WeeklyMission::where('is_active', true)->get();
        $completed = [];

        foreach ($missions as $mission) {
            $sm = StudentMission::firstOrCreate(
                [
                    'student_id' => $student->id,
                    'mission_id' => $mission->id,
                    'week_start' => $weekStart,
                ],
                ['progress' => 0, 'completed' => false]
            );

            if ($sm->completed) continue;

            switch ($mission->mission_type) {
                case 'sessions_completed':
                    $sm->progress += 1;
                    break;

                case 'correct_answers':
                    $sm->progress += $correctCount;
                    break;

                case 'domain_sessions_completed':
                    // Only counts if this session included the mission's target domain
                    if (!empty($mission->domain_id) && in_array($mission->domain_id, $sessionDomains)) {
                        $sm->progress += 1;
                    }
                    break;

                case 'near_perfect_sessions':
                    // Near-perfect = at most 1 wrong answer in a session with ≥1 activity
                    if ($totalActivities > 0 && ($totalActivities - $correctCount) <= 1) {
                        $sm->progress += 1;
                    }
                    break;

                case 'streak_days':
                    // Progress mirrors current streak value (not additive)
                    $sm->progress = $streakDays;
                    break;

                default:
                    continue 2; // skip unknown types
            }

            if ($sm->progress >= $mission->target) {
                $sm->completed    = true;
                $sm->completed_at = now();
                $completed[]      = $sm->load('mission');
            }

            $sm->save();
        }

        return $completed;
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

        $completedSessions = $sessions->where('status', 'completed')->count();
        $currentStreak    = $streak?->current_streak ?? 0;
        $pointsTotal      = $student->points_total ?? 0;

        return match ($badge->trigger_type) {
            'first_session' => $completedSessions >= 1,
            'streak_3'      => $currentStreak >= 3,
            'streak_5'      => $currentStreak >= 5,
            'streak_10'     => $currentStreak >= 10,
            'streak_20'     => $currentStreak >= 20,
            'sessions_5'    => $completedSessions >= 5,
            'sessions_10'   => $completedSessions >= 10,
            'sessions_25'   => $completedSessions >= 25,
            'sessions_50'   => $completedSessions >= 50,
            'points_100'    => $pointsTotal >= 100,
            'points_250'    => $pointsTotal >= 250,
            'points_500'    => $pointsTotal >= 500,
            default         => false,
        };
    }
}
