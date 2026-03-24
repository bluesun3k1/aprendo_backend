<?php

namespace Database\Seeders;

use App\Models\CurriculumSession;
use App\Models\CurriculumSessionItem;
use App\Models\CurriculumTrack;
use App\Models\CurriculumUnit;
use App\Models\CurriculumUnitSkill;
use App\Models\GradeBand;
use App\Models\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CurriculumTrackSeeder extends Seeder
{
    // -----------------------------------------------------------------------
    // Grade bands
    // -----------------------------------------------------------------------
    private array $bands = [
        ['code' => 'early',  'label_es' => 'Inicial (1.°–2.°)',   'label_en' => 'Early (Grades 1–2)',   'min_grade' => 1, 'max_grade' => 2, 'sort_order' => 1],
        ['code' => 'middle', 'label_es' => 'Medio (3.°–5.°)',     'label_en' => 'Middle (Grades 3–5)',  'min_grade' => 3, 'max_grade' => 5, 'sort_order' => 2],
        ['code' => 'upper',  'label_es' => 'Avanzado (6.°–9.°)',  'label_en' => 'Upper (Grades 6–9)',   'min_grade' => 6, 'max_grade' => 9, 'sort_order' => 3],
    ];

    // -----------------------------------------------------------------------
    // Curriculum definition — 3 bands × 3 units × 4 sessions × 3 items
    // -----------------------------------------------------------------------
    private array $curriculum = [

        // ===================================================================
        'early' => [
            'code'     => 'early_v1',
            'label_es' => 'Currículo Inicial v1',
            'label_en' => 'Early Curriculum v1',
            'units' => [
                [
                    'code'               => 'early_attention_foundations',
                    'title_es'           => 'Atención y Percepción',
                    'title_en'           => 'Attention & Perception',
                    'description_es'     => 'Ejercicios de atención visual y selectiva para grados 1.° y 2.°.',
                    'description_en'     => 'Visual and selective attention exercises for grades 1 and 2.',
                    'sort_order'         => 1,
                    'mastery_threshold'  => 60,
                    'skills'             => ['selective_attention', 'sustained_attention', 'visual_discrimination'],
                ],
                [
                    'code'               => 'early_reading_basics',
                    'title_es'           => 'Lectura Inicial',
                    'title_en'           => 'Early Reading',
                    'description_es'     => 'Comprensión de textos cortos y secuencias simples.',
                    'description_en'     => 'Comprehension of short texts and simple sequences.',
                    'sort_order'         => 2,
                    'mastery_threshold'  => 60,
                    'skills'             => ['main_idea', 'supporting_details', 'sequencing'],
                ],
                [
                    'code'               => 'early_reasoning_intro',
                    'title_es'           => 'Pensamiento Básico',
                    'title_en'           => 'Basic Thinking',
                    'description_es'     => 'Clasificación y patrones para estudiantes de grados iniciales.',
                    'description_en'     => 'Classification and patterns for early-grade students.',
                    'sort_order'         => 3,
                    'mastery_threshold'  => 60,
                    'skills'             => ['classification', 'patterns', 'cause_effect'],
                ],
            ],
        ],

        // ===================================================================
        'middle' => [
            'code'     => 'middle_v1',
            'label_es' => 'Currículo Medio v1',
            'label_en' => 'Middle Curriculum v1',
            'units' => [
                [
                    'code'               => 'middle_reading_foundations',
                    'title_es'           => 'Fundamentos de Lectura',
                    'title_en'           => 'Reading Foundations',
                    'description_es'     => 'Identificación de idea principal, detalles y secuencia.',
                    'description_en'     => 'Identifying main idea, supporting details, and sequencing.',
                    'sort_order'         => 1,
                    'mastery_threshold'  => 65,
                    'skills'             => ['main_idea', 'supporting_details', 'sequencing'],
                ],
                [
                    'code'               => 'middle_reading_interpretation',
                    'title_es'           => 'Interpretación Lectora',
                    'title_en'           => 'Reading Interpretation',
                    'description_es'     => 'Inferencia, pistas de contexto y resumen de textos.',
                    'description_en'     => 'Inference, context clues, and text summarization.',
                    'sort_order'         => 2,
                    'mastery_threshold'  => 65,
                    'skills'             => ['inference', 'context_clues', 'summarization'],
                ],
                [
                    'code'               => 'middle_critical_thinking_basics',
                    'title_es'           => 'Pensamiento Crítico Básico',
                    'title_en'           => 'Basic Critical Thinking',
                    'description_es'     => 'Clasificación, patrones y relaciones de causa y efecto.',
                    'description_en'     => 'Classification, patterns, and cause-effect relationships.',
                    'sort_order'         => 3,
                    'mastery_threshold'  => 65,
                    'skills'             => ['classification', 'patterns', 'cause_effect'],
                ],
            ],
        ],

        // ===================================================================
        'upper' => [
            'code'     => 'upper_v1',
            'label_es' => 'Currículo Avanzado v1',
            'label_en' => 'Upper Curriculum v1',
            'units' => [
                [
                    'code'               => 'upper_advanced_reading',
                    'title_es'           => 'Lectura Avanzada',
                    'title_en'           => 'Advanced Reading',
                    'description_es'     => 'Inferencia profunda, comparación y evaluación de evidencia.',
                    'description_en'     => 'Deep inference, comparison, and evidence evaluation.',
                    'sort_order'         => 1,
                    'mastery_threshold'  => 70,
                    'skills'             => ['inference', 'compare_contrast', 'evaluating_evidence'],
                ],
                [
                    'code'               => 'upper_language_purpose',
                    'title_es'           => 'Lenguaje y Propósito',
                    'title_en'           => 'Language & Purpose',
                    'description_es'     => 'Propósito del autor, hecho vs. opinión y pistas de contexto avanzadas.',
                    'description_en'     => 'Author\'s purpose, fact vs. opinion, and advanced context clues.',
                    'sort_order'         => 2,
                    'mastery_threshold'  => 70,
                    'skills'             => ['identifying_purpose', 'fact_vs_opinion', 'context_clues'],
                ],
                [
                    'code'               => 'upper_deep_reasoning',
                    'title_es'           => 'Razonamiento Profundo',
                    'title_en'           => 'Deep Reasoning',
                    'description_es'     => 'Lógica deductiva, análisis de argumentos y resolución de problemas.',
                    'description_en'     => 'Deductive logic, argument analysis, and problem solving.',
                    'sort_order'         => 3,
                    'mastery_threshold'  => 70,
                    'skills'             => ['deductive_logic', 'argument_analysis', 'problem_solving'],
                ],
            ],
        ],
    ];

    // -----------------------------------------------------------------------
    // Session blueprint template applied to every unit
    // 4 sessions per unit: 3 core (intro → practice → challenge) + 1 review
    // 3 items per session (one per skill in the unit), item_count = 2
    // -----------------------------------------------------------------------
    private array $sessionBlueprints = [
        [
            'suffix_es'        => '· Introducción',
            'suffix_en'        => '· Introduction',
            'session_type'     => 'core',
            'sort_order'       => 1,
            'estimated_minutes'=> 12,
            'item_template'    => ['difficulty_min' => 1, 'difficulty_max' => 1, 'item_count' => 2, 'selection_rule' => 'fixed'],
        ],
        [
            'suffix_es'        => '· Práctica',
            'suffix_en'        => '· Practice',
            'session_type'     => 'core',
            'sort_order'       => 2,
            'estimated_minutes'=> 15,
            'item_template'    => ['difficulty_min' => 1, 'difficulty_max' => 2, 'item_count' => 2, 'selection_rule' => 'adaptive'],
        ],
        [
            'suffix_es'        => '· Desafío',
            'suffix_en'        => '· Challenge',
            'session_type'     => 'core',
            'sort_order'       => 3,
            'estimated_minutes'=> 15,
            'item_template'    => ['difficulty_min' => 2, 'difficulty_max' => 3, 'item_count' => 2, 'selection_rule' => 'adaptive'],
        ],
        [
            'suffix_es'        => '· Repaso',
            'suffix_en'        => '· Review',
            'session_type'     => 'review',
            'sort_order'       => 4,
            'estimated_minutes'=> 12,
            'item_template'    => ['difficulty_min' => 1, 'difficulty_max' => 3, 'item_count' => 2, 'selection_rule' => 'adaptive'],
        ],
    ];

    // -----------------------------------------------------------------------

    public function run(): void
    {
        // 1. Grade bands
        foreach ($this->bands as $bandData) {
            GradeBand::firstOrCreate(
                ['code' => $bandData['code']],
                array_merge($bandData, ['id' => (string) Str::uuid()])
            );
        }

        // 2. Tracks, units, sessions, items
        foreach ($this->curriculum as $bandCode => $trackData) {
            $gradeBand = GradeBand::where('code', $bandCode)->firstOrFail();

            $track = CurriculumTrack::firstOrCreate(
                ['code' => $trackData['code']],
                [
                    'id'            => (string) Str::uuid(),
                    'grade_band_id' => $gradeBand->id,
                    'label_es'      => $trackData['label_es'],
                    'label_en'      => $trackData['label_en'],
                    'version'       => 'v1',
                    'is_active'     => true,
                ]
            );

            foreach ($trackData['units'] as $unitData) {
                $unit = CurriculumUnit::firstOrCreate(
                    ['curriculum_track_id' => $track->id, 'code' => $unitData['code']],
                    [
                        'id'                => (string) Str::uuid(),
                        'title_es'          => $unitData['title_es'],
                        'title_en'          => $unitData['title_en'],
                        'description_es'    => $unitData['description_es'],
                        'description_en'    => $unitData['description_en'],
                        'sort_order'        => $unitData['sort_order'],
                        'estimated_sessions'=> count($this->sessionBlueprints),
                        'mastery_threshold' => $unitData['mastery_threshold'],
                    ]
                );

                // Unit skills
                foreach ($unitData['skills'] as $weight => $skillName) {
                    $skill = Skill::where('name', $skillName)->first();
                    if (!$skill) {
                        $this->command->warn("Skill not found: {$skillName}");
                        continue;
                    }

                    CurriculumUnitSkill::firstOrCreate(
                        ['curriculum_unit_id' => $unit->id, 'skill_id' => $skill->id],
                        [
                            'id'                  => (string) Str::uuid(),
                            'priority_weight'     => $weight + 1, // 1-based
                            'target_mastery_min'  => 50,
                            'target_mastery_goal' => 75,
                        ]
                    );
                }

                // Session blueprints
                foreach ($this->sessionBlueprints as $blueprint) {
                    $sessionCode = $unitData['code'] . '_s' . $blueprint['sort_order'];

                    $session = CurriculumSession::firstOrCreate(
                        ['curriculum_unit_id' => $unit->id, 'code' => $sessionCode],
                        [
                            'id'                => (string) Str::uuid(),
                            'title_es'          => $unitData['title_es'] . ' ' . $blueprint['suffix_es'],
                            'title_en'          => $unitData['title_en'] . ' ' . $blueprint['suffix_en'],
                            'session_type'      => $blueprint['session_type'],
                            'sort_order'        => $blueprint['sort_order'],
                            'estimated_minutes' => $blueprint['estimated_minutes'],
                        ]
                    );

                    // One item per skill in the unit
                    foreach ($unitData['skills'] as $slotOrder => $skillName) {
                        $skill = Skill::where('name', $skillName)->first();
                        if (!$skill) continue;

                        CurriculumSessionItem::firstOrCreate(
                            ['curriculum_session_id' => $session->id, 'skill_id' => $skill->id],
                            array_merge(
                                ['id' => (string) Str::uuid(), 'sort_order' => $slotOrder + 1],
                                $blueprint['item_template']
                            )
                        );
                    }
                }
            }
        }

        $this->command->info('CurriculumTrackSeeder: 3 bands, 9 units, 36 sessions, 108 items seeded.');
    }
}
