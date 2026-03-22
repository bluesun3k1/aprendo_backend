<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\DomainMilestone;
use App\Models\MasteryScore;
use App\Models\ProgressSnapshot;
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

        // Pre-load progress snapshots for recent_scores (avoids N+1)
        $snapshots = ProgressSnapshot::where('student_id', $student->id)
            ->orderBy('recorded_at', 'desc')
            ->get()
            ->groupBy('skill_id');

        // Pre-load milestones from DB, grouped by domain_id
        $milestones = DomainMilestone::orderBy('sort_order')->orderBy('threshold')->get()->groupBy('domain_id');

        // Build domain list with overall mastery scores
        $domains = SkillDomain::with('skills')->get()->map(function ($domain) use ($masteryScores, $snapshots, $locale) {
            $skills = $domain->skills->map(function ($skill) use ($masteryScores, $snapshots, $locale) {
                $ms    = $masteryScores->get($skill->id);
                $score = $ms?->score ?? 0;

                $masteryLevel = match (true) {
                    $score >= 70 => 'strong',
                    $score >= 40 => 'developing',
                    $score > 0   => 'weak',
                    default      => 'not_started',
                };

                // Last 5 snapshot scores in chronological order (oldest → newest)
                $recentScores = ($snapshots[$skill->id] ?? collect())
                    ->take(5)
                    ->pluck('mastery_score')
                    ->reverse()
                    ->values()
                    ->toArray();

                $skillLabel = $locale === 'es' ? $skill->label_es : $skill->label_en;

                return [
                    'id'                => $skill->id,
                    'name'              => $skillLabel,
                    'mastery_score'     => $score,
                    'mastery_level'     => $masteryLevel,
                    'status'            => $masteryLevel, // kept for backward compat
                    'recent_scores'     => $recentScores,
                    'short_description' => $this->skillShortDescription($skillLabel, $masteryLevel, $locale),
                    'last_practiced_at' => $ms?->last_practiced_at
                        ? \Carbon\Carbon::parse($ms->last_practiced_at)->toIso8601String()
                        : null,
                ];
            });

            $domainScores = $domain->skills->map(fn ($s) => $masteryScores->get($s->id)?->score ?? 0);
            $overall      = $domainScores->isEmpty() ? 0 : (int) round($domainScores->avg());

            return [
                '_id'             => $domain->id,   // temp key for focus computation
                'id'              => $domain->id,
                'label'           => $locale === 'es' ? $domain->label_es : $domain->label_en,
                'overall_mastery' => $overall,
                'skills'          => $skills,
            ];
        });

        // current_focus_domain: weakest domain the student has started; fall back to first
        $started        = $domains->filter(fn ($d) => $d['overall_mastery'] > 0);
        $focusDomain    = $started->sortBy('overall_mastery')->first() ?? $domains->first();
        $focusDomainId  = $focusDomain['id'] ?? null;

        // Add is_current_focus + description to each domain; strip temp key
        $domainsOut = $domains->map(function ($domain) use ($focusDomainId, $locale) {
            $isFocus     = $domain['id'] === $focusDomainId;
            $description = $this->domainDescription($domain['id'], $domain['overall_mastery'], $isFocus, $locale);
            unset($domain['_id']);

            return array_merge($domain, [
                'is_current_focus' => $isFocus,
                'description'      => $description,
            ]);
        })->values();

        // next_unlock: find the domain/threshold the student is closest to completing
        $nextUnlock = $this->computeNextUnlock($domains, $milestones);

        return response()->json([
            'student_level'          => $student->current_level ?? 1,
            'current_focus_domain_id'=> $focusDomainId,
            'next_unlock'            => $nextUnlock,
            'domains'                => $domainsOut,
        ]);
    }

    // -----------------------------------------------------------------------
    // Compute next_unlock from DB milestones
    // -----------------------------------------------------------------------
    private function computeNextUnlock(iterable $domains, \Illuminate\Support\Collection $milestones): ?array
    {
        $best         = null;
        $bestProgress = -1.0;

        foreach ($domains as $domain) {
            $domainId        = $domain['id'];
            $mastery         = $domain['overall_mastery'];
            $domainMilestones = $milestones[$domainId] ?? collect();

            foreach ($domainMilestones as $milestone) {
                if ($mastery >= $milestone->threshold) {
                    continue; // already unlocked
                }

                $progress = $milestone->threshold > 0
                    ? round($mastery / $milestone->threshold, 2)
                    : 0.0;

                if ($progress > $bestProgress) {
                    $bestProgress = $progress;
                    $best = [
                        'name'        => $milestone->name,
                        'progress'    => $progress,
                        'description' => $milestone->description,
                    ];
                }
                break; // only the next unearned milestone per domain
            }
        }

        return $best;
    }

    // -----------------------------------------------------------------------
    // Generate a short domain description based on mastery state
    // -----------------------------------------------------------------------
    private function domainDescription(string $domainId, int $mastery, bool $isFocus, string $locale): string
    {
        $templates = [
            'reading' => [
                'es' => [
                    0  => 'Aún no has practicado comprensión lectora.',
                    1  => 'Estás dando tus primeros pasos en lectura.',
                    40 => 'Estás mejorando en encontrar ideas principales.',
                    70 => '¡Dominas bien la comprensión lectora!',
                ],
                'en' => [
                    0  => 'You haven\'t practiced reading comprehension yet.',
                    1  => 'You are taking your first steps in reading.',
                    40 => 'You are improving at finding main ideas.',
                    70 => 'You have strong reading comprehension!',
                ],
            ],
            'attention' => [
                'es' => [
                    0  => 'Entrena tu atención y enfoque aquí.',
                    1  => 'Tu atención está comenzando a mejorar.',
                    40 => 'Tu capacidad de concentración está creciendo.',
                    70 => '¡Tienes un gran nivel de atención y enfoque!',
                ],
                'en' => [
                    0  => 'Train your attention and focus here.',
                    1  => 'Your attention is starting to improve.',
                    40 => 'Your concentration skills are growing.',
                    70 => 'You have a great level of attention and focus!',
                ],
            ],
            'reasoning' => [
                'es' => [
                    0  => 'Aún no has practicado razonamiento.',
                    1  => 'Empiezas a desarrollar tu pensamiento crítico.',
                    40 => 'Tu razonamiento lógico está avanzando.',
                    70 => '¡Excelente nivel de razonamiento y lógica!',
                ],
                'en' => [
                    0  => 'You haven\'t practiced reasoning yet.',
                    1  => 'You are starting to develop critical thinking.',
                    40 => 'Your logical reasoning is advancing.',
                    70 => 'Excellent level of reasoning and logic!',
                ],
            ],
        ];

        $lang   = $locale === 'es' ? 'es' : 'en';
        $levels = $templates[$domainId][$lang] ?? [];

        $text = $levels[0] ?? '';
        foreach ($levels as $threshold => $msg) {
            if ($mastery >= $threshold) {
                $text = $msg;
            }
        }

        return $text;
    }

    // -----------------------------------------------------------------------
    // Generate a short per-skill description for the skill list screen
    // -----------------------------------------------------------------------
    private function skillShortDescription(string $skillLabel, string $masteryLevel, string $locale): string
    {
        if ($locale === 'es') {
            return match ($masteryLevel) {
                'strong'      => "¡Dominas muy bien {$skillLabel}!",
                'developing'  => "Tu habilidad de {$skillLabel} está creciendo.",
                'weak'        => "Sigue practicando {$skillLabel} para avanzar.",
                default       => "Explora {$skillLabel} para comenzar tu progreso.",
            };
        }

        return match ($masteryLevel) {
            'strong'      => "You have mastered {$skillLabel}!",
            'developing'  => "Your {$skillLabel} skill is growing.",
            'weak'        => "Keep practicing {$skillLabel} to move forward.",
            default       => "Explore {$skillLabel} to begin your progress.",
        };
    }
}

