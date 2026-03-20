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
        // DIAGNOSTIC activities — 3 per domain × 3 difficulties = 9 total
        // ---------------------------------------------------------------
        $this->seedDiagnosticActivities();

        // ---------------------------------------------------------------
        // REGULAR session activities — at least 20 across all domains
        // ---------------------------------------------------------------
        $this->seedSessionActivities();
    }

    // -------------------------------------------------------------------
    // DIAGNOSTIC
    // -------------------------------------------------------------------
    private function seedDiagnosticActivities(): void
    {
        $diagnosticActivities = [
            // ---- READING ----
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'difficulty' => 1,
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
                'is_diagnostic' => true,
            ],
            [
                'domain' => 'reading', 'skill_name' => 'inference', 'difficulty' => 2,
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
                'is_diagnostic' => true,
            ],
            [
                'domain' => 'reading', 'skill_name' => 'fact_vs_opinion', 'difficulty' => 3,
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
                'is_diagnostic' => true,
            ],

            // ---- ATTENTION ----
            [
                'domain' => 'attention', 'skill_name' => 'selective_attention', 'difficulty' => 1,
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
                'is_diagnostic' => true,
            ],
            [
                'domain' => 'attention', 'skill_name' => 'instruction_following', 'difficulty' => 2,
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
                'is_diagnostic' => true,
            ],
            [
                'domain' => 'attention', 'skill_name' => 'visual_discrimination', 'difficulty' => 3,
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
                'is_diagnostic' => true,
            ],

            // ---- REASONING ----
            [
                'domain' => 'reasoning', 'skill_name' => 'classification', 'difficulty' => 1,
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
                'is_diagnostic' => true,
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'patterns', 'difficulty' => 2,
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
                'is_diagnostic' => true,
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'cause_effect', 'difficulty' => 3,
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
                'is_diagnostic' => true,
            ],
        ];

        foreach ($diagnosticActivities as $data) {
            $skill = Skill::whereHas('domain', fn ($q) => $q->where('id', $data['domain']))
                ->where('name', $data['skill_name'])
                ->first();

            if (!$skill) continue;

            $existing = Activity::where('skill_id', $skill->id)
                ->where('difficulty', $data['difficulty'])
                ->where('is_diagnostic', true)
                ->first();

            if (!$existing) {
                Activity::create([
                    'id'               => Str::uuid(),
                    'skill_id'         => $skill->id,
                    'type'             => $data['type'],
                    'difficulty'       => $data['difficulty'],
                    'instructions_es'  => $data['instructions_es'],
                    'instructions_en'  => $data['instructions_en'],
                    'content'          => $data['content'],
                    'correct_answer'   => $data['correct_answer'],
                    'is_diagnostic'    => true,
                    'is_active'        => true,
                ]);
            }
        }
    }

    // -------------------------------------------------------------------
    // SESSION ACTIVITIES
    // -------------------------------------------------------------------
    private function seedSessionActivities(): void
    {
        $activities = [
            // ---- READING ----
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'difficulty' => 1,
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
                'domain' => 'reading', 'skill_name' => 'sequencing', 'difficulty' => 1,
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
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'difficulty' => 2,
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
                'domain' => 'reading', 'skill_name' => 'compare_contrast', 'difficulty' => 2,
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
                'domain' => 'reading', 'skill_name' => 'inference', 'difficulty' => 3,
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
                'domain' => 'reading', 'skill_name' => 'summarization', 'difficulty' => 3,
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
                'domain' => 'attention', 'skill_name' => 'selective_attention', 'difficulty' => 1,
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
                'domain' => 'attention', 'skill_name' => 'sustained_attention', 'difficulty' => 1,
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
                'domain' => 'attention', 'skill_name' => 'impulse_control', 'difficulty' => 2,
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
                'domain' => 'attention', 'skill_name' => 'filtering_distractions', 'difficulty' => 2,
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
                'domain' => 'attention', 'skill_name' => 'speed_accuracy', 'difficulty' => 3,
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
                'domain' => 'reasoning', 'skill_name' => 'classification', 'difficulty' => 1,
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
                'domain' => 'reasoning', 'skill_name' => 'analogies', 'difficulty' => 2,
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
                'domain' => 'reasoning', 'skill_name' => 'patterns', 'difficulty' => 1,
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
                'domain' => 'reasoning', 'skill_name' => 'cause_effect', 'difficulty' => 2,
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
                'domain' => 'reasoning', 'skill_name' => 'deductive_logic', 'difficulty' => 3,
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
                'domain' => 'reasoning', 'skill_name' => 'problem_solving', 'difficulty' => 3,
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

        foreach ($activities as $data) {
            $skill = Skill::whereHas('domain', fn ($q) => $q->where('id', $data['domain']))
                ->where('name', $data['skill_name'])
                ->first();

            if (!$skill) continue;

            // Avoid exact duplicates per skill/difficulty/type (for session activities)
            $existing = Activity::where('skill_id', $skill->id)
                ->where('difficulty', $data['difficulty'])
                ->where('type', $data['type'])
                ->where('is_diagnostic', false)
                ->first();

            if (!$existing) {
                Activity::create([
                    'id'               => Str::uuid(),
                    'skill_id'         => $skill->id,
                    'type'             => $data['type'],
                    'difficulty'       => $data['difficulty'],
                    'instructions_es'  => $data['instructions_es'],
                    'instructions_en'  => $data['instructions_en'],
                    'content'          => $data['content'],
                    'correct_answer'   => $data['correct_answer'],
                    'is_diagnostic'    => false,
                    'is_active'        => true,
                ]);
            }
        }
    }
}
