<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\MasteryScore;
use App\Models\SkillDomain;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SkillMapController extends Controller
{
    // Milestone definitions: [threshold (0-100), achievement name (es), achievement name (en), description (es), description (en)]
    private const MILESTONES = [
        'reading' => [
            [40, 'Explorador de lectura',  'Reading Pathfinder',  'Sigue practicando comprensión para alcanzar este logro.',         'Keep practicing comprehension to reach this achievement.'],
            [60, 'Navegante lector',        'Reading Navigator',   'Estás dominando la lectura. ¡Un poco más!',                       'You are mastering reading. Just a bit more!'],
            [80, 'Maestro lector',          'Reading Master',      'Casi eres un maestro de la comprensión lectora.',                 'You are almost a reading comprehension master.'],
        ],
        'attention' => [
            [40, 'Explorador de enfoque',  'Focus Explorer',      'Sigue entrenando tu atención para desbloquear esto.',             'Keep training your attention to unlock this.'],
            [60, 'Guardián de atención',   'Attention Keeper',    '¡Tu enfoque está mejorando mucho!',                              'Your focus is improving a lot!'],
            [80, 'Maestro de atención',    'Attention Master',    'Estás a punto de dominar la atención y el enfoque.',             'You are about to master attention and focus.'],
        ],
        'reasoning' => [
            [40, 'Explorador lógico',       'Logic Explorer',      'Sigue resolviendo problemas para alcanzar este logro.',           'Keep solving problems to reach this achievement.'],
            [60, 'Navegante lógico',        'Logic Pathfinder',    '¡Tu razonamiento está creciendo! Sigue así.',                    'Your reasoning is growing! Keep it up.'],
            [80, 'Maestro del razonamiento','Reasoning Master',    'Estás muy cerca de dominar el pensamiento crítico.',             'You are very close to mastering critical thinking.'],
        ],
    ];

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

        // Build domain list with overall mastery scores
        $domains = SkillDomain::with('skills')->get()->map(function ($domain) use ($masteryScores, $locale) {
            $skills = $domain->skills->map(function ($skill) use ($masteryScores, $locale) {
                $ms    = $masteryScores->get($skill->id);
                $score = $ms?->score ?? 0;

                $status = match (true) {
                    $score >= 70 => 'strong',
                    $score >= 40 => 'developing',
                    $score > 0   => 'weak',
                    default      => 'not_started',
                };

                return [
                    'id'                => $skill->id,
                    'name'              => $locale === 'es' ? $skill->label_es : $skill->label_en,
                    'mastery_score'     => $score,
                    'status'            => $status,
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
        $nextUnlock = $this->computeNextUnlock($domains, $locale);

        return response()->json([
            'student_level'          => $student->current_level ?? 1,
            'current_focus_domain_id'=> $focusDomainId,
            'next_unlock'            => $nextUnlock,
            'domains'                => $domainsOut,
        ]);
    }

    // -----------------------------------------------------------------------
    // Compute next_unlock
    // -----------------------------------------------------------------------
    private function computeNextUnlock(iterable $domains, string $locale): ?array
    {
        $best          = null;
        $bestProgress  = -1.0;

        foreach ($domains as $domain) {
            $domainId = $domain['id'];
            $mastery  = $domain['overall_mastery'];
            $milestones = self::MILESTONES[$domainId] ?? [];

            foreach ($milestones as [$threshold, $nameEs, $nameEn, $descEs, $descEn]) {
                if ($mastery >= $threshold) {
                    continue; // already unlocked
                }

                $progress = $threshold > 0 ? round($mastery / $threshold, 2) : 0.0;

                if ($progress > $bestProgress) {
                    $bestProgress = $progress;
                    $best = [
                        'name'        => $locale === 'es' ? $nameEs : $nameEn,
                        'progress'    => $progress,
                        'description' => $locale === 'es' ? $descEs : $descEn,
                    ];
                }
                break; // only consider the next unearned milestone per domain
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
}

