<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\MasteryScore;
use App\Models\SkillDomain;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SkillMapController extends Controller
{
    // -----------------------------------------------------------------------
    // GET /api/v1/student/skill-map
    // -----------------------------------------------------------------------
    public function index(Request $request): JsonResponse
    {
        $student = $request->user();
        $locale  = app()->getLocale();

        $masteryScores = MasteryScore::where('student_id', $student->id)
            ->with('skill')
            ->get()
            ->keyBy('skill_id');

        $domains = SkillDomain::with('skills')->get()->map(function ($domain) use ($masteryScores, $locale) {
            $skills = $domain->skills->map(function ($skill) use ($masteryScores, $locale) {
                $ms = $masteryScores->get($skill->id);

                return [
                    'id'             => $skill->id,
                    'name'           => $skill->name,
                    'label'          => $locale === 'es' ? $skill->label_es : $skill->label_en,
                    'mastery_score'  => $ms?->score ?? 0,
                    'trend'          => $ms?->trend ?? 'stable',
                    'last_practiced' => $ms?->last_practiced_at?->toDateString(),
                ];
            });

            $domainScores = $domain->skills->map(fn ($s) => $masteryScores->get($s->id)?->score ?? 0);
            $overall = $domainScores->isEmpty() ? 0 : (int) round($domainScores->avg());

            return [
                'id'              => $domain->id,
                'label'           => $locale === 'es' ? $domain->label_es : $domain->label_en,
                'overall_mastery' => $overall,
                'skills'          => $skills,
            ];
        });

        return response()->json(['domains' => $domains]);
    }
}
