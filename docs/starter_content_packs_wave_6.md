# Starter Content Packs — Wave 6

This continues the content production run with the next 3 premium packs:
- Grade 2 → `g2_garden_helpers`
- Grades 3–4 → `g34_maps_and_neighborhoods`
- Grades 5–6 → `g56_school_energy_project`

Each pack follows the same structure:
- linked activities
- reusable passage/scene family
- mission framing
- seed-friendly JSON in your current backend shape

---

# Pack 16 — Grade 2

## Pack Code
`g2_garden_helpers`

## Curriculum Unit
`early_reading_basics`

## Domain
`reading`

## Primary Skills
- `supporting_details`
- `classification`
- `sequencing`

## Secondary Skills
- `main_idea`
- `cause_effect`

## Theme
A class works together to help in the school garden.

## Tone
Warm, cooperative, simple and visual.

## Core Story
The class waters plants, pulls weeds, and places tools away after helping in the garden.

## Activity Family

### 1. Storybook reading
- Skill: `main_idea`
- Type: `storybook_reading`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Descubre cómo la clase ayuda en el jardín",
  "mission_description": "Lee la historia y piensa en lo más importante que hizo la clase.",
  "instructions_es": "Lee las páginas y responde la pregunta.",
  "content": {
    "pages": [
      {
        "id": "p1",
        "title": "Hora de ayudar",
        "text": "La maestra llevó a la clase al jardín. Algunos niños llevaron regaderas y otros miraron las plantas con atención.",
        "image_prompt": "children in a school garden with watering cans and plants"
      },
      {
        "id": "p2",
        "title": "Trabajo en equipo",
        "text": "Unos regaron, otros quitaron hierbas y al final todos guardaron las herramientas en su lugar.",
        "image_prompt": "children working together in school garden and putting tools away"
      }
    ],
    "question": {
      "prompt": "¿Cuál es la idea principal de la historia?",
      "options": [
        { "id": "a", "text": "La clase trabajó junta para cuidar el jardín.", "image_url": null },
        { "id": "b", "text": "Las herramientas se perdieron en el jardín.", "image_url": null },
        { "id": "c", "text": "Nadie quiso ayudar a la maestra.", "image_url": null }
      ]
    }
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 2. Multiple choice — supporting details
- Skill: `supporting_details`
- Type: `multiple_choice`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "friendly_challenge",
  "mission_title": "Busca el detalle que apoya la idea",
  "mission_description": "Escoge la pista que muestra cómo ayudó la clase.",
  "instructions_es": "Lee y escoge el detalle correcto.",
  "content": {
    "passage": "Los niños regaron las plantas, quitaron hierbas y guardaron las herramientas al terminar.",
    "question": "¿Qué detalle apoya que la clase cuidó el jardín?",
    "options": [
      { "id": "a", "text": "Regaron las plantas.", "image_url": null },
      { "id": "b", "text": "El cielo era azul.", "image_url": null },
      { "id": "c", "text": "La escuela tiene un pasillo.", "image_url": null },
      { "id": "d", "text": "Había una campana en el aula.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 3. Drag to sort — helper or tool
- Skill: `classification`
- Type: `drag_to_sort`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "puzzle",
  "mission_title": "Clasifica quién ayuda y qué se usa",
  "mission_description": "Arrastra cada tarjeta al grupo correcto.",
  "instructions_es": "Arrastra al grupo correcto.",
  "content": {
    "items": [
      { "id": "item_1", "text": "Niño regando", "image_url": null },
      { "id": "item_2", "text": "Regadera", "image_url": null },
      { "id": "item_3", "text": "Niña quitando hierbas", "image_url": null },
      { "id": "item_4", "text": "Pala pequeña", "image_url": null }
    ],
    "zones": [
      { "id": "zone_a", "label": "Ayudante" },
      { "id": "zone_b", "label": "Herramienta" }
    ],
    "instructions": "Pon cada tarjeta en ayudante o herramienta."
  },
  "correct_answer": {
    "zones": {
      "zone_a": ["item_1", "item_3"],
      "zone_b": ["item_2", "item_4"]
    }
  }
}
```

### 4. Tap sequence — order the garden work
- Skill: `sequencing`
- Type: `tap_sequence`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Ordena el trabajo del jardín",
  "mission_description": "Toca los pasos en el orden correcto.",
  "instructions_es": "Toca lo que pasó primero, después y al final.",
  "content": {
    "items": [
      { "id": "item_1", "text": "La clase llevó herramientas al jardín" },
      { "id": "item_2", "text": "Regaron y quitaron hierbas" },
      { "id": "item_3", "text": "Guardaron todo en su lugar" }
    ],
    "instructions": "Toca los pasos en el orden correcto.",
    "time_limit_seconds": 25
  },
  "correct_answer": {
    "sequence": ["item_1", "item_2", "item_3"]
  }
}
```

---

# Pack 17 — Grades 3–4

## Pack Code
`g34_maps_and_neighborhoods`

## Curriculum Unit
`middle_reading_interpretation`

## Domain
`reading`

## Primary Skills
- `context_clues`
- `compare_contrast`
- `supporting_details`

## Secondary Skills
- `decision_making`
- `sequencing`

## Theme
Students learn how maps help them understand their neighborhood and compare locations.

## Tone
Practical, community-based, exploratory.

## Core Story
A class uses a map to find the park, the library, and the clinic, and discusses how each place is used.

## Activity Family

### 1. Illustrated clue reading — compare and contrast
- Skill: `compare_contrast`
- Type: `illustrated_clue`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Compara lugares del vecindario",
  "mission_description": "Mira el mapa y lee el texto para comparar dos lugares.",
  "instructions_es": "Lee y escoge la mejor comparación.",
  "content": {
    "image_prompt": "simple neighborhood map with park, library, clinic and school",
    "passage": "En el mapa, el parque tiene árboles y espacio para jugar. La biblioteca es un lugar tranquilo para leer. Ambos lugares son importantes para la comunidad.",
    "question": "¿Cuál es la mejor comparación?",
    "options": [
      { "id": "a", "text": "El parque sirve para jugar y la biblioteca para leer, pero ambos ayudan a la comunidad.", "image_url": null },
      { "id": "b", "text": "El parque y la biblioteca son exactamente iguales.", "image_url": null },
      { "id": "c", "text": "La biblioteca tiene columpios y árboles grandes.", "image_url": null },
      { "id": "d", "text": "El parque siempre está dentro de la escuela.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 2. Multiple choice — context clues
- Skill: `context_clues`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "friendly_challenge",
  "mission_title": "Usa las pistas del texto",
  "mission_description": "Escoge el significado correcto usando las pistas de la oración.",
  "instructions_es": "Lee y usa las pistas del contexto.",
  "content": {
    "passage": "La clínica atiende a personas enfermas o heridas y las ayuda a recuperarse.",
    "question": "¿Qué significa 'atiende' en este texto?",
    "options": [
      { "id": "a", "text": "Cuida o ayuda", "image_url": null },
      { "id": "b", "text": "Dibuja mapas", "image_url": null },
      { "id": "c", "text": "Cierra puertas", "image_url": null },
      { "id": "d", "text": "Juega fútbol", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 3. Multiple choice — supporting details
- Skill: `supporting_details`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Encuentra el detalle importante",
  "mission_description": "Escoge la pista que apoya mejor la idea del texto.",
  "instructions_es": "Escoge el detalle que mejor apoya la idea principal.",
  "content": {
    "passage": "El mapa mostró que la biblioteca queda frente al parque y cerca de la escuela.",
    "question": "¿Qué detalle ayuda a encontrar la biblioteca?",
    "options": [
      { "id": "a", "text": "Está frente al parque y cerca de la escuela.", "image_url": null },
      { "id": "b", "text": "Tiene libros en los estantes.", "image_url": null },
      { "id": "c", "text": "Algunas personas leen allí.", "image_url": null },
      { "id": "d", "text": "Los mapas usan colores.", "image_url": null }
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
  "lesson_mood": "mission",
  "mission_title": "Escoge la mejor ruta",
  "mission_description": "Piensa qué harías con la información del mapa.",
  "instructions_es": "Escoge la mejor decisión según el mapa.",
  "content": {
    "passage": "La clase sale de la escuela y quiere ir al parque primero. La biblioteca queda justo frente al parque.",
    "question": "Si quieren visitar ambos lugares, ¿qué decisión es más práctica?",
    "options": [
      { "id": "a", "text": "Ir al parque y luego cruzar a la biblioteca.", "image_url": null },
      { "id": "b", "text": "Ir a un lugar que no aparece en el mapa.", "image_url": null },
      { "id": "c", "text": "Ignorar el mapa por completo.", "image_url": null },
      { "id": "d", "text": "Volver a casa sin visitar nada.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Pack 18 — Grades 5–6

## Pack Code
`g56_school_energy_project`

## Curriculum Unit
`upper_advanced_reading`

## Domain
`reading`

## Primary Skills
- `evaluating_evidence`
- `problem_solving`
- `compare_contrast`

## Secondary Skills
- `identifying_purpose`
- `inference`

## Theme
A school reviews its energy use and launches a project to reduce waste.

## Tone
Informative, practical, school-based, evidence-driven.

## Core Passage Family
Students and teachers compare energy use before and after changes such as switching off lights and using fans more efficiently.

## Activity Family

### 1. Illustrated article reading — evaluating evidence
- Skill: `evaluating_evidence`
- Type: `illustrated_clue`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "science_explore",
  "mission_title": "Analiza el proyecto de energía",
  "mission_description": "Lee la información y decide qué conclusión está mejor respaldada.",
  "instructions_es": "Escoge la conclusión mejor respaldada por el texto.",
  "content": {
    "image_prompt": "school classrooms with posters about saving energy and students turning off lights",
    "passage": "Durante dos meses, la escuela revisó su consumo de energía. Después de apagar luces vacías, revisar abanicos y cambiar algunos focos, el reporte mostró menos uso eléctrico en varias áreas.",
    "question": "¿Qué conclusión está mejor respaldada?",
    "options": [
      { "id": "a", "text": "Las acciones de ahorro pudieron reducir parte del consumo de energía.", "image_url": null },
      { "id": "b", "text": "La escuela dejó de necesitar electricidad por completo.", "image_url": null },
      { "id": "c", "text": "Los reportes demostraron que gastar más energía era mejor.", "image_url": null },
      { "id": "d", "text": "Nada cambió en ninguna parte de la escuela.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 2. Multiple choice — problem solving
- Skill: `problem_solving`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Piensa en la mejor solución",
  "mission_description": "Escoge la opción que ayuda más al proyecto.",
  "instructions_es": "Escoge la mejor solución para el problema.",
  "content": {
    "passage": "La escuela notó que muchas luces quedan encendidas en salones vacíos durante el recreo.",
    "question": "¿Qué solución sería más útil?",
    "options": [
      { "id": "a", "text": "Crear recordatorios y asignar revisión rápida antes del recreo.", "image_url": null },
      { "id": "b", "text": "Encender todavía más luces para compensar.", "image_url": null },
      { "id": "c", "text": "Ignorar el problema durante todo el año.", "image_url": null },
      { "id": "d", "text": "Romper los interruptores para que nadie los use.", "image_url": null }
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
  "mission_title": "Compara antes y después",
  "mission_description": "Observa cómo cambió la situación con el proyecto.",
  "instructions_es": "Escoge la mejor comparación.",
  "content": {
    "passage": "Antes del proyecto, muchas luces y abanicos quedaban encendidos sin necesidad. Después del proyecto, varias aulas mostraron menos consumo y más cuidado con el uso de energía.",
    "question": "¿Cuál es la mejor comparación?",
    "options": [
      { "id": "a", "text": "Antes había más desperdicio; después hubo más cuidado y menor consumo en varias aulas.", "image_url": null },
      { "id": "b", "text": "Antes y después todo fue exactamente igual.", "image_url": null },
      { "id": "c", "text": "Después del proyecto la escuela usó mucha más energía en todas partes.", "image_url": null },
      { "id": "d", "text": "El proyecto eliminó por completo todos los aparatos eléctricos.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 4. Multiple choice — identifying purpose
- Skill: `identifying_purpose`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Identifica el propósito del texto",
  "mission_description": "Piensa por qué fue escrito el artículo del proyecto.",
  "instructions_es": "Escoge el propósito principal.",
  "content": {
    "passage": "El artículo presenta el problema del gasto energético, las acciones tomadas y los resultados observados para que la comunidad escolar entienda el proyecto.",
    "question": "¿Cuál es el propósito principal del texto?",
    "options": [
      { "id": "a", "text": "Informar sobre un proyecto escolar y sus resultados.", "image_url": null },
      { "id": "b", "text": "Contar una historia de fantasía sobre focos mágicos.", "image_url": null },
      { "id": "c", "text": "Convencer a todos de usar más electricidad.", "image_url": null },
      { "id": "d", "text": "Burlarse de quienes apagan las luces.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Running Totals After Wave 6

With Waves 1–6, the draft set now covers:
- 6 Grade 2 packs
- 6 Grades 3–4 packs
- 6 Grades 5–6 packs

That gives you 18 premium packs in progress across the three main grade bands.

## Next recommended packs
- Grade 2 → `g2_market_morning`
- Grade 2 → `g2_animal_homes`
- Grades 3–4 → `g34_recycling_day`
- Grades 3–4 → `g34_weather_watchers`
- Grades 5–6 → `g56_local_news_comparison`
- Grades 5–6 → `g56_water_use_report`

