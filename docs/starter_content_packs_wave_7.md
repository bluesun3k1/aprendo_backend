# Starter Content Packs — Wave 7

This continues the content production run with the next 3 premium packs:
- Grade 2 → `g2_market_morning`
- Grades 3–4 → `g34_recycling_day`
- Grades 5–6 → `g56_local_news_comparison`

Each pack follows the same structure:
- linked activities
- reusable passage/scene family
- mission framing
- seed-friendly JSON in your current backend shape

---

# Pack 19 — Grade 2

## Pack Code
`g2_market_morning`

## Curriculum Unit
`early_reading_basics`

## Domain
`reading`

## Primary Skills
- `supporting_details`
- `sequencing`
- `main_idea`

## Secondary Skills
- `classification`
- `decision_making`

## Theme
A child goes with a family member to a morning market and observes what happens there.

## Tone
Warm, real-life, colorful, highly visual.

## Core Story
Lucía visits the market, sees fruits and vegetables, helps choose items, and carries a small bag home.

## Activity Family

### 1. Storybook reading
- Skill: `main_idea`
- Type: `storybook_reading`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Acompaña a Lucía al mercado",
  "mission_description": "Lee la historia y descubre lo más importante que pasó en la visita.",
  "instructions_es": "Lee las páginas y responde la pregunta.",
  "content": {
    "pages": [
      {
        "id": "p1",
        "title": "Llegan al mercado",
        "text": "Lucía fue al mercado con su abuela temprano en la mañana. Vio muchas frutas, verduras y personas comprando.",
        "image_prompt": "child and grandmother arriving at colorful morning market with fruits and vegetables"
      },
      {
        "id": "p2",
        "title": "Eligen y llevan compras",
        "text": "La abuela escogió tomates y guineos. Lucía ayudó a llevar una bolsa pequeña de regreso a casa.",
        "image_prompt": "child helping carry a small market bag with groceries"
      }
    ],
    "question": {
      "prompt": "¿Cuál es la idea principal de la historia?",
      "options": [
        { "id": "a", "text": "Lucía acompaña a su abuela al mercado y ayuda con las compras.", "image_url": null },
        { "id": "b", "text": "Lucía pierde una bolsa en el mercado.", "image_url": null },
        { "id": "c", "text": "El mercado estaba vacío toda la mañana.", "image_url": null }
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
  "mission_title": "Busca el detalle correcto",
  "mission_description": "Escoge la pista que apoya la idea principal.",
  "instructions_es": "Lee y escoge el detalle que mejor apoya la idea principal.",
  "content": {
    "passage": "Lucía vio frutas y verduras, y ayudó a llevar una bolsa pequeña después de elegir las compras.",
    "question": "¿Qué detalle muestra que Lucía ayudó?",
    "options": [
      { "id": "a", "text": "Llevó una bolsa pequeña.", "image_url": null },
      { "id": "b", "text": "El mercado tenía techo.", "image_url": null },
      { "id": "c", "text": "Había muchas personas allí.", "image_url": null },
      { "id": "d", "text": "Era por la mañana.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 3. Tap sequence — order the visit
- Skill: `sequencing`
- Type: `tap_sequence`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Ordena la visita al mercado",
  "mission_description": "Toca los pasos en el orden correcto.",
  "instructions_es": "Toca los eventos en el orden correcto.",
  "content": {
    "items": [
      { "id": "item_1", "text": "Llegan al mercado" },
      { "id": "item_2", "text": "Escogen frutas y verduras" },
      { "id": "item_3", "text": "Lucía ayuda a llevar una bolsa" }
    ],
    "instructions": "Toca lo que pasó primero, después y al final.",
    "time_limit_seconds": 25
  },
  "correct_answer": {
    "sequence": ["item_1", "item_2", "item_3"]
  }
}
```

### 4. Drag to sort — fruit or vegetable
- Skill: `classification`
- Type: `drag_to_sort`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "puzzle",
  "mission_title": "Clasifica lo que vieron en el mercado",
  "mission_description": "Arrastra cada tarjeta al grupo correcto.",
  "instructions_es": "Arrastra al grupo correcto.",
  "content": {
    "items": [
      { "id": "item_1", "text": "Guineo", "image_url": null },
      { "id": "item_2", "text": "Tomate", "image_url": null },
      { "id": "item_3", "text": "Manzana", "image_url": null },
      { "id": "item_4", "text": "Zanahoria", "image_url": null }
    ],
    "zones": [
      { "id": "zone_a", "label": "Fruta" },
      { "id": "zone_b", "label": "Verdura" }
    ],
    "instructions": "Pon cada tarjeta en fruta o verdura."
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

# Pack 20 — Grades 3–4

## Pack Code
`g34_recycling_day`

## Curriculum Unit
`middle_reading_interpretation`

## Domain
`reading`

## Primary Skills
- `main_idea`
- `supporting_details`
- `cause_effect`

## Secondary Skills
- `context_clues`
- `decision_making`

## Theme
A school holds a recycling day to teach students how to separate waste correctly.

## Tone
Practical, community-based, action-oriented.

## Core Story
Students bring paper, plastic, and cans, then learn what happens when items are sorted correctly or incorrectly.

## Activity Family

### 1. Illustrated clue reading — main idea
- Skill: `main_idea`
- Type: `illustrated_clue`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Descubre la idea principal del Día del Reciclaje",
  "mission_description": "Lee el texto y encuentra la idea más importante.",
  "instructions_es": "Lee y escoge la idea principal.",
  "content": {
    "image_prompt": "school recycling day with students sorting paper plastic and cans into bins",
    "passage": "En el Día del Reciclaje, la escuela enseñó a separar papel, plástico y latas en recipientes distintos. Los estudiantes aprendieron que clasificar bien los residuos ayuda a reutilizar materiales y reducir basura.",
    "question": "¿Cuál es la idea principal del texto?",
    "options": [
      { "id": "a", "text": "La escuela enseñó a reciclar separando materiales correctamente.", "image_url": null },
      { "id": "b", "text": "Los recipientes eran todos del mismo color.", "image_url": null },
      { "id": "c", "text": "Las latas desaparecen solas en la escuela.", "image_url": null },
      { "id": "d", "text": "Reciclar solo sirve un día al año.", "image_url": null }
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
  "mission_title": "Encuentra la pista importante",
  "mission_description": "Escoge el detalle que mejor apoya la idea principal.",
  "instructions_es": "Escoge el detalle correcto.",
  "content": {
    "passage": "Los estudiantes pusieron papel en un recipiente, plástico en otro y latas en uno diferente.",
    "question": "¿Qué detalle apoya que aprendieron a separar materiales?",
    "options": [
      { "id": "a", "text": "Usaron recipientes distintos para cada material.", "image_url": null },
      { "id": "b", "text": "El patio de la escuela es grande.", "image_url": null },
      { "id": "c", "text": "Algunos niños llevaban mochilas.", "image_url": null },
      { "id": "d", "text": "La actividad ocurrió de mañana.", "image_url": null }
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
  "lesson_mood": "science_explore",
  "mission_title": "Piensa en lo que pasa después",
  "mission_description": "Escoge el mejor efecto de separar bien los residuos.",
  "instructions_es": "Escoge el efecto correcto.",
  "content": {
    "passage": "Cuando el papel, el plástico y las latas se separan correctamente, es más fácil procesarlos para reciclarlos.",
    "question": "¿Cuál es un efecto de separarlos correctamente?",
    "options": [
      { "id": "a", "text": "Es más fácil reciclar los materiales.", "image_url": null },
      { "id": "b", "text": "Los recipientes dejan de existir.", "image_url": null },
      { "id": "c", "text": "La basura se convierte en comida.", "image_url": null },
      { "id": "d", "text": "Todos los objetos cambian de color.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 4. Multiple choice — decision making
- Skill: `decision_making`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Escoge la mejor decisión",
  "mission_description": "Piensa qué harías si no sabes dónde poner un objeto.",
  "instructions_es": "Escoge la mejor decisión.",
  "content": {
    "passage": "Estás en el Día del Reciclaje y no sabes si un envase limpio debe ir con plástico o con papel.",
    "question": "¿Qué sería mejor hacer?",
    "options": [
      { "id": "a", "text": "Preguntar o revisar la etiqueta del recipiente antes de colocarlo.", "image_url": null },
      { "id": "b", "text": "Lanzarlo a cualquier recipiente sin pensar.", "image_url": null },
      { "id": "c", "text": "Tirarlo al suelo para después verlo.", "image_url": null },
      { "id": "d", "text": "Llevarlo a casa sin intentarlo.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Pack 21 — Grades 5–6

## Pack Code
`g56_local_news_comparison`

## Curriculum Unit
`upper_advanced_reading`

## Domain
`reading`

## Primary Skills
- `compare_contrast`
- `fact_vs_opinion`
- `evaluating_evidence`

## Secondary Skills
- `identifying_purpose`
- `inference`

## Theme
Students compare two local news pieces about the same community event and analyze tone, evidence, and reliability.

## Tone
Analytical, civic, media-literacy oriented.

## Core Passage Family
One source reports the facts of a community cleanup event, while another source uses stronger opinions and fewer details.

## Activity Family

### 1. Illustrated article reading — compare and contrast
- Skill: `compare_contrast`
- Type: `illustrated_clue`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Compara dos noticias locales",
  "mission_description": "Lee ambas versiones y decide cuál comparación es mejor.",
  "instructions_es": "Escoge la mejor comparación entre los textos.",
  "content": {
    "image_prompt": "community cleanup event with volunteers, trash bags, and reporter notebook",
    "passage": "Texto A: El sábado participaron 40 voluntarios en una jornada de limpieza del parque central. Texto B: La actividad fue un éxito increíble y todos quedaron totalmente impresionados con el evento.",
    "question": "¿Cuál es la mejor comparación?",
    "options": [
      { "id": "a", "text": "El texto A presenta un dato concreto; el texto B usa una opinión más general y entusiasta.", "image_url": null },
      { "id": "b", "text": "Ambos textos usan el mismo tipo de evidencia y el mismo tono.", "image_url": null },
      { "id": "c", "text": "El texto B ofrece más datos verificables que el texto A.", "image_url": null },
      { "id": "d", "text": "El texto A no informa nada sobre el evento.", "image_url": null }
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
  "mission_title": "Distingue hechos de opiniones",
  "mission_description": "Encuentra la afirmación verificable.",
  "instructions_es": "Escoge cuál afirmación es un hecho.",
  "content": {
    "passage": null,
    "question": "¿Cuál afirmación es un hecho?",
    "options": [
      { "id": "a", "text": "La jornada de limpieza fue la actividad más maravillosa del año.", "image_url": null },
      { "id": "b", "text": "Participaron 40 voluntarios en la jornada del sábado.", "image_url": null },
      { "id": "c", "text": "Todos aman recoger basura en su tiempo libre.", "image_url": null },
      { "id": "d", "text": "El parque quedó perfecto y hermoso para siempre.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "b"
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
  "lesson_mood": "mission",
  "mission_title": "Escoge la afirmación mejor respaldada",
  "mission_description": "Piensa qué idea tiene mejor apoyo en el texto.",
  "instructions_es": "Escoge la afirmación mejor respaldada por el texto.",
  "content": {
    "passage": "El artículo informa el número de voluntarios, menciona el lugar de la actividad y explica que se recogieron bolsas de residuos durante tres horas.",
    "question": "¿Qué afirmación está mejor respaldada?",
    "options": [
      { "id": "a", "text": "La jornada tuvo organización y resultados concretos documentados.", "image_url": null },
      { "id": "b", "text": "La actividad fue la más famosa del país.", "image_url": null },
      { "id": "c", "text": "Nadie logró terminar el trabajo previsto.", "image_url": null },
      { "id": "d", "text": "Los voluntarios borraron por completo todos los problemas del parque.", "image_url": null }
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
  "lesson_mood": "calm",
  "mission_title": "Identifica el propósito de la noticia",
  "mission_description": "Piensa para qué fue escrito el texto informativo.",
  "instructions_es": "Escoge el propósito principal.",
  "content": {
    "passage": "La noticia presenta qué ocurrió en la jornada, quiénes participaron y qué resultados se observaron en el parque.",
    "question": "¿Cuál es el propósito principal del texto?",
    "options": [
      { "id": "a", "text": "Informar sobre un evento comunitario y sus resultados.", "image_url": null },
      { "id": "b", "text": "Inventar una historia humorística sobre el parque.", "image_url": null },
      { "id": "c", "text": "Convencer a las personas de ensuciar más el área.", "image_url": null },
      { "id": "d", "text": "Burlarse de los voluntarios que ayudaron.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Running Totals After Wave 7

With Waves 1–7, the draft set now covers:
- 7 Grade 2 packs
- 7 Grades 3–4 packs
- 7 Grades 5–6 packs

That gives you 21 premium packs in progress across the three main grade bands.

## Next recommended packs
- Grade 2 → `g2_animal_homes`
- Grade 2 → `g2_bus_stop_morning`
- Grades 3–4 → `g34_weather_watchers`
- Grades 3–4 → `g34_park_cleanup`
- Grades 5–6 → `g56_water_use_report`
- Grades 5–6 → `g56_science_fair_article`

