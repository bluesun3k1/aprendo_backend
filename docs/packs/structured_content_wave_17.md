# Structured Content Wave 17

This wave continues the **skill-first** production model:

**Grade band → Curriculum unit → Skill targets → Pack → Activity family**

Wave 17 focuses on the next structured gap-fill set:
- Grade 2 → `g2_which_one_belongs`
- Grades 3–4 → `g34_fact_or_clue`
- Grades 5–6 → `g56_claim_and_counterpoint`

These packs are designed to keep filling real skill gaps with stronger instructional structure and better evidence variety.

---

# Pack 49 — Grade 2

## Pack Code
`g2_which_one_belongs`

## Pack Role
`core`

## Curriculum Unit
`early_reading_basics`

## Primary Skills
- `classification`
- `compare_contrast`
- `visual_discrimination`

## Secondary Skills
- `supporting_details`
- `selective_attention`

## Theme
Students compare small groups of familiar objects and decide which one belongs, which one is different, and why.

## Why this pack exists
This pack gives Grade 2 more practice with **which-one-belongs** logic, visual noticing, and simple compare/contrast decisions.

## Activity Family

### 1. Storybook reading
- Skill: `supporting_details`
- Type: `storybook_reading`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Descubre cuál objeto va con el grupo",
  "mission_description": "Lee la historia y piensa en cómo la clase decidió qué objeto pertenecía.",
  "instructions_es": "Lee las páginas y responde la pregunta.",
  "content": {
    "pages": [
      {
        "id": "p1",
        "title": "Una mesa con objetos",
        "text": "La maestra puso tres frutas y un juguete sobre la mesa. Pidió a la clase mirar con cuidado cuál objeto no iba con el grupo.",
        "image_prompt": "teacher showing table with fruits and one toy to young students"
      },
      {
        "id": "p2",
        "title": "Pensar antes de elegir",
        "text": "Los niños compararon color, forma y uso. Después eligieron el objeto que era diferente a los demás.",
        "image_prompt": "young students comparing familiar objects on classroom table"
      }
    ],
    "question": {
      "prompt": "¿Cómo decidió la clase cuál objeto no iba con el grupo?",
      "options": [
        { "id": "a", "text": "Comparó los objetos y buscó cuál era diferente.", "image_url": null },
        { "id": "b", "text": "Escogió el objeto más grande sin mirar los demás.", "image_url": null },
        { "id": "c", "text": "Guardó todo sin observar nada.", "image_url": null }
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
  "mission_title": "Encuentra cuál no pertenece",
  "mission_description": "Mira el grupo y escoge la opción diferente.",
  "instructions_es": "Escoge cuál no pertenece al grupo.",
  "content": {
    "passage": null,
    "question": "¿Cuál no pertenece al grupo: manzana, pera, pelota, banana?",
    "options": [
      { "id": "a", "text": "Manzana", "image_url": null },
      { "id": "b", "text": "Pera", "image_url": null },
      { "id": "c", "text": "Pelota", "image_url": null },
      { "id": "d", "text": "Banana", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "c"
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
  "mission_title": "Compara antes de responder",
  "mission_description": "Piensa qué tienen en común tres objetos y cuál es diferente.",
  "instructions_es": "Escoge la mejor comparación.",
  "content": {
    "passage": "El lápiz, el crayón y el marcador sirven para escribir o dibujar. La taza sirve para tomar líquidos.",
    "question": "¿Cuál es la mejor respuesta?",
    "options": [
      { "id": "a", "text": "La taza es diferente porque no sirve para escribir o dibujar.", "image_url": null },
      { "id": "b", "text": "Todos sirven para hacer lo mismo.", "image_url": null },
      { "id": "c", "text": "El lápiz es diferente porque no se usa en clase.", "image_url": null },
      { "id": "d", "text": "El marcador es una fruta.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
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
  "mission_title": "Mira con atención",
  "mission_description": "Observa el grupo y encuentra el símbolo diferente.",
  "instructions_es": "Escoge el símbolo diferente.",
  "content": {
    "passage": null,
    "question": "¿Cuál es diferente: 🍎 🍎 🍎 🧸 ?",
    "options": [
      { "id": "a", "text": "El oso de peluche (🧸)", "image_url": null },
      { "id": "b", "text": "La primera manzana", "image_url": null },
      { "id": "c", "text": "La segunda manzana", "image_url": null },
      { "id": "d", "text": "La tercera manzana", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Pack 50 — Grades 3–4

## Pack Code
`g34_fact_or_clue`

## Pack Role
`core`

## Curriculum Unit
`middle_reading_interpretation`

## Primary Skills
- `fact_vs_opinion`
- `evidence_selection`
- `supporting_details`

## Secondary Skills
- `filtering_distractions`
- `inference`

## Theme
Students read short classroom and daily-life texts and decide whether a sentence is a real clue, a fact, or just an extra statement.

## Why this pack exists
This pack bridges Grades 3–4 toward stronger evidence reading by helping students separate **useful clues**, **facts**, and **non-helpful or opinion-like distractors**.

## Activity Family

### 1. Illustrated clue reading — evidence selection
- Skill: `evidence_selection`
- Type: `illustrated_clue`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mystery",
  "mission_title": "Encuentra la pista que sí ayuda",
  "mission_description": "Lee el texto y decide cuál detalle realmente sirve para resolver el problema.",
  "instructions_es": "Escoge la mejor pista.",
  "content": {
    "image_prompt": "student reading short clue list on worksheet with one useful clue and extra details",
    "passage": "Sara buscaba su botella. Recordó que había estado en el laboratorio, que su mochila era morada y que dejó la botella al lado del fregadero antes de salir.",
    "question": "¿Qué detalle es la mejor pista para encontrar la botella?",
    "options": [
      { "id": "a", "text": "La dejó al lado del fregadero antes de salir.", "image_url": null },
      { "id": "b", "text": "Su mochila era morada.", "image_url": null },
      { "id": "c", "text": "Había estado en la escuela.", "image_url": null },
      { "id": "d", "text": "Sara tiene una botella.", "image_url": null }
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
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Distingue dato de opinión",
  "mission_description": "Escoge la afirmación verificable.",
  "instructions_es": "Escoge cuál afirmación es un hecho.",
  "content": {
    "passage": null,
    "question": "¿Cuál afirmación es un hecho?",
    "options": [
      { "id": "a", "text": "La biblioteca es el lugar más bonito de toda la escuela.", "image_url": null },
      { "id": "b", "text": "La biblioteca abre antes del recreo según el horario.", "image_url": null },
      { "id": "c", "text": "Leer allí siempre se siente increíble.", "image_url": null },
      { "id": "d", "text": "Todos deberían amar los libros de misterio.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "b"
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
  "lesson_mood": "friendly_challenge",
  "mission_title": "Ignora lo que no sirve",
  "mission_description": "Escoge el detalle que menos ayuda a resolver el problema.",
  "instructions_es": "Escoge el detalle que no ayuda mucho.",
  "content": {
    "passage": "Luis quiere encontrar su cuaderno. Sabe que estuvo en la sala de música, llevaba medias azules y dejó el cuaderno sobre una silla cerca del piano.",
    "question": "¿Qué detalle ayuda menos?",
    "options": [
      { "id": "a", "text": "Que llevaba medias azules.", "image_url": null },
      { "id": "b", "text": "Que lo dejó sobre una silla cerca del piano.", "image_url": null },
      { "id": "c", "text": "Que estuvo en la sala de música.", "image_url": null },
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
  "mission_title": "Saca una conclusión con la mejor pista",
  "mission_description": "Usa el detalle más fuerte para pensar qué pasó.",
  "instructions_es": "Escoge la mejor inferencia.",
  "content": {
    "passage": "El paraguas de Lucía apareció mojado junto a la puerta del aula después del recreo.",
    "question": "¿Qué se puede inferir?",
    "options": [
      { "id": "a", "text": "Probablemente lo usó o lo llevó alguien después de la lluvia.", "image_url": null },
      { "id": "b", "text": "El paraguas se convirtió en toalla.", "image_url": null },
      { "id": "c", "text": "Nunca hubo lluvia ese día.", "image_url": null },
      { "id": "d", "text": "La puerta desapareció durante el recreo.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Pack 51 — Grades 5–6

## Pack Code
`g56_claim_and_counterpoint`

## Pack Role
`core`

## Curriculum Unit
`upper_advanced_reading`

## Primary Skills
- `argument_analysis`
- `compare_contrast`
- `evaluating_evidence`

## Secondary Skills
- `fact_vs_opinion`
- `identifying_purpose`

## Theme
Students compare a strong claim with a counterpoint that introduces limits, exceptions, or another perspective.

## Why this pack exists
This pack strengthens the ability to read both a **claim** and a **counterpoint**, which is essential for more mature critical reading.

## Activity Family

### 1. Illustrated article reading — argument analysis
- Skill: `argument_analysis`
- Type: `illustrated_clue`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Compara una afirmación y su contrapunto",
  "mission_description": "Lee ambos textos y decide cuál análisis es mejor.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "image_prompt": "student comparing two text cards labeled claim and counterpoint",
    "passage": "Texto A: 'Las tareas digitales son siempre mejores que las tareas en papel'. Texto B: 'Las tareas digitales pueden ayudar en algunos casos, pero no siempre funcionan mejor para todos los estudiantes o para todas las actividades'.",
    "question": "¿Cuál análisis es mejor?",
    "options": [
      { "id": "a", "text": "El Texto B es más equilibrado porque reconoce límites y diferencias entre situaciones.", "image_url": null },
      { "id": "b", "text": "El Texto A es más fuerte porque usar 'siempre' lo hace automáticamente correcto.", "image_url": null },
      { "id": "c", "text": "Los dos textos dicen exactamente lo mismo.", "image_url": null },
      { "id": "d", "text": "El Texto B no presenta ninguna idea útil.", "image_url": null }
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
  "mission_title": "Observa cómo cambian los argumentos",
  "mission_description": "Piensa en la diferencia entre una afirmación absoluta y una respuesta más matizada.",
  "instructions_es": "Escoge la mejor comparación.",
  "content": {
    "passage": "Una afirmación usa la palabra 'siempre'. La otra explica que depende del contexto, del estudiante y de la actividad.",
    "question": "¿Cuál es la mejor comparación?",
    "options": [
      { "id": "a", "text": "Una postura es absoluta y la otra introduce condiciones y límites.", "image_url": null },
      { "id": "b", "text": "Las dos posturas son igual de absolutas.", "image_url": null },
      { "id": "c", "text": "La postura con límites es menos útil por dar más detalles.", "image_url": null },
      { "id": "d", "text": "Ninguna postura intenta responder al tema.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 3. Multiple choice — evaluating evidence
- Skill: `evaluating_evidence`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Escoge la postura mejor apoyada",
  "mission_description": "Piensa cuál idea parece más razonable según la evidencia.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "passage": "La información disponible muestra que algunos estudiantes mejoran con tareas digitales, mientras que otros trabajan mejor con materiales impresos según el tipo de actividad.",
    "question": "¿Cuál postura está mejor respaldada?",
    "options": [
      { "id": "a", "text": "Depende de la situación; no siempre una opción funciona mejor para todos.", "image_url": null },
      { "id": "b", "text": "Las tareas digitales son mejores en cualquier caso y sin excepción.", "image_url": null },
      { "id": "c", "text": "Las tareas impresas nunca sirven para aprender.", "image_url": null },
      { "id": "d", "text": "No hay ninguna diferencia entre estudiantes ni actividades.", "image_url": null }
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
  "lesson_mood": "friendly_challenge",
  "mission_title": "Identifica el propósito del contrapunto",
  "mission_description": "Piensa qué intenta hacer el segundo texto.",
  "instructions_es": "Escoge el propósito principal.",
  "content": {
    "passage": "El segundo texto añade límites, condiciones y otra perspectiva para evitar una conclusión demasiado absoluta.",
    "question": "¿Cuál es el propósito principal del contrapunto?",
    "options": [
      { "id": "a", "text": "Equilibrar la discusión mostrando que la respuesta depende del contexto.", "image_url": null },
      { "id": "b", "text": "Eliminar toda posibilidad de discusión.", "image_url": null },
      { "id": "c", "text": "Insultar a quienes no estén de acuerdo.", "image_url": null },
      { "id": "d", "text": "Cambiar completamente de tema sin relación.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Running Totals After Structured Wave 17

This wave continues the structured gap-fill path by adding:
- stronger Grade 2 evidence for `classification`, `compare_contrast`, and visual noticing
- stronger Grades 3–4 evidence for `fact_vs_opinion`, `evidence_selection`, and filtering distractions
- stronger Grades 5–6 evidence for `argument balance`, `counterpoint reading`, and evidence-based comparison

## Recommended next structured gap-fill wave
- Grade 2 → `g2_rule_or_not`
- Grades 3–4 → `g34_strongest_clue`
- Grades 5–6 → `g56_missing_evidence`

