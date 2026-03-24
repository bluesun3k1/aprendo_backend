# Starter Content Packs — Wave 5

This continues the content production run with the next 3 premium packs:
- Grade 2 → `g2_helping_a_friend`
- Grades 3–4 → `g34_growing_plants`
- Grades 5–6 → `g56_weather_warning_followup`

Each pack follows the same structure:
- linked activities
- reusable passage/scene family
- mission framing
- seed-friendly JSON in your current backend shape

---

# Pack 13 — Grade 2

## Pack Code
`g2_helping_a_friend`

## Curriculum Unit
`early_reading_basics`

## Domain
`reading`

## Primary Skills
- `main_idea`
- `cause_effect`
- `sequencing`

## Secondary Skills
- `supporting_details`
- `decision_making`

## Theme
A child notices a friend needs help and decides what to do.

## Tone
Warm, social-emotional, classroom-centered.

## Core Story
Nora sees her friend Mateo drop his papers and feel worried. She helps him pick them up and they arrive ready for class.

## Activity Family

### 1. Storybook reading
- Skill: `main_idea`
- Type: `storybook_reading`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "friendly_challenge",
  "mission_title": "Descubre cómo Nora ayuda a su amigo",
  "mission_description": "Lee la historia y piensa en la idea más importante.",
  "instructions_es": "Lee las páginas y responde la pregunta.",
  "content": {
    "pages": [
      {
        "id": "p1",
        "title": "Un problema en el pasillo",
        "text": "Mateo dejó caer sus hojas en el pasillo. Se veía preocupado porque la clase iba a empezar.",
        "image_prompt": "school hallway with child dropping papers and looking worried"
      },
      {
        "id": "p2",
        "title": "Nora decide ayudar",
        "text": "Nora se agachó, recogió varias hojas y ayudó a Mateo a ordenar todo rápido.",
        "image_prompt": "two children picking up papers together in school hallway"
      }
    ],
    "question": {
      "prompt": "¿Cuál es la idea principal de la historia?",
      "options": [
        { "id": "a", "text": "Nora ayuda a un amigo que tiene un problema.", "image_url": null },
        { "id": "b", "text": "Las hojas vuelan por sí solas.", "image_url": null },
        { "id": "c", "text": "Mateo no tiene clases hoy.", "image_url": null }
      ]
    }
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 2. Multiple choice — cause and effect
- Skill: `cause_effect`
- Type: `multiple_choice`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Relaciona lo que pasó",
  "mission_description": "Encuentra el efecto correcto de lo que ocurrió.",
  "instructions_es": "Escoge el mejor efecto.",
  "content": {
    "passage": "Mateo dejó caer sus hojas en el pasillo. Entonces Nora se detuvo para ayudarlo.",
    "question": "¿Cuál fue un efecto de que Mateo dejara caer sus hojas?",
    "options": [
      { "id": "a", "text": "Nora se detuvo para ayudarlo.", "image_url": null },
      { "id": "b", "text": "La escuela cerró temprano.", "image_url": null },
      { "id": "c", "text": "Las hojas desaparecieron.", "image_url": null },
      { "id": "d", "text": "Mateo salió al patio a jugar.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 3. Tap sequence — order the events
- Skill: `sequencing`
- Type: `tap_sequence`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Pon la historia en orden",
  "mission_description": "Toca primero, después y al final.",
  "instructions_es": "Toca los eventos en el orden correcto.",
  "content": {
    "items": [
      { "id": "item_1", "text": "Nora ayudó a recoger las hojas" },
      { "id": "item_2", "text": "Mateo dejó caer sus papeles" },
      { "id": "item_3", "text": "Los dos quedaron listos para entrar a clase" }
    ],
    "instructions": "Toca los eventos en el orden en que ocurrieron.",
    "time_limit_seconds": 25
  },
  "correct_answer": {
    "sequence": ["item_2", "item_1", "item_3"]
  }
}
```

### 4. Multiple choice — decision making
- Skill: `decision_making`
- Type: `multiple_choice`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Escoge la mejor decisión",
  "mission_description": "Piensa qué harías para ayudar mejor.",
  "instructions_es": "Escoge la mejor decisión.",
  "content": {
    "passage": "Tu amigo dejó caer sus cuadernos y se ve preocupado porque el timbre va a sonar.",
    "question": "¿Qué sería mejor hacer?",
    "options": [
      { "id": "a", "text": "Ayudar a recogerlos rápidamente.", "image_url": null },
      { "id": "b", "text": "Reírse y seguir caminando.", "image_url": null },
      { "id": "c", "text": "Patear los cuadernos sin querer.", "image_url": null },
      { "id": "d", "text": "Esconderse detrás de la puerta.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Pack 14 — Grades 3–4

## Pack Code
`g34_growing_plants`

## Curriculum Unit
`middle_reading_interpretation`

## Domain
`reading`

## Primary Skills
- `sequencing`
- `supporting_details`
- `summarization`

## Secondary Skills
- `cause_effect`
- `context_clues`

## Theme
A class grows bean plants and records what helps them grow.

## Tone
Curious, science-based, observational.

## Core Story
Students plant seeds, water them, place them near sunlight, and observe changes over several days.

## Activity Family

### 1. Illustrated clue reading — summarization
- Skill: `summarization`
- Type: `illustrated_clue`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "science_explore",
  "mission_title": "Observa cómo crecen las plantas",
  "mission_description": "Lee lo que hizo la clase y elige el mejor resumen.",
  "instructions_es": "Lee y escoge el mejor resumen.",
  "content": {
    "image_prompt": "students growing bean plants in cups near a sunny classroom window",
    "passage": "La clase sembró semillas de habichuela en vasos con tierra. Cada día les echaron agua y las pusieron cerca de una ventana con luz. Después de varios días, salieron tallos verdes.",
    "question": "¿Cuál es el mejor resumen?",
    "options": [
      { "id": "a", "text": "La clase sembró semillas, las cuidó y vio cómo crecían.", "image_url": null },
      { "id": "b", "text": "Las semillas nunca cambiaron.", "image_url": null },
      { "id": "c", "text": "La ventana era muy grande.", "image_url": null },
      { "id": "d", "text": "Los vasos estaban vacíos todo el tiempo.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 2. Story strip sequencing
- Skill: `sequencing`
- Type: `story_strip_sequencing`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Ordena el crecimiento de la planta",
  "mission_description": "Pon los pasos del experimento en el orden correcto.",
  "instructions_es": "Ordena las tarjetas en el orden correcto.",
  "content": {
    "cards": [
      { "id": "card_1", "text": "La clase sembró las semillas." },
      { "id": "card_2", "text": "Regaron y pusieron los vasos cerca de la luz." },
      { "id": "card_3", "text": "Aparecieron tallos verdes." }
    ]
  },
  "correct_answer": {
    "sequence": ["card_1", "card_2", "card_3"]
  }
}
```

### 3. Multiple choice — supporting details
- Skill: `supporting_details`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "friendly_challenge",
  "mission_title": "Encuentra el detalle importante",
  "mission_description": "Escoge la pista que explica cómo ayudaron a crecer las plantas.",
  "instructions_es": "Escoge el detalle que mejor apoya la idea principal.",
  "content": {
    "passage": "La clase echó agua a las semillas cada día y colocó los vasos cerca de una ventana soleada.",
    "question": "¿Qué detalle muestra cómo ayudaron a crecer las plantas?",
    "options": [
      { "id": "a", "text": "Las pusieron cerca de la luz y las regaron cada día.", "image_url": null },
      { "id": "b", "text": "Los vasos eran transparentes.", "image_url": null },
      { "id": "c", "text": "La clase tenía muchas sillas.", "image_url": null },
      { "id": "d", "text": "La puerta del aula estaba abierta.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 4. Multiple choice — cause and effect
- Skill: `cause_effect`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "science_explore",
  "mission_title": "Piensa en causa y efecto",
  "mission_description": "Observa qué pasó y por qué.",
  "instructions_es": "Escoge el mejor efecto.",
  "content": {
    "passage": "Las semillas recibieron agua y luz durante varios días.",
    "question": "¿Cuál fue un efecto de eso?",
    "options": [
      { "id": "a", "text": "Comenzaron a salir tallos verdes.", "image_url": null },
      { "id": "b", "text": "La ventana se movió sola.", "image_url": null },
      { "id": "c", "text": "Los vasos se volvieron de metal.", "image_url": null },
      { "id": "d", "text": "La tierra desapareció por completo.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Pack 15 — Grades 5–6

## Pack Code
`g56_weather_warning_followup`

## Curriculum Unit
`upper_advanced_reading`

## Domain
`reading`

## Primary Skills
- `evaluating_evidence`
- `decision_making`
- `identifying_purpose`

## Secondary Skills
- `fact_vs_opinion`
- `compare_contrast`

## Theme
A follow-up article after a weather warning explains which precautions helped and what the community learned.

## Tone
Informative, civic, evidence-based.

## Core Passage Family
After the storm, the school reviews which safety actions were useful and compares rumors with official information.

## Activity Family

### 1. Illustrated article reading — evaluating evidence
- Skill: `evaluating_evidence`
- Type: `illustrated_clue`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Evalúa lo que funcionó después de la tormenta",
  "mission_description": "Lee la información y decide qué conclusión está mejor respaldada.",
  "instructions_es": "Escoge la conclusión mejor respaldada por el texto.",
  "content": {
    "image_prompt": "school staff and families reviewing storm preparation checklist after weather event",
    "passage": "Antes de la tormenta, la escuela aseguró objetos del patio, cerró ventanas y pidió a las familias revisar canales oficiales. Después del evento, no hubo daños mayores dentro de las aulas y la salida se organizó con calma.",
    "question": "¿Qué conclusión está mejor respaldada?",
    "options": [
      { "id": "a", "text": "Varias medidas de preparación ayudaron a reducir problemas en la escuela.", "image_url": null },
      { "id": "b", "text": "No era necesario prepararse de ninguna manera.", "image_url": null },
      { "id": "c", "text": "La tormenta nunca llegó a la zona.", "image_url": null },
      { "id": "d", "text": "Los daños fueron peores dentro de las aulas que afuera.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 2. Multiple choice — decision making
- Skill: `decision_making`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Escoge la mejor acción",
  "mission_description": "Piensa cuál decisión es más responsable según la información.",
  "instructions_es": "Escoge la mejor decisión.",
  "content": {
    "passage": "Durante la próxima alerta, algunas personas quieren compartir mensajes no confirmados en redes, mientras otras prefieren esperar los avisos del servicio meteorológico y la escuela.",
    "question": "¿Cuál es la mejor decisión?",
    "options": [
      { "id": "a", "text": "Esperar y compartir solo información confirmada por fuentes oficiales.", "image_url": null },
      { "id": "b", "text": "Difundir cualquier rumor para actuar más rápido.", "image_url": null },
      { "id": "c", "text": "Ignorar todos los mensajes y hacer lo que parezca.", "image_url": null },
      { "id": "d", "text": "Inventar una nueva alerta para llamar la atención.", "image_url": null }
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
  "lesson_mood": "curious",
  "mission_title": "Identifica el propósito del texto",
  "mission_description": "Piensa por qué se escribió este artículo de seguimiento.",
  "instructions_es": "Escoge el propósito principal.",
  "content": {
    "passage": "El artículo explica qué medidas funcionaron, cuáles pueden mejorar y por qué es importante seguir información oficial durante futuras alertas.",
    "question": "¿Cuál es el propósito principal del texto?",
    "options": [
      { "id": "a", "text": "Informar y ayudar a mejorar la preparación para futuras alertas.", "image_url": null },
      { "id": "b", "text": "Entretener con una historia inventada sobre tormentas.", "image_url": null },
      { "id": "c", "text": "Convencer a la gente de ignorar avisos oficiales.", "image_url": null },
      { "id": "d", "text": "Prometer que nunca volverá a llover.", "image_url": null }
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
  "lesson_mood": "friendly_challenge",
  "mission_title": "Separa hechos de opiniones",
  "mission_description": "Encuentra la afirmación verificable.",
  "instructions_es": "Escoge cuál afirmación es un hecho.",
  "content": {
    "passage": null,
    "question": "¿Cuál afirmación es un hecho?",
    "options": [
      { "id": "a", "text": "Cerrar ventanas fue una idea excelente y perfecta.", "image_url": null },
      { "id": "b", "text": "La escuela aseguró objetos del patio antes de la tormenta.", "image_url": null },
      { "id": "c", "text": "Los avisos meteorológicos siempre son emocionantes.", "image_url": null },
      { "id": "d", "text": "Toda tormenta es la peor de la historia.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "b"
  }
}
```

---

# Running Totals After Wave 5

With Waves 1–5, the draft set now covers:
- 5 Grade 2 packs
- 5 Grades 3–4 packs
- 5 Grades 5–6 packs

That gives you 15 premium packs in progress across the three main grade bands.

## Next recommended packs
- Grade 2 → `g2_garden_helpers`
- Grade 2 → `g2_market_morning`
- Grades 3–4 → `g34_maps_and_neighborhoods`
- Grades 3–4 → `g34_recycling_day`
- Grades 5–6 → `g56_school_energy_project`
- Grades 5–6 → `g56_local_news_comparison`

