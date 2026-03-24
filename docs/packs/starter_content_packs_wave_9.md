# Starter Content Packs — Wave 9

This continues the content production run with the next 3 premium packs:
- Grade 2 → `g2_bus_stop_morning`
- Grades 3–4 → `g34_park_cleanup`
- Grades 5–6 → `g56_science_fair_article`

Each pack follows the same structure:
- linked activities
- reusable passage/scene family
- mission framing
- seed-friendly JSON in your current backend shape

---

# Pack 25 — Grade 2

## Pack Code
`g2_bus_stop_morning`

## Curriculum Unit
`early_reading_basics`

## Domain
`reading`

## Primary Skills
- `sequencing`
- `supporting_details`
- `main_idea`

## Secondary Skills
- `instruction_following`
- `selective_attention`

## Theme
A child gets ready at the bus stop in the morning and follows simple steps safely.

## Tone
Familiar, routine-based, practical.

## Core Story
Eva gets her backpack, waits with an adult, watches for the bus, and gets on when it arrives.

## Activity Family

### 1. Storybook reading
- Skill: `main_idea`
- Type: `storybook_reading`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Acompaña a Eva a la parada del autobús",
  "mission_description": "Lee la historia y descubre lo más importante que hace Eva en la mañana.",
  "instructions_es": "Lee las páginas y responde la pregunta.",
  "content": {
    "pages": [
      {
        "id": "p1",
        "title": "Lista para salir",
        "text": "Eva se puso su mochila y caminó con su mamá hasta la parada del autobús.",
        "image_prompt": "child with backpack walking with mother to school bus stop in morning"
      },
      {
        "id": "p2",
        "title": "Esperan con cuidado",
        "text": "Esperaron juntos, vieron llegar el autobús y Eva subió cuando se detuvo por completo.",
        "image_prompt": "school bus arriving at stop with child waiting safely beside adult"
      }
    ],
    "question": {
      "prompt": "¿Cuál es la idea principal de la historia?",
      "options": [
        { "id": "a", "text": "Eva sigue una rutina segura para tomar el autobús escolar.", "image_url": null },
        { "id": "b", "text": "Eva corre detrás del autobús todos los días.", "image_url": null },
        { "id": "c", "text": "El autobús nunca llega a la parada.", "image_url": null }
      ]
    }
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 2. Tap sequence — order the morning routine
- Skill: `sequencing`
- Type: `tap_sequence`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Ordena la rutina de Eva",
  "mission_description": "Toca los pasos en el orden correcto.",
  "instructions_es": "Toca lo que pasa primero, después y al final.",
  "content": {
    "items": [
      { "id": "item_1", "text": "Eva se pone la mochila" },
      { "id": "item_2", "text": "Espera en la parada" },
      { "id": "item_3", "text": "Sube al autobús" }
    ],
    "instructions": "Toca los pasos en el orden correcto.",
    "time_limit_seconds": 25
  },
  "correct_answer": {
    "sequence": ["item_1", "item_2", "item_3"]
  }
}
```

### 3. Multiple choice — supporting details
- Skill: `supporting_details`
- Type: `multiple_choice`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "friendly_challenge",
  "mission_title": "Encuentra la pista importante",
  "mission_description": "Escoge el detalle que apoya la idea principal.",
  "instructions_es": "Lee y escoge el detalle correcto.",
  "content": {
    "passage": "Eva esperó con su mamá y subió al autobús cuando este se detuvo por completo.",
    "question": "¿Qué detalle muestra que Eva actuó con seguridad?",
    "options": [
      { "id": "a", "text": "Subió cuando el autobús se detuvo por completo.", "image_url": null },
      { "id": "b", "text": "Llevaba mochila nueva.", "image_url": null },
      { "id": "c", "text": "El cielo estaba claro.", "image_url": null },
      { "id": "d", "text": "Había otras personas cerca.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 4. Multiple choice — instruction following
- Skill: `instruction_following`
- Type: `multiple_choice`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Sigue la instrucción correcta",
  "mission_description": "Lee con cuidado antes de responder.",
  "instructions_es": "Lee toda la instrucción antes de responder.",
  "content": {
    "passage": "Si el autobús aún se mueve, espera. Si el autobús está detenido y la puerta está abierta, puedes subir.",
    "question": "¿Qué haces si el autobús está detenido y la puerta está abierta?",
    "options": [
      { "id": "a", "text": "Subo con cuidado.", "image_url": null },
      { "id": "b", "text": "Corro al otro lado de la calle.", "image_url": null },
      { "id": "c", "text": "Me siento en la acera.", "image_url": null },
      { "id": "d", "text": "Empujo la puerta sin mirar.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Pack 26 — Grades 3–4

## Pack Code
`g34_park_cleanup`

## Curriculum Unit
`middle_reading_interpretation`

## Domain
`reading`

## Primary Skills
- `main_idea`
- `cause_effect`
- `summarization`

## Secondary Skills
- `supporting_details`
- `decision_making`

## Theme
Students and neighbors clean a park and observe how it changes afterward.

## Tone
Community-based, practical, civic.

## Core Story
A cleanup team picks up litter, separates waste, and notices the park becomes safer and cleaner for everyone.

## Activity Family

### 1. Illustrated clue reading — main idea
- Skill: `main_idea`
- Type: `illustrated_clue`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Descubre la idea principal de la jornada",
  "mission_description": "Lee el texto y encuentra la idea más importante.",
  "instructions_es": "Lee y escoge la idea principal.",
  "content": {
    "image_prompt": "children and neighbors cleaning a community park with bags and gloves",
    "passage": "Un grupo de estudiantes y vecinos recogió basura del parque, separó plásticos y papeles, y dejó los caminos más limpios. Después, más personas pudieron usar el parque con comodidad.",
    "question": "¿Cuál es la idea principal del texto?",
    "options": [
      { "id": "a", "text": "La jornada de limpieza mejoró el parque para la comunidad.", "image_url": null },
      { "id": "b", "text": "El parque quedó cerrado todo el día.", "image_url": null },
      { "id": "c", "text": "Nadie quiso ayudar en la actividad.", "image_url": null },
      { "id": "d", "text": "Los caminos del parque cambiaron de color.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 2. Multiple choice — cause and effect
- Skill: `cause_effect`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "science_explore",
  "mission_title": "Piensa en lo que pasó después",
  "mission_description": "Escoge el mejor efecto de la jornada.",
  "instructions_es": "Escoge el efecto correcto.",
  "content": {
    "passage": "Los voluntarios recogieron basura, apartaron materiales reciclables y limpiaron los caminos del parque.",
    "question": "¿Cuál fue un efecto de esas acciones?",
    "options": [
      { "id": "a", "text": "El parque quedó más limpio y cómodo para usar.", "image_url": null },
      { "id": "b", "text": "Los árboles desaparecieron del parque.", "image_url": null },
      { "id": "c", "text": "La basura volvió sola a los caminos.", "image_url": null },
      { "id": "d", "text": "El parque se convirtió en biblioteca.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 3. Multiple choice — summarization
- Skill: `summarization`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "friendly_challenge",
  "mission_title": "Resume lo más importante",
  "mission_description": "Escoge el resumen que mejor cuenta lo ocurrido.",
  "instructions_es": "Lee y escoge el mejor resumen.",
  "content": {
    "passage": "Durante la jornada, estudiantes y vecinos limpiaron el parque, separaron residuos y ayudaron a dejar el espacio listo para que la comunidad lo disfrutara mejor.",
    "question": "¿Cuál es el mejor resumen?",
    "options": [
      { "id": "a", "text": "La comunidad limpió el parque y mejoró el espacio para todos.", "image_url": null },
      { "id": "b", "text": "El parque estaba vacío y nadie fue.", "image_url": null },
      { "id": "c", "text": "Solo se pintaron los bancos del parque.", "image_url": null },
      { "id": "d", "text": "La actividad ocurrió en una playa lejana.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 4. Multiple choice — decision making
- Skill: `decision_making`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Escoge la mejor decisión",
  "mission_description": "Piensa qué harías para ayudar en la actividad.",
  "instructions_es": "Escoge la mejor decisión.",
  "content": {
    "passage": "Ves una botella plástica en el césped durante la jornada de limpieza y un recipiente de reciclaje está cerca.",
    "question": "¿Qué sería mejor hacer?",
    "options": [
      { "id": "a", "text": "Recoger la botella y ponerla en el recipiente correcto.", "image_url": null },
      { "id": "b", "text": "Patearla hacia los arbustos.", "image_url": null },
      { "id": "c", "text": "Dejarla en el suelo y seguir caminando.", "image_url": null },
      { "id": "d", "text": "Lanzarla al aire para ver qué pasa.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Pack 27 — Grades 5–6

## Pack Code
`g56_science_fair_article`

## Curriculum Unit
`upper_advanced_reading`

## Domain
`reading`

## Primary Skills
- `identifying_purpose`
- `evaluating_evidence`
- `compare_contrast`

## Secondary Skills
- `fact_vs_opinion`
- `summarization`

## Theme
An article covers a school science fair, comparing projects and how winners were chosen.

## Tone
Informative, academic, evidence-focused.

## Core Passage Family
The article describes projects on water filtration, plant growth, and solar energy, explaining what evidence judges used.

## Activity Family

### 1. Illustrated article reading — identifying purpose
- Skill: `identifying_purpose`
- Type: `illustrated_clue`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "science_explore",
  "mission_title": "Lee el artículo de la feria de ciencias",
  "mission_description": "Descubre para qué fue escrito el texto.",
  "instructions_es": "Lee y escoge el propósito principal.",
  "content": {
    "image_prompt": "school science fair with student project boards on water filtration plant growth and solar energy",
    "passage": "El artículo presenta los proyectos más destacados de la feria de ciencias escolar, explica qué investigó cada equipo y describe cómo los jueces eligieron a los ganadores según sus pruebas y resultados.",
    "question": "¿Cuál es el propósito principal del texto?",
    "options": [
      { "id": "a", "text": "Informar sobre la feria y cómo se evaluaron los proyectos.", "image_url": null },
      { "id": "b", "text": "Inventar una historia fantástica sobre robots escolares.", "image_url": null },
      { "id": "c", "text": "Convencer a todos de no participar nunca en proyectos.", "image_url": null },
      { "id": "d", "text": "Burlarse de los estudiantes que hicieron experimentos.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 2. Multiple choice — evaluating evidence
- Skill: `evaluating_evidence`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Escoge la afirmación mejor respaldada",
  "mission_description": "Piensa qué idea tiene mejor apoyo en el texto.",
  "instructions_es": "Escoge la afirmación mejor respaldada por el texto.",
  "content": {
    "passage": "Los jueces revisaron tablas de resultados, compararon pruebas repetidas y escucharon las explicaciones de cada equipo antes de elegir a los ganadores.",
    "question": "¿Qué afirmación está mejor respaldada?",
    "options": [
      { "id": "a", "text": "Los jueces tomaron en cuenta evidencia y explicaciones antes de decidir.", "image_url": null },
      { "id": "b", "text": "Los ganadores se eligieron al azar sin mirar nada.", "image_url": null },
      { "id": "c", "text": "Las tablas de resultados no sirvieron para nada.", "image_url": null },
      { "id": "d", "text": "Solo un proyecto participó en toda la feria.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 3. Multiple choice — compare and contrast
- Skill: `compare_contrast`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Compara dos proyectos",
  "mission_description": "Observa cómo se parecen y se diferencian dos investigaciones.",
  "instructions_es": "Escoge la mejor comparación.",
  "content": {
    "passage": "Un equipo estudió cómo limpiar agua con filtros caseros. Otro observó cómo diferentes cantidades de luz afectan el crecimiento de las plantas. Ambos equipos hicieron pruebas y registraron resultados.",
    "question": "¿Cuál es la mejor comparación?",
    "options": [
      { "id": "a", "text": "Los proyectos investigaron temas distintos, pero ambos usaron pruebas y registros de resultados.", "image_url": null },
      { "id": "b", "text": "Los dos proyectos trataron exactamente la misma pregunta.", "image_url": null },
      { "id": "c", "text": "Ninguno de los dos usó observaciones.", "image_url": null },
      { "id": "d", "text": "Ambos proyectos eran solo opiniones sin experimentos.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 4. Multiple choice — fact vs opinion
- Skill: `fact_vs_opinion`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "friendly_challenge",
  "mission_title": "Distingue hechos de opiniones",
  "mission_description": "Encuentra la afirmación verificable.",
  "instructions_es": "Escoge cuál afirmación es un hecho.",
  "content": {
    "passage": null,
    "question": "¿Cuál afirmación es un hecho?",
    "options": [
      { "id": "a", "text": "La feria de ciencias fue la actividad más emocionante del universo.", "image_url": null },
      { "id": "b", "text": "Los jueces revisaron tablas de resultados antes de elegir a los ganadores.", "image_url": null },
      { "id": "c", "text": "Todos los proyectos fueron perfectos y maravillosos.", "image_url": null },
      { "id": "d", "text": "La mejor investigación siempre es la más bonita.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "b"
  }
}
```

---

# Running Totals After Wave 9

With Waves 1–9, the draft set now covers:
- 9 Grade 2 packs
- 9 Grades 3–4 packs
- 9 Grades 5–6 packs

That gives you 27 premium packs in progress across the three main grade bands.

## Next recommended packs
- Grade 2 → `g2_rain_after_school`
- Grades 3–4 → `g34_butterfly_garden`
- Grades 5–6 → `g56_city_trees_report`
