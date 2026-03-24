# Structured Content Wave 18

This wave continues the **skill-first** production model:

**Grade band → Curriculum unit → Skill targets → Pack → Activity family**

Wave 18 focuses on the next structured gap-fill set:
- Grade 2 → `g2_rule_or_not`
- Grades 3–4 → `g34_strongest_clue`
- Grades 5–6 → `g56_missing_evidence`

These packs are designed to keep filling real skill gaps with stronger instructional structure and clearer evidence variety.

---

# Pack 52 — Grade 2

## Pack Code
`g2_rule_or_not`

## Pack Role
`core`

## Curriculum Unit
`early_reading_basics`

## Primary Skills
- `instruction_following`
- `classification`
- `response_control`

## Secondary Skills
- `selective_attention`
- `supporting_details`

## Theme
Students play a simple classroom game where they must decide whether each action follows the rule or not.

## Why this pack exists
This pack gives Grade 2 stronger practice in **rule recognition**, **response control**, and deciding whether an action belongs inside a rule set.

## Activity Family

### 1. Storybook reading
- Skill: `supporting_details`
- Type: `storybook_reading`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Descubre la regla de la clase",
  "mission_description": "Lee la historia y piensa en cómo la clase sabe cuándo una acción sigue la regla.",
  "instructions_es": "Lee las páginas y responde la pregunta.",
  "content": {
    "pages": [
      {
        "id": "p1",
        "title": "Una regla clara",
        "text": "La maestra dijo: 'Si terminas una actividad, guarda tus materiales y espera en silencio'. Después mostró varias acciones para que la clase pensara cuáles seguían la regla.",
        "image_prompt": "teacher presenting a simple classroom rule with action cards"
      },
      {
        "id": "p2",
        "title": "Pensar antes de responder",
        "text": "Los niños observaron cada acción y levantaron la mano solo cuando estaban seguros de que sí seguía la regla.",
        "image_prompt": "students carefully deciding if classroom actions follow a rule"
      }
    ],
    "question": {
      "prompt": "¿Cómo decidió la clase si una acción seguía la regla?",
      "options": [
        { "id": "a", "text": "Miró la acción y pensó si cumplía la regla antes de responder.", "image_url": null },
        { "id": "b", "text": "Dijo sí a todas sin mirar.", "image_url": null },
        { "id": "c", "text": "Guardó las tarjetas antes del juego.", "image_url": null }
      ]
    }
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 2. Multiple choice — instruction following
- Skill: `instruction_following`
- Type: `multiple_choice`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Sigue la regla completa",
  "mission_description": "Lee con cuidado antes de escoger.",
  "instructions_es": "Escoge la acción que sí sigue la regla.",
  "content": {
    "passage": "Regla: Cuando termines, guarda tus materiales y espera en silencio.",
    "question": "¿Qué acción sigue la regla?",
    "options": [
      { "id": "a", "text": "Guardar el lápiz y esperar en silencio.", "image_url": null },
      { "id": "b", "text": "Correr por el aula con el cuaderno.", "image_url": null },
      { "id": "c", "text": "Gritar que ya terminaste.", "image_url": null },
      { "id": "d", "text": "Lanzar los materiales a la mesa.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 3. Drag to sort — rule or not
- Skill: `classification`
- Type: `drag_to_sort`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "puzzle",
  "mission_title": "Clasifica las acciones",
  "mission_description": "Arrastra cada acción al grupo correcto.",
  "instructions_es": "Arrastra al grupo correcto.",
  "content": {
    "items": [
      { "id": "item_1", "text": "Guardar el cuaderno", "image_url": null },
      { "id": "item_2", "text": "Esperar en silencio", "image_url": null },
      { "id": "item_3", "text": "Gritar y correr", "image_url": null },
      { "id": "item_4", "text": "Tirar los lápices", "image_url": null }
    ],
    "zones": [
      { "id": "zone_a", "label": "Sigue la regla" },
      { "id": "zone_b", "label": "No sigue la regla" }
    ],
    "instructions": "Pon cada acción en el grupo correcto."
  },
  "correct_answer": {
    "zones": {
      "zone_a": ["item_1", "item_2"],
      "zone_b": ["item_3", "item_4"]
    }
  }
}
```

### 4. Multiple choice — response control
- Skill: `response_control`
- Type: `multiple_choice`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "friendly_challenge",
  "mission_title": "Piensa antes de actuar",
  "mission_description": "Escoge la mejor respuesta cuando ves una acción incorrecta.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "passage": "Ves una tarjeta que muestra a un niño gritando después de terminar su trabajo.",
    "question": "¿Qué deberías pensar primero?",
    "options": [
      { "id": "a", "text": "Eso no sigue la regla de esperar en silencio.", "image_url": null },
      { "id": "b", "text": "Todas las acciones siempre siguen la regla.", "image_url": null },
      { "id": "c", "text": "Gritar es mejor que guardar materiales.", "image_url": null },
      { "id": "d", "text": "No hace falta mirar la tarjeta.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Pack 53 — Grades 3–4

## Pack Code
`g34_strongest_clue`

## Pack Role
`core`

## Curriculum Unit
`middle_reading_interpretation`

## Primary Skills
- `evidence_selection`
- `supporting_details`
- `argument_analysis`

## Secondary Skills
- `filtering_distractions`
- `summarization`

## Theme
Students compare several clues and decide which one is strongest for supporting a conclusion.

## Why this pack exists
This pack pushes Grades 3–4 beyond just finding a clue. It teaches them to choose the **strongest** clue and explain why weaker clues do less work.

## Activity Family

### 1. Illustrated clue reading — evidence selection
- Skill: `evidence_selection`
- Type: `illustrated_clue`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mystery",
  "mission_title": "Encuentra la pista más fuerte",
  "mission_description": "Lee el texto y decide qué pista apoya mejor la conclusión.",
  "instructions_es": "Escoge la pista más fuerte.",
  "content": {
    "image_prompt": "student looking at several clue cards and choosing the strongest one",
    "passage": "El patio estaba mojado, varios paraguas goteaban en la entrada y había huellas de botas cerca de la puerta.",
    "question": "¿Qué detalle es la pista más fuerte para concluir que había llovido?",
    "options": [
      { "id": "a", "text": "Varios paraguas goteaban en la entrada.", "image_url": null },
      { "id": "b", "text": "Había una puerta en el salón.", "image_url": null },
      { "id": "c", "text": "Los estudiantes usan botas a veces.", "image_url": null },
      { "id": "d", "text": "La clase estaba en la escuela.", "image_url": null }
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
  "mission_title": "Elige el detalle que mejor apoya",
  "mission_description": "Escoge el detalle que sí hace el trabajo principal.",
  "instructions_es": "Escoge el detalle más útil.",
  "content": {
    "passage": "Ana piensa que su merienda quedó en la biblioteca porque recuerda haberla dejado sobre una mesa junto al rincón de lectura.",
    "question": "¿Qué detalle apoya mejor esa idea?",
    "options": [
      { "id": "a", "text": "La dejó sobre una mesa junto al rincón de lectura.", "image_url": null },
      { "id": "b", "text": "La merienda estaba en una lonchera azul.", "image_url": null },
      { "id": "c", "text": "Ana fue a clase esa mañana.", "image_url": null },
      { "id": "d", "text": "La escuela tiene biblioteca.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 3. Multiple choice — argument analysis
- Skill: `argument_analysis`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Piensa por qué una pista es más fuerte",
  "mission_description": "Escoge la mejor explicación.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "passage": "Una pista dice exactamente dónde se dejó un objeto. Otra solo dice de qué color era.",
    "question": "¿Por qué la primera pista es más fuerte?",
    "options": [
      { "id": "a", "text": "Porque ayuda directamente a encontrar el lugar del objeto.", "image_url": null },
      { "id": "b", "text": "Porque es más larga que la otra pista.", "image_url": null },
      { "id": "c", "text": "Porque todos los colores son inútiles siempre.", "image_url": null },
      { "id": "d", "text": "Porque no hace falta pensar en la ubicación.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 4. Multiple choice — summarization
- Skill: `summarization`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Resume la lección principal",
  "mission_description": "Escoge el resumen que mejor explica lo aprendido.",
  "instructions_es": "Escoge el mejor resumen.",
  "content": {
    "passage": "La lectura enseña que no todas las pistas ayudan igual. Algunas apoyan una conclusión mejor porque son más directas y más útiles.",
    "question": "¿Cuál es el mejor resumen?",
    "options": [
      { "id": "a", "text": "Hay que escoger la pista más fuerte, no solo cualquier detalle.", "image_url": null },
      { "id": "b", "text": "Todas las pistas sirven exactamente igual.", "image_url": null },
      { "id": "c", "text": "Los detalles de color siempre son los más importantes.", "image_url": null },
      { "id": "d", "text": "La lectura trata sobre juegos sin pistas.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Pack 54 — Grades 5–6

## Pack Code
`g56_missing_evidence`

## Pack Role
`core`

## Curriculum Unit
`upper_advanced_reading`

## Primary Skills
- `evaluating_evidence`
- `argument_analysis`
- `identifying_purpose`

## Secondary Skills
- `fact_vs_opinion`
- `compare_contrast`

## Theme
Students read persuasive messages and identify what evidence is missing or too weak to support the conclusion.

## Why this pack exists
This pack strengthens a key upper-band skill: noticing when a message sounds convincing but leaves out the evidence needed to trust it.

## Activity Family

### 1. Illustrated article reading — evaluating evidence
- Skill: `evaluating_evidence`
- Type: `illustrated_clue`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Detecta la evidencia que falta",
  "mission_description": "Lee el mensaje y decide qué problema tiene.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "image_prompt": "student reading bold persuasive poster with missing evidence notes beside it",
    "passage": "Un cartel dice: 'Este programa mejora el aprendizaje de todos los estudiantes de inmediato'. Pero no muestra estudios, datos, ejemplos medidos ni comparación con otros métodos.",
    "question": "¿Cuál es el problema principal del cartel?",
    "options": [
      { "id": "a", "text": "Hace una afirmación muy grande sin mostrar evidencia suficiente.", "image_url": null },
      { "id": "b", "text": "Tiene demasiados datos y eso lo debilita.", "image_url": null },
      { "id": "c", "text": "Explica con detalle estudios comparativos completos.", "image_url": null },
      { "id": "d", "text": "Presenta límites y dudas con mucho cuidado.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 2. Multiple choice — argument analysis
- Skill: `argument_analysis`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Analiza la debilidad del argumento",
  "mission_description": "Piensa qué le falta para ser más confiable.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "passage": "El mensaje promete resultados para todos, pero no indica quién lo estudió, cuántas personas participaron ni cómo midieron los resultados.",
    "question": "¿Qué le falta al argumento?",
    "options": [
      { "id": "a", "text": "Evidencia concreta y detalles sobre cómo se obtuvieron los resultados.", "image_url": null },
      { "id": "b", "text": "Más palabras exageradas y absolutas.", "image_url": null },
      { "id": "c", "text": "Menos claridad sobre lo que promete.", "image_url": null },
      { "id": "d", "text": "Más insultos hacia quien no esté de acuerdo.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
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
  "mission_title": "Separa dato y promesa",
  "mission_description": "Encuentra la afirmación verificable.",
  "instructions_es": "Escoge cuál afirmación es un hecho.",
  "content": {
    "passage": null,
    "question": "¿Cuál afirmación es un hecho?",
    "options": [
      { "id": "a", "text": "El programa es el mejor del planeta para cualquier estudiante.", "image_url": null },
      { "id": "b", "text": "El cartel no presenta estudios ni datos medidos.", "image_url": null },
      { "id": "c", "text": "Toda promesa fuerte merece confianza automática.", "image_url": null },
      { "id": "d", "text": "Los carteles llamativos siempre tienen razón.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "b"
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
  "mission_title": "Identifica para qué sirve esta lectura",
  "mission_description": "Piensa qué intenta enseñar este texto.",
  "instructions_es": "Escoge el propósito principal.",
  "content": {
    "passage": "La lectura muestra cómo detectar cuándo una afirmación necesita más datos, ejemplos o estudios antes de aceptarse como confiable.",
    "question": "¿Cuál es el propósito principal de la lectura?",
    "options": [
      { "id": "a", "text": "Enseñar a revisar si una afirmación tiene suficiente evidencia.", "image_url": null },
      { "id": "b", "text": "Convencer al lector de aceptar cualquier promesa sin preguntas.", "image_url": null },
      { "id": "c", "text": "Contar una historia fantástica sobre carteles mágicos.", "image_url": null },
      { "id": "d", "text": "Evitar que la gente lea estudios reales.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Running Totals After Structured Wave 18

This wave continues the structured gap-fill path by adding:
- stronger Grade 2 evidence for `instruction_following`, `classification`, and response control
- stronger Grades 3–4 evidence for `strongest clue` thinking and stronger support selection
- stronger Grades 5–6 evidence for recognizing when arguments are missing necessary evidence

## Recommended next structured gap-fill wave
- Grade 2 → `g2_find_the_match`
- Grades 3–4 → `g34_what_proves_it`
- Grades 5–6 → `g56_reliable_or_not`

