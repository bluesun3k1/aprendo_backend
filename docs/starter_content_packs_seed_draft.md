# Starter Content Packs Seed Draft

This draft starts actual content production in your existing backend shape.

It includes 3 premium starter packs:
- Grade 2 → `early_reading_basics`
- Grades 3–4 → `middle_reading_interpretation`
- Grades 5–6 → `upper_advanced_reading`

These are written to fit your current content chain:
- `SkillDomain`
- `Skill`
- `Activity`
- `SkillContent`
- `StudentSession` assembly via the adaptive engine

The examples below are written in a seed-friendly shape using your existing fields:
- `type`
- `lesson_mood`
- `mission_title`
- `mission_description`
- `difficulty`
- `instructions_es`
- `content`
- `correct_answer`
- `is_diagnostic`

---

# Pack 1 — Grade 2

## Pack Code
`g2_school_garden`

## Curriculum Unit
`early_reading_basics`

## Domain
`reading`

## Primary Skills
- `main_idea`
- `supporting_details`
- `sequencing`

## Secondary Skills
- `inference`
- `cause_effect`

## Theme
A school garden that needs help.

## Tone
Warm, visual, simple, storybook-friendly.

## Story Arc
Luna notices the school garden is dry. She looks at the clues, asks for help, and the class waters the plants.

## Activity Family

