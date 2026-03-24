# Structured Content Wave 12

This wave continues the **skill-first** production model:

**Grade band → Curriculum unit → Skill targets → Pack → Activity family**

Wave 12 focuses on the next suggested structured gap-fill set:
- Grade 2 → `g2_listen_and_sort`
- Grades 3–4 → `g34_clue_letters`
- Grades 5–6 → `g56_article_and_ad`

These are designed to strengthen recurring skill gaps instead of only expanding themes.

---

# Pack 34 — Grade 2

## Pack Code
`g2_listen_and_sort`

## Pack Role
`core`

## Curriculum Unit
`early_reading_basics`

## Primary Skills
- `instruction_following`
- `classification`
- `selective_attention`

## Secondary Skills
- `supporting_details`
- `sequencing`

## Theme
Students follow simple listening and sorting directions during a classroom activity.

## Why this pack exists
This pack intentionally increases evidence for **instruction following**, **classification**, and **selective attention** in Grade 2.

## Activity Family

### 1. Storybook reading
- Skill: `supporting_details`
- Type: `storybook_reading`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Sigue la actividad del aula",
  "mission_description": "Lee la historia y descubre qué hizo la clase para ordenar las tarjetas.",
  "instructions_es": "Lee las páginas y responde la pregunta.",
  "content": {
    "pages": [
      {
        "id": "p1",
        "title": "La maestra da una instrucción",
        "text": "La maestra mostró tarjetas de animales, frutas y colores. Dijo que la clase debía escuchar primero y luego poner cada tarjeta en el grupo correcto.",
        "image_prompt": "teacher showing sorting cards with animals fruits and colors in classroom"
      },
      {
        "id": "p2",
        "title": "Todos trabajan con cuidado",
        "text": "Los niños miraron bien cada tarjeta, escucharon otra vez y la colocaron en su grupo sin apurarse.",
        "image_prompt": "children sorting classroom cards carefully into groups"
      }
    ],
    "question": {
      "prompt": "¿Qué hizo la clase para ordenar bien las tarjetas?",
      "options": [
        { "id": "a", "text": "Escuchó con cuidado y puso cada tarjeta en su grupo correcto.", "image_url": null },
        { "id": "b", "text": "Mezcló todas las tarjetas en una sola caja.", "image_url": null },
        { "id": "c", "text": "Ignoró la instrucción y salió del aula.", "image_url": null }
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
  "mission_title": "Sigue la instrucción completa",
  "mission_description": "Lee con cuidado antes de escoger.",
  "instructions_es": "Lee toda la instrucción antes de responder.",
  "content": {
    "passage": "Si ves una fruta, colócala en la caja verde. Si ves un animal, colócalo en la caja azul.",
    "question": "Si la tarjeta dice 'manzana', ¿qué haces?",
    "options": [
      { "id": "a", "text": "La pongo en la caja verde.", "image_url": null },
      { "id": "b", "text": "La pongo en la caja azul.", "image_url": null },
      { "id": "c", "text": "La rompo en dos partes.", "image_url": null },
      { "id": "d", "text": "La escondo debajo de la mesa.", "image_url": null }
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
  "mission_title": "Clasifica las tarjetas",
  "mission_description": "Arrastra cada tarjeta al grupo correcto.",
  "instructions_es": "Arrastra al grupo correcto.",
  "content": {
    "items": [
      { "id": "item_1", "text": "Perro", "image_url": null },
      { "id": "item_2", "text": "Pera", "image_url": null },
      { "id": "item_3", "text": "Gato", "image_url": null },
      { "id": "item_4", "text": "Banana", "image_url": null }
    ],
    "zones": [
      { "id": "zone_a", "label": "Animal" },
      { "id": "zone_b", "label": "Fruta" }
    ],
    "instructions": "Pon cada tarjeta en el grupo correcto."
  },
  "correct_answer": {
    "zones": {
      "zone_a": ["item_1", "item_3"],
      "zone_b": ["item_2", "item_4"]
    }
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
  "mission_title": "Toca solo lo que pertenece",
  "mission_description": "Observa con cuidado y toca solo las frutas en el orden en que aparecen.",
  "instructions_es": "Toca solo las frutas en el orden que aparecen.",
  "content": {
    "items": [
      { "id": "item_1", "text": "Perro" },
      { "id": "item_2", "text": "Pera" },
      { "id": "item_3", "text": "Gato" },
      { "id": "item_4", "text": "Banana" }
    ],
    "instructions": "Toca solo las frutas, sin tocar los animales.",
    "time_limit_seconds": 20
  },
  "correct_answer": {
    "sequence": ["item_2", "item_4"]
  }
}
```

---

# Pack 35 — Grades 3–4

## Pack Code
`g34_clue_letters`

## Pack Role
`core`

## Curriculum Unit
`middle_reading_interpretation`

## Primary Skills
- `inference`
- `context_clues`
- `decision_making`

## Secondary Skills
- `supporting_details`
- `summarization`

## Theme
Students read short note cards and clue letters to solve a simple school mystery.

## Why this pack exists
This pack is designed to strengthen **inference**, **context clues**, and **decision making** using short written clues.

## Activity Family

### 1. Illustrated clue reading — inference
- Skill: `inference`
- Type: `illustrated_clue`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mystery",
  "mission_title": "Lee las pistas de la carta",
  "mission_description": "Usa las pistas para descubrir la mejor respuesta.",
  "instructions_es": "Lee y escoge la mejor inferencia.",
  "content": {
    "image_prompt": "student desk with folded note, school hallway background, clue-style scene",
    "passage": "La nota decía: 'Dejé lo que buscas cerca del lugar donde se guardan los cuentos y donde siempre hay silencio'.",
    "question": "¿A qué lugar se refiere la nota?",
    "options": [
      { "id": "a", "text": "A la biblioteca.", "image_url": null },
      { "id": "b", "text": "Al comedor.", "image_url": null },
      { "id": "c", "text": "Al patio de juegos.", "image_url": null },
      { "id": "d", "text": "A la cancha.", "image_url": null }
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
  "mission_title": "Usa la pista de la palabra",
  "mission_description": "Escoge el significado correcto usando la frase completa.",
  "instructions_es": "Lee y usa las pistas del contexto.",
  "content": {
    "passage": "La nota estaba escondida en un lugar silencioso, entre estantes llenos de cuentos y enciclopedias.",
    "question": "¿Qué significa 'estantes' en este texto?",
    "options": [
      { "id": "a", "text": "Muebles donde se colocan libros", "image_url": null },
      { "id": "b", "text": "Puertas del salón", "image_url": null },
      { "id": "c", "text": "Pasillos del patio", "image_url": null },
      { "id": "d", "text": "Lámparas del techo", "image_url": null }
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
  "mission_title": "Escoge la mejor próxima acción",
  "mission_description": "Piensa qué sería más útil hacer con la pista.",
  "instructions_es": "Escoge la mejor decisión.",
  "content": {
    "passage": "Ya sabes que la nota habla de un lugar silencioso con cuentos y estantes.",
    "question": "¿Qué deberías hacer primero?",
    "options": [
      { "id": "a", "text": "Ir a la biblioteca y buscar allí.", "image_url": null },
      { "id": "b", "text": "Ir al patio sin revisar la pista.", "image_url": null },
      { "id": "c", "text": "Romper la nota porque ya la leíste.", "image_url": null },
      { "id": "d", "text": "Preguntar por una cafetería.", "image_url": null }
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
  "mission_title": "Resume la pista principal",
  "mission_description": "Escoge el resumen que mejor explica la nota.",
  "instructions_es": "Escoge el mejor resumen.",
  "content": {
    "passage": "La nota da pistas sobre un lugar tranquilo donde se guardan libros y cuentos, para ayudar a encontrar un objeto escondido.",
    "question": "¿Cuál es el mejor resumen?",
    "options": [
      { "id": "a", "text": "La nota guía a un lugar silencioso con libros para encontrar algo escondido.", "image_url": null },
      { "id": "b", "text": "La nota explica cómo cocinar en la escuela.", "image_url": null },
      { "id": "c", "text": "La nota habla de deportes en el patio.", "image_url": null },
      { "id": "d", "text": "La nota no da ninguna pista útil.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Pack 36 — Grades 5–6

## Pack Code
`g56_article_and_ad`

## Pack Role
`core`

## Curriculum Unit
`upper_advanced_reading`

## Primary Skills
- `fact_vs_opinion`
- `compare_contrast`
- `identifying_purpose`

## Secondary Skills
- `evaluating_evidence`
- `summarization`

## Theme
Students compare an informational article with a persuasive advertisement about the same product category.

## Why this pack exists
This pack increases **fact vs opinion**, **purpose**, and **comparison of source types**.

## Activity Family

### 1. Illustrated article reading — compare and contrast
- Skill: `compare_contrast`
- Type: `illustrated_clue`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Compara un artículo y un anuncio",
  "mission_description": "Lee ambos textos y decide cuál comparación es mejor.",
  "instructions_es": "Escoge la mejor comparación.",
  "content": {
    "image_prompt": "student comparing a simple article page and colorful advertisement poster for same product category",
    "passage": "Texto A explica cómo funciona una botella reutilizable y qué materiales usa. Texto B dice: '¡La botella más increíble! ¡La mejor opción para todos!'",
    "question": "¿Cuál es la mejor comparación?",
    "options": [
      { "id": "a", "text": "El texto A informa; el texto B intenta convencer usando lenguaje más llamativo.", "image_url": null },
      { "id": "b", "text": "Los dos textos tienen exactamente el mismo propósito.", "image_url": null },
      { "id": "c", "text": "El texto B da más datos técnicos que el texto A.", "image_url": null },
      { "id": "d", "text": "El texto A es solo una opinión sin información.", "image_url": null }
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
  "mission_title": "Separa hechos de opiniones",
  "mission_description": "Encuentra la afirmación verificable.",
  "instructions_es": "Escoge cuál afirmación es un hecho.",
  "content": {
    "passage": null,
    "question": "¿Cuál afirmación es un hecho?",
    "options": [
      { "id": "a", "text": "Esa botella es la más fantástica del mercado.", "image_url": null },
      { "id": "b", "text": "La botella está hecha de acero inoxidable según el artículo.", "image_url": null },
      { "id": "c", "text": "Todas las personas deberían amar ese producto.", "image_url": null },
      { "id": "d", "text": "El diseño es más bonito que cualquier otro del mundo.", "image_url": null }
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
  "mission_title": "Identifica el propósito de cada texto",
  "mission_description": "Piensa por qué se escribió el anuncio.",
  "instructions_es": "Escoge el propósito principal del anuncio.",
  "content": {
    "passage": "El anuncio usa frases como 'la mejor opción' y 'compra hoy' para llamar la atención del lector.",
    "question": "¿Cuál es el propósito principal del anuncio?",
    "options": [
      { "id": "a", "text": "Convencer al lector de comprar el producto.", "image_url": null },
      { "id": "b", "text": "Explicar paso a paso cómo se fabrica el producto.", "image_url": null },
      { "id": "c", "text": "Presentar resultados de una investigación científica.", "image_url": null },
      { "id": "d", "text": "Contar una historia de ficción larga.", "image_url": null }
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
  "mission_title": "Resume la diferencia principal",
  "mission_description": "Escoge el resumen que mejor explica los dos textos.",
  "instructions_es": "Escoge el mejor resumen.",
  "content": {
    "passage": "Un texto informa con datos sobre un producto. El otro usa palabras persuasivas para hacerlo parecer más atractivo y convencer al lector.",
    "question": "¿Cuál es el mejor resumen?",
    "options": [
      { "id": "a", "text": "Uno de los textos informa y el otro busca persuadir con lenguaje más llamativo.", "image_url": null },
      { "id": "b", "text": "Los dos textos son exactamente iguales en tono y propósito.", "image_url": null },
      { "id": "c", "text": "Los dos textos cuentan una historia de aventuras.", "image_url": null },
      { "id": "d", "text": "Ningún texto intenta comunicar una idea al lector.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Running Totals After Structured Wave 12

This continues the corrected production model by adding:
- stronger Grade 2 evidence for `instruction_following`, `classification`, `selective_attention`
- stronger Grades 3–4 evidence for `inference`, `context_clues`, `decision_making`
- stronger Grades 5–6 evidence for `fact_vs_opinion`, `purpose`, and source-type comparison

## Recommended next structured wave
- Grade 2 → `g2_find_the_rule`
- Grades 3–4 → `g34_two_solutions`
- Grades 5–6 → `g56_data_vs_claims`

