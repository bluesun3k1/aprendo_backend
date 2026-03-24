# Starter Content Packs — Wave 3

This continues the content production run with the next 3 premium packs:
- Grade 2 → `g2_class_pet`
- Grades 3–4 → `g34_river_trip`
- Grades 5–6 → `g56_plastic_in_the_ocean`

Each pack follows the same structure:
- linked activities
- reusable passage/scene family
- mission framing
- seed-friendly JSON in your current backend shape

---

# Pack 7 — Grade 2

## Pack Code
`g2_class_pet`

## Curriculum Unit
`early_reading_basics`

## Domain
`reading`

## Primary Skills
- `supporting_details`
- `main_idea`
- `sequencing`

## Secondary Skills
- `classification`
- `instruction_following`

## Theme
A classroom takes care of a pet turtle.

## Tone
Warm, friendly, school-centered.

## Core Story
The class learns how to care for a turtle by feeding it, cleaning its space, and observing what it needs.

## Activity Family

### 1. Storybook reading
- Skill: `main_idea`
- Type: `storybook_reading`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "friendly_challenge",
  "mission_title": "Aprende a cuidar a Tito, la tortuga",
  "mission_description": "Lee la historia y descubre qué hace la clase para cuidar a su mascota.",
  "instructions_es": "Lee las páginas y responde la pregunta.",
  "content": {
    "pages": [
      {
        "id": "p1",
        "title": "La nueva mascota",
        "text": "La clase recibió una tortuga llamada Tito. Los niños miraron su pecera con mucha emoción.",
        "image_prompt": "classroom with children around a turtle tank"
      },
      {
        "id": "p2",
        "title": "Cómo cuidarlo",
        "text": "La maestra explicó que debían darle comida, cambiar el agua y mantener su espacio limpio.",
        "image_prompt": "teacher showing children how to care for a turtle"
      }
    ],
    "question": {
      "prompt": "¿Cuál es la idea principal de la historia?",
      "options": [
        { "id": "a", "text": "La clase aprende a cuidar a una tortuga.", "image_url": null },
        { "id": "b", "text": "Las tortugas pueden correr rápido.", "image_url": null },
        { "id": "c", "text": "La pecera estaba vacía.", "image_url": null }
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
  "lesson_mood": "calm",
  "mission_title": "Encuentra el detalle correcto",
  "mission_description": "Escoge la pista que muestra cómo cuidan a Tito.",
  "instructions_es": "Lee y escoge el detalle que apoya la idea principal.",
  "content": {
    "passage": "La maestra dijo que debían darle comida a Tito, cambiar el agua y limpiar su espacio.",
    "question": "¿Qué detalle muestra cómo cuidan a Tito?",
    "options": [
      { "id": "a", "text": "Le cambian el agua.", "image_url": null },
      { "id": "b", "text": "La tortuga es verde.", "image_url": null },
      { "id": "c", "text": "La clase tiene ventanas.", "image_url": null },
      { "id": "d", "text": "Hay muchos cuadernos.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 3. Tap sequence — order the care steps
- Skill: `sequencing`
- Type: `tap_sequence`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Pon los pasos en orden",
  "mission_description": "Toca cómo la clase cuida a Tito en el orden correcto.",
  "instructions_es": "Toca los pasos en el orden correcto.",
  "content": {
    "items": [
      { "id": "item_1", "text": "Dar comida a Tito" },
      { "id": "item_2", "text": "Mirar su pecera" },
      { "id": "item_3", "text": "Cambiar el agua" }
    ],
    "instructions": "Toca lo que pasa primero, después y al final.",
    "time_limit_seconds": 25
  },
  "correct_answer": {
    "sequence": ["item_2", "item_1", "item_3"]
  }
}
```

### 4. Drag to sort — what belongs to pet care
- Skill: `classification`
- Type: `drag_to_sort`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "puzzle",
  "mission_title": "Clasifica lo que sirve para cuidar a Tito",
  "mission_description": "Arrastra cada elemento al grupo correcto.",
  "instructions_es": "Arrastra al grupo correcto.",
  "content": {
    "items": [
      { "id": "item_1", "text": "Comida para tortuga", "image_url": null },
      { "id": "item_2", "text": "Agua limpia", "image_url": null },
      { "id": "item_3", "text": "Pelota de fútbol", "image_url": null },
      { "id": "item_4", "text": "Piedras de la pecera", "image_url": null }
    ],
    "zones": [
      { "id": "zone_a", "label": "Sirve para cuidar a Tito" },
      { "id": "zone_b", "label": "No pertenece" }
    ],
    "instructions": "Arrastra cada tarjeta al grupo correcto."
  },
  "correct_answer": {
    "zones": {
      "zone_a": ["item_1", "item_2", "item_4"],
      "zone_b": ["item_3"]
    }
  }
}
```

---

# Pack 8 — Grades 3–4

## Pack Code
`g34_river_trip`

## Curriculum Unit
`middle_reading_interpretation`

## Domain
`reading`

## Primary Skills
- `compare_contrast`
- `context_clues`
- `summarization`

## Secondary Skills
- `supporting_details`
- `cause_effect`

## Theme
A class visit to a river to observe nature and learn about ecosystems.

## Tone
Curious, observational, nature-based.

## Core Story
Students visit a river, compare the calm and fast-moving sections, observe plants and animals, and discuss how litter affects the water.

## Activity Family

### 1. Illustrated clue reading — compare and contrast
- Skill: `compare_contrast`
- Type: `illustrated_clue`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "science_explore",
  "mission_title": "Compara dos partes del río",
  "mission_description": "Lee la descripción y descubre cómo se parecen y diferencian.",
  "instructions_es": "Lee y escoge la mejor comparación.",
  "content": {
    "image_prompt": "river with one calm area and one fast-moving area, students observing",
    "passage": "En una parte del río, el agua era tranquila y clara. En otra parte, el agua corría rápido entre rocas. En ambas zonas había plantas cerca de la orilla.",
    "question": "¿Cuál es la mejor comparación?",
    "options": [
      { "id": "a", "text": "Una parte del río era tranquila y otra era rápida, pero ambas tenían plantas cerca.", "image_url": null },
      { "id": "b", "text": "Todo el río era exactamente igual en cada parte.", "image_url": null },
      { "id": "c", "text": "No había plantas cerca del agua.", "image_url": null },
      { "id": "d", "text": "Las rocas hacían que el agua desapareciera.", "image_url": null }
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
  "lesson_mood": "curious",
  "mission_title": "Usa las pistas de contexto",
  "mission_description": "Escoge el significado correcto usando la oración.",
  "instructions_es": "Lee y usa las pistas para encontrar el significado.",
  "content": {
    "passage": "El agua corría con fuerza entre las rocas, formando una corriente rápida.",
    "question": "¿Qué significa la palabra 'corriente' en este texto?",
    "options": [
      { "id": "a", "text": "Movimiento del agua", "image_url": null },
      { "id": "b", "text": "Un pez pequeño", "image_url": null },
      { "id": "c", "text": "Una planta del río", "image_url": null },
      { "id": "d", "text": "Una bolsa de basura", "image_url": null }
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
  "lesson_mood": "science_explore",
  "mission_title": "Resume lo más importante",
  "mission_description": "Escoge el resumen que mejor reúne las ideas principales.",
  "instructions_es": "Lee y escoge el mejor resumen.",
  "content": {
    "passage": "La clase visitó un río para observar cómo cambia el agua en distintas zonas. También vio plantas, animales y habló sobre cómo la basura puede afectar el ecosistema.",
    "question": "¿Cuál es el mejor resumen?",
    "options": [
      { "id": "a", "text": "La clase observó el río y aprendió sobre sus cambios y el cuidado del ecosistema.", "image_url": null },
      { "id": "b", "text": "Los estudiantes solo querían mojarse los zapatos.", "image_url": null },
      { "id": "c", "text": "Todos los ríos son pequeños y silenciosos.", "image_url": null },
      { "id": "d", "text": "No había animales cerca del agua.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 4. Multiple choice — cause and effect
- Skill: `cause_effect`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Relaciona causa y efecto",
  "mission_description": "Piensa qué puede pasar cuando el río recibe basura.",
  "instructions_es": "Escoge el mejor efecto.",
  "content": {
    "passage": "Cuando las personas tiran basura cerca del río, el agua puede ensuciarse y algunos animales pierden un lugar seguro para vivir.",
    "question": "¿Cuál es un efecto de tirar basura cerca del río?",
    "options": [
      { "id": "a", "text": "El agua puede ensuciarse y afectar a los animales.", "image_url": null },
      { "id": "b", "text": "Las rocas desaparecen de inmediato.", "image_url": null },
      { "id": "c", "text": "El río deja de existir en un segundo.", "image_url": null },
      { "id": "d", "text": "Las plantas empiezan a cantar.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Pack 9 — Grades 5–6

## Pack Code
`g56_plastic_in_the_ocean`

## Curriculum Unit
`upper_advanced_reading`

## Domain
`reading`

## Primary Skills
- `evaluating_evidence`
- `summarization`
- `identifying_purpose`

## Secondary Skills
- `fact_vs_opinion`
- `inference`

## Theme
An informational text about how plastic reaches the ocean and why reducing waste matters.

## Tone
Informative, environmental, more mature.

## Core Passage Family
Students read an article explaining how plastic travels through drains, rivers, and coastlines, and what communities can do to reduce the problem.

## Activity Family

### 1. Illustrated article reading — evaluating evidence
- Skill: `evaluating_evidence`
- Type: `illustrated_clue`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "science_explore",
  "mission_title": "Analiza la evidencia sobre el plástico en el océano",
  "mission_description": "Lee la información y decide qué afirmación está mejor respaldada.",
  "instructions_es": "Escoge la afirmación mejor respaldada por el texto.",
  "content": {
    "image_prompt": "coastline with plastic waste, drain and river flow diagram toward the ocean",
    "passage": "Parte del plástico que usamos todos los días termina en calles y desagües. Cuando llueve, muchos residuos son arrastrados hacia ríos y, más tarde, al océano. Allí pueden afectar a peces, aves y otros animales marinos.",
    "question": "¿Qué afirmación está mejor respaldada?",
    "options": [
      { "id": "a", "text": "La lluvia puede ayudar a mover residuos plásticos desde la ciudad hasta el océano.", "image_url": null },
      { "id": "b", "text": "Todo el plástico desaparece antes de llegar al mar.", "image_url": null },
      { "id": "c", "text": "Los animales marinos usan el plástico como alimento saludable.", "image_url": null },
      { "id": "d", "text": "Los ríos no tienen relación con la contaminación del océano.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 2. Multiple choice — summarization
- Skill: `summarization`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Resume la idea central",
  "mission_description": "Escoge el resumen que mejor recoge las ideas importantes.",
  "instructions_es": "Lee y escoge el mejor resumen.",
  "content": {
    "passage": "El plástico puede viajar desde calles y desagües hasta ríos y océanos. En el mar, afecta a animales y ecosistemas. Reducir, reutilizar y reciclar ayuda a disminuir este problema.",
    "question": "¿Cuál es el mejor resumen?",
    "options": [
      { "id": "a", "text": "El plástico puede llegar al océano y dañar ecosistemas, por eso es importante reducir y reciclar.", "image_url": null },
      { "id": "b", "text": "Toda la basura del mundo está en una sola playa.", "image_url": null },
      { "id": "c", "text": "Reciclar solo sirve para ahorrar espacio en casa.", "image_url": null },
      { "id": "d", "text": "Los océanos no tienen animales afectados por residuos.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 3. Multiple choice — identifying purpose
- Skill: `identifying_purpose`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Identifica el propósito del texto",
  "mission_description": "Piensa por qué fue escrito este artículo.",
  "instructions_es": "Escoge el propósito principal del texto.",
  "content": {
    "passage": "El artículo explica cómo el plástico llega al océano, qué efectos produce y qué acciones pueden ayudar a reducir el problema.",
    "question": "¿Cuál es el propósito principal del texto?",
    "options": [
      { "id": "a", "text": "Informar sobre un problema ambiental y posibles soluciones.", "image_url": null },
      { "id": "b", "text": "Contar una historia inventada para entretener.", "image_url": null },
      { "id": "c", "text": "Convencer a la gente de tirar más plástico.", "image_url": null },
      { "id": "d", "text": "Describir una fiesta en la playa.", "image_url": null }
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
  "mission_description": "Encuentra la afirmación basada en información verificable.",
  "instructions_es": "Escoge cuál afirmación es un hecho.",
  "content": {
    "passage": null,
    "question": "¿Cuál de estas afirmaciones es un hecho?",
    "options": [
      { "id": "a", "text": "Reducir plástico es la idea más brillante del mundo.", "image_url": null },
      { "id": "b", "text": "La lluvia puede arrastrar residuos hacia desagües y ríos.", "image_url": null },
      { "id": "c", "text": "Las botellas plásticas son objetos hermosos.", "image_url": null },
      { "id": "d", "text": "Toda la gente debería odiar el plástico.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "b"
  }
}
```

### 5. Multiple choice — inference
- Skill: `inference`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "science_explore",
  "mission_title": "Lee entre líneas",
  "mission_description": "Usa las pistas del texto para sacar una conclusión.",
  "instructions_es": "Escoge la mejor inferencia.",
  "content": {
    "passage": "Después de una campaña escolar para reducir plásticos de un solo uso, menos estudiantes llevaron botellas desechables y más usaron botellas reutilizables.",
    "question": "¿Qué se puede inferir?",
    "options": [
      { "id": "a", "text": "La campaña pudo influir en los hábitos de los estudiantes.", "image_url": null },
      { "id": "b", "text": "Las botellas reutilizables dejaron de existir.", "image_url": null },
      { "id": "c", "text": "Nadie prestó atención a la campaña.", "image_url": null },
      { "id": "d", "text": "Las botellas desechables se hicieron gratuitas.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Phase 2 Running Totals

With Waves 1–3, the draft set now covers:
- 3 Grade 2 packs
- 3 Grades 3–4 packs
- 3 Grades 5–6 packs

That gives you a real starting base across the three main grade bands.

## Next recommended packs
- Grade 2 → `g2_day_and_night`
- Grade 2 → `g2_helping_a_friend`
- Grades 3–4 → `g34_inventors_notebook`
- Grades 3–4 → `g34_growing_plants`
- Grades 5–6 → `g56_ancient_city_discovery`
- Grades 5–6 → `g56_weather_warning_followup`

