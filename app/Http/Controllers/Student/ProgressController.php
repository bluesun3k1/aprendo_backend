<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ProgressSnapshot;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    // -----------------------------------------------------------------------
    // GET /api/v1/student/progress?domain=reading&days=30
    // -----------------------------------------------------------------------
    public function index(Request $request): JsonResponse
    {
        $student = $request->user();

        $request->validate([
            'domain' => 'nullable|string|in:reading,attention,reasoning',
            'days'   => 'nullable|integer|min:1|max:365',
        ]);

        $domain = $request->query('domain', 'reading');
        $days   = (int) $request->query('days', 30);

        $snapshots = ProgressSnapshot::where('student_id', $student->id)
            ->where('domain_id', $domain)
            ->whereDate('recorded_at', '>=', today()->subDays($days))
            ->orderBy('recorded_at')
            ->get(['recorded_at', 'mastery_score'])
            ->map(fn ($s) => [
                'date'          => $s->recorded_at->toDateString(),
                'mastery_score' => $s->mastery_score,
            ]);

        return response()->json([
            'domain'    => $domain,
            'snapshots' => $snapshots,
        ]);
    }
}
