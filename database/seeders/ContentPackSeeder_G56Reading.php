<?php

namespace Database\Seeders;

use Database\Seeders\Traits\InsertsPackActivities;
use Illuminate\Database\Seeder;

/**
 * Grade 5-6 — Reading content packs
 *
 * 20 packs (skip g56_loaded_language — no source data):
 *   Core (seq 1-9): g56_weather_warning, g56_school_news_article, g56_plastic_in_the_ocean,
 *                   g56_ancient_city_discovery, g56_weather_warning_followup,
 *                   g56_school_energy_project, g56_local_news_comparison,
 *                   g56_water_use_report, g56_science_fair_article
 *   Support-only:   g56_city_trees_report
 *   Structured 11-20: g56_claims_and_sources … g56_fair_or_one_sided
 *
 * grade_band = 'upper'  |  curriculum_unit = upper_reading_critical_literacy
 */
class ContentPackSeeder_G56Reading extends Seeder
{
    use InsertsPackActivities;

    public function run(): void
    {
        // ----------------------------------------------------------------
        // Pack 1 — g56_weather_warning  (core, seq 1, seed_draft Pack 3)
        // 5 activities: illustrated_clue + 4× multiple_choice
        // Primary: inference, main_idea, cause_effect, compare_contrast
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain'=>'reading','skill_name'=>'inference','grade_band'=>'upper',
                'type'=>'illustrated_clue','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Interpreta la alerta meteorológica',
                'mission_description'=>'Analiza la imagen y el texto para sacar conclusiones.',
                'instructions_es'=>'Mira la imagen y lee el texto antes de responder.',
                'content'=>['image_url'=>null,'image_prompt'=>'weather alert map with dark storm system approaching coastal town','passage'=>'El mapa muestra un sistema de nubes oscuras acercándose a la costa. Las autoridades emitieron una alerta naranja.','question'=>'¿Qué podemos inferir sobre la situación?','options'=>[['id'=>'a','text'=>'Hay riesgo de condiciones climáticas peligrosas.','image_url'=>null],['id'=>'b','text'=>'El clima estará perfecto para salir.','image_url'=>null],['id'=>'c','text'=>'La alerta no requiere ninguna precaución.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'main_idea','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'mission',
                'mission_title'=>'Idea principal del boletín de alerta',
                'mission_description'=>'Lee el boletín y determina su idea central.',
                'instructions_es'=>'Lee y escoge la idea principal.',
                'content'=>['passage'=>'El boletín meteorológico advierte: vientos de hasta 90 km/h y lluvias intensas se esperan esta tarde. Se recomienda permanecer en casa y alejarse de áreas costeras.','question'=>'¿Cuál es la idea principal del boletín?','options'=>[['id'=>'a','text'=>'El boletín advierte sobre condiciones peligrosas y da recomendaciones de seguridad.','image_url'=>null],['id'=>'b','text'=>'Los vientos son agradables para practicar deportes.','image_url'=>null],['id'=>'c','text'=>'Hay que ir a la playa para observar el fenómeno.','image_url'=>null],['id'=>'d','text'=>'La lluvia beneficia especialmente a los agricultores.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'cause_effect','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Causa y efecto de la alerta naranja',
                'mission_description'=>'Analiza qué causa la alerta y qué efectos produce.',
                'instructions_es'=>'Lee y escoge el efecto correcto.',
                'content'=>['passage'=>'La alerta naranja se emitió porque los vientos superarán los 80 km/h. Como resultado, se suspendieron las clases y se cerraron los parques.','question'=>'¿Cuál fue el efecto directo de la alerta naranja?','options'=>[['id'=>'a','text'=>'Se suspendieron clases y se cerraron parques.','image_url'=>null],['id'=>'b','text'=>'Los estudiantes tuvieron más tiempo de recreo.','image_url'=>null],['id'=>'c','text'=>'Se abrieron nuevas rutas de transporte.','image_url'=>null],['id'=>'d','text'=>'El gobierno bajó el nivel de alerta.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'supporting_details','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'friendly_challenge',
                'mission_title'=>'Detalles específicos de la alerta',
                'mission_description'=>'Identifica los detalles concretos del boletín.',
                'instructions_es'=>'Lee y escoge el detalle correcto.',
                'content'=>['passage'=>'El boletín especifica: vientos de 90 km/h, marejadas de hasta 3 metros y lluvias de 80 mm en 24 horas.','question'=>'¿Qué detalle describe la intensidad del viento?','options'=>[['id'=>'a','text'=>'Vientos de hasta 90 km/h.','image_url'=>null],['id'=>'b','text'=>'Marejadas de hasta 3 metros.','image_url'=>null],['id'=>'c','text'=>'Lluvias de 80 mm en 24 horas.','image_url'=>null],['id'=>'d','text'=>'Alerta emitida a las 9 a.m.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'compare_contrast','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Alerta naranja vs. alerta roja',
                'mission_description'=>'Compara los dos niveles de alerta meteorológica.',
                'instructions_es'=>'Lee y escoge la mejor comparación.',
                'content'=>['passage'=>'La alerta naranja indica riesgo alto; la alerta roja indica peligro extremo e inminente. Ambas requieren precauciones, pero la roja exige evacuación.','question'=>'¿Cuál es la mejor comparación?','options'=>[['id'=>'a','text'=>'Ambas son alertas pero la roja exige medidas más urgentes como evacuar.','image_url'=>null],['id'=>'b','text'=>'Son exactamente iguales en sus medidas de seguridad.','image_url'=>null],['id'=>'c','text'=>'La naranja es más peligrosa que la roja.','image_url'=>null],['id'=>'d','text'=>'Solo la alerta roja requiere precauciones.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack 2 — g56_school_news_article  (core, seq 2, normalized)
        // 5 activities: main_idea, supporting_details, inference, compare_contrast, cause_effect
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain'=>'reading','skill_name'=>'main_idea','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Idea principal de la noticia escolar',
                'mission_description'=>'Lee la noticia y determina su idea central.',
                'instructions_es'=>'Lee y escoge la idea principal.',
                'content'=>['passage'=>'El periódico escolar publicó una noticia sobre la nueva biblioteca digital. El artículo explica sus beneficios para el aprendizaje y cómo acceder a ella desde casa.','question'=>'¿Cuál es la idea principal?','options'=>[['id'=>'a','text'=>'La nueva biblioteca digital amplía las oportunidades de aprendizaje.','image_url'=>null],['id'=>'b','text'=>'La biblioteca antigua fue demolida.','image_url'=>null],['id'=>'c','text'=>'Solo los profesores pueden usar la biblioteca digital.','image_url'=>null],['id'=>'d','text'=>'La biblioteca digital no tiene libros de ciencia.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'supporting_details','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'friendly_challenge',
                'mission_title'=>'Detalle sobre la biblioteca digital',
                'mission_description'=>'Busca el detalle que explica cómo funciona.',
                'instructions_es'=>'Lee y escoge el detalle correcto.',
                'content'=>['passage'=>'La biblioteca digital tiene más de 5,000 títulos, se puede acceder con el correo escolar y funciona las 24 horas.','question'=>'¿Cuántos títulos tiene la biblioteca digital?','options'=>[['id'=>'a','text'=>'Más de 5,000 títulos.','image_url'=>null],['id'=>'b','text'=>'Exactamente 500 títulos.','image_url'=>null],['id'=>'c','text'=>'Solo libros de texto oficiales.','image_url'=>null],['id'=>'d','text'=>'Los mismos títulos que la biblioteca física.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'inference','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'mission',
                'mission_title'=>'Infiere el propósito de la noticia',
                'mission_description'=>'Usa el texto para inferir por qué se escribió.',
                'instructions_es'=>'Lee y escoge la inferencia correcta.',
                'content'=>['passage'=>'La noticia explica cómo acceder a la biblioteca, qué recursos ofrece y destaca que es gratuita para todos los estudiantes.','question'=>'¿Cuál es el propósito principal de la noticia?','options'=>[['id'=>'a','text'=>'Informar a los estudiantes sobre un recurso nuevo que pueden usar.','image_url'=>null],['id'=>'b','text'=>'Criticar la falta de libros en la escuela.','image_url'=>null],['id'=>'c','text'=>'Convencer a los estudiantes de no usar la biblioteca física.','image_url'=>null],['id'=>'d','text'=>'Comparar la escuela con otras instituciones.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'compare_contrast','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Biblioteca física vs. digital',
                'mission_description'=>'Compara las dos bibliotecas según el artículo.',
                'instructions_es'=>'Lee y escoge la mejor comparación.',
                'content'=>['passage'=>'La biblioteca física tiene libros impresos y horario limitado. La digital tiene recursos en línea y está disponible las 24 horas.','question'=>'¿Cuál es la principal diferencia?','options'=>[['id'=>'a','text'=>'La física tiene horario limitado; la digital está disponible todo el tiempo.','image_url'=>null],['id'=>'b','text'=>'Las dos tienen exactamente los mismos recursos.','image_url'=>null],['id'=>'c','text'=>'La física tiene más recursos que la digital.','image_url'=>null],['id'=>'d','text'=>'La digital no tiene horario porque no funciona.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'cause_effect','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'¿Por qué crearon la biblioteca digital?',
                'mission_description'=>'Analiza la causa de su creación.',
                'instructions_es'=>'Lee y escoge la causa correcta.',
                'content'=>['passage'=>'La biblioteca digital se creó porque muchos estudiantes no podían visitar la biblioteca física después del horario escolar.','question'=>'¿Cuál fue la causa de crear la biblioteca digital?','options'=>[['id'=>'a','text'=>'Muchos estudiantes no podían ir a la física fuera de horario escolar.','image_url'=>null],['id'=>'b','text'=>'La biblioteca física tenía demasiados libros.','image_url'=>null],['id'=>'c','text'=>'El gobierno exigió una biblioteca en línea.','image_url'=>null],['id'=>'d','text'=>'Los profesores prefieren enseñar sin libros.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack 3 — g56_plastic_in_the_ocean  (core, seq 3, normalized)
        // 5 activities: main_idea, inference, cause_effect, compare_contrast, supporting_details
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain'=>'reading','skill_name'=>'main_idea','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'mission',
                'mission_title'=>'El plástico en los océanos',
                'mission_description'=>'Lee el artículo y determina su idea central.',
                'instructions_es'=>'Lee y escoge la idea principal.',
                'content'=>['passage'=>'Cada año millones de toneladas de plástico llegan a los océanos. Esta contaminación afecta a la vida marina y entra en la cadena alimentaria humana.','question'=>'¿Cuál es la idea principal?','options'=>[['id'=>'a','text'=>'La contaminación plástica daña los océanos y afecta a humanos y animales.','image_url'=>null],['id'=>'b','text'=>'Los plásticos son beneficiosos para los peces del océano.','image_url'=>null],['id'=>'c','text'=>'El problema del plástico ya fue resuelto.','image_url'=>null],['id'=>'d','text'=>'Solo los países grandes producen plástico.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'cause_effect','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Efectos del plástico en la vida marina',
                'mission_description'=>'Analiza qué efecto tiene el plástico en los océanos.',
                'instructions_es'=>'Lee y escoge el efecto correcto.',
                'content'=>['passage'=>'Los animales marinos confunden el plástico con alimento. Al comerlo, se lesionan internamente y muchos mueren.','question'=>'¿Cuál es el efecto del plástico en los animales marinos?','options'=>[['id'=>'a','text'=>'Se lesionan internamente y muchos mueren al confundirlo con comida.','image_url'=>null],['id'=>'b','text'=>'Crecen más fuertes al alimentarse de plástico.','image_url'=>null],['id'=>'c','text'=>'Aprenden a evitarlo con el tiempo.','image_url'=>null],['id'=>'d','text'=>'No les afecta porque nadan muy rápido.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'inference','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Infiere la solución al problema',
                'mission_description'=>'Usa el texto para inferir qué habría que hacer.',
                'instructions_es'=>'Lee y escoge la inferencia correcta.',
                'content'=>['passage'=>'El plástico llega al océano desde ríos, playas y vertederos. Reducir su producción y mejorar la gestión de residuos disminuiría el problema.','question'=>'¿Qué podemos inferir sobre la solución?','options'=>[['id'=>'a','text'=>'Reducir plásticos y mejorar la gestión de residuos son pasos clave.','image_url'=>null],['id'=>'b','text'=>'El problema se resolverá solo con el tiempo.','image_url'=>null],['id'=>'c','text'=>'Solo los océanos más grandes tienen este problema.','image_url'=>null],['id'=>'d','text'=>'Limpiar una playa es suficiente para resolver el problema.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'supporting_details','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'friendly_challenge',
                'mission_title'=>'Detalle sobre la magnitud del problema',
                'mission_description'=>'Encuentra el detalle que muestra la escala del problema.',
                'instructions_es'=>'Lee y escoge el detalle correcto.',
                'content'=>['passage'=>'Se estima que para 2050 habrá más plástico que peces en los océanos si no se toman medidas urgentes.','question'=>'¿Qué detalle muestra la magnitud del problema?','options'=>[['id'=>'a','text'=>'Para 2050 podría haber más plástico que peces en los océanos.','image_url'=>null],['id'=>'b','text'=>'El plástico fue inventado en el siglo XX.','image_url'=>null],['id'=>'c','text'=>'Algunos países reciclan el 10% de su plástico.','image_url'=>null],['id'=>'d','text'=>'Los océanos cubren el 70% de la Tierra.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'compare_contrast','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Plástico reciclable vs. plástico de un solo uso',
                'mission_description'=>'Compara los dos tipos según el artículo.',
                'instructions_es'=>'Lee y escoge la mejor comparación.',
                'content'=>['passage'=>'El plástico reciclable puede procesarse y reutilizarse. El plástico de un solo uso generalmente termina en vertederos o en el océano.','question'=>'¿Cuál es la principal diferencia?','options'=>[['id'=>'a','text'=>'El reciclable puede reutilizarse; el de un solo uso suele contaminar más.','image_url'=>null],['id'=>'b','text'=>'Los dos contaminan exactamente igual.','image_url'=>null],['id'=>'c','text'=>'El de un solo uso es más fácil de reciclar.','image_url'=>null],['id'=>'d','text'=>'No hay diferencia relevante entre los dos.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack 4 — g56_ancient_city_discovery  (core, seq 4, normalized)
        // 4 activities: main_idea, inference, supporting_details, cause_effect
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain'=>'reading','skill_name'=>'main_idea','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'El descubrimiento de la ciudad antigua',
                'mission_description'=>'Lee el artículo y determina su idea central.',
                'instructions_es'=>'Lee y escoge la idea principal.',
                'content'=>['passage'=>'Arqueólogos descubrieron los restos de una ciudad de 3,000 años en América del Sur. Los hallazgos incluyen templos, viviendas y un sistema de acueductos.','question'=>'¿Cuál es la idea principal?','options'=>[['id'=>'a','text'=>'El descubrimiento revela una civilización avanzada de hace 3,000 años.','image_url'=>null],['id'=>'b','text'=>'La ciudad fue construida hace 100 años.','image_url'=>null],['id'=>'c','text'=>'Los arqueólogos encontraron solo utensilios de cocina.','image_url'=>null],['id'=>'d','text'=>'La ciudad nunca tuvo habitantes permanentes.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'inference','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'mission',
                'mission_title'=>'Infiere sobre la civilización descubierta',
                'mission_description'=>'Usa los hallazgos para inferir sobre sus habitantes.',
                'instructions_es'=>'Lee y escoge la inferencia correcta.',
                'content'=>['passage'=>'La ciudad tenía templos elaborados, un sistema de acueductos y zonas residenciales bien organizadas.','question'=>'¿Qué podemos inferir sobre sus habitantes?','options'=>[['id'=>'a','text'=>'Tenían conocimientos avanzados de ingeniería y arquitectura.','image_url'=>null],['id'=>'b','text'=>'Vivían en condiciones primitivas sin organización social.','image_url'=>null],['id'=>'c','text'=>'No tenían ningún sistema de gobierno.','image_url'=>null],['id'=>'d','text'=>'La ciudad fue construida por una sola persona.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'supporting_details','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'friendly_challenge',
                'mission_title'=>'Detalle del descubrimiento',
                'mission_description'=>'Encuentra el detalle que apoya la antigüedad del hallazgo.',
                'instructions_es'=>'Lee y escoge el detalle correcto.',
                'content'=>['passage'=>'Pruebas de carbono-14 determinaron que los edificios tienen entre 2,800 y 3,200 años de antigüedad.','question'=>'¿Qué método determinó la edad de los edificios?','options'=>[['id'=>'a','text'=>'Pruebas de carbono-14.','image_url'=>null],['id'=>'b','text'=>'Análisis de documentos históricos.','image_url'=>null],['id'=>'c','text'=>'Testimonio de pobladores locales.','image_url'=>null],['id'=>'d','text'=>'Comparación con ciudades modernas.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'cause_effect','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'¿Por qué quedó enterrada la ciudad?',
                'mission_description'=>'Analiza la causa de que la ciudad quedara oculta.',
                'instructions_es'=>'Lee y escoge la causa correcta.',
                'content'=>['passage'=>'La ciudad quedó enterrada bajo capas de sedimento después de inundaciones y siglos de crecimiento vegetal.','question'=>'¿Por qué quedó enterrada la ciudad?','options'=>[['id'=>'a','text'=>'Por inundaciones y siglos de sedimento y vegetación.','image_url'=>null],['id'=>'b','text'=>'Sus habitantes la cubrieron intencionalmente.','image_url'=>null],['id'=>'c','text'=>'Un terremoto la hundió en el suelo.','image_url'=>null],['id'=>'d','text'=>'Otro pueblo construyó encima de ella.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack 5 — g56_weather_warning_followup  (core, seq 5, normalized)
        // 4 activities: inference, compare_contrast, main_idea, cause_effect
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain'=>'reading','skill_name'=>'main_idea','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'calm',
                'mission_title'=>'Lecciones aprendidas tras la tormenta',
                'mission_description'=>'Lee el artículo de seguimiento y encuentra la idea central.',
                'instructions_es'=>'Lee y escoge la idea principal.',
                'content'=>['passage'=>'Después de la tormenta, la comunidad evaluó los daños y revisó sus protocolos de emergencia. El municipio propuso nuevas inversiones en infraestructura.','question'=>'¿Cuál es la idea principal?','options'=>[['id'=>'a','text'=>'La comunidad aprendió lecciones y planea mejorar su preparación ante emergencias.','image_url'=>null],['id'=>'b','text'=>'La tormenta no causó ningún daño significativo.','image_url'=>null],['id'=>'c','text'=>'El municipio decidió no cambiar ningún protocolo.','image_url'=>null],['id'=>'d','text'=>'La alerta meteorológica fue incorrecta.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'cause_effect','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Causa y efecto de los daños',
                'mission_description'=>'Analiza qué causó los mayores daños.',
                'instructions_es'=>'Lee y escoge el efecto correcto.',
                'content'=>['passage'=>'La falta de desagües adecuados causó inundaciones en zonas bajas que no habían sido afectadas antes.','question'=>'¿Cuál fue el efecto de los desagües inadecuados?','options'=>[['id'=>'a','text'=>'Se inundaron zonas que antes no habían sido afectadas.','image_url'=>null],['id'=>'b','text'=>'Los desagües protegieron bien a toda la comunidad.','image_url'=>null],['id'=>'c','text'=>'Las lluvias fueron menos intensas de lo esperado.','image_url'=>null],['id'=>'d','text'=>'Los edificios nuevos no sufrieron daños.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'inference','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'mission',
                'mission_title'=>'Infiere la prioridad del municipio',
                'mission_description'=>'Usa el texto para inferir qué hará primero el municipio.',
                'instructions_es'=>'Lee y escoge la inferencia correcta.',
                'content'=>['passage'=>'El alcalde señaló que los desagües y la resistencia de los puentes son las dos áreas más vulnerables que deben atenderse antes de la próxima temporada de lluvias.','question'=>'¿Cuál será probablemente la primera prioridad?','options'=>[['id'=>'a','text'=>'Mejorar los desagües y reforzar los puentes antes de la próxima temporada.','image_url'=>null],['id'=>'b','text'=>'Construir un nuevo estadio deportivo.','image_url'=>null],['id'=>'c','text'=>'Ampliar las escuelas del municipio.','image_url'=>null],['id'=>'d','text'=>'Actualizar el sistema de alerta para que sea más preciso.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'compare_contrast','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Compara la preparación antes y después',
                'mission_description'=>'Compara la situación antes y después de la tormenta.',
                'instructions_es'=>'Lee y escoge la mejor comparación.',
                'content'=>['passage'=>'Antes de la tormenta los protocolos eran básicos. Después, el municipio aprobó un plan de 12 puntos con simulacros obligatorios y nuevas alarmas.','question'=>'¿Cuál es la principal diferencia en la preparación?','options'=>[['id'=>'a','text'=>'Antes era básica; después pasó a ser un plan estructurado con nuevas medidas.','image_url'=>null],['id'=>'b','text'=>'La preparación no cambió nada después de la tormenta.','image_url'=>null],['id'=>'c','text'=>'Antes era mejor que el plan nuevo.','image_url'=>null],['id'=>'d','text'=>'Los dos planes son idénticos.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack 6 — g56_school_energy_project  (core, seq 6, normalized)
        // 4 activities: main_idea, supporting_details, inference, cause_effect
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain'=>'reading','skill_name'=>'main_idea','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'El proyecto de energía de la escuela',
                'mission_description'=>'Lee el artículo y determina su idea central.',
                'instructions_es'=>'Lee y escoge la idea principal.',
                'content'=>['passage'=>'La escuela instaló paneles solares en el techo. En seis meses generó el 40% de su electricidad con energía solar, reduciendo sus facturas y su huella de carbono.','question'=>'¿Cuál es la idea principal?','options'=>[['id'=>'a','text'=>'Los paneles solares redujeron los costos y la huella de carbono de la escuela.','image_url'=>null],['id'=>'b','text'=>'La escuela no puede pagar sus facturas de electricidad.','image_url'=>null],['id'=>'c','text'=>'Los paneles solares no funcionaron bien en la escuela.','image_url'=>null],['id'=>'d','text'=>'El gobierno instaló los paneles sin costo alguno.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'supporting_details','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'friendly_challenge',
                'mission_title'=>'Datos del proyecto solar',
                'mission_description'=>'Identifica el dato concreto del artículo.',
                'instructions_es'=>'Lee y escoge el detalle correcto.',
                'content'=>['passage'=>'Los paneles generaron 40% de la electricidad en seis meses y ahorraron $12,000 al año en facturas.','question'=>'¿Cuánto ahorra la escuela con los paneles al año?','options'=>[['id'=>'a','text'=>'$12,000 al año.','image_url'=>null],['id'=>'b','text'=>'$1,200 al mes.','image_url'=>null],['id'=>'c','text'=>'Todo el costo de la electricidad.','image_url'=>null],['id'=>'d','text'=>'Exactamente el 50% de sus facturas.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'inference','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'mission',
                'mission_title'=>'Infiere el impacto a largo plazo',
                'mission_description'=>'Usa los datos para inferir qué pasará en 10 años.',
                'instructions_es'=>'Lee y escoge la inferencia correcta.',
                'content'=>['passage'=>'La escuela planea ampliar los paneles para cubrir el 80% de su consumo energético en tres años.','question'=>'¿Qué podemos inferir sobre el futuro del proyecto?','options'=>[['id'=>'a','text'=>'La dependencia del combustible fósil seguirá disminuyendo con la expansión.','image_url'=>null],['id'=>'b','text'=>'El proyecto será cancelado el próximo año.','image_url'=>null],['id'=>'c','text'=>'La escuela necesitará más electricidad de la red.','image_url'=>null],['id'=>'d','text'=>'Los paneles solares no son útiles para las escuelas.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'cause_effect','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Causa y efecto de los paneles solares',
                'mission_description'=>'Analiza la relación causa-efecto en el proyecto.',
                'instructions_es'=>'Lee y escoge el efecto correcto.',
                'content'=>['passage'=>'Al generar su propia electricidad, la escuela redujo su consumo de la red eléctrica y sus emisiones de CO2.','question'=>'¿Cuál fue el efecto de generar electricidad propia?','options'=>[['id'=>'a','text'=>'Se redujo el consumo de la red y las emisiones de CO2.','image_url'=>null],['id'=>'b','text'=>'El consumo de la red aumentó considerablemente.','image_url'=>null],['id'=>'c','text'=>'Las emisiones de CO2 de la escuela aumentaron.','image_url'=>null],['id'=>'d','text'=>'La escuela tuvo que pagar más por la electricidad.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack 7 — g56_local_news_comparison  (core, seq 7, normalized)
        // 4 activities: compare_contrast, inference, supporting_details, main_idea
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain'=>'reading','skill_name'=>'main_idea','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Compara dos noticias locales',
                'mission_description'=>'Lee y determina la idea central del ejercicio comparativo.',
                'instructions_es'=>'Lee y escoge la idea principal.',
                'content'=>['passage'=>'Dos periódicos locales publicaron noticias sobre la misma obra de construcción. El primero la presentó como progreso; el segundo destacó los inconvenientes para los vecinos.','question'=>'¿Cuál es la idea principal?','options'=>[['id'=>'a','text'=>'El mismo evento puede presentarse de forma diferente según la perspectiva del medio.','image_url'=>null],['id'=>'b','text'=>'Los dos periódicos cometieron errores en sus noticias.','image_url'=>null],['id'=>'c','text'=>'Solo un periódico publicó la noticia correctamente.','image_url'=>null],['id'=>'d','text'=>'Los periódicos siempre presentan la misma perspectiva.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'compare_contrast','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Compara las dos coberturas periodísticas',
                'mission_description'=>'Analiza en qué difieren los dos artículos.',
                'instructions_es'=>'Lee y escoge la mejor comparación.',
                'content'=>['passage'=>'Artículo A enfocó los beneficios económicos de la obra. Artículo B enfocó el ruido, el polvo y los cierres de calles para los residentes.','question'=>'¿Cuál es la principal diferencia entre los dos artículos?','options'=>[['id'=>'a','text'=>'A destacó beneficios económicos; B destacó inconvenientes para los vecinos.','image_url'=>null],['id'=>'b','text'=>'Los dos artículos son idénticos en su enfoque.','image_url'=>null],['id'=>'c','text'=>'El artículo B apoyó la obra más que el A.','image_url'=>null],['id'=>'d','text'=>'El artículo A habló de los vecinos afectados.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'inference','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'mission',
                'mission_title'=>'Infiere la audiencia de cada artículo',
                'mission_description'=>'Usa el enfoque para inferir a quién va dirigido cada uno.',
                'instructions_es'=>'Lee y escoge la inferencia correcta.',
                'content'=>['passage'=>'El artículo A usa lenguaje optimista y está en la sección económica. El B usa lenguaje de queja y está en la sección de comunidad.','question'=>'¿A qué audiencia va dirigido principalmente el artículo B?','options'=>[['id'=>'a','text'=>'A los residentes y vecinos afectados por la obra.','image_url'=>null],['id'=>'b','text'=>'A los inversores y empresarios de la ciudad.','image_url'=>null],['id'=>'c','text'=>'Al gobierno municipal que aprobó la obra.','image_url'=>null],['id'=>'d','text'=>'A los turistas que visitan la ciudad.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'supporting_details','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'friendly_challenge',
                'mission_title'=>'Detalle que muestra el enfoque de cada artículo',
                'mission_description'=>'Identifica el detalle que define la perspectiva de cada medio.',
                'instructions_es'=>'Lee y escoge el detalle correcto.',
                'content'=>['passage'=>'El artículo A menciona 200 empleos nuevos. El artículo B menciona el cierre de 3 calles por 18 meses.','question'=>'¿Cuál detalle usó el artículo B para mostrar su perspectiva?','options'=>[['id'=>'a','text'=>'El cierre de 3 calles por 18 meses.','image_url'=>null],['id'=>'b','text'=>'Los 200 empleos nuevos que generará la obra.','image_url'=>null],['id'=>'c','text'=>'El costo total de la construcción.','image_url'=>null],['id'=>'d','text'=>'El nombre del arquitecto del proyecto.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack 8 — g56_water_use_report  (waves 8-10, seq 7)
        // 4 activities: main_idea, supporting_details, inference, cause_effect
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain'=>'reading','skill_name'=>'main_idea','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'calm',
                'mission_title'=>'El informe sobre el uso del agua',
                'mission_description'=>'Lee el informe y determina su idea central.',
                'instructions_es'=>'Lee y escoge la idea principal.',
                'content'=>['passage'=>'El informe municipal reveló que el consumo de agua doméstico aumentó un 15% en el último año. La mayor parte del incremento provino del riego de jardines y el lavado de vehículos.','question'=>'¿Cuál es la idea principal?','options'=>[['id'=>'a','text'=>'El consumo doméstico de agua subió, especialmente por el riego y el lavado de vehículos.','image_url'=>null],['id'=>'b','text'=>'El consumo de agua en fábricas disminuyó significativamente.','image_url'=>null],['id'=>'c','text'=>'El informe no encontró ningún problema con el agua.','image_url'=>null],['id'=>'d','text'=>'Solo los edificios comerciales usan demasiada agua.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'supporting_details','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'friendly_challenge',
                'mission_title'=>'Detalle del informe hídrico',
                'mission_description'=>'Identifica el dato concreto del informe.',
                'instructions_es'=>'Lee y escoge el detalle correcto.',
                'content'=>['passage'=>'El 35% del agua doméstica se usa en duchas, el 25% en el inodoro y el 20% en el riego de jardines.','question'=>'¿Qué actividad usa más agua según el informe?','options'=>[['id'=>'a','text'=>'Las duchas (35%).','image_url'=>null],['id'=>'b','text'=>'El riego de jardines (20%).','image_url'=>null],['id'=>'c','text'=>'El inodoro (25%).','image_url'=>null],['id'=>'d','text'=>'El lavado de ropa.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'inference','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'mission',
                'mission_title'=>'Infiere la recomendación del informe',
                'mission_description'=>'Usa los datos para inferir qué recomienda el informe.',
                'instructions_es'=>'Lee y escoge la inferencia correcta.',
                'content'=>['passage'=>'El informe señala que el riego de jardines y el lavado de vehículos son las áreas de mayor desperdicio potencial.','question'=>'¿Qué podemos inferir sobre las recomendaciones del informe?','options'=>[['id'=>'a','text'=>'Probablemente recomienda reducir el riego y usar métodos de lavado más eficientes.','image_url'=>null],['id'=>'b','text'=>'Recomienda aumentar el consumo de agua en jardines.','image_url'=>null],['id'=>'c','text'=>'Propone eliminar todos los jardines privados.','image_url'=>null],['id'=>'d','text'=>'Sugiere cobrar más impuestos sin cambiar hábitos.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'cause_effect','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'¿Por qué aumentó el consumo de agua?',
                'mission_description'=>'Analiza la causa del incremento en el informe.',
                'instructions_es'=>'Lee y escoge la causa correcta.',
                'content'=>['passage'=>'El verano seco y las altas temperaturas llevaron a un mayor uso de sistemas de riego y al incremento en el lavado de vehículos.','question'=>'¿Cuál fue la causa del aumento en el consumo de agua?','options'=>[['id'=>'a','text'=>'El verano seco y las altas temperaturas.','image_url'=>null],['id'=>'b','text'=>'La instalación de nuevas piscinas públicas.','image_url'=>null],['id'=>'c','text'=>'Un fallo en el sistema de medidores.','image_url'=>null],['id'=>'d','text'=>'Un aumento en la población de la ciudad.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack 9 — g56_science_fair_article  (waves 8-10, seq 9)
        // 4 activities: main_idea, inference, compare_contrast, cause_effect
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain'=>'reading','skill_name'=>'main_idea','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'calm',
                'mission_title'=>'El artículo de la feria de ciencias',
                'mission_description'=>'Lee el artículo y determina su idea central.',
                'instructions_es'=>'Lee y escoge la idea principal.',
                'content'=>['passage'=>'La feria de ciencias escolar presentó 48 proyectos este año. El proyecto ganador investigó la purificación del agua con filtros caseros, demostrando que reduce el 90% de bacterias comunes.','question'=>'¿Cuál es la idea principal?','options'=>[['id'=>'a','text'=>'El proyecto ganador demostró cómo los filtros caseros purifican el agua eficazmente.','image_url'=>null],['id'=>'b','text'=>'La feria tuvo menos proyectos que el año pasado.','image_url'=>null],['id'=>'c','text'=>'El agua de la ciudad no tiene bacterias.','image_url'=>null],['id'=>'d','text'=>'Los filtros caseros son peligrosos.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'inference','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'mission',
                'mission_title'=>'Infiere el impacto del proyecto ganador',
                'mission_description'=>'Usa los datos para inferir su aplicación real.',
                'instructions_es'=>'Lee y escoge la inferencia correcta.',
                'content'=>['passage'=>'El filtro casero costó $5 en materiales y redujo las bacterias en un 90%. El estudiante propuso replicarlo en comunidades sin acceso a agua potable.','question'=>'¿Cuál sería el mayor impacto potencial del proyecto?','options'=>[['id'=>'a','text'=>'Proveer agua más segura a bajo costo en comunidades sin acceso a agua potable.','image_url'=>null],['id'=>'b','text'=>'Reemplazar completamente los sistemas municipales de tratamiento.','image_url'=>null],['id'=>'c','text'=>'Ganar dinero vendiendo el filtro en tiendas.','image_url'=>null],['id'=>'d','text'=>'Reducir el uso de agua embotellada en supermercados.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'compare_contrast','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Compara dos proyectos de la feria',
                'mission_description'=>'Analiza las diferencias entre los proyectos.',
                'instructions_es'=>'Lee y escoge la mejor comparación.',
                'content'=>['passage'=>'Proyecto A: purificación de agua con filtros caseros ($5, 90% eficiencia). Proyecto B: jardín hidropónico solar (bajo consumo de agua, producción constante).','question'=>'¿Cuál es la principal diferencia entre los dos proyectos?','options'=>[['id'=>'a','text'=>'El A enfoca la purificación del agua; el B se centra en la producción de alimentos eficiente.','image_url'=>null],['id'=>'b','text'=>'Los dos investigan exactamente lo mismo.','image_url'=>null],['id'=>'c','text'=>'El proyecto B es más barato de implementar.','image_url'=>null],['id'=>'d','text'=>'El A y el B tienen la misma eficiencia.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'cause_effect','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Causa y efecto del filtro casero',
                'mission_description'=>'Analiza el resultado del experimento.',
                'instructions_es'=>'Lee y escoge el efecto correcto.',
                'content'=>['passage'=>'Al pasar el agua por capas de arena, grava y carbón activado, el filtro eliminó el 90% de las bacterias detectadas.','question'=>'¿Cuál fue el efecto de usar el filtro casero?','options'=>[['id'=>'a','text'=>'El 90% de las bacterias fue eliminado del agua.','image_url'=>null],['id'=>'b','text'=>'El agua quedó completamente esterilizada.','image_url'=>null],['id'=>'c','text'=>'Las bacterias aumentaron después del filtrado.','image_url'=>null],['id'=>'d','text'=>'El filtro no tuvo ningún efecto medible.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
        ]);

        // ----------------------------------------------------------------
        // Pack 10 — g56_city_trees_report  (support/support_only)
        // 4 activities: main_idea, inference, cause_effect, supporting_details
        // ----------------------------------------------------------------
        $this->insertPack([
            [
                'domain'=>'reading','skill_name'=>'main_idea','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'calm',
                'mission_title'=>'El informe sobre los árboles de la ciudad',
                'mission_description'=>'Lee el informe y determina su idea central.',
                'instructions_es'=>'Lee y escoge la idea principal.',
                'content'=>['passage'=>'El informe municipal evaluó la cobertura arbórea. Encontró que los barrios con más árboles tenían temperaturas hasta 4°C más bajas y mejor calidad del aire.','question'=>'¿Cuál es la idea principal?','options'=>[['id'=>'a','text'=>'Los árboles urbanos mejoran la temperatura y la calidad del aire de la ciudad.','image_url'=>null],['id'=>'b','text'=>'La ciudad tiene demasiados árboles que obstruyen las calles.','image_url'=>null],['id'=>'c','text'=>'Solo los parques grandes tienen beneficios climáticos.','image_url'=>null],['id'=>'d','text'=>'Los árboles no afectan la temperatura urbana.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'cause_effect','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'¿Por qué baja la temperatura con más árboles?',
                'mission_description'=>'Analiza el mecanismo causa-efecto de los árboles.',
                'instructions_es'=>'Lee y escoge el efecto correcto.',
                'content'=>['passage'=>'Los árboles absorben el calor solar, liberan humedad y crean sombra, lo que reduce la temperatura del aire circundante.','question'=>'¿Por qué los árboles reducen la temperatura urbana?','options'=>[['id'=>'a','text'=>'Absorben calor, liberan humedad y crean sombra.','image_url'=>null],['id'=>'b','text'=>'Bloquean el viento que calienta la ciudad.','image_url'=>null],['id'=>'c','text'=>'Producen oxígeno que enfría el ambiente.','image_url'=>null],['id'=>'d','text'=>'Absorben el ruido del tráfico.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'inference','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'mission',
                'mission_title'=>'Infiere la recomendación del informe',
                'mission_description'=>'Usa los datos del informe para inferir qué propone.',
                'instructions_es'=>'Lee y escoge la inferencia correcta.',
                'content'=>['passage'=>'Los barrios con menos del 10% de cobertura arbórea tuvieron los mayores problemas de calor extremo y contaminación del aire.','question'=>'¿Qué propondrá probablemente el informe?','options'=>[['id'=>'a','text'=>'Aumentar la cobertura arbórea en los barrios con menos del 10%.','image_url'=>null],['id'=>'b','text'=>'Eliminar árboles de zonas con mucha cobertura.','image_url'=>null],['id'=>'c','text'=>'Construir más edificios en los barrios con pocos árboles.','image_url'=>null],['id'=>'d','text'=>'Instalar sistemas de climatización en lugar de plantar árboles.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'supporting_details','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'friendly_challenge',
                'mission_title'=>'Dato específico del informe arbóreo',
                'mission_description'=>'Identifica el dato concreto del estudio.',
                'instructions_es'=>'Lee y escoge el detalle correcto.',
                'content'=>['passage'=>'Los barrios con alta cobertura arbórea registraron temperaturas hasta 4°C más bajas que los barrios sin árboles.','question'=>'¿Cuántos grados más frescos son los barrios arborizados?','options'=>[['id'=>'a','text'=>'Hasta 4°C más frescos.','image_url'=>null],['id'=>'b','text'=>'1°C más frescos.','image_url'=>null],['id'=>'c','text'=>'10°C más frescos.','image_url'=>null],['id'=>'d','text'=>'La temperatura es exactamente la misma.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
        ]);

        // ----------------------------------------------------------------
        // Packs 11–20 — structured waves 11–20 (4 activities each)
        // Focus: critical reading and media literacy
        // ----------------------------------------------------------------

        // Pack 11 — g56_claims_and_sources
        $this->insertPack([
            [
                'domain'=>'reading','skill_name'=>'main_idea','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Afirmaciones y fuentes',
                'mission_description'=>'Lee y determina la idea central sobre fuentes.',
                'instructions_es'=>'Lee y escoge la idea principal.',
                'content'=>['passage'=>'Una afirmación solo es confiable si está respaldada por fuentes verificables. Fuentes como estudios científicos o instituciones reconocidas son más confiables que opiniones anónimas.','question'=>'¿Cuál es la idea principal?','options'=>[['id'=>'a','text'=>'La confiabilidad de una afirmación depende de la calidad de sus fuentes.','image_url'=>null],['id'=>'b','text'=>'Todas las fuentes son igualmente confiables.','image_url'=>null],['id'=>'c','text'=>'Las opiniones anónimas son las mejores fuentes.','image_url'=>null],['id'=>'d','text'=>'No es necesario citar fuentes para hacer afirmaciones.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'inference','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'mission',
                'mission_title'=>'Infiere la calidad de la fuente',
                'mission_description'=>'Decide qué fuente es más confiable para la afirmación.',
                'instructions_es'=>'Lee y escoge la fuente más confiable.',
                'content'=>['passage'=>'Afirmación: "El ejercicio mejora la salud mental." Fuentes: A) Estudio de la OMS con 10,000 participantes. B) Comentario de usuario anónimo en foro.','question'=>'¿Cuál fuente apoya mejor la afirmación?','options'=>[['id'=>'a','text'=>'El estudio de la OMS con 10,000 participantes.','image_url'=>null],['id'=>'b','text'=>'El comentario anónimo del foro.','image_url'=>null],['id'=>'c','text'=>'Las dos fuentes son igualmente confiables.','image_url'=>null],['id'=>'d','text'=>'Ninguna de las dos apoya la afirmación.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'supporting_details','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'friendly_challenge',
                'mission_title'=>'Detalle que define una fuente confiable',
                'mission_description'=>'Identifica las características de una fuente confiable.',
                'instructions_es'=>'Lee y escoge el detalle correcto.',
                'content'=>['passage'=>'Una fuente confiable es verificable, tiene autor identificado y está respaldada por una institución o método reconocido.','question'=>'¿Cuál característica define mejor una fuente confiable?','options'=>[['id'=>'a','text'=>'Es verificable, tiene autor identificado y está respaldada institucionalmente.','image_url'=>null],['id'=>'b','text'=>'Tiene muchos "likes" en redes sociales.','image_url'=>null],['id'=>'c','text'=>'Fue publicada recientemente.','image_url'=>null],['id'=>'d','text'=>'Está escrita en un idioma extranjero.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'cause_effect','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Efecto de usar fuentes no confiables',
                'mission_description'=>'Analiza qué pasa cuando usamos fuentes débiles.',
                'instructions_es'=>'Lee y escoge el efecto correcto.',
                'content'=>['passage'=>'Cuando se usan fuentes no verificadas, las afirmaciones pierden credibilidad y pueden difundir información falsa.','question'=>'¿Cuál es el efecto de usar fuentes no verificadas?','options'=>[['id'=>'a','text'=>'Las afirmaciones pierden credibilidad y pueden difundir desinformación.','image_url'=>null],['id'=>'b','text'=>'El argumento se vuelve más convincente.','image_url'=>null],['id'=>'c','text'=>'No tiene ningún efecto en la calidad del argumento.','image_url'=>null],['id'=>'d','text'=>'Las fuentes débiles fortalecen la afirmación.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
        ]);

        // Pack 12 — g56_article_and_ad
        $this->insertPack([
            [
                'domain'=>'reading','skill_name'=>'compare_contrast','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Artículo periodístico vs. anuncio publicitario',
                'mission_description'=>'Compara un artículo informativo con un anuncio.',
                'instructions_es'=>'Lee y escoge la mejor comparación.',
                'content'=>['passage'=>'Un artículo periodístico busca informar con hechos verificados. Un anuncio publicitario busca persuadir al lector para comprar o creer algo.','question'=>'¿Cuál es la principal diferencia entre los dos?','options'=>[['id'=>'a','text'=>'El artículo informa con hechos; el anuncio busca persuadir.','image_url'=>null],['id'=>'b','text'=>'Los dos tienen exactamente el mismo propósito.','image_url'=>null],['id'=>'c','text'=>'El anuncio siempre es más objetivo que el artículo.','image_url'=>null],['id'=>'d','text'=>'El artículo busca vender productos.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'inference','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'mission',
                'mission_title'=>'Identifica si es artículo o anuncio',
                'mission_description'=>'Usa el texto para inferir qué tipo de texto es.',
                'instructions_es'=>'Lee y decide si es artículo informativo o anuncio.',
                'content'=>['passage'=>'"¡Nuestro nuevo jugo natural tiene el 100% de vitaminas que tu familia necesita! Pruébalo hoy y siente la diferencia."','question'=>'¿Qué tipo de texto es este?','options'=>[['id'=>'a','text'=>'Un anuncio publicitario que busca persuadir.','image_url'=>null],['id'=>'b','text'=>'Un artículo científico sobre vitaminas.','image_url'=>null],['id'=>'c','text'=>'Un informe nutricional objetivo.','image_url'=>null],['id'=>'d','text'=>'Una noticia periodística de salud.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'main_idea','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Propósito del texto publicitario',
                'mission_description'=>'Lee y determina la idea central del anuncio.',
                'instructions_es'=>'Lee y escoge la idea principal.',
                'content'=>['passage'=>'La clase analizó anuncios y artículos para aprender a distinguir información objetiva de mensajes diseñados para influir en el consumidor.','question'=>'¿Cuál es la idea principal de la lección?','options'=>[['id'=>'a','text'=>'Distinguir textos informativos de textos persuasivos es una habilidad lectora clave.','image_url'=>null],['id'=>'b','text'=>'Los anuncios siempre dicen la verdad.','image_url'=>null],['id'=>'c','text'=>'Los artículos periodísticos también intentan vender.','image_url'=>null],['id'=>'d','text'=>'No es importante diferenciar artículos de anuncios.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'cause_effect','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'¿Qué pasa si no identificamos un anuncio?',
                'mission_description'=>'Analiza el efecto de no reconocer textos persuasivos.',
                'instructions_es'=>'Lee y escoge el efecto correcto.',
                'content'=>['passage'=>'Si el lector no reconoce que un texto es un anuncio, puede tomar decisiones basadas en información parcial o sesgada.','question'=>'¿Cuál es el efecto de no identificar un anuncio?','options'=>[['id'=>'a','text'=>'El lector puede tomar decisiones basadas en información sesgada.','image_url'=>null],['id'=>'b','text'=>'El lector siempre toma mejores decisiones.','image_url'=>null],['id'=>'c','text'=>'La información del anuncio se vuelve objetiva.','image_url'=>null],['id'=>'d','text'=>'No tiene ningún efecto en las decisiones del lector.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
        ]);

        // Pack 13 — g56_data_vs_claims
        $this->insertPack([
            [
                'domain'=>'reading','skill_name'=>'main_idea','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Datos vs. afirmaciones',
                'mission_description'=>'Lee y determina la idea central.',
                'instructions_es'=>'Lee y escoge la idea principal.',
                'content'=>['passage'=>'Una afirmación es una declaración que puede ser verdadera o falsa. Un dato es un hecho verificado. Cuando un dato respalda una afirmación, la hace más sólida.','question'=>'¿Cuál es la idea principal?','options'=>[['id'=>'a','text'=>'Los datos verificados hacen más sólidas las afirmaciones.','image_url'=>null],['id'=>'b','text'=>'Los datos y las afirmaciones son lo mismo.','image_url'=>null],['id'=>'c','text'=>'Las afirmaciones sin datos son siempre falsas.','image_url'=>null],['id'=>'d','text'=>'Los datos no son necesarios para argumentar.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'inference','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'mission',
                'mission_title'=>'Identifica si el dato apoya la afirmación',
                'mission_description'=>'Decide si el dato refuerza la afirmación.',
                'instructions_es'=>'Lee y escoge si el dato apoya la afirmación.',
                'content'=>['passage'=>'Afirmación: "Los jóvenes pasan demasiado tiempo en pantallas." Dato: "El promedio de uso de dispositivos entre jóvenes de 13-17 años es de 7 horas diarias."','question'=>'¿El dato apoya la afirmación?','options'=>[['id'=>'a','text'=>'Sí, 7 horas diarias respalda directamente que es tiempo excesivo.','image_url'=>null],['id'=>'b','text'=>'No, porque el dato no menciona las pantallas.','image_url'=>null],['id'=>'c','text'=>'Solo apoya a algunos jóvenes, no a todos.','image_url'=>null],['id'=>'d','text'=>'El dato contradice la afirmación.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'compare_contrast','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Compara dato y opinión',
                'mission_description'=>'Diferencia entre un dato objetivo y una opinión.',
                'instructions_es'=>'Lee y escoge la mejor comparación.',
                'content'=>['passage'=>'"El 65% de los estudiantes prefiere aprender con tecnología" es un dato de encuesta. "La tecnología es mejor que los libros" es una opinión.','question'=>'¿Cuál es la principal diferencia?','options'=>[['id'=>'a','text'=>'El dato es verificable; la opinión refleja una postura personal sin evidencia medible.','image_url'=>null],['id'=>'b','text'=>'Los dos son igualmente objetivos.','image_url'=>null],['id'=>'c','text'=>'La opinión es más confiable que el dato de encuesta.','image_url'=>null],['id'=>'d','text'=>'El dato no puede verificarse.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'cause_effect','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Efecto de usar solo afirmaciones sin datos',
                'mission_description'=>'Analiza el efecto de argumentar sin datos.',
                'instructions_es'=>'Lee y escoge el efecto correcto.',
                'content'=>['passage'=>'Un argumento basado solo en afirmaciones sin datos verificados es fácilmente cuestionado y pierde fuerza persuasiva.','question'=>'¿Qué efecto tiene argumentar sin datos?','options'=>[['id'=>'a','text'=>'El argumento es fácilmente cuestionado y pierde fuerza persuasiva.','image_url'=>null],['id'=>'b','text'=>'El argumento se vuelve más convincente.','image_url'=>null],['id'=>'c','text'=>'No tiene ningún efecto en la calidad del argumento.','image_url'=>null],['id'=>'d','text'=>'Los datos siempre debilitan los argumentos.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
        ]);

        // Pack 14 — g56_source_strength
        $this->insertPack([
            [
                'domain'=>'reading','skill_name'=>'main_idea','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'La fortaleza de las fuentes',
                'mission_description'=>'Lee y determina la idea central.',
                'instructions_es'=>'Lee y escoge la idea principal.',
                'content'=>['passage'=>'No todas las fuentes tienen el mismo peso. Una fuente primaria (investigación directa) es más fuerte que una fuente secundaria (resumen de otro texto) para apoyar una afirmación.','question'=>'¿Cuál es la idea principal?','options'=>[['id'=>'a','text'=>'Las fuentes primarias son más fuertes para apoyar afirmaciones que las secundarias.','image_url'=>null],['id'=>'b','text'=>'Las fuentes secundarias son siempre más confiables.','image_url'=>null],['id'=>'c','text'=>'Todas las fuentes tienen exactamente el mismo peso.','image_url'=>null],['id'=>'d','text'=>'Solo las fuentes en inglés son válidas.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'compare_contrast','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Fuente primaria vs. fuente secundaria',
                'mission_description'=>'Compara los dos tipos de fuentes.',
                'instructions_es'=>'Lee y escoge la mejor comparación.',
                'content'=>['passage'=>'Fuente primaria: el estudio original publicado en una revista científica. Fuente secundaria: un artículo de blog que resume ese estudio.','question'=>'¿Cuál es la principal diferencia?','options'=>[['id'=>'a','text'=>'La primaria es el estudio original; la secundaria lo resume e interpreta.','image_url'=>null],['id'=>'b','text'=>'Las dos contienen exactamente la misma información.','image_url'=>null],['id'=>'c','text'=>'La secundaria es siempre más exacta.','image_url'=>null],['id'=>'d','text'=>'Solo la secundaria es verificable.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'inference','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'mission',
                'mission_title'=>'Infiere cuál fuente usar',
                'mission_description'=>'Decide qué fuente sería más apropiada para el argumento.',
                'instructions_es'=>'Lee y escoge la fuente más adecuada.',
                'content'=>['passage'=>'Estás escribiendo un ensayo sobre los efectos del cambio climático. Encontraste: A) Informe del IPCC (panel intergubernamental de expertos). B) Post de red social de un influencer.','question'=>'¿Cuál fuente usarías principalmente en tu ensayo?','options'=>[['id'=>'a','text'=>'El informe del IPCC, por ser una fuente primaria de expertos verificables.','image_url'=>null],['id'=>'b','text'=>'El post del influencer, por ser más reciente.','image_url'=>null],['id'=>'c','text'=>'Las dos son igualmente válidas para un ensayo académico.','image_url'=>null],['id'=>'d','text'=>'Ninguna de las dos es útil.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'cause_effect','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Efecto de citar fuentes débiles',
                'mission_description'=>'Analiza qué pasa cuando citas fuentes poco confiables.',
                'instructions_es'=>'Lee y escoge el efecto correcto.',
                'content'=>['passage'=>'Cuando un texto cita fuentes poco confiables, sus conclusiones son más fácilmente refutadas por expertos o lectores críticos.','question'=>'¿Cuál es el efecto de citar fuentes débiles?','options'=>[['id'=>'a','text'=>'Las conclusiones son más fácilmente refutadas.','image_url'=>null],['id'=>'b','text'=>'El texto gana más credibilidad.','image_url'=>null],['id'=>'c','text'=>'Las conclusiones se vuelven más sólidas.','image_url'=>null],['id'=>'d','text'=>'No afecta la calidad del texto.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
        ]);

        // Pack 15 — g56_limits_of_a_claim
        $this->insertPack([
            [
                'domain'=>'reading','skill_name'=>'main_idea','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Los límites de una afirmación',
                'mission_description'=>'Lee y determina la idea central.',
                'instructions_es'=>'Lee y escoge la idea principal.',
                'content'=>['passage'=>'Toda afirmación tiene límites: aplica en un contexto específico y no puede generalizarse sin evidencia adicional. Reconocer estos límites es parte del pensamiento crítico.','question'=>'¿Cuál es la idea principal?','options'=>[['id'=>'a','text'=>'Reconocer los límites de una afirmación es parte del pensamiento crítico.','image_url'=>null],['id'=>'b','text'=>'Una afirmación válida se aplica en todos los contextos sin excepción.','image_url'=>null],['id'=>'c','text'=>'El pensamiento crítico no tiene nada que ver con las afirmaciones.','image_url'=>null],['id'=>'d','text'=>'Las afirmaciones sin límites son siempre más útiles.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'inference','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'mission',
                'mission_title'=>'Infiere el límite de la afirmación',
                'mission_description'=>'Decide en qué situación la afirmación ya no aplica.',
                'instructions_es'=>'Lee y escoge el límite correcto.',
                'content'=>['passage'=>'Afirmación: "Los estudiantes aprenden mejor con música de fondo." Esta conclusión se basó en un estudio con adultos jóvenes en una universidad.','question'=>'¿Cuál es el límite de esta afirmación?','options'=>[['id'=>'a','text'=>'No puede generalizarse automáticamente a niños de primaria u otras culturas.','image_url'=>null],['id'=>'b','text'=>'Se aplica igualmente a todos sin importar la edad ni el contexto.','image_url'=>null],['id'=>'c','text'=>'Es completamente falsa porque no hay ningún estudio.','image_url'=>null],['id'=>'d','text'=>'Solo aplica en universidades de ese país específico.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'supporting_details','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'friendly_challenge',
                'mission_title'=>'Detalle que señala el límite',
                'mission_description'=>'Identifica el detalle que indica dónde aplica la afirmación.',
                'instructions_es'=>'Lee y escoge el detalle correcto.',
                'content'=>['passage'=>'El estudio especificó: "Los resultados son válidos para adultos sanos en entornos universitarios silenciosos."','question'=>'¿Qué detalle muestra el límite de los resultados?','options'=>[['id'=>'a','text'=>'"Válidos para adultos sanos en entornos universitarios silenciosos."','image_url'=>null],['id'=>'b','text'=>'El título del investigador principal.','image_url'=>null],['id'=>'c','text'=>'El año en que se publicó el estudio.','image_url'=>null],['id'=>'d','text'=>'El número de páginas del informe.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'cause_effect','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Efecto de generalizar sin evidencia',
                'mission_description'=>'Analiza qué pasa cuando se generaliza sin respetar límites.',
                'instructions_es'=>'Lee y escoge el efecto correcto.',
                'content'=>['passage'=>'Cuando una afirmación se generaliza más allá de su evidencia, se corre el riesgo de sacar conclusiones incorrectas en contextos diferentes.','question'=>'¿Qué efecto tiene generalizar una afirmación más allá de su evidencia?','options'=>[['id'=>'a','text'=>'Se pueden sacar conclusiones incorrectas en otros contextos.','image_url'=>null],['id'=>'b','text'=>'La afirmación se vuelve más precisa.','image_url'=>null],['id'=>'c','text'=>'La evidencia se fortalece automáticamente.','image_url'=>null],['id'=>'d','text'=>'No hay ningún riesgo en generalizar afirmaciones.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
        ]);

        // Pack 16 — g56_biased_message
        $this->insertPack([
            [
                'domain'=>'reading','skill_name'=>'main_idea','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Detecta el sesgo en un mensaje',
                'mission_description'=>'Lee y determina la idea central sobre el sesgo.',
                'instructions_es'=>'Lee y escoge la idea principal.',
                'content'=>['passage'=>'Un mensaje sesgado presenta solo una perspectiva de un tema, omite información contraria y usa lenguaje cargado emocionalmente para influir al lector.','question'=>'¿Cuál es la idea principal?','options'=>[['id'=>'a','text'=>'Los mensajes sesgados presentan solo una perspectiva y usan lenguaje emocional para influir.','image_url'=>null],['id'=>'b','text'=>'Todos los mensajes son sesgados por naturaleza.','image_url'=>null],['id'=>'c','text'=>'El sesgo siempre hace los mensajes más precisos.','image_url'=>null],['id'=>'d','text'=>'El sesgo no afecta la comprensión del lector.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'inference','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'mission',
                'mission_title'=>'Identifica el sesgo en el texto',
                'mission_description'=>'Decide si el mensaje es sesgado y por qué.',
                'instructions_es'=>'Lee y escoge si el mensaje es sesgado.',
                'content'=>['passage'=>'"Todos saben que la energía nuclear es extremadamente peligrosa y nadie que quiera a sus hijos debería apoyarla."','question'=>'¿Este mensaje es sesgado? ¿Por qué?','options'=>[['id'=>'a','text'=>'Sí, usa lenguaje emocional ("quiera a sus hijos") y omite datos objetivos sobre seguridad.','image_url'=>null],['id'=>'b','text'=>'No, presenta datos científicos objetivos.','image_url'=>null],['id'=>'c','text'=>'Solo parcialmente, porque menciona un hecho real.','image_url'=>null],['id'=>'d','text'=>'No hay suficiente información para decidir.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'compare_contrast','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Compara mensaje sesgado vs. objetivo',
                'mission_description'=>'Diferencia entre un mensaje sesgado y uno objetivo.',
                'instructions_es'=>'Lee y escoge la mejor comparación.',
                'content'=>['passage'=>'Mensaje A: "Los estudios muestran que la energía nuclear tiene el menor número de muertes por unidad de energía de todas las fuentes." Mensaje B: "La energía nuclear es un peligro mortal para todos."','question'=>'¿Cuál es la principal diferencia?','options'=>[['id'=>'a','text'=>'El A presenta datos verificables; el B usa lenguaje emocional sin citar datos.','image_url'=>null],['id'=>'b','text'=>'Los dos son igualmente objetivos.','image_url'=>null],['id'=>'c','text'=>'El B es más preciso porque es más enfático.','image_url'=>null],['id'=>'d','text'=>'El A es más sesgado que el B.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'cause_effect','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Efecto del sesgo en el lector',
                'mission_description'=>'Analiza cómo afecta el sesgo la comprensión del lector.',
                'instructions_es'=>'Lee y escoge el efecto correcto.',
                'content'=>['passage'=>'Los mensajes sesgados pueden llevar al lector a adoptar una postura sin considerar toda la evidencia disponible.','question'=>'¿Cuál es el efecto del sesgo en el lector?','options'=>[['id'=>'a','text'=>'Puede llevar al lector a adoptar una postura sin considerar toda la evidencia.','image_url'=>null],['id'=>'b','text'=>'Siempre ayuda al lector a formarse una opinión más completa.','image_url'=>null],['id'=>'c','text'=>'No tiene ningún efecto en la comprensión del lector.','image_url'=>null],['id'=>'d','text'=>'El sesgo hace los textos más informativos.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
        ]);

        // Pack 17 — g56_claim_and_counterpoint
        $this->insertPack([
            [
                'domain'=>'reading','skill_name'=>'compare_contrast','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Afirmación y contrapunto',
                'mission_description'=>'Compara una afirmación con su contrapunto.',
                'instructions_es'=>'Lee y escoge la mejor comparación.',
                'content'=>['passage'=>'Afirmación: "Las tareas escolares mejoran el aprendizaje." Contrapunto: "Las tareas en exceso aumentan el estrés sin mejorar el rendimiento."','question'=>'¿Cuál es la relación entre ambos?','options'=>[['id'=>'a','text'=>'Presentan perspectivas opuestas sobre el mismo tema con matices distintos.','image_url'=>null],['id'=>'b','text'=>'Los dos dicen exactamente lo mismo.','image_url'=>null],['id'=>'c','text'=>'El contrapunto confirma la afirmación original.','image_url'=>null],['id'=>'d','text'=>'Los dos son igualmente incorrectos.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'main_idea','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Propósito de incluir el contrapunto',
                'mission_description'=>'Lee y determina por qué se incluye el contrapunto.',
                'instructions_es'=>'Lee y escoge la idea principal.',
                'content'=>['passage'=>'Un texto que incluye afirmaciones y sus contrapuntos presenta múltiples perspectivas, lo que ayuda al lector a formarse una opinión más informada y equilibrada.','question'=>'¿Cuál es el propósito de incluir el contrapunto?','options'=>[['id'=>'a','text'=>'Presentar múltiples perspectivas para que el lector forme una opinión equilibrada.','image_url'=>null],['id'=>'b','text'=>'Confundir al lector con información contradictoria.','image_url'=>null],['id'=>'c','text'=>'Demostrar que la afirmación original es incorrecta.','image_url'=>null],['id'=>'d','text'=>'Añadir información innecesaria al texto.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'inference','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'mission',
                'mission_title'=>'Infiere la postura del autor',
                'mission_description'=>'Usa el texto para inferir si el autor tiene una postura.',
                'instructions_es'=>'Lee y escoge la inferencia correcta.',
                'content'=>['passage'=>'El artículo presenta tres argumentos a favor de las tareas y luego solo uno en contra, sin profundizar en este último.','question'=>'¿Qué podemos inferir sobre la postura del autor?','options'=>[['id'=>'a','text'=>'El autor probablemente es más favorable a las tareas, dada la distribución desigual de argumentos.','image_url'=>null],['id'=>'b','text'=>'El autor es perfectamente neutral.','image_url'=>null],['id'=>'c','text'=>'El autor está en contra de las tareas.','image_url'=>null],['id'=>'d','text'=>'No es posible inferir ninguna postura del autor.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'cause_effect','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Efecto de ignorar el contrapunto',
                'mission_description'=>'Analiza qué pasa si no se considera el contrapunto.',
                'instructions_es'=>'Lee y escoge el efecto correcto.',
                'content'=>['passage'=>'Si el lector solo considera la afirmación y descarta el contrapunto, puede formarse una visión parcial del tema.','question'=>'¿Qué efecto tiene ignorar el contrapunto?','options'=>[['id'=>'a','text'=>'El lector puede formarse una visión parcial del tema.','image_url'=>null],['id'=>'b','text'=>'El lector comprende mejor el tema.','image_url'=>null],['id'=>'c','text'=>'El contrapunto no afecta la comprensión del tema.','image_url'=>null],['id'=>'d','text'=>'La afirmación se vuelve automáticamente correcta.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
        ]);

        // Pack 18 — g56_missing_evidence
        $this->insertPack([
            [
                'domain'=>'reading','skill_name'=>'main_idea','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'La evidencia que falta',
                'mission_description'=>'Lee y determina la idea central.',
                'instructions_es'=>'Lee y escoge la idea principal.',
                'content'=>['passage'=>'Un argumento fuerte anticipa las objeciones y presenta evidencia para refutarlas. Cuando falta evidencia clave, el argumento tiene brechas que el lector crítico puede identificar.','question'=>'¿Cuál es la idea principal?','options'=>[['id'=>'a','text'=>'Los argumentos fuertes responden objeciones; las brechas de evidencia los debilitan.','image_url'=>null],['id'=>'b','text'=>'Todo argumento tiene suficiente evidencia por defecto.','image_url'=>null],['id'=>'c','text'=>'Un lector crítico siempre acepta los argumentos sin cuestionar.','image_url'=>null],['id'=>'d','text'=>'Las objeciones no deben mencionarse en un argumento.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'inference','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'mission',
                'mission_title'=>'Identifica la evidencia que falta',
                'mission_description'=>'Detecta qué información es necesaria pero no está.',
                'instructions_es'=>'Lee y escoge la evidencia que falta.',
                'content'=>['passage'=>'El artículo afirma: "Los videojuegos mejoran la concentración." Cita un estudio con 20 estudiantes de una ciudad. No menciona grupos de control, edad ni resultados a largo plazo.','question'=>'¿Qué evidencia clave le falta al artículo?','options'=>[['id'=>'a','text'=>'Grupo de control, diversidad de edades y resultados a largo plazo.','image_url'=>null],['id'=>'b','text'=>'El nombre del videojuego utilizado.','image_url'=>null],['id'=>'c','text'=>'El precio de los videojuegos estudiados.','image_url'=>null],['id'=>'d','text'=>'La duración de cada sesión de juego.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'supporting_details','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'friendly_challenge',
                'mission_title'=>'Detalle que fortalecería el argumento',
                'mission_description'=>'Identifica qué dato fortalecería la afirmación.',
                'instructions_es'=>'Lee y escoge el detalle que fortalecería el argumento.',
                'content'=>['passage'=>'Afirmación: "La lectura en papel mejora la retención más que en pantalla."','question'=>'¿Qué detalle fortalecería más esta afirmación?','options'=>[['id'=>'a','text'=>'Un estudio comparativo con grupos de control, múltiples edades y textos similares.','image_url'=>null],['id'=>'b','text'=>'La opinión de un profesor sobre los libros.','image_url'=>null],['id'=>'c','text'=>'El precio promedio de libros en el mercado.','image_url'=>null],['id'=>'d','text'=>'El número de bibliotecas en el país.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'cause_effect','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Efecto de las brechas de evidencia',
                'mission_description'=>'Analiza qué pasa cuando falta evidencia clave.',
                'instructions_es'=>'Lee y escoge el efecto correcto.',
                'content'=>['passage'=>'Cuando un argumento tiene brechas de evidencia, un lector informado puede cuestionarlo y el argumento pierde credibilidad.','question'=>'¿Qué efecto tienen las brechas de evidencia en un argumento?','options'=>[['id'=>'a','text'=>'El argumento puede ser cuestionado y pierde credibilidad.','image_url'=>null],['id'=>'b','text'=>'El argumento se vuelve más persuasivo.','image_url'=>null],['id'=>'c','text'=>'Las brechas hacen el argumento más completo.','image_url'=>null],['id'=>'d','text'=>'Solo los expertos pueden detectar brechas de evidencia.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
        ]);

        // Pack 19 — g56_reliable_or_not
        $this->insertPack([
            [
                'domain'=>'reading','skill_name'=>'main_idea','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'¿Confiable o no?',
                'mission_description'=>'Lee y determina la idea central.',
                'instructions_es'=>'Lee y escoge la idea principal.',
                'content'=>['passage'=>'Evaluar la confiabilidad de una fuente requiere verificar la autoría, el respaldo institucional, la fecha de publicación y si la información puede corroborarse en otras fuentes.','question'=>'¿Cuál es la idea principal?','options'=>[['id'=>'a','text'=>'Evaluar la confiabilidad requiere verificar varios criterios: autor, institución, fecha y corroboración.','image_url'=>null],['id'=>'b','text'=>'Solo la fecha de publicación determina si una fuente es confiable.','image_url'=>null],['id'=>'c','text'=>'Todas las fuentes en internet son igualmente confiables.','image_url'=>null],['id'=>'d','text'=>'La confiabilidad se determina por la extensión del texto.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'inference','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'mission',
                'mission_title'=>'Evalúa si la fuente es confiable',
                'mission_description'=>'Usa los criterios para inferir si la fuente es confiable.',
                'instructions_es'=>'Lee y decide si la fuente es confiable.',
                'content'=>['passage'=>'Fuente: artículo sin autor, publicado en un blog personal, sin citas, con información que contradice múltiples estudios revisados por pares.','question'=>'¿Esta fuente es confiable?','options'=>[['id'=>'a','text'=>'No, carece de autoría, respaldo institucional y contradice estudios verificados.','image_url'=>null],['id'=>'b','text'=>'Sí, los blogs personales siempre son confiables.','image_url'=>null],['id'=>'c','text'=>'Solo es confiable para temas de opinión.','image_url'=>null],['id'=>'d','text'=>'No hay suficiente información para decidir.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'compare_contrast','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Compara dos fuentes sobre el mismo tema',
                'mission_description'=>'Analiza qué hace más confiable a una fuente.',
                'instructions_es'=>'Lee y escoge la mejor comparación.',
                'content'=>['passage'=>'Fuente A: artículo de revista científica revisado por pares, autores identificados, institución universitaria. Fuente B: video de YouTube sin referencias, autor desconocido.','question'=>'¿Cuál es la principal diferencia en confiabilidad?','options'=>[['id'=>'a','text'=>'La fuente A tiene criterios de verificabilidad que la B no tiene.','image_url'=>null],['id'=>'b','text'=>'Las dos son igualmente confiables.','image_url'=>null],['id'=>'c','text'=>'La fuente B es más actualizada, así que es más confiable.','image_url'=>null],['id'=>'d','text'=>'La fuente A no es confiable porque es muy larga.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'cause_effect','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Efecto de confiar en fuentes no confiables',
                'mission_description'=>'Analiza las consecuencias de usar fuentes sin verificar.',
                'instructions_es'=>'Lee y escoge el efecto correcto.',
                'content'=>['passage'=>'Confiar en fuentes no verificadas puede llevar a tomar decisiones basadas en información falsa o incompleta, con consecuencias negativas.','question'=>'¿Cuál es el efecto de confiar en fuentes no verificadas?','options'=>[['id'=>'a','text'=>'Se pueden tomar decisiones basadas en información falsa con consecuencias negativas.','image_url'=>null],['id'=>'b','text'=>'Las decisiones tomadas son siempre correctas.','image_url'=>null],['id'=>'c','text'=>'La información de fuentes no verificadas siempre es verdadera.','image_url'=>null],['id'=>'d','text'=>'No hay consecuencias negativas al usar cualquier fuente.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
        ]);

        // Pack 20 — g56_fair_or_one_sided
        $this->insertPack([
            [
                'domain'=>'reading','skill_name'=>'compare_contrast','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'¿Equilibrado o parcial?',
                'mission_description'=>'Compara un texto equilibrado con uno parcial.',
                'instructions_es'=>'Lee y escoge la mejor comparación.',
                'content'=>['passage'=>'Un texto equilibrado presenta múltiples puntos de vista con evidencia para cada uno. Un texto parcial favorece una postura y minimiza o ignora las demás.','question'=>'¿Cuál es la principal diferencia?','options'=>[['id'=>'a','text'=>'El equilibrado presenta múltiples perspectivas; el parcial favorece solo una.','image_url'=>null],['id'=>'b','text'=>'Los dos tipos de texto son igualmente informativos.','image_url'=>null],['id'=>'c','text'=>'El texto parcial siempre es más honesto.','image_url'=>null],['id'=>'d','text'=>'Un texto equilibrado no puede tener una conclusión.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'inference','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'mission',
                'mission_title'=>'Identifica si el artículo es parcial',
                'mission_description'=>'Usa el texto para inferir si es equilibrado o no.',
                'instructions_es'=>'Lee y escoge si el texto es equilibrado o parcial.',
                'content'=>['passage'=>'El artículo dedica 8 párrafos a los beneficios de las redes sociales y un solo párrafo a sus riesgos, usando términos como "supuestos peligros" para describir los problemas.','question'=>'¿El artículo es equilibrado o parcial?','options'=>[['id'=>'a','text'=>'Parcial: favorece los beneficios y minimiza los riesgos con lenguaje desestimador.','image_url'=>null],['id'=>'b','text'=>'Equilibrado: menciona los dos aspectos del tema.','image_url'=>null],['id'=>'c','text'=>'No hay suficiente información para decidir.','image_url'=>null],['id'=>'d','text'=>'Parcial solo porque usa un lenguaje muy técnico.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'supporting_details','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'friendly_challenge',
                'mission_title'=>'Detalle que indica parcialidad',
                'mission_description'=>'Identifica el detalle que revela el sesgo del texto.',
                'instructions_es'=>'Lee y escoge el detalle que indica parcialidad.',
                'content'=>['passage'=>'El artículo usa el término "supuestos peligros" para los riesgos documentados de las redes sociales en lugar de citar los estudios que los demuestran.','question'=>'¿Qué detalle indica que el artículo es parcial?','options'=>[['id'=>'a','text'=>'El uso de "supuestos peligros" en vez de citar estudios que los documentan.','image_url'=>null],['id'=>'b','text'=>'El artículo es muy largo.','image_url'=>null],['id'=>'c','text'=>'El artículo menciona el nombre de varias redes sociales.','image_url'=>null],['id'=>'d','text'=>'El artículo fue publicado en un periódico.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
            [
                'domain'=>'reading','skill_name'=>'cause_effect','grade_band'=>'upper',
                'type'=>'multiple_choice','difficulty'=>3,'lesson_mood'=>'curious',
                'mission_title'=>'Efecto de leer solo textos parciales',
                'mission_description'=>'Analiza qué pasa si el lector solo consume textos parciales.',
                'instructions_es'=>'Lee y escoge el efecto correcto.',
                'content'=>['passage'=>'Si un lector solo consume textos que favorecen una perspectiva, su comprensión del tema quedará incompleta y potencialmente sesgada.','question'=>'¿Cuál es el efecto de leer solo textos parciales?','options'=>[['id'=>'a','text'=>'La comprensión del tema quedará incompleta y sesgada.','image_url'=>null],['id'=>'b','text'=>'El lector entenderá mejor el tema con perspectivas claras.','image_url'=>null],['id'=>'c','text'=>'Los textos parciales siempre mejoran la comprensión lectora.','image_url'=>null],['id'=>'d','text'=>'No hay ningún efecto negativo en leer solo una perspectiva.','image_url'=>null]]],
                'correct_answer'=>['correct_option_id'=>'a'],
            ],
        ]);

        $this->command->info('G56 Reading: 20 packs seeded.');
    }
}
