# Starter Content Packs — Wave 2

This continues the seed draft with the next 3 premium packs:
- Grade 2 → `g2_rainy_day_plans`
- Grades 3–4 → `g34_lost_backpack`
- Grades 5–6 → `g56_school_news_article`

These are written to fit the current backend shape:
- `type`
- `lesson_mood`
- `mission_title`
- `mission_description`
- `instructions_es`
- `content`
- `correct_answer`
- `difficulty`
- `is_diagnostic`

---

# Pack 4 — Grade 2

## Pack Code
`g2_rainy_day_plans`

## Curriculum Unit
`early_reading_basics`

## Domain
`reading`

## Primary Skills
- `sequencing`
- `supporting_details`
- `main_idea`

## Secondary Skills
- `instruction_following`
- `cause_effect`

## Theme
A rainy school morning and how the class adjusts its plans.

## Tone
Warm, familiar, school-centered.

## Core Story
The class planned to play outside, but rain changes the day. Students move activities indoors and follow a new plan.

## Activity Family

### 1. Storybook reading
- Skill: `main_idea`
- Type: `storybook_reading`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Descubre qué cambió en el plan del día",
  "mission_description": "Lee la historia de la mañana lluviosa y descubre la idea principal.",
  "instructions_es": "Lee las páginas y responde la pregunta.",
  "content": {
    "pages": [
      {
        "id": "p1",
        "title": "Una mañana lluviosa",
        "text": "La clase iba a jugar afuera en el recreo. Pero el cielo se nubló y comenzó a llover.",
        "image_prompt": "school yard in rain with children looking through classroom window"
      },
      {
        "id": "p2",
        "title": "Un nuevo plan",
        "text": "La maestra cambió la actividad. Los niños hicieron juegos y lectura dentro del aula.",
        "image_prompt": "students doing indoor activities in classroom while raining outside"
      }
    ],
    "question": {
      "prompt": "¿Cuál es la idea principal de la historia?",
      "options": [
        { "id": "a", "text": "La lluvia cambió los planes y la clase hizo actividades adentro.", "image_url": null },
        { "id": "b", "text": "A todos les gusta la lluvia.", "image_url": null },
        { "id": "c", "text": "El recreo siempre ocurre en el aula.", "image_url": null }
      ]
    }
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 2. Tap sequence — order the new plan
- Skill: `sequencing`
- Type: `tap_sequence`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Ordena lo que pasó",
  "mission_description": "Toca los eventos en el orden correcto.",
  "instructions_es": "Toca los eventos en el orden en que ocurrieron.",
  "content": {
    "items": [
      { "id": "item_1", "text": "Los niños hicieron lectura adentro" },
      { "id": "item_2", "text": "Comenzó a llover" },
      { "id": "item_3", "text": "La clase pensaba jugar afuera" }
    ],
    "instructions": "Toca primero, después y al final.",
    "time_limit_seconds": 25
  },
  "correct_answer": {
    "sequence": ["item_3", "item_2", "item_1"]
  }
}
```

### 3. Multiple choice — supporting detail
- Skill: `supporting_details`
- Type: `multiple_choice`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "friendly_challenge",
  "mission_title": "Busca la pista correcta",
  "mission_description": "Encuentra el detalle que muestra por qué cambió el plan.",
  "instructions_es": "Escoge el detalle correcto.",
  "content": {
    "passage": "El cielo se nubló, cayó lluvia y la maestra decidió que la clase haría actividades adentro.",
    "question": "¿Qué detalle explica por qué no salieron?",
    "options": [
      { "id": "a", "text": "Cayó lluvia.", "image_url": null },
      { "id": "b", "text": "Había libros en el aula.", "image_url": null },
      { "id": "c", "text": "La clase tiene ventanas.", "image_url": null },
      { "id": "d", "text": "Los niños llevaron mochilas.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 4. Multiple choice — instruction following
- Skill: `instruction_following`
- Type: `multiple_choice`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Sigue las instrucciones",
  "mission_description": "Lee con cuidado antes de escoger.",
  "instructions_es": "Lee toda la instrucción antes de responder.",
  "content": {
    "passage": "Si está lloviendo, ve a la biblioteca. Si además tienes un libro azul, siéntate en la mesa redonda.",
    "question": "Si está lloviendo y tienes un libro azul, ¿qué haces?",
    "options": [
      { "id": "a", "text": "Voy a la biblioteca y me siento en la mesa redonda.", "image_url": null },
      { "id": "b", "text": "Salgo al patio.", "image_url": null },
      { "id": "c", "text": "Me quedo de pie en la puerta.", "image_url": null },
      { "id": "d", "text": "Voy a la biblioteca y corro.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Pack 5 — Grades 3–4

## Pack Code
`g34_lost_backpack`

## Curriculum Unit
`middle_reading_interpretation`

## Domain
`reading`

## Primary Skills
- `inference`
- `supporting_details`
- `summarization`

## Secondary Skills
- `decision_making`
- `sequencing`

## Theme
A student tries to figure out where a lost backpack might be.

## Tone
Light mystery, school-centered, clue-based.

## Core Story
A backpack is missing after lunch. The student remembers several clues and uses them to decide where to search.

## Activity Family

### 1. Illustrated clue reading — inference
- Skill: `inference`
- Type: `illustrated_clue`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mystery",
  "mission_title": "Sigue las pistas de la mochila perdida",
  "mission_description": "Lee y descubre el lugar más probable donde está la mochila.",
  "instructions_es": "Usa las pistas para responder.",
  "content": {
    "image_prompt": "school hallway with lockers, cafeteria tray, and a bench near library",
    "passage": "Sofía recordó que dejó su mochila junto al banco cuando fue a devolver un libro. Después fue al comedor y más tarde volvió al salón sin la mochila.",
    "question": "¿Dónde es más probable que esté la mochila?",
    "options": [
      { "id": "a", "text": "Cerca del banco junto a la biblioteca.", "image_url": null },
      { "id": "b", "text": "Debajo de la mesa del comedor.", "image_url": null },
      { "id": "c", "text": "En la oficina del director.", "image_url": null },
      { "id": "d", "text": "En el patio de recreo.", "image_url": null }
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
  "mission_title": "Encuentra la pista más útil",
  "mission_description": "Escoge el detalle que mejor ayuda a resolver el problema.",
  "instructions_es": "Escoge la pista más útil.",
  "content": {
    "passage": "Sofía fue a la biblioteca, dejó su mochila junto a un banco y luego fue al comedor con un libro en la mano.",
    "question": "¿Qué detalle ayuda más a encontrar la mochila?",
    "options": [
      { "id": "a", "text": "Dejó la mochila junto a un banco.", "image_url": null },
      { "id": "b", "text": "Llevaba un libro en la mano.", "image_url": null },
      { "id": "c", "text": "Fue al comedor.", "image_url": null },
      { "id": "d", "text": "Era la hora del almuerzo.", "image_url": null }
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
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mystery",
  "mission_title": "Resume el problema",
  "mission_description": "Escoge el resumen que mejor cuenta lo sucedido.",
  "instructions_es": "Lee y escoge el mejor resumen.",
  "content": {
    "passage": "Después del almuerzo, Sofía no encontraba su mochila. Recordó que había ido a la biblioteca y que la dejó junto a un banco antes de salir.",
    "question": "¿Cuál es el mejor resumen?",
    "options": [
      { "id": "a", "text": "Sofía perdió un libro en el comedor.", "image_url": null },
      { "id": "b", "text": "Sofía intenta recordar dónde dejó su mochila después de ir a la biblioteca.", "image_url": null },
      { "id": "c", "text": "Sofía siempre olvida sus cosas en clase.", "image_url": null },
      { "id": "d", "text": "La biblioteca estaba cerrada durante el almuerzo.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "b"
  }
}
```

