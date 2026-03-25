<?php

namespace Database\Seeders;

use Database\Seeders\Traits\InsertsPackActivities;
use Illuminate\Database\Seeder;

/**
 * Grade 2 — Reading content packs
 *
 * Covers 21 packs:
 *   Core (seq 1–10):  g2_school_garden, g2_bus_stop_morning, g2_rainy_day_plans,
 *                     g2_helping_a_friend, g2_class_pet, g2_garden_helpers,
 *                     g2_animal_homes, g2_day_and_night, g2_market_morning,
 *                     g2_rain_after_school
 *   Support (seq 11–21): g2_classroom_rules_day, g2_listen_and_sort, g2_find_the_rule,
 *                        g2_same_and_different, g2_follow_the_clues, g2_sort_the_signs,
 *                        g2_which_one_belongs, g2_rule_or_not, g2_find_the_match,
 *                        g2_same_group, g2_match_the_rule
 *
 * grade_band = 'early'  |  curriculum_unit = early_reading_basics
 */
class ContentPackSeeder_G2Reading extends Seeder
{
    use InsertsPackActivities;

    public function run(): void
    {
        // ----------------------------------------------------------------
        // Pack 1 — g2_school_garden  (core, seq 1, unit_entry)
        // Primary: main_idea, supporting_details, sequencing
        // Secondary: inference, cause_effect
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'early',
                'type' => 'storybook_reading', 'difficulty' => 1,
                'lesson_mood' => 'curious',
                'mission_title' => 'Ayuda a Luna a entender qué pasa en el jardín',
                'mission_description' => 'Lee las páginas, mira las imágenes y descubre el problema del jardín.',
                'instructions_es' => 'Lee la historia y luego responde la pregunta.',
                'content' => ['pages' => [['id'=>'p1','title'=>'Luna mira el jardín','text'=>'Luna caminó por el jardín de la escuela. Las flores estaban inclinadas y la tierra se veía seca.','image_prompt'=>'school garden with drooping flowers and dry soil, child observing'],['id'=>'p2','title'=>'Luna encuentra pistas','text'=>'Luna vio que no había agua cerca de las plantas. Entonces pensó: el jardín necesita ayuda.','image_prompt'=>'child noticing dry plants and missing watering can']],'question'=>['prompt'=>'¿Cuál es el problema principal en la historia?','options'=>[['id'=>'a','text'=>'El jardín necesita agua.','image_url'=>null],['id'=>'b','text'=>'El jardín tiene demasiadas flores.','image_url'=>null],['id'=>'c','text'=>'Luna perdió una regadera.','image_url'=>null]]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Encuentra la pista correcta',
                'mission_description' => 'Busca el detalle que muestra por qué Luna piensa que el jardín necesita ayuda.',
                'instructions_es' => 'Lee y escoge el detalle que apoya la idea principal.',
                'content' => ['passage'=>'Luna vio flores inclinadas, tierra seca y ninguna regadera cerca de las plantas.','question'=>'¿Qué detalle apoya que el jardín necesita agua?','options'=>[['id'=>'a','text'=>'La tierra se veía seca.','image_url'=>null],['id'=>'b','text'=>'Luna fue al jardín.','image_url'=>null],['id'=>'c','text'=>'Había flores de colores.','image_url'=>null],['id'=>'d','text'=>'La escuela tiene un jardín.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'sequencing', 'grade_band' => 'early',
                'type' => 'tap_sequence', 'difficulty' => 1,
                'lesson_mood' => 'mission',
                'mission_title' => 'Pon la historia en orden',
                'mission_description' => 'Toca los eventos en el orden correcto.',
                'instructions_es' => 'Toca los eventos en el orden en que ocurrieron.',
                'duration_seconds' => 25,
                'content' => ['items'=>[['id'=>'item_1','text'=>'La clase regó las plantas'],['id'=>'item_2','text'=>'Luna miró el jardín'],['id'=>'item_3','text'=>'Luna vio la tierra seca']],'instructions'=>'Toca en orden lo que pasó primero, después y al final.','time_limit_seconds'=>25],
                'correct_answer' => ['sequence' => ['item_2','item_3','item_1']],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'inference', 'grade_band' => 'early',
                'type' => 'illustrated_clue', 'difficulty' => 1,
                'lesson_mood' => 'curious',
                'mission_title' => 'Mira la imagen y descubre la pista',
                'mission_description' => 'Usa la imagen y el texto para pensar qué necesitaban las plantas.',
                'instructions_es' => 'Mira la imagen y lee el texto antes de responder.',
                'content' => ['image_url'=>null,'image_prompt'=>'small school garden with dry soil and drooping flowers','passage'=>'Las hojas estaban bajas y la tierra no tenía humedad.','question'=>'¿Qué podemos inferir?','options'=>[['id'=>'a','text'=>'Las plantas necesitaban agua.','image_url'=>null],['id'=>'b','text'=>'Las plantas tenían demasiada sombra.','image_url'=>null],['id'=>'c','text'=>'Las plantas eran nuevas.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'cause_effect', 'grade_band' => 'early',
                'type' => 'drag_to_sort', 'difficulty' => 1,
                'lesson_mood' => 'puzzle',
                'mission_title' => 'Relaciona la causa y el efecto',
                'mission_description' => 'Arrastra cada tarjeta al grupo correcto.',
                'instructions_es' => 'Arrastra cada tarjeta a causa o efecto.',
                'content' => ['items'=>[['id'=>'item_1','text'=>'No había agua en el jardín','image_url'=>null],['id'=>'item_2','text'=>'Las flores se inclinaron','image_url'=>null],['id'=>'item_3','text'=>'La clase regó las plantas','image_url'=>null],['id'=>'item_4','text'=>'El jardín se veía mejor','image_url'=>null]],'zones'=>[['id'=>'zone_a','label'=>'Causa'],['id'=>'zone_b','label'=>'Efecto']],'instructions'=>'Pon cada tarjeta en causa o efecto.'],
                'correct_answer' => ['zones' => ['zone_a'=>['item_1','item_3'],'zone_b'=>['item_2','item_4']]],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack 2 — g2_bus_stop_morning  (core, seq 2, unit_entry)
        // Primary: sequencing, supporting_details, main_idea
        // Secondary: instruction_following, selective_attention
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'early',
                'type' => 'storybook_reading', 'difficulty' => 1,
                'lesson_mood' => 'calm',
                'mission_title' => 'Sigue la rutina segura de Eva',
                'mission_description' => 'Lee la historia y descubre cuál es la idea principal.',
                'instructions_es' => 'Lee la historia y responde la pregunta.',
                'content' => ['pages'=>[['id'=>'p1','title'=>'Eva en la parada','text'=>'Eva llegó a la parada del autobús escolar. Se puso la mochila bien puesta y esperó con calma.','image_prompt'=>'child with backpack waiting at school bus stop'],['id'=>'p2','title'=>'El autobús llega','text'=>'Cuando el autobús se detuvo por completo y se abrió la puerta, Eva subió con cuidado.','image_prompt'=>'school bus stopped with door open, child boarding carefully']],'question'=>['prompt'=>'¿Cuál es la idea principal de la historia?','options'=>[['id'=>'a','text'=>'Eva sigue una rutina segura para tomar el autobús escolar.','image_url'=>null],['id'=>'b','text'=>'El autobús llegó tarde a la parada.','image_url'=>null],['id'=>'c','text'=>'Eva olvidó su mochila en casa.','image_url'=>null]]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'sequencing', 'grade_band' => 'early',
                'type' => 'tap_sequence', 'difficulty' => 1,
                'lesson_mood' => 'mission',
                'mission_title' => 'Ordena los pasos de Eva',
                'mission_description' => 'Toca los pasos en el orden correcto.',
                'instructions_es' => 'Toca los eventos en el orden en que ocurrieron.',
                'duration_seconds' => 25,
                'content' => ['items'=>[['id'=>'item_1','text'=>'Ponerse la mochila'],['id'=>'item_2','text'=>'Esperar en la parada'],['id'=>'item_3','text'=>'Subir al autobús']],'instructions'=>'Toca en orden.','time_limit_seconds'=>25],
                'correct_answer' => ['sequence' => ['item_1','item_2','item_3']],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Encuentra el detalle del autobús',
                'mission_description' => 'Busca el detalle que muestra que Eva fue segura.',
                'instructions_es' => 'Lee y escoge el detalle correcto.',
                'content' => ['passage'=>'Eva esperó con calma y subió cuando el autobús se detuvo por completo.','question'=>'¿Qué detalle muestra que Eva fue segura?','options'=>[['id'=>'a','text'=>'Subió cuando el autobús se detuvo por completo.','image_url'=>null],['id'=>'b','text'=>'El autobús era de color amarillo.','image_url'=>null],['id'=>'c','text'=>'Eva llevaba uniforme.','image_url'=>null],['id'=>'d','text'=>'Había otros niños en la parada.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'instruction_following', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'mission',
                'mission_title' => 'Sigue la instrucción de la parada',
                'mission_description' => 'Lee la regla y decide qué hacer.',
                'instructions_es' => 'Lee la regla y escoge la acción correcta.',
                'content' => ['passage'=>'Regla: Si el autobús todavía se está moviendo, espera. Si el autobús está detenido y la puerta está abierta, sube con cuidado.','question'=>'El autobús se acaba de detener y la puerta se abrió. ¿Qué haces?','options'=>[['id'=>'a','text'=>'Subo con cuidado.','image_url'=>null],['id'=>'b','text'=>'Espero a que llegue otro autobús.','image_url'=>null],['id'=>'c','text'=>'Corro para subir más rápido.','image_url'=>null],['id'=>'d','text'=>'Me quedo esperando aunque la puerta esté abierta.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack 3 — g2_rainy_day_plans  (core, seq 3, unit_core)
        // Primary: sequencing, supporting_details, main_idea
        // Secondary: instruction_following, cause_effect
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'early',
                'type' => 'storybook_reading', 'difficulty' => 1,
                'lesson_mood' => 'calm',
                'mission_title' => 'Descubre qué cambió los planes',
                'mission_description' => 'Lee la historia y encuentra la idea principal.',
                'instructions_es' => 'Lee la historia y responde la pregunta.',
                'content' => ['pages'=>[['id'=>'p1','title'=>'Una mañana lluviosa','text'=>'La clase pensaba jugar afuera, pero comenzó a llover. La maestra cambió los planes rápidamente.','image_prompt'=>'rainy school morning, children looking outside'],['id'=>'p2','title'=>'Adentro está bien','text'=>'Los niños hicieron lectura adentro y estuvieron contentos igual.','image_prompt'=>'children reading inside classroom on rainy day']],'question'=>['prompt'=>'¿Cuál es la idea principal de la historia?','options'=>[['id'=>'a','text'=>'La lluvia cambió los planes y la clase hizo actividades adentro.','image_url'=>null],['id'=>'b','text'=>'A los niños no les gustó leer.','image_url'=>null],['id'=>'c','text'=>'La maestra se fue a casa por la lluvia.','image_url'=>null]]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'sequencing', 'grade_band' => 'early',
                'type' => 'tap_sequence', 'difficulty' => 1,
                'lesson_mood' => 'mission',
                'mission_title' => 'Ordena lo que pasó bajo la lluvia',
                'mission_description' => 'Toca los eventos en el orden correcto.',
                'instructions_es' => 'Toca los eventos en orden.',
                'duration_seconds' => 25,
                'content' => ['items'=>[['id'=>'item_1','text'=>'Los niños hicieron lectura adentro'],['id'=>'item_2','text'=>'Comenzó a llover'],['id'=>'item_3','text'=>'La clase pensaba jugar afuera']],'instructions'=>'Toca en orden.','time_limit_seconds'=>25],
                'correct_answer' => ['sequence' => ['item_3','item_2','item_1']],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Busca el detalle de la lluvia',
                'mission_description' => 'Encuentra qué detalle explica el cambio de planes.',
                'instructions_es' => 'Lee y escoge el detalle correcto.',
                'content' => ['passage'=>'La clase quería jugar afuera pero la lluvia cambió todo.','question'=>'¿Qué hizo cambiar los planes de la clase?','options'=>[['id'=>'a','text'=>'Cayó lluvia.','image_url'=>null],['id'=>'b','text'=>'La maestra se olvidó de salir.','image_url'=>null],['id'=>'c','text'=>'El patio estaba cerrado.','image_url'=>null],['id'=>'d','text'=>'Los niños no querían jugar.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'cause_effect', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'curious',
                'mission_title' => 'Relaciona causa y efecto en la lluvia',
                'mission_description' => 'Piensa qué pasó porque llovió.',
                'instructions_es' => 'Lee y escoge la consecuencia correcta.',
                'content' => ['passage'=>'Comenzó a llover fuerte antes de que salieran al recreo.','question'=>'¿Qué pasó como consecuencia de la lluvia?','options'=>[['id'=>'a','text'=>'La clase se quedó adentro a leer.','image_url'=>null],['id'=>'b','text'=>'Los niños corrieron más rápido afuera.','image_url'=>null],['id'=>'c','text'=>'La maestra canceló todas las clases.','image_url'=>null],['id'=>'d','text'=>'El autobús llegó tarde.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack 4 — g2_helping_a_friend  (core, seq 4, unit_core)
        // Primary: main_idea, cause_effect, sequencing
        // Secondary: supporting_details, decision_making
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'early',
                'type' => 'storybook_reading', 'difficulty' => 1,
                'lesson_mood' => 'calm',
                'mission_title' => 'Mira cómo Nora ayuda a Mateo',
                'mission_description' => 'Lee la historia y encuentra la idea principal.',
                'instructions_es' => 'Lee la historia y responde la pregunta.',
                'content' => ['pages'=>[['id'=>'p1','title'=>'Los papeles de Mateo','text'=>'Mateo dejó caer sus papeles al piso. Nora lo vio y se detuvo para ayudarlo a recogerlos.','image_prompt'=>'child dropping papers, another child stopping to help pick them up'],['id'=>'p2','title'=>'Listos para continuar','text'=>'Juntos recogieron todo. Los dos quedaron listos para seguir el día.','image_prompt'=>'two children smiling after collecting papers together']],'question'=>['prompt'=>'¿Cuál es la idea principal de la historia?','options'=>[['id'=>'a','text'=>'Nora ayuda a un amigo que tiene un problema.','image_url'=>null],['id'=>'b','text'=>'Mateo perdió todos sus libros.','image_url'=>null],['id'=>'c','text'=>'Nora necesitaba ayuda de Mateo.','image_url'=>null]]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'cause_effect', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'curious',
                'mission_title' => '¿Por qué Nora se detuvo?',
                'mission_description' => 'Piensa qué causó la acción de Nora.',
                'instructions_es' => 'Lee y escoge la causa correcta.',
                'content' => ['passage'=>'Mateo dejó caer sus papeles y Nora se detuvo para ayudarlo.','question'=>'¿Por qué Nora se detuvo?','options'=>[['id'=>'a','text'=>'Porque Mateo dejó caer sus papeles.','image_url'=>null],['id'=>'b','text'=>'Porque la maestra le pidió parar.','image_url'=>null],['id'=>'c','text'=>'Porque Nora también dejó caer algo.','image_url'=>null],['id'=>'d','text'=>'Porque sonó el timbre.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'sequencing', 'grade_band' => 'early',
                'type' => 'tap_sequence', 'difficulty' => 1,
                'lesson_mood' => 'mission',
                'mission_title' => 'Ordena lo que pasó con Mateo y Nora',
                'mission_description' => 'Toca los eventos en el orden correcto.',
                'instructions_es' => 'Toca los eventos en orden.',
                'duration_seconds' => 25,
                'content' => ['items'=>[['id'=>'item_1','text'=>'Mateo dejó caer sus papeles'],['id'=>'item_2','text'=>'Nora ayudó a recoger'],['id'=>'item_3','text'=>'Los dos quedaron listos']],'instructions'=>'Toca en orden.','time_limit_seconds'=>25],
                'correct_answer' => ['sequence' => ['item_1','item_2','item_3']],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'decision_making', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Decide qué haría Nora',
                'mission_description' => 'Piensa cuál sería la mejor decisión de Nora.',
                'instructions_es' => 'Lee y escoge la mejor decisión.',
                'content' => ['passage'=>'Mateo dejó caer sus papeles y nadie más lo vio. Nora está cerca.','question'=>'¿Qué debería hacer Nora?','options'=>[['id'=>'a','text'=>'Ayudar a recogerlos rápidamente.','image_url'=>null],['id'=>'b','text'=>'Ignorar a Mateo y seguir caminando.','image_url'=>null],['id'=>'c','text'=>'Reírse de Mateo.','image_url'=>null],['id'=>'d','text'=>'Esperar a que llegue la maestra.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack 5 — g2_class_pet  (core, seq 5, unit_core)
        // Primary: supporting_details, main_idea, sequencing
        // Secondary: classification, instruction_following
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'early',
                'type' => 'storybook_reading', 'difficulty' => 1,
                'lesson_mood' => 'calm',
                'mission_title' => 'Conoce a Tito la tortuga',
                'mission_description' => 'Lee la historia y descubre la idea principal.',
                'instructions_es' => 'Lee la historia y responde la pregunta.',
                'content' => ['pages'=>[['id'=>'p1','title'=>'La tortuga de la clase','text'=>'La clase tiene una tortuga llamada Tito. Todos los días la cuidan con mucho cariño.','image_prompt'=>'classroom turtle in a tank with children watching'],['id'=>'p2','title'=>'Cuidados de Tito','text'=>'Le cambian el agua, le dan comida y revisan su pecera para que esté limpia.','image_prompt'=>'children feeding turtle and cleaning its tank']],'question'=>['prompt'=>'¿Cuál es la idea principal de la historia?','options'=>[['id'=>'a','text'=>'La clase aprende a cuidar a una tortuga.','image_url'=>null],['id'=>'b','text'=>'Tito es una tortuga muy grande.','image_url'=>null],['id'=>'c','text'=>'Los niños tienen miedo de Tito.','image_url'=>null]]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Busca el detalle del cuidado de Tito',
                'mission_description' => 'Encuentra qué detalle explica cómo cuidan a Tito.',
                'instructions_es' => 'Lee y escoge el detalle correcto.',
                'content' => ['passage'=>'La clase le da comida a Tito, le cambia el agua y revisa su pecera.','question'=>'¿Qué hace la clase para cuidar a Tito?','options'=>[['id'=>'a','text'=>'Le cambian el agua.','image_url'=>null],['id'=>'b','text'=>'Lo llevan a pasear por el parque.','image_url'=>null],['id'=>'c','text'=>'Le enseñan a leer.','image_url'=>null],['id'=>'d','text'=>'Le ponen música.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'sequencing', 'grade_band' => 'early',
                'type' => 'tap_sequence', 'difficulty' => 1,
                'lesson_mood' => 'mission',
                'mission_title' => 'Ordena los cuidados de Tito',
                'mission_description' => 'Toca los pasos en el orden correcto.',
                'instructions_es' => 'Toca los cuidados en el orden correcto.',
                'duration_seconds' => 25,
                'content' => ['items'=>[['id'=>'item_1','text'=>'Dar comida'],['id'=>'item_2','text'=>'Mirar su pecera'],['id'=>'item_3','text'=>'Cambiar el agua']],'instructions'=>'Toca en orden.','time_limit_seconds'=>25],
                'correct_answer' => ['sequence' => ['item_2','item_1','item_3']],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'classification', 'grade_band' => 'early',
                'type' => 'drag_to_sort', 'difficulty' => 1,
                'lesson_mood' => 'puzzle',
                'mission_title' => 'Clasifica lo que sirve para Tito',
                'mission_description' => 'Arrastra cada tarjeta al grupo correcto.',
                'instructions_es' => 'Arrastra cada tarjeta a su grupo.',
                'content' => ['items'=>[['id'=>'item_1','text'=>'Comida para tortuga','image_url'=>null],['id'=>'item_2','text'=>'Agua limpia','image_url'=>null],['id'=>'item_3','text'=>'Pelota de fútbol','image_url'=>null],['id'=>'item_4','text'=>'Piedras de la pecera','image_url'=>null]],'zones'=>[['id'=>'zone_a','label'=>'Sirve para cuidar a Tito'],['id'=>'zone_b','label'=>'No pertenece']],'instructions'=>'Arrastra cada tarjeta.'],
                'correct_answer' => ['zones' => ['zone_a'=>['item_1','item_2','item_4'],'zone_b'=>['item_3']]],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack 6 — g2_garden_helpers  (core, seq 6, unit_late)
        // Primary: supporting_details, classification, sequencing
        // Secondary: main_idea, cause_effect
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'early',
                'type' => 'storybook_reading', 'difficulty' => 1,
                'lesson_mood' => 'calm',
                'mission_title' => 'La clase cuida el jardín juntos',
                'mission_description' => 'Lee y descubre cuál es la idea principal.',
                'instructions_es' => 'Lee la historia y responde la pregunta.',
                'content' => ['pages'=>[['id'=>'p1','title'=>'Todos al jardín','text'=>'La clase fue al jardín de la escuela para ayudar. Cada estudiante tenía una tarea.','image_prompt'=>'children working together in school garden'],['id'=>'p2','title'=>'El jardín florece','text'=>'Regaron las plantas, quitaron hierbas y guardaron las herramientas. El jardín se veía mejor.','image_prompt'=>'school garden looking healthy after children tended it']],'question'=>['prompt'=>'¿Cuál es la idea principal de la historia?','options'=>[['id'=>'a','text'=>'La clase trabajó junta para cuidar el jardín.','image_url'=>null],['id'=>'b','text'=>'El jardín estaba siempre perfecto.','image_url'=>null],['id'=>'c','text'=>'Solo una estudiante cuidaba el jardín.','image_url'=>null]]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Detalle del jardín',
                'mission_description' => 'Encuentra qué hizo la clase en el jardín.',
                'instructions_es' => 'Lee y escoge el detalle correcto.',
                'content' => ['passage'=>'La clase regó las plantas, quitó hierbas y guardó las herramientas.','question'=>'¿Qué hizo la clase en el jardín?','options'=>[['id'=>'a','text'=>'Regaron las plantas.','image_url'=>null],['id'=>'b','text'=>'Pintaron las flores.','image_url'=>null],['id'=>'c','text'=>'Trajeron animales.','image_url'=>null],['id'=>'d','text'=>'Construyeron una banca.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'classification', 'grade_band' => 'early',
                'type' => 'drag_to_sort', 'difficulty' => 1,
                'lesson_mood' => 'puzzle',
                'mission_title' => 'Clasifica ayudantes y herramientas',
                'mission_description' => 'Arrastra cada tarjeta al grupo correcto.',
                'instructions_es' => 'Arrastra cada tarjeta a su grupo.',
                'content' => ['items'=>[['id'=>'item_1','text'=>'Niño regando','image_url'=>null],['id'=>'item_2','text'=>'Regadera','image_url'=>null],['id'=>'item_3','text'=>'Niña quitando hierbas','image_url'=>null],['id'=>'item_4','text'=>'Pala pequeña','image_url'=>null]],'zones'=>[['id'=>'zone_a','label'=>'Ayudante'],['id'=>'zone_b','label'=>'Herramienta']],'instructions'=>'Arrastra cada tarjeta.'],
                'correct_answer' => ['zones' => ['zone_a'=>['item_1','item_3'],'zone_b'=>['item_2','item_4']]],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'sequencing', 'grade_band' => 'early',
                'type' => 'tap_sequence', 'difficulty' => 1,
                'lesson_mood' => 'mission',
                'mission_title' => 'Ordena el trabajo del jardín',
                'mission_description' => 'Toca los pasos en orden.',
                'instructions_es' => 'Toca los pasos en el orden correcto.',
                'duration_seconds' => 25,
                'content' => ['items'=>[['id'=>'item_1','text'=>'Llevaron herramientas'],['id'=>'item_2','text'=>'Regaron y quitaron hierbas'],['id'=>'item_3','text'=>'Guardaron todo']],'instructions'=>'Toca en orden.','time_limit_seconds'=>25],
                'correct_answer' => ['sequence' => ['item_1','item_2','item_3']],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack 7 — g2_animal_homes  (core, seq 7, unit_core)
        // Primary: main_idea, classification, supporting_details
        // Secondary: compare_contrast, sequencing
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'early',
                'type' => 'storybook_reading', 'difficulty' => 1,
                'lesson_mood' => 'calm',
                'mission_title' => 'Descubre dónde vive cada animal',
                'mission_description' => 'Lee y encuentra la idea principal sobre los hogares.',
                'instructions_es' => 'Lee la historia y responde.',
                'content' => ['pages'=>[['id'=>'p1','title'=>'El pájaro y su nido','text'=>'El pájaro vive en un nido en las ramas del árbol. El pez nada en el agua.','image_prompt'=>'bird in nest in tree and fish in water'],['id'=>'p2','title'=>'El conejo bajo tierra','text'=>'El conejo vive en una madriguera bajo la tierra. Cada animal tiene su propio hogar.','image_prompt'=>'rabbit entering burrow underground']],'question'=>['prompt'=>'¿Cuál es la idea principal?','options'=>[['id'=>'a','text'=>'Distintos animales viven en distintos hogares.','image_url'=>null],['id'=>'b','text'=>'Todos los animales viven en árboles.','image_url'=>null],['id'=>'c','text'=>'El conejo y el pájaro son amigos.','image_url'=>null]]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'classification', 'grade_band' => 'early',
                'type' => 'drag_to_sort', 'difficulty' => 1,
                'lesson_mood' => 'puzzle',
                'mission_title' => 'Lleva cada animal a su hogar',
                'mission_description' => 'Arrastra cada animal al lugar donde vive.',
                'instructions_es' => 'Arrastra cada animal a su hogar.',
                'content' => ['items'=>[['id'=>'item_1','text'=>'Pájaro','image_url'=>null],['id'=>'item_2','text'=>'Pez','image_url'=>null],['id'=>'item_3','text'=>'Conejo','image_url'=>null]],'zones'=>[['id'=>'zone_a','label'=>'Nido'],['id'=>'zone_b','label'=>'Agua'],['id'=>'zone_c','label'=>'Madriguera']],'instructions'=>'Arrastra al hogar correcto.'],
                'correct_answer' => ['zones' => ['zone_a'=>['item_1'],'zone_b'=>['item_2'],'zone_c'=>['item_3']]],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Detalle de los animales en casa',
                'mission_description' => 'Busca el detalle que describe los hogares.',
                'instructions_es' => 'Lee y escoge el detalle correcto.',
                'content' => ['passage'=>'El pájaro vive en un nido, el pez nada en el agua y el conejo tiene una madriguera.','question'=>'¿Qué detalle describe dónde viven el pez y el conejo?','options'=>[['id'=>'a','text'=>'El pez nadó en el agua y el conejo se escondió en su madriguera.','image_url'=>null],['id'=>'b','text'=>'El pez y el conejo viven en el mismo lugar.','image_url'=>null],['id'=>'c','text'=>'El pez vive en un árbol.','image_url'=>null],['id'=>'d','text'=>'El conejo nada en el mar.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'compare_contrast', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'curious',
                'mission_title' => 'Compara el nido y la madriguera',
                'mission_description' => 'Piensa en qué se parecen y en qué son diferentes.',
                'instructions_es' => 'Lee y escoge la mejor comparación.',
                'content' => ['passage'=>'El pájaro vive en un nido en un árbol. El conejo vive bajo la tierra en una madriguera.','question'=>'¿Qué tienen en común el nido y la madriguera?','options'=>[['id'=>'a','text'=>'Los dos son hogares, pero uno está en un árbol y el otro bajo la tierra.','image_url'=>null],['id'=>'b','text'=>'Los dos están bajo la tierra.','image_url'=>null],['id'=>'c','text'=>'Los dos son para pájaros.','image_url'=>null],['id'=>'d','text'=>'No tienen nada en común.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack 8 — g2_day_and_night  (core, seq 8, unit_late)
        // Primary: compare_contrast, sequencing, main_idea
        // Secondary: classification, supporting_details
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'early',
                'type' => 'storybook_reading', 'difficulty' => 1,
                'lesson_mood' => 'calm',
                'mission_title' => 'Descubre las diferencias del día y la noche',
                'mission_description' => 'Lee y encuentra la idea principal.',
                'instructions_es' => 'Lee la historia y responde.',
                'content' => ['pages'=>[['id'=>'p1','title'=>'El día lleno de luz','text'=>'Durante el día hay mucha luz solar. Los niños juegan afuera y hacen sus actividades.','image_prompt'=>'child playing outside in sunny daytime'],['id'=>'p2','title'=>'La noche tranquila','text'=>'En la noche todo se oscurece. Las personas encienden lámparas y se preparan para dormir.','image_prompt'=>'family turning on lamp at night, child getting ready for bed']],'question'=>['prompt'=>'¿Cuál es la idea principal?','options'=>[['id'=>'a','text'=>'El día y la noche tienen diferencias en luz y actividades.','image_url'=>null],['id'=>'b','text'=>'La noche dura más que el día.','image_url'=>null],['id'=>'c','text'=>'No se puede salir durante el día.','image_url'=>null]]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'compare_contrast', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'curious',
                'mission_title' => 'Compara el día y la noche',
                'mission_description' => 'Piensa en qué se diferencian.',
                'instructions_es' => 'Lee y escoge la mejor comparación.',
                'content' => ['passage'=>'El día tiene mucha luz. La noche es oscura. En ambos se puede descansar o estar activo.','question'=>'¿Cuál es la mejor comparación?','options'=>[['id'=>'a','text'=>'El día tiene más luz; la noche es más oscura, pero ambos son partes del tiempo.','image_url'=>null],['id'=>'b','text'=>'El día y la noche son exactamente iguales.','image_url'=>null],['id'=>'c','text'=>'Solo se puede jugar de noche.','image_url'=>null],['id'=>'d','text'=>'La noche tiene más luz que el día.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'sequencing', 'grade_band' => 'early',
                'type' => 'tap_sequence', 'difficulty' => 1,
                'lesson_mood' => 'mission',
                'mission_title' => 'Ordena las actividades del día',
                'mission_description' => 'Toca los eventos del día en orden.',
                'instructions_es' => 'Toca los eventos en el orden correcto.',
                'duration_seconds' => 25,
                'content' => ['items'=>[['id'=>'item_1','text'=>'Juega con luz del sol'],['id'=>'item_2','text'=>'Enciende una lámpara'],['id'=>'item_3','text'=>'Se prepara para dormir']],'instructions'=>'Toca en orden.','time_limit_seconds'=>25],
                'correct_answer' => ['sequence' => ['item_1','item_2','item_3']],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'classification', 'grade_band' => 'early',
                'type' => 'drag_to_sort', 'difficulty' => 1,
                'lesson_mood' => 'puzzle',
                'mission_title' => 'Clasifica actividades de día y noche',
                'mission_description' => 'Arrastra cada actividad al momento correcto.',
                'instructions_es' => 'Arrastra cada actividad a día o noche.',
                'content' => ['items'=>[['id'=>'item_1','text'=>'Ver el sol','image_url'=>null],['id'=>'item_2','text'=>'Ver la luna','image_url'=>null],['id'=>'item_3','text'=>'Jugar en el patio con mucha luz','image_url'=>null],['id'=>'item_4','text'=>'Dormir','image_url'=>null]],'zones'=>[['id'=>'zone_a','label'=>'Día'],['id'=>'zone_b','label'=>'Noche']],'instructions'=>'Arrastra cada actividad.'],
                'correct_answer' => ['zones' => ['zone_a'=>['item_1','item_3'],'zone_b'=>['item_2','item_4']]],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack 9 — g2_market_morning  (core, seq 9, unit_late)
        // Primary: supporting_details, sequencing, main_idea
        // Secondary: classification, decision_making
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'early',
                'type' => 'storybook_reading', 'difficulty' => 1,
                'lesson_mood' => 'calm',
                'mission_title' => 'Lucía va al mercado con su abuela',
                'mission_description' => 'Lee y descubre la idea principal.',
                'instructions_es' => 'Lee la historia y responde.',
                'content' => ['pages'=>[['id'=>'p1','title'=>'El mercado de la mañana','text'=>'Lucía acompañó a su abuela al mercado una mañana. Llevó una bolsa pequeña para ayudar.','image_prompt'=>'child with grandmother at morning market carrying small bag'],['id'=>'p2','title'=>'Escogen juntas','text'=>'Escogieron frutas y verduras frescas. Lucía ayudó a llevar la bolsa con las compras.','image_prompt'=>'grandmother and child picking fruits and vegetables at market']],'question'=>['prompt'=>'¿Cuál es la idea principal?','options'=>[['id'=>'a','text'=>'Lucía acompaña a su abuela al mercado y ayuda con las compras.','image_url'=>null],['id'=>'b','text'=>'La abuela de Lucía perdió su bolsa.','image_url'=>null],['id'=>'c','text'=>'El mercado estaba cerrado esa mañana.','image_url'=>null]]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Detalle de Lucía en el mercado',
                'mission_description' => 'Busca el detalle que muestra cómo ayudó Lucía.',
                'instructions_es' => 'Lee y escoge el detalle correcto.',
                'content' => ['passage'=>'Lucía llevó una bolsa pequeña para ayudar a su abuela a cargar las compras.','question'=>'¿Cómo ayudó Lucía en el mercado?','options'=>[['id'=>'a','text'=>'Llevó una bolsa pequeña.','image_url'=>null],['id'=>'b','text'=>'Pagó todas las compras.','image_url'=>null],['id'=>'c','text'=>'Escogió sola todo lo que comprarían.','image_url'=>null],['id'=>'d','text'=>'Habló con los vendedores.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'sequencing', 'grade_band' => 'early',
                'type' => 'tap_sequence', 'difficulty' => 1,
                'lesson_mood' => 'mission',
                'mission_title' => 'Ordena la visita al mercado',
                'mission_description' => 'Toca los pasos en orden.',
                'instructions_es' => 'Toca los pasos en el orden correcto.',
                'duration_seconds' => 25,
                'content' => ['items'=>[['id'=>'item_1','text'=>'Llegan al mercado'],['id'=>'item_2','text'=>'Escogen frutas y verduras'],['id'=>'item_3','text'=>'Lucía ayuda a llevar la bolsa']],'instructions'=>'Toca en orden.','time_limit_seconds'=>25],
                'correct_answer' => ['sequence' => ['item_1','item_2','item_3']],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'classification', 'grade_band' => 'early',
                'type' => 'drag_to_sort', 'difficulty' => 1,
                'lesson_mood' => 'puzzle',
                'mission_title' => 'Clasifica frutas y verduras del mercado',
                'mission_description' => 'Arrastra cada alimento al grupo correcto.',
                'instructions_es' => 'Arrastra cada tarjeta a su grupo.',
                'content' => ['items'=>[['id'=>'item_1','text'=>'Guineo','image_url'=>null],['id'=>'item_2','text'=>'Tomate','image_url'=>null],['id'=>'item_3','text'=>'Manzana','image_url'=>null],['id'=>'item_4','text'=>'Zanahoria','image_url'=>null]],'zones'=>[['id'=>'zone_a','label'=>'Fruta'],['id'=>'zone_b','label'=>'Verdura']],'instructions'=>'Arrastra al grupo correcto.'],
                'correct_answer' => ['zones' => ['zone_a'=>['item_1','item_3'],'zone_b'=>['item_2','item_4']]],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack 10 — g2_rain_after_school  (core, seq 10, unit_late)
        // Primary: cause_effect, sequencing, supporting_details
        // Secondary: main_idea, decision_making
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'early',
                'type' => 'storybook_reading', 'difficulty' => 1,
                'lesson_mood' => 'calm',
                'mission_title' => 'Diego y la lluvia inesperada',
                'mission_description' => 'Lee y descubre la idea principal.',
                'instructions_es' => 'Lee la historia y responde.',
                'content' => ['pages'=>[['id'=>'p1','title'=>'Nubes oscuras','text'=>'Diego salió de la escuela. Vio nubes oscuras y sintió viento frío. Tenía su sombrilla en la mochila.','image_prompt'=>'child leaving school, dark clouds overhead, wind blowing'],['id'=>'p2','title'=>'Diego abre su sombrilla','text'=>'Comenzó a llover. Diego abrió su sombrilla y caminó tranquilo hasta su casa.','image_prompt'=>'child walking home with umbrella in rain']],'question'=>['prompt'=>'¿Cuál es la idea principal?','options'=>[['id'=>'a','text'=>'Diego cambió lo que hacía al ver que comenzó a llover.','image_url'=>null],['id'=>'b','text'=>'Diego llegó tarde porque olvidó su sombrilla.','image_url'=>null],['id'=>'c','text'=>'La lluvia no afectó a Diego en nada.','image_url'=>null]]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'cause_effect', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'curious',
                'mission_title' => '¿Qué hizo Diego cuando llovió?',
                'mission_description' => 'Piensa en la causa y el efecto.',
                'instructions_es' => 'Lee y escoge la consecuencia correcta.',
                'content' => ['passage'=>'Cuando comenzó a llover, Diego sacó su sombrilla y la abrió.','question'=>'¿Qué hizo Diego cuando comenzó a llover?','options'=>[['id'=>'a','text'=>'Abrió su sombrilla.','image_url'=>null],['id'=>'b','text'=>'Regresó a la escuela a esperar.','image_url'=>null],['id'=>'c','text'=>'Corrió sin sombrilla.','image_url'=>null],['id'=>'d','text'=>'Llamó a su mamá.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'sequencing', 'grade_band' => 'early',
                'type' => 'tap_sequence', 'difficulty' => 1,
                'lesson_mood' => 'mission',
                'mission_title' => 'Ordena los eventos de Diego',
                'mission_description' => 'Toca los eventos en el orden correcto.',
                'instructions_es' => 'Toca los eventos en orden.',
                'duration_seconds' => 25,
                'content' => ['items'=>[['id'=>'item_1','text'=>'Salió de la escuela'],['id'=>'item_2','text'=>'Empezó a llover'],['id'=>'item_3','text'=>'Abrió su sombrilla']],'instructions'=>'Toca en orden.','time_limit_seconds'=>25],
                'correct_answer' => ['sequence' => ['item_1','item_2','item_3']],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Detalle de las señales de lluvia',
                'mission_description' => 'Encuentra el detalle que avisó que iba a llover.',
                'instructions_es' => 'Lee y escoge el detalle correcto.',
                'content' => ['passage'=>'Diego vio nubes oscuras y sintió viento frío antes de que lloviera.','question'=>'¿Qué señales vio Diego antes de llover?','options'=>[['id'=>'a','text'=>'Vio nubes oscuras y sintió viento.','image_url'=>null],['id'=>'b','text'=>'Vio un arco iris.','image_url'=>null],['id'=>'c','text'=>'Escuchó el trueno muy fuerte.','image_url'=>null],['id'=>'d','text'=>'El piso ya estaba mojado.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // ----------------------------------------------------------------
        // Packs 11–21 — support_only packs (structured waves 11–20 + match_the_rule)
        // Each has 4 activities covering the primary skills of that pack.
        // ----------------------------------------------------------------

        // Pack 11 — g2_classroom_rules_day
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'early',
                'type' => 'storybook_reading', 'difficulty' => 1,
                'lesson_mood' => 'calm',
                'mission_title' => 'Sigue el día de reglas del aula',
                'mission_description' => 'Lee y descubre cuál es la idea principal.',
                'instructions_es' => 'Lee la historia y responde.',
                'content' => ['pages'=>[['id'=>'p1','title'=>'Las reglas del aula','text'=>'La clase aprendió las reglas del aula. Todos debían escuchar, trabajar y guardar materiales.','image_prompt'=>'classroom with rules posted, children following them calmly'],['id'=>'p2','title'=>'Un día exitoso','text'=>'Siguieron las reglas todo el día y el aula quedó ordenada al final.','image_prompt'=>'tidy classroom at end of day with happy children']],'question'=>['prompt'=>'¿Cuál es la idea principal?','options'=>[['id'=>'a','text'=>'La clase siguió las reglas y tuvo un buen día.','image_url'=>null],['id'=>'b','text'=>'Las reglas del aula son difíciles de recordar.','image_url'=>null],['id'=>'c','text'=>'La maestra no enseñó reglas ese día.','image_url'=>null]]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'instruction_following', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'mission',
                'mission_title' => 'Sigue la instrucción correcta',
                'mission_description' => 'Lee la regla y decide qué hacer.',
                'instructions_es' => 'Lee la instrucción y escoge la acción correcta.',
                'content' => ['passage'=>'Instrucción: Si terminas la actividad, guarda el lápiz y pon el cuaderno en la bandeja azul.','question'=>'Terminaste la actividad. ¿Qué haces?','options'=>[['id'=>'a','text'=>'Guardo el lápiz y pongo el cuaderno en la bandeja azul.','image_url'=>null],['id'=>'b','text'=>'Salgo del salón a buscar a la maestra.','image_url'=>null],['id'=>'c','text'=>'Dejo todo sobre el escritorio.','image_url'=>null],['id'=>'d','text'=>'Le doy el lápiz a un amigo.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'sequencing', 'grade_band' => 'early',
                'type' => 'tap_sequence', 'difficulty' => 1,
                'lesson_mood' => 'mission',
                'mission_title' => 'Ordena la rutina del aula',
                'mission_description' => 'Toca los pasos de la rutina en orden.',
                'instructions_es' => 'Toca los pasos en el orden correcto.',
                'duration_seconds' => 25,
                'content' => ['items'=>[['id'=>'item_1','text'=>'Escuchar la instrucción'],['id'=>'item_2','text'=>'Hacer la actividad'],['id'=>'item_3','text'=>'Guardar materiales']],'instructions'=>'Toca en orden.','time_limit_seconds'=>25],
                'correct_answer' => ['sequence' => ['item_1','item_2','item_3']],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Busca el detalle de la regla',
                'mission_description' => 'Encuentra qué detalle apoya la regla del aula.',
                'instructions_es' => 'Lee y escoge el detalle correcto.',
                'content' => ['passage'=>'Los estudiantes guardaron materiales después de usarlos y dejaron el aula ordenada.','question'=>'¿Qué detalle muestra que siguieron la regla?','options'=>[['id'=>'a','text'=>'Guardaron materiales después de usarlos.','image_url'=>null],['id'=>'b','text'=>'La maestra no estaba en el aula.','image_url'=>null],['id'=>'c','text'=>'Dejaron todo sobre las mesas.','image_url'=>null],['id'=>'d','text'=>'Salieron corriendo al recreo.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // Pack 12 — g2_listen_and_sort
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'early',
                'type' => 'storybook_reading', 'difficulty' => 1,
                'lesson_mood' => 'calm',
                'mission_title' => 'Sigue la actividad del aula',
                'mission_description' => 'Lee y descubre qué hizo la clase para ordenar las tarjetas.',
                'instructions_es' => 'Lee la historia y responde.',
                'content' => ['pages'=>[['id'=>'p1','title'=>'Tarjetas de clasificar','text'=>'La maestra mostró tarjetas con imágenes de frutas y animales. La clase debía escuchar y ordenarlas.','image_prompt'=>'teacher showing sorting cards to students in classroom'],['id'=>'p2','title'=>'La clase las ordena','text'=>'Cada estudiante escuchó la instrucción y puso las tarjetas en el grupo correcto.','image_prompt'=>'students sorting picture cards into two groups']],'question'=>['prompt'=>'¿Qué hizo la clase para ordenar bien las tarjetas?','options'=>[['id'=>'a','text'=>'Escucharon la instrucción y las agruparon por tipo.','image_url'=>null],['id'=>'b','text'=>'Las tiraron al suelo.','image_url'=>null],['id'=>'c','text'=>'Las colorearon antes de ordenarlas.','image_url'=>null]]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'instruction_following', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'mission',
                'mission_title' => 'Sigue la instrucción de clasificar',
                'mission_description' => 'Lee la regla y decide dónde va la manzana.',
                'instructions_es' => 'Lee la instrucción y escoge la acción correcta.',
                'content' => ['passage'=>'Regla: Si es una fruta → caja verde. Si es un animal → caja azul.','question'=>'Tienes una manzana. ¿Dónde la pones?','options'=>[['id'=>'a','text'=>'La pongo en la caja verde.','image_url'=>null],['id'=>'b','text'=>'La pongo en la caja azul.','image_url'=>null],['id'=>'c','text'=>'La dejo sobre la mesa.','image_url'=>null],['id'=>'d','text'=>'La guardo en la mochila.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'classification', 'grade_band' => 'early',
                'type' => 'drag_to_sort', 'difficulty' => 1,
                'lesson_mood' => 'puzzle',
                'mission_title' => 'Clasifica animales y frutas',
                'mission_description' => 'Arrastra cada tarjeta al grupo correcto.',
                'instructions_es' => 'Arrastra cada tarjeta a su grupo.',
                'content' => ['items'=>[['id'=>'item_1','text'=>'Perro','image_url'=>null],['id'=>'item_2','text'=>'Pera','image_url'=>null],['id'=>'item_3','text'=>'Gato','image_url'=>null],['id'=>'item_4','text'=>'Banana','image_url'=>null]],'zones'=>[['id'=>'zone_a','label'=>'Animal'],['id'=>'zone_b','label'=>'Fruta']],'instructions'=>'Arrastra cada tarjeta.'],
                'correct_answer' => ['zones' => ['zone_a'=>['item_1','item_3'],'zone_b'=>['item_2','item_4']]],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'selective_attention', 'grade_band' => 'early',
                'type' => 'tap_sequence', 'difficulty' => 1,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Toca solo las frutas en orden',
                'mission_description' => 'Toca solo las frutas en el orden en que aparecen.',
                'instructions_es' => 'Toca solo las frutas en orden.',
                'duration_seconds' => 20,
                'content' => ['items'=>[['id'=>'item_1','text'=>'Perro'],['id'=>'item_2','text'=>'Pera'],['id'=>'item_3','text'=>'Gato'],['id'=>'item_4','text'=>'Banana']],'instructions'=>'Toca solo las frutas.','time_limit_seconds'=>20],
                'correct_answer' => ['sequence' => ['item_2','item_4']],
            ],
        ]);

        // Pack 13 — g2_find_the_rule
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'early',
                'type' => 'storybook_reading', 'difficulty' => 1,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Descubre la regla del juego',
                'mission_description' => 'Lee y encuentra qué detalle explica la regla.',
                'instructions_es' => 'Lee la historia y responde.',
                'content' => ['pages'=>[['id'=>'p1','title'=>'El juego de las figuras','text'=>'La maestra puso figuras de distintas formas en la mesa. Los estudiantes debían encontrar la regla del juego.','image_prompt'=>'teacher with star and circle shapes arranged in a pattern on table'],['id'=>'p2','title'=>'La regla del juego','text'=>'La regla era: las estrellas van a la caja amarilla y los círculos van a la caja azul.','image_prompt'=>'students placing shapes in colored boxes according to rule']],'question'=>['prompt'=>'¿Qué detalle explica la regla del juego?','options'=>[['id'=>'a','text'=>'Las estrellas van a la caja amarilla y los círculos a la azul.','image_url'=>null],['id'=>'b','text'=>'Todos pusieron las figuras en la misma caja.','image_url'=>null],['id'=>'c','text'=>'Las figuras eran de colores mezclados.','image_url'=>null]]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'instruction_following', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'mission',
                'mission_title' => 'Aplica la regla de las figuras',
                'mission_description' => 'Lee la regla y decide dónde va la estrella.',
                'instructions_es' => 'Lee la regla y escoge la acción correcta.',
                'content' => ['passage'=>'Regla: estrella → caja amarilla / círculo → caja azul.','question'=>'Tienes una estrella. ¿Dónde la pones?','options'=>[['id'=>'a','text'=>'La pongo en la caja amarilla.','image_url'=>null],['id'=>'b','text'=>'La pongo en la caja azul.','image_url'=>null],['id'=>'c','text'=>'La dejo sobre la mesa.','image_url'=>null],['id'=>'d','text'=>'La pongo en cualquier caja.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'patterns', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'curious',
                'mission_title' => 'Completa el patrón de figuras',
                'mission_description' => 'Piensa qué figura viene después.',
                'instructions_es' => 'Escoge la figura que completa el patrón.',
                'content' => ['passage'=>null,'question'=>'⭐ 🔵 ⭐ 🔵 ___ ¿Cuál viene después?','options'=>[['id'=>'a','text'=>'⭐','image_url'=>null],['id'=>'b','text'=>'🔵','image_url'=>null],['id'=>'c','text'=>'🔺','image_url'=>null],['id'=>'d','text'=>'🟩','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'selective_attention', 'grade_band' => 'early',
                'type' => 'tap_sequence', 'difficulty' => 1,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Toca solo las estrellas en orden',
                'mission_description' => 'Toca solo las estrellas en el orden en que aparecen.',
                'instructions_es' => 'Toca solo las estrellas.',
                'duration_seconds' => 20,
                'content' => ['items'=>[['id'=>'item_1','text'=>'⭐'],['id'=>'item_2','text'=>'🔵'],['id'=>'item_3','text'=>'⭐'],['id'=>'item_4','text'=>'🔺']],'instructions'=>'Toca solo las estrellas en orden.','time_limit_seconds'=>20],
                'correct_answer' => ['sequence' => ['item_1','item_3']],
            ],
        ]);

        // Pack 14 — g2_same_and_different
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'early',
                'type' => 'storybook_reading', 'difficulty' => 1,
                'lesson_mood' => 'calm',
                'mission_title' => 'Compara objetos del aula',
                'mission_description' => 'Lee y descubre la idea principal sobre comparar.',
                'instructions_es' => 'Lee la historia y responde.',
                'content' => ['pages'=>[['id'=>'p1','title'=>'Objetos distintos','text'=>'La clase tiene lápices y crayones. Los dos sirven para marcar, pero son diferentes.','image_prompt'=>'pencils and crayons side by side on classroom desk'],['id'=>'p2','title'=>'¿En qué se parecen?','text'=>'La maestra preguntó: ¿en qué se parecen? ¿en qué son diferentes? Los estudiantes compararon con cuidado.','image_prompt'=>'teacher asking students to compare two objects']],'question'=>['prompt'=>'¿Cuál es la idea principal?','options'=>[['id'=>'a','text'=>'La clase aprende a comparar objetos y notar diferencias.','image_url'=>null],['id'=>'b','text'=>'Los crayones son mejores que los lápices.','image_url'=>null],['id'=>'c','text'=>'Solo los lápices se usan en la escuela.','image_url'=>null]]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'compare_contrast', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'curious',
                'mission_title' => 'Compara el lápiz y el crayón',
                'mission_description' => 'Piensa en qué se parecen y en qué son distintos.',
                'instructions_es' => 'Lee y escoge la mejor comparación.',
                'content' => ['passage'=>'Un lápiz y un crayón sirven para marcar, pero uno escribe con grafito y el otro con cera de colores.','question'=>'¿Cuál es la mejor comparación?','options'=>[['id'=>'a','text'=>'Los dos sirven para marcar, pero escriben de forma diferente.','image_url'=>null],['id'=>'b','text'=>'Son exactamente iguales.','image_url'=>null],['id'=>'c','text'=>'El crayón no sirve para marcar.','image_url'=>null],['id'=>'d','text'=>'Solo el lápiz hace marcas.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'classification', 'grade_band' => 'early',
                'type' => 'drag_to_sort', 'difficulty' => 1,
                'lesson_mood' => 'puzzle',
                'mission_title' => 'Clasifica objetos del aula',
                'mission_description' => 'Arrastra cada objeto al grupo correcto.',
                'instructions_es' => 'Arrastra cada tarjeta a su grupo.',
                'content' => ['items'=>[['id'=>'item_1','text'=>'Lápiz','image_url'=>null],['id'=>'item_2','text'=>'Libro','image_url'=>null],['id'=>'item_3','text'=>'Crayón','image_url'=>null],['id'=>'item_4','text'=>'Cuaderno','image_url'=>null]],'zones'=>[['id'=>'zone_a','label'=>'Para escribir o dibujar'],['id'=>'zone_b','label'=>'Para leer o guardar trabajo']],'instructions'=>'Arrastra cada objeto.'],
                'correct_answer' => ['zones' => ['zone_a'=>['item_1','item_3'],'zone_b'=>['item_2','item_4']]],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Detalle de la comparación',
                'mission_description' => 'Encuentra el detalle que apoya la comparación.',
                'instructions_es' => 'Lee y escoge el detalle correcto.',
                'content' => ['passage'=>'Los estudiantes miraron el color, el tamaño y el uso de cada objeto para compararlos.','question'=>'¿Qué usaron para comparar los objetos?','options'=>[['id'=>'a','text'=>'Miraron el color, el tamaño y el uso.','image_url'=>null],['id'=>'b','text'=>'Solo miraron el color.','image_url'=>null],['id'=>'c','text'=>'Los pesaron en una balanza.','image_url'=>null],['id'=>'d','text'=>'Los olieron y los probaron.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // Pack 15 — g2_follow_the_clues
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'early',
                'type' => 'storybook_reading', 'difficulty' => 1,
                'lesson_mood' => 'curious',
                'mission_title' => 'Sigue las pistas del aula',
                'mission_description' => 'Lee y descubre la idea principal.',
                'instructions_es' => 'Lee la historia y responde.',
                'content' => ['pages'=>[['id'=>'p1','title'=>'Una nota misteriosa','text'=>'La maestra dejó una nota que decía: "Está cerca del lugar donde viven los cuentos y siempre se habla bajito."','image_prompt'=>'note on desk with clue about a quiet place with stories'],['id'=>'p2','title'=>'Buscando la pista','text'=>'La clase leyó la nota y usó las pistas para encontrar el lugar correcto.','image_prompt'=>'children looking around classroom searching for a place']],'question'=>['prompt'=>'¿Cuál es la idea principal?','options'=>[['id'=>'a','text'=>'La clase usa pistas para encontrar un lugar correcto.','image_url'=>null],['id'=>'b','text'=>'La maestra perdió una nota importante.','image_url'=>null],['id'=>'c','text'=>'El lugar secreto está fuera del aula.','image_url'=>null]]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Detalle de la pista misteriosa',
                'mission_description' => 'Encuentra el detalle que describe el lugar.',
                'instructions_es' => 'Lee y escoge el detalle correcto.',
                'content' => ['passage'=>'La nota decía: está cerca de los cuentos y es un lugar silencioso.','question'=>'¿Qué describe el lugar de la pista?','options'=>[['id'=>'a','text'=>'Está cerca de los cuentos y es un lugar silencioso.','image_url'=>null],['id'=>'b','text'=>'Está cerca del patio y hay mucho ruido.','image_url'=>null],['id'=>'c','text'=>'Es un lugar con muchos juguetes.','image_url'=>null],['id'=>'d','text'=>'Es un lugar que solo usa la maestra.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'inference', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'curious',
                'mission_title' => 'Infiere dónde está el lugar',
                'mission_description' => 'Usa las pistas para encontrar el lugar.',
                'instructions_es' => 'Lee las pistas y escoge la inferencia correcta.',
                'content' => ['passage'=>'La nota dice: está cerca de los cuentos y siempre se habla bajito.','question'=>'¿A qué lugar se refiere la pista?','options'=>[['id'=>'a','text'=>'Al rincón de lectura.','image_url'=>null],['id'=>'b','text'=>'Al patio de recreo.','image_url'=>null],['id'=>'c','text'=>'A la cafetería.','image_url'=>null],['id'=>'d','text'=>'Al baño.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'selective_attention', 'grade_band' => 'early',
                'type' => 'tap_sequence', 'difficulty' => 1,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Toca solo las pistas útiles',
                'mission_description' => 'Toca solo las palabras que te ayudan a encontrar el lugar.',
                'instructions_es' => 'Toca solo las pistas útiles.',
                'duration_seconds' => 20,
                'content' => ['items'=>[['id'=>'item_1','text'=>'cuentos'],['id'=>'item_2','text'=>'mesa'],['id'=>'item_3','text'=>'bajito'],['id'=>'item_4','text'=>'ventana']],'instructions'=>'Toca solo las pistas que ayudan.','time_limit_seconds'=>20],
                'correct_answer' => ['sequence' => ['item_1','item_3']],
            ],
        ]);

        // Pack 16 — g2_sort_the_signs
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'early',
                'type' => 'storybook_reading', 'difficulty' => 1,
                'lesson_mood' => 'calm',
                'mission_title' => 'Aprende los letreros del aula',
                'mission_description' => 'Lee y descubre cómo la clase usó los letreros.',
                'instructions_es' => 'Lee la historia y responde.',
                'content' => ['pages'=>[['id'=>'p1','title'=>'Los letreros de la escuela','text'=>'La clase vio varios letreros en los pasillos: silencio, salida, lavarse las manos, no correr.','image_prompt'=>'school hallway with various signs: silence, exit, wash hands, no running'],['id'=>'p2','title'=>'¿Qué significa cada uno?','text'=>'Los estudiantes leyeron cada letrero y lo agruparon por lo que significaba.','image_prompt'=>'students sorting school signs by meaning']],'question'=>['prompt'=>'¿Qué hizo la clase con los letreros?','options'=>[['id'=>'a','text'=>'Los observó y los agrupó por significado.','image_url'=>null],['id'=>'b','text'=>'Los quitó de la pared.','image_url'=>null],['id'=>'c','text'=>'Solo leyó el letrero de silencio.','image_url'=>null]]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'instruction_following', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'mission',
                'mission_title' => 'Aplica la regla del letrero',
                'mission_description' => 'Lee la regla y decide qué hacer.',
                'instructions_es' => 'Lee la regla y escoge la acción correcta.',
                'content' => ['passage'=>'Regla: si ves el letrero de silencio → habla bajito. Si ves salida → mira la puerta.','question'=>'Ves el letrero de silencio. ¿Qué haces?','options'=>[['id'=>'a','text'=>'Hablo bajito.','image_url'=>null],['id'=>'b','text'=>'Corro hacia la puerta.','image_url'=>null],['id'=>'c','text'=>'Grito para llamar a mis amigos.','image_url'=>null],['id'=>'d','text'=>'Ignoro el letrero.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'classification', 'grade_band' => 'early',
                'type' => 'drag_to_sort', 'difficulty' => 1,
                'lesson_mood' => 'puzzle',
                'mission_title' => 'Clasifica los letreros de la escuela',
                'mission_description' => 'Arrastra cada letrero al grupo correcto.',
                'instructions_es' => 'Arrastra cada letrero a su grupo.',
                'content' => ['items'=>[['id'=>'item_1','text'=>'Silencio','image_url'=>null],['id'=>'item_2','text'=>'Salida','image_url'=>null],['id'=>'item_3','text'=>'Lavarse las manos','image_url'=>null],['id'=>'item_4','text'=>'No correr','image_url'=>null]],'zones'=>[['id'=>'zone_a','label'=>'Seguridad y movimiento'],['id'=>'zone_b','label'=>'Conducta e higiene']],'instructions'=>'Arrastra cada letrero.'],
                'correct_answer' => ['zones' => ['zone_a'=>['item_2','item_4'],'zone_b'=>['item_1','item_3']]],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'visual_discrimination', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Encuentra el letrero diferente',
                'mission_description' => 'Observa bien y encuentra cuál es diferente.',
                'instructions_es' => 'Escoge el letrero que es diferente.',
                'content' => ['passage'=>null,'question'=>'¿Cuál es diferente? 🚪 🚪 🚪 🧼','options'=>[['id'=>'a','text'=>'La señal de manos (🧼)','image_url'=>null],['id'=>'b','text'=>'La primera puerta (🚪)','image_url'=>null],['id'=>'c','text'=>'La segunda puerta (🚪)','image_url'=>null],['id'=>'d','text'=>'Son todos iguales.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // Pack 17 — g2_which_one_belongs
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'early',
                'type' => 'storybook_reading', 'difficulty' => 1,
                'lesson_mood' => 'calm',
                'mission_title' => 'Busca el que no pertenece',
                'mission_description' => 'Lee y descubre cómo encontró la clase cuál no pertenecía.',
                'instructions_es' => 'Lee la historia y responde.',
                'content' => ['pages'=>[['id'=>'p1','title'=>'Tres frutas y algo más','text'=>'La maestra puso tres frutas y un juguete sobre la mesa. Los estudiantes debían encontrar cuál no pertenecía.','image_prompt'=>'three fruits and one toy on classroom table'],['id'=>'p2','title'=>'La clase compara','text'=>'Los estudiantes compararon los objetos y buscaron cuál era diferente.','image_prompt'=>'children pointing to the toy as the different item']],'question'=>['prompt'=>'¿Cómo encontró la clase cuál no pertenecía?','options'=>[['id'=>'a','text'=>'Comparó los objetos y buscó cuál era diferente.','image_url'=>null],['id'=>'b','text'=>'Solo miraron el color de los objetos.','image_url'=>null],['id'=>'c','text'=>'La maestra les dijo la respuesta directamente.','image_url'=>null]]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'classification', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'curious',
                'mission_title' => '¿Cuál no pertenece al grupo?',
                'mission_description' => 'Encuentra el objeto que no es del mismo grupo.',
                'instructions_es' => 'Escoge el que no pertenece.',
                'content' => ['passage'=>null,'question'=>'Manzana, Pera, Pelota, Banana — ¿cuál no pertenece?','options'=>[['id'=>'a','text'=>'Manzana','image_url'=>null],['id'=>'b','text'=>'Pera','image_url'=>null],['id'=>'c','text'=>'Pelota','image_url'=>null],['id'=>'d','text'=>'Banana','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'c'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'compare_contrast', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'curious',
                'mission_title' => 'Compara los útiles escolares',
                'mission_description' => 'Piensa cuál no pertenece a los útiles.',
                'instructions_es' => 'Lee y escoge la mejor comparación.',
                'content' => ['passage'=>'Un lápiz, un crayón y un marcador se usan para escribir o dibujar. Una taza se usa para beber.','question'=>'¿Por qué la taza es diferente?','options'=>[['id'=>'a','text'=>'La taza es diferente porque no sirve para escribir o dibujar.','image_url'=>null],['id'=>'b','text'=>'La taza es más grande que los demás.','image_url'=>null],['id'=>'c','text'=>'La taza y el lápiz son iguales.','image_url'=>null],['id'=>'d','text'=>'El marcador no sirve para escribir.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'visual_discrimination', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Encuentra el objeto diferente',
                'mission_description' => 'Observa y encuentra cuál no es igual a los demás.',
                'instructions_es' => 'Escoge el que es diferente.',
                'content' => ['passage'=>null,'question'=>'¿Cuál es diferente? 🍎 🍎 🍎 🧸','options'=>[['id'=>'a','text'=>'El oso de peluche (🧸)','image_url'=>null],['id'=>'b','text'=>'La primera manzana (🍎)','image_url'=>null],['id'=>'c','text'=>'La segunda manzana (🍎)','image_url'=>null],['id'=>'d','text'=>'Todos son iguales.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // Pack 18 — g2_rule_or_not
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'early',
                'type' => 'storybook_reading', 'difficulty' => 1,
                'lesson_mood' => 'calm',
                'mission_title' => 'Juega a seguir o no la regla',
                'mission_description' => 'Lee y descubre cómo jugó la clase.',
                'instructions_es' => 'Lee la historia y responde.',
                'content' => ['pages'=>[['id'=>'p1','title'=>'La regla del juego','text'=>'La regla era: si terminas, guarda tus materiales y espera en silencio.','image_prompt'=>'classroom game where students decide if actions follow a rule'],['id'=>'p2','title'=>'¿Sigue la regla?','text'=>'La maestra mostraba acciones y los estudiantes decidían si seguían o no la regla.','image_prompt'=>'teacher showing action cards while students decide']],'question'=>['prompt'=>'¿Cómo respondía la clase?','options'=>[['id'=>'a','text'=>'Miraba la acción y pensaba si cumplía la regla antes de responder.','image_url'=>null],['id'=>'b','text'=>'Respondía sin pensar nada.','image_url'=>null],['id'=>'c','text'=>'Solo miraba si la acción era divertida.','image_url'=>null]]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'instruction_following', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'mission',
                'mission_title' => 'Aplica la regla del juego',
                'mission_description' => 'Decide qué hacer cuando terminas.',
                'instructions_es' => 'Lee la regla y escoge la acción correcta.',
                'content' => ['passage'=>'Regla: Si terminas, guarda tus materiales y espera en silencio.','question'=>'Terminaste. ¿Qué haces?','options'=>[['id'=>'a','text'=>'Guardar el lápiz y esperar en silencio.','image_url'=>null],['id'=>'b','text'=>'Gritar que terminé.','image_url'=>null],['id'=>'c','text'=>'Salir del salón.','image_url'=>null],['id'=>'d','text'=>'Seguir escribiendo aunque ya terminé.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'classification', 'grade_band' => 'early',
                'type' => 'drag_to_sort', 'difficulty' => 1,
                'lesson_mood' => 'puzzle',
                'mission_title' => 'Clasifica: ¿sigue la regla o no?',
                'mission_description' => 'Arrastra cada acción al grupo correcto.',
                'instructions_es' => 'Arrastra cada acción a su grupo.',
                'content' => ['items'=>[['id'=>'item_1','text'=>'Guardar el cuaderno','image_url'=>null],['id'=>'item_2','text'=>'Esperar en silencio','image_url'=>null],['id'=>'item_3','text'=>'Gritar y correr','image_url'=>null],['id'=>'item_4','text'=>'Tirar los lápices','image_url'=>null]],'zones'=>[['id'=>'zone_a','label'=>'Sigue la regla'],['id'=>'zone_b','label'=>'No sigue la regla']],'instructions'=>'Arrastra cada acción.'],
                'correct_answer' => ['zones' => ['zone_a'=>['item_1','item_2'],'zone_b'=>['item_3','item_4']]],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'response_control', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'mission',
                'mission_title' => 'Controla tu respuesta',
                'mission_description' => 'Piensa antes de actuar.',
                'instructions_es' => 'Escoge la respuesta que controla el impulso.',
                'content' => ['passage'=>'Una tarjeta muestra a un niño gritando cuando termina su trabajo.','question'=>'¿Esta acción sigue la regla de esperar en silencio?','options'=>[['id'=>'a','text'=>'No, eso no sigue la regla de esperar en silencio.','image_url'=>null],['id'=>'b','text'=>'Sí, gritar está bien si terminaste.','image_url'=>null],['id'=>'c','text'=>'Solo a veces se puede gritar.','image_url'=>null],['id'=>'d','text'=>'La regla no decía nada sobre el ruido.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // Pack 19 — g2_find_the_match
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'early',
                'type' => 'storybook_reading', 'difficulty' => 1,
                'lesson_mood' => 'calm',
                'mission_title' => 'Encuentra las parejas del aula',
                'mission_description' => 'Lee y descubre cómo la clase encontró las parejas.',
                'instructions_es' => 'Lee la historia y responde.',
                'content' => ['pages'=>[['id'=>'p1','title'=>'Tarjetas de parejas','text'=>'La maestra mostró tarjetas con imágenes y palabras. Los estudiantes debían encontrar cuáles combinaban.','image_prompt'=>'teacher showing matching cards with pictures and words'],['id'=>'p2','title'=>'Encontrando la pareja','text'=>'Los estudiantes miraron con atención y encontraron las parejas que iban juntas.','image_prompt'=>'students matching cards carefully on a table']],'question'=>['prompt'=>'¿Cómo encontró la clase las parejas?','options'=>[['id'=>'a','text'=>'Miró con atención cuáles tarjetas combinaban.','image_url'=>null],['id'=>'b','text'=>'Escogió las tarjetas al azar.','image_url'=>null],['id'=>'c','text'=>'La maestra les mostró todas las respuestas.','image_url'=>null]]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'classification', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'curious',
                'mission_title' => '¿Qué hace pareja?',
                'mission_description' => 'Encuentra qué dos cosas van juntas.',
                'instructions_es' => 'Escoge la pareja correcta.',
                'content' => ['passage'=>null,'question'=>'¿Qué hace pareja? Lápiz, Zapato, Cuaderno, Banana','options'=>[['id'=>'a','text'=>'Lápiz y cuaderno','image_url'=>null],['id'=>'b','text'=>'Zapato y banana','image_url'=>null],['id'=>'c','text'=>'Lápiz y banana','image_url'=>null],['id'=>'d','text'=>'Cuaderno y zapato','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'visual_discrimination', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => '¿Cuál hace pareja con el triángulo?',
                'mission_description' => 'Observa las figuras y escoge la que hace pareja.',
                'instructions_es' => 'Escoge la figura que hace pareja.',
                'content' => ['passage'=>null,'question'=>'¿Qué hace pareja con 🔺 ?','options'=>[['id'=>'a','text'=>'🔺','image_url'=>null],['id'=>'b','text'=>'🔵','image_url'=>null],['id'=>'c','text'=>'🟩','image_url'=>null],['id'=>'d','text'=>'⭐','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'selective_attention', 'grade_band' => 'early',
                'type' => 'tap_sequence', 'difficulty' => 1,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Toca solo los útiles escolares',
                'mission_description' => 'Toca solo los útiles escolares en orden.',
                'instructions_es' => 'Toca solo los útiles escolares.',
                'duration_seconds' => 20,
                'content' => ['items'=>[['id'=>'item_1','text'=>'Lápiz'],['id'=>'item_2','text'=>'Zapato'],['id'=>'item_3','text'=>'Cuaderno'],['id'=>'item_4','text'=>'Banana']],'instructions'=>'Toca solo los útiles escolares.','time_limit_seconds'=>20],
                'correct_answer' => ['sequence' => ['item_1','item_3']],
            ],
        ]);

        // Pack 20 — g2_same_group
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'early',
                'type' => 'storybook_reading', 'difficulty' => 1,
                'lesson_mood' => 'calm',
                'mission_title' => 'Agrupa los objetos iguales',
                'mission_description' => 'Lee y descubre cómo la clase agrupó los objetos.',
                'instructions_es' => 'Lee la historia y responde.',
                'content' => ['pages'=>[['id'=>'p1','title'=>'Objetos en la alfombra','text'=>'La maestra puso frutas, útiles escolares y juguetes en la alfombra. La clase debía agruparlos.','image_prompt'=>'fruits, school supplies and toys spread on classroom rug'],['id'=>'p2','title'=>'¿Cómo los agruparon?','text'=>'Los estudiantes pensaron para qué servía cada cosa y la agruparon con las parecidas.','image_prompt'=>'students sorting items into three groups on rug']],'question'=>['prompt'=>'¿Cómo agrupó la clase los objetos?','options'=>[['id'=>'a','text'=>'Pensó para qué servía cada cosa y la agrupó con las parecidas.','image_url'=>null],['id'=>'b','text'=>'Los agrupó por color solamente.','image_url'=>null],['id'=>'c','text'=>'Los puso todos juntos sin orden.','image_url'=>null]]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'classification', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'curious',
                'mission_title' => '¿Cuál pertenece al grupo escolar?',
                'mission_description' => 'Encuentra qué objeto va con los útiles.',
                'instructions_es' => 'Escoge el objeto que pertenece al mismo grupo.',
                'content' => ['passage'=>'Cuaderno, lápiz, borrador... ¿cuál más va con ellos?','question'=>'¿Cuál va con cuaderno, lápiz y borrador?','options'=>[['id'=>'a','text'=>'Regla','image_url'=>null],['id'=>'b','text'=>'Banana','image_url'=>null],['id'=>'c','text'=>'Pelota','image_url'=>null],['id'=>'d','text'=>'Sombrero','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'compare_contrast', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'curious',
                'mission_title' => 'Compara frutas y útiles',
                'mission_description' => 'Piensa en qué son iguales y en qué son diferentes.',
                'instructions_es' => 'Lee y escoge la mejor comparación.',
                'content' => ['passage'=>'Una banana, una manzana y un lápiz están sobre la mesa.','question'=>'¿Cuál es la mejor comparación?','options'=>[['id'=>'a','text'=>'La banana y la manzana van juntas porque son frutas; el lápiz es diferente.','image_url'=>null],['id'=>'b','text'=>'Los tres son exactamente iguales.','image_url'=>null],['id'=>'c','text'=>'El lápiz es una fruta también.','image_url'=>null],['id'=>'d','text'=>'La banana y el lápiz van juntos.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'selective_attention', 'grade_band' => 'early',
                'type' => 'tap_sequence', 'difficulty' => 1,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Toca solo las frutas del grupo',
                'mission_description' => 'Toca solo las frutas en orden.',
                'instructions_es' => 'Toca solo las frutas.',
                'duration_seconds' => 20,
                'content' => ['items'=>[['id'=>'item_1','text'=>'Pelota'],['id'=>'item_2','text'=>'Banana'],['id'=>'item_3','text'=>'Lápiz'],['id'=>'item_4','text'=>'Manzana']],'instructions'=>'Toca solo las frutas.','time_limit_seconds'=>20],
                'correct_answer' => ['sequence' => ['item_2','item_4']],
            ],
        ]);

        // Pack 21 — g2_match_the_rule
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'early',
                'type' => 'storybook_reading', 'difficulty' => 1,
                'lesson_mood' => 'calm',
                'mission_title' => 'Relaciona acción y regla',
                'mission_description' => 'Lee y descubre cómo la clase relacionó acciones con reglas.',
                'instructions_es' => 'Lee la historia y responde.',
                'content' => ['pages'=>[['id'=>'p1','title'=>'Las reglas del aula','text'=>'Hay reglas para moverse, para hablar y para guardar cosas. La clase aprendió a relacionar cada acción con su regla.','image_prompt'=>'students matching action cards to rule cards on classroom wall'],['id'=>'p2','title'=>'Cada acción tiene su regla','text'=>'Los estudiantes miraron cada acción y encontraron cuál regla correspondía.','image_prompt'=>'children pointing to matching rule cards']],'question'=>['prompt'=>'¿Qué encontró la clase para cada acción?','options'=>[['id'=>'a','text'=>'La regla que correspondía a esa acción.','image_url'=>null],['id'=>'b','text'=>'Un castigo diferente.','image_url'=>null],['id'=>'c','text'=>'Una actividad nueva.','image_url'=>null]]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'instruction_following', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'mission',
                'mission_title' => 'Relaciona la instrucción con la acción',
                'mission_description' => 'Lee la instrucción y decide qué acción corresponde.',
                'instructions_es' => 'Lee la instrucción y escoge la acción correcta.',
                'content' => ['passage'=>'Instrucción: Si tienes una fruta → ponla en la caja verde. Si tienes un útil → ponlo en la caja roja.','question'=>'Tienes una manzana. ¿Dónde la pones?','options'=>[['id'=>'a','text'=>'En la caja verde.','image_url'=>null],['id'=>'b','text'=>'En la caja roja.','image_url'=>null],['id'=>'c','text'=>'La dejo sobre la mesa.','image_url'=>null],['id'=>'d','text'=>'La como antes de hacer nada.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reasoning', 'skill_name' => 'classification', 'grade_band' => 'early',
                'type' => 'drag_to_sort', 'difficulty' => 1,
                'lesson_mood' => 'puzzle',
                'mission_title' => 'Clasifica según la regla',
                'mission_description' => 'Arrastra cada objeto a la caja correcta según la regla.',
                'instructions_es' => 'Arrastra cada objeto a su caja.',
                'content' => ['items'=>[['id'=>'item_1','text'=>'Manzana','image_url'=>null],['id'=>'item_2','text'=>'Lápiz','image_url'=>null],['id'=>'item_3','text'=>'Banana','image_url'=>null],['id'=>'item_4','text'=>'Borrador','image_url'=>null]],'zones'=>[['id'=>'zone_a','label'=>'Caja verde (fruta)'],['id'=>'zone_b','label'=>'Caja roja (útil)']],'instructions'=>'Arrastra según la regla.'],
                'correct_answer' => ['zones' => ['zone_a'=>['item_1','item_3'],'zone_b'=>['item_2','item_4']]],
            ],
            [
                'domain' => 'attention', 'skill_name' => 'response_control', 'grade_band' => 'early',
                'type' => 'multiple_choice', 'difficulty' => 1,
                'lesson_mood' => 'mission',
                'mission_title' => 'Espera antes de responder',
                'mission_description' => 'Piensa en la regla antes de actuar.',
                'instructions_es' => 'Escoge la respuesta que sigue la regla correctamente.',
                'content' => ['passage'=>'La regla dice: lee la pregunta completa antes de marcar una respuesta.','question'=>'¿Qué debes hacer antes de marcar tu respuesta?','options'=>[['id'=>'a','text'=>'Leer la pregunta completa.','image_url'=>null],['id'=>'b','text'=>'Marcar la primera opción rápidamente.','image_url'=>null],['id'=>'c','text'=>'Preguntarle a un amigo.','image_url'=>null],['id'=>'d','text'=>'Marcar cualquier respuesta.','image_url'=>null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        $this->command->info('G2 Reading: 21 packs seeded.');
    }
}
