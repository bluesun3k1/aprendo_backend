<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Diagnostic;
use App\Services\DiagnosticService;
use App\Services\MasteryScoreService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DiagnosticController extends Controller
{
    public function __construct(
        private readonly DiagnosticService $diagnosticService,
        private readonly MasteryScoreService $masteryService,
    ) {}

    // -----------------------------------------------------------------------
    // GET /api/v1/student/diagnostic
    // -----------------------------------------------------------------------
    public function show(Request $request): JsonResponse
    {
        $student    = $request->user();
        $diagnostic = $this->diagnosticService->getOrCreateDiagnostic($student);
        $locale     = app()->getLocale();

        $activities = $diagnostic->activities()->with('skill')->get()->map(function ($activity) use ($locale) {
            return $this->formatActivity($activity, $locale);
        });

        return response()->json([
            'diagnostic_id' => $diagnostic->id,
            'activities'    => $activities,
        ]);
    }

    // -----------------------------------------------------------------------
    // POST /api/v1/student/diagnostic/{diagnostic_id}/submit
    // -----------------------------------------------------------------------
    public function submit(Request $request, string $diagnosticId): JsonResponse
    {
        $student = $request->user();

        $request->validate([
            'attempts'                       => 'required|array|min:1',
            'attempts.*.activity_id'         => 'required|uuid',
            'attempts.*.type'                => 'required|string',
            'attempts.*.response'            => 'required|array',
            'attempts.*.response_time_ms'    => 'nullable|integer',
            'attempts.*.hints_used'          => 'nullable|integer',
            'attempts.*.completed'           => 'nullable|boolean',
            'attempts.*.is_correct'          => 'nullable|boolean',
        ]);

        $diagnostic = Diagnostic::where('id', $diagnosticId)
            ->where('student_id', $student->id)
            ->where('status', 'pending')
            ->firstOrFail();

        $this->diagnosticService->processSubmission(
            $student,
            $diagnostic,
            $request->attempts,
            $this->masteryService
        );

        return response()->json(['success' => true]);
    }

    private function formatActivity(\App\Models\Activity $activity, string $locale): array
    {
        return [
            'id'               => $activity->id,
            'type'             => $activity->type,
            'domain'           => $activity->skill->domain_id,
            'skill_id'         => $activity->skill_id,
            'skill_name'       => $activity->skill->name,
            'difficulty'       => $activity->difficulty,
            'instructions'     => $locale === 'es' ? $activity->instructions_es : $activity->instructions_en,
            'duration_seconds' => $activity->duration_seconds,
            'content'          => $activity->content,
        ];
    }
}