### 1. Storybook reading
- Skill: `main_idea`
- Type: `storybook_reading`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Ayuda a Luna a entender qué pasa en el jardín",
  "mission_description": "Lee las páginas, mira las imágenes y descubre el problema del jardín.",
  "instructions_es": "Lee la historia y luego responde la pregunta.",
  "content": {
    "pages": [
      {
        "id": "p1",
        "title": "Luna mira el jardín",
        "text": "Luna caminó por el jardín de la escuela. Las flores estaban inclinadas y la tierra se veía seca.",
        "image_prompt": "school garden with drooping flowers and dry soil, child observing"
      },
      {
        "id": "p2",
        "title": "Luna encuentra pistas",
        "text": "Luna vio que no había agua cerca de las plantas. Entonces pensó: el jardín necesita ayuda.",
        "image_prompt": "child noticing dry plants and missing watering can"
      }
    ],
    "question": {
      "prompt": "¿Cuál es el problema principal en la historia?",
      "options": [
        { "id": "a", "text": "El jardín necesita agua.", "image_url": null },
        { "id": "b", "text": "El jardín tiene demasiadas flores.", "image_url": null },
        { "id": "c", "text": "Luna perdió una regadera.", "image_url": null }
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
  "mission_title": "Encuentra la pista correcta",
  "mission_description": "Busca el detalle que muestra por qué Luna piensa que el jardín necesita ayuda.",
  "instructions_es": "Lee y escoge el detalle que apoya la idea principal.",
  "content": {
    "passage": "Luna vio flores inclinadas, tierra seca y ninguna regadera cerca de las plantas.",
    "question": "¿Qué detalle apoya que el jardín necesita agua?",
    "options": [
      { "id": "a", "text": "La tierra se veía seca.", "image_url": null },
      { "id": "b", "text": "Luna fue al jardín.", "image_url": null },
      { "id": "c", "text": "Había flores de colores.", "image_url": null },
      { "id": "d", "text": "La escuela tiene un jardín.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 3. Tap sequence — order the events
- Skill: `sequencing`
- Type: `tap_sequence`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Pon la historia en orden",
  "mission_description": "Toca los eventos en el orden correcto.",
  "instructions_es": "Toca los eventos en el orden en que ocurrieron.",
  "content": {
    "items": [
      { "id": "item_1", "text": "La clase regó las plantas" },
      { "id": "item_2", "text": "Luna miró el jardín" },
      { "id": "item_3", "text": "Luna vio la tierra seca" }
    ],
    "instructions": "Toca en orden lo que pasó primero, después y al final.",
    "time_limit_seconds": 25
  },
  "correct_answer": {
    "sequence": ["item_2", "item_3", "item_1"]
  }
}
```

### 4. Illustrated clue reading
- Skill: `inference`
- Type: `illustrated_clue`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Mira la imagen y descubre la pista",
  "mission_description": "Usa la imagen y el texto para pensar qué necesitaban las plantas.",
  "instructions_es": "Mira la imagen y lee el texto antes de responder.",
  "content": {
    "image_prompt": "small school garden with dry soil and drooping flowers",
    "passage": "Las hojas estaban bajas y la tierra no tenía humedad.",
    "question": "¿Qué podemos inferir?",
    "options": [
      { "id": "a", "text": "Las plantas necesitaban agua.", "image_url": null },
      { "id": "b", "text": "Las plantas tenían demasiada sombra.", "image_url": null },
      { "id": "c", "text": "Las plantas eran nuevas.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 5. Drag to sort — cause and effect
- Skill: `cause_effect`
- Type: `drag_to_sort`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "puzzle",
  "mission_title": "Relaciona la causa y el efecto",
  "mission_description": "Arrastra cada tarjeta al grupo correcto.",
  "instructions_es": "Arrastra cada tarjeta a causa o efecto.",
  "content": {
    "items": [
      { "id": "item_1", "text": "No había agua en el jardín", "image_url": null },
      { "id": "item_2", "text": "Las flores se inclinaron", "image_url": null },
      { "id": "item_3", "text": "La clase regó las plantas", "image_url": null },
      { "id": "item_4", "text": "El jardín se veía mejor", "image_url": null }
    ],
    "zones": [
      { "id": "zone_a", "label": "Causa" },
      { "id": "zone_b", "label": "Efecto" }
    ],
    "instructions": "Pon cada tarjeta en causa o efecto."
  },
  "correct_answer": {
    "zones": {
      "zone_a": ["item_1", "item_3"],
      "zone_b": ["item_2", "item_4"]
    }
  }
}
```

---

# Pack 2 — Grades 3–4

## Pack Code
`g34_bee_helper`

## Curriculum Unit
`middle_reading_interpretation`

## Domain
`reading`

## Primary Skills
- `inference`
- `context_clues`
- `summarization`

## Secondary Skills
- `supporting_details`
- `compare_contrast`

## Theme
How bees help plants and people.

## Tone
Curious, informative, light science.

## Core Passage
Bees collect nectar and pollen. As they move from flower to flower, they help plants grow fruits and seeds.

## Activity Family

### 1. Illustrated lesson — inference
- Skill: `inference`
- Type: `illustrated_clue`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "science_explore",
  "mission_title": "Descubre por qué las abejas son importantes",
  "mission_description": "Lee el texto, mira la escena y encuentra la mejor conclusión.",
  "instructions_es": "Usa el texto y la imagen para responder.",
  "content": {
    "image_prompt": "bees moving among flowers in a garden",
    "passage": "Las abejas visitan flores para recoger néctar y polen. Al moverse entre flores, ayudan a que crezcan frutos y semillas.",
    "question": "¿Qué podemos inferir?",
    "options": [
      { "id": "a", "text": "Las abejas ayudan a las plantas a reproducirse.", "image_url": null },
      { "id": "b", "text": "Las flores dañan a las abejas.", "image_url": null },
      { "id": "c", "text": "Las abejas solo comen hojas.", "image_url": null },
      { "id": "d", "text": "Las semillas aparecen sin ayuda.", "image_url": null }
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
  "mission_description": "Encuentra el significado correcto usando la oración completa.",
  "instructions_es": "Lee y usa las pistas del texto.",
  "content": {
    "passage": "Las abejas son esenciales para muchos ecosistemas porque ayudan a polinizar plantas y flores.",
    "question": "¿Qué significa la palabra 'esenciales' en este texto?",
    "options": [
      { "id": "a", "text": "Muy importantes", "image_url": null },
      { "id": "b", "text": "Muy pequeñas", "image_url": null },
      { "id": "c", "text": "Muy rápidas", "image_url": null },
      { "id": "d", "text": "Muy silenciosas", "image_url": null }
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
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "friendly_challenge",
  "mission_title": "Resume la información importante",
  "mission_description": "Escoge el resumen que mejor reúne las ideas principales.",
  "instructions_es": "Lee y escoge el mejor resumen.",
  "content": {
    "passage": "Las abejas recogen néctar y polen. Al visitar distintas flores, ayudan a la polinización. Gracias a eso, muchas plantas producen frutos y semillas.",
    "question": "¿Cuál es el mejor resumen?",
    "options": [
      { "id": "a", "text": "Las abejas vuelan en jardines.", "image_url": null },
      { "id": "b", "text": "Las abejas ayudan a las plantas al polinizar flores.", "image_url": null },
      { "id": "c", "text": "Las semillas crecen en cualquier lugar.", "image_url": null },
      { "id": "d", "text": "Todas las flores tienen abejas siempre.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "b"
  }
}
```

### 4. Story strip sequencing
- Skill: `supporting_details`
- Type: `story_strip_sequencing`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Ordena las ideas del proceso",
  "mission_description": "Pon las partes del proceso en el orden correcto.",
  "instructions_es": "Ordena las tarjetas de acuerdo con el proceso descrito.",
  "content": {
    "cards": [
      { "id": "card_1", "text": "La abeja visita una flor." },
      { "id": "card_2", "text": "El polen se mueve a otra flor." },
      { "id": "card_3", "text": "La planta puede formar semillas." }
    ]
  },
  "correct_answer": {
    "sequence": ["card_1", "card_2", "card_3"]
  }
}
```

### 5. Multiple choice — compare and contrast
- Skill: `compare_contrast`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Compara dos ideas",
  "mission_description": "Encuentra cómo se relacionan las flores y las abejas.",
  "instructions_es": "Lee y escoge la mejor comparación.",
  "content": {
    "passage": "Las abejas necesitan flores para conseguir néctar. Las flores necesitan abejas para mover el polen.",
    "question": "¿Qué relación muestra el texto?",
    "options": [
      { "id": "a", "text": "Las flores y las abejas se ayudan mutuamente.", "image_url": null },
      { "id": "b", "text": "Las flores no necesitan insectos.", "image_url": null },
      { "id": "c", "text": "Las abejas viven dentro de las flores.", "image_url": null },
      { "id": "d", "text": "Las flores solo sirven para decorar.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Pack 3 — Grades 5–6

## Pack Code
`g56_weather_warning`

## Curriculum Unit
`upper_advanced_reading`

## Domain
`reading`

## Primary Skills
- `evaluating_evidence`
- `compare_contrast`
- `inference`

## Secondary Skills
- `identifying_purpose`
- `fact_vs_opinion`

## Theme
A weather alert and how people should respond.

## Tone
More mature, article-like, still highly readable.

## Core Passage Family
A school community receives a severe weather warning and must decide how to prepare.

## Activity Family

### 1. Illustrated article reading — evaluating evidence
- Skill: `evaluating_evidence`
- Type: `illustrated_clue`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Evalúa la evidencia del aviso meteorológico",
  "mission_description": "Lee la información y decide qué afirmación está mejor respaldada.",
  "instructions_es": "Lee el texto y escoge la afirmación con mejor evidencia.",
  "content": {
    "image_prompt": "school building under cloudy sky with weather alert icon",
    "passage": "El servicio meteorológico informó que una tormenta fuerte llegaría en la tarde. También indicó vientos intensos, lluvia abundante y posibles inundaciones en calles bajas.",
    "question": "¿Qué afirmación está mejor respaldada por el texto?",
    "options": [
      { "id": "a", "text": "La escuela debe prepararse para lluvia intensa y posibles problemas en algunas calles.", "image_url": null },
      { "id": "b", "text": "La tormenta durará toda la semana.", "image_url": null },
      { "id": "c", "text": "No habrá viento durante la tormenta.", "image_url": null },
      { "id": "d", "text": "Las inundaciones ocurrirán en todas partes sin excepción.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 2. Multiple choice — identifying purpose
- Skill: `identifying_purpose`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Identifica el propósito del aviso",
  "mission_description": "Piensa por qué fue escrito el texto.",
  "instructions_es": "Lee y determina el propósito principal del texto.",
  "content": {
    "passage": "El aviso meteorológico recomienda asegurar objetos livianos, evitar calles inundadas y mantenerse informado por canales oficiales.",
    "question": "¿Cuál es el propósito principal del texto?",
    "options": [
      { "id": "a", "text": "Entretener con una historia de tormentas.", "image_url": null },
      { "id": "b", "text": "Dar instrucciones para prepararse y mantenerse seguro.", "image_url": null },
      { "id": "c", "text": "Convencer a las personas de viajar durante la lluvia.", "image_url": null },
      { "id": "d", "text": "Describir una tormenta pasada en detalle.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "b"
  }
}
```

### 3. Multiple choice — fact vs opinion
- Skill: `fact_vs_opinion`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "friendly_challenge",
  "mission_title": "Separa hechos de opiniones",
  "mission_description": "Encuentra la afirmación basada en información verificable.",
  "instructions_es": "Escoge la afirmación que sea un hecho.",
  "content": {
    "passage": null,
    "question": "¿Cuál de estas afirmaciones es un hecho?",
    "options": [
      { "id": "a", "text": "Las tormentas son lo peor que puede pasar en una ciudad.", "image_url": null },
      { "id": "b", "text": "El aviso meteorológico informó vientos intensos y lluvia abundante.", "image_url": null },
      { "id": "c", "text": "Todos deberían amar los días lluviosos.", "image_url": null },
      { "id": "d", "text": "Las calles mojadas siempre son hermosas.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "b"
  }
}
```

### 4. Multiple choice — compare and contrast
- Skill: `compare_contrast`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Compara dos mensajes",
  "mission_description": "Observa cómo cambian el tono y el propósito entre dos textos.",
  "instructions_es": "Lee ambos mensajes y compáralos.",
  "content": {
    "passage": "Texto A: El aviso oficial recomienda asegurar objetos y evitar zonas inundadas. Texto B: Un estudiante escribió que la tormenta hará que todos pierdan la semana completa de clases.",
    "question": "¿Cuál es la mejor comparación?",
    "options": [
      { "id": "a", "text": "El texto A informa con evidencia; el texto B exagera sin apoyo claro.", "image_url": null },
      { "id": "b", "text": "Ambos textos tienen el mismo propósito y el mismo tono.", "image_url": null },
      { "id": "c", "text": "El texto B es más oficial que el texto A.", "image_url": null },
      { "id": "d", "text": "El texto A es una opinión y el texto B es una noticia oficial.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
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
  "lesson_mood": "mission",
  "mission_title": "Lee entre líneas",
  "mission_description": "Usa las pistas del texto para inferir la mejor conclusión.",
  "instructions_es": "Escoge la mejor inferencia según la información dada.",
  "content": {
    "passage": "La directora pidió cerrar las ventanas, mover materiales del patio al interior y revisar los mensajes oficiales antes de la salida.",
    "question": "¿Qué se puede inferir?",
    "options": [
      { "id": "a", "text": "La escuela se está preparando seriamente para el mal tiempo.", "image_url": null },
      { "id": "b", "text": "La tormenta ya terminó por completo.", "image_url": null },
      { "id": "c", "text": "La escuela no cree en el aviso meteorológico.", "image_url": null },
      { "id": "d", "text": "Los materiales del patio no importan para la seguridad.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# What to do next

## Immediate next production step
Build these 3 packs into your seed pipeline first, then add:
- Pack 4 → Grade 2: `g2_rainy_day_plans`
- Pack 5 → Grades 3–4: `g34_lost_backpack`
- Pack 6 → Grades 5–6: `g56_school_news_article`

## Best implementation notes
- create `storybook_reading` and `story_strip_sequencing` support in the frontend renderer
- start actually using `lesson_mood`, `mission_title`, and `mission_description`
- keep one passage/story supporting multiple linked activities
- do not publish isolated questions as the main premium content path
