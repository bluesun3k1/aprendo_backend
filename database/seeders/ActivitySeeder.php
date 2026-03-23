<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        // ---------------------------------------------------------------
        // DIAGNOSTIC — 9 activities per band (3 domains × 3 difficulties)
        // ---------------------------------------------------------------
        $this->insertActivities($this->earlyDiagnosticActivities(), true);
        $this->insertActivities($this->middleDiagnosticActivities(), true);
        $this->insertActivities($this->upperDiagnosticActivities(), true);

        // ---------------------------------------------------------------
        // SESSION — 16 activities per band (6 reading, 5 attention, 5 reasoning)
        // ---------------------------------------------------------------
        $this->insertActivities($this->earlySessionActivities(), false);
        $this->insertActivities($this->middleSessionActivities(), false);
        $this->insertActivities($this->upperSessionActivities(), false);
    }

    // -------------------------------------------------------------------
    // Generic insert helper — skips duplicates per skill+difficulty+grade_band
    // -------------------------------------------------------------------
    private function insertActivities(array $activities, bool $isDiagnostic): void
    {
        foreach ($activities as $data) {
            $skill = Skill::whereHas('domain', fn ($q) => $q->where('id', $data['domain']))
                ->where('name', $data['skill_name'])
                ->first();

            if (!$skill) continue;

            $query = Activity::where('skill_id', $skill->id)
                ->where('difficulty', $data['difficulty'])
                ->where('grade_band', $data['grade_band'])
                ->where('is_diagnostic', $isDiagnostic);

            // For session activities also match type to allow multiple types per skill/difficulty
            if (!$isDiagnostic) {
                $query->where('type', $data['type']);
            }

            if ($query->exists()) continue;

            Activity::create([
                'id'              => Str::uuid(),
                'skill_id'        => $skill->id,
                'type'            => $data['type'],
                'difficulty'      => $data['difficulty'],
                'grade_band'      => $data['grade_band'],
                'instructions_es' => $data['instructions_es'],
                'instructions_en' => $data['instructions_en'],
                'content'         => $data['content'],
                'correct_answer'  => $data['correct_answer'],
                'is_diagnostic'   => $isDiagnostic,
                'is_active'       => true,
            ]);
        }
    }

    // ===================================================================
    // EARLY BAND — grades 1-2  (simple, concrete, short text)
    // ===================================================================

    private function earlyDiagnosticActivities(): array
    {
        return [
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'difficulty' => 1, 'grade_band' => 'early',
                'type' => 'multiple_choice',
                'instructions_es' => 'Lee el texto y elige de qué trata.',
                'instructions_en' => 'Read the text and choose what it is about.',
                'content' => [
                    'passage' => 'El gato duerme en el sofá. Le gusta descansar todo el día.',
                    'question' => '¿De qué trata el texto?',
                    'options' => [
                        ['id' => 'a', 'text' => 'El sofá es suave', 'image_url' => null],
                        ['id' => 'b', 'text' => 'El gato descansa mucho', 'image_url' => null],
                        ['id' => 'c', 'text' => 'El gato come mucho', 'image_url' => null],
                        ['id' => 'd', 'text' => 'El sofá es nuevo', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'inference', 'difficulty' => 2, 'grade_band' => 'early',
                'type' => 'multiple_choice',
                'instructions_es' => 'Lee y elige lo que podemos saber.',
                'instructions_en' => 'Read and choose what we can tell.',
                'content' => [
                    'passage' => 'Lucas se puso el abrigo y tomó su paraguas antes de salir.',
                    'question' => '¿Qué tiempo hace afuera?',
                    'options' => [
                        ['id' => 'a', 'text' => 'Hace mucho sol', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Hace frío o llueve', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Hace mucho calor', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Está muy oscuro', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'fact_vs_opinion', 'difficulty' => 3, 'grade_band' => 'early',
                'type' => 'multiple_choice',
                'instructions_es' => 'Elige la oración que es un hecho real.',
                'instructions_en' => 'Choose the sentence that is a real fact.',
                'content' => [
                    'passage' => null,
                    'question' => '¿Cuál es un hecho verdadero?',
                    'options' => [
                        ['id' => 'a', 'text' => 'Los perros son las mejores mascotas', 'image_url' => null],
                        ['id' => 'b', 'text' => 'El cielo es azul', 'image_url' => null],
                        ['id' => 'c', 'text' => 'El verano es mejor que el invierno', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Las flores son muy bonitas', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'selective_attention', 'difficulty' => 1, 'grade_band' => 'early',
                'type' => 'multiple_choice',
                'instructions_es' => 'Encuentra la palabra que no es una fruta.',
                'instructions_en' => 'Find the word that is not a fruit.',
                'content' => [
                    'passage' => null,
                    'question' => '¿Cuál no es una fruta?',
                    'options' => [
                        ['id' => 'a', 'text' => 'Naranja', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Manzana', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Lechuga', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Pera', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'c'],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'instruction_following', 'difficulty' => 2, 'grade_band' => 'early',
                'type' => 'tap_sequence',
                'instructions_es' => 'Toca los animales del más pequeño al más grande.',
                'instructions_en' => 'Tap the animals from smallest to largest.',
                'content' => [
                    'instructions' => 'Toca los animales del más pequeño al más grande.',
                    'items' => [
                        ['id' => 'item_1', 'text' => 'Gato'],
                        ['id' => 'item_2', 'text' => 'Elefante'],
                        ['id' => 'item_3', 'text' => 'Hormiga'],
                        ['id' => 'item_4', 'text' => 'Perro'],
                    ],
                    'time_limit_seconds' => 30,
                ],
                'correct_answer' => ['sequence' => ['item_3', 'item_1', 'item_4', 'item_2']],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'visual_discrimination', 'difficulty' => 3, 'grade_band' => 'early',
                'type' => 'multiple_choice',
                'instructions_es' => 'Encuentra la secuencia diferente.',
                'instructions_en' => 'Find the different sequence.',
                'content' => [
                    'passage' => null,
                    'question' => '¿Cuál es diferente? AAB | AAB | AAB | ABA',
                    'options' => [
                        ['id' => 'a', 'text' => 'Primera: AAB', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Segunda: AAB', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Tercera: AAB', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Cuarta: ABA', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'd'],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'classification', 'difficulty' => 1, 'grade_band' => 'early',
                'type' => 'drag_to_sort',
                'instructions_es' => 'Arrastra cada elemento al grupo correcto.',
                'instructions_en' => 'Drag each item to the correct group.',
                'content' => [
                    'instructions' => 'Arrastra cada elemento al grupo correcto.',
                    'items' => [
                        ['id' => 'item_1', 'text' => 'Vaca', 'image_url' => null],
                        ['id' => 'item_2', 'text' => 'Mesa', 'image_url' => null],
                        ['id' => 'item_3', 'text' => 'Silla', 'image_url' => null],
                        ['id' => 'item_4', 'text' => 'Caballo', 'image_url' => null],
                    ],
                    'zones' => [
                        ['id' => 'zone_a', 'label' => 'Animales'],
                        ['id' => 'zone_b', 'label' => 'Muebles'],
                    ],
                ],
                'correct_answer' => ['zones' => ['zone_a' => ['item_1', 'item_4'], 'zone_b' => ['item_2', 'item_3']]],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'patterns', 'difficulty' => 2, 'grade_band' => 'early',
                'type' => 'multiple_choice',
                'instructions_es' => 'Completa el patrón.',
                'instructions_en' => 'Complete the pattern.',
                'content' => [
                    'passage' => null,
                    'question' => 'Rojo, Azul, Rojo, Azul, Rojo, ___',
                    'options' => [
                        ['id' => 'a', 'text' => 'Rojo', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Azul', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Verde', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Amarillo', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'cause_effect', 'difficulty' => 3, 'grade_band' => 'early',
                'type' => 'tap_sequence',
                'instructions_es' => 'Toca los eventos en el orden en que pasaron.',
                'instructions_en' => 'Tap the events in the order they happened.',
                'content' => [
                    'instructions' => 'Toca los eventos en el orden en que pasaron.',
                    'items' => [
                        ['id' => 'item_1', 'text' => 'Se mojó'],
                        ['id' => 'item_2', 'text' => 'Salió sin paraguas'],
                        ['id' => 'item_3', 'text' => 'Empezó a llover'],
                    ],
                    'time_limit_seconds' => 30,
                ],
                'correct_answer' => ['sequence' => ['item_2', 'item_3', 'item_1']],
            ],
        ];
    }

    private function earlySessionActivities(): array
    {
        return [
            // ---- READING ----
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'difficulty' => 1, 'grade_band' => 'early',
                'type' => 'multiple_choice',
                'instructions_es' => 'Lee y elige de qué trata el texto.',
                'instructions_en' => 'Read and choose what the text is about.',
                'content' => [
                    'passage' => 'Los peces viven en el agua. Respiran con branquias y tienen aletas para nadar.',
                    'question' => '¿De qué trata el texto?',
                    'options' => [
                        ['id' => 'a', 'text' => 'Los peces comen mucho', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Los peces viven en el agua y nadan con aletas', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Las branquias son muy grandes', 'image_url' => null],
                        ['id' => 'd', 'text' => 'El agua está fría', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'sequencing', 'difficulty' => 1, 'grade_band' => 'early',
                'type' => 'tap_sequence',
                'instructions_es' => 'Ordena los pasos para lavarse los dientes.',
                'instructions_en' => 'Put the steps for brushing teeth in order.',
                'content' => [
                    'instructions' => 'Toca los pasos en el orden correcto.',
                    'items' => [
                        ['id' => 'item_1', 'text' => 'Enjuagar la boca'],
                        ['id' => 'item_2', 'text' => 'Poner pasta en el cepillo'],
                        ['id' => 'item_3', 'text' => 'Tomar el cepillo'],
                        ['id' => 'item_4', 'text' => 'Cepillar los dientes'],
                    ],
                    'time_limit_seconds' => 30,
                ],
                'correct_answer' => ['sequence' => ['item_3', 'item_2', 'item_4', 'item_1']],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'difficulty' => 2, 'grade_band' => 'early',
                'type' => 'multiple_choice',
                'instructions_es' => 'Elige el detalle que habla sobre los pájaros.',
                'instructions_en' => 'Choose the detail that tells us about birds.',
                'content' => [
                    'passage' => 'Los pájaros son animales especiales. Tienen plumas, ponen huevos y muchos pueden volar.',
                    'question' => '¿Qué detalle nos dice que los pájaros son especiales?',
                    'options' => [
                        ['id' => 'a', 'text' => 'Tienen plumas y muchos pueden volar', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Son muy ruidosos', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Viven en los árboles', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Son de muchos colores', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'compare_contrast', 'difficulty' => 2, 'grade_band' => 'early',
                'type' => 'drag_to_sort',
                'instructions_es' => 'Arrastra cada cosa al animal correcto.',
                'instructions_en' => 'Drag each thing to the correct animal.',
                'content' => [
                    'instructions' => 'Arrastra cada característica al animal correcto.',
                    'items' => [
                        ['id' => 'item_1', 'text' => 'Ladra', 'image_url' => null],
                        ['id' => 'item_2', 'text' => 'Maúlla', 'image_url' => null],
                        ['id' => 'item_3', 'text' => 'Le gusta perseguir pelotas', 'image_url' => null],
                        ['id' => 'item_4', 'text' => 'Ronronea', 'image_url' => null],
                    ],
                    'zones' => [
                        ['id' => 'zone_a', 'label' => 'Perro'],
                        ['id' => 'zone_b', 'label' => 'Gato'],
                    ],
                ],
                'correct_answer' => ['zones' => ['zone_a' => ['item_1', 'item_3'], 'zone_b' => ['item_2', 'item_4']]],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'inference', 'difficulty' => 3, 'grade_band' => 'early',
                'type' => 'multiple_choice',
                'instructions_es' => 'Lee y elige lo que está pasando.',
                'instructions_en' => 'Read and choose what is happening.',
                'content' => [
                    'passage' => 'Sofía llegó a casa y vio un pastel con velas encendidas y muchos globos de colores.',
                    'question' => '¿Qué está pasando en la casa de Sofía?',
                    'options' => [
                        ['id' => 'a', 'text' => 'Están limpiando la casa', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Es el cumpleaños de alguien', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Están decorando para Navidad', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Su mamá está cocinando', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'summarization', 'difficulty' => 3, 'grade_band' => 'early',
                'type' => 'multiple_choice',
                'instructions_es' => 'Elige la oración que mejor explica todo el texto.',
                'instructions_en' => 'Choose the sentence that best explains the whole text.',
                'content' => [
                    'passage' => 'Las mariposas nacen de huevos. Luego se convierten en orugas que comen hojas. Después forman una crisálida. Finalmente, salen como mariposas coloridas.',
                    'question' => '¿Cuál es el mejor resumen?',
                    'options' => [
                        ['id' => 'a', 'text' => 'Las mariposas son coloridas', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Las orugas comen muchas hojas', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Las mariposas pasan por cuatro etapas para nacer', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Las crisálidas son muy duras', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'c'],
            ],
            // ---- ATTENTION ----
            [
                'domain' => 'attention', 'skill_name' => 'selective_attention', 'difficulty' => 1, 'grade_band' => 'early',
                'type' => 'multiple_choice',
                'instructions_es' => 'Elige el que no es un número.',
                'instructions_en' => 'Choose the one that is not a number.',
                'content' => [
                    'passage' => null,
                    'question' => '¿Cuál no es un número?',
                    'options' => [
                        ['id' => 'a', 'text' => '3', 'image_url' => null],
                        ['id' => 'b', 'text' => '7', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Árbol', 'image_url' => null],
                        ['id' => 'd', 'text' => '5', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'c'],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'sustained_attention', 'difficulty' => 1, 'grade_band' => 'early',
                'type' => 'tap_sequence',
                'instructions_es' => 'Toca solo los círculos en el orden en que aparecen.',
                'instructions_en' => 'Tap only the circles in the order they appear.',
                'content' => [
                    'instructions' => 'Toca solo los círculos en el orden en que aparecen.',
                    'items' => [
                        ['id' => 'item_1', 'text' => 'Círculo'],
                        ['id' => 'item_2', 'text' => 'Cuadrado'],
                        ['id' => 'item_3', 'text' => 'Círculo'],
                        ['id' => 'item_4', 'text' => 'Triángulo'],
                        ['id' => 'item_5', 'text' => 'Círculo'],
                    ],
                    'time_limit_seconds' => 20,
                ],
                'correct_answer' => ['sequence' => ['item_1', 'item_3', 'item_5']],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'impulse_control', 'difficulty' => 2, 'grade_band' => 'early',
                'type' => 'multiple_choice',
                'instructions_es' => 'Lee todo antes de responder.',
                'instructions_en' => 'Read everything before answering.',
                'content' => [
                    'passage' => 'Si el semáforo está en rojo, para. Si está en verde, camina. Si está en amarillo, espera.',
                    'question' => 'El semáforo está en amarillo. ¿Qué haces?',
                    'options' => [
                        ['id' => 'a', 'text' => 'Caminas rápido', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Te detienes completamente', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Esperas', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Corres', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'c'],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'filtering_distractions', 'difficulty' => 2, 'grade_band' => 'early',
                'type' => 'multiple_choice',
                'instructions_es' => 'Usa solo la información que necesitas.',
                'instructions_en' => 'Use only the information you need.',
                'content' => [
                    'passage' => 'Hay 5 manzanas en la mesa. También hay 3 naranjas, una jarra y 2 tazas.',
                    'question' => '¿Cuántas frutas hay en total?',
                    'options' => [
                        ['id' => 'a', 'text' => '5', 'image_url' => null],
                        ['id' => 'b', 'text' => '8', 'image_url' => null],
                        ['id' => 'c', 'text' => '10', 'image_url' => null],
                        ['id' => 'd', 'text' => '3', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'speed_accuracy', 'difficulty' => 3, 'grade_band' => 'early',
                'type' => 'tap_sequence',
                'instructions_es' => 'Toca las letras en orden alfabético lo más rápido posible.',
                'instructions_en' => 'Tap the letters in alphabetical order as fast as you can.',
                'content' => [
                    'instructions' => 'Toca las letras en orden: A, B, C, D, E.',
                    'items' => [
                        ['id' => 'item_1', 'text' => 'D'],
                        ['id' => 'item_2', 'text' => 'A'],
                        ['id' => 'item_3', 'text' => 'C'],
                        ['id' => 'item_4', 'text' => 'E'],
                        ['id' => 'item_5', 'text' => 'B'],
                    ],
                    'time_limit_seconds' => 15,
                ],
                'correct_answer' => ['sequence' => ['item_2', 'item_5', 'item_3', 'item_1', 'item_4']],
            ],
            // ---- REASONING ----
            [
                'domain' => 'reasoning', 'skill_name' => 'classification', 'difficulty' => 1, 'grade_band' => 'early',
                'type' => 'drag_to_sort',
                'instructions_es' => 'Clasifica en frutas o verduras.',
                'instructions_en' => 'Classify as fruits or vegetables.',
                'content' => [
                    'instructions' => 'Arrastra al grupo correcto.',
                    'items' => [
                        ['id' => 'item_1', 'text' => 'Zanahoria', 'image_url' => null],
                        ['id' => 'item_2', 'text' => 'Mango', 'image_url' => null],
                        ['id' => 'item_3', 'text' => 'Espinaca', 'image_url' => null],
                        ['id' => 'item_4', 'text' => 'Durazno', 'image_url' => null],
                    ],
                    'zones' => [
                        ['id' => 'zone_a', 'label' => 'Frutas'],
                        ['id' => 'zone_b', 'label' => 'Verduras'],
                    ],
                ],
                'correct_answer' => ['zones' => ['zone_a' => ['item_2', 'item_4'], 'zone_b' => ['item_1', 'item_3']]],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'patterns', 'difficulty' => 1, 'grade_band' => 'early',
                'type' => 'multiple_choice',
                'instructions_es' => 'Completa la secuencia.',
                'instructions_en' => 'Complete the sequence.',
                'content' => [
                    'passage' => null,
                    'question' => '1, 2, 3, 4, ___',
                    'options' => [
                        ['id' => 'a', 'text' => '4', 'image_url' => null],
                        ['id' => 'b', 'text' => '5', 'image_url' => null],
                        ['id' => 'c', 'text' => '6', 'image_url' => null],
                        ['id' => 'd', 'text' => '7', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'cause_effect', 'difficulty' => 2, 'grade_band' => 'early',
                'type' => 'multiple_choice',
                'instructions_es' => 'Elige qué pasará.',
                'instructions_en' => 'Choose what will happen.',
                'content' => [
                    'passage' => 'Pedro no estudió para el examen.',
                    'question' => '¿Qué podría pasar?',
                    'options' => [
                        ['id' => 'a', 'text' => 'Saca una nota muy buena', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Le va mal en el examen', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Su maestra está contenta', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Aprende mucho ese día', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'deductive_logic', 'difficulty' => 3, 'grade_band' => 'early',
                'type' => 'multiple_choice',
                'instructions_es' => 'Lee y elige lo que podemos concluir.',
                'instructions_en' => 'Read and choose what we can conclude.',
                'content' => [
                    'passage' => 'Todos los niños de la clase tienen mochila. Juan es un niño de la clase.',
                    'question' => '¿Qué podemos concluir?',
                    'options' => [
                        ['id' => 'a', 'text' => 'Juan tiene mochila', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Juan no tiene mochila', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Algunos niños no tienen mochila', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Solo Juan tiene mochila', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'problem_solving', 'difficulty' => 3, 'grade_band' => 'early',
                'type' => 'multiple_choice',
                'instructions_es' => 'Resuelve el problema.',
                'instructions_en' => 'Solve the problem.',
                'content' => [
                    'passage' => 'En una caja hay 10 lápices. María toma 3.',
                    'question' => '¿Cuántos lápices quedan en la caja?',
                    'options' => [
                        ['id' => 'a', 'text' => '5', 'image_url' => null],
                        ['id' => 'b', 'text' => '6', 'image_url' => null],
                        ['id' => 'c', 'text' => '7', 'image_url' => null],
                        ['id' => 'd', 'text' => '8', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'c'],
            ],
        ];
    }

    // ===================================================================
    // MIDDLE BAND — grades 3-5 (moderate complexity, age-appropriate)
    // ===================================================================

    private function middleDiagnosticActivities(): array
    {
        return [
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'difficulty' => 1, 'grade_band' => 'middle',
                'type' => 'multiple_choice',
                'instructions_es' => 'Lee el texto y elige la idea principal.',
                'instructions_en' => 'Read the text and choose the main idea.',
                'content' => [
                    'passage' => 'El sol es una estrella enorme que se encuentra en el centro de nuestro sistema solar. Nos da luz y calor para vivir.',
                    'question' => '¿Cuál es la idea principal del texto?',
                    'options' => [
                        ['id' => 'a', 'text' => 'El sol da calor', 'image_url' => null],
                        ['id' => 'b', 'text' => 'El sol es una estrella que da luz y calor', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Las estrellas son grandes', 'image_url' => null],
                        ['id' => 'd', 'text' => 'La Tierra gira alrededor del sol', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'inference', 'difficulty' => 2, 'grade_band' => 'middle',
                'type' => 'multiple_choice',
                'instructions_es' => 'Lee y elige la mejor inferencia.',
                'instructions_en' => 'Read and choose the best inference.',
                'content' => [
                    'passage' => 'María llegó a casa con el cabello mojado y los zapatos llenos de barro.',
                    'question' => '¿Qué podemos inferir?',
                    'options' => [
                        ['id' => 'a', 'text' => 'María fue a nadar', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Estuvo bajo la lluvia', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Lavó el piso', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Fue al mercado', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'fact_vs_opinion', 'difficulty' => 3, 'grade_band' => 'middle',
                'type' => 'multiple_choice',
                'instructions_es' => 'Identifica cuál es un hecho y cuál es una opinión.',
                'instructions_en' => 'Identify which is a fact and which is an opinion.',
                'content' => [
                    'passage' => null,
                    'question' => '¿Cuál de estas afirmaciones es un hecho?',
                    'options' => [
                        ['id' => 'a', 'text' => 'El chocolate es el mejor sabor del mundo', 'image_url' => null],
                        ['id' => 'b', 'text' => 'El agua hierve a 100 °C al nivel del mar', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Los perros son mejores mascotas que los gatos', 'image_url' => null],
                        ['id' => 'd', 'text' => 'La música clásica es aburrida', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'selective_attention', 'difficulty' => 1, 'grade_band' => 'middle',
                'type' => 'multiple_choice',
                'instructions_es' => 'Encuentra el objeto diferente.',
                'instructions_en' => 'Find the different object.',
                'content' => [
                    'passage' => null,
                    'question' => '¿Cuál de estas palabras NO pertenece al grupo?',
                    'options' => [
                        ['id' => 'a', 'text' => 'Manzana', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Pera', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Zanahoria', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Uva', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'c'],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'instruction_following', 'difficulty' => 2, 'grade_band' => 'middle',
                'type' => 'tap_sequence',
                'instructions_es' => 'Toca los números en orden de menor a mayor.',
                'instructions_en' => 'Tap the numbers from smallest to largest.',
                'content' => [
                    'instructions' => 'Toca los números en orden de menor a mayor.',
                    'items' => [
                        ['id' => 'item_1', 'text' => '7'],
                        ['id' => 'item_2', 'text' => '2'],
                        ['id' => 'item_3', 'text' => '5'],
                        ['id' => 'item_4', 'text' => '1'],
                    ],
                    'time_limit_seconds' => 30,
                ],
                'correct_answer' => ['sequence' => ['item_4', 'item_2', 'item_3', 'item_1']],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'visual_discrimination', 'difficulty' => 3, 'grade_band' => 'middle',
                'type' => 'multiple_choice',
                'instructions_es' => 'Identifica la figura que es diferente a las demás.',
                'instructions_en' => 'Identify the figure that differs from the others.',
                'content' => [
                    'passage' => null,
                    'question' => '¿Cuál es diferente: ABAB ABAB ABAB ACAB?',
                    'options' => [
                        ['id' => 'a', 'text' => 'Primera secuencia', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Segunda secuencia', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Tercera secuencia', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Cuarta secuencia', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'd'],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'classification', 'difficulty' => 1, 'grade_band' => 'middle',
                'type' => 'drag_to_sort',
                'instructions_es' => 'Arrastra cada elemento a la categoría correcta.',
                'instructions_en' => 'Drag each item to the correct category.',
                'content' => [
                    'instructions' => 'Arrastra cada elemento a la categoría correcta.',
                    'items' => [
                        ['id' => 'item_1', 'text' => 'Perro', 'image_url' => null],
                        ['id' => 'item_2', 'text' => 'Rosa', 'image_url' => null],
                        ['id' => 'item_3', 'text' => 'Gato', 'image_url' => null],
                        ['id' => 'item_4', 'text' => 'Girasol', 'image_url' => null],
                    ],
                    'zones' => [
                        ['id' => 'zone_a', 'label' => 'Animales'],
                        ['id' => 'zone_b', 'label' => 'Plantas'],
                    ],
                ],
                'correct_answer' => ['zones' => ['zone_a' => ['item_1', 'item_3'], 'zone_b' => ['item_2', 'item_4']]],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'patterns', 'difficulty' => 2, 'grade_band' => 'middle',
                'type' => 'multiple_choice',
                'instructions_es' => 'Completa el patrón.',
                'instructions_en' => 'Complete the pattern.',
                'content' => [
                    'passage' => null,
                    'question' => '2, 4, 6, 8, ___',
                    'options' => [
                        ['id' => 'a', 'text' => '9', 'image_url' => null],
                        ['id' => 'b', 'text' => '10', 'image_url' => null],
                        ['id' => 'c', 'text' => '11', 'image_url' => null],
                        ['id' => 'd', 'text' => '12', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'cause_effect', 'difficulty' => 3, 'grade_band' => 'middle',
                'type' => 'tap_sequence',
                'instructions_es' => 'Toca los eventos en el orden en que ocurrieron.',
                'instructions_en' => 'Tap the events in the order they occurred.',
                'content' => [
                    'instructions' => 'Toca los eventos en el orden en que ocurrieron.',
                    'items' => [
                        ['id' => 'item_1', 'text' => 'El agricultor recogió los frutos'],
                        ['id' => 'item_2', 'text' => 'Sembró las semillas'],
                        ['id' => 'item_3', 'text' => 'Preparó la tierra'],
                        ['id' => 'item_4', 'text' => 'Regó las plantas'],
                    ],
                    'time_limit_seconds' => 45,
                ],
                'correct_answer' => ['sequence' => ['item_3', 'item_2', 'item_4', 'item_1']],
            ],
        ];
    }

    private function middleSessionActivities(): array
    {
        return [
            // ---- READING ----
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'difficulty' => 1, 'grade_band' => 'middle',
                'type' => 'multiple_choice',
                'instructions_es' => 'Lee y elige la idea principal.',
                'instructions_en' => 'Read and choose the main idea.',
                'content' => [
                    'passage' => 'Los perros son animales domésticos muy leales. Acompañan a las personas y las ayudan en muchas tareas.',
                    'question' => '¿Cuál es la idea principal?',
                    'options' => [
                        ['id' => 'a', 'text' => 'Los perros muerden', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Los perros son leales y útiles', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Los gatos son mejores mascotas', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Los animales viven en el campo', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'sequencing', 'difficulty' => 1, 'grade_band' => 'middle',
                'type' => 'tap_sequence',
                'instructions_es' => 'Ordena los pasos para preparar un sándwich.',
                'instructions_en' => 'Order the steps to make a sandwich.',
                'content' => [
                    'instructions' => 'Toca los pasos en el orden correcto.',
                    'items' => [
                        ['id' => 'item_1', 'text' => 'Comer el sándwich'],
                        ['id' => 'item_2', 'text' => 'Poner los ingredientes'],
                        ['id' => 'item_3', 'text' => 'Tomar el pan'],
                        ['id' => 'item_4', 'text' => 'Cerrar el sándwich'],
                    ],
                    'time_limit_seconds' => 30,
                ],
                'correct_answer' => ['sequence' => ['item_3', 'item_2', 'item_4', 'item_1']],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'difficulty' => 2, 'grade_band' => 'middle',
                'type' => 'multiple_choice',
                'instructions_es' => 'Elige el detalle que apoya la idea principal.',
                'instructions_en' => 'Choose the detail that supports the main idea.',
                'content' => [
                    'passage' => 'El ejercicio es beneficioso para la salud. Fortalece los músculos, mejora el corazón y reduce el estrés.',
                    'question' => '¿Qué detalle apoya que el ejercicio es beneficioso?',
                    'options' => [
                        ['id' => 'a', 'text' => 'Mejora el corazón', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Es difícil de hacer', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Cansa mucho', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Requiere ropa especial', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'compare_contrast', 'difficulty' => 2, 'grade_band' => 'middle',
                'type' => 'drag_to_sort',
                'instructions_es' => 'Clasifica las características de cada animal.',
                'instructions_en' => 'Classify the characteristics of each animal.',
                'content' => [
                    'instructions' => 'Arrastra cada característica al animal correcto.',
                    'items' => [
                        ['id' => 'item_1', 'text' => 'Vive en el agua', 'image_url' => null],
                        ['id' => 'item_2', 'text' => 'Tiene plumas', 'image_url' => null],
                        ['id' => 'item_3', 'text' => 'Tiene escamas', 'image_url' => null],
                        ['id' => 'item_4', 'text' => 'Vuela', 'image_url' => null],
                    ],
                    'zones' => [
                        ['id' => 'zone_a', 'label' => 'Pez'],
                        ['id' => 'zone_b', 'label' => 'Pájaro'],
                    ],
                ],
                'correct_answer' => ['zones' => ['zone_a' => ['item_1', 'item_3'], 'zone_b' => ['item_2', 'item_4']]],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'inference', 'difficulty' => 3, 'grade_band' => 'middle',
                'type' => 'multiple_choice',
                'instructions_es' => 'Lee y elige la mejor conclusión.',
                'instructions_en' => 'Read and choose the best conclusion.',
                'content' => [
                    'passage' => 'Carlos no durmió bien, no desayunó y llegó tarde al trabajo. Su jefe lo miró con ceño fruncido.',
                    'question' => '¿Qué puede inferirse sobre el día de Carlos?',
                    'options' => [
                        ['id' => 'a', 'text' => 'Fue un día excelente', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Fue un día difícil', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Su jefe estaba contento', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Carlos ganó un premio', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'summarization', 'difficulty' => 3, 'grade_band' => 'middle',
                'type' => 'multiple_choice',
                'instructions_es' => 'Elige el mejor resumen del texto.',
                'instructions_en' => 'Choose the best summary of the text.',
                'content' => [
                    'passage' => 'Las abejas son insectos fundamentales para el ecosistema. Polinizan flores y plantas, lo que permite que crezcan frutos y semillas. Sin las abejas, muchas plantas desaparecerían.',
                    'question' => '¿Cuál es el mejor resumen?',
                    'options' => [
                        ['id' => 'a', 'text' => 'Las abejas producen miel', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Las abejas son importantes para las plantas y el ecosistema', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Los insectos viven en el jardín', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Las flores necesitan agua', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            // ---- ATTENTION ----
            [
                'domain' => 'attention', 'skill_name' => 'selective_attention', 'difficulty' => 1, 'grade_band' => 'middle',
                'type' => 'multiple_choice',
                'instructions_es' => 'Selecciona la palabra que NO pertenece al grupo.',
                'instructions_en' => 'Select the word that does NOT belong to the group.',
                'content' => [
                    'passage' => null,
                    'question' => '¿Cuál no es un color?',
                    'options' => [
                        ['id' => 'a', 'text' => 'Rojo', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Azul', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Círculo', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Verde', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'c'],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'sustained_attention', 'difficulty' => 1, 'grade_band' => 'middle',
                'type' => 'tap_sequence',
                'instructions_es' => 'Toca solo las vocales en orden de aparición.',
                'instructions_en' => 'Tap only the vowels in order of appearance.',
                'content' => [
                    'instructions' => 'Toca solo las vocales en el orden que aparecen.',
                    'items' => [
                        ['id' => 'item_1', 'text' => 'B'],
                        ['id' => 'item_2', 'text' => 'A'],
                        ['id' => 'item_3', 'text' => 'C'],
                        ['id' => 'item_4', 'text' => 'E'],
                        ['id' => 'item_5', 'text' => 'D'],
                    ],
                    'time_limit_seconds' => 20,
                ],
                'correct_answer' => ['sequence' => ['item_2', 'item_4']],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'impulse_control', 'difficulty' => 2, 'grade_band' => 'middle',
                'type' => 'multiple_choice',
                'instructions_es' => 'Antes de responder, lee todo con cuidado.',
                'instructions_en' => 'Before answering, read everything carefully.',
                'content' => [
                    'passage' => 'Si un número es mayor que 5 y menor que 10, dibuja un cuadrado. Si es exactamente 7, pinta el cuadrado de azul.',
                    'question' => '¿Qué haces con el número 7?',
                    'options' => [
                        ['id' => 'a', 'text' => 'Solo dibujas un cuadrado', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Dibujas un cuadrado y lo pintas de azul', 'image_url' => null],
                        ['id' => 'c', 'text' => 'No haces nada', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Lo pintas de rojo', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'filtering_distractions', 'difficulty' => 2, 'grade_band' => 'middle',
                'type' => 'multiple_choice',
                'instructions_es' => 'Ignora los datos que no son relevantes.',
                'instructions_en' => 'Ignore data that is not relevant.',
                'content' => [
                    'passage' => 'Juan tiene 12 años. Tiene 3 hermanos. Su perro se llama Firulais. ¿Cuántos años tiene Juan?',
                    'question' => '¿Cuántos años tiene Juan?',
                    'options' => [
                        ['id' => 'a', 'text' => '3', 'image_url' => null],
                        ['id' => 'b', 'text' => '12', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Firulais', 'image_url' => null],
                        ['id' => 'd', 'text' => '15', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'speed_accuracy', 'difficulty' => 3, 'grade_band' => 'middle',
                'type' => 'tap_sequence',
                'instructions_es' => 'Ordena los planetas del más cercano al más lejano del sol.',
                'instructions_en' => 'Order the planets from closest to farthest from the sun.',
                'content' => [
                    'instructions' => 'Toca en orden del más cercano al más lejano del sol.',
                    'items' => [
                        ['id' => 'item_1', 'text' => 'Tierra'],
                        ['id' => 'item_2', 'text' => 'Mercurio'],
                        ['id' => 'item_3', 'text' => 'Marte'],
                        ['id' => 'item_4', 'text' => 'Venus'],
                    ],
                    'time_limit_seconds' => 20,
                ],
                'correct_answer' => ['sequence' => ['item_2', 'item_4', 'item_1', 'item_3']],
            ],
            // ---- REASONING ----
            [
                'domain' => 'reasoning', 'skill_name' => 'classification', 'difficulty' => 1, 'grade_band' => 'middle',
                'type' => 'drag_to_sort',
                'instructions_es' => 'Clasifica en transporte terrestre o aéreo.',
                'instructions_en' => 'Classify as land or air transport.',
                'content' => [
                    'instructions' => 'Arrastra al tipo de transporte correcto.',
                    'items' => [
                        ['id' => 'item_1', 'text' => 'Avión', 'image_url' => null],
                        ['id' => 'item_2', 'text' => 'Auto', 'image_url' => null],
                        ['id' => 'item_3', 'text' => 'Helicóptero', 'image_url' => null],
                        ['id' => 'item_4', 'text' => 'Tren', 'image_url' => null],
                    ],
                    'zones' => [
                        ['id' => 'zone_a', 'label' => 'Terrestre'],
                        ['id' => 'zone_b', 'label' => 'Aéreo'],
                    ],
                ],
                'correct_answer' => ['zones' => ['zone_a' => ['item_2', 'item_4'], 'zone_b' => ['item_1', 'item_3']]],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'analogies', 'difficulty' => 2, 'grade_band' => 'middle',
                'type' => 'multiple_choice',
                'instructions_es' => 'Completa la analogía.',
                'instructions_en' => 'Complete the analogy.',
                'content' => [
                    'passage' => null,
                    'question' => 'Zapato es a pie, como guante es a ___.',
                    'options' => [
                        ['id' => 'a', 'text' => 'Cabeza', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Mano', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Cara', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Espalda', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'patterns', 'difficulty' => 1, 'grade_band' => 'middle',
                'type' => 'multiple_choice',
                'instructions_es' => 'Completa la secuencia.',
                'instructions_en' => 'Complete the sequence.',
                'content' => [
                    'passage' => null,
                    'question' => '1, 3, 5, 7, ___',
                    'options' => [
                        ['id' => 'a', 'text' => '8', 'image_url' => null],
                        ['id' => 'b', 'text' => '9', 'image_url' => null],
                        ['id' => 'c', 'text' => '10', 'image_url' => null],
                        ['id' => 'd', 'text' => '11', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'cause_effect', 'difficulty' => 2, 'grade_band' => 'middle',
                'type' => 'multiple_choice',
                'instructions_es' => 'Identifica la causa.',
                'instructions_en' => 'Identify the cause.',
                'content' => [
                    'passage' => 'El cielo se nubló, el viento sopló fuerte y comenzó a llover.',
                    'question' => '¿Cuál fue la causa de la lluvia?',
                    'options' => [
                        ['id' => 'a', 'text' => 'El cielo se nubló y el viento sopló fuerte', 'image_url' => null],
                        ['id' => 'b', 'text' => 'La lluvia hizo que el cielo se nublara', 'image_url' => null],
                        ['id' => 'c', 'text' => 'El sol salió', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Nadie sabe por qué llovió', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'deductive_logic', 'difficulty' => 3, 'grade_band' => 'middle',
                'type' => 'multiple_choice',
                'instructions_es' => 'Usa la lógica para encontrar la respuesta.',
                'instructions_en' => 'Use logic to find the answer.',
                'content' => [
                    'passage' => 'Todos los pájaros tienen alas. El pingüino es un pájaro.',
                    'question' => '¿Qué podemos concluir?',
                    'options' => [
                        ['id' => 'a', 'text' => 'El pingüino puede volar', 'image_url' => null],
                        ['id' => 'b', 'text' => 'El pingüino tiene alas', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Los pájaros son pingüinos', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Los pingüinos no son aves', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'problem_solving', 'difficulty' => 3, 'grade_band' => 'middle',
                'type' => 'multiple_choice',
                'instructions_es' => 'Resuelve el problema.',
                'instructions_en' => 'Solve the problem.',
                'content' => [
                    'passage' => 'Ana tiene 15 caramelos. Le da 4 a Juan y 3 a Pedro.',
                    'question' => '¿Cuántos caramelos le quedan a Ana?',
                    'options' => [
                        ['id' => 'a', 'text' => '6', 'image_url' => null],
                        ['id' => 'b', 'text' => '7', 'image_url' => null],
                        ['id' => 'c', 'text' => '8', 'image_url' => null],
                        ['id' => 'd', 'text' => '9', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'c'],
            ],
        ];
    }

    // ===================================================================
    // UPPER BAND — grades 6-9  (abstract, denser, more inferential)
    // ===================================================================

    private function upperDiagnosticActivities(): array
    {
        return [
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'difficulty' => 1, 'grade_band' => 'upper',
                'type' => 'multiple_choice',
                'instructions_es' => 'Lee el texto y elige la idea central.',
                'instructions_en' => 'Read the text and choose the central idea.',
                'content' => [
                    'passage' => 'La globalización ha transformado las economías locales al facilitar el libre flujo de bienes, servicios y capital entre naciones. Sin embargo, este proceso también ha generado desigualdades y ha puesto en riesgo la identidad cultural de comunidades tradicionales.',
                    'question' => '¿Cuál es la idea central del texto?',
                    'options' => [
                        ['id' => 'a', 'text' => 'La globalización solo trae beneficios económicos', 'image_url' => null],
                        ['id' => 'b', 'text' => 'La globalización transforma economías pero genera desigualdades y riesgos culturales', 'image_url' => null],
                        ['id' => 'c', 'text' => 'El libre comercio elimina la pobreza mundial', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Las culturas tradicionales deben rechazar la globalización', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'inference', 'difficulty' => 2, 'grade_band' => 'upper',
                'type' => 'multiple_choice',
                'instructions_es' => 'Lee y elige la inferencia más sólida.',
                'instructions_en' => 'Read and choose the strongest inference.',
                'content' => [
                    'passage' => 'El informe fue entregado con tres días de retraso. La directora lo revisó en silencio, subrayó varios párrafos y devolvió el documento sin decir una palabra.',
                    'question' => '¿Qué se puede inferir sobre la situación?',
                    'options' => [
                        ['id' => 'a', 'text' => 'La directora quedó muy satisfecha con el informe', 'image_url' => null],
                        ['id' => 'b', 'text' => 'El informe era excelente pero demasiado largo', 'image_url' => null],
                        ['id' => 'c', 'text' => 'La directora encontró problemas serios en el informe', 'image_url' => null],
                        ['id' => 'd', 'text' => 'El retraso fue justificado y comprendido', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'c'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'fact_vs_opinion', 'difficulty' => 3, 'grade_band' => 'upper',
                'type' => 'multiple_choice',
                'instructions_es' => 'Identifica la afirmación verificable como hecho.',
                'instructions_en' => 'Identify the statement verifiable as a fact.',
                'content' => [
                    'passage' => null,
                    'question' => '¿Cuál de estas afirmaciones es un hecho verificable?',
                    'options' => [
                        ['id' => 'a', 'text' => 'La democracia es el mejor sistema de gobierno posible', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Según el 97% de los climatólogos, el cambio climático es causado principalmente por actividades humanas', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Las energías renovables son siempre más eficientes que las fósiles', 'image_url' => null],
                        ['id' => 'd', 'text' => 'La tecnología mejora inevitablemente la calidad de vida', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'selective_attention', 'difficulty' => 1, 'grade_band' => 'upper',
                'type' => 'multiple_choice',
                'instructions_es' => 'Encuentra el concepto que NO pertenece a la biología.',
                'instructions_en' => 'Find the concept that does NOT belong to biology.',
                'content' => [
                    'passage' => null,
                    'question' => '¿Cuál de estos conceptos NO pertenece al campo de la biología?',
                    'options' => [
                        ['id' => 'a', 'text' => 'Fotosíntesis', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Mitosis', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Termodinámica', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Ecosistema', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'c'],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'instruction_following', 'difficulty' => 2, 'grade_band' => 'upper',
                'type' => 'tap_sequence',
                'instructions_es' => 'Ordena los pasos del método científico.',
                'instructions_en' => 'Put the steps of the scientific method in order.',
                'content' => [
                    'instructions' => 'Toca los pasos del método científico en el orden correcto.',
                    'items' => [
                        ['id' => 'item_1', 'text' => 'Formular hipótesis'],
                        ['id' => 'item_2', 'text' => 'Experimentar'],
                        ['id' => 'item_3', 'text' => 'Observar'],
                        ['id' => 'item_4', 'text' => 'Concluir'],
                    ],
                    'time_limit_seconds' => 30,
                ],
                'correct_answer' => ['sequence' => ['item_3', 'item_1', 'item_2', 'item_4']],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'visual_discrimination', 'difficulty' => 3, 'grade_band' => 'upper',
                'type' => 'multiple_choice',
                'instructions_es' => 'Encuentra la secuencia que rompe el patrón.',
                'instructions_en' => 'Find the sequence that breaks the pattern.',
                'content' => [
                    'passage' => null,
                    'question' => '¿En cuál secuencia hay un elemento diferente? XYZXYZ | XYZXYZ | XYZXYW | XYZXYZ',
                    'options' => [
                        ['id' => 'a', 'text' => 'Primera: XYZXYZ', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Segunda: XYZXYZ', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Tercera: XYZXYW', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Cuarta: XYZXYZ', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'c'],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'classification', 'difficulty' => 1, 'grade_band' => 'upper',
                'type' => 'drag_to_sort',
                'instructions_es' => 'Clasifica según tipo de fuente de energía.',
                'instructions_en' => 'Classify by type of energy source.',
                'content' => [
                    'instructions' => 'Arrastra cada fuente al grupo correcto.',
                    'items' => [
                        ['id' => 'item_1', 'text' => 'Energía solar', 'image_url' => null],
                        ['id' => 'item_2', 'text' => 'Carbón', 'image_url' => null],
                        ['id' => 'item_3', 'text' => 'Energía eólica', 'image_url' => null],
                        ['id' => 'item_4', 'text' => 'Petróleo', 'image_url' => null],
                    ],
                    'zones' => [
                        ['id' => 'zone_a', 'label' => 'Renovable'],
                        ['id' => 'zone_b', 'label' => 'No renovable'],
                    ],
                ],
                'correct_answer' => ['zones' => ['zone_a' => ['item_1', 'item_3'], 'zone_b' => ['item_2', 'item_4']]],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'patterns', 'difficulty' => 2, 'grade_band' => 'upper',
                'type' => 'multiple_choice',
                'instructions_es' => 'Completa la secuencia de Fibonacci.',
                'instructions_en' => 'Complete the Fibonacci sequence.',
                'content' => [
                    'passage' => null,
                    'question' => '1, 1, 2, 3, 5, 8, ___',
                    'options' => [
                        ['id' => 'a', 'text' => '11', 'image_url' => null],
                        ['id' => 'b', 'text' => '12', 'image_url' => null],
                        ['id' => 'c', 'text' => '13', 'image_url' => null],
                        ['id' => 'd', 'text' => '14', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'c'],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'cause_effect', 'difficulty' => 3, 'grade_band' => 'upper',
                'type' => 'tap_sequence',
                'instructions_es' => 'Ordena los eventos que llevaron a la Revolución Industrial.',
                'instructions_en' => 'Order the events that led to the Industrial Revolution.',
                'content' => [
                    'instructions' => 'Toca los eventos en el orden lógico en que ocurrieron.',
                    'items' => [
                        ['id' => 'item_1', 'text' => 'Se mecanizó la producción en fábricas'],
                        ['id' => 'item_2', 'text' => 'Aumentó la demanda masiva de bienes'],
                        ['id' => 'item_3', 'text' => 'Se inventó la máquina de vapor'],
                        ['id' => 'item_4', 'text' => 'Surgió la clase obrera urbana'],
                    ],
                    'time_limit_seconds' => 45,
                ],
                'correct_answer' => ['sequence' => ['item_3', 'item_1', 'item_4', 'item_2']],
            ],
        ];
    }

    private function upperSessionActivities(): array
    {
        return [
            // ---- READING ----
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'difficulty' => 1, 'grade_band' => 'upper',
                'type' => 'multiple_choice',
                'instructions_es' => 'Lee y elige la idea central del texto.',
                'instructions_en' => 'Read and choose the central idea of the text.',
                'content' => [
                    'passage' => 'La inteligencia artificial ha comenzado a transformar sectores como la medicina, la educación y la industria. A pesar de sus enormes beneficios en diagnósticos precisos y procesos automatizados, también plantea preguntas éticas sobre el desplazamiento laboral y la privacidad de datos.',
                    'question' => '¿Cuál es la idea central?',
                    'options' => [
                        ['id' => 'a', 'text' => 'La IA solo funciona en medicina', 'image_url' => null],
                        ['id' => 'b', 'text' => 'La IA transforma sectores con beneficios, pero también genera dilemas éticos', 'image_url' => null],
                        ['id' => 'c', 'text' => 'La automatización elimina todos los empleos', 'image_url' => null],
                        ['id' => 'd', 'text' => 'La IA viola siempre la privacidad personal', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'sequencing', 'difficulty' => 1, 'grade_band' => 'upper',
                'type' => 'tap_sequence',
                'instructions_es' => 'Ordena los pasos del proceso legislativo.',
                'instructions_en' => 'Order the steps of the legislative process.',
                'content' => [
                    'instructions' => 'Toca los pasos en el orden correcto del proceso legislativo.',
                    'items' => [
                        ['id' => 'item_1', 'text' => 'Promulgación por el ejecutivo'],
                        ['id' => 'item_2', 'text' => 'Debate en el congreso'],
                        ['id' => 'item_3', 'text' => 'Propuesta inicial de ley'],
                        ['id' => 'item_4', 'text' => 'Aprobación en comisiones'],
                    ],
                    'time_limit_seconds' => 30,
                ],
                'correct_answer' => ['sequence' => ['item_3', 'item_2', 'item_4', 'item_1']],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'difficulty' => 2, 'grade_band' => 'upper',
                'type' => 'multiple_choice',
                'instructions_es' => 'Elige el detalle que mejor apoya la afirmación central.',
                'instructions_en' => 'Choose the detail that best supports the central claim.',
                'content' => [
                    'passage' => 'El calentamiento global está acelerando el derretimiento de los glaciares. Esto eleva el nivel del mar, inunda zonas costeras y afecta los ciclos de agua dulce de los que dependen millones de personas.',
                    'question' => '¿Qué detalle apoya que el derretimiento de glaciares es un problema grave?',
                    'options' => [
                        ['id' => 'a', 'text' => 'Los glaciares son muy antiguos', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Eleva el nivel del mar e inunda zonas costeras afectando a millones', 'image_url' => null],
                        ['id' => 'c', 'text' => 'El agua fría es más densa que el agua caliente', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Los osos polares viven cerca de los glaciares', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'compare_contrast', 'difficulty' => 2, 'grade_band' => 'upper',
                'type' => 'drag_to_sort',
                'instructions_es' => 'Clasifica las características de cada sistema económico.',
                'instructions_en' => 'Classify the characteristics of each economic system.',
                'content' => [
                    'instructions' => 'Arrastra cada característica al sistema correcto.',
                    'items' => [
                        ['id' => 'item_1', 'text' => 'Propiedad privada de los medios de producción', 'image_url' => null],
                        ['id' => 'item_2', 'text' => 'Planificación centralizada del Estado', 'image_url' => null],
                        ['id' => 'item_3', 'text' => 'Libre mercado y competencia', 'image_url' => null],
                        ['id' => 'item_4', 'text' => 'Control estatal de los precios', 'image_url' => null],
                    ],
                    'zones' => [
                        ['id' => 'zone_a', 'label' => 'Capitalismo'],
                        ['id' => 'zone_b', 'label' => 'Socialismo'],
                    ],
                ],
                'correct_answer' => ['zones' => ['zone_a' => ['item_1', 'item_3'], 'zone_b' => ['item_2', 'item_4']]],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'inference', 'difficulty' => 3, 'grade_band' => 'upper',
                'type' => 'multiple_choice',
                'instructions_es' => 'Lee y elige la inferencia mejor respaldada por el texto.',
                'instructions_en' => 'Read and choose the inference best supported by the text.',
                'content' => [
                    'passage' => 'El científico publicó sus hallazgos en una revista de alto impacto. Al día siguiente, tres laboratorios internacionales solicitaron acceso a sus datos y dos universidades lo invitaron a dar conferencias.',
                    'question' => '¿Qué se puede inferir sobre los hallazgos?',
                    'options' => [
                        ['id' => 'a', 'text' => 'Fueron polémicos y rechazados por la comunidad científica', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Fueron significativos e importantes para la comunidad científica', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Fueron copiados de investigaciones anteriores', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Fueron publicados sin revisión por pares', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'summarization', 'difficulty' => 3, 'grade_band' => 'upper',
                'type' => 'multiple_choice',
                'instructions_es' => 'Elige el resumen más preciso y completo.',
                'instructions_en' => 'Choose the most accurate and complete summary.',
                'content' => [
                    'passage' => 'La Revolución Francesa derrocó a la monarquía, proclamó los derechos del ciudadano y difundió los ideales de libertad, igualdad y fraternidad. Aunque estuvo marcada por violencia y el Terror, estableció las bases del pensamiento político moderno y del estado laico.',
                    'question' => '¿Cuál es el mejor resumen?',
                    'options' => [
                        ['id' => 'a', 'text' => 'La Revolución Francesa fue un período de violencia sin logros duraderos', 'image_url' => null],
                        ['id' => 'b', 'text' => 'La Revolución Francesa terminó con la monarquía y fundó la política moderna a pesar de su violencia', 'image_url' => null],
                        ['id' => 'c', 'text' => 'La fraternidad y la igualdad se lograron plenamente durante la Revolución', 'image_url' => null],
                        ['id' => 'd', 'text' => 'El Terror fue el principal legado de la Revolución Francesa', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            // ---- ATTENTION ----
            [
                'domain' => 'attention', 'skill_name' => 'selective_attention', 'difficulty' => 1, 'grade_band' => 'upper',
                'type' => 'multiple_choice',
                'instructions_es' => 'Elige el que NO es un tipo de gobierno.',
                'instructions_en' => 'Choose the one that is NOT a type of government.',
                'content' => [
                    'passage' => null,
                    'question' => '¿Cuál de estos NO es un tipo de gobierno?',
                    'options' => [
                        ['id' => 'a', 'text' => 'Democracia', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Teocracia', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Oligarquía', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Fotosíntesis', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'd'],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'sustained_attention', 'difficulty' => 1, 'grade_band' => 'upper',
                'type' => 'tap_sequence',
                'instructions_es' => 'Toca solo los conceptos de economía en orden de aparición.',
                'instructions_en' => 'Tap only the economics concepts in order of appearance.',
                'content' => [
                    'instructions' => 'Toca solo los conceptos relacionados con economía.',
                    'items' => [
                        ['id' => 'item_1', 'text' => 'Inflación'],
                        ['id' => 'item_2', 'text' => 'Mitosis'],
                        ['id' => 'item_3', 'text' => 'PIB'],
                        ['id' => 'item_4', 'text' => 'Cromosoma'],
                        ['id' => 'item_5', 'text' => 'Déficit fiscal'],
                    ],
                    'time_limit_seconds' => 20,
                ],
                'correct_answer' => ['sequence' => ['item_1', 'item_3', 'item_5']],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'impulse_control', 'difficulty' => 2, 'grade_band' => 'upper',
                'type' => 'multiple_choice',
                'instructions_es' => 'Lee todas las condiciones antes de responder.',
                'instructions_en' => 'Read all conditions before answering.',
                'content' => [
                    'passage' => 'Si un número es primo Y mayor que 10, márcalo con X. Si es primo pero menor o igual a 10, márcalo con O. Si no es primo, ignóralo.',
                    'question' => '¿Cómo marcas el número 13?',
                    'options' => [
                        ['id' => 'a', 'text' => 'Con O', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Con X', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Lo ignoras', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Con ambos símbolos', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'filtering_distractions', 'difficulty' => 2, 'grade_band' => 'upper',
                'type' => 'multiple_choice',
                'instructions_es' => 'Usa solo los datos relevantes para resolver.',
                'instructions_en' => 'Use only the relevant data to solve.',
                'content' => [
                    'passage' => 'El tren A sale a las 9:00 y viaja a 80 km/h. El tren B sale a las 10:00 y viaja a 100 km/h. Ambos van a la misma ciudad a 200 km. La temperatura ese día era de 22 °C.',
                    'question' => '¿A qué hora llega el tren A a su destino?',
                    'options' => [
                        ['id' => 'a', 'text' => '11:00', 'image_url' => null],
                        ['id' => 'b', 'text' => '11:30', 'image_url' => null],
                        ['id' => 'c', 'text' => '12:00', 'image_url' => null],
                        ['id' => 'd', 'text' => '10:30', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'speed_accuracy', 'difficulty' => 3, 'grade_band' => 'upper',
                'type' => 'tap_sequence',
                'instructions_es' => 'Ordena los elementos por número atómico ascendente.',
                'instructions_en' => 'Order the elements by ascending atomic number.',
                'content' => [
                    'instructions' => 'Toca en orden de número atómico de menor a mayor.',
                    'items' => [
                        ['id' => 'item_1', 'text' => 'Carbono (6)'],
                        ['id' => 'item_2', 'text' => 'Helio (2)'],
                        ['id' => 'item_3', 'text' => 'Oxígeno (8)'],
                        ['id' => 'item_4', 'text' => 'Hidrógeno (1)'],
                        ['id' => 'item_5', 'text' => 'Nitrógeno (7)'],
                    ],
                    'time_limit_seconds' => 20,
                ],
                'correct_answer' => ['sequence' => ['item_4', 'item_2', 'item_1', 'item_5', 'item_3']],
            ],
            // ---- REASONING ----
            [
                'domain' => 'reasoning', 'skill_name' => 'classification', 'difficulty' => 1, 'grade_band' => 'upper',
                'type' => 'drag_to_sort',
                'instructions_es' => 'Clasifica según tipo de razonamiento.',
                'instructions_en' => 'Classify by type of reasoning.',
                'content' => [
                    'instructions' => 'Arrastra cada concepto al tipo de razonamiento correcto.',
                    'items' => [
                        ['id' => 'item_1', 'text' => 'Ad hominem', 'image_url' => null],
                        ['id' => 'item_2', 'text' => 'Modus ponens', 'image_url' => null],
                        ['id' => 'item_3', 'text' => 'Pendiente resbaladiza', 'image_url' => null],
                        ['id' => 'item_4', 'text' => 'Silogismo válido', 'image_url' => null],
                    ],
                    'zones' => [
                        ['id' => 'zone_a', 'label' => 'Falacia'],
                        ['id' => 'zone_b', 'label' => 'Razonamiento válido'],
                    ],
                ],
                'correct_answer' => ['zones' => ['zone_a' => ['item_1', 'item_3'], 'zone_b' => ['item_2', 'item_4']]],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'analogies', 'difficulty' => 2, 'grade_band' => 'upper',
                'type' => 'multiple_choice',
                'instructions_es' => 'Completa la analogía conceptual.',
                'instructions_en' => 'Complete the conceptual analogy.',
                'content' => [
                    'passage' => null,
                    'question' => 'Feudalismo es a Edad Media, como Capitalismo es a ___.',
                    'options' => [
                        ['id' => 'a', 'text' => 'Edad Antigua', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Revolución Industrial', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Prehistoria', 'image_url' => null],
                        ['id' => 'd', 'text' => 'Renacimiento', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'patterns', 'difficulty' => 1, 'grade_band' => 'upper',
                'type' => 'multiple_choice',
                'instructions_es' => 'Completa la progresión geométrica.',
                'instructions_en' => 'Complete the geometric progression.',
                'content' => [
                    'passage' => null,
                    'question' => '2, 6, 18, 54, ___',
                    'options' => [
                        ['id' => 'a', 'text' => '108', 'image_url' => null],
                        ['id' => 'b', 'text' => '162', 'image_url' => null],
                        ['id' => 'c', 'text' => '72', 'image_url' => null],
                        ['id' => 'd', 'text' => '216', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'cause_effect', 'difficulty' => 2, 'grade_band' => 'upper',
                'type' => 'multiple_choice',
                'instructions_es' => 'Identifica el efecto más probable a largo plazo.',
                'instructions_en' => 'Identify the most likely long-term effect.',
                'content' => [
                    'passage' => 'Durante años, una empresa descargó residuos químicos en el río local. La concentración de toxinas aumentó gradualmente en el agua.',
                    'question' => '¿Cuál sería el efecto más probable a largo plazo?',
                    'options' => [
                        ['id' => 'a', 'text' => 'El río se limpiaría solo de manera natural', 'image_url' => null],
                        ['id' => 'b', 'text' => 'Las especies acuáticas disminuirían significativamente', 'image_url' => null],
                        ['id' => 'c', 'text' => 'La empresa aumentaría su producción sin consecuencias', 'image_url' => null],
                        ['id' => 'd', 'text' => 'El agua se volvería más cristalina con el tiempo', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'deductive_logic', 'difficulty' => 3, 'grade_band' => 'upper',
                'type' => 'multiple_choice',
                'instructions_es' => 'Aplica el razonamiento deductivo.',
                'instructions_en' => 'Apply deductive reasoning.',
                'content' => [
                    'passage' => 'Ningún reptil es de sangre caliente. La serpiente es un reptil.',
                    'question' => '¿Qué se concluye lógicamente?',
                    'options' => [
                        ['id' => 'a', 'text' => 'Algunas serpientes son de sangre caliente', 'image_url' => null],
                        ['id' => 'b', 'text' => 'La serpiente no es de sangre caliente', 'image_url' => null],
                        ['id' => 'c', 'text' => 'Los reptiles son una clase de mamíferos', 'image_url' => null],
                        ['id' => 'd', 'text' => 'La serpiente puede regular su temperatura', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'problem_solving', 'difficulty' => 3, 'grade_band' => 'upper',
                'type' => 'multiple_choice',
                'instructions_es' => 'Resuelve el problema aplicando porcentajes.',
                'instructions_en' => 'Solve the problem applying percentages.',
                'content' => [
                    'passage' => 'Una tienda ofrece un 20% de descuento. Una chaqueta cuesta $150 antes del descuento.',
                    'question' => '¿Cuánto pagas por la chaqueta con el descuento?',
                    'options' => [
                        ['id' => 'a', 'text' => '$100', 'image_url' => null],
                        ['id' => 'b', 'text' => '$110', 'image_url' => null],
                        ['id' => 'c', 'text' => '$120', 'image_url' => null],
                        ['id' => 'd', 'text' => '$130', 'image_url' => null],
                    ],
                ],
                'correct_answer' => ['correct_option_id' => 'c'],
            ]
        ];
    }
}