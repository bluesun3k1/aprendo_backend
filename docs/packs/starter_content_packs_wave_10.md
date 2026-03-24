# Starter Content Packs — Wave 10

This continues the content production run with the next 3 premium packs:
- Grade 2 → `g2_rain_after_school`
- Grades 3–4 → `g34_butterfly_garden`
- Grades 5–6 → `g56_city_trees_report`

Each pack follows the same structure:
- linked activities
- reusable passage/scene family
- mission framing
- seed-friendly JSON in your current backend shape

---

# Pack 28 — Grade 2

## Pack Code
`g2_rain_after_school`

## Curriculum Unit
`early_reading_basics`

## Domain
`reading`

## Primary Skills
- `cause_effect`
- `sequencing`
- `supporting_details`

## Secondary Skills
- `main_idea`
- `decision_making`

## Theme
A child leaves school and notices the weather changing quickly.

## Tone
Familiar, routine-based, weather-centered.

## Core Story
When school ends, dark clouds appear, rain starts, and the child changes plans to get home safely.

## Activity Family

### 1. Storybook reading
- Skill: `main_idea`
- Type: `storybook_reading`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Descubre qué pasó después de la escuela",
  "mission_description": "Lee la historia y piensa en el cambio más importante.",
  "instructions_es": "Lee las páginas y responde la pregunta.",
  "content": {
    "pages": [
      {
        "id": "p1",
        "title": "La salida de clases",
        "text": "Cuando sonó el timbre, Diego salió de la escuela. Vio nubes oscuras y sintió viento en la calle.",
        "image_prompt": "child leaving school with dark clouds and wind starting outside"
      },
      {
        "id": "p2",
        "title": "Cambio de plan",
        "text": "Poco después empezó a llover. Diego abrió su sombrilla y caminó con cuidado hasta llegar a casa.",
        "image_prompt": "child using umbrella in rain while walking home safely"
      }
    ],
    "question": {
      "prompt": "¿Cuál es la idea principal de la historia?",
      "options": [
        { "id": "a", "text": "Diego cambió lo que hacía al ver que comenzó a llover.", "image_url": null },
        { "id": "b", "text": "Diego corrió a jugar bajo la lluvia sin cuidado.", "image_url": null },
        { "id": "c", "text": "La escuela nunca termina por la tarde.", "image_url": null }
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
  "mission_description": "Escoge el mejor efecto de la lluvia.",
  "instructions_es": "Escoge el efecto correcto.",
  "content": {
    "passage": "Las nubes se hicieron oscuras y poco después empezó a llover. Entonces Diego abrió su sombrilla.",
    "question": "¿Cuál fue un efecto de que comenzara a llover?",
    "options": [
      { "id": "a", "text": "Diego abrió su sombrilla.", "image_url": null },
      { "id": "b", "text": "La escuela volvió a empezar.", "image_url": null },
      { "id": "c", "text": "Las nubes desaparecieron de inmediato.", "image_url": null },
      { "id": "d", "text": "Diego entró al aula otra vez para dormir.", "image_url": null }
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
  "mission_title": "Ordena la historia de Diego",
  "mission_description": "Toca primero, después y al final.",
  "instructions_es": "Toca los eventos en el orden correcto.",
  "content": {
    "items": [
      { "id": "item_1", "text": "Diego salió de la escuela" },
      { "id": "item_2", "text": "Empezó a llover" },
      { "id": "item_3", "text": "Abrió su sombrilla" }
    ],
    "instructions": "Toca los pasos en el orden en que ocurrieron.",
    "time_limit_seconds": 25
  },
  "correct_answer": {
    "sequence": ["item_1", "item_2", "item_3"]
  }
}
```

### 4. Multiple choice — supporting details
- Skill: `supporting_details`
- Type: `multiple_choice`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "friendly_challenge",
  "mission_title": "Encuentra la pista importante",
  "mission_description": "Escoge el detalle que ayuda a entender la historia.",
  "instructions_es": "Lee y escoge el detalle correcto.",
  "content": {
    "passage": "Diego vio nubes oscuras, sintió viento y luego comenzó a llover mientras caminaba a casa.",
    "question": "¿Qué detalle muestra que el clima estaba cambiando?",
    "options": [
      { "id": "a", "text": "Vio nubes oscuras y sintió viento.", "image_url": null },
      { "id": "b", "text": "La escuela tiene un patio.", "image_url": null },
      { "id": "c", "text": "Diego llevaba zapatos.", "image_url": null },
      { "id": "d", "text": "La calle tenía acera.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Pack 29 — Grades 3–4

## Pack Code
`g34_butterfly_garden`

## Curriculum Unit
`middle_reading_interpretation`

## Domain
`reading`

## Primary Skills
- `compare_contrast`
- `supporting_details`
- `summarization`

## Secondary Skills
- `cause_effect`
- `context_clues`

## Theme
A class creates a butterfly garden and observes which plants and conditions attract butterflies.

## Tone
Nature-based, curious, lightly scientific.

## Core Story
Students plant flowers, observe butterflies returning, and compare which garden areas attract more insects.

## Activity Family

### 1. Illustrated clue reading — compare and contrast
- Skill: `compare_contrast`
- Type: `illustrated_clue`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "science_explore",
  "mission_title": "Compara dos partes del jardín de mariposas",
  "mission_description": "Lee y decide qué comparación es mejor.",
  "instructions_es": "Escoge la mejor comparación.",
  "content": {
    "image_prompt": "school butterfly garden with sunny flower area and shaded area with fewer butterflies",
    "passage": "En la parte soleada del jardín crecieron más flores y llegaron más mariposas. En la parte con más sombra hubo menos flores y menos insectos. En ambas zonas la clase regó las plantas con cuidado.",
    "question": "¿Cuál es la mejor comparación?",
    "options": [
      { "id": "a", "text": "La zona soleada tuvo más flores y mariposas; ambas zonas recibieron cuidado de la clase.", "image_url": null },
      { "id": "b", "text": "Las dos zonas tuvieron exactamente la misma cantidad de mariposas.", "image_url": null },
      { "id": "c", "text": "La sombra hizo crecer más flores que el sol.", "image_url": null },
      { "id": "d", "text": "Ninguna zona fue regada por la clase.", "image_url": null }
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
  "mission_title": "Busca el detalle importante",
  "mission_description": "Escoge la pista que mejor apoya la idea principal.",
  "instructions_es": "Lee y escoge el detalle correcto.",
  "content": {
    "passage": "La clase plantó flores de colores, regó el jardín y luego observó que más mariposas visitaban la zona con más flores abiertas.",
    "question": "¿Qué detalle apoya que las mariposas preferían cierta parte del jardín?",
    "options": [
      { "id": "a", "text": "Más mariposas visitaban la zona con más flores abiertas.", "image_url": null },
      { "id": "b", "text": "La clase tenía una libreta para anotar.", "image_url": null },
      { "id": "c", "text": "Las flores eran de varios colores.", "image_url": null },
      { "id": "d", "text": "El jardín estaba cerca del aula.", "image_url": null }
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
  "lesson_mood": "curious",
  "mission_title": "Resume lo más importante",
  "mission_description": "Escoge el resumen que mejor cuenta lo ocurrido.",
  "instructions_es": "Lee y escoge el mejor resumen.",
  "content": {
    "passage": "La clase creó un jardín para atraer mariposas. Después de plantar y cuidar flores, observó que algunas zonas recibían más visitas de insectos que otras.",
    "question": "¿Cuál es el mejor resumen?",
    "options": [
      { "id": "a", "text": "La clase creó un jardín y observó cómo diferentes condiciones atraían más mariposas.", "image_url": null },
      { "id": "b", "text": "Las mariposas nunca regresaron al jardín.", "image_url": null },
      { "id": "c", "text": "La clase solo pintó carteles sobre insectos.", "image_url": null },
      { "id": "d", "text": "Todas las flores crecieron exactamente igual en cada lugar.", "image_url": null }
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
  "lesson_mood": "mission",
  "mission_title": "Piensa en causa y efecto",
  "mission_description": "Escoge el efecto correcto según el texto.",
  "instructions_es": "Escoge el mejor efecto.",
  "content": {
    "passage": "La clase sembró más flores abiertas y cuidó bien la zona soleada del jardín.",
    "question": "¿Cuál fue un posible efecto de eso?",
    "options": [
      { "id": "a", "text": "Llegaron más mariposas a esa parte del jardín.", "image_url": null },
      { "id": "b", "text": "El jardín se convirtió en una cancha.", "image_url": null },
      { "id": "c", "text": "Las flores dejaron de necesitar agua.", "image_url": null },
      { "id": "d", "text": "Las mariposas desaparecieron de toda la zona.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Pack 30 — Grades 5–6

## Pack Code
`g56_city_trees_report`

## Curriculum Unit
`upper_advanced_reading`

## Domain
`reading`

## Primary Skills
- `evaluating_evidence`
- `summarization`
- `identifying_purpose`

## Secondary Skills
- `compare_contrast`
- `fact_vs_opinion`

## Theme
A city report explains why planting and protecting urban trees matters for shade, air quality, and neighborhood comfort.

## Tone
Informative, civic, evidence-based.

## Core Passage Family
The report compares tree-covered areas with places that have less shade and explains community recommendations.

## Activity Family

### 1. Illustrated article reading — evaluating evidence
- Skill: `evaluating_evidence`
- Type: `illustrated_clue`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "science_explore",
  "mission_title": "Analiza el reporte sobre árboles de la ciudad",
  "mission_description": "Lee la información y decide qué conclusión está mejor respaldada.",
  "instructions_es": "Escoge la conclusión mejor respaldada por el texto.",
  "content": {
    "image_prompt": "city street with shaded tree-lined area and nearby area with less shade, simple report graphic",
    "passage": "El reporte mostró que las calles con más árboles tenían más sombra y resultaban más cómodas durante las horas de calor. También indicó que los árboles ayudan a mejorar el aire y a dar refugio a algunas aves e insectos.",
    "question": "¿Qué conclusión está mejor respaldada?",
    "options": [
      { "id": "a", "text": "Tener más árboles en ciertas calles puede mejorar la comodidad y aportar beneficios ambientales.", "image_url": null },
      { "id": "b", "text": "Los árboles hacen innecesarias todas las construcciones humanas.", "image_url": null },
      { "id": "c", "text": "Las calles con árboles siempre son idénticas entre sí.", "image_url": null },
      { "id": "d", "text": "Los árboles solo sirven para decorar y no tienen otros efectos.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 2. Multiple choice — summarization
- Skill: `summarization`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Resume la idea principal del reporte",
  "mission_description": "Escoge el resumen que mejor reúne la información importante.",
  "instructions_es": "Lee y escoge el mejor resumen.",
  "content": {
    "passage": "El reporte explica que los árboles urbanos pueden dar sombra, hacer las calles más cómodas en días calurosos y aportar beneficios para el aire y algunos seres vivos. También recomienda cuidarlos y plantar más en ciertas zonas.",
    "question": "¿Cuál es el mejor resumen?",
    "options": [
      { "id": "a", "text": "Los árboles de la ciudad aportan sombra y beneficios ambientales, por eso conviene cuidarlos y plantar más.", "image_url": null },
      { "id": "b", "text": "Los árboles solo están en parques lejanos y no tienen efecto en la ciudad.", "image_url": null },
      { "id": "c", "text": "El reporte trata sobre cómo quitar todos los árboles de las calles.", "image_url": null },
      { "id": "d", "text": "Las aves no usan los árboles urbanos nunca.", "image_url": null }
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
  "lesson_mood": "mission",
  "mission_title": "Identifica el propósito del reporte",
  "mission_description": "Piensa por qué fue escrito este texto.",
  "instructions_es": "Escoge el propósito principal.",
  "content": {
    "passage": "El reporte presenta observaciones sobre árboles urbanos, compara zonas con más y menos sombra y propone acciones para mejorar ciertas calles.",
    "question": "¿Cuál es el propósito principal del texto?",
    "options": [
      { "id": "a", "text": "Informar sobre los beneficios de los árboles urbanos y orientar decisiones para la comunidad.", "image_url": null },
      { "id": "b", "text": "Contar una historia inventada sobre bosques mágicos.", "image_url": null },
      { "id": "c", "text": "Convencer a la ciudad de cortar todos los árboles.", "image_url": null },
      { "id": "d", "text": "Burlarse de los vecinos que riegan plantas.", "image_url": null }
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
  "mission_title": "Compara dos zonas de la ciudad",
  "mission_description": "Observa cómo cambian la sombra y el confort entre dos áreas.",
  "instructions_es": "Escoge la mejor comparación.",
  "content": {
    "passage": "La zona A tiene árboles altos que dan sombra durante gran parte del día. La zona B tiene menos árboles y se calienta más rápido al mediodía.",
    "question": "¿Cuál es la mejor comparación?",
    "options": [
      { "id": "a", "text": "La zona A tiene más sombra y la zona B se calienta más rápido por tener menos árboles.", "image_url": null },
      { "id": "b", "text": "Las dos zonas tienen exactamente la misma cantidad de sombra.", "image_url": null },
      { "id": "c", "text": "La zona B tiene árboles más altos que la zona A.", "image_url": null },
      { "id": "d", "text": "Ninguna de las dos zonas recibe luz solar.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Running Totals After Wave 10

With Waves 1–10, the draft set now covers:
- 10 Grade 2 packs
- 10 Grades 3–4 packs
- 10 Grades 5–6 packs

That gives you 30 premium packs in progress across the three main grade bands.

## Recommended next step
Now that the 30-pack milestone has been reached, the smartest move is to:
1. align the remaining 3 packs to the curriculum map if needed
2. add sequence metadata to all 30 packs
3. identify gaps by skill/domain inside each grade band
4. begin Wave 11 with targeted gap-filling rather than only broad topic expansion
