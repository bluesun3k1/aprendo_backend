<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\Diagnostic;
use App\Models\DiagnosticActivity;
use App\Models\LearningPath;
use App\Models\MasteryScore;
use App\Models\Student;
use Illuminate\Support\Str;

class DiagnosticService
{
    /**
     * Create (or retrieve) a diagnostic for the student.
     * Selects 9 activities: 3 per domain, 1 per difficulty.
     */
    public function getOrCreateDiagnostic(Student $student): Diagnostic
    {
        $existing = Diagnostic::where('student_id', $student->id)
            ->where('status', 'pending')
            ->first();

        if ($existing) {
            return $existing;
        }

        $activities = $this->selectDiagnosticActivities();

        $diagnostic = Diagnostic::create([
            'student_id' => $student->id,
            'status'     => 'pending',
        ]);

        foreach ($activities as $index => $activity) {
            \DB::table('diagnostic_activities')->insert([
                'diagnostic_id' => $diagnostic->id,
                'activity_id'   => $activity->id,
                'order_index'   => $index,
            ]);
        }

        return $diagnostic;
    }

    /**
     * Select 3 activities per domain (one per difficulty 1/2/3) marked as diagnostic.
     */
    private function selectDiagnosticActivities(): \Illuminate\Support\Collection
    {
        $domains    = ['reading', 'attention', 'reasoning'];
        $activities = collect();

        foreach ($domains as $domain) {
            foreach ([1, 2, 3] as $difficulty) {
                $activity = Activity::whereHas('skill', fn ($q) => $q->where('domain_id', $domain))
                    ->where('difficulty', $difficulty)
                    ->where('is_diagnostic', true)
                    ->where('is_active', true)
                    ->inRandomOrder()
                    ->first();

                if ($activity) {
                    $activities->push($activity);
                }
            }
        }

        return $activities;
    }

    /**
     * Process submitted diagnostic attempts and compute mastery scores.
     */
    public function processSubmission(
        Student $student,
        Diagnostic $diagnostic,
        array $attempts,
        MasteryScoreService $masteryService
    ): array {
        $masteryResults = [];

        foreach ($attempts as $attempt) {
            $activity = Activity::with('skill')->find($attempt['activity_id']);
            if (!$activity) continue;

            // New contract: response is always in 'response' wrapper
            $response  = $attempt['response'] ?? [];
            $correct   = $masteryService->checkCorrectness($activity, $response);
            $rtMs      = $attempt['response_time_ms'] ?? 0;

            $updated = $masteryService->updateMastery($student, $activity, $correct, $rtMs);

            $masteryResults[] = [
                'domain'     => $activity->skill->domain_id,
                'skill_id'   => $activity->skill_id,
                'skill_name' => $activity->skill->name,
                'score'      => $updated['new_score'],
            ];
        }

        // Mark diagnostic complete
        $diagnostic->update(['status' => 'completed', 'completed_at' => now()]);

        // Mark student diagnostic_completed
        $student->update(['diagnostic_completed' => true]);

        // Ensure learning path exists
        LearningPath::firstOrCreate(['student_id' => $student->id]);

        return $masteryResults;
    }
}
