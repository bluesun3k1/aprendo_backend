# Structured Content Wave 19

This wave continues the **skill-first** production model:

**Grade band → Curriculum unit → Skill targets → Pack → Activity family**

Wave 19 focuses on the next structured gap-fill set:
- Grade 2 → `g2_find_the_match`
- Grades 3–4 → `g34_what_proves_it`
- Grades 5–6 → `g56_reliable_or_not`

These packs continue strengthening under-covered skills with clearer evidence patterns.

---

# Pack 55 — Grade 2

## Pack Code
`g2_find_the_match`

## Pack Role
`core`

## Curriculum Unit
`early_reading_basics`

## Primary Skills
- `classification`
- `visual_discrimination`
- `selective_attention`

## Secondary Skills
- `compare_contrast`
- `supporting_details`

## Theme
Students match classroom objects, pictures, and simple symbols by what goes together.

## Why this pack exists
This pack adds more concrete work on matching, noticing small differences, and choosing what belongs together.

## Activity Family

### 1. Storybook reading
- Skill: `supporting_details`
- Type: `storybook_reading`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Busca lo que combina",
  "mission_description": "Lee la historia y descubre cómo la clase encontró las parejas correctas.",
  "instructions_es": "Lee las páginas y responde la pregunta.",
  "content": {
    "pages": [
      {
        "id": "p1",
        "title": "Tarjetas sobre la mesa",
        "text": "La maestra puso tarjetas con dibujos y palabras. Algunas eran parejas correctas y otras no combinaban.",
        "image_prompt": "teacher showing matching cards with pictures and words on classroom table"
      },
      {
        "id": "p2",
        "title": "Mirar con mucha atención",
        "text": "Los niños observaron formas, colores y significados para encontrar cuáles tarjetas iban juntas.",
        "image_prompt": "young students carefully matching classroom cards by meaning and look"
      }
    ],
    "question": {
      "prompt": "¿Cómo encontró la clase las parejas correctas?",
      "options": [
        { "id": "a", "text": "Miró con atención cuáles tarjetas combinaban.", "image_url": null },
        { "id": "b", "text": "Escogió tarjetas al azar sin mirar.", "image_url": null },
        { "id": "c", "text": "Guardó las tarjetas antes de empezar.", "image_url": null }
      ]
    }
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 2. Multiple choice — classification
- Skill: `classification`
- Type: `multiple_choice`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "puzzle",
  "mission_title": "Escoge la pareja correcta",
  "mission_description": "Piensa qué dos cosas van juntas.",
  "instructions_es": "Escoge la mejor pareja.",
  "content": {
    "passage": null,
    "question": "¿Qué pareja va mejor junta?",
    "options": [
      { "id": "a", "text": "Lápiz y cuaderno", "image_url": null },
      { "id": "b", "text": "Banana y zapato", "image_url": null },
      { "id": "c", "text": "Libro y cucharón", "image_url": null },
      { "id": "d", "text": "Pelota y almohada", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 3. Multiple choice — visual discrimination
- Skill: `visual_discrimination`
- Type: `multiple_choice`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "friendly_challenge",
  "mission_title": "Mira cuál combina de verdad",
  "mission_description": "Observa con cuidado y encuentra el símbolo que hace pareja.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "passage": null,
    "question": "¿Qué hace pareja con 🔺 ?",
    "options": [
      { "id": "a", "text": "🔺", "image_url": null },
      { "id": "b", "text": "⚪", "image_url": null },
      { "id": "c", "text": "⬛", "image_url": null },
      { "id": "d", "text": "⭐", "image_url": null }
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
  "lesson_mood": "mission",
  "mission_title": "Toca solo las parejas útiles",
  "mission_description": "Mira con cuidado y toca solo los útiles escolares.",
  "instructions_es": "Toca solo los útiles escolares en el orden en que aparecen.",
  "content": {
    "items": [
      { "id": "item_1", "text": "Lápiz" },
      { "id": "item_2", "text": "Zapato" },
      { "id": "item_3", "text": "Cuaderno" },
      { "id": "item_4", "text": "Banana" }
    ],
    "instructions": "Toca solo las cosas que sirven para trabajar en clase.",
    "time_limit_seconds": 20
  },
  "correct_answer": {
    "sequence": ["item_1", "item_3"]
  }
}
```

---

# Pack 56 — Grades 3–4

## Pack Code
`g34_what_proves_it`

## Pack Role
`core`

## Curriculum Unit
`middle_reading_interpretation`

## Primary Skills
- `evidence_selection`
- `supporting_details`
- `cause_effect`

## Secondary Skills
- `summarization`
- `inference`

## Theme
Students read short passages and decide what sentence or clue actually proves an answer.

## Why this pack exists
This pack strengthens the jump from “I think so” to “I can point to what proves it.”

## Activity Family

### 1. Illustrated clue reading — evidence selection
- Skill: `evidence_selection`
- Type: `illustrated_clue`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Encuentra qué lo demuestra",
  "mission_description": "Lee el texto y escoge la prueba más clara.",
  "instructions_es": "Escoge la mejor evidencia.",
  "content": {
    "image_prompt": "student highlighting best evidence sentence in short classroom passage",
    "passage": "Después de la tormenta, el árbol del patio tenía ramas caídas, hojas mojadas y tierra removida cerca del tronco.",
    "question": "¿Qué detalle prueba mejor que la tormenta afectó al árbol?",
    "options": [
      { "id": "a", "text": "Tenía ramas caídas.", "image_url": null },
      { "id": "b", "text": "El patio tenía un árbol.", "image_url": null },
      { "id": "c", "text": "La escuela tiene patio.", "image_url": null },
      { "id": "d", "text": "Había hojas cerca del tronco.", "image_url": null }
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
  "mission_title": "Escoge el detalle que sí apoya",
  "mission_description": "Piensa qué detalle sirve mejor para apoyar la idea.",
  "instructions_es": "Escoge el detalle correcto.",
  "content": {
    "passage": "La maestra dijo que la planta necesitaba más agua porque la tierra estaba seca y las hojas se veían caídas.",
    "question": "¿Qué detalle apoya mejor que la planta necesitaba agua?",
    "options": [
      { "id": "a", "text": "La tierra estaba seca y las hojas caídas.", "image_url": null },
      { "id": "b", "text": "La planta estaba en el aula.", "image_url": null },
      { "id": "c", "text": "La maceta era marrón.", "image_url": null },
      { "id": "d", "text": "Había una ventana cerca.", "image_url": null }
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
  "lesson_mood": "calm",
  "mission_title": "Escoge qué demuestra la causa",
  "mission_description": "Piensa qué detalle conecta mejor con lo que pasó.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "passage": "El piso quedó resbaloso porque entró agua de lluvia por la puerta del aula.",
    "question": "¿Qué detalle apoya mejor la causa del piso resbaloso?",
    "options": [
      { "id": "a", "text": "Entró agua de lluvia por la puerta.", "image_url": null },
      { "id": "b", "text": "La clase estaba en el salón.", "image_url": null },
      { "id": "c", "text": "El piso era gris.", "image_url": null },
      { "id": "d", "text": "Había mochilas cerca.", "image_url": null }
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
  "mission_title": "Resume la idea clave",
  "mission_description": "Escoge el mejor resumen de esta práctica.",
  "instructions_es": "Escoge el mejor resumen.",
  "content": {
    "passage": "La lectura enseña que una buena respuesta no solo dice qué pasó, sino también qué detalle lo demuestra mejor.",
    "question": "¿Cuál es el mejor resumen?",
    "options": [
      { "id": "a", "text": "Hay que usar detalles que prueben claramente una idea.", "image_url": null },
      { "id": "b", "text": "Cualquier detalle sirve igual para explicar un texto.", "image_url": null },
      { "id": "c", "text": "No hace falta mostrar pruebas para responder.", "image_url": null },
      { "id": "d", "text": "La lectura trata sobre tormentas solamente.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Pack 57 — Grades 5–6

## Pack Code
`g56_reliable_or_not`

## Pack Role
`core`

## Curriculum Unit
`upper_advanced_reading`

## Primary Skills
- `evaluating_evidence`
- `argument_analysis`
- `compare_contrast`

## Secondary Skills
- `identifying_purpose`
- `fact_vs_opinion`

## Theme
Students compare stronger and weaker messages and decide whether each source feels reliable based on what it shows.

## Why this pack exists
This pack deepens judgment about reliability, not just bias or missing evidence in isolation.

## Activity Family

### 1. Illustrated article reading — evaluating evidence
- Skill: `evaluating_evidence`
- Type: `illustrated_clue`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Decide si la fuente parece confiable",
  "mission_description": "Lee las dos opciones y decide cuál parece más fiable.",
  "instructions_es": "Escoge la fuente más confiable.",
  "content": {
    "image_prompt": "student comparing two source cards, one detailed and one vague promotional message",
    "passage": "Fuente A explica quién hizo el estudio, cuándo, con cuántos participantes y qué resultados encontró. Fuente B dice: 'Miles lo aman, así que seguro funciona' sin mostrar datos.",
    "question": "¿Cuál fuente parece más confiable?",
    "options": [
      { "id": "a", "text": "La Fuente A, porque presenta detalles verificables.", "image_url": null },
      { "id": "b", "text": "La Fuente B, porque usa palabras seguras y populares.", "image_url": null },
      { "id": "c", "text": "Las dos son igual de confiables aunque una no muestre datos.", "image_url": null },
      { "id": "d", "text": "Ninguna fuente puede compararse jamás.", "image_url": null }
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
  "mission_title": "Piensa por qué una fuente parece más fuerte",
  "mission_description": "Escoge la mejor explicación.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "passage": "Una fuente ofrece datos, límites y contexto. La otra repite una promesa sin explicar de dónde sale.",
    "question": "¿Por qué la primera fuente parece más fuerte?",
    "options": [
      { "id": "a", "text": "Porque muestra base para su conclusión en lugar de solo repetir una promesa.", "image_url": null },
      { "id": "b", "text": "Porque usa menos detalles y más emoción.", "image_url": null },
      { "id": "c", "text": "Porque toda promesa es automáticamente evidencia.", "image_url": null },
      { "id": "d", "text": "Porque no importa de dónde salen los resultados.", "image_url": null }
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
  "lesson_mood": "friendly_challenge",
  "mission_title": "Compara dos tipos de fuente",
  "mission_description": "Observa la diferencia entre una fuente explicativa y otra vaga.",
  "instructions_es": "Escoge la mejor comparación.",
  "content": {
    "passage": "Una fuente explica su evidencia. La otra intenta convencer sin mostrar cómo sabe lo que afirma.",
    "question": "¿Cuál es la mejor comparación?",
    "options": [
      { "id": "a", "text": "Una permite revisar su respaldo; la otra pide confiar sin demostrarlo.", "image_url": null },
      { "id": "b", "text": "Las dos muestran el mismo nivel de respaldo.", "image_url": null },
      { "id": "c", "text": "La fuente vaga es mejor porque usa menos palabras.", "image_url": null },
      { "id": "d", "text": "No hay diferencia entre explicar y no explicar evidencia.", "image_url": null }
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
  "lesson_mood": "calm",
  "mission_title": "Separa dato y frase persuasiva",
  "mission_description": "Encuentra la afirmación verificable.",
  "instructions_es": "Escoge cuál afirmación es un hecho.",
  "content": {
    "passage": null,
    "question": "¿Cuál afirmación es un hecho?",
    "options": [
      { "id": "a", "text": "La fuente A incluye cantidad de participantes y fecha del estudio.", "image_url": null },
      { "id": "b", "text": "La fuente B suena mucho más convincente y brillante.", "image_url": null },
      { "id": "c", "text": "Toda fuente popular merece confianza total.", "image_url": null },
      { "id": "d", "text": "La mejor fuente siempre es la más emocionante.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Running Totals After Structured Wave 19

This wave continues the structured gap-fill path by adding:
- stronger Grade 2 evidence for matching, grouping, and careful visual comparison
- stronger Grades 3–4 evidence for proving answers with stronger details
- stronger Grades 5–6 evidence for reliability judgment and source comparison

## Recommended next structured gap-fill wave
- Grade 2 → `g2_same_group`
- Grades 3–4 → `g34_which_detail_matters`
- Grades 5–6 → `g56_fair_or_one_sided`

