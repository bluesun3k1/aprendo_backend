<?php

namespace Database\Seeders;

use Database\Seeders\Traits\InsertsPackActivities;
use Illuminate\Database\Seeder;

/**
 * Grade 2 — Math content packs
 *
 * 2 packs: g2_math_number_friends (M1), g2_math_place_value_blocks (M4)
 * grade_band = 'early'  |  domain = 'math'
 */
class ContentPackSeeder_G2Math extends Seeder
{
    use InsertsPackActivities;

    public function run(): void
    {
        // ----------------------------------------------------------------
        // Pack M1 — g2_math_number_friends  (Wave 1)
        // Primary: number_sense, addition_subtraction
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain'=>'math','skill_name'=>'number_sense','grade_band'=>'early',
                'type'=>'storybook_reading','difficulty'=>1,'lesson_mood'=>'curious',
                'mission_title'=>'Conoce los amigos del número 10',
                'mission_description'=>'Lee y descubre cómo los números forman parejas que suman 10.',
                'instructions_es'=>'Lee la historia y responde la pregunta.',
                'content'=>['pages'=>[['id'=>'p1','title'=>'Los amigos del 10','text'=>'Cada número tiene un amigo especial. El 6 y el 4 son amigos porque juntos suman 10.','image_prompt'=>'number 6 and number 4 as cartoon characters holding hands, equals 10 above them'],['id'=>'p2','title'=>'Más parejas','text'=>'El 7 y el 3 también son amigos del 10. ¿Cuáles otras parejas conoces?','image_prompt'=>'number pairs 7 and 3, 8 and 2 illustrated as friends']],'question'=>['prompt'=>'¿Cuáles números son amigos porque suman 10?','options'=>[['id'=>'a','text'=>'6 y 4','image_url'=>null],['id'=>'b','text'=>'6 y 5','image_url'=>null],['id'=>'c','text'=>'3 y 5','image_url'=>null]]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'math','skill_name'=>'addition_subtraction','grade_band'=>'early',
                'type'=>'multiple_choice','difficulty'=>1,'lesson_mood'=>'friendly_challenge',
                'mission_title'=>'Completa la pareja del 10',
                'mission_description'=>'Encuentra qué número falta para llegar a 10.',
                'instructions_es'=>'Lee y escoge el número que falta.',
                'content'=>['passage'=>'8 + ___ = 10','question'=>'¿Qué número completa la suma?','options'=>[['id'=>'a','text'=>'2','image_url'=>null],['id'=>'b','text'=>'3','image_url'=>null],['id'=>'c','text'=>'4','image_url'=>null],['id'=>'d','text'=>'1','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'math','skill_name'=>'number_sense','grade_band'=>'early',
                'type'=>'tap_sequence','difficulty'=>1,'lesson_mood'=>'mission',
                'mission_title'=>'Ordena las parejas del 10',
                'mission_description'=>'Toca las parejas en orden de menor a mayor.',
                'instructions_es'=>'Toca las parejas en el orden correcto.',
                'duration_seconds'=>25,
                'content'=>['items'=>[['id'=>'item_1','text'=>'1 y 9'],['id'=>'item_2','text'=>'3 y 7'],['id'=>'item_3','text'=>'5 y 5']],'instructions'=>'Toca en orden: la pareja donde el primer número es menor primero.','time_limit_seconds'=>25],
                'correct_answer'=>['sequence'=>['item_1','item_2','item_3']],
            ],
            [
                'domain'=>'math','skill_name'=>'addition_subtraction','grade_band'=>'early',
                'type'=>'multiple_choice','difficulty'=>1,'lesson_mood'=>'puzzle',
                'mission_title'=>'La pareja que sobra',
                'mission_description'=>'Encuentra cuál pareja NO suma 10.',
                'instructions_es'=>'Escoge la pareja que NO suma 10.',
                'content'=>['passage'=>null,'question'=>'¿Cuál pareja NO suma 10?','options'=>[['id'=>'a','text'=>'4 y 7','image_url'=>null],['id'=>'b','text'=>'3 y 7','image_url'=>null],['id'=>'c','text'=>'6 y 4','image_url'=>null],['id'=>'d','text'=>'2 y 8','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack M4 — g2_math_place_value_blocks  (Wave 2)
        // Primary: place_value, number_sense
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain'=>'math','skill_name'=>'place_value','grade_band'=>'early',
                'type'=>'storybook_reading','difficulty'=>1,'lesson_mood'=>'curious',
                'mission_title'=>'Las torres de bloques de lugar',
                'mission_description'=>'Lee y descubre cómo funcionan las decenas y unidades.',
                'instructions_es'=>'Lee la historia y responde.',
                'content'=>['pages'=>[['id'=>'p1','title'=>'Decenas y unidades','text'=>'Una torre de 10 bloques es una decena. Los bloques sueltos son unidades. El número 23 tiene 2 decenas y 3 unidades.','image_prompt'=>'base-10 blocks showing 2 tens rods and 3 unit cubes for the number 23'],['id'=>'p2','title'=>'Construye con bloques','text'=>'Para construir el 35 necesitas 3 torres (decenas) y 5 bloques sueltos (unidades).','image_prompt'=>'base-10 blocks showing 3 tens rods and 5 unit cubes for number 35']],'question'=>['prompt'=>'¿Cuántas decenas y unidades tiene el 23?','options'=>[['id'=>'a','text'=>'2 decenas y 3 unidades','image_url'=>null],['id'=>'b','text'=>'3 decenas y 2 unidades','image_url'=>null],['id'=>'c','text'=>'0 decenas y 23 unidades','image_url'=>null]]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'math','skill_name'=>'place_value','grade_band'=>'early',
                'type'=>'multiple_choice','difficulty'=>1,'lesson_mood'=>'friendly_challenge',
                'mission_title'=>'¿Cuántos bloques necesitas?',
                'mission_description'=>'Decide cuántas decenas y unidades forman el número.',
                'instructions_es'=>'Lee y escoge la respuesta correcta.',
                'content'=>['passage'=>'El número 47 tiene ___ decenas y ___ unidades.','question'=>'¿Cuál es la respuesta correcta?','options'=>[['id'=>'a','text'=>'4 decenas y 7 unidades','image_url'=>null],['id'=>'b','text'=>'7 decenas y 4 unidades','image_url'=>null],['id'=>'c','text'=>'4 decenas y 4 unidades','image_url'=>null],['id'=>'d','text'=>'0 decenas y 47 unidades','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'math','skill_name'=>'number_sense','grade_band'=>'early',
                'type'=>'drag_to_sort','difficulty'=>1,'lesson_mood'=>'puzzle',
                'mission_title'=>'Clasifica decenas y unidades',
                'mission_description'=>'Arrastra cada bloque al grupo correcto.',
                'instructions_es'=>'Arrastra cada número a decenas o unidades.',
                'content'=>['items'=>[['id'=>'item_1','text'=>'El 5 en el número 52','image_url'=>null],['id'=>'item_2','text'=>'El 2 en el número 52','image_url'=>null],['id'=>'item_3','text'=>'El 3 en el número 31','image_url'=>null],['id'=>'item_4','text'=>'El 1 en el número 31','image_url'=>null]],'zones'=>[['id'=>'zone_a','label'=>'Decenas'],['id'=>'zone_b','label'=>'Unidades']],'instructions'=>'Arrastra cada uno.'],
                'correct_answer'=>['zones'=>['zone_a'=>['item_1','item_3'],'zone_b'=>['item_2','item_4']]],
            ],
            [
                'domain'=>'math','skill_name'=>'place_value','grade_band'=>'early',
                'type'=>'multiple_choice','difficulty'=>1,'lesson_mood'=>'mission',
                'mission_title'=>'¿Cuál número forman los bloques?',
                'mission_description'=>'Cuenta los bloques y encuentra el número.',
                'instructions_es'=>'Lee y escoge el número correcto.',
                'content'=>['passage'=>'Tienes 6 torres de decenas y 8 bloques sueltos de unidades.','question'=>'¿Qué número forman?','options'=>[['id'=>'a','text'=>'68','image_url'=>null],['id'=>'b','text'=>'86','image_url'=>null],['id'=>'c','text'=>'608','image_url'=>null],['id'=>'d','text'=>'14','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
        ]);

        $this->command->info('G2 Math: 2 packs seeded.');
    }
}
