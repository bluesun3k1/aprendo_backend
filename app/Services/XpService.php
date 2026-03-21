<?php

namespace App\Services;

use App\Models\Student;

class XpService
{
    /**
     * XP thresholds to reach each level (cumulative total XP required).
     * Level 1 starts at 0.
     */
    private const LEVEL_THRESHOLDS = [
        1  => 0,
        2  => 100,
        3  => 250,
        4  => 450,
        5  => 700,
        6  => 1000,
        7  => 1350,
        8  => 1750,
        9  => 2200,
        10 => 2700,
        11 => 3250,
        12 => 3850,
        13 => 4500,
        14 => 5200,
        15 => 6000,
    ];

    /**
     * Calculate XP to award for a session.
     *
     * @param int $correctCount
     * @param int $totalActivities
     * @param int $avgDifficulty  average difficulty across attempted activities (1-3)
     * @param int $currentStreak
     */
    public function calculateSessionXp(
        int $correctCount,
        int $totalActivities,
        float $avgDifficulty = 2.0,
        int $currentStreak = 0
    ): int {
        if ($totalActivities === 0) return 0;

        // Base XP: 10 per correct answer, scaled by difficulty
        $base = $correctCount * (int) round($avgDifficulty * 10);

        // Session completion bonus
        $base += 10;

        // Streak bonus: +10% per 3 days of streak, max +30%
        $streakMultiplier = 1.0 + min(0.30, floor($currentStreak / 3) * 0.10);

        return (int) round($base * $streakMultiplier);
    }

    /**
     * Award XP to a student. Updates current_xp and current_level.
     * Returns [xp_awarded, new_level, levelled_up].
     */
    public function awardXp(Student $student, int $xp): array
    {
        $previousLevel = $student->current_level;
        $newXp         = $student->current_xp + $xp;
        $newLevel      = $this->levelForXp($newXp);
        $levelledUp    = $newLevel > $previousLevel;

        $student->update([
            'current_xp'    => $newXp,
            'current_level' => $newLevel,
        ]);

        return [
            'xp_awarded'  => $xp,
            'new_level'   => $newLevel,
            'levelled_up' => $levelledUp,
        ];
    }

    /**
     * Determine the current level from total XP.
     */
    public function levelForXp(int $xp): int
    {
        $level = 1;
        foreach (self::LEVEL_THRESHOLDS as $lvl => $threshold) {
            if ($xp >= $threshold) {
                $level = $lvl;
            }
        }
        return $level;
    }

    /**
     * XP required to reach the next level from current total XP.
     */
    public function xpToNextLevel(int $currentXp): int
    {
        $currentLevel = $this->levelForXp($currentXp);
        $nextLevel    = $currentLevel + 1;

        if (!isset(self::LEVEL_THRESHOLDS[$nextLevel])) {
            // Max level — return 0
            return 0;
        }

        return self::LEVEL_THRESHOLDS[$nextLevel] - $currentXp;
    }

    /**
     * Derive age_band from a grade string.
     * grades 1–2 → early, 3–5 → middle, 6–9 → upper
     */
    public static function ageBandFromGrade(?string $grade): ?string
    {
        if ($grade === null) return null;
        $g = (int) preg_replace('/\D/', '', $grade);
        if ($g <= 0) return null;
        if ($g <= 2) return 'early';
        if ($g <= 5) return 'middle';
        if ($g <= 9) return 'upper';
        return null;
    }
}