### 4. Story strip sequencing
- Skill: `sequencing`
- Type: `story_strip_sequencing`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Pon la búsqueda en orden",
  "mission_description": "Ordena las acciones de Sofía.",
  "instructions_es": "Ordena los eventos en el orden correcto.",
  "content": {
    "cards": [
      { "id": "card_1", "text": "Sofía fue a la biblioteca." },
      { "id": "card_2", "text": "Dejó la mochila junto al banco." },
      { "id": "card_3", "text": "Después notó que no la tenía." }
    ]
  },
  "correct_answer": {
    "sequence": ["card_1", "card_2", "card_3"]
  }
}
```

### 5. Multiple choice — decision making
- Skill: `decision_making`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Escoge la mejor decisión",
  "mission_description": "Piensa cuál sería el mejor próximo paso.",
  "instructions_es": "Escoge la mejor decisión según las pistas.",
  "content": {
    "passage": "Sofía recuerda haber dejado la mochila junto al banco de la biblioteca y aún no ha buscado allí.",
    "question": "¿Qué debería hacer primero?",
    "options": [
      { "id": "a", "text": "Buscar cerca del banco de la biblioteca.", "image_url": null },
      { "id": "b", "text": "Esperar hasta mañana para revisar.", "image_url": null },
      { "id": "c", "text": "Ir al patio sin revisar las pistas.", "image_url": null },
      { "id": "d", "text": "Comprar otra mochila inmediatamente.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Pack 6 — Grades 5–6

## Pack Code
`g56_school_news_article`

## Curriculum Unit
`upper_advanced_reading`

## Domain
`reading`

## Primary Skills
- `identifying_purpose`
- `fact_vs_opinion`
- `evaluating_evidence`

## Secondary Skills
- `compare_contrast`
- `inference`

## Theme
A school news article about a new community recycling project.

## Tone
Informative, article-like, school/community relevance.

## Core Passage Family
An article reports on a recycling campaign launched by the school and includes facts, student comments, and suggested next steps.

## Activity Family

### 1. Illustrated article reading — identifying purpose
- Skill: `identifying_purpose`
- Type: `illustrated_clue`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "science_explore",
  "mission_title": "Lee la noticia escolar",
  "mission_description": "Descubre para qué fue escrito el artículo.",
  "instructions_es": "Lee el artículo y escoge su propósito principal.",
  "content": {
    "image_prompt": "school recycling bins with students and posters about recycling campaign",
    "passage": "La escuela Las Palmas lanzó un proyecto de reciclaje para reducir residuos. Los estudiantes colocaron estaciones de papel, plástico y metal en distintos pasillos. Según la directora, la meta es enseñar hábitos responsables y disminuir la basura en el plantel.",
    "question": "¿Cuál es el propósito principal del artículo?",
    "options": [
      { "id": "a", "text": "Informar sobre un proyecto escolar de reciclaje y sus objetivos.", "image_url": null },
      { "id": "b", "text": "Entretener con una historia inventada sobre basura.", "image_url": null },
      { "id": "c", "text": "Convencer a la gente de dejar de estudiar.", "image_url": null },
      { "id": "d", "text": "Criticar a todos los estudiantes del plantel.", "image_url": null }
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
  "mission_title": "Separa hechos y opiniones",
  "mission_description": "Encuentra la afirmación verificable.",
  "instructions_es": "Escoge cuál afirmación es un hecho.",
  "content": {
    "passage": null,
    "question": "¿Cuál afirmación es un hecho según una noticia escolar?",
    "options": [
      { "id": "a", "text": "El proyecto de reciclaje es la mejor idea del año.", "image_url": null },
      { "id": "b", "text": "Se instalaron estaciones para papel, plástico y metal en los pasillos.", "image_url": null },
      { "id": "c", "text": "Reciclar es mucho más divertido que cualquier otra actividad.", "image_url": null },
      { "id": "d", "text": "Todos los estudiantes aman limpiar siempre.", "image_url": null }
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
  "mission_description": "Piensa qué idea está apoyada por la evidencia del texto.",
  "instructions_es": "Lee el texto y escoge la afirmación mejor respaldada.",
  "content": {
    "passage": "La escuela colocó estaciones de reciclaje en varios pasillos, organizó charlas sobre residuos y entregó carteles informativos a cada curso.",
    "question": "¿Qué afirmación está mejor respaldada?",
    "options": [
      { "id": "a", "text": "La escuela está tomando varias acciones concretas para promover el reciclaje.", "image_url": null },
      { "id": "b", "text": "El proyecto ya eliminó toda la basura de la ciudad.", "image_url": null },
      { "id": "c", "text": "Las charlas fueron canceladas por falta de interés.", "image_url": null },
      { "id": "d", "text": "Nadie en la escuela sabe reciclar.", "image_url": null }
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
  "lesson_mood": "curious",
  "mission_title": "Compara dos fuentes",
  "mission_description": "Observa la diferencia entre una noticia y una opinión.",
  "instructions_es": "Lee y compara los dos textos.",
  "content": {
    "passage": "Texto A: La escuela abrió tres estaciones de reciclaje y comenzó talleres semanales. Texto B: Este proyecto es tan increíble que cambiará el planeta entero de inmediato.",
    "question": "¿Cuál comparación es mejor?",
    "options": [
      { "id": "a", "text": "El texto A informa con datos; el texto B usa una opinión exagerada.", "image_url": null },
      { "id": "b", "text": "Ambos textos presentan hechos con el mismo tono.", "image_url": null },
      { "id": "c", "text": "El texto B es más neutral que el texto A.", "image_url": null },
      { "id": "d", "text": "El texto A es inventado y el texto B es una noticia oficial.", "image_url": null }
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
  "mission_description": "Usa las pistas del artículo para sacar una conclusión.",
  "instructions_es": "Escoge la mejor inferencia.",
  "content": {
    "passage": "Después de una semana, varios cursos pidieron más recipientes de reciclaje porque los existentes se llenaban rápido.",
    "question": "¿Qué se puede inferir?",
    "options": [
      { "id": "a", "text": "Muchos estudiantes están participando en el proyecto.", "image_url": null },
      { "id": "b", "text": "El proyecto fue abandonado el primer día.", "image_url": null },
      { "id": "c", "text": "Los recipientes estaban vacíos toda la semana.", "image_url": null },
      { "id": "d", "text": "La escuela decidió eliminar las estaciones de reciclaje.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Phase 2 Expansion Targets

To move toward hours of content per grade, the next content wave should produce at least:

## Grade 2
- 8 premium packs
- average 8 activities per pack
- total target: 64 linked activities

## Grades 3–4
- 10 premium packs
- average 8 to 10 activities per pack
- total target: 80 to 100 linked activities

## Grades 5–6
- 10 premium packs
- average 8 to 10 activities per pack
- total target: 80 to 100 linked activities

## Estimated Session Coverage
At 5 to 6 activities per session:
- Grade 2 first wave: 10 to 12 sessions
- Grades 3–4 first wave: 14 to 18 sessions
- Grades 5–6 first wave: 14 to 18 sessions

That is enough to start creating meaningful session variety and avoid early repetition.

# What to do next

## Immediate next production step
Continue with:
- Pack 7 → Grade 2: `g2_class_pet`
- Pack 8 → Grade 2: `g2_day_and_night`
- Pack 9 → Grades 3–4: `g34_river_trip`
- Pack 10 → Grades 3–4: `g34_inventors_notebook`
- Pack 11 → Grades 5–6: `g56_plastic_in_the_ocean`
- Pack 12 → Grades 5–6: `g56_ancient_city_discovery`

## Best implementation notes
- create `storybook_reading` and `story_strip_sequencing` support in the frontend renderer
- start actually using `lesson_mood`, `mission_title`, and `mission_description`
- keep one passage/story supporting multiple linked activities
- do not publish isolated questions as the main premium content path

