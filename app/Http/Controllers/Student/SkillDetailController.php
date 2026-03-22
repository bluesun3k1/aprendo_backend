<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Attempt;
use App\Models\MasteryScore;
use App\Models\Skill;
use App\Models\SkillContent;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SkillDetailController extends Controller
{

    // -----------------------------------------------------------------------
    // GET /api/v1/student/skills/{skillId}/detail
    // -----------------------------------------------------------------------
    public function detail(Request $request, string $skillId): JsonResponse
    {
        $student = $request->user();
        $locale  = app()->getLocale();

        $skill = Skill::with('domain')->find($skillId);
        if (!$skill) {
            return response()->json(['error' => 'skill_not_found'], 404);
        }

        $ms    = MasteryScore::where('student_id', $student->id)->where('skill_id', $skillId)->first();
        $score = $ms?->score ?? 0;
        $masteryLevel = $this->masteryLevel($score);

        // One query for both stats and recent evidence
        $recentAttempts = Attempt::where('student_id', $student->id)
            ->whereHas('activity', fn ($q) => $q->where('skill_id', $skillId))
            ->with('activity')
            ->latest()
            ->limit(10)
            ->get();

        $totalCount   = $recentAttempts->count();
        $correctCount = $recentAttempts->where('correct', true)->count();
        $accuracy     = $totalCount > 0 ? (int) round(($correctCount / $totalCount) * 100) : 0;

        $cms          = SkillContent::where('skill_id', $skillId)->first();
        $doingWell    = $accuracy >= 70 ? ($cms?->doing_well_high ?? '') : ($cms?->doing_well_low ?? '');
        $practiceNext = $accuracy >= 70 ? ($cms?->practice_next_high ?? '') : ($cms?->practice_next_low ?? '');

        $recentEvidence = $recentAttempts->take(3)->map(function ($attempt) use ($locale) {
            $activity = $attempt->activity;
            $title = $locale === 'es'
                ? ($activity->mission_title ?: Str::limit($activity->instructions_es ?? 'Actividad', 50))
                : ($activity->mission_title ?: Str::limit($activity->instructions_en ?? 'Activity', 50));
            return [
                'title'  => $title,
                'result' => $attempt->correct ? 'correct' : 'needs_work',
                'date'   => $this->relativeDate($attempt->created_at, $locale),
            ];
        })->values();

        $lastUpdatedDate = $ms?->last_practiced_at
            ?? ($recentAttempts->isNotEmpty() ? $recentAttempts->first()->created_at : null);
        $lastUpdated = $lastUpdatedDate ? $this->relativeDate($lastUpdatedDate, $locale) : '-';

        $skillLabel  = $locale === 'es' ? $skill->label_es : $skill->label_en;
        $domainLabel = $locale === 'es' ? $skill->domain->label_es : $skill->domain->label_en;
        $statusText  = $this->statusText($masteryLevel, $ms?->trend ?? 'stable', $locale);

        $recommendedCount = \App\Models\Activity::where('skill_id', $skillId)
            ->where('is_active', true)
            ->count();
        $recommendedCount = max(min($recommendedCount, 5), $totalCount > 0 ? 2 : 1);

        return response()->json([
            'skill_id'                         => $skillId,
            'skill_label'                      => $skillLabel,
            'domain_label'                     => $domainLabel,
            'mastery'                          => $score,
            'mastery_level'                    => $masteryLevel,
            'status'                           => $statusText,
            'recent_activities_count'          => $totalCount,
            'correct_count'                    => $correctCount,
            'total_count'                      => $totalCount,
            'average_accuracy'                 => $accuracy,
            'last_updated'                     => $lastUpdated,
            'description'                      => $cms?->description ?? '',
            'why_it_matters'                   => $cms?->why_it_matters ?? '',
            'doing_well'                        => $doingWell,
            'practice_next'                    => $practiceNext,
            'insight_tip'                      => $cms?->insight_tip ?? '',
            'insight_tip_body'                 => $cms?->insight_tip_body ?? '',
            'insight_example'                  => $cms?->insight_example ?? '',
            'recommended_activity_title'       => $locale === 'es'
                ? "Practicar {$skillLabel}"
                : "Practice {$skillLabel}",
            'recommended_activity_description' => $locale === 'es'
                ? "{$recommendedCount} actividades cortas pueden ayudar a mejorar esta habilidad."
                : "{$recommendedCount} short activities can help improve this skill.",
            'recommended_activities_count'     => $recommendedCount,
            'recent_evidence'                  => $recentEvidence,
        ]);
    }

    // -----------------------------------------------------------------------
    // GET /api/v1/student/skills/{skillId}/score-history
    // -----------------------------------------------------------------------
    public function scoreHistory(Request $request, string $skillId): JsonResponse
    {
        $student = $request->user();
        $locale  = app()->getLocale();
        $limit   = min((int) $request->query('limit', 10), 50);

        $skill = Skill::find($skillId);
        if (!$skill) {
            return response()->json(['error' => 'skill_not_found'], 404);
        }

        $ms    = MasteryScore::where('student_id', $student->id)->where('skill_id', $skillId)->first();
        $score = $ms?->score ?? 0;

        $attempts = Attempt::where('student_id', $student->id)
            ->whereHas('activity', fn ($q) => $q->where('skill_id', $skillId))
            ->with(['activity', 'session'])
            ->latest()
            ->limit($limit)
            ->get();

        $totalCount   = $attempts->count();
        $correctCount = $attempts->where('correct', true)->count();

        $lastUpdatedDate = $ms?->last_practiced_at
            ?? ($attempts->isNotEmpty() ? $attempts->first()->created_at : null);
        $lastUpdated = $lastUpdatedDate ? $this->relativeDate($lastUpdatedDate, $locale) : '-';

        $entries = $attempts->map(function ($attempt) use ($locale) {
            $session  = $attempt->session;
            $activity = $attempt->activity;

            $seqNum       = $session?->sequence_number ?? '?';
            $sessionTitle = $locale === 'es' ? "Sesión {$seqNum}" : "Session {$seqNum}";
            if (!empty($session?->domains)) {
                $domains = is_array($session->domains) ? $session->domains : [];
                if (!empty($domains)) {
                    $sessionTitle .= ' · ' . implode(' y ', array_slice($domains, 0, 2));
                }
            }

            $activityTitle = $locale === 'es'
                ? ($activity->mission_title ?: Str::limit($activity->instructions_es ?? 'Actividad', 50))
                : ($activity->mission_title ?: Str::limit($activity->instructions_en ?? 'Activity', 50));

            return [
                'session_id'     => $attempt->session_id,
                'session_title'  => $sessionTitle,
                'activity_title' => $activityTitle,
                'score_change'   => $attempt->score_delta ?? ($attempt->correct ? 5 : -3),
                'date'           => $this->relativeDate($attempt->created_at, $locale),
            ];
        })->values();

        return response()->json([
            'skill_id'                => $skillId,
            'skill_label'             => $locale === 'es' ? $skill->label_es : $skill->label_en,
            'mastery'                 => $score,
            'recent_activities_count' => $totalCount,
            'correct_count'           => $correctCount,
            'total_count'             => $totalCount,
            'last_updated'            => $lastUpdated,
            'entries'                 => $entries,
        ]);
    }

    // -----------------------------------------------------------------------
    // GET /api/v1/student/sessions/{sessionId}/skill-evidence?skill_id=X
    // -----------------------------------------------------------------------
    public function skillEvidence(Request $request, string $sessionId): JsonResponse
    {
        $student = $request->user();
        $locale  = app()->getLocale();
        $skillId = $request->query('skill_id');

        if (!$skillId) {
            return response()->json(['error' => 'skill_id query parameter is required'], 422);
        }

        $skill = Skill::with('domain')->find($skillId);
        if (!$skill) {
            return response()->json(['error' => 'skill_not_found'], 404);
        }

        $attempt = Attempt::where('student_id', $student->id)
            ->where('session_id', $sessionId)
            ->whereHas('activity', fn ($q) => $q->where('skill_id', $skillId))
            ->with(['activity', 'session'])
            ->latest()
            ->first();

        if (!$attempt) {
            return response()->json(['error' => 'evidence_not_found'], 404);
        }

        $session  = $attempt->session;
        $activity = $attempt->activity;

        $skillLabel  = $locale === 'es' ? $skill->label_es : $skill->label_en;
        $domainLabel = $locale === 'es' ? $skill->domain->label_es : $skill->domain->label_en;
        $masteryLevel = $this->masteryLevel(
            MasteryScore::where('student_id', $student->id)->where('skill_id', $skillId)->value('score') ?? 0
        );

        $seqNum       = $session?->sequence_number ?? '?';
        $sessionTitle = $locale === 'es' ? "Sesión {$seqNum}" : "Session {$seqNum}";

        $sessionTypePretty = match ($session?->session_type) {
            'bonus'  => $locale === 'es' ? 'Sesión de repaso' : 'Review Session',
            'review' => $locale === 'es' ? 'Repaso' : 'Review',
            default  => $locale === 'es' ? 'Misión de aprendizaje' : 'Learning Mission',
        };

        $activityTitle = $locale === 'es'
            ? ($activity->mission_title ?: Str::limit($activity->instructions_es ?? 'Actividad', 60))
            : ($activity->mission_title ?: Str::limit($activity->instructions_en ?? 'Activity', 60));

        $scoreDelta  = $attempt->score_delta ?? ($attempt->correct ? 5 : -3);
        $timeSeconds = $attempt->response_time_ms ? intdiv((int) $attempt->response_time_ms, 1000) : 0;

        if ($attempt->correct) {
            $explanation = $locale === 'es'
                ? "Respondiste correctamente esta actividad, lo que ayudó a mejorar tu puntuación en {$skillLabel}."
                : "You answered this activity correctly, which helped improve your score in {$skillLabel}.";
        } else {
            $explanation = $locale === 'es'
                ? "Esta actividad fue un desafío. Seguir practicando {$skillLabel} te ayudará a mejorar."
                : "This activity was challenging. Keep practicing {$skillLabel} to improve.";
        }

        return response()->json([
            'session_id'          => $sessionId,
            'session_title'       => $sessionTitle,
            'session_type'        => $sessionTypePretty,
            'activity_title'      => $activityTitle,
            'is_correct'          => (bool) $attempt->correct,
            'score_impact'        => $scoreDelta,
            'time_seconds'        => $timeSeconds,
            'date'                => $this->relativeDate($attempt->created_at, $locale),
            'explanation'         => $explanation,
            'skill_id'            => $skillId,
            'skill_label'         => $skillLabel,
            'skill_domain_label'  => $domainLabel,
            'skill_mastery_level' => $masteryLevel,
        ]);
    }

    // -----------------------------------------------------------------------
    // Helpers
    // -----------------------------------------------------------------------

    private function masteryLevel(int $score): string
    {
        return match (true) {
            $score >= 70 => 'strong',
            $score >= 40 => 'developing',
            $score > 0   => 'weak',
            default      => 'not_started',
        };
    }

    private function statusText(string $masteryLevel, ?string $trend, string $locale): string
    {
        if ($locale === 'es') {
            return match (true) {
                $masteryLevel === 'strong'     => 'Dominado',
                $trend === 'up'                => 'Creciendo constantemente',
                $masteryLevel === 'developing' => 'En progreso',
                default                        => 'Necesita práctica',
            };
        }

        return match (true) {
            $masteryLevel === 'strong'     => 'Mastered',
            $trend === 'up'                => 'Growing steadily',
            $masteryLevel === 'developing' => 'In progress',
            default                        => 'Needs practice',
        };
    }

    private function relativeDate(mixed $date, string $locale): string
    {
        if (!$date) {
            return '-';
        }

        $d    = $date instanceof Carbon ? $date : Carbon::parse($date);
        $days = abs((int) $d->startOfDay()->diffInDays(now()->startOfDay(), false));

        if ($locale === 'es') {
            return match ($days) {
                0       => 'Hoy',
                1       => 'Ayer',
                default => "Hace {$days} días",
            };
        }

        return match ($days) {
            0       => 'Today',
            1       => 'Yesterday',
            default => "{$days} days ago",
        };
    }
}
