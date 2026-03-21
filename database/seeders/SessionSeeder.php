<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\LearningPath;
use App\Models\School;
use App\Models\SessionActivity;
use App\Models\Student;
use App\Models\StudentSession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

/**
 * Creates a rich set of sessions across all types and statuses for front-end testing.
 *
 * Scenario matrix (one student per scenario):
 *
 *  maria.lopez   — "mid-progress"
 *      Core 1:   completed  (yesterday)
 *      Core 2:   completed  (today, earlier)
 *      Core 3:   in_progress (current session — 2 of 5 done)
 *      Core 4:   pending     (locked: next up)
 *      Core 5:   pending     (locked: further ahead)
 *      Bonus 1:  pending     (unlocked extra practice)
 *
 *  carlos.ramirez — "fresh start"
 *      Core 1:   pending  (no activity yet — first session)
 *
 *  sofia.torres — "all done today"
 *      Core 1:   completed  (today)
 *      Core 2:   completed  (today)
 *      Bonus 1:  pending    (auto generated after finishing core)
 *      Review 1: pending    (additional review pack)
 *
 *  Additional student "luis.herrera" — "stacked in_progress" (edge case)
 *      Core 1:   in_progress  (old, 3 days ago)
 *      Core 2:   in_progress  (yesterday)
 *      Core 3:   pending
 *      Bonus 1:  pending
 */
class SessionSeeder extends Seeder
{
    private array $activityPool = [];

    public function run(): void
    {
        $school = School::where('school_code', 'SCH-001')->first();
        if (!$school) {
            $this->command->warn('SessionSeeder: SCH-001 school not found. Run SchoolSeeder first.');
            return;
        }

        $this->activityPool = Activity::where('is_active', true)
            ->where('is_diagnostic', false)
            ->get()
            ->toArray();

        if (count($this->activityPool) < 5) {
            $this->command->warn('SessionSeeder: Not enough activities. Run ActivitySeeder first.');
            return;
        }

        $this->seedLuisHerrera($school);   // create before the others so ID is available
        $this->seedMariaLopez($school);
        $this->seedCarlosRamirez($school);
        $this->seedSofiaTorres($school);
    }

    // -----------------------------------------------------------------------
    // maria.lopez — mid-progress (2 completed, 1 in_progress, 2 pending locked, 1 bonus)
    // -----------------------------------------------------------------------
    private function seedMariaLopez(object $school): void
    {
        $student = Student::where('username', 'maria.lopez')->first();
        if (!$student) return;

        $lp = $this->learningPath($student);

        // Wipe existing test sessions for idempotency
        StudentSession::where('student_id', $student->id)->delete();

        // Core 1 — completed yesterday
        $c1 = $this->makeSession($student, $lp, [
            'session_type'    => 'core',
            'sequence_number' => 1,
            'status'          => 'completed',
            'completed_at'    => Carbon::yesterday()->setTime(14, 30),
            'xp_earned'       => 120,
            'domains'         => ['reading', 'attention'],
        ], 5, 5);

        // Core 2 — completed earlier today
        $c2 = $this->makeSession($student, $lp, [
            'session_type'    => 'core',
            'sequence_number' => 2,
            'status'          => 'completed',
            'completed_at'    => Carbon::today()->setTime(9, 15),
            'xp_earned'       => 95,
            'domains'         => ['reasoning', 'attention'],
        ], 5, 5);

        // Core 3 — in_progress (2 of 5 activities done — resume scenario)
        $c3 = $this->makeSession($student, $lp, [
            'session_type'    => 'core',
            'sequence_number' => 3,
            'status'          => 'in_progress',
            'domains'         => ['reading', 'reasoning'],
        ], 5, 2);

        // Core 4 — pending (locked until core 3 completes)
        $this->makeSession($student, $lp, [
            'session_type'    => 'core',
            'sequence_number' => 4,
            'status'          => 'pending',
            'domains'         => ['attention'],
        ], 5, 0);

        // Core 5 — pending (further ahead)
        $this->makeSession($student, $lp, [
            'session_type'    => 'core',
            'sequence_number' => 5,
            'status'          => 'pending',
            'domains'         => ['reading', 'attention', 'reasoning'],
        ], 5, 0);

        // Bonus 1 — unlocked extra practice
        $this->makeSession($student, $lp, [
            'session_type'    => 'bonus',
            'sequence_number' => null,
            'status'          => 'pending',
            'domains'         => ['reading'],
        ], 3, 0);
    }

    // -----------------------------------------------------------------------
    // carlos.ramirez — fresh start (only core 1 pending, nothing done)
    // -----------------------------------------------------------------------
    private function seedCarlosRamirez(object $school): void
    {
        $student = Student::where('username', 'carlos.ramirez')->first();
        if (!$student) return;

        $lp = $this->learningPath($student);

        StudentSession::where('student_id', $student->id)->delete();

        $this->makeSession($student, $lp, [
            'session_type'    => 'core',
            'sequence_number' => 1,
            'status'          => 'pending',
            'domains'         => ['reading', 'attention'],
        ], 5, 0);
    }

