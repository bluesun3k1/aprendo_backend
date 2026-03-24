# Structured Content Wave 20

This wave continues the **skill-first** production model:

**Grade band → Curriculum unit → Skill targets → Pack → Activity family**

Wave 20 focuses on the next structured gap-fill set:
- Grade 2 → `g2_same_group`
- Grades 3–4 → `g34_which_detail_matters`
- Grades 5–6 → `g56_fair_or_one_sided`

These packs continue strengthening under-covered skills with clearer evidence patterns and more deliberate reasoning practice.

---

# Pack 58 — Grade 2

## Pack Code
`g2_same_group`

## Pack Role
`core`

## Curriculum Unit
`early_reading_basics`

## Primary Skills
- `classification`
- `compare_contrast`
- `selective_attention`

## Secondary Skills
- `visual_discrimination`
- `supporting_details`

## Theme
Students look at groups of familiar objects and decide which items belong together and why.

## Why this pack exists
This pack gives Grade 2 more practice in grouping by shared traits, noticing which items match, and ignoring items that do not fit.

## Activity Family

### 1. Storybook reading
- Skill: `supporting_details`
- Type: `storybook_reading`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Busca el grupo correcto",
  "mission_description": "Lee la historia y descubre cómo la clase formó grupos con los objetos.",
  "instructions_es": "Lee las páginas y responde la pregunta.",
  "content": {
    "pages": [
      {
        "id": "p1",
        "title": "Objetos sobre la alfombra",
        "text": "La maestra puso frutas, útiles escolares y juguetes sobre la alfombra. Después pidió buscar qué cosas iban juntas.",
        "image_prompt": "teacher placing fruits school supplies and toys on classroom rug"
      },
      {
        "id": "p2",
        "title": "Comparar para agrupar",
        "text": "Los niños miraron para qué servía cada cosa y la pusieron en el grupo correcto.",
        "image_prompt": "young students grouping classroom objects by category"
      }
    ],
    "question": {
      "prompt": "¿Cómo hizo la clase para formar los grupos?",
      "options": [
        { "id": "a", "text": "Pensó para qué servía cada cosa y la agrupó con las parecidas.", "image_url": null },
        { "id": "b", "text": "Mezcló todo sin observar nada.", "image_url": null },
        { "id": "c", "text": "Guardó los objetos antes de empezar.", "image_url": null }
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
  "mission_title": "Escoge qué va en el mismo grupo",
  "mission_description": "Piensa qué objeto pertenece con los otros.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "passage": null,
    "question": "¿Qué pertenece con cuaderno, lápiz y borrador?",
    "options": [
      { "id": "a", "text": "Regla", "image_url": null },
      { "id": "b", "text": "Banana", "image_url": null },
      { "id": "c", "text": "Pelota", "image_url": null },
      { "id": "d", "text": "Muñeca", "image_url": null }
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
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Compara dos grupos",
  "mission_description": "Piensa qué tienen en común y qué no.",
  "instructions_es": "Escoge la mejor comparación.",
  "content": {
    "passage": "La banana y la manzana se comen. El lápiz se usa para escribir.",
    "question": "¿Cuál es la mejor respuesta?",
    "options": [
      { "id": "a", "text": "La banana y la manzana van juntas porque son frutas; el lápiz es diferente.", "image_url": null },
      { "id": "b", "text": "Los tres objetos sirven para escribir.", "image_url": null },
      { "id": "c", "text": "La manzana y el lápiz son el mismo tipo de objeto.", "image_url": null },
      { "id": "d", "text": "Nada puede agruparse con nada.", "image_url": null }
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
  "mission_title": "Toca solo el mismo grupo",
  "mission_description": "Observa con cuidado y toca solo las frutas en el orden en que aparecen.",
  "instructions_es": "Toca solo las frutas en el orden que aparecen.",
  "content": {
    "items": [
      { "id": "item_1", "text": "Pelota" },
      { "id": "item_2", "text": "Banana" },
      { "id": "item_3", "text": "Lápiz" },
      { "id": "item_4", "text": "Manzana" }
    ],
    "instructions": "Toca solo las frutas.",
    "time_limit_seconds": 20
  },
  "correct_answer": {
    "sequence": ["item_2", "item_4"]
  }
}
```

---

# Pack 59 — Grades 3–4

## Pack Code
`g34_which_detail_matters`

## Pack Role
`core`

## Curriculum Unit
`middle_reading_interpretation`

## Primary Skills
- `supporting_details`
- `evidence_selection`
- `filtering_distractions`

## Secondary Skills
- `inference`
- `summarization`

## Theme
Students compare several details in short passages and decide which one actually matters for answering the question.

## Why this pack exists
This pack sharpens the difference between a detail that is simply present and a detail that is actually useful.

## Activity Family

### 1. Illustrated clue reading — supporting details
- Skill: `supporting_details`
- Type: `illustrated_clue`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Descubre qué detalle importa",
  "mission_description": "Lee el texto y escoge el detalle que mejor ayuda a responder.",
  "instructions_es": "Escoge el detalle más útil.",
  "content": {
    "image_prompt": "student reading short passage with several highlighted details, only one truly relevant",
    "passage": "El gato de Sofía no apareció en la sala. Ella recordó que la ventana estaba abierta y que había visto huellas pequeñas cerca del jardín.",
    "question": "¿Qué detalle importa más para pensar dónde está el gato?",
    "options": [
      { "id": "a", "text": "La ventana estaba abierta y había huellas cerca del jardín.", "image_url": null },
      { "id": "b", "text": "Sofía tiene un gato.", "image_url": null },
      { "id": "c", "text": "La sala existe en la casa.", "image_url": null },
      { "id": "d", "text": "Las huellas eran pequeñas.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 2. Multiple choice — evidence selection
- Skill: `evidence_selection`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "friendly_challenge",
  "mission_title": "Elige la prueba más clara",
  "mission_description": "Piensa qué detalle apoya mejor la respuesta.",
  "instructions_es": "Escoge la mejor evidencia.",
  "content": {
    "passage": "María piensa que dejó su merienda en la biblioteca porque recuerda haberla puesto sobre la mesa redonda del rincón de lectura.",
    "question": "¿Qué detalle demuestra mejor esa idea?",
    "options": [
      { "id": "a", "text": "La puso sobre la mesa redonda del rincón de lectura.", "image_url": null },
      { "id": "b", "text": "La merienda estaba en una lonchera.", "image_url": null },
      { "id": "c", "text": "María fue a la escuela ese día.", "image_url": null },
      { "id": "d", "text": "La biblioteca tiene libros.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 3. Multiple choice — filtering distractions
- Skill: `filtering_distractions`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Ignora el detalle extra",
  "mission_description": "Escoge el detalle que menos ayuda a responder.",
  "instructions_es": "Escoge el detalle menos útil.",
  "content": {
    "passage": "Andrés busca su cuaderno. Sabe que estuvo en el laboratorio, que llevaba tenis blancos y que lo dejó cerca del microscopio.",
    "question": "¿Qué detalle ayuda menos?",
    "options": [
      { "id": "a", "text": "Que llevaba tenis blancos.", "image_url": null },
      { "id": "b", "text": "Que lo dejó cerca del microscopio.", "image_url": null },
      { "id": "c", "text": "Que estuvo en el laboratorio.", "image_url": null },
      { "id": "d", "text": "Que estaba buscando un cuaderno.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 4. Multiple choice — inference
- Skill: `inference`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Piensa qué se puede concluir",
  "mission_description": "Usa el detalle que importa para sacar una conclusión.",
  "instructions_es": "Escoge la mejor inferencia.",
  "content": {
    "passage": "La mochila de Carla apareció justo al lado del banco donde había esperado antes de entrar a clase.",
    "question": "¿Qué se puede inferir?",
    "options": [
      { "id": "a", "text": "Probablemente la dejó allí mientras esperaba.", "image_url": null },
      { "id": "b", "text": "La mochila caminó sola hasta el banco.", "image_url": null },
      { "id": "c", "text": "Carla nunca llevó mochila a la escuela.", "image_url": null },
      { "id": "d", "text": "El banco se movió hasta la mochila.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Pack 60 — Grades 5–6

## Pack Code
`g56_fair_or_one_sided`

## Pack Role
`core`

## Curriculum Unit
`upper_advanced_reading`

## Primary Skills
- `argument_analysis`
- `compare_contrast`
- `bias_detection`

## Secondary Skills
- `identifying_purpose`
- `evaluating_evidence`

## Theme
Students compare a balanced discussion with a one-sided message and decide which one is fairer and why.

## Why this pack exists
This pack deepens upper-band critical reading by helping students identify when a text is fair and when it only pushes one side.

## Activity Family

### 1. Illustrated clue reading — argument analysis
- Skill: `argument_analysis`
- Type: `illustrated_clue`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Decide si el texto es justo o parcial",
  "mission_description": "Lee ambos mensajes y decide cuál es más equilibrado.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "image_prompt": "student comparing balanced article and one-sided opinion post side by side",
    "passage": "Texto A presenta ventajas y desventajas de un nuevo horario escolar. Texto B solo dice que el horario es terrible y que nadie inteligente podría apoyarlo.",
    "question": "¿Cuál texto es más justo o equilibrado?",
    "options": [
      { "id": "a", "text": "El Texto A, porque muestra más de un lado del tema.", "image_url": null },
      { "id": "b", "text": "El Texto B, porque insulta a quienes no piensan igual.", "image_url": null },
      { "id": "c", "text": "Los dos son igual de equilibrados.", "image_url": null },
      { "id": "d", "text": "Ninguno expresa una postura.", "image_url": null }
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
  "lesson_mood": "mission",
  "mission_title": "Compara equilibrio y parcialidad",
  "mission_description": "Piensa qué diferencia mejor a los dos textos.",
  "instructions_es": "Escoge la mejor comparación.",
  "content": {
    "passage": "Un texto presenta ventajas y desventajas. El otro solo repite una postura negativa y ataca a quienes opinan diferente.",
    "question": "¿Cuál es la mejor comparación?",
    "options": [
      { "id": "a", "text": "Uno es más equilibrado y el otro es más parcial y agresivo.", "image_url": null },
      { "id": "b", "text": "Los dos ofrecen el mismo nivel de equilibrio.", "image_url": null },
      { "id": "c", "text": "El texto parcial es más justo porque es más fuerte.", "image_url": null },
      { "id": "d", "text": "Ninguno intenta convencer al lector.", "image_url": null }
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
  "lesson_mood": "friendly_challenge",
  "mission_title": "Identifica la intención del mensaje parcial",
  "mission_description": "Piensa qué intenta hacer el texto más agresivo.",
  "instructions_es": "Escoge el propósito principal.",
  "content": {
    "passage": "El texto parcial usa palabras fuertes y ataques personales para empujar al lector a aceptar una sola posición.",
    "question": "¿Cuál es su propósito principal?",
    "options": [
      { "id": "a", "text": "Convencer al lector sin mostrar un tratamiento equilibrado del tema.", "image_url": null },
      { "id": "b", "text": "Presentar información completa de ambos lados.", "image_url": null },
      { "id": "c", "text": "Explicar datos de una investigación científica.", "image_url": null },
      { "id": "d", "text": "Mostrar límites y dudas con cuidado.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 4. Multiple choice — evaluating evidence
- Skill: `evaluating_evidence`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Escoge qué texto parece más confiable",
  "mission_description": "Piensa cuál texto ayuda más a entender el tema.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "passage": "El texto equilibrado da razones a favor y en contra. El texto parcial solo ataca una postura y no explica la otra.",
    "question": "¿Cuál texto parece más útil para pensar mejor sobre el tema?",
    "options": [
      { "id": "a", "text": "El texto equilibrado, porque permite considerar más de una perspectiva.", "image_url": null },
      { "id": "b", "text": "El texto parcial, porque es más ruidoso y extremo.", "image_url": null },
      { "id": "c", "text": "Los dos ayudan exactamente igual.", "image_url": null },
      { "id": "d", "text": "Ningún texto puede compararse con otro.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Running Totals After Structured Wave 20

This wave continues the structured gap-fill path by adding:
- stronger Grade 2 evidence for grouping by similarity and careful matching
- stronger Grades 3–4 evidence for deciding which detail actually matters
- stronger Grades 5–6 evidence for balanced vs one-sided argument reading

## Recommended next structured gap-fill wave
- Grade 2 → `g2_match_the_rule`
- Grades 3–4 → `g34_which_sentence_helps`
- Grades 5–6 → `g56_loaded_language`

