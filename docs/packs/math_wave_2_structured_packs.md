# Math Wave 2 — Structured Packs

This wave continues the math track using the same structured model:

**Grade band → Curriculum unit → Skill targets → Pack → Activity family**

Wave 2 focuses on the next three math packs:
- Grade 2 → `g2_math_place_value_blocks`
- Grades 3–4 → `g34_math_share_and_divide`
- Grades 5–6 → `g56_math_decimal_money`

These packs are designed to strengthen foundational math progression while keeping the platform’s skill-training style.

---

# Pack M4 — Grade 2

## Pack Code
`g2_math_place_value_blocks`

## Pack Role
`core`

## Curriculum Unit
`math_number_foundations`

## Primary Skills
- `place_value`
- `number_sense`
- `addition_subtraction`

## Secondary Skills
- `word_problems`
- `patterns_sequences`

## Theme
Students use tens and ones to build numbers and compare quantities.

## Why this pack exists
Grade 2 needs explicit place-value work early so later arithmetic and comparison skills have a strong base.

## Activity Family

### 1. Storybook math reading
- Skill: `place_value`
- Type: `storybook_reading`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "playful",
  "mission_title": "Construye números con decenas y unidades",
  "mission_description": "Lee la historia y piensa en cuántas decenas y unidades ves.",
  "instructions_es": "Lee las páginas y responde.",
  "content": {
    "pages": [
      {
        "id": "p1",
        "title": "Bloques en la mesa",
        "text": "Mila puso 2 barras de diez y 3 cubitos sueltos sobre la mesa.",
        "image_prompt": "child placing 2 base-ten rods and 3 single cubes on a classroom table"
      },
      {
        "id": "p2",
        "title": "Ahora forma el número",
        "text": "Mila quiere saber qué número forman esas decenas y unidades.",
        "image_prompt": "base ten blocks arranged clearly for counting tens and ones"
      }
    ],
    "question": {
      "prompt": "¿Qué número forman 2 decenas y 3 unidades?",
      "options": [
        { "id": "a", "text": "13", "image_url": null },
        { "id": "b", "text": "23", "image_url": null },
        { "id": "c", "text": "32", "image_url": null }
      ]
    }
  },
  "correct_answer": {
    "correct_option_id": "b"
  }
}
```

### 2. Multiple choice — place_value
- Skill: `place_value`
- Type: `multiple_choice`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Cuenta decenas y unidades",
  "mission_description": "Escoge el número correcto.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "passage": null,
    "question": "3 decenas y 4 unidades forman el número...",
    "options": [
      { "id": "a", "text": "34", "image_url": null },
      { "id": "b", "text": "43", "image_url": null },
      { "id": "c", "text": "7", "image_url": null },
      { "id": "d", "text": "30", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

### 3. Drag to sort — number_sense
- Skill: `number_sense`
- Type: `drag_to_sort`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "puzzle",
  "mission_title": "Relaciona número y bloques",
  "mission_description": "Arrastra cada número al grupo correcto.",
  "instructions_es": "Arrastra al grupo correcto.",
  "content": {
    "items": [
      { "id": "item_1", "text": "12", "image_url": null },
      { "id": "item_2", "text": "20", "image_url": null },
      { "id": "item_3", "text": "31", "image_url": null }
    ],
    "zones": [
      { "id": "zone_a", "label": "1 decena y 2 unidades" },
      { "id": "zone_b", "label": "2 decenas y 0 unidades" },
      { "id": "zone_c", "label": "3 decenas y 1 unidad" }
    ],
    "instructions": "Pon cada número con su cantidad de decenas y unidades."
  },
  "correct_answer": {
    "zones": {
      "zone_a": ["item_1"],
      "zone_b": ["item_2"],
      "zone_c": ["item_3"]
    }
  }
}
```

