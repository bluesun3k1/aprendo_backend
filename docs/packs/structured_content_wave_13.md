# Structured Content Wave 13

This wave continues the **skill-first** production model:

**Grade band → Curriculum unit → Skill targets → Pack → Activity family**

Wave 13 focuses on the next structured gap-fill set:
- Grade 2 → `g2_find_the_rule`
- Grades 3–4 → `g34_two_solutions`
- Grades 5–6 → `g56_data_vs_claims`

These are designed to deepen skill coverage instead of only adding new topics.

---

# Pack 37 — Grade 2

## Pack Code
`g2_find_the_rule`

## Pack Role
`core`

## Curriculum Unit
`early_reading_basics`

## Primary Skills
- `instruction_following`
- `patterns`
- `selective_attention`

## Secondary Skills
- `classification`
- `supporting_details`

## Theme
Students follow a simple classroom rule game where they must notice patterns and only choose the items that fit.

## Why this pack exists
This pack strengthens **instruction following**, **pattern recognition**, and **selective attention** in a very concrete Grade 2 way.

## Activity Family

### 1. Storybook reading
- Skill: `supporting_details`
- Type: `storybook_reading`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "friendly_challenge",
  "mission_title": "Descubre la regla del juego",
  "mission_description": "Lee la historia y piensa en cómo la clase siguió la regla.",
  "instructions_es": "Lee las páginas y responde la pregunta.",
  "content": {
    "pages": [
      {
        "id": "p1",
        "title": "Empieza el juego",
        "text": "La maestra puso tarjetas sobre la mesa y dijo: 'Hoy solo elegiremos las que siguen la regla'.",
        "image_prompt": "teacher showing classroom rule cards on table to young students"
      },
      {
        "id": "p2",
        "title": "Todos observan con cuidado",
        "text": "Los niños miraron los dibujos, escucharon otra vez y eligieron solo las tarjetas que sí encajaban en el patrón.",
        "image_prompt": "students carefully selecting matching pattern cards in classroom"
      }
    ],
    "question": {
      "prompt": "¿Qué hizo la clase para jugar bien?",
      "options": [
        { "id": "a", "text": "Escuchó la regla y eligió solo las tarjetas correctas.", "image_url": null },
        { "id": "b", "text": "Mezcló todas las tarjetas sin mirar.", "image_url": null },
        { "id": "c", "text": "Guardó las tarjetas antes de empezar.", "image_url": null }
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
  "instructions_es": "Lee toda la instrucción antes de responder.",
  "content": {
    "passage": "Si la tarjeta tiene una estrella, colócala en la caja amarilla. Si tiene un círculo, colócala en la caja azul.",
    "question": "Si la tarjeta tiene una estrella, ¿qué haces?",
    "options": [
      { "id": "a", "text": "La pongo en la caja amarilla.", "image_url": null },
      { "id": "b", "text": "La pongo en la caja azul.", "image_url": null },
      { "id": "c", "text": "La escondo debajo de la mesa.", "image_url": null },
      { "id": "d", "text": "La rompo en dos partes.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 3. Multiple choice — patterns
- Skill: `patterns`
- Type: `multiple_choice`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "puzzle",
  "mission_title": "Encuentra la regla del patrón",
  "mission_description": "Observa con cuidado y completa la secuencia.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "passage": null,
    "question": "⭐ 🔵 ⭐ 🔵 ___",
    "options": [
      { "id": "a", "text": "⭐", "image_url": null },
      { "id": "b", "text": "⬛", "image_url": null },
      { "id": "c", "text": "🔺", "image_url": null },
      { "id": "d", "text": "🟢", "image_url": null }
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
  "lesson_mood": "friendly_challenge",
  "mission_title": "Toca solo lo que sigue la regla",
  "mission_description": "Mira con cuidado y toca solo las estrellas en el orden en que aparecen.",
  "instructions_es": "Toca solo las estrellas en el orden en que aparecen.",
  "content": {
    "items": [
      { "id": "item_1", "text": "⭐" },
      { "id": "item_2", "text": "🔵" },
      { "id": "item_3", "text": "⭐" },
      { "id": "item_4", "text": "🔺" }
    ],
    "instructions": "Toca solo las estrellas.",
    "time_limit_seconds": 20
  },
  "correct_answer": {
    "sequence": ["item_1", "item_3"]
  }
}
```

---

# Pack 38 — Grades 3–4

## Pack Code
`g34_two_solutions`

## Pack Role
`core`

## Curriculum Unit
`middle_reading_interpretation`

## Primary Skills
- `problem_solving`
- `compare_contrast`
- `decision_making`

## Secondary Skills
- `supporting_details`
- `summarization`

## Theme
Students compare two possible ways to solve the same classroom problem.

## Why this pack exists
This pack strengthens **problem solving** and **decision making** by asking students to compare solution quality, not just identify clues.

## Activity Family

### 1. Illustrated clue reading — compare and contrast
- Skill: `compare_contrast`
- Type: `illustrated_clue`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Compara dos formas de resolver el problema",
  "mission_description": "Lee la situación y decide cuál comparación es mejor.",
  "instructions_es": "Escoge la mejor comparación.",
  "content": {
    "image_prompt": "two student groups solving classroom problem in different ways, one organized and one messy",
    "passage": "Dos grupos debían ordenar materiales antes de la presentación. Un grupo hizo una lista y repartió tareas. El otro empezó sin plan y perdió tiempo buscando cosas.",
    "question": "¿Cuál es la mejor comparación?",
    "options": [
      { "id": "a", "text": "Un grupo se organizó mejor y el otro perdió tiempo por no planear.", "image_url": null },
      { "id": "b", "text": "Los dos grupos trabajaron exactamente igual.", "image_url": null },
      { "id": "c", "text": "El grupo sin plan terminó mucho antes.", "image_url": null },
      { "id": "d", "text": "Ningún grupo necesitaba materiales.", "image_url": null }
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
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Escoge la solución más útil",
  "mission_description": "Piensa cuál forma de actuar ayuda más a resolver el problema.",
  "instructions_es": "Escoge la mejor solución.",
  "content": {
    "passage": "Tu grupo tiene muchos materiales mezclados y la presentación empieza pronto.",
    "question": "¿Qué sería más útil hacer primero?",
    "options": [
      { "id": "a", "text": "Separar materiales y repartir tareas rápidamente.", "image_url": null },
      { "id": "b", "text": "Esperar sin hacer nada.", "image_url": null },
      { "id": "c", "text": "Mezclar aún más todo sobre la mesa.", "image_url": null },
      { "id": "d", "text": "Salir del aula sin avisar.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 3. Multiple choice — decision making
- Skill: `decision_making`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Escoge la mejor decisión del grupo",
  "mission_description": "Piensa qué haría que el trabajo saliera mejor.",
  "instructions_es": "Escoge la mejor decisión.",
  "content": {
    "passage": "Un grupo puede organizarse y repartir tareas, o puede dejar que todos hablen al mismo tiempo sin plan.",
    "question": "¿Qué decisión ayuda más al grupo?",
    "options": [
      { "id": "a", "text": "Repartir tareas y trabajar con un plan.", "image_url": null },
      { "id": "b", "text": "Hablar todos a la vez sin decidir nada.", "image_url": null },
      { "id": "c", "text": "Esconder parte de los materiales.", "image_url": null },
      { "id": "d", "text": "Cambiar de idea cada minuto sin revisar.", "image_url": null }
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
  "lesson_mood": "friendly_challenge",
  "mission_title": "Resume la diferencia principal",
  "mission_description": "Escoge el resumen que mejor explica los dos enfoques.",
  "instructions_es": "Escoge el mejor resumen.",
  "content": {
    "passage": "Dos grupos enfrentaron el mismo problema. El grupo que se organizó avanzó mejor, mientras que el grupo sin plan perdió tiempo y tuvo más dificultades.",
    "question": "¿Cuál es el mejor resumen?",
    "options": [
      { "id": "a", "text": "Tener un plan ayudó a un grupo a resolver mejor el problema que el otro.", "image_url": null },
      { "id": "b", "text": "Los dos grupos resolvieron el problema de la misma manera.", "image_url": null },
      { "id": "c", "text": "Ningún grupo intentó trabajar.", "image_url": null },
      { "id": "d", "text": "El texto trata sobre juegos al aire libre.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Pack 39 — Grades 5–6

## Pack Code
`g56_data_vs_claims`

## Pack Role
`core`

## Curriculum Unit
`upper_advanced_reading`

## Primary Skills
- `evaluating_evidence`
- `fact_vs_opinion`
- `compare_contrast`

## Secondary Skills
- `identifying_purpose`
- `summarization`

## Theme
Students compare a chart/data summary with a bold claim that goes beyond the evidence.

## Why this pack exists
This pack is built to deepen **data interpretation vs unsupported claims**, which is essential for Grades 5–6 reading and media literacy.

## Activity Family

### 1. Illustrated article reading — evaluating evidence
- Skill: `evaluating_evidence`
- Type: `illustrated_clue`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Compara datos y afirmaciones",
  "mission_description": "Lee la información y decide qué idea está mejor respaldada.",
  "instructions_es": "Escoge la afirmación mejor respaldada por los datos.",
  "content": {
    "image_prompt": "student reading simple bar chart next to bold social-media style claim card",
    "passage": "El gráfico muestra que en una encuesta escolar 52% de los estudiantes prefirió leer en silencio, 31% prefirió leer en grupo y 17% eligió audiolibros. Un mensaje dice: '¡Todos los estudiantes prefieren leer en silencio!'",
    "question": "¿Qué afirmación está mejor respaldada?",
    "options": [
      { "id": "a", "text": "Leer en silencio fue la opción más elegida, pero no fue la preferencia de todos.", "image_url": null },
      { "id": "b", "text": "Todos los estudiantes eligieron leer en silencio.", "image_url": null },
      { "id": "c", "text": "Nadie eligió audiolibros.", "image_url": null },
      { "id": "d", "text": "Leer en grupo fue la opción más popular.", "image_url": null }
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
  "mission_title": "Distingue hecho de exageración",
  "mission_description": "Encuentra la afirmación que sí coincide con los datos.",
  "instructions_es": "Escoge cuál afirmación es un hecho.",
  "content": {
    "passage": null,
    "question": "¿Cuál afirmación es un hecho según el gráfico?",
    "options": [
      { "id": "a", "text": "Leer en silencio fue la opción más elegida en la encuesta.", "image_url": null },
      { "id": "b", "text": "Leer en silencio es la única forma correcta de leer.", "image_url": null },
      { "id": "c", "text": "Los audiolibros son la peor opción posible.", "image_url": null },
      { "id": "d", "text": "Toda encuesta escolar siempre demuestra la verdad absoluta.", "image_url": null }
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
  "lesson_mood": "mission",
  "mission_title": "Compara el gráfico y el mensaje",
  "mission_description": "Observa cómo cambia la información entre una fuente y otra.",
  "instructions_es": "Escoge la mejor comparación.",
  "content": {
    "passage": "El gráfico presenta porcentajes específicos. El mensaje usa la palabra 'todos' sin respetar las diferencias mostradas en los datos.",
    "question": "¿Cuál es la mejor comparación?",
    "options": [
      { "id": "a", "text": "El gráfico es más preciso; el mensaje exagera lo que muestran los datos.", "image_url": null },
      { "id": "b", "text": "El mensaje es más exacto que el gráfico.", "image_url": null },
      { "id": "c", "text": "Ambos comunican exactamente la misma idea con la misma precisión.", "image_url": null },
      { "id": "d", "text": "El gráfico no muestra ninguna información útil.", "image_url": null }
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
  "mission_title": "Resume la lección principal",
  "mission_description": "Escoge el resumen que mejor explica el problema del mensaje.",
  "instructions_es": "Escoge el mejor resumen.",
  "content": {
    "passage": "Los datos de una encuesta mostraron varias preferencias distintas, pero un mensaje resumió esa información con una frase exagerada que no coincidía del todo con el gráfico.",
    "question": "¿Cuál es el mejor resumen?",
    "options": [
      { "id": "a", "text": "Los datos mostraban varias opciones, pero el mensaje exageró la conclusión.", "image_url": null },
      { "id": "b", "text": "El gráfico y el mensaje decían cosas completamente iguales.", "image_url": null },
      { "id": "c", "text": "Las encuestas nunca muestran diferencias entre personas.", "image_url": null },
      { "id": "d", "text": "Ningún estudiante respondió la encuesta.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Running Totals After Structured Wave 13

This wave continues the corrected production path by adding:
- stronger Grade 2 evidence for `instruction_following`, `patterns`, `selective_attention`
- stronger Grades 3–4 evidence for `problem_solving`, `decision_making`, `compare_contrast`
- stronger Grades 5–6 evidence for `evaluating_evidence`, `fact_vs_opinion`, `compare_contrast`

## Recommended next structured gap-fill wave
- Grade 2 → `g2_same_and_different`
- Grades 3–4 → `g34_missing_steps`
- Grades 5–6 → `g56_source_strength`

