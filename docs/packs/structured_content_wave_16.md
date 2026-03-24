# Structured Content Wave 16

This wave continues the **skill-first** production model:

**Grade band → Curriculum unit → Skill targets → Pack → Activity family**

Wave 16 focuses on the next structured gap-fill set:
- Grade 2 → `g2_sort_the_signs`
- Grades 3–4 → `g34_clue_or_not`
- Grades 5–6 → `g56_biased_message`

These packs are designed to keep filling real skill gaps with better instructional structure.

---

# Pack 46 — Grade 2

## Pack Code
`g2_sort_the_signs`

## Pack Role
`core`

## Curriculum Unit
`early_reading_basics`

## Primary Skills
- `classification`
- `instruction_following`
- `visual_discrimination`

## Secondary Skills
- `supporting_details`
- `selective_attention`

## Theme
Students look at simple classroom and school signs and sort them by what they mean.

## Why this pack exists
This pack gives Grade 2 stronger practice in **classification**, **following instructions**, and noticing visual differences that matter.

## Activity Family

### 1. Storybook reading
- Skill: `supporting_details`
- Type: `storybook_reading`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Mira las señales del aula",
  "mission_description": "Lee la historia y descubre qué hizo la clase con las señales.",
  "instructions_es": "Lee las páginas y responde la pregunta.",
  "content": {
    "pages": [
      {
        "id": "p1",
        "title": "Señales en la pared",
        "text": "La maestra mostró señales con dibujos y palabras, como 'silencio', 'salida' y 'lavarse las manos'.",
        "image_prompt": "teacher showing simple classroom and school signs with icons and words"
      },
      {
        "id": "p2",
        "title": "Pensar y agrupar",
        "text": "Los niños observaron bien cada señal y las agruparon según lo que indicaban.",
        "image_prompt": "young students sorting simple sign cards into meaning groups"
      }
    ],
    "question": {
      "prompt": "¿Qué hizo la clase con las señales?",
      "options": [
        { "id": "a", "text": "Las observó y las agrupó por significado.", "image_url": null },
        { "id": "b", "text": "Las escondió debajo de los libros.", "image_url": null },
        { "id": "c", "text": "Las mezcló sin mirar ninguna.", "image_url": null }
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
  "mission_title": "Sigue la instrucción del letrero",
  "mission_description": "Lee con cuidado antes de escoger.",
  "instructions_es": "Lee la instrucción y responde.",
  "content": {
    "passage": "Si una señal indica silencio, debes hablar bajito. Si una señal indica salida, debes mirar hacia la puerta correcta.",
    "question": "Si una señal indica silencio, ¿qué haces?",
    "options": [
      { "id": "a", "text": "Hablo bajito.", "image_url": null },
      { "id": "b", "text": "Empiezo a gritar.", "image_url": null },
      { "id": "c", "text": "Corro al patio.", "image_url": null },
      { "id": "d", "text": "Escondo la señal.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 3. Drag to sort — classification
- Skill: `classification`
- Type: `drag_to_sort`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "puzzle",
  "mission_title": "Agrupa las señales",
  "mission_description": "Arrastra cada señal al grupo correcto.",
  "instructions_es": "Arrastra al grupo correcto.",
  "content": {
    "items": [
      { "id": "item_1", "text": "Silencio", "image_url": null },
      { "id": "item_2", "text": "Salida", "image_url": null },
      { "id": "item_3", "text": "Lavarse las manos", "image_url": null },
      { "id": "item_4", "text": "No correr", "image_url": null }
    ],
    "zones": [
      { "id": "zone_a", "label": "Seguridad y movimiento" },
      { "id": "zone_b", "label": "Conducta e higiene" }
    ],
    "instructions": "Pon cada señal en el grupo que mejor corresponde."
  },
  "correct_answer": {
    "zones": {
      "zone_a": ["item_2", "item_4"],
      "zone_b": ["item_1", "item_3"]
    }
  }
}
```

### 4. Multiple choice — visual discrimination
- Skill: `visual_discrimination`
- Type: `multiple_choice`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "friendly_challenge",
  "mission_title": "Encuentra la señal diferente",
  "mission_description": "Observa con cuidado y encuentra la opción que no pertenece al grupo.",
  "instructions_es": "Escoge la opción diferente.",
  "content": {
    "passage": null,
    "question": "¿Cuál es diferente: 🚪 🚪 🚪 🧼 ?",
    "options": [
      { "id": "a", "text": "La señal de manos (🧼)", "image_url": null },
      { "id": "b", "text": "La primera puerta", "image_url": null },
      { "id": "c", "text": "La segunda puerta", "image_url": null },
      { "id": "d", "text": "La tercera puerta", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Pack 47 — Grades 3–4

## Pack Code
`g34_clue_or_not`

## Pack Role
`core`

## Curriculum Unit
`middle_reading_interpretation`

## Primary Skills
- `evidence_selection`
- `supporting_details`
- `filtering_distractions`

## Secondary Skills
- `inference`
- `decision_making`

## Theme
Students read short passages and decide which details are real clues and which are extra information.

## Why this pack exists
This pack strengthens **evidence selection** by forcing students to ignore distractors and focus on the detail that actually matters.

## Activity Family

### 1. Illustrated clue reading — evidence selection
- Skill: `evidence_selection`
- Type: `illustrated_clue`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mystery",
  "mission_title": "Encuentra la pista verdadera",
  "mission_description": "Lee el texto y decide cuál detalle sirve como pista real.",
  "instructions_es": "Escoge la mejor pista.",
  "content": {
    "image_prompt": "student reading clue worksheet with several details, only one clearly useful",
    "passage": "Marcos buscaba su lonchera. Recordó que estuvo en la biblioteca, llevaba zapatos rojos y se sentó cerca de una mesa junto a la ventana antes del recreo.",
    "question": "¿Qué detalle es la pista más útil para encontrar la lonchera?",
    "options": [
      { "id": "a", "text": "Se sentó cerca de una mesa junto a la ventana.", "image_url": null },
      { "id": "b", "text": "Llevaba zapatos rojos.", "image_url": null },
      { "id": "c", "text": "Era antes del recreo.", "image_url": null },
      { "id": "d", "text": "Marcos fue a la escuela.", "image_url": null }
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
  "mission_title": "Elige el detalle que sí ayuda",
  "mission_description": "Escoge el detalle que mejor apoya la respuesta.",
  "instructions_es": "Escoge el detalle correcto.",
  "content": {
    "passage": "Lucía piensa que su paraguas quedó cerca de la puerta porque recuerda haberlo dejado junto al perchero al entrar.",
    "question": "¿Qué detalle apoya mejor esa idea?",
    "options": [
      { "id": "a", "text": "Lo dejó junto al perchero al entrar.", "image_url": null },
      { "id": "b", "text": "El paraguas era azul.", "image_url": null },
      { "id": "c", "text": "Lucía tiene una mochila nueva.", "image_url": null },
      { "id": "d", "text": "Era la mañana.", "image_url": null }
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
  "lesson_mood": "mission",
  "mission_title": "Ignora lo que no ayuda",
  "mission_description": "Piensa qué detalle no sirve para resolver el problema.",
  "instructions_es": "Escoge el detalle que no ayuda.",
  "content": {
    "passage": "Tomás perdió su libro. Sabe que estuvo en la biblioteca, que su camisa era verde y que se sentó en la segunda mesa del fondo.",
    "question": "¿Qué detalle no ayuda mucho a encontrar el libro?",
    "options": [
      { "id": "a", "text": "Que su camisa era verde.", "image_url": null },
      { "id": "b", "text": "Que estuvo en la biblioteca.", "image_url": null },
      { "id": "c", "text": "Que se sentó en la segunda mesa del fondo.", "image_url": null },
      { "id": "d", "text": "Que estaba buscando un libro.", "image_url": null }
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
  "lesson_mood": "calm",
  "mission_title": "Saca una conclusión con las pistas",
  "mission_description": "Usa el detalle más útil para pensar qué pasó.",
  "instructions_es": "Escoge la mejor inferencia.",
  "content": {
    "passage": "El cuaderno de Ana apareció debajo de la mesa donde había estado trabajando antes del almuerzo.",
    "question": "¿Qué se puede inferir?",
    "options": [
      { "id": "a", "text": "Probablemente dejó el cuaderno allí mientras trabajaba.", "image_url": null },
      { "id": "b", "text": "Alguien escondió el cuaderno en otra escuela.", "image_url": null },
      { "id": "c", "text": "Ana nunca usó el cuaderno ese día.", "image_url": null },
      { "id": "d", "text": "La mesa cambió de lugar sola.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Pack 48 — Grades 5–6

## Pack Code
`g56_biased_message`

## Pack Role
`core`

## Curriculum Unit
`upper_advanced_reading`

## Primary Skills
- `argument_analysis`
- `fact_vs_opinion`
- `identifying_purpose`

## Secondary Skills
- `evaluating_evidence`
- `compare_contrast`

## Theme
Students analyze a message with clear bias and compare it to a more neutral explanation.

## Why this pack exists
This pack strengthens **bias detection**, helping students notice tone, one-sided wording, and persuasive framing.

## Activity Family

### 1. Illustrated article reading — argument analysis
- Skill: `argument_analysis`
- Type: `illustrated_clue`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Detecta el mensaje sesgado",
  "mission_description": "Lee los textos y decide cuál muestra más sesgo.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "image_prompt": "student comparing strong opinion post and neutral informational paragraph side by side",
    "passage": "Texto A: 'Solo una persona sin criterio estaría en desacuerdo con este plan. Es claramente perfecto'. Texto B: 'El plan tiene beneficios, pero también algunos desafíos que deben revisarse'.",
    "question": "¿Cuál texto muestra más sesgo?",
    "options": [
      { "id": "a", "text": "El Texto A, porque usa lenguaje extremo y no reconoce otras posibilidades.", "image_url": null },
      { "id": "b", "text": "El Texto B, porque menciona beneficios y desafíos.", "image_url": null },
      { "id": "c", "text": "Los dos muestran el mismo nivel de neutralidad.", "image_url": null },
      { "id": "d", "text": "Ninguno intenta expresar una postura.", "image_url": null }
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
  "mission_title": "Separa hecho de postura",
  "mission_description": "Encuentra la afirmación verificable.",
  "instructions_es": "Escoge cuál afirmación es un hecho.",
  "content": {
    "passage": null,
    "question": "¿Cuál afirmación es un hecho?",
    "options": [
      { "id": "a", "text": "El plan es la idea más brillante jamás creada.", "image_url": null },
      { "id": "b", "text": "El informe menciona beneficios y desafíos del plan.", "image_url": null },
      { "id": "c", "text": "Quien no esté de acuerdo está completamente equivocado.", "image_url": null },
      { "id": "d", "text": "Toda crítica al plan es absurda.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "b"
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
  "mission_title": "Identifica la intención del mensaje",
  "mission_description": "Piensa qué busca hacer el texto sesgado.",
  "instructions_es": "Escoge el propósito principal.",
  "content": {
    "passage": "El texto usa frases extremas y ataca a quienes no están de acuerdo para empujar al lector a aceptar una sola postura.",
    "question": "¿Cuál es el propósito principal del texto sesgado?",
    "options": [
      { "id": "a", "text": "Convencer al lector usando presión y lenguaje extremo.", "image_url": null },
      { "id": "b", "text": "Presentar una revisión neutral de pros y contras.", "image_url": null },
      { "id": "c", "text": "Explicar datos de una investigación científica.", "image_url": null },
      { "id": "d", "text": "Mostrar dos lados del tema con equilibrio.", "image_url": null }
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
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Compara mensaje sesgado y mensaje neutral",
  "mission_description": "Observa cómo cambia el tono entre ambos textos.",
  "instructions_es": "Escoge la mejor comparación.",
  "content": {
    "passage": "El mensaje sesgado usa palabras absolutas y ataques. El mensaje neutral reconoce ventajas y problemas sin insultar a nadie.",
    "question": "¿Cuál es la mejor comparación?",
    "options": [
      { "id": "a", "text": "Uno presiona y exagera; el otro explica de forma más equilibrada.", "image_url": null },
      { "id": "b", "text": "Los dos usan exactamente el mismo tono.", "image_url": null },
      { "id": "c", "text": "El mensaje neutral es más agresivo que el sesgado.", "image_url": null },
      { "id": "d", "text": "Ninguno intenta influir en el lector.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Running Totals After Structured Wave 16

This wave continues the structured gap-fill path by adding:
- stronger Grade 2 evidence for `classification`, `instruction_following`, `visual_discrimination`
- stronger Grades 3–4 evidence for `evidence_selection`, `filtering_distractions`, and clue quality
- stronger Grades 5–6 evidence for `bias detection`, `argument analysis`, and message purpose

## Recommended next structured gap-fill wave
- Grade 2 → `g2_which_one_belongs`
- Grades 3–4 → `g34_fact_or_clue`
- Grades 5–6 → `g56_claim_and_counterpoint`

