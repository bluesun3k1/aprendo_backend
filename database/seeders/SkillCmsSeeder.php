<?php

namespace Database\Seeders;

use App\Models\DomainMilestone;
use App\Models\Skill;
use App\Models\SkillContent;
use Illuminate\Database\Seeder;

class SkillCmsSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedMilestones();
        $this->seedSkillContents();
    }

    // -----------------------------------------------------------------------
    // Domain unlock milestones
    // -----------------------------------------------------------------------
    private function seedMilestones(): void
    {
        DomainMilestone::truncate();

        $milestones = [
            'reading' => [
                [40, 'Explorador de lectura',   'Sigue practicando comprensión para alcanzar este logro.',        1],
                [60, 'Navegante lector',          'Estás dominando la lectura. ¡Un poco más!',                      2],
                [80, 'Maestro lector',            'Casi eres un maestro de la comprensión lectora.',                3],
            ],
            'attention' => [
                [40, 'Explorador de enfoque',    'Sigue entrenando tu atención para desbloquear esto.',            1],
                [60, 'Guardián de atención',     '¡Tu enfoque está mejorando mucho!',                             2],
                [80, 'Maestro de atención',      'Estás a punto de dominar la atención y el enfoque.',            3],
            ],
            'reasoning' => [
                [40, 'Explorador lógico',        'Sigue resolviendo problemas para alcanzar este logro.',          1],
                [60, 'Navegante lógico',         '¡Tu razonamiento está creciendo! Sigue así.',                   2],
                [80, 'Maestro del razonamiento', 'Estás muy cerca de dominar el pensamiento crítico.',             3],
            ],
        ];

        foreach ($milestones as $domainId => $rows) {
            foreach ($rows as [$threshold, $name, $description, $sortOrder]) {
                DomainMilestone::create([
                    'domain_id'   => $domainId,
                    'threshold'   => $threshold,
                    'name'        => $name,
                    'description' => $description,
                    'sort_order'  => $sortOrder,
                ]);
            }
        }
    }

    // -----------------------------------------------------------------------
    // Per-skill CMS content
    // -----------------------------------------------------------------------
    private function seedSkillContents(): void
    {
        SkillContent::truncate();

        $contents = [

            // ── READING ──────────────────────────────────────────────────────────

            'main_idea' => [
                'description'         => 'Encontrar la idea principal significa entender de qué trata principalmente un párrafo o historia, aunque haya muchos detalles a su alrededor.',
                'why_it_matters'      => 'Esta habilidad te ayuda a comprender textos más rápido, recordar información importante y responder preguntas con más confianza.',
                'doing_well_high'     => 'Estás identificando bien la oración que mejor explica todo el texto, especialmente cuando el tema es claro desde el inicio.',
                'doing_well_low'      => 'Estás aprendiendo a distinguir la idea principal de los detalles secundarios, lo cual es un avance importante.',
                'practice_next_high'  => 'Practica con textos más largos donde la idea principal no aparece al principio del párrafo.',
                'practice_next_low'   => 'Practica ignorar los detalles extra y elige la oración que mejor explique todo el texto, no solo una parte.',
                'insight_tip'         => 'Busca la oración que abarca todo el texto',
                'insight_tip_body'    => 'Una idea principal generalmente conecta la mayoría de los detalles. Si una respuesta solo coincide con una pequeña parte, probablemente no es la mejor opción.',
                'insight_example'     => 'Si una historia habla sobre tierra seca, flores marchitas y un plan de riego, la idea principal no es solo "flores". Es que el jardín necesitaba ayuda y alguien resolvió el problema.',
            ],

            'supporting_details' => [
                'description'         => 'Los detalles de apoyo son la información específica que el autor incluye para explicar, demostrar o reforzar la idea principal.',
                'why_it_matters'      => 'Saber distinguir los detalles de apoyo te ayuda a entender por qué el autor dice lo que dice y a responder preguntas de comprensión con más precisión.',
                'doing_well_high'     => 'Estás identificando correctamente qué información apoya la idea principal y cuál es irrelevante.',
                'doing_well_low'      => 'Estás aprendiendo a diferenciar entre detalles importantes y datos que no refuerzan la idea del texto.',
                'practice_next_high'  => 'Practica con textos que tienen múltiples ideas y cuyas pistas de apoyo son más sutiles.',
                'practice_next_low'   => 'Pregúntate: "¿este detalle explica o demuestra la idea principal?" Si la respuesta es sí, es un detalle de apoyo.',
                'insight_tip'         => 'Un detalle de apoyo explica el "por qué" o el "cómo"',
                'insight_tip_body'    => 'Los detalles de apoyo responden preguntas como: ¿por qué?, ¿cómo?, ¿cuándo?, ¿dónde? Si el detalle no responde ninguna de esas preguntas sobre la idea principal, probablemente no es de apoyo.',
                'insight_example'     => 'Si la idea principal es "los perros son buenos compañeros", los detalles de apoyo serían: "detectan emociones de sus dueños" o "reducen el estrés". "Los perros tienen cuatro patas" no apoya esa idea.',
            ],

            'sequencing' => [
                'description'         => 'La secuencia es el orden en que ocurren los eventos de un texto, desde el primero hasta el último.',
                'why_it_matters'      => 'Seguir el orden correcto de eventos te ayuda a entender historias y procesos, y a seguir instrucciones paso a paso.',
                'doing_well_high'     => 'Estás siguiendo el orden de los eventos con precisión, incluso cuando el texto no los presenta cronológicamente.',
                'doing_well_low'      => 'Estás identificando el orden de los eventos más obvios en el texto.',
                'practice_next_high'  => 'Practica con textos que usan flashbacks o que mezclan el orden temporal.',
                'practice_next_low'   => 'Numera los eventos con 1, 2, 3 mientras lees para no perder el hilo.',
                'insight_tip'         => 'Los marcadores de tiempo son tus aliados',
                'insight_tip_body'    => 'Palabras como "primero", "luego", "después", "finalmente" y fechas o horas te indican el orden correcto de los eventos.',
                'insight_example'     => 'Si una receta dice "primero mezcla los ingredientes, luego añade agua, finalmente hornea", puedes seguir exactamente qué hacer y en qué orden.',
            ],

            'inference' => [
                'description'         => 'Hacer inferencias significa usar las pistas del texto para entender cosas que el autor no dice directamente.',
                'why_it_matters'      => 'Las inferencias te permiten entender textos más profundos, descubrir intenciones ocultas y disfrutar más de la lectura.',
                'doing_well_high'     => 'Estás usando las pistas del texto con habilidad para llegar a conclusiones que no están escritas directamente.',
                'doing_well_low'      => 'Ya estás notando algunas pistas en el texto que te ayudan a deducir lo que no está escrito.',
                'practice_next_high'  => 'Practica con textos donde las inferencias son más sutiles o implícitas.',
                'practice_next_low'   => 'Antes de responder, identifica en qué pista del texto te basas para tu inferencia.',
                'insight_tip'         => 'Usa las pistas del texto para deducir',
                'insight_tip_body'    => 'El autor deja pistas en las palabras, las acciones y el contexto. Combina esas pistas con lo que ya sabes para llegar a la respuesta.',
                'insight_example'     => 'Si la historia dice que un niño entra al salón con la ropa mojada y una mochila goteando, puedes inferir que llovió afuera, aunque la historia nunca lo mencione.',
            ],

            'context_clues' => [
                'description'         => 'Las pistas de contexto son las palabras y oraciones que rodean una palabra desconocida y te ayudan a deducir su significado.',
                'why_it_matters'      => 'Un vocabulario más amplio te ayuda a leer con mayor fluidez y a expresarte mejor tanto en la escuela como en la vida diaria.',
                'doing_well_high'     => 'Estás usando el contexto de manera efectiva para deducir el significado de palabras nuevas.',
                'doing_well_low'      => 'Estás intentando descifrar palabras nuevas a partir del texto que las rodea.',
                'practice_next_high'  => 'Practica con vocabulario académico y palabras que aparecen en varias materias.',
                'practice_next_low'   => 'Lee las oraciones alrededor de la palabra desconocida para encontrar pistas de su significado.',
                'insight_tip'         => 'El contexto es tu diccionario',
                'insight_tip_body'    => 'Las palabras antes y después de una palabra difícil casi siempre revelan su significado. Busca antónimos, explicaciones o ejemplos en el texto.',
                'insight_example'     => 'Si el texto dice "El árido desierto, donde la lluvia casi nunca cae", la palabra árido probablemente significa seco, aunque no la hayas visto antes.',
            ],

            'summarization' => [
                'description'         => 'Resumir significa reducir un texto largo a sus ideas más importantes, usando tus propias palabras.',
                'why_it_matters'      => 'Saber resumir te ayuda a estudiar mejor, a retener información clave y a explicarle algo a otra persona de forma clara.',
                'doing_well_high'     => 'Estás capturando las ideas esenciales del texto sin copiar frases literales ni perder información clave.',
                'doing_well_low'      => 'Estás incluyendo las ideas más obvias del texto en tus resúmenes.',
                'practice_next_high'  => 'Practica resumiendo textos más largos en una o dos oraciones.',
                'practice_next_low'   => 'Después de leer, cierra el texto y escribe las 3 cosas más importantes que recuerdes.',
                'insight_tip'         => 'Incluye solo lo que no se puede dejar fuera',
                'insight_tip_body'    => 'Un buen resumen responde: ¿quién o qué?, ¿qué pasó?, ¿cuál fue el resultado? Todo lo demás es detalle que puedes omitir.',
                'insight_example'     => 'Si una historia tiene 10 oraciones sobre un viaje al mercado, tu resumen necesita saber: quién fue, por qué fue y qué pasó al final.',
            ],

            'compare_contrast' => [
                'description'         => 'Comparar y contrastar significa identificar en qué se parecen y en qué se diferencian dos o más cosas dentro de un texto.',
                'why_it_matters'      => 'Esta habilidad te ayuda a organizar información y a tomar mejores decisiones analizando las opciones disponibles.',
                'doing_well_high'     => 'Estás identificando con precisión las semejanzas y diferencias clave en los textos que lees.',
                'doing_well_low'      => 'Estás comenzando a notar las diferencias y similitudes más obvias entre los elementos del texto.',
                'practice_next_high'  => 'Practica comparando elementos con características mezcladas: algunas iguales y otras diferentes.',
                'practice_next_low'   => 'Usa un diagrama de Venn mental: piensa en qué va en el centro y qué solo pertenece a cada lado.',
                'insight_tip'         => 'Busca primero lo diferente, luego lo igual',
                'insight_tip_body'    => 'Las diferencias suelen ser más fáciles de ver. Una vez que las identifiques, será más sencillo encontrar lo que sí tienen en común.',
                'insight_example'     => 'Si el texto habla de dos animales del desierto, uno nocturno y uno diurno, ambos se adaptan al calor (similitud) pero de formas opuestas (diferencia).',
            ],

            'identifying_purpose' => [
                'description'         => 'El propósito del autor es la razón principal por la que alguien escribe: para informar, persuadir, entretener o describir.',
                'why_it_matters'      => 'Entender el propósito del autor te ayuda a leer de forma más crítica y a no confundir opiniones con hechos.',
                'doing_well_high'     => 'Estás diferenciando bien cuándo un texto busca informar, convencer o entretener.',
                'doing_well_low'      => 'Estás aprendiendo a preguntarte "¿por qué lo escribió?" al leer un texto.',
                'practice_next_high'  => 'Practica con textos mixtos donde el autor usa más de un propósito a la vez.',
                'practice_next_low'   => '¿El autor me está dando datos, quiere que cambie mi opinión, o solo me está contando una historia?',
                'insight_tip'         => 'Pregúntate: ¿por qué lo escribió?',
                'insight_tip_body'    => 'Si el texto tiene muchos datos, probablemente informa. Si usa palabras fuertes para convencerte, está persuadiendo. Si te hace sentir algo, entretiene.',
                'insight_example'     => 'Un artículo sobre cómo alimentar a tu perro informa. Un anuncio que dice "¡El mejor alimento para perros!" persuade. Un cuento sobre un perrito aventurero entretiene.',
            ],

            'fact_vs_opinion' => [
                'description'         => 'Distinguir hechos de opiniones significa reconocer cuándo algo puede verificarse como verdadero y cuándo es solo el punto de vista de alguien.',
                'why_it_matters'      => 'Esta habilidad te protege de creer todo lo que lees y te ayuda a pensar de forma más crítica e independiente.',
                'doing_well_high'     => 'Estás distinguiendo bien entre los datos verificables y los juicios de valor en los textos.',
                'doing_well_low'      => 'Estás comenzando a cuestionar si lo que lees es un hecho o una opinión.',
                'practice_next_high'  => 'Practica con textos periodísticos que mezclan datos y editoriales.',
                'practice_next_low'   => 'Pregúntate: "¿se puede comprobar esto?" Si sí, es un hecho. Si depende del punto de vista, es una opinión.',
                'insight_tip'         => 'Pregúntate: ¿se puede comprobar?',
                'insight_tip_body'    => 'Los hechos tienen evidencia o datos concretos. Las opiniones usan palabras como "creo", "debería", "el mejor", "el peor".',
                'insight_example'     => '"La Luna tiene 3.474 km de diámetro" es un hecho. "La Luna es más interesante que el Sol" es una opinión, porque depende de con quién se hable.',
            ],

            'evaluating_evidence' => [
                'description'         => 'Evaluar la evidencia significa juzgar si los datos, ejemplos o razones que da un autor son suficientemente buenos para apoyar su argumento.',
                'why_it_matters'      => 'Te ayuda a leer de forma crítica, a no aceptar argumentos débiles y a construir tus propios razonamientos con bases sólidas.',
                'doing_well_high'     => 'Estás evaluando con buen criterio si la evidencia presentada realmente apoya el argumento del texto.',
                'doing_well_low'      => 'Estás comenzando a preguntarte si los datos del texto son suficientes para justificar lo que el autor dice.',
                'practice_next_high'  => 'Practica con argumentos donde la evidencia es real pero irrelevante para la conclusión.',
                'practice_next_low'   => 'Pregúntate: "¿este dato realmente prueba lo que el autor afirma, o solo suena convincente?"',
                'insight_tip'         => 'La evidencia debe probar exactamente lo que se afirma',
                'insight_tip_body'    => 'Una estadística puede ser verdadera pero no relevante. Verifica siempre que la evidencia responda directamente a la afirmación del autor.',
                'insight_example'     => 'Si un autor dice "los estudiantes que duermen más tienen mejor memoria" y solo cita que "los adultos que duermen más trabajan mejor", la evidencia no prueba lo que afirma sobre estudiantes.',
            ],

            // ── ATTENTION ────────────────────────────────────────────────────────

            'selective_attention' => [
                'description'         => 'La atención selectiva es la habilidad de enfocarte en lo que importa y filtrar las distracciones del entorno.',
                'why_it_matters'      => 'Poder filtrar distracciones te ayuda a concentrarte mejor en clases, leer con comprensión y terminar tareas sin interrupciones.',
                'doing_well_high'     => 'Estás filtrando bien las distracciones y manteniéndote enfocado en los elementos relevantes.',
                'doing_well_low'      => 'Estás aprendiendo a ignorar información irrelevante para enfocarte en lo que importa.',
                'practice_next_high'  => 'Practica con estímulos donde las distracciones son muy similares al objetivo.',
                'practice_next_low'   => 'Antes de empezar, define claramente qué es lo que buscas y mantenlo en mente mientras trabajas.',
                'insight_tip'         => 'Define primero qué es lo que buscas',
                'insight_tip_body'    => 'Saber exactamente qué buscar antes de empezar reduce el esfuerzo de filtrar. Tu cerebro descarta automáticamente lo que no coincide.',
                'insight_example'     => 'Si buscas la palabra "gato" en un texto lleno de animales, tu cerebro ignorará "perro", "pez" y "ave" automáticamente.',
            ],

            'sustained_attention' => [
                'description'         => 'La atención sostenida es la capacidad de mantener el enfoque durante un período largo sin distraerte.',
                'why_it_matters'      => 'Esta habilidad es fundamental para terminar tareas, leer textos largos y concentrarte durante clases o exámenes.',
                'doing_well_high'     => 'Estás manteniendo bien el enfoque durante toda la actividad sin perder el hilo.',
                'doing_well_low'      => 'Estás mejorando en mantener la concentración por períodos cada vez más largos.',
                'practice_next_high'  => 'Practica con actividades más largas o que requieren atención constante sin señales de guía.',
                'practice_next_low'   => 'Divide la tarea en pequeñas partes y descansa brevemente entre ellas para mantener el enfoque.',
                'insight_tip'         => 'Pequeños descansos mejoran la atención',
                'insight_tip_body'    => 'Revisar el progreso cada pocos minutos y darte una pausa breve recarga tu capacidad de atención para mantenerte enfocado más tiempo.',
                'insight_example'     => 'Un estudiante que lee 3 páginas, toma 30 segundos de descanso y luego lee 3 más, retiene más información que uno que intenta leer 6 páginas de corrido.',
            ],

            'visual_discrimination' => [
                'description'         => 'La discriminación visual es la capacidad de notar diferencias y similitudes sutiles entre imágenes, símbolos, letras o palabras parecidas.',
                'why_it_matters'      => 'Es esencial para leer con precisión, hacer operaciones matemáticas y seguir instrucciones visuales en cualquier materia.',
                'doing_well_high'     => 'Estás detectando diferencias visuales sutiles con mucha exactitud.',
                'doing_well_low'      => 'Estás mejorando en identificar las diferencias más obvias entre elementos visuales similares.',
                'practice_next_high'  => 'Practica con conjuntos donde las diferencias son mínimas o se presentan en contextos más complejos.',
                'practice_next_low'   => 'Compara elemento por elemento en lugar de ver el conjunto completo de una sola vez.',
                'insight_tip'         => 'Revisa cada rasgo por separado',
                'insight_tip_body'    => 'En lugar de comparar todo a la vez, enfócate en un rasgo (forma, tamaño, orientación) y compara solo ese antes de pasar al siguiente.',
                'insight_example'     => 'Para distinguir la "b" de la "d", enfócate solo en la dirección del palo: ¿apunta a la derecha o a la izquierda? Eso es suficiente para diferenciarlas.',
            ],

            'impulse_control' => [
                'description'         => 'El control de impulsos es la capacidad de frenar respuestas automáticas e impulsivas y pensar antes de actuar.',
                'why_it_matters'      => 'Ayuda a tomar mejores decisiones, evitar errores por apresuramiento y seguir reglas cuando la respuesta obvia es incorrecta.',
                'doing_well_high'     => 'Estás resistiendo bien las respuestas impulsivas y eligiendo la respuesta correcta aunque no sea la más obvia.',
                'doing_well_low'      => 'Estás aprendiendo a hacer una pausa antes de responder cuando la respuesta obvia podría ser incorrecta.',
                'practice_next_high'  => 'Practica con ejercicios donde la respuesta "trampa" es muy atractiva o intuitiva.',
                'practice_next_low'   => 'Antes de responder, cuenta hasta 3 mentalmente para frenar la respuesta impulsiva.',
                'insight_tip'         => 'La primera respuesta no siempre es la correcta',
                'insight_tip_body'    => 'Tu cerebro sugiere la respuesta más fácil y automática primero. Tómate un segundo para verificar si esa respuesta cumple todas las reglas del problema.',
                'insight_example'     => 'En un ejercicio donde debes decir el color de las letras, tu cerebro querrá leer "ROJO" escrito en azul. Inhibirlo y decir "azul" requiere control de impulsos.',
            ],

            'instruction_following' => [
                'description'         => 'Seguir instrucciones es la habilidad de leer o escuchar pasos en orden y ejecutarlos con precisión, sin saltarse ni cambiar ninguno.',
                'why_it_matters'      => 'Es fundamental en la escuela y en la vida para completar tareas correctamente, evitar errores y trabajar de manera autónoma.',
                'doing_well_high'     => 'Estás siguiendo secuencias de instrucciones largas con mucha exactitud.',
                'doing_well_low'      => 'Estás mejorando en mantenerte fiel a los pasos indicados sin saltarlos ni modificarlos.',
                'practice_next_high'  => 'Practica con instrucciones condicionales ("si... entonces...") que requieren más atención al detalle.',
                'practice_next_low'   => 'Lee todas las instrucciones antes de empezar para tener el mapa completo en mente.',
                'insight_tip'         => 'Lee todo antes de empezar',
                'insight_tip_body'    => 'Las instrucciones a veces tienen pasos al final que cambian los anteriores. Leer todo de una vez evita tener que rehacerlos.',
                'insight_example'     => 'Un examen que dice "lee todas las preguntas antes de contestar" a veces termina con "no respondas ninguna de las anteriores". Quien leyó primero ahorra tiempo.',
            ],

            'filtering_distractions' => [
                'description'         => 'Filtrar distracciones es la habilidad de ignorar activamente estímulos irrelevantes para mantener el foco en la tarea.',
                'why_it_matters'      => 'En un mundo lleno de interrupciones, poder filtrar lo que no importa te permite trabajar más rápido y con mayor calidad.',
                'doing_well_high'     => 'Estás ignorando eficientemente los estímulos irrelevantes y completando las tareas sin perder el hilo.',
                'doing_well_low'      => 'Estás aprendiendo a reconocer y dejar pasar los estímulos que no son relevantes para la tarea.',
                'practice_next_high'  => 'Practica con ejercicios donde las distracciones son dinámicas o cambian de lugar durante la tarea.',
                'practice_next_low'   => 'Antes de empezar, decide conscientemente qué información debes ignorar en esta actividad.',
                'insight_tip'         => 'Decide de antemano qué ignorar',
                'insight_tip_body'    => 'Saber qué distrae antes de empezar te permite "apagar" esa información conscientemente, en lugar de luchar contra ella durante la tarea.',
                'insight_example'     => 'Si practicas con música de fondo, decides deliberadamente "el sonido no cuenta". Eso activa tu filtro mental y hace más fácil no prestarle atención.',
            ],

            'speed_accuracy' => [
                'description'         => 'Velocidad con precisión es la habilidad de procesar información y responder correctamente en el menor tiempo posible.',
                'why_it_matters'      => 'Una mayor velocidad de procesamiento te permite completar tareas con más eficiencia y con menos esfuerzo mental.',
                'doing_well_high'     => 'Estás respondiendo con rapidez y precisión en los ejercicios de velocidad.',
                'doing_well_low'      => 'Estás mejorando tu velocidad de respuesta mientras mantienes la precisión.',
                'practice_next_high'  => 'Reduce el tiempo límite de los ejercicios para seguir desafiando tu velocidad.',
                'practice_next_low'   => 'Practica primero despacio y con precisión; la velocidad mejora naturalmente con la práctica.',
                'insight_tip'         => 'Precisión primero, velocidad después',
                'insight_tip_body'    => 'Intentar responder muy rápido antes de estar seguro aumenta los errores. La velocidad sube sola cuando los patrones se vuelven automáticos.',
                'insight_example'     => 'Un pianista empieza tocando despacio hasta que sus dedos memorizan los movimientos. Solo entonces acelera sin perder las notas. Lo mismo aplica a tu velocidad mental.',
            ],

            'response_control' => [
                'description'         => 'El control de respuesta es la habilidad de ajustar y modular tus reacciones según el contexto, respondiendo de forma apropiada a cada situación.',
                'why_it_matters'      => 'Te ayuda a evitar errores por reaccionar sin pensar y a adaptar tu comportamiento cuando las reglas o el contexto cambian.',
                'doing_well_high'     => 'Estás ajustando tus respuestas correctamente cuando el contexto o las instrucciones cambian.',
                'doing_well_low'      => 'Estás aprendiendo a verificar si tu respuesta encaja bien con el contexto antes de darla.',
                'practice_next_high'  => 'Practica con situaciones donde las reglas cambian de manera inesperada a mitad del ejercicio.',
                'practice_next_low'   => 'Antes de responder, pregúntate: "¿esta es la respuesta correcta para lo que se está pidiendo ahora?"',
                'insight_tip'         => 'Pon a prueba tu respuesta antes de darla',
                'insight_tip_body'    => 'Una buena respuesta cumple exactamente lo que se pide en ese momento. Revisar un segundo antes evita respuestas correctas en el contexto equivocado.',
                'insight_example'     => 'Si en un juego debes presionar el botón cuando aparece un círculo verde, pero la regla cambia a "solo círculos azules", una respuesta a un círculo verde ya no cuenta.',
            ],

            // ── REASONING ────────────────────────────────────────────────────────

            'classification' => [
                'description'         => 'La clasificación es la habilidad de organizar elementos en grupos según sus características comunes.',
                'why_it_matters'      => 'Clasificar información te ayuda a organizar el conocimiento, encontrar patrones y aprender más rápido en todas las materias.',
                'doing_well_high'     => 'Estás organizando elementos correctamente en categorías, incluso cuando las características no son obvias.',
                'doing_well_low'      => 'Estás identificando los grupos más evidentes y practicando con categorías más complejas.',
                'practice_next_high'  => 'Practica con elementos que podrían pertenecer a más de una categoría y debes elegir la más precisa.',
                'practice_next_low'   => 'Busca un rasgo clave que todos los miembros de un grupo comparten y úsalo como criterio de clasificación.',
                'insight_tip'         => 'Busca el rasgo que tienen todos en común',
                'insight_tip_body'    => 'Un grupo válido tiene al menos un rasgo que todos sus miembros comparten y que los diferencia de los demás grupos.',
                'insight_example'     => 'Manzana, pera y uva son frutas porque todas crecen en plantas y contienen semillas. El tomate también, aunque a veces lo clasificamos como verdura en la cocina.',
            ],

            'analogies' => [
                'description'         => 'Las analogías son comparaciones que muestran cómo dos pares de conceptos se relacionan de la misma manera: "A es a B como C es a D".',
                'why_it_matters'      => 'Te ayuda a transferir conocimiento aprendido en un contexto a situaciones nuevas y a entender conceptos complejos por comparación.',
                'doing_well_high'     => 'Estás identificando y aplicando relaciones analógicas en pares de conceptos complejos.',
                'doing_well_low'      => 'Estás comenzando a ver las relaciones que conectan los pares de una analogía.',
                'practice_next_high'  => 'Practica con analogías donde hay varias relaciones posibles para elegir la más precisa.',
                'practice_next_low'   => 'Primero define con una oración la relación entre el primer par; luego aplica la misma relación al segundo.',
                'insight_tip'         => 'Nombra la relación del primer par primero',
                'insight_tip_body'    => 'Identifica exactamente cómo se relacionan A y B: ¿es parte-todo, sinónimo, causa-efecto? Luego aplica esa misma relación para encontrar D.',
                'insight_example'     => '"Cuchillo es a cortar como pincel es a pintar." La relación es herramienta→acción. Si sabes eso, resolver "rueda es a girar como ala es a ___" es mucho más fácil.',
            ],

            'patterns' => [
                'description'         => 'El reconocimiento de patrones es la capacidad de identificar reglas o tendencias repetidas en una serie de elementos.',
                'why_it_matters'      => 'Esta habilidad está en la base de las matemáticas, la ciencia y la resolución de problemas, ayudándote a predecir y generalizar.',
                'doing_well_high'     => 'Estás detectando patrones complejos y aplicando las reglas identificadas con precisión.',
                'doing_well_low'      => 'Estás comenzando a encontrar los patrones más simples y repetitivos.',
                'practice_next_high'  => 'Practica con patrones que combinan más de una dimensión (forma, color, tamaño).',
                'practice_next_low'   => 'Busca qué cambia y qué se mantiene igual entre los elementos de la serie.',
                'insight_tip'         => 'Compara elementos adyacentes primero',
                'insight_tip_body'    => 'La regla más simple casi siempre se ve comparando el primer y segundo elemento. Si la encontraste, compruébala con el tercero antes de continuar.',
                'insight_example'     => 'En la serie 2, 4, 8, 16... comparas 2→4 (×2) y 4→8 (×2), confirmas la regla y predices que el siguiente es 32.',
            ],

            'cause_effect' => [
                'description'         => 'Causa y efecto es la relación entre un evento que ocurre (causa) y lo que pasa como consecuencia (efecto).',
                'why_it_matters'      => 'Entender causas y efectos te ayuda a predecir resultados y a razonar sobre por qué las cosas suceden como suceden.',
                'doing_well_high'     => 'Estás trazando bien la cadena de causas y efectos, incluso cuando hay múltiples niveles.',
                'doing_well_low'      => 'Estás identificando algunas relaciones causa-efecto cuando las señales son claras.',
                'practice_next_high'  => 'Practica con textos que tienen causas múltiples para un solo efecto.',
                'practice_next_low'   => 'Busca palabras clave como "porque", "por lo tanto", "como resultado" para detectar las relaciones.',
                'insight_tip'         => 'Pregúntate: ¿qué provocó esto?',
                'insight_tip_body'    => 'Para cada evento, pregúntate "¿por qué pasó?" — eso es la causa. Luego pregúntate "¿qué pasó después?" — eso es el efecto.',
                'insight_example'     => 'La ciudad no tenía agua limpia (causa). Por lo tanto, muchas personas enfermaron (efecto) y los científicos decidieron construir un filtro (nuevo efecto).',
            ],

            'deductive_logic' => [
                'description'         => 'La lógica deductiva es ir de premisas generales a conclusiones específicas: si las premisas son verdaderas, la conclusión debe serlo también.',
                'why_it_matters'      => 'Es la base del razonamiento formal, las matemáticas y el pensamiento científico. Te ayuda a sacar conclusiones necesarias y verificables.',
                'doing_well_high'     => 'Estás aplicando correctamente premisas generales para llegar a conclusiones específicas.',
                'doing_well_low'      => 'Estás aprendiendo a seguir la cadena lógica de premisa a conclusión.',
                'practice_next_high'  => 'Practica con argumentos donde algunas premisas son falsas para identificar conclusiones inválidas.',
                'practice_next_low'   => 'Reformula el argumento como "Si A, y B, entonces..." para ver la estructura lógica con claridad.',
                'insight_tip'         => 'Sigue la cadena: si esto y esto, entonces aquello',
                'insight_tip_body'    => 'La lógica deductiva es como una cadena. Si cada eslabón (premisa) es verdadero, la conclusión al final también tiene que serlo.',
                'insight_example'     => '"Todos los mamíferos tienen huesos. Los perros son mamíferos. Por lo tanto, los perros tienen huesos." Esta es la estructura completa de la lógica deductiva.',
            ],

            'argument_analysis' => [
                'description'         => 'El análisis de argumentos es la capacidad de evaluar si un argumento está bien construido: si las razones apoyan la conclusión y si la evidencia es suficiente.',
                'why_it_matters'      => 'Te protege de ser convencido por argumentos débiles, te ayuda a construir mejores razonamientos y a comunicarte con más claridad.',
                'doing_well_high'     => 'Estás identificando la estructura de los argumentos y evaluando su solidez con criterios precisos.',
                'doing_well_low'      => 'Estás comenzando a preguntarte si las razones de un argumento realmente justifican su conclusión.',
                'practice_next_high'  => 'Practica con argumentos que contienen falacias lógicas sutiles.',
                'practice_next_low'   => 'Ante cualquier argumento, pregúntate: "¿la razón que da realmente apoya lo que concluye?"',
                'insight_tip'         => 'Separa la conclusión de las razones',
                'insight_tip_body'    => 'Un buen argumento tiene una conclusión clara y razones que la apoyan directamente. Si las razones no están conectadas a la conclusión, el argumento es débil.',
                'insight_example'     => '"Deberías comer este cereal porque tiene un atleta en la caja." La razón (atleta en la caja) no tiene conexión lógica con la conclusión (deberías comerlo). Argumento débil.',
            ],

            'problem_solving' => [
                'description'         => 'La resolución de problemas es la habilidad de identificar un obstáculo, planificar pasos y ejecutarlos para llegar a una solución.',
                'why_it_matters'      => 'Es una de las habilidades más valoradas en la vida y el trabajo. Te prepara para enfrentar desafíos nuevos con confianza y creatividad.',
                'doing_well_high'     => 'Estás planificando y ejecutando soluciones en varias etapas con muy buenos resultados.',
                'doing_well_low'      => 'Estás progresando en descomponer problemas en pasos más manejables.',
                'practice_next_high'  => 'Practica con problemas abiertos que tienen más de una solución válida.',
                'practice_next_low'   => 'Antes de resolver, escribe qué sabes, qué necesitas saber y qué podrías intentar.',
                'insight_tip'         => 'Divide el problema en partes más pequeñas',
                'insight_tip_body'    => 'Un problema grande tiene partes más pequeñas y manejables. Resuelve una a la vez en lugar de intentar verlo todo de una vez.',
                'insight_example'     => 'Si el problema es "organizar una fiesta", divídelo en: invitaciones, comida, lugar y decoración. Resolver cada parte por separado hace el total mucho más manejable.',
            ],

            'decision_making' => [
                'description'         => 'La toma de decisiones es el proceso de evaluar opciones disponibles y elegir la más adecuada según un objetivo o criterio claro.',
                'why_it_matters'      => 'Tomar buenas decisiones te ayuda a resolver problemas más rápido, evitar errores costosos y sentirte más seguro ante situaciones nuevas.',
                'doing_well_high'     => 'Estás evaluando las opciones con criterios claros y eligiendo la más adecuada con consistencia.',
                'doing_well_low'      => 'Estás aprendiendo a identificar los factores más importantes antes de tomar una decisión.',
                'practice_next_high'  => 'Practica con decisiones donde el criterio más importante no es el más obvio.',
                'practice_next_low'   => 'Antes de decidir, lista las ventajas y desventajas de cada opción.',
                'insight_tip'         => 'Define el criterio más importante antes de elegir',
                'insight_tip_body'    => 'Saber cuál es el factor más relevante para tu objetivo te ayuda a eliminar opciones rápidamente y a elegir con más seguridad.',
                'insight_example'     => 'Si debes elegir entre dos rutas al colegio y llegarte a tiempo es lo más importante, la distancia importa menos que el tráfico. El criterio correcto cambia la decisión.',
            ],

            'evidence_selection' => [
                'description'         => 'La selección de evidencia es la habilidad de elegir los datos o ejemplos más relevantes y sólidos para apoyar una afirmación.',
                'why_it_matters'      => 'Te ayuda a construir argumentos más convincentes, a responder preguntas con precisión y a escribir mejor en todas las materias.',
                'doing_well_high'     => 'Estás seleccionando evidencia que es relevante, específica y directamente relacionada con la afirmación.',
                'doing_well_low'      => 'Estás aprendiendo a distinguir entre evidencia fuerte y evidencia que solo suena convincente.',
                'practice_next_high'  => 'Practica con conjuntos de evidencia donde varias opciones son plausibles pero solo una es la más sólida.',
                'practice_next_low'   => 'Pregúntate: "¿este dato prueba exactamente lo que quiero decir, o solo está relacionado con el tema?"',
                'insight_tip'         => 'La mejor evidencia es específica y directa',
                'insight_tip_body'    => 'La evidencia genérica o indirecta debilita un argumento. Busca datos, ejemplos o citas que prueben exactamente tu afirmación, no solo que estén en el mismo tema.',
                'insight_example'     => 'Para argumentar que "leer mejora la comprensión", citar un estudio con resultados medidos es mejor que decir "mucha gente inteligente lee". El primero es evidencia directa; el segundo, una generalización.',
            ],
        ];

        // Resolve skill IDs by name slug (the `name` column is the slug)
        $skillIds = Skill::pluck('id', 'name'); // ['reading_comprehension' => uuid, ...]

        foreach ($contents as $skillName => $data) {
            $skillId = $skillIds[$skillName] ?? null;
            if (!$skillId) {
                $this->command?->warn("Skill not found: {$skillName} — skipping.");
                continue;
            }

            SkillContent::updateOrCreate(
                ['skill_id' => $skillId],
                $data
            );
        }
    }
}