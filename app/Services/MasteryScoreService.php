<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\Attempt;
use App\Models\MasteryScore;
use App\Models\ProgressSnapshot;
use App\Models\Skill;
use App\Models\Student;

class MasteryScoreService
{
    /**
     * Evaluate an attempt and update mastery score.
     * Returns [correct, score_delta, feedback_text, updated_mastery].
     */
    public function evaluateAttempt(Activity $activity, array $response): array
    {
        $correct = $this->checkCorrectness($activity, $response);

        return [
            'correct'       => $correct,
            'feedback_text' => $correct
                ? $this->correctFeedback()
                : $this->incorrectFeedback(),
        ];
    }

    /**
     * Update mastery score for a student/skill pair after an attempt.
     */
    public function updateMastery(Student $student, Activity $activity, bool $correct, int $responseTimeMs = 0): array
    {
        $mastery = MasteryScore::firstOrCreate(
            ['student_id' => $student->id, 'skill_id' => $activity->skill_id],
            ['score' => 0, 'trend' => 'stable']
        );

        $previousScore = $mastery->score;

        // Score delta based on difficulty and correctness
        $delta = $this->calculateDelta($activity->difficulty, $correct, $responseTimeMs);
        $newScore = max(0, min(100, $mastery->score + $delta));

        $trend = match (true) {
            $newScore > $previousScore + 2 => 'up',
            $newScore < $previousScore - 2 => 'down',
            default                        => 'stable',
        };

        $mastery->update([
            'score'             => $newScore,
            'trend'             => $trend,
            'last_practiced_at' => now(),
        ]);

        // Snapshot for progress history (once per day per domain)
        $this->maybeSnapshot($student, $activity->skill_id, $activity->skill->domain_id, $newScore);

        return [
            'skill_id'  => $activity->skill_id,
            'new_score' => $newScore,
            'trend'     => $trend,
        ];
    }

    public function checkCorrectness(Activity $activity, array $response): bool
    {
        $correct = $activity->correct_answer;

        return match ($activity->type) {
            // New contract: selected_option_id  (old: chosen_option_id — keep both for compat)
            'multiple_choice' => (
                isset($response['selected_option_id'])
                    ? $response['selected_option_id']
                    : ($response['chosen_option_id'] ?? null)
            ) === ($correct['correct_option_id'] ?? null),

            // New contract: placements: [{item_id, zone_id}]  (old: zones: {zone_id: [items]})
            'drag_to_sort' => isset($response['placements'])
                ? $this->comparePlacements($response['placements'], $correct['zones'] ?? [])
                : (isset($response['zones']) && $this->compareMaps($response['zones'], $correct['zones'] ?? [])),

            // New contract: tapped_ids: [ids]  (old: sequence: [ids])
            'tap_sequence' => (
                isset($response['tapped_ids'])
                    ? $response['tapped_ids']
                    : ($response['sequence'] ?? [])
            ) === ($correct['sequence'] ?? []),

            default => false,
        };
    }

    private function calculateDelta(int $difficulty, bool $correct, int $responseTimeMs): int
    {
        if (!$correct) {
            return match ($difficulty) {
                1 => -3,
                2 => -4,
                3 => -5,
                default => -3,
            };
        }

        $base = match ($difficulty) {
            1 => 5,
            2 => 8,
            3 => 12,
            default => 5,
        };

        // Speed bonus: under 5s for easy, 8s for medium, 12s for hard
        $speedThreshold = match ($difficulty) {
            1 => 5000,
            2 => 8000,
            3 => 12000,
            default => 8000,
        };

        if ($responseTimeMs > 0 && $responseTimeMs < $speedThreshold) {
            $base += 2;
        }

        return $base;
    }

    /**
     * Convert [{item_id, zone_id}] placements into {zone_id: [item_ids]} map
     * and compare against the correct zones map.
     */
    private function comparePlacements(array $placements, array $correctZones): bool
    {
        $built = [];
        foreach ($placements as $p) {
            $built[$p['zone_id']][] = $p['item_id'];
        }
        return $this->compareMaps($built, $correctZones);
    }

    private function compareMaps(array $submitted, array $correct): bool
    {
        if (array_keys($submitted) !== array_keys($correct)) {
            return false;
        }

        foreach ($correct as $zone => $items) {
            $submittedItems = $submitted[$zone] ?? [];
            if (sort($submittedItems) !== sort($items)) {
                sort($submittedItems);
                sort($items);
                if ($submittedItems !== $items) return false;
            }
        }

        return true;
    }

    private function maybeSnapshot(Student $student, string $skillId, string $domainId, int $score): void
    {
        $today = today()->toDateString();

        $exists = ProgressSnapshot::where('student_id', $student->id)
            ->where('domain_id', $domainId)
            ->where('recorded_at', $today)
            ->exists();

        if (!$exists) {
            ProgressSnapshot::create([
                'student_id'    => $student->id,
                'domain_id'     => $domainId,
                'skill_id'      => $skillId,
                'mastery_score' => $score,
                'recorded_at'   => $today,
            ]);
        }
    }

    private function correctFeedback(): string
    {
        $options = ['¡Muy bien!', '¡Excelente!', '¡Correcto!', '¡Genial!', '¡Perfecto!'];
        return $options[array_rand($options)];
    }

    private function incorrectFeedback(): string
    {
        $options = ['Sigue intentando.', 'Casi lo logras.', 'Inténtalo de nuevo.', 'No te rindas.'];
        return $options[array_rand($options)];
    }
}
