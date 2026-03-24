# Structured Content Wave 15

This wave continues the **skill-first** production model:

**Grade band → Curriculum unit → Skill targets → Pack → Activity family**

Wave 15 focuses on the next structured gap-fill set:
- Grade 2 → `g2_follow_the_clues`
- Grades 3–4 → `g34_best_evidence`
- Grades 5–6 → `g56_limits_of_a_claim`

These are designed to keep filling real skill gaps instead of only broadening themes.

---

# Pack 43 — Grade 2

## Pack Code
`g2_follow_the_clues`

## Pack Role
`core`

## Curriculum Unit
`early_reading_basics`

## Primary Skills
- `supporting_details`
- `inference`
- `selective_attention`

## Secondary Skills
- `main_idea`
- `instruction_following`

## Theme
Students use simple clues around the classroom to find where an object belongs.

## Why this pack exists
This pack gives Grade 2 students more practice with **following clues**, noticing relevant details, and making simple inferences from concrete information.

## Activity Family

### 1. Storybook reading
- Skill: `main_idea`
- Type: `storybook_reading`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mystery",
  "mission_title": "Sigue las pistas del aula",
  "mission_description": "Lee la historia y descubre qué está tratando de hacer la clase.",
  "instructions_es": "Lee las páginas y responde la pregunta.",
  "content": {
    "pages": [
      {
        "id": "p1",
        "title": "Una pista en la mesa",
        "text": "La maestra dejó una nota que decía: 'Busca cerca del lugar donde viven los cuentos y donde siempre se habla bajito'.",
        "image_prompt": "teacher note on classroom table with children reading it curiously"
      },
      {
        "id": "p2",
        "title": "Pensar y buscar",
        "text": "Los niños miraron alrededor del aula y siguieron la pista con cuidado para encontrar el lugar correcto.",
        "image_prompt": "children looking around classroom following a clue to the reading corner"
      }
    ],
    "question": {
      "prompt": "¿Qué está haciendo la clase en la historia?",
      "options": [
        { "id": "a", "text": "Está usando pistas para encontrar un lugar correcto.", "image_url": null },
        { "id": "b", "text": "Está guardando todos los libros en cajas cerradas.", "image_url": null },
        { "id": "c", "text": "Está saliendo al patio para jugar fútbol.", "image_url": null }
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
  "mission_title": "Encuentra la pista importante",
  "mission_description": "Escoge el detalle que ayuda más a resolver la pista.",
  "instructions_es": "Escoge la mejor pista.",
  "content": {
    "passage": "La nota decía que el objeto estaba cerca de los cuentos y en un lugar donde se habla bajito.",
    "question": "¿Qué detalle ayuda más a encontrar el lugar?",
    "options": [
      { "id": "a", "text": "Está cerca de los cuentos y es un lugar silencioso.", "image_url": null },
      { "id": "b", "text": "La nota estaba sobre una mesa.", "image_url": null },
      { "id": "c", "text": "Los niños estaban en el aula.", "image_url": null },
      { "id": "d", "text": "Había una maestra en el salón.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 3. Multiple choice — inference
- Skill: `inference`
- Type: `multiple_choice`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Piensa con la pista",
  "mission_description": "Usa la pista para descubrir el mejor lugar.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "passage": "La pista dice que el lugar tiene cuentos y que allí se habla bajito.",
    "question": "¿A qué lugar se refiere la pista?",
    "options": [
      { "id": "a", "text": "Al rincón de lectura.", "image_url": null },
      { "id": "b", "text": "A la cancha.", "image_url": null },
      { "id": "c", "text": "Al comedor.", "image_url": null },
      { "id": "d", "text": "Al baño.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 4. Tap sequence — selective attention
- Skill: `selective_attention`
- Type: `tap_sequence`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "puzzle",
  "mission_title": "Toca solo las pistas útiles",
  "mission_description": "Observa con cuidado y toca solo las palabras que ayudan a encontrar el lugar.",
  "instructions_es": "Toca solo las pistas útiles en el orden en que aparecen.",
  "content": {
    "items": [
      { "id": "item_1", "text": "cuentos" },
      { "id": "item_2", "text": "mesa" },
      { "id": "item_3", "text": "bajito" },
      { "id": "item_4", "text": "ventana" }
    ],
    "instructions": "Toca solo las palabras que sí ayudan a resolver la pista.",
    "time_limit_seconds": 20
  },
  "correct_answer": {
    "sequence": ["item_1", "item_3"]
  }
}
```

---

# Pack 44 — Grades 3–4

## Pack Code
`g34_best_evidence`

## Pack Role
`core`

## Curriculum Unit
`middle_reading_interpretation`

## Primary Skills
- `evidence_selection`
- `supporting_details`
- `inference`

## Secondary Skills
- `summarization`
- `decision_making`

## Theme
Students read short passages and choose which sentence best supports a conclusion.

## Why this pack exists
This pack adds stronger **evidence selection** work to Grades 3–4, bridging from basic details toward more explicit evidence-based reasoning.

## Activity Family

### 1. Illustrated clue reading — evidence selection
- Skill: `evidence_selection`
- Type: `illustrated_clue`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Escoge la mejor evidencia",
  "mission_description": "Lee el texto y elige la pista que mejor apoya la conclusión.",
  "instructions_es": "Escoge la mejor evidencia.",
  "content": {
    "image_prompt": "student reading short passage and highlighting strongest clue on worksheet",
    "passage": "El patio estaba mojado, había botas en la entrada y varios estudiantes sacudían sus paraguas antes de entrar al salón.",
    "question": "¿Qué conclusión está mejor apoyada por el texto?",
    "options": [
      { "id": "a", "text": "Afuera había llovido.", "image_url": null },
      { "id": "b", "text": "Era hora del almuerzo.", "image_url": null },
      { "id": "c", "text": "La clase iba a pintar.", "image_url": null },
      { "id": "d", "text": "Los estudiantes iban a la biblioteca.", "image_url": null }
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
  "mission_title": "Encuentra el detalle más fuerte",
  "mission_description": "Escoge la pista que mejor apoya la respuesta.",
  "instructions_es": "Escoge el detalle más útil.",
  "content": {
    "passage": "Había paraguas abiertos en la puerta, charcos en el patio y gotas en los abrigos.",
    "question": "¿Qué detalle apoya mejor que había llovido?",
    "options": [
      { "id": "a", "text": "Había charcos en el patio.", "image_url": null },
      { "id": "b", "text": "La puerta estaba abierta.", "image_url": null },
      { "id": "c", "text": "Los estudiantes llevaban mochilas.", "image_url": null },
      { "id": "d", "text": "El salón tenía pizarras.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 3. Multiple choice — inference
- Skill: `inference`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Saca una conclusión con las pistas",
  "mission_description": "Usa los detalles para pensar qué ocurrió.",
  "instructions_es": "Escoge la mejor inferencia.",
  "content": {
    "passage": "La maestra pidió dejar los paraguas en la esquina y secar el piso cerca de la puerta.",
    "question": "¿Qué se puede inferir?",
    "options": [
      { "id": "a", "text": "Había entrado agua de la lluvia al salón.", "image_url": null },
      { "id": "b", "text": "La clase iba a salir a correr.", "image_url": null },
      { "id": "c", "text": "El salón no tenía puerta.", "image_url": null },
      { "id": "d", "text": "Los paraguas estaban rotos por completo.", "image_url": null }
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
  "lesson_mood": "mission",
  "mission_title": "Resume la idea central",
  "mission_description": "Escoge el resumen que mejor explica el trabajo con evidencias.",
  "instructions_es": "Escoge el mejor resumen.",
  "content": {
    "passage": "La lectura enseña a elegir la pista más útil para apoyar una conclusión en lugar de fijarse en cualquier detalle pequeño.",
    "question": "¿Cuál es el mejor resumen?",
    "options": [
      { "id": "a", "text": "Hay que escoger la evidencia más fuerte para apoyar una idea.", "image_url": null },
      { "id": "b", "text": "Todos los detalles valen exactamente lo mismo siempre.", "image_url": null },
      { "id": "c", "text": "No hace falta usar pistas para entender un texto.", "image_url": null },
      { "id": "d", "text": "La lectura trata sobre deportes en la lluvia.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Pack 45 — Grades 5–6

## Pack Code
`g56_limits_of_a_claim`

## Pack Role
`core`

## Curriculum Unit
`upper_advanced_reading`

## Primary Skills
- `evaluating_evidence`
- `fact_vs_opinion`
- `argument_analysis`

## Secondary Skills
- `compare_contrast`
- `summarization`

## Theme
Students examine a strong claim and learn to notice when it goes beyond what the evidence can really support.

## Why this pack exists
This pack deepens **argument analysis** and helps students recognize when a claim sounds stronger than the evidence behind it.

## Activity Family

### 1. Illustrated article reading — evaluating evidence
- Skill: `evaluating_evidence`
- Type: `illustrated_clue`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Detecta los límites de una afirmación",
  "mission_description": "Lee la evidencia y decide si la conclusión va demasiado lejos.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "image_prompt": "student comparing small study summary with oversized bold claim poster",
    "passage": "Un estudio corto observó mejoras en 12 estudiantes después de una semana de práctica. Un anuncio dijo: '¡Este método garantiza grandes resultados para todos los alumnos!'",
    "question": "¿Cuál es la mejor evaluación?",
    "options": [
      { "id": "a", "text": "La afirmación del anuncio es demasiado amplia para la evidencia que presenta el estudio.", "image_url": null },
      { "id": "b", "text": "El anuncio es correcto porque 12 estudiantes representan a todos los alumnos.", "image_url": null },
      { "id": "c", "text": "El estudio demuestra que nunca se necesita más investigación.", "image_url": null },
      { "id": "d", "text": "No hay ninguna diferencia entre una observación corta y una garantía total.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 2. Multiple choice — fact vs opinion
- Skill: `fact_vs_opinion`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "friendly_challenge",
  "mission_title": "Separa el dato de la exageración",
  "mission_description": "Escoge la afirmación verificable.",
  "instructions_es": "Escoge cuál afirmación es un hecho.",
  "content": {
    "passage": null,
    "question": "¿Cuál afirmación es un hecho?",
    "options": [
      { "id": "a", "text": "El método es el mejor del universo para cualquier estudiante.", "image_url": null },
      { "id": "b", "text": "El estudio observó a 12 estudiantes durante una semana.", "image_url": null },
      { "id": "c", "text": "Toda práctica corta cambia la vida para siempre.", "image_url": null },
      { "id": "d", "text": "Las garantías absolutas siempre son confiables.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "b"
  }
}
```

### 3. Multiple choice — argument analysis
- Skill: `argument_analysis`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Analiza la fuerza del argumento",
  "mission_description": "Piensa si la conclusión está bien apoyada o si es exagerada.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "passage": "La evidencia muestra una mejora pequeña en un grupo reducido, pero el mensaje dice que el resultado está garantizado para cualquier persona.",
    "question": "¿Cuál es el problema principal del argumento?",
    "options": [
      { "id": "a", "text": "La conclusión generaliza demasiado a partir de evidencia limitada.", "image_url": null },
      { "id": "b", "text": "La conclusión es demasiado modesta para el estudio.", "image_url": null },
      { "id": "c", "text": "El argumento tiene demasiados detalles precisos.", "image_url": null },
      { "id": "d", "text": "El estudio no menciona ninguna observación real.", "image_url": null }
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
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Resume la idea principal",
  "mission_description": "Escoge el resumen que mejor explica la lección de esta lectura.",
  "instructions_es": "Escoge el mejor resumen.",
  "content": {
    "passage": "La lectura enseña que una afirmación puede sonar convincente, pero aun así ir más lejos de lo que la evidencia realmente permite asegurar.",
    "question": "¿Cuál es el mejor resumen?",
    "options": [
      { "id": "a", "text": "Hay que revisar si una afirmación dice más de lo que la evidencia puede apoyar.", "image_url": null },
      { "id": "b", "text": "Toda afirmación fuerte siempre es verdadera.", "image_url": null },
      { "id": "c", "text": "Los estudios pequeños nunca sirven para nada.", "image_url": null },
      { "id": "d", "text": "La lectura trata sobre deportes y ejercicios físicos.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Running Totals After Structured Wave 15

This wave continues the structured gap-fill path by adding:
- stronger Grade 2 evidence for `supporting_details`, `inference`, `selective_attention`
- stronger Grades 3–4 evidence for `evidence_selection`, `supporting_details`, `inference`
- stronger Grades 5–6 evidence for `evaluating_evidence`, `fact_vs_opinion`, `argument_analysis`

## Recommended next structured gap-fill wave
- Grade 2 → `g2_sort_the_signs`
- Grades 3–4 → `g34_clue_or_not`
- Grades 5–6 → `g56_biased_message`

