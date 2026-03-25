<?php

namespace Database\Seeders;

use Database\Seeders\Traits\InsertsPackActivities;
use Illuminate\Database\Seeder;

/**
 * Grade 3-4 — Reading content packs
 *
 * 20 packs (skip g34_which_sentence_helps — no source data):
 *   Core (seq 1-9): g34_bee_helper, g34_lost_backpack, g34_river_trip,
 *                   g34_inventors_notebook, g34_growing_plants,
 *                   g34_maps_and_neighborhoods, g34_recycling_day,
 *                   g34_weather_watchers, g34_park_cleanup
 *   Support-only:   g34_butterfly_garden
 *   Structured 11-20: g34_tool_trouble … g34_which_detail_matters
 *
 * grade_band = 'middle'  |  curriculum_unit = middle_reading_comprehension
 */
class ContentPackSeeder_G34Reading extends Seeder
{
    use InsertsPackActivities;

    public function run(): void
    {
        // ----------------------------------------------------------------
        // Pack 1 — g34_bee_helper  (core, seq 1, unit_entry)
        // Primary: main_idea, inference, compare_contrast
        // Secondary: supporting_details, cause_effect
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'middle',
                'type' => 'illustrated_clue', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => 'Investiga al ayudante invisible del jardín',
                'mission_description' => 'Mira la imagen y lee para descubrir qué hace la abeja.',
                'instructions_es' => 'Mira la imagen y lee el texto antes de responder.',
                'content' => ['image_url' => null, 'image_prompt' => 'bee collecting pollen from a flower in a garden', 'passage' => 'La abeja visita flor tras flor. Lleva un polvo especial llamado néctar que luego se convierte en miel.', 'question' => '¿Cuál es la idea principal de esta imagen y texto?', 'options' => [['id' => 'a', 'text' => 'La abeja cumple un trabajo importante en el jardín.', 'image_url' => null], ['id' => 'b', 'text' => 'La abeja solo busca flores bonitas.', 'image_url' => null], ['id' => 'c', 'text' => 'La abeja molesta a las plantas.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Detalle del trabajo de la abeja',
                'mission_description' => 'Busca el detalle que explica lo que hace la abeja.',
                'instructions_es' => 'Lee y escoge el detalle correcto.',
                'content' => ['passage' => 'La abeja lleva néctar de flor en flor. Gracias a eso las plantas producen frutos y el jardín crece.', 'question' => '¿Qué detalle explica la función de la abeja?', 'options' => [['id' => 'a', 'text' => 'Lleva néctar de flor en flor para que las plantas produzcan frutos.', 'image_url' => null], ['id' => 'b', 'text' => 'La abeja come hojas de los árboles.', 'image_url' => null], ['id' => 'c', 'text' => 'La abeja vive dentro del jardín sin hacer nada.', 'image_url' => null], ['id' => 'd', 'text' => 'La abeja asusta a otros insectos.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'compare_contrast', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => 'Compara la abeja y la mariposa',
                'mission_description' => 'Piensa en qué se parecen y en qué son diferentes.',
                'instructions_es' => 'Lee y escoge la mejor comparación.',
                'content' => ['passage' => 'La abeja y la mariposa visitan flores para alimentarse. La abeja produce miel; la mariposa no.', 'question' => '¿Cuál es la mejor comparación entre abeja y mariposa?', 'options' => [['id' => 'a', 'text' => 'Las dos visitan flores pero solo la abeja produce miel.', 'image_url' => null], ['id' => 'b', 'text' => 'Son exactamente iguales en todo.', 'image_url' => null], ['id' => 'c', 'text' => 'La mariposa produce más miel.', 'image_url' => null], ['id' => 'd', 'text' => 'Ninguna de las dos visita flores.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'inference', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => 'Infiere qué pasaría sin abejas',
                'mission_description' => 'Usa lo que sabes para inferir la consecuencia.',
                'instructions_es' => 'Lee y escoge la inferencia correcta.',
                'content' => ['passage' => 'Las abejas llevan néctar entre plantas. Gracias a eso muchas plantas se reproducen y producen frutos.', 'question' => '¿Qué podemos inferir si desaparecieran todas las abejas?', 'options' => [['id' => 'a', 'text' => 'Muchas plantas tendrían dificultad para reproducirse y producir frutos.', 'image_url' => null], ['id' => 'b', 'text' => 'Los jardines tendrían aún más flores.', 'image_url' => null], ['id' => 'c', 'text' => 'Las plantas no necesitarían ayuda de nadie.', 'image_url' => null], ['id' => 'd', 'text' => 'Las mariposas se convertirían en abejas.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'cause_effect', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'mission',
                'mission_title' => '¿Qué causa la polinización?',
                'mission_description' => 'Piensa en la relación causa-efecto.',
                'instructions_es' => 'Lee y escoge el efecto correcto.',
                'content' => ['passage' => 'Cuando la abeja lleva néctar a nuevas flores, ayuda a la polinización.', 'question' => '¿Cuál es el efecto de la polinización?', 'options' => [['id' => 'a', 'text' => 'Las plantas producen frutos y semillas nuevas.', 'image_url' => null], ['id' => 'b', 'text' => 'Las flores pierden todos sus pétalos.', 'image_url' => null], ['id' => 'c', 'text' => 'El jardín se queda sin flores.', 'image_url' => null], ['id' => 'd', 'text' => 'La abeja deja de volar.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack 2 — g34_lost_backpack  (core, seq 2)
        // Primary: inference, sequencing, supporting_details
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => 'La mochila perdida de Samuel',
                'mission_description' => 'Lee y descubre la idea principal.',
                'instructions_es' => 'Lee y escoge la idea principal.',
                'content' => ['passage' => 'Samuel no encontraba su mochila en ningún lugar del aula. Fue repasando mentalmente cada paso de la mañana hasta que recordó dónde la había dejado.', 'question' => '¿Cuál es la idea principal?', 'options' => [['id' => 'a', 'text' => 'Samuel usa el repaso mental para encontrar lo que perdió.', 'image_url' => null], ['id' => 'b', 'text' => 'Samuel perdió su mochila para siempre.', 'image_url' => null], ['id' => 'c', 'text' => 'Un compañero le robó la mochila.', 'image_url' => null], ['id' => 'd', 'text' => 'La maestra escondió la mochila.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'inference', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => 'Infiere dónde está la mochila',
                'mission_description' => 'Usa las pistas para inferir dónde la dejó.',
                'instructions_es' => 'Lee las pistas y escoge la inferencia correcta.',
                'content' => ['passage' => 'Samuel recuerda que al llegar a la escuela fue al gimnasio antes de ir al aula.', 'question' => '¿Dónde podría estar la mochila?', 'options' => [['id' => 'a', 'text' => 'En el gimnasio.', 'image_url' => null], ['id' => 'b', 'text' => 'En el autobús.', 'image_url' => null], ['id' => 'c', 'text' => 'En la cafetería.', 'image_url' => null], ['id' => 'd', 'text' => 'En la oficina.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'sequencing', 'grade_band' => 'middle',
                'type' => 'story_strip_sequencing', 'difficulty' => 2,
                'lesson_mood' => 'mission',
                'mission_title' => 'Ordena los pasos de búsqueda de Samuel',
                'mission_description' => 'Arrastra las tiras en el orden correcto.',
                'instructions_es' => 'Ordena los eventos en el orden en que ocurrieron.',
                'content' => ['strips' => [['id' => 's1', 'text' => 'Samuel llegó a la escuela y fue al gimnasio.', 'image_prompt' => 'child entering school gym with backpack'], ['id' => 's2', 'text' => 'Samuel fue al aula y no encontró su mochila.', 'image_prompt' => 'child looking around empty desk for backpack'], ['id' => 's3', 'text' => 'Samuel repasó mentalmente sus pasos de la mañana.', 'image_prompt' => 'child thinking with thought bubble showing morning steps'], ['id' => 's4', 'text' => 'Samuel fue al gimnasio y encontró su mochila.', 'image_prompt' => 'happy child picking up backpack in gym']], 'instructions' => 'Arrastra las tiras en el orden correcto.'],
                'correct_answer' => ['sequence' => ['s1', 's2', 's3', 's4']],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Detalle de cómo buscó Samuel',
                'mission_description' => 'Busca el detalle que explica cómo encontró su mochila.',
                'instructions_es' => 'Lee y escoge el detalle correcto.',
                'content' => ['passage' => 'Samuel repasó mentalmente cada paso desde que llegó hasta que se sentó en su escritorio.', 'question' => '¿Qué usó Samuel para encontrar su mochila?', 'options' => [['id' => 'a', 'text' => 'El repaso mental de sus pasos.', 'image_url' => null], ['id' => 'b', 'text' => 'Preguntó a todos sus compañeros.', 'image_url' => null], ['id' => 'c', 'text' => 'Buscó en el libro de texto.', 'image_url' => null], ['id' => 'd', 'text' => 'La maestra le dio una pista.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack 3 — g34_river_trip  (core, seq 3)
        // Primary: supporting_details, cause_effect, main_idea
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => 'El recorrido por el río',
                'mission_description' => 'Lee y descubre la idea principal.',
                'instructions_es' => 'Lee y escoge la idea principal.',
                'content' => ['passage' => 'La clase visitó el río para observar el agua, los animales y las plantas de la orilla. Tomaron notas y aprendieron sobre el ecosistema.', 'question' => '¿Cuál es la idea principal?', 'options' => [['id' => 'a', 'text' => 'La clase observó el ecosistema del río durante una visita.', 'image_url' => null], ['id' => 'b', 'text' => 'La clase nadó en el río.', 'image_url' => null], ['id' => 'c', 'text' => 'El río estaba sucio y sin animales.', 'image_url' => null], ['id' => 'd', 'text' => 'Solo la maestra tomó notas.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Detalle del recorrido',
                'mission_description' => 'Busca el detalle que apoya lo que aprendieron.',
                'instructions_es' => 'Lee y escoge el detalle correcto.',
                'content' => ['passage' => 'La clase observó peces, plantas acuáticas y aves que vivían cerca del río.', 'question' => '¿Qué observó la clase en el río?', 'options' => [['id' => 'a', 'text' => 'Peces, plantas acuáticas y aves.', 'image_url' => null], ['id' => 'b', 'text' => 'Solo agua clara y rocas.', 'image_url' => null], ['id' => 'c', 'text' => 'Ballenas y delfines.', 'image_url' => null], ['id' => 'd', 'text' => 'Máquinas y edificios.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'cause_effect', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => 'Causa y efecto en el río',
                'mission_description' => 'Piensa qué causó que el agua del río cambiara.',
                'instructions_es' => 'Lee y escoge el efecto correcto.',
                'content' => ['passage' => 'Cuando las personas tiran basura en el río, el agua se contamina y los animales sufren.', 'question' => '¿Qué efecto tiene tirar basura en el río?', 'options' => [['id' => 'a', 'text' => 'El agua se contamina y los animales sufren.', 'image_url' => null], ['id' => 'b', 'text' => 'El río crece y lleva más agua.', 'image_url' => null], ['id' => 'c', 'text' => 'Aparecen más peces.', 'image_url' => null], ['id' => 'd', 'text' => 'Las plantas crecen más rápido.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'inference', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'mission',
                'mission_title' => 'Infiere qué aprende la clase en el río',
                'mission_description' => 'Usa las pistas para inferir la lección.',
                'instructions_es' => 'Lee y escoge la inferencia correcta.',
                'content' => ['passage' => 'La clase observó que el agua limpia tenía más peces y plantas que el tramo contaminado.', 'question' => '¿Qué podemos inferir sobre el agua limpia?', 'options' => [['id' => 'a', 'text' => 'El agua limpia es esencial para la vida en el río.', 'image_url' => null], ['id' => 'b', 'text' => 'La contaminación ayuda a que crezcan más plantas.', 'image_url' => null], ['id' => 'c', 'text' => 'Los peces no necesitan agua limpia.', 'image_url' => null], ['id' => 'd', 'text' => 'El agua sucia tiene más vida.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack 4 — g34_inventors_notebook  (core, seq 4)
        // Primary: supporting_details, inference, cause_effect
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => 'El cuaderno de inventos de Ana',
                'mission_description' => 'Lee y descubre la idea principal.',
                'instructions_es' => 'Lee y escoge la idea principal.',
                'content' => ['passage' => 'Ana escribía en su cuaderno cada idea que le venía a la mente. Anotaba problemas, posibles soluciones e ilustraciones. Así aprendió que los inventores siempre empiezan por observar y anotar.', 'question' => '¿Cuál es la idea principal?', 'options' => [['id' => 'a', 'text' => 'Ana aprendió que anotar ideas y observar es el primer paso para inventar.', 'image_url' => null], ['id' => 'b', 'text' => 'Ana no sabía para qué servía su cuaderno.', 'image_url' => null], ['id' => 'c', 'text' => 'El cuaderno de Ana estaba siempre vacío.', 'image_url' => null], ['id' => 'd', 'text' => 'Ana se dedicaba a copiar ideas de otros.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Detalle del cuaderno de inventos',
                'mission_description' => 'Busca el detalle que muestra cómo usaba Ana su cuaderno.',
                'instructions_es' => 'Lee y escoge el detalle correcto.',
                'content' => ['passage' => 'Ana anotaba problemas, soluciones posibles e ilustraciones en su cuaderno.', 'question' => '¿Qué anotaba Ana en su cuaderno?', 'options' => [['id' => 'a', 'text' => 'Problemas, soluciones e ilustraciones.', 'image_url' => null], ['id' => 'b', 'text' => 'Solo dibujos de flores.', 'image_url' => null], ['id' => 'c', 'text' => 'Las tareas de matemáticas.', 'image_url' => null], ['id' => 'd', 'text' => 'Las comidas del día.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'inference', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => 'Infiere qué tipo de persona es Ana',
                'mission_description' => 'Usa las pistas para inferir sobre Ana.',
                'instructions_es' => 'Lee y escoge la inferencia correcta.',
                'content' => ['passage' => 'Ana siempre llevaba su cuaderno y nunca dejaba pasar una idea sin anotarla.', 'question' => '¿Qué podemos inferir sobre Ana?', 'options' => [['id' => 'a', 'text' => 'Es una persona curiosa y organizada.', 'image_url' => null], ['id' => 'b', 'text' => 'Es una persona distraída que olvida todo.', 'image_url' => null], ['id' => 'c', 'text' => 'Ana solo anota para no aburrirse.', 'image_url' => null], ['id' => 'd', 'text' => 'El cuaderno es un regalo que no usa.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'cause_effect', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'mission',
                'mission_title' => 'Causa y efecto del cuaderno',
                'mission_description' => 'Piensa qué consecuencia tiene anotar ideas.',
                'instructions_es' => 'Lee y escoge el efecto correcto.',
                'content' => ['passage' => 'Por anotar sus ideas, Ana pudo volver a revisarlas y mejorar sus inventos.', 'question' => '¿Cuál fue el efecto de que Ana anotara sus ideas?', 'options' => [['id' => 'a', 'text' => 'Pudo revisarlas y mejorar sus inventos.', 'image_url' => null], ['id' => 'b', 'text' => 'Las ideas desaparecieron rápido.', 'image_url' => null], ['id' => 'c', 'text' => 'Ana dejó de inventar cosas.', 'image_url' => null], ['id' => 'd', 'text' => 'El cuaderno se llenó de errores.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack 5 — g34_growing_plants  (core, seq 5)
        // Primary: sequencing, cause_effect, supporting_details
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'calm',
                'mission_title' => 'La planta de la clase crece',
                'mission_description' => 'Lee y descubre la idea principal.',
                'instructions_es' => 'Lee y escoge la idea principal.',
                'content' => ['passage' => 'La clase plantó semillas y las observó cada día. Vieron cómo la semilla germinaba, el tallo crecía y aparecían las primeras hojas. Aprendieron que las plantas necesitan agua, luz y cuidado.', 'question' => '¿Cuál es la idea principal?', 'options' => [['id' => 'a', 'text' => 'La clase aprendió cómo crece una planta cuidándola desde semilla.', 'image_url' => null], ['id' => 'b', 'text' => 'La planta no necesitaba agua ni luz.', 'image_url' => null], ['id' => 'c', 'text' => 'La semilla nunca germinó.', 'image_url' => null], ['id' => 'd', 'text' => 'Solo una estudiante cuido la planta.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'sequencing', 'grade_band' => 'middle',
                'type' => 'story_strip_sequencing', 'difficulty' => 2,
                'lesson_mood' => 'mission',
                'mission_title' => 'Ordena el ciclo de crecimiento',
                'mission_description' => 'Arrastra las tiras en el orden correcto.',
                'instructions_es' => 'Ordena los eventos en el orden correcto.',
                'content' => ['strips' => [['id' => 's1', 'text' => 'La clase plantó la semilla en tierra.', 'image_prompt' => 'child planting seed in pot of soil'], ['id' => 's2', 'text' => 'La semilla germinó y salió un pequeño tallo.', 'image_prompt' => 'small green sprout emerging from soil'], ['id' => 's3', 'text' => 'Aparecieron las primeras hojas verdes.', 'image_prompt' => 'small plant with first leaves in pot'], ['id' => 's4', 'text' => 'La planta estaba grande y sana.', 'image_prompt' => 'healthy plant in classroom pot']], 'instructions' => 'Arrastra las tiras en orden.'],
                'correct_answer' => ['sequence' => ['s1', 's2', 's3', 's4']],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'cause_effect', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => '¿Por qué creció la planta?',
                'mission_description' => 'Piensa qué causó que la planta creciera bien.',
                'instructions_es' => 'Lee y escoge la causa correcta.',
                'content' => ['passage' => 'La planta creció fuerte porque recibió agua y luz solar cada día.', 'question' => '¿Por qué creció bien la planta?', 'options' => [['id' => 'a', 'text' => 'Porque recibió agua y luz solar cada día.', 'image_url' => null], ['id' => 'b', 'text' => 'Porque la pusieron en un lugar oscuro.', 'image_url' => null], ['id' => 'c', 'text' => 'Porque la dejaron sin regar mucho tiempo.', 'image_url' => null], ['id' => 'd', 'text' => 'Porque era una planta mágica.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Detalle del cuidado de la planta',
                'mission_description' => 'Encuentra qué detalle apoya el crecimiento.',
                'instructions_es' => 'Lee y escoge el detalle correcto.',
                'content' => ['passage' => 'La clase regó la planta cada mañana y la puso cerca de la ventana para que recibiera luz.', 'question' => '¿Qué hizo la clase para cuidar la planta?', 'options' => [['id' => 'a', 'text' => 'La regó cada mañana y la puso cerca de la ventana.', 'image_url' => null], ['id' => 'b', 'text' => 'La dejó sin luz en un armario.', 'image_url' => null], ['id' => 'c', 'text' => 'La cubrió con papel para protegerla.', 'image_url' => null], ['id' => 'd', 'text' => 'La regó solo una vez al mes.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack 6 — g34_maps_and_neighborhoods  (core, seq 6)
        // Primary: main_idea, supporting_details, compare_contrast
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'calm',
                'mission_title' => 'Explora el mapa del vecindario',
                'mission_description' => 'Lee y descubre la idea principal.',
                'instructions_es' => 'Lee y escoge la idea principal.',
                'content' => ['passage' => 'La clase usó mapas para estudiar su vecindario. Vieron calles, parques y edificios. Aprendieron que los mapas ayudan a orientarse.', 'question' => '¿Cuál es la idea principal?', 'options' => [['id' => 'a', 'text' => 'Los mapas ayudan a entender y orientarse en el vecindario.', 'image_url' => null], ['id' => 'b', 'text' => 'Los mapas no tienen ningún uso.', 'image_url' => null], ['id' => 'c', 'text' => 'Solo los adultos pueden leer mapas.', 'image_url' => null], ['id' => 'd', 'text' => 'El vecindario no tiene ningún parque.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Detalle del mapa del vecindario',
                'mission_description' => 'Busca el detalle que explica qué hay en el mapa.',
                'instructions_es' => 'Lee y escoge el detalle correcto.',
                'content' => ['passage' => 'El mapa mostraba calles principales, parques y escuelas del vecindario.', 'question' => '¿Qué mostraba el mapa?', 'options' => [['id' => 'a', 'text' => 'Calles principales, parques y escuelas.', 'image_url' => null], ['id' => 'b', 'text' => 'Solo ríos y montañas.', 'image_url' => null], ['id' => 'c', 'text' => 'Solo la escuela, sin nada más.', 'image_url' => null], ['id' => 'd', 'text' => 'Los nombres de las personas del vecindario.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'compare_contrast', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => 'Compara dos mapas',
                'mission_description' => 'Piensa en qué se parecen y en qué son diferentes.',
                'instructions_es' => 'Lee y escoge la mejor comparación.',
                'content' => ['passage' => 'Un mapa del vecindario muestra calles locales. Un mapa del país muestra ciudades y carreteras.', 'question' => '¿Cuál es la mejor comparación?', 'options' => [['id' => 'a', 'text' => 'Los dos son mapas pero muestran áreas de diferente tamaño.', 'image_url' => null], ['id' => 'b', 'text' => 'Son exactamente iguales.', 'image_url' => null], ['id' => 'c', 'text' => 'El mapa del vecindario muestra ciudades.', 'image_url' => null], ['id' => 'd', 'text' => 'Solo el mapa del país es útil.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'inference', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'mission',
                'mission_title' => 'Infiere cuándo usar un mapa',
                'mission_description' => 'Usa lo que sabes para inferir cuándo es útil un mapa.',
                'instructions_es' => 'Lee y escoge la inferencia correcta.',
                'content' => ['passage' => 'Cuando la clase llegó a una ciudad nueva, no sabían cómo llegar al museo.', 'question' => '¿Cuándo sería más útil un mapa?', 'options' => [['id' => 'a', 'text' => 'Al llegar a un lugar desconocido y buscar una dirección.', 'image_url' => null], ['id' => 'b', 'text' => 'Cuando ya conoces bien un lugar.', 'image_url' => null], ['id' => 'c', 'text' => 'Para decidir qué comer.', 'image_url' => null], ['id' => 'd', 'text' => 'Solo cuando hay tormenta.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack 7 — g34_recycling_day  (core, seq 7)
        // Primary: cause_effect, sequencing, supporting_details
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'calm',
                'mission_title' => 'El día del reciclaje en la clase',
                'mission_description' => 'Lee y descubre la idea principal.',
                'instructions_es' => 'Lee y escoge la idea principal.',
                'content' => ['passage' => 'La clase organizó un día de reciclaje. Separaron papel, plástico y vidrio. Aprendieron que reciclar ayuda al medioambiente.', 'question' => '¿Cuál es la idea principal?', 'options' => [['id' => 'a', 'text' => 'La clase aprendió a reciclar para ayudar al medioambiente.', 'image_url' => null], ['id' => 'b', 'text' => 'La clase tiró toda la basura junta.', 'image_url' => null], ['id' => 'c', 'text' => 'Solo el vidrio se puede reciclar.', 'image_url' => null], ['id' => 'd', 'text' => 'El reciclaje no sirve para nada.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'sequencing', 'grade_band' => 'middle',
                'type' => 'story_strip_sequencing', 'difficulty' => 2,
                'lesson_mood' => 'mission',
                'mission_title' => 'Ordena el proceso de reciclaje',
                'mission_description' => 'Arrastra las tiras en el orden correcto.',
                'instructions_es' => 'Ordena los pasos del proceso.',
                'content' => ['strips' => [['id' => 's1', 'text' => 'La clase recopiló materiales usados.', 'image_prompt' => 'students collecting used paper, plastic and glass'], ['id' => 's2', 'text' => 'Separaron papel, plástico y vidrio.', 'image_prompt' => 'children sorting waste into colored bins'], ['id' => 's3', 'text' => 'Pusieron los materiales en los contenedores correctos.', 'image_prompt' => 'students placing sorted items in recycling containers'], ['id' => 's4', 'text' => 'La clase aprendió por qué reciclar es importante.', 'image_prompt' => 'teacher explaining benefits of recycling to class']], 'instructions' => 'Arrastra las tiras en orden.'],
                'correct_answer' => ['sequence' => ['s1', 's2', 's3', 's4']],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'cause_effect', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => '¿Por qué reciclar ayuda al planeta?',
                'mission_description' => 'Piensa en la relación causa-efecto del reciclaje.',
                'instructions_es' => 'Lee y escoge el efecto correcto.',
                'content' => ['passage' => 'Cuando reciclamos, usamos menos materias primas y producimos menos basura.', 'question' => '¿Cuál es el efecto del reciclaje?', 'options' => [['id' => 'a', 'text' => 'Se usa menos material natural y se genera menos basura.', 'image_url' => null], ['id' => 'b', 'text' => 'Se produce más basura en la ciudad.', 'image_url' => null], ['id' => 'c', 'text' => 'No cambia nada en el medioambiente.', 'image_url' => null], ['id' => 'd', 'text' => 'Se necesita más agua para limpiar.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Detalle del reciclaje',
                'mission_description' => 'Busca el detalle que apoya la acción de reciclar.',
                'instructions_es' => 'Lee y escoge el detalle correcto.',
                'content' => ['passage' => 'La clase separó papel, plástico y vidrio en contenedores de colores.', 'question' => '¿Qué hizo la clase para reciclar bien?', 'options' => [['id' => 'a', 'text' => 'Separó papel, plástico y vidrio en contenedores de colores.', 'image_url' => null], ['id' => 'b', 'text' => 'Puso todo junto en un solo contenedor.', 'image_url' => null], ['id' => 'c', 'text' => 'Tiró todo a la basura sin separar.', 'image_url' => null], ['id' => 'd', 'text' => 'Solo separó papel.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack 8 — g34_weather_watchers  (waves 8-10, seq 7)
        // Primary: supporting_details, cause_effect, main_idea
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'calm',
                'mission_title' => 'La clase observa el clima',
                'mission_description' => 'Lee y descubre la idea principal.',
                'instructions_es' => 'Lee y escoge la idea principal.',
                'content' => ['passage' => 'La clase registró la temperatura y el tipo de cielo cada día durante una semana. Usaron una tabla para ver los cambios. Al final entendieron cómo el clima varía.', 'question' => '¿Cuál es la idea principal?', 'options' => [['id' => 'a', 'text' => 'Observar y registrar datos ayuda a entender cómo cambia el clima.', 'image_url' => null], ['id' => 'b', 'text' => 'El clima nunca cambia.', 'image_url' => null], ['id' => 'c', 'text' => 'La clase solo dibujó nubes.', 'image_url' => null], ['id' => 'd', 'text' => 'La tabla de datos no fue útil.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Detalle del registro del clima',
                'mission_description' => 'Busca el detalle que explica qué registraron.',
                'instructions_es' => 'Lee y escoge el detalle correcto.',
                'content' => ['passage' => 'La clase registró temperatura y tipo de cielo cada día durante una semana.', 'question' => '¿Qué datos registró la clase?', 'options' => [['id' => 'a', 'text' => 'Temperatura y tipo de cielo.', 'image_url' => null], ['id' => 'b', 'text' => 'Solo la velocidad del viento.', 'image_url' => null], ['id' => 'c', 'text' => 'Los nombres de los estudiantes.', 'image_url' => null], ['id' => 'd', 'text' => 'Solo si llovió o no.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'cause_effect', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => 'Causa y efecto del cielo nublado',
                'mission_description' => 'Piensa qué causa trae el cielo nublado.',
                'instructions_es' => 'Lee y escoge el efecto correcto.',
                'content' => ['passage' => 'Cuando el cielo se pone muy nublado y oscuro, suele llover poco después.', 'question' => '¿Qué efecto tiene un cielo muy nublado?', 'options' => [['id' => 'a', 'text' => 'Generalmente sigue la lluvia.', 'image_url' => null], ['id' => 'b', 'text' => 'Sale el sol más fuerte.', 'image_url' => null], ['id' => 'c', 'text' => 'El cielo se vuelve azul.', 'image_url' => null], ['id' => 'd', 'text' => 'No ocurre nada especial.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'inference', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'mission',
                'mission_title' => 'Infiere qué tiempo hará mañana',
                'mission_description' => 'Usa los datos del registro para inferir.',
                'instructions_es' => 'Lee y escoge la inferencia correcta.',
                'content' => ['passage' => 'Ayer la temperatura bajó y el cielo se nubló. Esta mañana hay más nubes oscuras.', 'question' => '¿Qué podemos inferir sobre mañana?', 'options' => [['id' => 'a', 'text' => 'Probablemente lloverá.', 'image_url' => null], ['id' => 'b', 'text' => 'Hará mucho calor y sol.', 'image_url' => null], ['id' => 'c', 'text' => 'El cielo estará completamente despejado.', 'image_url' => null], ['id' => 'd', 'text' => 'La temperatura subirá mucho.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack 9 — g34_park_cleanup  (waves 8-10, seq 9)
        // Primary: cause_effect, supporting_details, inference
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'calm',
                'mission_title' => 'La clase limpia el parque',
                'mission_description' => 'Lee y descubre la idea principal.',
                'instructions_es' => 'Lee y escoge la idea principal.',
                'content' => ['passage' => 'La clase fue al parque y encontró basura. Decidieron limpiar juntos. Recogieron bolsas, botellas y envolturas. El parque quedó mejor para todos.', 'question' => '¿Cuál es la idea principal?', 'options' => [['id' => 'a', 'text' => 'La clase actuó en equipo para mejorar el parque.', 'image_url' => null], ['id' => 'b', 'text' => 'La basura en el parque no importa.', 'image_url' => null], ['id' => 'c', 'text' => 'Solo la maestra recogió la basura.', 'image_url' => null], ['id' => 'd', 'text' => 'El parque estaba limpio desde antes.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'cause_effect', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => '¿Qué causó la basura en el parque?',
                'mission_description' => 'Piensa qué pasó porque había basura.',
                'instructions_es' => 'Lee y escoge el efecto correcto.',
                'content' => ['passage' => 'La basura en el parque ensuciaba el suelo y podía lastimar a los animales.', 'question' => '¿Qué efecto tiene la basura en el parque?', 'options' => [['id' => 'a', 'text' => 'Ensucia el suelo y puede lastimar animales.', 'image_url' => null], ['id' => 'b', 'text' => 'Hace crecer más plantas.', 'image_url' => null], ['id' => 'c', 'text' => 'Atrae a más personas a jugar.', 'image_url' => null], ['id' => 'd', 'text' => 'No tiene ningún efecto.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Detalle de la limpieza del parque',
                'mission_description' => 'Encuentra qué hizo la clase específicamente.',
                'instructions_es' => 'Lee y escoge el detalle correcto.',
                'content' => ['passage' => 'Recogieron bolsas, botellas y envolturas y las pusieron en bolsas de basura.', 'question' => '¿Qué recogió la clase?', 'options' => [['id' => 'a', 'text' => 'Bolsas, botellas y envolturas.', 'image_url' => null], ['id' => 'b', 'text' => 'Solo hojas secas del suelo.', 'image_url' => null], ['id' => 'c', 'text' => 'Ramas y piedras.', 'image_url' => null], ['id' => 'd', 'text' => 'Solo botellas de vidrio.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'inference', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'mission',
                'mission_title' => 'Infiere qué pasa si se cuida el parque',
                'mission_description' => 'Usa lo que sabes para inferir la consecuencia.',
                'instructions_es' => 'Lee y escoge la inferencia correcta.',
                'content' => ['passage' => 'Después de limpiar, el parque quedó limpio y los niños podían jugar sin peligro.', 'question' => '¿Qué se puede inferir sobre cuidar los espacios públicos?', 'options' => [['id' => 'a', 'text' => 'Los espacios limpios son más seguros y agradables para todos.', 'image_url' => null], ['id' => 'b', 'text' => 'Da lo mismo si el parque está limpio o sucio.', 'image_url' => null], ['id' => 'c', 'text' => 'Limpiar el parque no tuvo ningún efecto.', 'image_url' => null], ['id' => 'd', 'text' => 'Solo los adultos deben preocuparse por la limpieza.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack 10 — g34_butterfly_garden  (support/support_only)
        // Primary: inference, supporting_details, cause_effect
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'calm',
                'mission_title' => 'Las mariposas del jardín',
                'mission_description' => 'Lee y descubre la idea principal.',
                'instructions_es' => 'Lee y escoge la idea principal.',
                'content' => ['passage' => 'El jardín de mariposas tiene plantas que atraen a diferentes especies. La mariposa monarca visita flores ricas en néctar. Cada especie tiene su planta favorita.', 'question' => '¿Cuál es la idea principal?', 'options' => [['id' => 'a', 'text' => 'Diferentes mariposas visitan diferentes plantas en el jardín.', 'image_url' => null], ['id' => 'b', 'text' => 'Solo la mariposa monarca existe en el jardín.', 'image_url' => null], ['id' => 'c', 'text' => 'Las mariposas no visitan flores.', 'image_url' => null], ['id' => 'd', 'text' => 'El jardín solo tiene una planta.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'inference', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => 'Infiere por qué visitan las mariposas',
                'mission_description' => 'Usa las pistas para inferir el motivo.',
                'instructions_es' => 'Lee y escoge la inferencia correcta.',
                'content' => ['passage' => 'La mariposa monarca siempre vuelve al jardín donde hay flores de lavanda y milkweed.', 'question' => '¿Por qué vuelve la mariposa al mismo jardín?', 'options' => [['id' => 'a', 'text' => 'Porque ese jardín tiene las plantas que necesita para alimentarse.', 'image_url' => null], ['id' => 'b', 'text' => 'Porque las otras mariposas la mandan.', 'image_url' => null], ['id' => 'c', 'text' => 'Porque el jardín tiene muchos colores brillantes.', 'image_url' => null], ['id' => 'd', 'text' => 'Porque el jardín es el más grande.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'cause_effect', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'mission',
                'mission_title' => '¿Por qué crecen más flores con mariposas?',
                'mission_description' => 'Piensa en la causa-efecto de la visita.',
                'instructions_es' => 'Lee y escoge el efecto correcto.',
                'content' => ['passage' => 'Cuando las mariposas visitan flores, llevan néctar de una planta a otra y ayudan a la polinización.', 'question' => '¿Cuál es el efecto de las visitas de las mariposas?', 'options' => [['id' => 'a', 'text' => 'Ayudan a la polinización y a que crezcan más flores.', 'image_url' => null], ['id' => 'b', 'text' => 'Las flores se marchitan más rápido.', 'image_url' => null], ['id' => 'c', 'text' => 'Las plantas dejan de producir néctar.', 'image_url' => null], ['id' => 'd', 'text' => 'El jardín pierde sus colores.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Detalle de la planta favorita',
                'mission_description' => 'Encuentra qué detalle explica la planta de la monarca.',
                'instructions_es' => 'Lee y escoge el detalle correcto.',
                'content' => ['passage' => 'La mariposa monarca prefiere el milkweed porque en esa planta pone sus huevos.', 'question' => '¿Por qué prefiere el milkweed la mariposa monarca?', 'options' => [['id' => 'a', 'text' => 'Porque en esa planta pone sus huevos.', 'image_url' => null], ['id' => 'b', 'text' => 'Porque es la planta más colorida.', 'image_url' => null], ['id' => 'c', 'text' => 'Porque el milkweed tiene mucho néctar.', 'image_url' => null], ['id' => 'd', 'text' => 'Porque le gusta su olor.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // ----------------------------------------------------------------
        // Packs 11–20 — structured waves 11–20  (4 activities each)
        // ----------------------------------------------------------------

        // Pack 11 — g34_tool_trouble
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => 'El problema con las herramientas',
                'mission_description' => 'Lee y descubre la idea principal.',
                'instructions_es' => 'Lee y escoge la idea principal.',
                'content' => ['passage' => 'En el taller escolar las herramientas no estaban ordenadas. Nadie podía encontrar lo que necesitaba. La clase decidió crear un sistema de organización.', 'question' => '¿Cuál es la idea principal?', 'options' => [['id' => 'a', 'text' => 'Crear un sistema de organización resuelve el problema del taller.', 'image_url' => null], ['id' => 'b', 'text' => 'Las herramientas ya no servían.', 'image_url' => null], ['id' => 'c', 'text' => 'El taller no tenía herramientas.', 'image_url' => null], ['id' => 'd', 'text' => 'La clase no quería usar el taller.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Detalle del problema del taller',
                'mission_description' => 'Busca el detalle que describe el problema.',
                'instructions_es' => 'Lee y escoge el detalle correcto.',
                'content' => ['passage' => 'Las herramientas del taller estaban mezcladas y nadie sabía dónde estaban los martillos ni los destornilladores.', 'question' => '¿Qué detalle describe el problema?', 'options' => [['id' => 'a', 'text' => 'Las herramientas estaban mezcladas y nadie las encontraba.', 'image_url' => null], ['id' => 'b', 'text' => 'El taller siempre estaba ordenado.', 'image_url' => null], ['id' => 'c', 'text' => 'Solo faltaba un martillo.', 'image_url' => null], ['id' => 'd', 'text' => 'Las herramientas eran de otro taller.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'inference', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'mission',
                'mission_title' => 'Infiere la solución del taller',
                'mission_description' => 'Usa las pistas para inferir qué hará la clase.',
                'instructions_es' => 'Lee y escoge la inferencia correcta.',
                'content' => ['passage' => 'La clase decidió etiquetar cada herramienta y asignarle un lugar fijo en el estante.', 'question' => '¿Qué podemos inferir sobre el resultado?', 'options' => [['id' => 'a', 'text' => 'El taller quedará ordenado y fácil de usar.', 'image_url' => null], ['id' => 'b', 'text' => 'Las herramientas seguirán perdidas.', 'image_url' => null], ['id' => 'c', 'text' => 'El taller tendrá más problemas.', 'image_url' => null], ['id' => 'd', 'text' => 'La clase dejará de usar el taller.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'cause_effect', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => '¿Qué causó el desorden del taller?',
                'mission_description' => 'Piensa en la causa del problema.',
                'instructions_es' => 'Lee y escoge la causa correcta.',
                'content' => ['passage' => 'El desorden del taller ocurrió porque cada persona dejaba las herramientas en cualquier lugar.', 'question' => '¿Cuál fue la causa del desorden?', 'options' => [['id' => 'a', 'text' => 'Cada persona dejaba las herramientas en cualquier lugar.', 'image_url' => null], ['id' => 'b', 'text' => 'Alguien robó algunas herramientas.', 'image_url' => null], ['id' => 'c', 'text' => 'El estante era demasiado pequeño.', 'image_url' => null], ['id' => 'd', 'text' => 'Las herramientas llegaron sin etiquetas.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // Pack 12 — g34_clue_letters
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => 'Las cartas con pistas',
                'mission_description' => 'Lee y descubre la idea principal.',
                'instructions_es' => 'Lee y escoge la idea principal.',
                'content' => ['passage' => 'Cada carta tenía una pista sobre un personaje secreto. La clase leyó todas las cartas y usó las pistas para identificar a quién pertenecían.', 'question' => '¿Cuál es la idea principal?', 'options' => [['id' => 'a', 'text' => 'Leer las pistas de las cartas ayuda a identificar al personaje secreto.', 'image_url' => null], ['id' => 'b', 'text' => 'Las cartas no tenían ninguna pista.', 'image_url' => null], ['id' => 'c', 'text' => 'La clase ignoró las cartas.', 'image_url' => null], ['id' => 'd', 'text' => 'El personaje secreto estaba en el aula.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'inference', 'grade_band' => 'middle',
                'type' => 'illustrated_clue', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => 'Descifra la pista de la carta',
                'mission_description' => 'Mira la imagen y lee la pista para inferir el personaje.',
                'instructions_es' => 'Usa la imagen y el texto para inferir.',
                'content' => ['image_url' => null, 'image_prompt' => 'envelope with small magnifying glass icon drawn on it', 'passage' => 'La carta dice: "Soy muy pequeño, tengo muchas patas y vivo bajo las rocas."', 'question' => '¿Quién es el personaje secreto?', 'options' => [['id' => 'a', 'text' => 'Un ciempiés.', 'image_url' => null], ['id' => 'b', 'text' => 'Un pájaro.', 'image_url' => null], ['id' => 'c', 'text' => 'Un perro.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Detalle de la carta misteriosa',
                'mission_description' => 'Busca el detalle que ayuda a identificar al personaje.',
                'instructions_es' => 'Lee y escoge el detalle correcto.',
                'content' => ['passage' => 'La carta decía: el personaje tiene alas, vuela de noche y come insectos.', 'question' => '¿Cuál detalle ayuda a identificar al personaje?', 'options' => [['id' => 'a', 'text' => 'Tiene alas, vuela de noche y come insectos.', 'image_url' => null], ['id' => 'b', 'text' => 'Tiene cuatro patas y ladra.', 'image_url' => null], ['id' => 'c', 'text' => 'Vive en el agua y nada muy rápido.', 'image_url' => null], ['id' => 'd', 'text' => 'Es de color azul y vive en un árbol.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'cause_effect', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'mission',
                'mission_title' => '¿Por qué la clase resolvió el misterio?',
                'mission_description' => 'Piensa qué causó que resolvieran el misterio.',
                'instructions_es' => 'Lee y escoge la causa correcta.',
                'content' => ['passage' => 'La clase resolvió el misterio porque usó todas las pistas de las cartas juntas.', 'question' => '¿Por qué la clase resolvió el misterio?', 'options' => [['id' => 'a', 'text' => 'Porque usó todas las pistas juntas.', 'image_url' => null], ['id' => 'b', 'text' => 'Porque adivinó sin leer.', 'image_url' => null], ['id' => 'c', 'text' => 'Porque un estudiante sabía la respuesta desde antes.', 'image_url' => null], ['id' => 'd', 'text' => 'Porque la maestra les dijo la respuesta.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // Pack 13 — g34_two_solutions
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => 'Dos soluciones para un problema',
                'mission_description' => 'Lee y descubre la idea principal.',
                'instructions_es' => 'Lee y escoge la idea principal.',
                'content' => ['passage' => 'Cuando la planta de la clase se secó, algunos pensaban regarla más; otros pensaban cambiarla de lugar con más luz. La clase comparó las dos soluciones.', 'question' => '¿Cuál es la idea principal?', 'options' => [['id' => 'a', 'text' => 'A veces hay más de una solución y es útil comparar antes de actuar.', 'image_url' => null], ['id' => 'b', 'text' => 'Siempre hay una sola solución para cada problema.', 'image_url' => null], ['id' => 'c', 'text' => 'La planta no necesitaba ninguna solución.', 'image_url' => null], ['id' => 'd', 'text' => 'La clase no pudo resolver el problema.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'compare_contrast', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => 'Compara las dos soluciones',
                'mission_description' => 'Piensa en qué se parecen y en qué son diferentes.',
                'instructions_es' => 'Lee y escoge la mejor comparación.',
                'content' => ['passage' => 'Solución A: regar más la planta. Solución B: cambiarla a un lugar con más luz.', 'question' => '¿Cuál es la mejor comparación de las dos soluciones?', 'options' => [['id' => 'a', 'text' => 'Las dos buscan ayudar a la planta pero de formas diferentes.', 'image_url' => null], ['id' => 'b', 'text' => 'Son exactamente la misma solución.', 'image_url' => null], ['id' => 'c', 'text' => 'Solo la solución B funciona siempre.', 'image_url' => null], ['id' => 'd', 'text' => 'Las dos harían daño a la planta.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'cause_effect', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'mission',
                'mission_title' => '¿Qué causa eligió la clase?',
                'mission_description' => 'Piensa qué decisión tomó la clase y su efecto.',
                'instructions_es' => 'Lee y escoge el efecto correcto.',
                'content' => ['passage' => 'La clase decidió cambiar la planta a un lugar con más luz y también regarla con moderación. La planta se recuperó.', 'question' => '¿Cuál fue el efecto de la decisión de la clase?', 'options' => [['id' => 'a', 'text' => 'La planta se recuperó.', 'image_url' => null], ['id' => 'b', 'text' => 'La planta se marchitó más.', 'image_url' => null], ['id' => 'c', 'text' => 'La planta no cambió nada.', 'image_url' => null], ['id' => 'd', 'text' => 'La planta creció demasiado rápido.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'inference', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => 'Infiere la mejor solución',
                'mission_description' => 'Usa las pistas para inferir qué solución es mejor.',
                'instructions_es' => 'Lee y escoge la inferencia correcta.',
                'content' => ['passage' => 'La planta estaba seca y estaba en un rincón oscuro. Tenía poca agua y poca luz.', 'question' => '¿Cuál sería la mejor solución inferida?', 'options' => [['id' => 'a', 'text' => 'Regarla más y cambiarla a un lugar con luz.', 'image_url' => null], ['id' => 'b', 'text' => 'Solo hablarle a la planta.', 'image_url' => null], ['id' => 'c', 'text' => 'Dejarla donde está y no tocarla.', 'image_url' => null], ['id' => 'd', 'text' => 'Regarla menos todavía.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // Pack 14 — g34_missing_steps
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'sequencing', 'grade_band' => 'middle',
                'type' => 'story_strip_sequencing', 'difficulty' => 2,
                'lesson_mood' => 'mission',
                'mission_title' => 'Completa los pasos que faltan',
                'mission_description' => 'Arrastra las tiras en el orden correcto.',
                'instructions_es' => 'Ordena los pasos del proceso.',
                'content' => ['strips' => [['id' => 's1', 'text' => 'Reunir los materiales necesarios.', 'image_prompt' => 'student gathering materials at desk'], ['id' => 's2', 'text' => 'Leer las instrucciones completas.', 'image_prompt' => 'student reading instruction sheet carefully'], ['id' => 's3', 'text' => 'Seguir cada paso en orden.', 'image_prompt' => 'student following steps of an activity'], ['id' => 's4', 'text' => 'Revisar el trabajo terminado.', 'image_prompt' => 'student checking completed work']], 'instructions' => 'Arrastra las tiras en el orden correcto.'],
                'correct_answer' => ['sequence' => ['s1', 's2', 's3', 's4']],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Detalle del paso faltante',
                'mission_description' => 'Busca el paso que faltó y que causó el problema.',
                'instructions_es' => 'Lee y escoge el detalle correcto.',
                'content' => ['passage' => 'Miguel saltó el paso de leer las instrucciones y su proyecto no salió bien.', 'question' => '¿Qué paso saltó Miguel?', 'options' => [['id' => 'a', 'text' => 'Leer las instrucciones.', 'image_url' => null], ['id' => 'b', 'text' => 'Reunir los materiales.', 'image_url' => null], ['id' => 'c', 'text' => 'Revisar el trabajo.', 'image_url' => null], ['id' => 'd', 'text' => 'Pedir ayuda a un amigo.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'cause_effect', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => '¿Qué pasó por saltar el paso?',
                'mission_description' => 'Piensa qué efecto tuvo saltarse las instrucciones.',
                'instructions_es' => 'Lee y escoge el efecto correcto.',
                'content' => ['passage' => 'Como Miguel no leyó las instrucciones, armó las piezas en el orden incorrecto.', 'question' => '¿Qué efecto tuvo no leer las instrucciones?', 'options' => [['id' => 'a', 'text' => 'Armó las piezas en el orden incorrecto.', 'image_url' => null], ['id' => 'b', 'text' => 'El proyecto quedó perfecto.', 'image_url' => null], ['id' => 'c', 'text' => 'No le pasó nada malo.', 'image_url' => null], ['id' => 'd', 'text' => 'Los materiales se perdieron.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'inference', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'mission',
                'mission_title' => 'Infiere cómo evitar el error',
                'mission_description' => 'Usa las pistas para inferir la solución.',
                'instructions_es' => 'Lee y escoge la inferencia correcta.',
                'content' => ['passage' => 'Miguel aprendió que seguir todos los pasos en orden es clave para que el proyecto salga bien.', 'question' => '¿Qué podemos inferir sobre los proyectos?', 'options' => [['id' => 'a', 'text' => 'Seguir los pasos en orden es clave para que los proyectos salgan bien.', 'image_url' => null], ['id' => 'b', 'text' => 'Saltar pasos no afecta el resultado.', 'image_url' => null], ['id' => 'c', 'text' => 'Los proyectos siempre salen bien sin importar el orden.', 'image_url' => null], ['id' => 'd', 'text' => 'Leer instrucciones es pérdida de tiempo.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // Pack 15 — g34_best_evidence
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => 'Encuentra la mejor evidencia',
                'mission_description' => 'Lee y descubre la idea principal.',
                'instructions_es' => 'Lee y escoge la idea principal.',
                'content' => ['passage' => 'La clase aprendió que no toda la información apoya igual una idea. Hay que buscar la evidencia que más directamente la sustenta.', 'question' => '¿Cuál es la idea principal?', 'options' => [['id' => 'a', 'text' => 'La mejor evidencia es la que apoya más directamente la idea.', 'image_url' => null], ['id' => 'b', 'text' => 'Toda la información es igualmente buena como evidencia.', 'image_url' => null], ['id' => 'c', 'text' => 'No hace falta evidencia para apoyar una idea.', 'image_url' => null], ['id' => 'd', 'text' => 'Solo los datos numéricos son evidencia válida.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Escoge la mejor evidencia',
                'mission_description' => 'Busca el detalle que mejor apoya la idea.',
                'instructions_es' => 'Lee y escoge el mejor detalle de apoyo.',
                'content' => ['passage' => 'Idea: Las abejas son importantes para el ecosistema.', 'question' => '¿Cuál es la mejor evidencia para apoyar esa idea?', 'options' => [['id' => 'a', 'text' => 'Sin la polinización de las abejas, muchas plantas no podrían reproducirse.', 'image_url' => null], ['id' => 'b', 'text' => 'Las abejas tienen rayas amarillas y negras.', 'image_url' => null], ['id' => 'c', 'text' => 'Las abejas a veces pican.', 'image_url' => null], ['id' => 'd', 'text' => 'Las abejas viven en colmenas.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'inference', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'mission',
                'mission_title' => 'Infiere si la evidencia es suficiente',
                'mission_description' => 'Usa las pistas para inferir si apoya bien la idea.',
                'instructions_es' => 'Lee y escoge la inferencia correcta.',
                'content' => ['passage' => 'Un estudiante dijo: "Los perros son mascotas populares." Su evidencia fue: "Los perros son de color café."', 'question' => '¿Es suficiente esa evidencia?', 'options' => [['id' => 'a', 'text' => 'No, el color no apoya que sean mascotas populares.', 'image_url' => null], ['id' => 'b', 'text' => 'Sí, el color prueba que son populares.', 'image_url' => null], ['id' => 'c', 'text' => 'Sí, cualquier detalle sobre perros es evidencia válida.', 'image_url' => null], ['id' => 'd', 'text' => 'No hay suficiente información para decidir.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'cause_effect', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => '¿Qué pasa con evidencia débil?',
                'mission_description' => 'Piensa qué efecto tiene la evidencia débil.',
                'instructions_es' => 'Lee y escoge el efecto correcto.',
                'content' => ['passage' => 'Cuando la evidencia no apoya directamente la idea, el argumento se vuelve difícil de entender.', 'question' => '¿Cuál es el efecto de usar evidencia débil?', 'options' => [['id' => 'a', 'text' => 'El argumento se vuelve confuso y difícil de entender.', 'image_url' => null], ['id' => 'b', 'text' => 'El argumento se hace más fuerte.', 'image_url' => null], ['id' => 'c', 'text' => 'La idea queda mejor explicada.', 'image_url' => null], ['id' => 'd', 'text' => 'La evidencia ya no importa.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // Pack 16 — g34_clue_or_not
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => '¿Es una pista o no?',
                'mission_description' => 'Lee y descubre la idea principal.',
                'instructions_es' => 'Lee y escoge la idea principal.',
                'content' => ['passage' => 'No toda la información que encontramos es una pista útil. A veces un dato no tiene relación con lo que buscamos. La clase aprendió a distinguir pistas reales de información irrelevante.', 'question' => '¿Cuál es la idea principal?', 'options' => [['id' => 'a', 'text' => 'Distinguir pistas útiles de información irrelevante es importante.', 'image_url' => null], ['id' => 'b', 'text' => 'Toda la información es siempre una pista.', 'image_url' => null], ['id' => 'c', 'text' => 'Las pistas no son necesarias.', 'image_url' => null], ['id' => 'd', 'text' => 'La clase no aprendió nada sobre pistas.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'inference', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'mission',
                'mission_title' => 'Infiere si es una pista útil',
                'mission_description' => 'Usa las pistas para inferir qué información ayuda.',
                'instructions_es' => 'Lee y escoge si es pista útil o no.',
                'content' => ['passage' => 'Estás buscando qué animal hizo huellas en el barro. Encuentras: "El zorro tiene patas pequeñas con garras." y "El sol sale por el este."', 'question' => '¿Cuál es la pista útil?', 'options' => [['id' => 'a', 'text' => '"El zorro tiene patas pequeñas con garras."', 'image_url' => null], ['id' => 'b', 'text' => '"El sol sale por el este."', 'image_url' => null], ['id' => 'c', 'text' => 'Las dos son pistas útiles.', 'image_url' => null], ['id' => 'd', 'text' => 'Ninguna de las dos es útil.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Detalle que apoya la pista',
                'mission_description' => 'Busca el detalle que hace útil una pista.',
                'instructions_es' => 'Lee y escoge el detalle correcto.',
                'content' => ['passage' => 'Una pista es útil cuando tiene relación directa con el problema que estamos investigando.', 'question' => '¿Qué hace útil a una pista?', 'options' => [['id' => 'a', 'text' => 'Tener relación directa con el problema investigado.', 'image_url' => null], ['id' => 'b', 'text' => 'Ser la información más larga del texto.', 'image_url' => null], ['id' => 'c', 'text' => 'Aparecer al principio del texto.', 'image_url' => null], ['id' => 'd', 'text' => 'Tener muchas palabras difíciles.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'cause_effect', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => '¿Qué pasa con pistas falsas?',
                'mission_description' => 'Piensa qué efecto tienen las pistas irrelevantes.',
                'instructions_es' => 'Lee y escoge el efecto correcto.',
                'content' => ['passage' => 'Cuando se siguen pistas irrelevantes, se pierde tiempo y se llega a conclusiones incorrectas.', 'question' => '¿Qué efecto tienen las pistas irrelevantes?', 'options' => [['id' => 'a', 'text' => 'Se pierde tiempo y se llega a conclusiones incorrectas.', 'image_url' => null], ['id' => 'b', 'text' => 'Ayudan a encontrar la solución más rápido.', 'image_url' => null], ['id' => 'c', 'text' => 'No afectan la investigación.', 'image_url' => null], ['id' => 'd', 'text' => 'Hacen la investigación más fácil.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // Pack 17 — g34_fact_or_clue
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => '¿Hecho o pista?',
                'mission_description' => 'Lee y descubre la idea principal.',
                'instructions_es' => 'Lee y escoge la idea principal.',
                'content' => ['passage' => 'Un hecho es algo que se puede verificar. Una pista es información que ayuda a resolver un problema. La clase aprendió a distinguir entre los dos.', 'question' => '¿Cuál es la idea principal?', 'options' => [['id' => 'a', 'text' => 'Los hechos se verifican; las pistas ayudan a resolver problemas.', 'image_url' => null], ['id' => 'b', 'text' => 'Los hechos y las pistas son lo mismo.', 'image_url' => null], ['id' => 'c', 'text' => 'Las pistas siempre son más importantes que los hechos.', 'image_url' => null], ['id' => 'd', 'text' => 'Un hecho no se puede verificar.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'compare_contrast', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => 'Compara hecho y pista',
                'mission_description' => 'Piensa en qué se parecen y en qué son diferentes.',
                'instructions_es' => 'Lee y escoge la mejor comparación.',
                'content' => ['passage' => 'Hecho: La Tierra tarda 365 días en girar alrededor del Sol. Pista: la tierra estaba mojada, lo que indica que llovió.', 'question' => '¿Cuál es la mejor comparación?', 'options' => [['id' => 'a', 'text' => 'Los dos son formas de información; el hecho se verifica y la pista sirve para inferir.', 'image_url' => null], ['id' => 'b', 'text' => 'Son exactamente iguales.', 'image_url' => null], ['id' => 'c', 'text' => 'El hecho sirve para inferir y la pista para verificar.', 'image_url' => null], ['id' => 'd', 'text' => 'Solo el hecho es información real.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'inference', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'mission',
                'mission_title' => 'Identifica: ¿hecho o pista?',
                'mission_description' => 'Decide si la información es un hecho verificable o una pista.',
                'instructions_es' => 'Lee y escoge la categoría correcta.',
                'content' => ['passage' => '"El piso del pasillo estaba mojado esta mañana."', 'question' => '¿Esto es un hecho o una pista?', 'options' => [['id' => 'a', 'text' => 'Es una pista (sugiere que alguien entró con los zapatos mojados o que hubo un derrame).', 'image_url' => null], ['id' => 'b', 'text' => 'Es un hecho verificable sobre el estado del piso Y una pista sobre lo que pasó.', 'image_url' => null], ['id' => 'c', 'text' => 'No es ni hecho ni pista.', 'image_url' => null], ['id' => 'd', 'text' => 'Es solo una opinión.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'b'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Detalle que convierte datos en pistas',
                'mission_description' => 'Busca el detalle que explica cuándo un hecho es pista.',
                'instructions_es' => 'Lee y escoge el detalle correcto.',
                'content' => ['passage' => 'Un hecho puede convertirse en pista cuando lo usamos para responder una pregunta o resolver un problema.', 'question' => '¿Qué convierte un hecho en pista?', 'options' => [['id' => 'a', 'text' => 'Usarlo para responder una pregunta o resolver un problema.', 'image_url' => null], ['id' => 'b', 'text' => 'Que sea muy largo y difícil.', 'image_url' => null], ['id' => 'c', 'text' => 'Que esté escrito en negrita.', 'image_url' => null], ['id' => 'd', 'text' => 'Que alguien famoso lo haya dicho.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // Pack 18 — g34_strongest_clue
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => 'La pista más fuerte',
                'mission_description' => 'Lee y descubre la idea principal.',
                'instructions_es' => 'Lee y escoge la idea principal.',
                'content' => ['passage' => 'Cuando tienes varias pistas, la más fuerte es la que apoya tu conclusión de forma más directa y clara. La clase practicó identificar la pista más fuerte.', 'question' => '¿Cuál es la idea principal?', 'options' => [['id' => 'a', 'text' => 'La pista más fuerte apoya la conclusión de forma más directa.', 'image_url' => null], ['id' => 'b', 'text' => 'Todas las pistas tienen el mismo valor.', 'image_url' => null], ['id' => 'c', 'text' => 'La pista más larga es siempre la más fuerte.', 'image_url' => null], ['id' => 'd', 'text' => 'Las pistas no son necesarias para sacar conclusiones.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'inference', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'mission',
                'mission_title' => 'Infiere cuál pista es más fuerte',
                'mission_description' => 'Usa las pistas para inferir cuál apoya mejor.',
                'instructions_es' => 'Lee y escoge la pista más fuerte.',
                'content' => ['passage' => 'Conclusión: el jardín estuvo sin agua por varios días. Pistas: A) Las flores están marchitas y el suelo está seco. B) El jardinero no fue al trabajo ayer. C) Está nublado hoy.', 'question' => '¿Cuál es la pista más fuerte?', 'options' => [['id' => 'a', 'text' => 'A — flores marchitas y suelo seco.', 'image_url' => null], ['id' => 'b', 'text' => 'B — el jardinero no fue al trabajo.', 'image_url' => null], ['id' => 'c', 'text' => 'C — está nublado.', 'image_url' => null], ['id' => 'd', 'text' => 'Las tres pistas tienen el mismo peso.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Detalle que define la pista fuerte',
                'mission_description' => 'Busca el detalle que hace fuerte a una pista.',
                'instructions_es' => 'Lee y escoge el detalle correcto.',
                'content' => ['passage' => 'Una pista es fuerte cuando apoya la conclusión de forma directa, sin necesitar muchos pasos intermedios para conectarla.', 'question' => '¿Qué hace fuerte a una pista?', 'options' => [['id' => 'a', 'text' => 'Que apoye la conclusión de forma directa sin muchos pasos.', 'image_url' => null], ['id' => 'b', 'text' => 'Que sea la más difícil de entender.', 'image_url' => null], ['id' => 'c', 'text' => 'Que aparezca muchas veces en el texto.', 'image_url' => null], ['id' => 'd', 'text' => 'Que sea la primera pista que encontramos.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'cause_effect', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => '¿Qué pasa si usas la pista equivocada?',
                'mission_description' => 'Piensa en el efecto de elegir una pista débil.',
                'instructions_es' => 'Lee y escoge el efecto correcto.',
                'content' => ['passage' => 'Si usas una pista que no apoya directamente la conclusión, tu razonamiento puede ser incorrecto.', 'question' => '¿Qué efecto tiene elegir una pista débil?', 'options' => [['id' => 'a', 'text' => 'El razonamiento puede ser incorrecto.', 'image_url' => null], ['id' => 'b', 'text' => 'La conclusión es siempre correcta igual.', 'image_url' => null], ['id' => 'c', 'text' => 'La pista débil fortalece el argumento.', 'image_url' => null], ['id' => 'd', 'text' => 'No tiene ningún efecto en el razonamiento.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // Pack 19 — g34_what_proves_it
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => '¿Qué lo prueba?',
                'mission_description' => 'Lee y descubre la idea principal.',
                'instructions_es' => 'Lee y escoge la idea principal.',
                'content' => ['passage' => 'Para probar una afirmación necesitamos evidencia concreta. No es suficiente decir algo; hay que mostrar qué lo respalda. La clase practicó esta habilidad.', 'question' => '¿Cuál es la idea principal?', 'options' => [['id' => 'a', 'text' => 'Toda afirmación necesita evidencia concreta que la respalde.', 'image_url' => null], ['id' => 'b', 'text' => 'Decir algo con confianza es suficiente prueba.', 'image_url' => null], ['id' => 'c', 'text' => 'La evidencia no es necesaria en la lectura.', 'image_url' => null], ['id' => 'd', 'text' => 'Solo los científicos usan evidencia.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Busca la evidencia que lo prueba',
                'mission_description' => 'Encuentra el detalle que prueba la afirmación.',
                'instructions_es' => 'Lee y escoge el detalle que prueba la afirmación.',
                'content' => ['passage' => 'Afirmación: Los murciélagos son importantes para el ecosistema.', 'question' => '¿Cuál es la mejor evidencia?', 'options' => [['id' => 'a', 'text' => 'Los murciélagos comen millones de insectos cada noche, controlando sus poblaciones.', 'image_url' => null], ['id' => 'b', 'text' => 'Los murciélagos tienen alas y vuelan de noche.', 'image_url' => null], ['id' => 'c', 'text' => 'Los murciélagos viven en cuevas.', 'image_url' => null], ['id' => 'd', 'text' => 'Los murciélagos son mamíferos.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'inference', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'mission',
                'mission_title' => 'Infiere si la evidencia prueba la afirmación',
                'mission_description' => 'Decide si la evidencia realmente prueba lo que dice.',
                'instructions_es' => 'Lee y escoge si la evidencia prueba la afirmación.',
                'content' => ['passage' => 'Afirmación: Los gatos son buenos para controlar plagas en la ciudad. Evidencia: los gatos pueden ser de muchos colores.', 'question' => '¿Prueba esa evidencia la afirmación?', 'options' => [['id' => 'a', 'text' => 'No, el color no tiene relación con controlar plagas.', 'image_url' => null], ['id' => 'b', 'text' => 'Sí, el color muestra que son útiles.', 'image_url' => null], ['id' => 'c', 'text' => 'Sí, siempre que hables de gatos es evidencia válida.', 'image_url' => null], ['id' => 'd', 'text' => 'No hay suficiente información para decidir.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'cause_effect', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => '¿Qué ocurre sin evidencia?',
                'mission_description' => 'Piensa en el efecto de afirmar sin evidencia.',
                'instructions_es' => 'Lee y escoge el efecto correcto.',
                'content' => ['passage' => 'Cuando alguien hace una afirmación sin presentar evidencia, es difícil saber si es verdad.', 'question' => '¿Qué efecto tiene no presentar evidencia?', 'options' => [['id' => 'a', 'text' => 'Es difícil saber si la afirmación es verdad.', 'image_url' => null], ['id' => 'b', 'text' => 'La afirmación se vuelve más convincente.', 'image_url' => null], ['id' => 'c', 'text' => 'No hay ningún efecto, la afirmación vale igual.', 'image_url' => null], ['id' => 'd', 'text' => 'La evidencia no es necesaria si el tema es conocido.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        // Pack 20 — g34_which_detail_matters
        $this->insertPack([
            [
                'domain' => 'reading', 'skill_name' => 'main_idea', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => '¿Cuál detalle importa?',
                'mission_description' => 'Lee y descubre la idea principal.',
                'instructions_es' => 'Lee y escoge la idea principal.',
                'content' => ['passage' => 'No todos los detalles de un texto son igualmente importantes. Algunos apoyan la idea principal; otros son simplemente información de contexto. La clase aprendió a distinguirlos.', 'question' => '¿Cuál es la idea principal?', 'options' => [['id' => 'a', 'text' => 'Algunos detalles apoyan la idea principal y otros son contexto secundario.', 'image_url' => null], ['id' => 'b', 'text' => 'Todos los detalles de un texto son igualmente importantes.', 'image_url' => null], ['id' => 'c', 'text' => 'Los detalles de contexto siempre son más importantes.', 'image_url' => null], ['id' => 'd', 'text' => 'La idea principal no necesita detalles de apoyo.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'supporting_details', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'friendly_challenge',
                'mission_title' => 'Elige el detalle que más importa',
                'mission_description' => 'Busca el detalle que mejor apoya la idea principal.',
                'instructions_es' => 'Lee y escoge el detalle más importante.',
                'content' => ['passage' => 'Idea principal: El agua es esencial para la vida. Detalles: A) El agua cubre el 70% de la Tierra. B) Sin agua, los seres vivos no pueden sobrevivir. C) El océano Pacífico es el más grande.', 'question' => '¿Cuál detalle apoya mejor la idea?', 'options' => [['id' => 'a', 'text' => 'B — sin agua los seres vivos no pueden sobrevivir.', 'image_url' => null], ['id' => 'b', 'text' => 'A — el agua cubre el 70% de la Tierra.', 'image_url' => null], ['id' => 'c', 'text' => 'C — el océano Pacífico es el más grande.', 'image_url' => null], ['id' => 'd', 'text' => 'Los tres apoyan igualmente la idea.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'inference', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'mission',
                'mission_title' => 'Infiere qué detalle es de contexto',
                'mission_description' => 'Decide cuál detalle es solo contexto y no apoya.',
                'instructions_es' => 'Lee y escoge el detalle de contexto.',
                'content' => ['passage' => 'Idea: Las plantas necesitan la luz solar para crecer. Detalles: A) La fotosíntesis convierte la luz en energía para la planta. B) Las plantas tienen hojas verdes. C) Hay más de 300,000 especies de plantas en el mundo.', 'question' => '¿Cuál detalle es principalmente de contexto y no apoya directamente la idea?', 'options' => [['id' => 'a', 'text' => 'C — hay más de 300,000 especies de plantas.', 'image_url' => null], ['id' => 'b', 'text' => 'A — la fotosíntesis convierte la luz en energía.', 'image_url' => null], ['id' => 'c', 'text' => 'B — las plantas tienen hojas verdes.', 'image_url' => null], ['id' => 'd', 'text' => 'Los tres son igualmente de contexto.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
            [
                'domain' => 'reading', 'skill_name' => 'cause_effect', 'grade_band' => 'middle',
                'type' => 'multiple_choice', 'difficulty' => 2,
                'lesson_mood' => 'curious',
                'mission_title' => '¿Qué ocurre si usas solo detalles de contexto?',
                'mission_description' => 'Piensa en el efecto de depender de detalles secundarios.',
                'instructions_es' => 'Lee y escoge el efecto correcto.',
                'content' => ['passage' => 'Si solo usas detalles de contexto para apoyar una idea, el argumento no queda bien respaldado.', 'question' => '¿Cuál es el efecto de usar solo detalles de contexto?', 'options' => [['id' => 'a', 'text' => 'El argumento no queda bien respaldado.', 'image_url' => null], ['id' => 'b', 'text' => 'El argumento se fortalece mucho.', 'image_url' => null], ['id' => 'c', 'text' => 'La idea principal se entiende mejor.', 'image_url' => null], ['id' => 'd', 'text' => 'No hay ninguna diferencia en la calidad del argumento.', 'image_url' => null]]],
                'correct_answer' => ['correct_option_id' => 'a'],
            ],
        ]);

        $this->command->info('G34 Reading: 20 packs seeded.');
    }
}
