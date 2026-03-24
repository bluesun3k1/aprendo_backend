<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\SkillDomain;
use Illuminate\Database\Seeder;

class DomainSkillSeeder extends Seeder
{
    private array $domains = [
        'reading'   => ['label_es' => 'Comprensión lectora',    'label_en' => 'Reading Comprehension'],
        'attention' => ['label_es' => 'Atención y enfoque',      'label_en' => 'Attention & Focus'],
        'reasoning' => ['label_es' => 'Pensamiento crítico',     'label_en' => 'Critical Thinking'],
        'math'      => ['label_es' => 'Matemáticas',                'label_en' => 'Mathematics'],
    ];

    private array $skills = [
        'reading' => [
            ['name' => 'main_idea',          'label_es' => 'Idea principal',           'label_en' => 'Main Idea'],
            ['name' => 'supporting_details', 'label_es' => 'Detalles de apoyo',         'label_en' => 'Supporting Details'],
            ['name' => 'sequencing',         'label_es' => 'Secuencia',                 'label_en' => 'Sequencing'],
            ['name' => 'inference',          'label_es' => 'Inferencia',                'label_en' => 'Inference'],
            ['name' => 'context_clues',      'label_es' => 'Pistas de contexto',        'label_en' => 'Context Clues'],
            ['name' => 'summarization',      'label_es' => 'Resumen',                   'label_en' => 'Summarization'],
            ['name' => 'compare_contrast',   'label_es' => 'Comparar y contrastar',     'label_en' => 'Compare & Contrast'],
            ['name' => 'identifying_purpose','label_es' => 'Identificar el propósito',  'label_en' => 'Identifying Purpose'],
            ['name' => 'fact_vs_opinion',    'label_es' => 'Hecho vs. opinión',         'label_en' => 'Fact vs. Opinion'],
            ['name' => 'evaluating_evidence','label_es' => 'Evaluar evidencia',         'label_en' => 'Evaluating Evidence'],
        ],
        'attention' => [
            ['name' => 'selective_attention',    'label_es' => 'Atención selectiva',         'label_en' => 'Selective Attention'],
            ['name' => 'sustained_attention',    'label_es' => 'Atención sostenida',          'label_en' => 'Sustained Attention'],
            ['name' => 'visual_discrimination',  'label_es' => 'Discriminación visual',       'label_en' => 'Visual Discrimination'],
            ['name' => 'impulse_control',        'label_es' => 'Control de impulsos',         'label_en' => 'Impulse Control'],
            ['name' => 'instruction_following',  'label_es' => 'Seguir instrucciones',        'label_en' => 'Instruction Following'],
            ['name' => 'filtering_distractions', 'label_es' => 'Filtrar distracciones',       'label_en' => 'Filtering Distractions'],
            ['name' => 'speed_accuracy',         'label_es' => 'Velocidad con precisión',     'label_en' => 'Speed & Accuracy'],
            ['name' => 'response_control',       'label_es' => 'Control de respuesta',        'label_en' => 'Response Control'],
        ],
        'reasoning' => [
            ['name' => 'classification',      'label_es' => 'Clasificación',             'label_en' => 'Classification'],
            ['name' => 'analogies',           'label_es' => 'Analogías',                 'label_en' => 'Analogies'],
            ['name' => 'patterns',            'label_es' => 'Patrones',                  'label_en' => 'Patterns'],
            ['name' => 'cause_effect',        'label_es' => 'Causa y efecto',            'label_en' => 'Cause & Effect'],
            ['name' => 'deductive_logic',     'label_es' => 'Lógica deductiva',          'label_en' => 'Deductive Logic'],
            ['name' => 'argument_analysis',   'label_es' => 'Análisis de argumentos',   'label_en' => 'Argument Analysis'],
            ['name' => 'problem_solving',     'label_es' => 'Resolución de problemas',  'label_en' => 'Problem Solving'],
            ['name' => 'decision_making',     'label_es' => 'Toma de decisiones',       'label_en' => 'Decision Making'],
            ['name' => 'evidence_selection',  'label_es' => 'Selección de evidencia',   'label_en' => 'Evidence Selection'],
        ],
        'math' => [
            ['name' => 'number_sense',            'label_es' => 'Sentido numérico',           'label_en' => 'Number Sense'],
            ['name' => 'place_value',             'label_es' => 'Valor posicional',           'label_en' => 'Place Value'],
            ['name' => 'addition_subtraction',    'label_es' => 'Suma y resta',               'label_en' => 'Addition & Subtraction'],
            ['name' => 'geometry_basics',         'label_es' => 'Geometría básica',           'label_en' => 'Basic Geometry'],
            ['name' => 'measurement',             'label_es' => 'Medición',                   'label_en' => 'Measurement'],
            ['name' => 'patterns_sequences',      'label_es' => 'Patrones y secuencias',      'label_en' => 'Patterns & Sequences'],
            ['name' => 'word_problems',           'label_es' => 'Problemas de palabras',      'label_en' => 'Word Problems'],
            ['name' => 'data_interpretation',     'label_es' => 'Interpretación de datos',    'label_en' => 'Data Interpretation'],
            ['name' => 'multiplication_division', 'label_es' => 'Multiplicación y división',  'label_en' => 'Multiplication & Division'],
            ['name' => 'fractions',               'label_es' => 'Fracciones',                 'label_en' => 'Fractions'],
            ['name' => 'decimals',                'label_es' => 'Decimales',                  'label_en' => 'Decimals'],
            ['name' => 'percentages',             'label_es' => 'Porcentajes',                'label_en' => 'Percentages'],
            ['name' => 'ratios_proportions',      'label_es' => 'Razones y proporciones',     'label_en' => 'Ratios & Proportions'],
            ['name' => 'integers',                'label_es' => 'Números enteros',            'label_en' => 'Integers'],
            ['name' => 'algebra_basics',          'label_es' => 'Álgebra básica',             'label_en' => 'Basic Algebra'],
            ['name' => 'equations',               'label_es' => 'Ecuaciones',                 'label_en' => 'Equations'],
            ['name' => 'statistics_basics',       'label_es' => 'Estadística básica',         'label_en' => 'Basic Statistics'],
        ],
    ];

    public function run(): void
    {
        foreach ($this->domains as $id => $labels) {
            SkillDomain::firstOrCreate(['id' => $id], $labels);
        }

        foreach ($this->skills as $domainId => $domainSkills) {
            foreach ($domainSkills as $skillData) {
                Skill::firstOrCreate(
                    ['domain_id' => $domainId, 'name' => $skillData['name']],
                    array_merge($skillData, ['id' => \Illuminate\Support\Str::uuid()])
                );
            }
        }
    }
}
