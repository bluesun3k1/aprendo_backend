<?php

namespace Database\Seeders;

use Database\Seeders\Traits\InsertsPackActivities;
use Illuminate\Database\Seeder;

/**
 * Grade 3-4 — Math content packs
 *
 * 2 packs: g34_math_equal_groups (M2), g34_math_share_and_divide (M5)
 * grade_band = 'middle'  |  domain = 'math'
 */
class ContentPackSeeder_G34Math extends Seeder
{
    use InsertsPackActivities;

    public function run(): void
    {
        // ----------------------------------------------------------------
        // Pack M2 — g34_math_equal_groups  (Wave 1)
        // Primary: multiplication, number_sense
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain'=>'math','skill_name'=>'multiplication','grade_band'=>'middle',
                'type'=>'storybook_reading','difficulty'=>2,'lesson_mood'=>'curious',
                'mission_title'=>'Los grupos iguales de Ana',
                'mission_description'=>'Lee y descubre cómo los grupos iguales llevan a la multiplicación.',
                'instructions_es'=>'Lee la historia y responde la pregunta.',
                'content'=>['pages'=>[['id'=>'p1','title'=>'Los grupos de Ana','text'=>'Ana organizó sus estampas en 4 grupos iguales. Cada grupo tenía 6 estampas. ¿Cuántas estampas tiene en total?','image_prompt'=>'4 equal groups of 6 stickers arranged on a table'],['id'=>'p2','title'=>'Multiplicar es más rápido','text'=>'En vez de sumar 6+6+6+6, Ana aprendió que 4 × 6 = 24. ¡La multiplicación es una suma rápida!','image_prompt'=>'equation 4 x 6 = 24 shown with groups of objects']],'question'=>['prompt'=>'¿Cuántas estampas tiene Ana en total?','options'=>[['id'=>'a','text'=>'24 estampas','image_url'=>null],['id'=>'b','text'=>'10 estampas','image_url'=>null],['id'=>'c','text'=>'46 estampas','image_url'=>null]]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'math','skill_name'=>'multiplication','grade_band'=>'middle',
                'type'=>'multiple_choice','difficulty'=>2,'lesson_mood'=>'friendly_challenge',
                'mission_title'=>'Calcula grupos iguales',
                'mission_description'=>'Usa la multiplicación para calcular el total.',
                'instructions_es'=>'Lee y escoge la respuesta correcta.',
                'content'=>['passage'=>'Hay 3 cajas con 8 lápices cada una.','question'=>'¿Cuántos lápices hay en total?','options'=>[['id'=>'a','text'=>'24','image_url'=>null],['id'=>'b','text'=>'11','image_url'=>null],['id'=>'c','text'=>'38','image_url'=>null],['id'=>'d','text'=>'16','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'math','skill_name'=>'number_sense','grade_band'=>'middle',
                'type'=>'drag_to_sort','difficulty'=>2,'lesson_mood'=>'puzzle',
                'mission_title'=>'Clasifica multiplicaciones y sus resultados',
                'mission_description'=>'Arrastra cada operación al grupo correcto según si su resultado es mayor o menor que 20.',
                'instructions_es'=>'Arrastra cada operación a su grupo.',
                'content'=>['items'=>[['id'=>'item_1','text'=>'3 × 5 = 15','image_url'=>null],['id'=>'item_2','text'=>'4 × 6 = 24','image_url'=>null],['id'=>'item_3','text'=>'2 × 7 = 14','image_url'=>null],['id'=>'item_4','text'=>'5 × 5 = 25','image_url'=>null]],'zones'=>[['id'=>'zone_a','label'=>'Resultado menor que 20'],['id'=>'zone_b','label'=>'Resultado mayor que 20']],'instructions'=>'Arrastra cada operación.'],
                'correct_answer'=>['zones'=>['zone_a'=>['item_1','item_3'],'zone_b'=>['item_2','item_4']]],
            ],
            [
                'domain'=>'math','skill_name'=>'multiplication','grade_band'=>'middle',
                'type'=>'multiple_choice','difficulty'=>2,'lesson_mood'=>'mission',
                'mission_title'=>'¿Cuál multiplicación describe el problema?',
                'mission_description'=>'Elige la multiplicación que corresponde a la situación.',
                'instructions_es'=>'Lee y escoge la multiplicación correcta.',
                'content'=>['passage'=>'En el jardín hay 5 filas de plantas con 7 plantas en cada fila.','question'=>'¿Cuál multiplicación describe la situación?','options'=>[['id'=>'a','text'=>'5 × 7','image_url'=>null],['id'=>'b','text'=>'5 + 7','image_url'=>null],['id'=>'c','text'=>'7 − 5','image_url'=>null],['id'=>'d','text'=>'5 × 5','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack M5 — g34_math_share_and_divide  (Wave 2)
        // Primary: division, multiplication
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain'=>'math','skill_name'=>'division','grade_band'=>'middle',
                'type'=>'storybook_reading','difficulty'=>2,'lesson_mood'=>'curious',
                'mission_title'=>'Repartir en partes iguales',
                'mission_description'=>'Lee y descubre cómo la división reparte en grupos iguales.',
                'instructions_es'=>'Lee la historia y responde.',
                'content'=>['pages'=>[['id'=>'p1','title'=>'Las galletas de Tomás','text'=>'Tomás tiene 20 galletas y quiere repartirlas en 4 grupos iguales para sus amigos. ¿Cuántas le tocan a cada uno?','image_prompt'=>'20 cookies being divided equally into 4 groups'],['id'=>'p2','title'=>'Dividir es repartir','text'=>'20 ÷ 4 = 5. A cada amigo le tocan 5 galletas. Dividir significa repartir de forma justa.','image_prompt'=>'equation 20 divided by 4 equals 5 with cookie illustration']],'question'=>['prompt'=>'¿Cuántas galletas le tocan a cada amigo?','options'=>[['id'=>'a','text'=>'5 galletas','image_url'=>null],['id'=>'b','text'=>'4 galletas','image_url'=>null],['id'=>'c','text'=>'20 galletas','image_url'=>null]]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'math','skill_name'=>'division','grade_band'=>'middle',
                'type'=>'multiple_choice','difficulty'=>2,'lesson_mood'=>'friendly_challenge',
                'mission_title'=>'Calcula la división',
                'mission_description'=>'Resuelve la división para repartir en partes iguales.',
                'instructions_es'=>'Lee y escoge la respuesta correcta.',
                'content'=>['passage'=>'Hay 36 libros para repartir en 6 estantes iguales.','question'=>'¿Cuántos libros caben en cada estante?','options'=>[['id'=>'a','text'=>'6','image_url'=>null],['id'=>'b','text'=>'7','image_url'=>null],['id'=>'c','text'=>'30','image_url'=>null],['id'=>'d','text'=>'42','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'math','skill_name'=>'multiplication','grade_band'=>'middle',
                'type'=>'multiple_choice','difficulty'=>2,'lesson_mood'=>'curious',
                'mission_title'=>'Relaciona multiplicación y división',
                'mission_description'=>'Usa la multiplicación para verificar la división.',
                'instructions_es'=>'Lee y escoge la operación relacionada.',
                'content'=>['passage'=>'Sabes que 24 ÷ 6 = 4.','question'=>'¿Cuál multiplicación está relacionada con esa división?','options'=>[['id'=>'a','text'=>'6 × 4 = 24','image_url'=>null],['id'=>'b','text'=>'6 + 4 = 10','image_url'=>null],['id'=>'c','text'=>'24 × 6 = 144','image_url'=>null],['id'=>'d','text'=>'4 × 4 = 16','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'math','skill_name'=>'division','grade_band'=>'middle',
                'type'=>'tap_sequence','difficulty'=>2,'lesson_mood'=>'mission',
                'mission_title'=>'Ordena los pasos para dividir',
                'mission_description'=>'Toca los pasos en el orden correcto para resolver 28 ÷ 7.',
                'instructions_es'=>'Toca los pasos en orden.',
                'duration_seconds'=>25,
                'content'=>['items'=>[['id'=>'item_1','text'=>'Identifico que debo repartir 28 en grupos de 7'],['id'=>'item_2','text'=>'Cuento cuántas veces cabe 7 en 28'],['id'=>'item_3','text'=>'El resultado es 4']],'instructions'=>'Toca los pasos en orden.','time_limit_seconds'=>25],
                'correct_answer'=>['sequence'=>['item_1','item_2','item_3']],
            ],
        ]);

        $this->command->info('G34 Math: 2 packs seeded.');
    }
}
