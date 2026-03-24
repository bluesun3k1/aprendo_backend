# Structured Content Wave 14

This wave continues the **skill-first** production model:

**Grade band → Curriculum unit → Skill targets → Pack → Activity family**

Wave 14 focuses on the next structured gap-fill set:
- Grade 2 → `g2_same_and_different`
- Grades 3–4 → `g34_missing_steps`
- Grades 5–6 → `g56_source_strength`

These are designed to keep filling real skill gaps instead of only broadening themes.

---

# Pack 40 — Grade 2

## Pack Code
`g2_same_and_different`

## Pack Role
`core`

## Curriculum Unit
`early_reading_basics`

## Primary Skills
- `compare_contrast`
- `classification`
- `supporting_details`

## Secondary Skills
- `selective_attention`
- `main_idea`

## Theme
Students compare classroom objects and sort what is the same and what is different.

## Why this pack exists
This pack intentionally strengthens **compare and contrast** in a very concrete Grade 2 way, while reinforcing classification and careful attention to details.

## Activity Family

### 1. Storybook reading
- Skill: `main_idea`
- Type: `storybook_reading`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Descubre qué es igual y qué es diferente",
  "mission_description": "Lee la historia y piensa en lo que la clase está aprendiendo.",
  "instructions_es": "Lee las páginas y responde la pregunta.",
  "content": {
    "pages": [
      {
        "id": "p1",
        "title": "Dos mesas, varios objetos",
        "text": "La maestra puso lápices, crayones y libros sobre dos mesas. Pidió a la clase mirar cuáles cosas eran iguales y cuáles eran diferentes.",
        "image_prompt": "teacher showing two classroom tables with pencils crayons and books for comparing"
      },
      {
        "id": "p2",
        "title": "Observar con atención",
        "text": "Los niños compararon colores, tamaños y usos. Después agruparon los objetos con más cuidado.",
        "image_prompt": "students comparing and grouping classroom objects by color size and use"
      }
    ],
    "question": {
      "prompt": "¿Cuál es la idea principal de la historia?",
      "options": [
        { "id": "a", "text": "La clase aprende a comparar objetos y notar diferencias.", "image_url": null },
        { "id": "b", "text": "Los niños esconden los libros debajo de la mesa.", "image_url": null },
        { "id": "c", "text": "La maestra guarda todos los lápices sin mirar.", "image_url": null }
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
  "lesson_mood": "mission",
  "mission_title": "Compara dos objetos",
  "mission_description": "Piensa en lo que es igual y diferente.",
  "instructions_es": "Escoge la mejor comparación.",
  "content": {
    "passage": "El lápiz y el crayón sirven para escribir o colorear. El lápiz se puede borrar más fácilmente y el crayón suele dejar trazos más gruesos.",
    "question": "¿Cuál es la mejor comparación?",
    "options": [
      { "id": "a", "text": "Los dos sirven para marcar, pero escriben de forma diferente.", "image_url": null },
      { "id": "b", "text": "Ninguno sirve para hacer trabajos escolares.", "image_url": null },
      { "id": "c", "text": "Los dos se borran exactamente igual siempre.", "image_url": null },
      { "id": "d", "text": "El crayón es un libro y el lápiz una mesa.", "image_url": null }
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
  "mission_title": "Agrupa lo que se parece",
  "mission_description": "Arrastra cada tarjeta al grupo correcto.",
  "instructions_es": "Arrastra al grupo correcto.",
  "content": {
    "items": [
      { "id": "item_1", "text": "Lápiz", "image_url": null },
      { "id": "item_2", "text": "Libro", "image_url": null },
      { "id": "item_3", "text": "Crayón", "image_url": null },
      { "id": "item_4", "text": "Cuaderno", "image_url": null }
    ],
    "zones": [
      { "id": "zone_a", "label": "Para escribir o dibujar" },
      { "id": "zone_b", "label": "Para leer o guardar trabajo" }
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

### 4. Multiple choice — supporting details
- Skill: `supporting_details`
- Type: `multiple_choice`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "friendly_challenge",
  "mission_title": "Encuentra el detalle importante",
  "mission_description": "Escoge la pista que mejor apoya la comparación.",
  "instructions_es": "Escoge el detalle correcto.",
  "content": {
    "passage": "Los niños miraron el color, el tamaño y el uso de cada objeto antes de agruparlo.",
    "question": "¿Qué detalle muestra cómo compararon los objetos?",
    "options": [
      { "id": "a", "text": "Miraron el color, el tamaño y el uso.", "image_url": null },
      { "id": "b", "text": "La clase tenía una puerta azul.", "image_url": null },
      { "id": "c", "text": "El salón tenía muchas sillas.", "image_url": null },
      { "id": "d", "text": "Algunos niños llegaron temprano.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Pack 41 — Grades 3–4

## Pack Code
`g34_missing_steps`

## Pack Role
`core`

## Curriculum Unit
`middle_reading_interpretation`

## Primary Skills
- `sequencing`
- `problem_solving`
- `supporting_details`

## Secondary Skills
- `decision_making`
- `summarization`

## Theme
Students read about a process with missing steps and must figure out what is missing to complete it correctly.

## Why this pack exists
This pack strengthens **sequencing** and **problem solving** by making students repair an incomplete process instead of only reading a finished one.

## Activity Family

### 1. Illustrated clue reading — sequencing
- Skill: `sequencing`
- Type: `illustrated_clue`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Encuentra el paso que falta",
  "mission_description": "Lee el proceso y descubre qué paso falta para que tenga sentido.",
  "instructions_es": "Escoge el paso que falta.",
  "content": {
    "image_prompt": "students doing classroom project with step cards and one missing card",
    "passage": "Para sembrar una semilla, la clase hizo esto: puso tierra en un vaso, ________, y después la colocó cerca de una ventana con luz.",
    "question": "¿Qué paso falta?",
    "options": [
      { "id": "a", "text": "Colocar la semilla y echar un poco de agua.", "image_url": null },
      { "id": "b", "text": "Cerrar el vaso y guardarlo en una mochila.", "image_url": null },
      { "id": "c", "text": "Romper el vaso y empezar otra vez.", "image_url": null },
      { "id": "d", "text": "Quitar toda la tierra antes de seguir.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 2. Multiple choice — problem solving
- Skill: `problem_solving`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Resuelve el proceso incompleto",
  "mission_description": "Piensa qué hace falta para que el trabajo funcione.",
  "instructions_es": "Escoge la mejor solución.",
  "content": {
    "passage": "Un grupo quiere hacer un cartel, pero ya pegó el título y las imágenes antes de decidir el orden de las ideas.",
    "question": "¿Qué deberían hacer ahora?",
    "options": [
      { "id": "a", "text": "Revisar el orden de ideas y reorganizar el cartel antes de terminarlo.", "image_url": null },
      { "id": "b", "text": "Ignorar el problema y entregarlo sin revisar.", "image_url": null },
      { "id": "c", "text": "Quitar todas las imágenes y esconderlas.", "image_url": null },
      { "id": "d", "text": "Esperar que el cartel se ordene solo.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
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
  "mission_title": "Encuentra la pista útil",
  "mission_description": "Escoge el detalle que ayuda a completar el proceso.",
  "instructions_es": "Escoge el detalle correcto.",
  "content": {
    "passage": "La clase ya tenía tierra en el vaso y sabía que la planta necesitaba luz después de sembrarse.",
    "question": "¿Qué detalle ayuda a saber el paso que falta?",
    "options": [
      { "id": "a", "text": "La planta debía sembrarse antes de ir a la ventana.", "image_url": null },
      { "id": "b", "text": "El aula tenía una ventana grande.", "image_url": null },
      { "id": "c", "text": "Los vasos eran transparentes.", "image_url": null },
      { "id": "d", "text": "Había muchos estudiantes en clase.", "image_url": null }
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
  "mission_title": "Resume el problema principal",
  "mission_description": "Escoge el resumen que mejor explica la situación.",
  "instructions_es": "Escoge el mejor resumen.",
  "content": {
    "passage": "La lectura presenta procesos incompletos y pide pensar qué paso falta para que el trabajo tenga sentido y pueda terminarse bien.",
    "question": "¿Cuál es el mejor resumen?",
    "options": [
      { "id": "a", "text": "Hay que encontrar el paso faltante para completar bien un proceso.", "image_url": null },
      { "id": "b", "text": "La lectura trata sobre deportes y recreo.", "image_url": null },
      { "id": "c", "text": "Los procesos siempre empiezan por el final.", "image_url": null },
      { "id": "d", "text": "No importa el orden cuando se hace un proyecto.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Pack 42 — Grades 5–6

## Pack Code
`g56_source_strength`

## Pack Role
`core`

## Curriculum Unit
`upper_advanced_reading`

## Primary Skills
- `evaluating_evidence`
- `identifying_purpose`
- `compare_contrast`

## Secondary Skills
- `fact_vs_opinion`
- `summarization`

## Theme
Students compare stronger and weaker sources on the same topic and decide which one is more useful.

## Why this pack exists
This pack deepens **source evaluation**, helping students judge not only what a text says but how strong the source behind it is.

## Activity Family

### 1. Illustrated article reading — evaluating evidence
- Skill: `evaluating_evidence`
- Type: `illustrated_clue`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Compara la fuerza de dos fuentes",
  "mission_description": "Lee ambas fuentes y decide cuál parece más sólida.",
  "instructions_es": "Escoge la fuente más fuerte según la evidencia.",
  "content": {
    "image_prompt": "student comparing two source cards: one with study details and one with vague personal post",
    "passage": "Fuente A explica cuándo se hizo un estudio, cuántas personas participaron y qué resultados encontraron. Fuente B dice: 'Yo lo probé una vez y seguro funciona para todos'.",
    "question": "¿Cuál fuente parece más fuerte?",
    "options": [
      { "id": "a", "text": "La Fuente A, porque da detalles sobre el estudio y sus resultados.", "image_url": null },
      { "id": "b", "text": "La Fuente B, porque una experiencia sola siempre prueba todo.", "image_url": null },
      { "id": "c", "text": "Las dos son igual de fuertes sin importar la evidencia.", "image_url": null },
      { "id": "d", "text": "La Fuente B, porque usa palabras más seguras.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 2. Multiple choice — identifying purpose
- Skill: `identifying_purpose`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Identifica lo que busca hacer cada fuente",
  "mission_description": "Piensa cuál texto intenta informar y cuál intenta convencer rápidamente.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "passage": "La Fuente A describe datos y explica límites del estudio. La Fuente B usa frases como 'créeme' y 'funciona siempre'.",
    "question": "¿Cuál es la mejor descripción?",
    "options": [
      { "id": "a", "text": "La Fuente A intenta informar con más cuidado; la Fuente B intenta convencer con afirmaciones fuertes.", "image_url": null },
      { "id": "b", "text": "Las dos buscan exactamente lo mismo y usan el mismo método.", "image_url": null },
      { "id": "c", "text": "La Fuente B informa con más detalle que la Fuente A.", "image_url": null },
      { "id": "d", "text": "La Fuente A no intenta comunicar nada.", "image_url": null }
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
  "mission_title": "Compara dos fuentes distintas",
  "mission_description": "Observa la diferencia entre una fuente detallada y una vaga.",
  "instructions_es": "Escoge la mejor comparación.",
  "content": {
    "passage": "Una fuente presenta fechas, participantes y resultados. La otra solo ofrece una experiencia personal sin más información.",
    "question": "¿Cuál es la mejor comparación?",
    "options": [
      { "id": "a", "text": "Una fuente es más específica y la otra más débil por falta de detalles.", "image_url": null },
      { "id": "b", "text": "Las dos tienen el mismo nivel de precisión.", "image_url": null },
      { "id": "c", "text": "La experiencia personal siempre vale más que los datos organizados.", "image_url": null },
      { "id": "d", "text": "Las dos son inútiles porque hablan del mismo tema.", "image_url": null }
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
  "mission_title": "Resume la lección principal",
  "mission_description": "Escoge el resumen que mejor explica cómo evaluar una fuente.",
  "instructions_es": "Escoge el mejor resumen.",
  "content": {
    "passage": "La lectura muestra que una fuente suele ser más útil cuando da detalles, evidencia y límites claros, en lugar de hacer afirmaciones generales sin apoyo suficiente.",
    "question": "¿Cuál es el mejor resumen?",
    "options": [
      { "id": "a", "text": "Las fuentes con más detalles y evidencia suelen ser más confiables que las afirmaciones vagas.", "image_url": null },
      { "id": "b", "text": "Las afirmaciones vagas siempre son mejores porque son más rápidas de leer.", "image_url": null },
      { "id": "c", "text": "No importa cuánta evidencia tenga una fuente.", "image_url": null },
      { "id": "d", "text": "Toda fuente personal es automáticamente incorrecta.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Running Totals After Structured Wave 14

This wave continues the structured gap-fill path by adding:
- stronger Grade 2 evidence for `compare_contrast`, `classification`, and careful detail use
- stronger Grades 3–4 evidence for `sequencing`, `problem_solving`, and repair of incomplete processes
- stronger Grades 5–6 evidence for `source evaluation`, `purpose`, and comparison of stronger vs weaker evidence

## Recommended next structured gap-fill wave
- Grade 2 → `g2_follow_the_clues`
- Grades 3–4 → `g34_best_evidence`
- Grades 5–6 → `g56_limits_of_a_claim`

