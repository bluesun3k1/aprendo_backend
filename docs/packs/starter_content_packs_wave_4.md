# Starter Content Packs — Wave 4

This continues the content production run with the next 3 premium packs:
- Grade 2 → `g2_day_and_night`
- Grades 3–4 → `g34_inventors_notebook`
- Grades 5–6 → `g56_ancient_city_discovery`

Each pack follows the same structure:
- linked activities
- reusable passage/scene family
- mission framing
- seed-friendly JSON in your current backend shape

---

# Pack 10 — Grade 2

## Pack Code
`g2_day_and_night`

## Curriculum Unit
`early_reading_basics`

## Domain
`reading`

## Primary Skills
- `compare_contrast`
- `sequencing`
- `main_idea`

## Secondary Skills
- `classification`
- `supporting_details`

## Theme
How daytime and nighttime are different, and what people and animals do in each.

## Tone
Simple science, familiar daily life, highly visual.

## Core Story
A child notices what changes between morning and night at home and outside.

## Activity Family

### 1. Storybook reading
- Skill: `main_idea`
- Type: `storybook_reading`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Descubre qué cambia entre el día y la noche",
  "mission_description": "Lee la historia y piensa en lo más importante que muestra.",
  "instructions_es": "Lee las páginas y responde la pregunta.",
  "content": {
    "pages": [
      {
        "id": "p1",
        "title": "Durante el día",
        "text": "En el día, Mateo ve el sol, escucha pájaros y juega en el patio con mucha luz.",
        "image_prompt": "child playing in sunny yard with birds and bright sky"
      },
      {
        "id": "p2",
        "title": "Durante la noche",
        "text": "En la noche, Mateo ve la luna, enciende una lámpara y se prepara para dormir.",
        "image_prompt": "child indoors at night with lamp, moon visible through window"
      }
    ],
    "question": {
      "prompt": "¿Cuál es la idea principal de la historia?",
      "options": [
        { "id": "a", "text": "El día y la noche tienen diferencias en luz y actividades.", "image_url": null },
        { "id": "b", "text": "Mateo nunca duerme.", "image_url": null },
        { "id": "c", "text": "Los pájaros vuelan de noche siempre.", "image_url": null }
      ]
    }
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 2. Multiple choice — compare and contrast
- Skill: `compare_contrast`
- Type: `multiple_choice`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "friendly_challenge",
  "mission_title": "Compara el día y la noche",
  "mission_description": "Escoge la mejor comparación.",
  "instructions_es": "Lee y escoge la mejor comparación.",
  "content": {
    "passage": "En el día hay sol y mucha luz. En la noche hay menos luz y muchas personas descansan. En ambos momentos, el cielo cambia.",
    "question": "¿Cuál es la mejor comparación?",
    "options": [
      { "id": "a", "text": "El día tiene más luz; la noche es más oscura, pero ambos son partes del tiempo.", "image_url": null },
      { "id": "b", "text": "El día y la noche son exactamente iguales.", "image_url": null },
      { "id": "c", "text": "En la noche siempre hay sol.", "image_url": null },
      { "id": "d", "text": "El día nunca cambia.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 3. Tap sequence — order the routine
- Skill: `sequencing`
- Type: `tap_sequence`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Ordena la rutina de Mateo",
  "mission_description": "Toca lo que pasa primero, después y al final.",
  "instructions_es": "Toca los eventos en el orden correcto.",
  "content": {
    "items": [
      { "id": "item_1", "text": "Juega con luz del sol" },
      { "id": "item_2", "text": "Enciende una lámpara" },
      { "id": "item_3", "text": "Se prepara para dormir" }
    ],
    "instructions": "Toca lo que pasa durante el día y luego en la noche.",
    "time_limit_seconds": 25
  },
  "correct_answer": {
    "sequence": ["item_1", "item_2", "item_3"]
  }
}
```

### 4. Drag to sort — day or night
- Skill: `classification`
- Type: `drag_to_sort`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "puzzle",
  "mission_title": "Clasifica lo que pasa de día o de noche",
  "mission_description": "Arrastra cada tarjeta al grupo correcto.",
  "instructions_es": "Arrastra al grupo correcto.",
  "content": {
    "items": [
      { "id": "item_1", "text": "Ver el sol", "image_url": null },
      { "id": "item_2", "text": "Ver la luna", "image_url": null },
      { "id": "item_3", "text": "Jugar en el patio con mucha luz", "image_url": null },
      { "id": "item_4", "text": "Dormir", "image_url": null }
    ],
    "zones": [
      { "id": "zone_a", "label": "Día" },
      { "id": "zone_b", "label": "Noche" }
    ],
    "instructions": "Pon cada tarjeta en día o noche."
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

# Pack 11 — Grades 3–4

## Pack Code
`g34_inventors_notebook`

## Curriculum Unit
`middle_reading_interpretation`

## Domain
`reading`

## Primary Skills
- `main_idea`
- `context_clues`
- `problem_solving`

## Secondary Skills
- `supporting_details`
- `compare_contrast`

## Theme
A student reads notes from a young inventor trying to improve a machine for watering plants.

## Tone
Curious, inventive, school-science feel.

## Core Story
An inventor tests ideas, notices problems, and changes the design after observing what does and does not work.

## Activity Family

### 1. Illustrated clue reading — main idea
- Skill: `main_idea`
- Type: `illustrated_clue`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "science_explore",
  "mission_title": "Lee el cuaderno del inventor",
  "mission_description": "Descubre cuál es la idea principal de sus notas.",
  "instructions_es": "Lee y escoge la idea principal.",
  "content": {
    "image_prompt": "child inventor notebook with sketches of watering device and plants",
    "passage": "Ariel quería construir una herramienta para regar plantas usando menos agua. En su cuaderno dibujó un tubo, una botella y pequeños agujeros para dejar caer el agua poco a poco.",
    "question": "¿Cuál es la idea principal del texto?",
    "options": [
      { "id": "a", "text": "Ariel está diseñando una forma de regar plantas de manera más eficiente.", "image_url": null },
      { "id": "b", "text": "Ariel quiere vender botellas vacías.", "image_url": null },
      { "id": "c", "text": "Las plantas no necesitan agua.", "image_url": null },
      { "id": "d", "text": "Los agujeros son siempre un problema.", "image_url": null }
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
  "mission_title": "Usa pistas para entender una palabra",
  "mission_description": "Escoge el significado usando la oración completa.",
  "instructions_es": "Usa el contexto para entender la palabra.",
  "content": {
    "passage": "Ariel hizo pequeños ajustes a su invento después de probarlo varias veces.",
    "question": "¿Qué significa 'ajustes' en este texto?",
    "options": [
      { "id": "a", "text": "Cambios pequeños", "image_url": null },
      { "id": "b", "text": "Grandes tormentas", "image_url": null },
      { "id": "c", "text": "Colores brillantes", "image_url": null },
      { "id": "d", "text": "Juegos rápidos", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 3. Multiple choice — problem solving
- Skill: `problem_solving`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Piensa como un inventor",
  "mission_description": "Escoge la mejor solución para el problema del invento.",
  "instructions_es": "Lee el problema y escoge la mejor solución.",
  "content": {
    "passage": "En la primera prueba, el agua salió demasiado rápido y la tierra se inundó. Ariel quiere que el agua salga poco a poco.",
    "question": "¿Qué debería intentar Ariel?",
    "options": [
      { "id": "a", "text": "Hacer agujeros más pequeños o menos agujeros.", "image_url": null },
      { "id": "b", "text": "Quitar toda el agua del invento.", "image_url": null },
      { "id": "c", "text": "Romper la botella y empezar sin pensar.", "image_url": null },
      { "id": "d", "text": "Poner la botella boca abajo sin cambios.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 4. Multiple choice — supporting details
- Skill: `supporting_details`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "friendly_challenge",
  "mission_title": "Encuentra el detalle útil",
  "mission_description": "Escoge el detalle que apoya la idea principal.",
  "instructions_es": "Escoge el detalle que mejor apoya el texto.",
  "content": {
    "passage": "Ariel dibujó una botella con agujeros pequeños para que el agua cayera lentamente sobre las raíces de las plantas.",
    "question": "¿Qué detalle apoya que Ariel quiere regar mejor las plantas?",
    "options": [
      { "id": "a", "text": "Quiere que el agua caiga lentamente sobre las raíces.", "image_url": null },
      { "id": "b", "text": "Usó un cuaderno para dibujar.", "image_url": null },
      { "id": "c", "text": "Le gustan las botellas vacías.", "image_url": null },
      { "id": "d", "text": "El dibujo tiene líneas.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Pack 12 — Grades 5–6

## Pack Code
`g56_ancient_city_discovery`

## Curriculum Unit
`upper_advanced_reading`

## Domain
`reading`

## Primary Skills
- `inference`
- `evaluating_evidence`
- `compare_contrast`

## Secondary Skills
- `identifying_purpose`
- `fact_vs_opinion`

## Theme
An article about archaeologists discovering remains of an ancient city and interpreting what the evidence suggests.

## Tone
Historical curiosity, evidence-based, more mature nonfiction.

## Core Passage Family
Researchers uncover walls, tools, and pottery, then compare their findings with earlier ideas about the site.

## Activity Family

### 1. Illustrated article reading — inference
- Skill: `inference`
- Type: `illustrated_clue`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mystery",
  "mission_title": "Explora el hallazgo de una ciudad antigua",
  "mission_description": "Lee la evidencia y descubre qué se puede inferir sobre el lugar.",
  "instructions_es": "Usa las pistas del texto para hacer una inferencia.",
  "content": {
    "image_prompt": "archaeologists uncovering ancient walls, pottery and tools at dig site",
    "passage": "Los arqueólogos encontraron restos de muros, fragmentos de cerámica y herramientas de piedra. También hallaron señales de fogones antiguos en varias zonas del sitio.",
    "question": "¿Qué se puede inferir?",
    "options": [
      { "id": "a", "text": "En el lugar vivieron personas que cocinaban y realizaban actividades diarias.", "image_url": null },
      { "id": "b", "text": "El sitio era solo un campo vacío sin uso humano.", "image_url": null },
      { "id": "c", "text": "Las herramientas aparecieron allí por casualidad moderna.", "image_url": null },
      { "id": "d", "text": "El lugar fue construido la semana pasada.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 2. Multiple choice — evaluating evidence
- Skill: `evaluating_evidence`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Escoge la afirmación mejor respaldada",
  "mission_description": "Piensa qué idea está apoyada por la evidencia encontrada.",
  "instructions_es": "Escoge la afirmación mejor respaldada por el texto.",
  "content": {
    "passage": "Los investigadores hallaron muros, fogones y restos de cerámica en varias áreas cercanas entre sí.",
    "question": "¿Qué afirmación está mejor respaldada?",
    "options": [
      { "id": "a", "text": "El sitio tuvo actividad humana organizada en diferentes espacios.", "image_url": null },
      { "id": "b", "text": "El sitio fue usado únicamente por animales salvajes.", "image_url": null },
      { "id": "c", "text": "La ciudad tenía automóviles y carreteras modernas.", "image_url": null },
      { "id": "d", "text": "No había ninguna estructura construida por personas.", "image_url": null }
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
  "mission_title": "Compara ideas antiguas y nuevas",
  "mission_description": "Observa cómo cambia la interpretación con nueva evidencia.",
  "instructions_es": "Compara la idea anterior con la nueva evidencia.",
  "content": {
    "passage": "Antes, algunos pensaban que el sitio era solo un puesto pequeño de paso. Después de encontrar muros extensos y varias zonas de fogones, los investigadores creen que pudo ser un asentamiento más grande.",
    "question": "¿Cuál es la mejor comparación?",
    "options": [
      { "id": "a", "text": "La nueva evidencia sugiere un lugar más grande y complejo que lo que se pensaba antes.", "image_url": null },
      { "id": "b", "text": "La nueva evidencia demuestra que no hubo personas allí nunca.", "image_url": null },
      { "id": "c", "text": "Ambas ideas dicen exactamente lo mismo.", "image_url": null },
      { "id": "d", "text": "La evidencia nueva elimina por completo la existencia de muros.", "image_url": null }
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
  "mission_title": "Identifica el propósito del artículo",
  "mission_description": "Piensa por qué fue escrito este texto.",
  "instructions_es": "Escoge el propósito principal.",
  "content": {
    "passage": "El artículo explica qué encontraron los arqueólogos, cómo interpretan los hallazgos y por qué el sitio puede cambiar lo que se sabía sobre la región.",
    "question": "¿Cuál es el propósito principal del texto?",
    "options": [
      { "id": "a", "text": "Informar sobre un descubrimiento y su importancia.", "image_url": null },
      { "id": "b", "text": "Contar una leyenda inventada para entretener.", "image_url": null },
      { "id": "c", "text": "Convencer a todos de construir en el sitio.", "image_url": null },
      { "id": "d", "text": "Criticar a los científicos sin evidencia.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Running Totals After Wave 4

With Waves 1–4, the draft set now covers:
- 4 Grade 2 packs
- 4 Grades 3–4 packs
- 4 Grades 5–6 packs

That gives you 12 premium packs in progress across the three main grade bands.

## Next recommended packs
- Grade 2 → `g2_helping_a_friend`
- Grade 2 → `g2_garden_helpers`
- Grades 3–4 → `g34_growing_plants`
- Grades 3–4 → `g34_maps_and_neighborhoods`
- Grades 5–6 → `g56_weather_warning_followup`
- Grades 5–6 → `g56_school_energy_project`

