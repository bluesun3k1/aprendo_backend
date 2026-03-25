<?php

namespace Database\Seeders;

use Database\Seeders\Traits\InsertsPackActivities;
use Illuminate\Database\Seeder;

/**
 * Grade 5-6 — Math content packs
 *
 * 2 packs: g56_math_part_whole_and_data (M3), g56_math_decimal_money (M6)
 * grade_band = 'upper'  |  domain = 'math'
 */
class ContentPackSeeder_G56Math extends Seeder
{
    use InsertsPackActivities;

    public function run(): void
    {
        // ----------------------------------------------------------------
        // Pack M3 — g56_math_part_whole_and_data  (Wave 1)
        // Primary: fractions, data_analysis
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain'=>'math','skill_name'=>'fractions','grade_band'=>'upper',
                'type'=>'storybook_reading','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Fracciones en la gráfica de la clase',
                'mission_description'=>'Lee y descubre cómo las fracciones representan partes de un todo.',
                'instructions_es'=>'Lee la historia y responde.',
                'content'=>['pages'=>[['id'=>'p1','title'=>'La encuesta de la clase','text'=>'La clase encuestó 24 estudiantes sobre su deporte favorito. 12 eligieron fútbol, 6 natación y 6 béisbol.','image_prompt'=>'pie chart divided into fractions for soccer half, swimming quarter, baseball quarter'],['id'=>'p2','title'=>'Fracciones del total','text'=>'12 de 24 eligieron fútbol: eso es 12/24 = 1/2. 6 de 24 eligieron natación: eso es 6/24 = 1/4.','image_prompt'=>'fraction simplification shown with bar model 12/24 = 1/2']],'question'=>['prompt'=>'¿Qué fracción del total eligió natación?','options'=>[['id'=>'a','text'=>'1/4','image_url'=>null],['id'=>'b','text'=>'1/2','image_url'=>null],['id'=>'c','text'=>'1/6','image_url'=>null]]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'math','skill_name'=>'fractions','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'friendly_challenge',
                'mission_title'=>'Simplifica la fracción',
                'mission_description'=>'Reduce la fracción a su forma más simple.',
                'instructions_es'=>'Lee y escoge la fracción simplificada correcta.',
                'content'=>['passage'=>'En un grupo de 30 estudiantes, 15 prefieren leer en la tarde.','question'=>'¿Qué fracción simplificada representa a los que prefieren leer?','options'=>[['id'=>'a','text'=>'1/2','image_url'=>null],['id'=>'b','text'=>'15/30','image_url'=>null],['id'=>'c','text'=>'3/5','image_url'=>null],['id'=>'d','text'=>'2/3','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'math','skill_name'=>'data_analysis','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'mission',
                'mission_title'=>'Interpreta la gráfica de datos',
                'mission_description'=>'Usa los datos de la gráfica para responder la pregunta.',
                'instructions_es'=>'Lee los datos y escoge la respuesta correcta.',
                'content'=>['passage'=>'Gráfica de barras: Lunes=15, Martes=20, Miércoles=10, Jueves=25, Viernes=30 estudiantes asistieron a la biblioteca.','question'=>'¿Qué día asistió la mayor cantidad de estudiantes?','options'=>[['id'=>'a','text'=>'Viernes (30 estudiantes)','image_url'=>null],['id'=>'b','text'=>'Jueves (25 estudiantes)','image_url'=>null],['id'=>'c','text'=>'Martes (20 estudiantes)','image_url'=>null],['id'=>'d','text'=>'Lunes (15 estudiantes)','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'math','skill_name'=>'fractions','grade_band'=>'upper',
                'type'=>'drag_to_sort','difficulty'=>3,'lesson_mood'=>'puzzle',
                'mission_title'=>'Ordena fracciones de menor a mayor',
                'mission_description'=>'Arrastra las fracciones al grupo correcto según su valor.',
                'instructions_es'=>'Arrastra las fracciones a su grupo.',
                'content'=>['items'=>[['id'=>'item_1','text'=>'1/4','image_url'=>null],['id'=>'item_2','text'=>'3/4','image_url'=>null],['id'=>'item_3','text'=>'1/2','image_url'=>null],['id'=>'item_4','text'=>'1/8','image_url'=>null]],'zones'=>[['id'=>'zone_a','label'=>'Menor que 1/2'],['id'=>'zone_b','label'=>'Mayor o igual que 1/2']],'instructions'=>'Arrastra cada fracción.'],
                'correct_answer'=>['zones'=>['zone_a'=>['item_1','item_4'],'zone_b'=>['item_2','item_3']]],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack M6 — g56_math_decimal_money  (Wave 2)
        // Primary: decimals, operations_with_decimals
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain'=>'math','skill_name'=>'decimals','grade_band'=>'upper',
                'type'=>'storybook_reading','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Los decimales en la feria de la escuela',
                'mission_description'=>'Lee y descubre cómo los decimales aparecen en el dinero.',
                'instructions_es'=>'Lee la historia y responde.',
                'content'=>['pages'=>[['id'=>'p1','title'=>'Los precios de la feria','text'=>'En la feria escolar una limonada cuesta $1.50 y un sándwich $3.75. Los precios usan decimales para los centavos.','image_prompt'=>'school fair stand with price tags showing $1.50 and $3.75'],['id'=>'p2','title'=>'Sumando precios','text'=>'$1.50 + $3.75 = $5.25. El punto separa los dólares de los centavos.','image_prompt'=>'addition of $1.50 + $3.75 = $5.25 shown on receipt']],'question'=>['prompt'=>'¿Cuánto cuestan juntos la limonada y el sándwich?','options'=>[['id'=>'a','text'=>'$5.25','image_url'=>null],['id'=>'b','text'=>'$4.25','image_url'=>null],['id'=>'c','text'=>'$5.75','image_url'=>null]]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'math','skill_name'=>'decimals','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'friendly_challenge',
                'mission_title'=>'Compara precios decimales',
                'mission_description'=>'Determina cuál precio es mayor.',
                'instructions_es'=>'Lee y escoge la respuesta correcta.',
                'content'=>['passage'=>'Producto A: $4.80. Producto B: $4.08.','question'=>'¿Cuál producto es más caro?','options'=>[['id'=>'a','text'=>'Producto A ($4.80)','image_url'=>null],['id'=>'b','text'=>'Producto B ($4.08)','image_url'=>null],['id'=>'c','text'=>'Son exactamente iguales.','image_url'=>null],['id'=>'d','text'=>'No se puede comparar.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'math','skill_name'=>'operations_with_decimals','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'mission',
                'mission_title'=>'Calcula el cambio en la feria',
                'mission_description'=>'Resta los decimales para encontrar el cambio.',
                'instructions_es'=>'Lee y escoge la respuesta correcta.',
                'content'=>['passage'=>'Pagas con $10.00 y tu compra cuesta $6.45.','question'=>'¿Cuánto de cambio recibes?','options'=>[['id'=>'a','text'=>'$3.55','image_url'=>null],['id'=>'b','text'=>'$3.45','image_url'=>null],['id'=>'c','text'=>'$4.55','image_url'=>null],['id'=>'d','text'=>'$16.45','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'math','skill_name'=>'decimals','grade_band'=>'upper',
                'type'=>'drag_to_sort','difficulty'=>3,'lesson_mood'=>'puzzle',
                'mission_title'=>'Clasifica: mayor o menor que $5.00',
                'mission_description'=>'Arrastra cada precio al grupo correcto.',
                'instructions_es'=>'Arrastra cada precio a su grupo.',
                'content'=>['items'=>[['id'=>'item_1','text'=>'$3.99','image_url'=>null],['id'=>'item_2','text'=>'$7.50','image_url'=>null],['id'=>'item_3','text'=>'$4.99','image_url'=>null],['id'=>'item_4','text'=>'$5.01','image_url'=>null]],'zones'=>[['id'=>'zone_a','label'=>'Menor que $5.00'],['id'=>'zone_b','label'=>'Mayor que $5.00']],'instructions'=>'Arrastra cada precio.'],
                'correct_answer'=>['zones'=>['zone_a'=>['item_1','item_3'],'zone_b'=>['item_2','item_4']]],
            ],
        ]);

        $this->command->info('G56 Math: 2 packs seeded.');
    }
}
