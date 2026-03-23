<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Services\CurriculumTrackService;
use App\Services\SessionQueueService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    public function __construct(
        private readonly CurriculumTrackService $trackService,
        private readonly SessionQueueService    $queueService,
    ) {}

    // -----------------------------------------------------------------------
    // GET /api/v1/student/curriculum-track
    // -----------------------------------------------------------------------
    public function track(Request $request): JsonResponse
    {
        $student = $request->user();
        $locale  = str_contains($request->header('Accept-Language', 'es'), 'en') ? 'en' : 'es';

        $studentTrack = $this->trackService->getActiveTrack($student);

        if (!$studentTrack) {
            return response()->json(['curriculum_track' => null]);
        }

        $track        = $studentTrack->track;
        $allProgress  = $this->trackService->getAllUnitProgress($student);

        $units = $allProgress->map(function ($progress) use ($locale) {
            $unit = $progress->unit;

            return [
                'unit_id'           => $unit->id,
                'code'              => $unit->code,
                'title'             => $locale === 'en' ? $unit->title_en : $unit->title_es,
                'description'       => $locale === 'en' ? $unit->description_en : $unit->description_es,
                'sort_order'        => $unit->sort_order,
                'estimated_sessions'=> $unit->estimated_sessions,
                'mastery_threshold' => $unit->mastery_threshold,
                'status'            => $progress->status,
                'started_at'        => $progress->started_at?->toIso8601String(),
                'completed_at'      => $progress->completed_at?->toIso8601String(),
            ];
        });

        return response()->json([
            'curriculum_track' => [
                'track_id'   => $track->id,
                'code'       => $track->code,
                'label'      => $locale === 'en' ? $track->label_en : $track->label_es,
                'version'    => $track->version,
                'band'       => $student->placement_band,
                'status'     => $studentTrack->status,
                'started_at' => $studentTrack->started_at?->toIso8601String(),
                'units'      => $units,
            ],
        ]);
    }

    // -----------------------------------------------------------------------
    // GET /api/v1/student/current-unit
    // -----------------------------------------------------------------------
    public function currentUnit(Request $request): JsonResponse
    {
        $student = $request->user();
        $locale  = str_contains($request->header('Accept-Language', 'es'), 'en') ? 'en' : 'es';

        $activeProgress = $this->trackService->getActiveUnitProgress($student);

        if (!$activeProgress) {
            return response()->json(['current_unit' => null]);
        }

        $unit   = $activeProgress->unit;
        $skills = $unit->unitSkills()->with('skill')->get()->map(function ($us) use ($locale, $student) {
            $mastery = \App\Models\MasteryScore::where('student_id', $student->id)
                ->where('skill_id', $us->skill_id)
                ->first();

            return [
                'skill_id'            => $us->skill_id,
                'skill_name'          => $us->skill->name,
                'skill_label'         => $locale === 'en' ? $us->skill->label_en : $us->skill->label_es,
                'priority_weight'     => $us->priority_weight,
                'target_mastery_min'  => $us->target_mastery_min,
                'target_mastery_goal' => $us->target_mastery_goal,
                'current_mastery'     => $mastery?->score ?? 0,
                'trend'               => $mastery?->trend ?? 'stable',
            ];
        });

        $totalSessions     = $unit->sessions()->count();
        $completedSessions = \App\Models\StudentSessionQueue::where('student_id', $student->id)
            ->where('status', 'completed')
            ->whereHas('curriculumSession', fn ($q) => $q->where('curriculum_unit_id', $unit->id))
            ->count();

        return response()->json([
            'current_unit' => [
                'unit_id'            => $unit->id,
                'code'               => $unit->code,
                'title'              => $locale === 'en' ? $unit->title_en : $unit->title_es,
                'description'        => $locale === 'en' ? $unit->description_en : $unit->description_es,
                'sort_order'         => $unit->sort_order,
                'mastery_threshold'  => $unit->mastery_threshold,
                'sessions_total'     => $totalSessions,
                'sessions_completed' => $completedSessions,
                'started_at'         => $activeProgress->started_at?->toIso8601String(),
                'skills'             => $skills,
            ],
        ]);
    }

    // -----------------------------------------------------------------------
    // GET /api/v1/student/session-queue
    // -----------------------------------------------------------------------
    public function sessionQueue(Request $request): JsonResponse
    {
        $student = $request->user();
        $locale  = str_contains($request->header('Accept-Language', 'es'), 'en') ? 'en' : 'es';

        $items = $this->queueService->getQueueForStudent($student)->map(function ($item) use ($locale) {
            $blueprint = $item->curriculumSession;

            return [
                'queue_item_id'  => $item->id,
                'queue_order'    => $item->queue_order,
                'session_kind'   => $item->session_kind,
                'status'         => $item->status,
                'available_at'   => $item->available_at?->toIso8601String(),
                'session_id'     => $item->generated_session_id,
                'blueprint'      => $blueprint ? [
                    'curriculum_session_id' => $blueprint->id,
                    'title'                 => $locale === 'en' ? $blueprint->title_en : $blueprint->title_es,
                    'session_type'          => $blueprint->session_type,
                    'estimated_minutes'     => $blueprint->estimated_minutes,
                    'unit_title'            => $blueprint->unit
                        ? ($locale === 'en' ? $blueprint->unit->title_en : $blueprint->unit->title_es)
                        : null,
                ] : null,
            ];
        });

        return response()->json(['queue' => $items]);
    }
}
