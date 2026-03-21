<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Attempt;
use App\Models\ProgressSnapshot;
use App\Models\StudentSession;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgressController extends Controller
{
    // -----------------------------------------------------------------------
    // GET /api/v1/student/progress
    // -----------------------------------------------------------------------
    public function index(Request $request): JsonResponse
    {
        $student = $request->user();
        $weeks   = 8; // Return last 8 ISO weeks

        // ── Weekly aggregation ─────────────────────────────────────────────
        $weekStart = Carbon::now()->startOfWeek()->subWeeks($weeks - 1);

        $weekly = [];
        for ($i = 0; $i < $weeks; $i++) {
            $from = $weekStart->copy()->addWeeks($i);
            $to   = $from->copy()->endOfWeek();

            $sessions = StudentSession::where('student_id', $student->id)
                ->where('status', 'completed')
                ->whereBetween('completed_at', [$from, $to])
                ->get(['id', 'xp_earned']);

            $sessionsCompleted = $sessions->count();
            $xpEarned          = (int) $sessions->sum('xp_earned');

            // Accuracy: correct / total attempts for those sessions
            $sessionIds = $sessions->pluck('id');
            $accuracy   = 0;

            if ($sessionIds->isNotEmpty()) {
                $totals = Attempt::whereIn('session_id', $sessionIds)
                    ->selectRaw('COUNT(*) as total, SUM(correct) as correct_count')
                    ->first();

                $accuracy = $totals->total > 0
                    ? (int) round(($totals->correct_count / $totals->total) * 100)
                    : 0;
            }

            $weekly[] = [
                'date'                => $from->toDateString(),
                'sessions_completed'  => $sessionsCompleted,
                'accuracy'            => $accuracy,
                'xp_earned'           => $xpEarned,
            ];
        }

        // ── Domain trends (from progress_snapshots) ─────────────────────────
        $since = Carbon::now()->subWeeks($weeks)->toDateString();

        $snapshots = ProgressSnapshot::where('student_id', $student->id)
            ->whereDate('recorded_at', '>=', $since)
            ->orderBy('recorded_at')
            ->get(['domain_id', 'recorded_at', 'mastery_score']);

        $domainTrends = $snapshots
            ->groupBy('domain_id')
            ->map(fn ($rows, $domain) => [
                'domain' => $domain,
                'scores' => $rows->map(fn ($s) => [
                    'date'          => Carbon::parse($s->recorded_at)->toDateString(),
                    'mastery_score' => $s->mastery_score,
                ])->values(),
            ])
            ->values();

        return response()->json([
            'weekly'        => $weekly,
            'domain_trends' => $domainTrends,
        ]);
    }
}