    // -----------------------------------------------------------------------
    // sofia.torres — all done (2 completed today, bonus + review pending)
    // -----------------------------------------------------------------------
    private function seedSofiaTorres(object $school): void
    {
        $student = Student::where('username', 'sofia.torres')->first();
        if (!$student) return;

        $lp = $this->learningPath($student);

        StudentSession::where('student_id', $student->id)->delete();

        $this->makeSession($student, $lp, [
            'session_type'    => 'core',
            'sequence_number' => 1,
            'status'          => 'completed',
            'completed_at'    => Carbon::today()->setTime(8, 0),
            'xp_earned'       => 110,
            'domains'         => ['reading'],
        ], 5, 5);

        $this->makeSession($student, $lp, [
            'session_type'    => 'core',
            'sequence_number' => 2,
            'status'          => 'completed',
            'completed_at'    => Carbon::today()->setTime(8, 30),
            'xp_earned'       => 130,
            'domains'         => ['attention', 'reasoning'],
        ], 5, 5);

        // Bonus — auto-generated after completing core
        $this->makeSession($student, $lp, [
            'session_type'    => 'bonus',
            'sequence_number' => null,
            'status'          => 'pending',
            'domains'         => ['reading'],
        ], 3, 0);

        // Review pack
        $this->makeSession($student, $lp, [
            'session_type'    => 'review',
            'sequence_number' => null,
            'status'          => 'pending',
            'domains'         => ['reasoning'],
        ], 3, 0);
    }

    // -----------------------------------------------------------------------
    // luis.herrera — stacked in_progress edge case (created fresh if missing)
    // -----------------------------------------------------------------------
    private function seedLuisHerrera(object $school): void
    {
        $student = Student::firstOrCreate(
            ['school_id' => $school->id, 'username' => 'luis.herrera'],
            [
                'school_id'            => $school->id,
                'display_name'         => 'Luis Herrera',
                'username'             => 'luis.herrera',
                'pin'                  => bcrypt('9999'),
                'grade'                => '5',
                'age'                  => 10,
                'age_band'             => 'middle',
                'is_active'            => true,
                'diagnostic_completed' => true,
                'points_total'         => 200,
                'current_level'        => 2,
                'current_xp'           => 200,
            ]
        );

        $lp = $this->learningPath($student);

        StudentSession::where('student_id', $student->id)->delete();

        // Two stacked in_progress sessions (missed days scenario)
        $this->makeSession($student, $lp, [
            'session_type'    => 'core',
            'sequence_number' => 1,
            'status'          => 'in_progress',
            'domains'         => ['reading'],
            'created_at'      => Carbon::now()->subDays(3),
        ], 5, 1);

        $this->makeSession($student, $lp, [
            'session_type'    => 'core',
            'sequence_number' => 2,
            'status'          => 'in_progress',
            'domains'         => ['attention'],
            'created_at'      => Carbon::now()->subDays(1),
        ], 5, 2);

        // Core 3 — pending (locked behind the two above)
        $this->makeSession($student, $lp, [
            'session_type'    => 'core',
            'sequence_number' => 3,
            'status'          => 'pending',
            'domains'         => ['reasoning', 'reading'],
        ], 5, 0);

        // Bonus — always available
        $this->makeSession($student, $lp, [
            'session_type'    => 'bonus',
            'sequence_number' => null,
            'status'          => 'pending',
            'domains'         => ['attention'],
        ], 3, 0);
    }

    // -----------------------------------------------------------------------
    // Helpers
    // -----------------------------------------------------------------------

    private function learningPath(Student $student): object
    {
        return LearningPath::firstOrCreate(['student_id' => $student->id]);
    }

    /**
     * Create a StudentSession with $totalActivities attached,
     * and stub $completedCount "attempt" activity IDs in the session's attempts
     * so that activities_completed is computed correctly by the queue endpoint.
     */
    private function makeSession(
        Student $student,
        object  $lp,
        array   $attrs,
        int     $totalActivities,
        int     $completedCount
    ): StudentSession {
        $activities = collect($this->activityPool)
            ->shuffle()
            ->take($totalActivities);

        $estimatedMinutes = max(5, $totalActivities * 2);

        $sessionData = array_merge([
            'student_id'                 => $student->id,
            'learning_path_id'           => $lp->id,
            'estimated_duration_minutes' => $estimatedMinutes,
        ], $attrs);

        // Strip non-column keys before insert
        $createdAt = $sessionData['created_at'] ?? null;
        unset($sessionData['created_at']);

        $session = StudentSession::create($sessionData);

        if ($createdAt) {
            $session->created_at = $createdAt;
            $session->save();
        }

        // Attach activities via session_activities pivot
        foreach ($activities->values() as $index => $actArr) {
            SessionActivity::create([
                'session_id'  => $session->id,
                'activity_id' => $actArr['id'],
                'order_index' => $index,
            ]);
        }

        // Stub attempts for completed activities so activities_completed count works
        if ($completedCount > 0) {
            $doneActivities = $activities->take($completedCount);
            foreach ($doneActivities as $actArr) {
                \App\Models\Attempt::create([
                    'student_id'       => $student->id,
                    'session_id'       => $session->id,
                    'activity_id'      => $actArr['id'],
                    'response'         => ['chosen_option_id' => 'opt_a'],
                    'correct'          => true,
                    'score_delta'      => 10,
                    'feedback_text'    => null,
                    'response_time_ms' => 3000,
                    'hints_used'       => 0,
                    'completed'        => true,
                ]);
            }
        }

        return $session;
    }
}