### 4. Multiple choice — word_problems
- Skill: `word_problems`
- Type: `multiple_choice`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Resuelve el problema con decenas",
  "mission_description": "Piensa cuántas decenas y unidades hay.",
  "instructions_es": "Escoge la respuesta correcta.",
  "content": {
    "passage": "En una caja hay 2 grupos de diez fichas y 5 fichas sueltas.",
    "question": "¿Cuántas fichas hay en total?",
    "options": [
      { "id": "a", "text": "15", "image_url": null },
      { "id": "b", "text": "20", "image_url": null },
      { "id": "c", "text": "25", "image_url": null },
      { "id": "d", "text": "30", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "c"
  }
}
```

---

# Pack M5 — Grades 3–4

## Pack Code
`g34_math_share_and_divide`

## Pack Role
`core`

## Curriculum Unit
`math_multiplication_division_foundations`

## Primary Skills
- `multiplication_division`
- `word_problems`
- `number_sense`

## Secondary Skills
- `patterns_sequences`
- `data_interpretation`

## Theme
Students reason about sharing equally, fair groups, and simple division situations.

## Why this pack exists
Middle-band students need division to feel like fair sharing and grouping before it becomes abstract notation only.

## Activity Family

### 1. Illustrated clue reading — multiplication_division
- Skill: `multiplication_division`
- Type: `illustrated_clue`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Comparte en grupos iguales",
  "mission_description": "Lee la situación y decide cuántos recibe cada grupo.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "image_prompt": "12 classroom stickers being shared equally into 3 groups",
    "passage": "La maestra tiene 12 pegatinas y quiere repartirlas por igual entre 3 estudiantes.",
    "question": "¿Cuántas pegatinas recibe cada estudiante?",
    "options": [
      { "id": "a", "text": "3", "image_url": null },
      { "id": "b", "text": "4", "image_url": null },
      { "id": "c", "text": "5", "image_url": null },
      { "id": "d", "text": "6", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "b"
  }
}
```

### 2. Multiple choice — word_problems
- Skill: `word_problems`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Resuelve el problema de reparto",
  "mission_description": "Piensa cómo compartir la cantidad en partes iguales.",
  "instructions_es": "Escoge la respuesta correcta.",
  "content": {
    "passage": "Hay 15 galletas para repartir por igual entre 5 niños.",
    "question": "¿Cuántas galletas recibe cada niño?",
    "options": [
      { "id": "a", "text": "2", "image_url": null },
      { "id": "b", "text": "3", "image_url": null },
      { "id": "c", "text": "4", "image_url": null },
      { "id": "d", "text": "5", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "b"
  }
}
```

### 3. Drag to sort — multiplication_division
- Skill: `multiplication_division`
- Type: `drag_to_sort`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "puzzle",
  "mission_title": "Relaciona reparto y resultado",
  "mission_description": "Arrastra cada situación a su respuesta correcta.",
  "instructions_es": "Arrastra al grupo correcto.",
  "content": {
    "items": [
      { "id": "item_1", "text": "8 objetos en 2 grupos", "image_url": null },
      { "id": "item_2", "text": "18 objetos en 3 grupos", "image_url": null },
      { "id": "item_3", "text": "20 objetos en 5 grupos", "image_url": null }
    ],
    "zones": [
      { "id": "zone_a", "label": "4 en cada grupo" },
      { "id": "zone_b", "label": "6 en cada grupo" }
    ],
    "instructions": "Pon cada situación con su resultado."
  },
  "correct_answer": {
    "zones": {
      "zone_a": ["item_1", "item_3"],
      "zone_b": ["item_2"]
    }
  }
}
```

### 4. Multiple choice — patterns_sequences
- Skill: `patterns_sequences`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "friendly_challenge",
  "mission_title": "Sigue la secuencia de saltos",
  "mission_description": "Piensa qué número viene después si cuentas de 3 en 3.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "passage": null,
    "question": "3, 6, 9, 12, ___",
    "options": [
      { "id": "a", "text": "13", "image_url": null },
      { "id": "b", "text": "14", "image_url": null },
      { "id": "c", "text": "15", "image_url": null },
      { "id": "d", "text": "16", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "c"
  }
}
```

---

# Pack M6 — Grades 5–6

## Pack Code
`g56_math_decimal_money`

## Pack Role
`core`

## Curriculum Unit
`math_decimals_percentages_and_ratios`

## Primary Skills
- `decimals`
- `word_problems`
- `percentages`

## Secondary Skills
- `data_interpretation`
- `number_sense`

## Theme
Students use money contexts to reason with decimals, totals, and simple discounts.

## Why this pack exists
Money is one of the cleanest ways to make decimals feel practical and meaningful for upper-band students.

## Activity Family

### 1. Illustrated clue reading — decimals
- Skill: `decimals`
- Type: `illustrated_clue`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Suma precios con decimales",
  "mission_description": "Lee la situación y decide el total correcto.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "image_prompt": "school snack stand showing two prices 1.25 and 2.50",
    "passage": "En la merienda escolar, un jugo cuesta 1.25 y un sándwich cuesta 2.50.",
    "question": "¿Cuánto cuestan juntos?",
    "options": [
      { "id": "a", "text": "3.25", "image_url": null },
      { "id": "b", "text": "3.50", "image_url": null },
      { "id": "c", "text": "3.75", "image_url": null },
      { "id": "d", "text": "4.25", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "c"
  }
}
```

### 2. Multiple choice — word_problems
- Skill: `word_problems`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Resuelve el problema de dinero",
  "mission_description": "Piensa en el total y el cambio.",
  "instructions_es": "Escoge la respuesta correcta.",
  "content": {
    "passage": "Luis compra una libreta por 4.75 y paga con 5.00.",
    "question": "¿Cuánto cambio recibe?",
    "options": [
      { "id": "a", "text": "0.15", "image_url": null },
      { "id": "b", "text": "0.25", "image_url": null },
      { "id": "c", "text": "0.35", "image_url": null },
      { "id": "d", "text": "1.25", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "b"
  }
}
```

### 3. Multiple choice — percentages
- Skill: `percentages`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Piensa en un descuento simple",
  "mission_description": "Lee el precio y el porcentaje antes de responder.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "passage": "Un cuaderno cuesta 10.00 y tiene 20% de descuento.",
    "question": "¿Cuánto se descuenta?",
    "options": [
      { "id": "a", "text": "1.00", "image_url": null },
      { "id": "b", "text": "2.00", "image_url": null },
      { "id": "c": "3.00", "text": "3.00", "image_url": null },
      { "id": "d", "text": "5.00", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "b"
  }
}
```

### 4. Multiple choice — data_interpretation
- Skill: `data_interpretation`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "friendly_challenge",
  "mission_title": "Lee la tabla de precios",
  "mission_description": "Piensa qué producto cuesta más.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "passage": "Tabla de precios: Lápiz = 0.75, Borrador = 0.50, Libreta = 2.25, Regla = 1.10.",
    "question": "¿Cuál cuesta más?",
    "options": [
      { "id": "a", "text": "Lápiz", "image_url": null },
      { "id": "b", "text": "Borrador", "image_url": null },
      { "id": "c", "text": "Libreta", "image_url": null },
      { "id": "d", "text": "Regla", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "c"
  }
}
```

---

# Recommended Next Math Wave

The next structured math wave should be:
- Grade 2 → `g2_math_measure_and_compare`
- Grades 3–4 → `g34_math_fraction_parts`
- Grades 5–6 → `g56_math_ratio_tables`

## Why these next
- Grade 2 still needs stronger `measurement`
- Grades 3–4 need broader `fractions`
- Grades 5–6 need `ratios_proportions` introduced more explicitly

---

# Final Summary

You now have a second structured math wave that extends the curriculum in the same architecture as reading:
- `g2_math_place_value_blocks`
- `g34_math_share_and_divide`
- `g56_math_decimal_money`

This keeps the math track clean, intentional, and ready for continued structured growth.

