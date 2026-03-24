# Starter Content Packs — Wave 8

This continues the content production run with the next 3 premium packs:
- Grade 2 → `g2_animal_homes`
- Grades 3–4 → `g34_weather_watchers`
- Grades 5–6 → `g56_water_use_report`

Each pack follows the same structure:
- linked activities
- reusable passage/scene family
- mission framing
- seed-friendly JSON in your current backend shape

---

# Pack 22 — Grade 2

## Pack Code
`g2_animal_homes`

## Curriculum Unit
`early_reading_basics`

## Domain
`reading`

## Primary Skills
- `main_idea`
- `classification`
- `supporting_details`

## Secondary Skills
- `compare_contrast`
- `sequencing`

## Theme
Children learn that different animals live in different homes.

## Tone
Nature-based, simple, visual, concrete.

## Core Story
A class reads about a bird in a nest, a fish in water, and a rabbit in a burrow, then compares where each animal lives.

## Activity Family

### 1. Storybook reading
- Skill: `main_idea`
- Type: `storybook_reading`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Descubre dónde vive cada animal",
  "mission_description": "Lee la historia y piensa en la idea más importante.",
  "instructions_es": "Lee las páginas y responde la pregunta.",
  "content": {
    "pages": [
      {
        "id": "p1",
        "title": "El nido del pájaro",
        "text": "La clase vio un pájaro pequeño entrando a un nido en un árbol. Allí estaba su hogar.",
        "image_prompt": "small bird entering nest in a tree, children observing"
      },
      {
        "id": "p2",
        "title": "Otros hogares",
        "text": "Después aprendieron que los peces viven en el agua y los conejos pueden vivir en madrigueras bajo la tierra.",
        "image_prompt": "fish in water and rabbit near burrow, simple nature scene"
      }
    ],
    "question": {
      "prompt": "¿Cuál es la idea principal de la historia?",
      "options": [
        { "id": "a", "text": "Distintos animales viven en distintos hogares.", "image_url": null },
        { "id": "b", "text": "Todos los animales viven en árboles.", "image_url": null },
        { "id": "c", "text": "Los peces construyen nidos en el cielo.", "image_url": null }
      ]
    }
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 2. Drag to sort — animal homes
- Skill: `classification`
- Type: `drag_to_sort`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "puzzle",
  "mission_title": "Clasifica cada animal con su hogar",
  "mission_description": "Arrastra cada tarjeta al lugar correcto.",
  "instructions_es": "Arrastra cada animal a su hogar.",
  "content": {
    "items": [
      { "id": "item_1", "text": "Pájaro", "image_url": null },
      { "id": "item_2", "text": "Pez", "image_url": null },
      { "id": "item_3", "text": "Conejo", "image_url": null }
    ],
    "zones": [
      { "id": "zone_a", "label": "Nido" },
      { "id": "zone_b", "label": "Agua" },
      { "id": "zone_c", "label": "Madriguera" }
    ],
    "instructions": "Pon cada animal en su hogar."
  },
  "correct_answer": {
    "zones": {
      "zone_a": ["item_1"],
      "zone_b": ["item_2"],
      "zone_c": ["item_3"]
    }
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
  "mission_title": "Encuentra la pista correcta",
  "mission_description": "Escoge el detalle que apoya la idea principal.",
  "instructions_es": "Lee y escoge el detalle correcto.",
  "content": {
    "passage": "El pájaro entró a su nido en el árbol. El pez nadó en el agua y el conejo se escondió en su madriguera.",
    "question": "¿Qué detalle apoya que cada animal tiene un hogar diferente?",
    "options": [
      { "id": "a", "text": "El pez nadó en el agua y el conejo se escondió en su madriguera.", "image_url": null },
      { "id": "b", "text": "La clase salió al patio.", "image_url": null },
      { "id": "c", "text": "Había árboles cerca.", "image_url": null },
      { "id": "d", "text": "Los niños llevaban cuadernos.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 4. Multiple choice — compare and contrast
- Skill: `compare_contrast`
- Type: `multiple_choice`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Compara dos hogares",
  "mission_description": "Piensa cómo se parecen y cómo son diferentes.",
  "instructions_es": "Escoge la mejor comparación.",
  "content": {
    "passage": "El pájaro vive en un nido en un árbol. El conejo vive en una madriguera bajo la tierra.",
    "question": "¿Cuál es la mejor comparación?",
    "options": [
      { "id": "a", "text": "Los dos son hogares, pero uno está en un árbol y el otro bajo la tierra.", "image_url": null },
      { "id": "b", "text": "Los dos están dentro del agua.", "image_url": null },
      { "id": "c", "text": "No son hogares de animales.", "image_url": null },
      { "id": "d", "text": "Ambos son exactamente iguales.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Pack 23 — Grades 3–4

## Pack Code
`g34_weather_watchers`

## Curriculum Unit
`middle_reading_interpretation`

## Domain
`reading`

## Primary Skills
- `supporting_details`
- `summarization`
- `cause_effect`

## Secondary Skills
- `context_clues`
- `decision_making`

## Theme
Students observe clouds, wind, and rain to understand changes in weather.

## Tone
Science-based, observational, classroom-friendly.

## Core Story
A class keeps a weather chart and records how the sky changes before a rainy afternoon.

## Activity Family

### 1. Illustrated clue reading — summarization
- Skill: `summarization`
- Type: `illustrated_clue`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "science_explore",
  "mission_title": "Observa los cambios del clima",
  "mission_description": "Lee lo que vio la clase y escoge el mejor resumen.",
  "instructions_es": "Lee y escoge el mejor resumen.",
  "content": {
    "image_prompt": "students observing cloudy sky and weather chart outside classroom",
    "passage": "En la mañana, la clase vio nubes blancas y poco viento. Más tarde, las nubes se hicieron oscuras, el viento sopló más fuerte y después empezó a llover.",
    "question": "¿Cuál es el mejor resumen?",
    "options": [
      { "id": "a", "text": "La clase observó cómo el clima cambió antes de que lloviera.", "image_url": null },
      { "id": "b", "text": "La clase nunca miró el cielo.", "image_url": null },
      { "id": "c", "text": "El viento desapareció todo el día.", "image_url": null },
      { "id": "d", "text": "Las nubes se volvieron de colores brillantes.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 2. Multiple choice — supporting details
- Skill: `supporting_details`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "friendly_challenge",
  "mission_title": "Encuentra la pista importante",
  "mission_description": "Escoge el detalle que apoya la idea principal.",
  "instructions_es": "Escoge el detalle correcto.",
  "content": {
    "passage": "Antes de la lluvia, las nubes se hicieron oscuras y el viento comenzó a soplar más fuerte.",
    "question": "¿Qué detalle apoya que el clima estaba cambiando?",
    "options": [
      { "id": "a", "text": "Las nubes se hicieron oscuras y el viento sopló más fuerte.", "image_url": null },
      { "id": "b", "text": "La clase tenía una pizarra.", "image_url": null },
      { "id": "c", "text": "Había sillas en el aula.", "image_url": null },
      { "id": "d", "text": "Los estudiantes llevaron lápices.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 3. Multiple choice — cause and effect
- Skill: `cause_effect`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Piensa qué pasó después",
  "mission_description": "Escoge el efecto correcto según el texto.",
  "instructions_es": "Escoge el mejor efecto.",
  "content": {
    "passage": "Las nubes se hicieron más oscuras y el viento sopló con más fuerza durante la tarde.",
    "question": "¿Cuál fue un efecto de esos cambios?",
    "options": [
      { "id": "a", "text": "Después comenzó a llover.", "image_url": null },
      { "id": "b", "text": "El patio se convirtió en biblioteca.", "image_url": null },
      { "id": "c", "text": "Las nubes desaparecieron en un instante.", "image_url": null },
      { "id": "d", "text": "El sol brilló con más fuerza de inmediato.", "image_url": null }
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
  "mission_description": "Piensa qué haría la clase con la información del clima.",
  "instructions_es": "Escoge la mejor decisión.",
  "content": {
    "passage": "La clase ve nubes oscuras, viento fuerte y gotas pequeñas antes de salir al patio.",
    "question": "¿Qué sería mejor hacer?",
    "options": [
      { "id": "a", "text": "Prepararse para entrar o quedarse bajo techo.", "image_url": null },
      { "id": "b", "text": "Ignorar el cielo y dejar los cuadernos afuera.", "image_url": null },
      { "id": "c", "text": "Salir corriendo sin mirar el clima.", "image_url": null },
      { "id": "d", "text": "Apagar todas las luces del barrio.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Pack 24 — Grades 5–6

## Pack Code
`g56_water_use_report`

## Curriculum Unit
`upper_advanced_reading`

## Domain
`reading`

## Primary Skills
- `evaluating_evidence`
- `compare_contrast`
- `problem_solving`

## Secondary Skills
- `identifying_purpose`
- `fact_vs_opinion`

## Theme
A school reads a report about water use in bathrooms, classrooms, and the garden, then plans improvements.

## Tone
Analytical, practical, school-based, evidence-driven.

## Core Passage Family
The report compares where the school uses the most water and proposes actions to reduce waste.

## Activity Family

### 1. Illustrated article reading — evaluating evidence
- Skill: `evaluating_evidence`
- Type: `illustrated_clue`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "science_explore",
  "mission_title": "Analiza el reporte sobre uso de agua",
  "mission_description": "Lee la información y decide qué conclusión está mejor respaldada.",
  "instructions_es": "Escoge la conclusión mejor respaldada por el texto.",
  "content": {
    "image_prompt": "school sinks, garden hose, and classroom water containers with simple report graphic",
    "passage": "El reporte mostró que la mayor parte del agua se usa en baños y limpieza, mientras que el jardín usa menos pero aumenta su consumo en semanas secas. También se detectaron llaves que goteaban en dos áreas.",
    "question": "¿Qué conclusión está mejor respaldada?",
    "options": [
      { "id": "a", "text": "Arreglar llaves que gotean podría ayudar a reducir parte del consumo innecesario.", "image_url": null },
      { "id": "b", "text": "El jardín usa más agua que toda la escuela junta.", "image_url": null },
      { "id": "c", "text": "No existe ninguna oportunidad de mejorar el uso de agua.", "image_url": null },
      { "id": "d", "text": "Las aulas nunca necesitan agua para ninguna actividad.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 2. Multiple choice — compare and contrast
- Skill: `compare_contrast`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Compara dos áreas de uso de agua",
  "mission_description": "Observa cómo se parecen y diferencian los datos.",
  "instructions_es": "Escoge la mejor comparación.",
  "content": {
    "passage": "Los baños y la limpieza usan mucha agua cada semana. El jardín usa menos en general, pero necesita más en semanas secas.",
    "question": "¿Cuál es la mejor comparación?",
    "options": [
      { "id": "a", "text": "Baños y limpieza mantienen un uso alto; el jardín cambia más según el clima.", "image_url": null },
      { "id": "b", "text": "El jardín siempre usa más agua que todas las demás áreas.", "image_url": null },
      { "id": "c", "text": "Todas las áreas usan exactamente la misma cantidad.", "image_url": null },
      { "id": "d", "text": "Los baños no usan agua nunca.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 3. Multiple choice — problem solving
- Skill: `problem_solving`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Piensa en la mejor solución",
  "mission_description": "Escoge la acción que ayudaría más con el problema.",
  "instructions_es": "Escoge la mejor solución.",
  "content": {
    "passage": "La escuela quiere bajar su consumo de agua y ya sabe que hay llaves con fugas y que algunas mangueras se dejan abiertas más tiempo del necesario.",
    "question": "¿Qué acción sería más útil?",
    "options": [
      { "id": "a", "text": "Reparar fugas y establecer tiempos claros para usar mangueras.", "image_url": null },
      { "id": "b", "text": "Abrir más llaves para usar el agua más rápido.", "image_url": null },
      { "id": "c", "text": "Ignorar el reporte hasta el próximo año.", "image_url": null },
      { "id": "d", "text": "Usar agua adicional para comprobar si sobra.", "image_url": null }
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
  "mission_title": "Identifica el propósito del reporte",
  "mission_description": "Piensa por qué fue escrito este texto.",
  "instructions_es": "Escoge el propósito principal.",
  "content": {
    "passage": "El reporte presenta datos sobre dónde se usa más agua, qué problemas se encontraron y qué mejoras podrían hacerse.",
    "question": "¿Cuál es el propósito principal del texto?",
    "options": [
      { "id": "a", "text": "Informar sobre el uso de agua y orientar decisiones para mejorar.", "image_url": null },
      { "id": "b", "text": "Entretener con una historia fantástica sobre llaves mágicas.", "image_url": null },
      { "id": "c", "text": "Convencer a la escuela de usar toda el agua posible.", "image_url": null },
      { "id": "d", "text": "Burlarse de quienes revisan reportes.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Running Totals After Wave 8

With Waves 1–8, the draft set now covers:
- 8 Grade 2 packs
- 8 Grades 3–4 packs
- 8 Grades 5–6 packs

That gives you 24 premium packs in progress across the three main grade bands.

## Next recommended packs
- Grade 2 → `g2_bus_stop_morning`
- Grade 2 → `g2_rain_after_school`
- Grades 3–4 → `g34_park_cleanup`
- Grades 3–4 → `g34_butterfly_garden`
- Grades 5–6 → `g56_science_fair_article`
- Grades 5–6 → `g56_city_trees_report`
