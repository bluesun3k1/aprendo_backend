# Math Domain, Skill Master List, First Curriculum Map, and Wave 1 Packs

This document starts the **math track** using the same structured model already used for reading:

**Grade band → Curriculum unit → Skill targets → Pack → Activity family**

The goal is to make math part of the platform’s skill-training identity, not just a random add-on.

---

# 1. Math Domain Principles

Math should be its own curriculum track.

It should not be mixed loosely into reading packs because math needs:
- its own progression
- its own mastery reporting
- its own adaptive sequencing
- its own activity types and difficulty curves

## Math track identity
This is **not** meant to become a giant traditional textbook curriculum at first.

It should start as:
- math thinking
- number fluency
- pattern recognition
- quantity reasoning
- applied word-problem reasoning
- early pre-algebra thinking

That keeps it aligned with the platform’s purpose: improving how students think and solve, not just memorizing procedures.

---

# 2. Math Skill Master List by Grade Band

Your skills are shared globally in the `skills` table, which is correct.

Band specificity should continue to live in:
- curriculum placement
- seeded activities
- adaptive queries

Below is the recommended first operational map.

## Grade 2 — active math skills
### Core skills
- `number_sense`
- `place_value`
- `addition_subtraction`
- `geometry_basics`
- `measurement`
- `patterns_sequences`
- `word_problems`

### Secondary / light exposure
- `data_interpretation`

## Grades 3–4 — active math skills
### Core skills
- `place_value`
- `addition_subtraction`
- `measurement`
- `patterns_sequences`
- `word_problems`
- `data_interpretation`
- `multiplication_division`
- `fractions`

### Secondary / light exposure
- `geometry_basics`
- `decimals` (late 4 bridge only, light)

## Grades 5–6 — active math skills
### Core skills
- `multiplication_division`
- `fractions`
- `decimals`
- `percentages`
- `ratios_proportions`
- `integers`
- `algebra_basics`
- `equations`
- `data_interpretation`
- `statistics_basics`
- `word_problems`

### Secondary / support skills
- `measurement`
- `patterns_sequences`

---

# 3. First Math Curriculum Map

This is the first curriculum backbone for the math track.

---

## Grade 2 Math Curriculum Map

### Goal
Build concrete number meaning, basic operations, grouping, simple shape/measure thinking, and math in real situations.

### Unit A — Number foundations
**Unit code:** `math_number_foundations`

**Skills:**
- `number_sense`
- `place_value`
- `addition_subtraction`

**Purpose:**
Students understand quantity, number relationships, and simple composing/decomposing.

### Unit B — Patterns, grouping, and early math logic
**Unit code:** `math_patterns_and_groups`

**Skills:**
- `patterns_sequences`
- `classification`
- `word_problems`

**Purpose:**
Students recognize order, repetition, simple rules, and category-based reasoning in math-like contexts.

### Unit C — Shapes and measurement basics
**Unit code:** `math_shapes_and_measurement`

**Skills:**
- `geometry_basics`
- `measurement`
- `word_problems`

**Purpose:**
Students compare size, length, shape, and simple measurable properties.

### Unit D — Story problem basics
**Unit code:** `math_story_problem_basics`

**Skills:**
- `addition_subtraction`
- `word_problems`
- `number_sense`

**Purpose:**
Students solve short everyday problems with small numbers and concrete actions.

---

## Grades 3–4 Math Curriculum Map

### Goal
Strengthen operations, place value, multiplication/division, basic fractions, and interpreting tables or small data displays.

### Unit A — Operations and place value
**Unit code:** `math_operations_and_place_value`

**Skills:**
- `place_value`
- `addition_subtraction`
- `word_problems`

### Unit B — Patterns, measurement, and data
**Unit code:** `math_patterns_measurement_and_data`

**Skills:**
- `patterns_sequences`
- `measurement`
- `data_interpretation`

### Unit C — Multiplication and division foundations
**Unit code:** `math_multiplication_division_foundations`

**Skills:**
- `multiplication_division`
- `word_problems`
- `patterns_sequences`

### Unit D — Fraction and applied problem solving basics
**Unit code:** `math_fraction_and_problem_solving_basics`

**Skills:**
- `fractions`
- `word_problems`
- `data_interpretation`

---

## Grades 5–6 Math Curriculum Map

### Goal
Move into more abstract and flexible numeric reasoning: fractions, decimals, percents, ratios, equations, and evidence-based problem solving.

### Unit A — Number operations and fractions
**Unit code:** `math_number_operations_and_fractions`

**Skills:**
- `multiplication_division`
- `fractions`
- `word_problems`

### Unit B — Decimals, percentages, and ratios
**Unit code:** `math_decimals_percentages_and_ratios`

**Skills:**
- `decimals`
- `percentages`
- `ratios_proportions`

### Unit C — Data, charts, and basic statistics
**Unit code:** `math_data_statistics_and_interpretation`

**Skills:**
- `data_interpretation`
- `statistics_basics`
- `word_problems`

### Unit D — Pre-algebra and equations
**Unit code:** `math_pre_algebra_and_equations`

**Skills:**
- `algebra_basics`
- `equations`
- `integers`

### Unit E — Multi-step applied problem solving
**Unit code:** `math_multi_step_problem_solving`

**Skills:**
- `word_problems`
- `ratios_proportions`
- `data_interpretation`

---

# 4. Recommended Math Activity Templates

The math track should prioritize these templates first:

## Keep from current system
- `multiple_choice`
- `tap_sequence`
- `drag_to_sort`

## Add as math-first templates
- `number_line_tap`
- `equation_builder`
- `table_chart_reading`
- `quantity_compare`
- `word_problem_choice`
- `fraction_visual_choice`

For Wave 1, we can still build using the existing templates plus a couple of math-friendly shapes in JSON.

---

# 5. Math Wave 1 Strategy

The first wave should establish one math pack per grade band.

These should be deliberately chosen to:
- feel clearly mathematical
- still fit the platform’s skill-training identity
- avoid overcomplicating the first implementation

So Wave 1 will use:
- Grade 2 → number sense + addition/subtraction
- Grades 3–4 → multiplication/division foundations
- Grades 5–6 → fractions + data/percent-style reasoning intro

---

# 6. Math Wave 1 Packs

---

## Pack M1 — Grade 2

### Pack Code
`g2_math_number_friends`

### Pack Role
`core`

### Curriculum Unit
`math_number_foundations`

### Primary Skills
- `number_sense`
- `addition_subtraction`
- `patterns_sequences`

### Secondary Skills
- `word_problems`
- `place_value`

### Theme
Students work with small numbers using objects, simple sums, and patterns.

### Why this pack exists
This is the cleanest way to start Grade 2 math: quantity meaning, number combinations, and very simple sequence recognition.

### Activity Family

#### 1. Storybook math reading
- Skill: `number_sense`
- Type: `storybook_reading`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "playful",
  "mission_title": "Cuenta los amigos del número",
  "mission_description": "Lee la historia y piensa cuántos objetos hay en total.",
  "instructions_es": "Lee las páginas y responde.",
  "content": {
    "pages": [
      {
        "id": "p1",
        "title": "Botones en la mesa",
        "text": "Lina puso 3 botones rojos en la mesa. Luego agregó 2 botones azules.",
        "image_prompt": "child placing 3 red buttons and 2 blue buttons on a classroom table"
      },
      {
        "id": "p2",
        "title": "Ahora cuenta todos",
        "text": "Lina quiere saber cuántos botones hay ahora en total.",
        "image_prompt": "close view of grouped classroom buttons ready to count"
      }
    ],
    "question": {
      "prompt": "¿Cuántos botones hay en total?",
      "options": [
        { "id": "a", "text": "4", "image_url": null },
        { "id": "b", "text": "5", "image_url": null },
        { "id": "c", "text": "6", "image_url": null }
      ]
    }
  },
  "correct_answer": {
    "correct_option_id": "b"
  }
}
```

#### 2. Multiple choice — addition_subtraction
- Skill: `addition_subtraction`
- Type: `multiple_choice`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Suma los grupos",
  "mission_description": "Junta las cantidades y escoge la respuesta correcta.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "passage": null,
    "question": "3 + 2 = ?",
    "options": [
      { "id": "a", "text": "4", "image_url": null },
      { "id": "b", "text": "5", "image_url": null },
      { "id": "c", "text": "6", "image_url": null },
      { "id": "d", "text": "7", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "b"
  }
}
```

#### 3. Tap sequence — patterns_sequences
- Skill: `patterns_sequences`
- Type: `tap_sequence`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "puzzle",
  "mission_title": "Sigue el patrón",
  "mission_description": "Toca la secuencia en el orden correcto.",
  "instructions_es": "Toca el patrón correcto.",
  "content": {
    "items": [
      { "id": "item_1", "text": "1" },
      { "id": "item_2", "text": "2" },
      { "id": "item_3", "text": "3" },
      { "id": "item_4", "text": "4" }
    ],
    "instructions": "Toca los números de menor a mayor.",
    "time_limit_seconds": 20
  },
  "correct_answer": {
    "sequence": ["item_1", "item_2", "item_3", "item_4"]
  }
}
```

#### 4. Multiple choice — word_problems
- Skill: `word_problems`
- Type: `multiple_choice`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Resuelve el problema corto",
  "mission_description": "Lee y piensa qué operación usar.",
  "instructions_es": "Escoge la respuesta correcta.",
  "content": {
    "passage": "Ana tiene 4 lápices. Su amiga le da 1 más.",
    "question": "¿Cuántos lápices tiene ahora Ana?",
    "options": [
      { "id": "a", "text": "3", "image_url": null },
      { "id": "b", "text": "4", "image_url": null },
      { "id": "c", "text": "5", "image_url": null },
      { "id": "d", "text": "6", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "c"
  }
}
```

---

## Pack M2 — Grades 3–4

### Pack Code
`g34_math_equal_groups`

### Pack Role
`core`

### Curriculum Unit
`math_multiplication_division_foundations`

### Primary Skills
- `multiplication_division`
- `word_problems`
- `patterns_sequences`

### Secondary Skills
- `data_interpretation`
- `place_value`

### Theme
Students work with equal groups, repeated addition, and simple division situations.

### Why this pack exists
This is the best entry point for middle-band math reasoning: multiplication as equal groups, not memorization only.

### Activity Family

#### 1. Illustrated clue reading — multiplication_division
- Skill: `multiplication_division`
- Type: `illustrated_clue`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Cuenta grupos iguales",
  "mission_description": "Lee la situación y decide cuántos objetos hay en total.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "image_prompt": "classroom trays with 3 rows of 4 markers each",
    "passage": "La maestra puso 3 bandejas. En cada bandeja hay 4 marcadores.",
    "question": "¿Cuántos marcadores hay en total?",
    "options": [
      { "id": "a", "text": "7", "image_url": null },
      { "id": "b", "text": "10", "image_url": null },
      { "id": "c", "text": "12", "image_url": null },
      { "id": "d", "text": "14", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "c"
  }
}
```

#### 2. Multiple choice — word_problems
- Skill: `word_problems`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Resuelve el problema de grupos",
  "mission_description": "Piensa qué operación ayuda más.",
  "instructions_es": "Escoge la respuesta correcta.",
  "content": {
    "passage": "Hay 5 mesas. En cada mesa se sientan 2 estudiantes.",
    "question": "¿Cuántos estudiantes se sientan en total?",
    "options": [
      { "id": "a", "text": "7", "image_url": null },
      { "id": "b", "text": "8", "image_url": null },
      { "id": "c", "text": "10", "image_url": null },
      { "id": "d", "text": "12", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "c"
  }
}
```

#### 3. Drag to sort — multiplication_division
- Skill: `multiplication_division`
- Type: `drag_to_sort`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "puzzle",
  "mission_title": "Relaciona grupo y total",
  "mission_description": "Arrastra cada expresión al total correcto.",
  "instructions_es": "Arrastra al grupo correcto.",
  "content": {
    "items": [
      { "id": "item_1", "text": "2 grupos de 3", "image_url": null },
      { "id": "item_2", "text": "4 grupos de 2", "image_url": null },
      { "id": "item_3", "text": "3 grupos de 3", "image_url": null }
    ],
    "zones": [
      { "id": "zone_a", "label": "6" },
      { "id": "zone_b", "label": "8" },
      { "id": "zone_c", "label": "9" }
    ],
    "instructions": "Pon cada grupo en su total correcto."
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

#### 4. Multiple choice — patterns_sequences
- Skill: `patterns_sequences`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "friendly_challenge",
  "mission_title": "Sigue la secuencia de saltos",
  "mission_description": "Piensa qué número viene después.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "passage": null,
    "question": "2, 4, 6, 8, ___",
    "options": [
      { "id": "a", "text": "9", "image_url": null },
      { "id": "b", "text": "10", "image_url": null },
      { "id": "c", "text": "11", "image_url": null },
      { "id": "d", "text": "12", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "b"
  }
}
```

---

## Pack M3 — Grades 5–6

### Pack Code
`g56_math_part_whole_and_data`

### Pack Role
`core`

### Curriculum Unit
`math_data_statistics_and_interpretation`

### Primary Skills
- `fractions`
- `data_interpretation`
- `percentages`

### Secondary Skills
- `word_problems`
- `decimals`

### Theme
Students interpret part-whole relationships, small charts, and simple percent reasoning.

### Why this pack exists
This is a strong upper-band entry pack because it mixes visual math meaning with applied interpretation.

### Activity Family

#### 1. Illustrated clue reading — fractions
- Skill: `fractions`
- Type: `illustrated_clue`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Observa la parte del total",
  "mission_description": "Lee la situación y decide qué fracción representa la parte sombreada.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "image_prompt": "simple classroom pie chart or rectangle divided into 4 equal parts with 3 shaded",
    "passage": "Una figura está dividida en 4 partes iguales y 3 de ellas están sombreadas.",
    "question": "¿Qué fracción está sombreada?",
    "options": [
      { "id": "a", "text": "1/4", "image_url": null },
      { "id": "b", "text": "2/4", "image_url": null },
      { "id": "c", "text": "3/4", "image_url": null },
      { "id": "d", "text": "4/4", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "c"
  }
}
```

#### 2. Multiple choice — data_interpretation
- Skill: `data_interpretation`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Lee la tabla pequeña",
  "mission_description": "Piensa qué dato muestra más estudiantes.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "passage": "Encuesta de merienda favorita: Frutas = 8, Galletas = 5, Yogur = 7, Sándwich = 4.",
    "question": "¿Cuál opción fue la más elegida?",
    "options": [
      { "id": "a", "text": "Frutas", "image_url": null },
      { "id": "b", "text": "Galletas", "image_url": null },
      { "id": "c", "text": "Yogur", "image_url": null },
      { "id": "d", "text": "Sándwich", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

#### 3. Multiple choice — percentages
- Skill: `percentages`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Piensa en porcentaje simple",
  "mission_description": "Lee el total y la parte antes de responder.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "passage": "En un grupo de 10 estudiantes, 5 eligieron frutas.",
    "question": "¿Qué porcentaje eligió frutas?",
    "options": [
      { "id": "a", "text": "25%", "image_url": null },
      { "id": "b", "text": "50%", "image_url": null },
      { "id": "c", "text": "75%", "image_url": null },
      { "id": "d", "text": "100%", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "b"
  }
}
```

#### 4. Multiple choice — word_problems
- Skill: `word_problems`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "friendly_challenge",
  "mission_title": "Resuelve el problema con datos",
  "mission_description": "Usa la información del total y la parte.",
  "instructions_es": "Escoge la mejor respuesta.",
  "content": {
    "passage": "En una caja hay 12 fichas. La mitad son azules.",
    "question": "¿Cuántas fichas son azules?",
    "options": [
      { "id": "a", "text": "4", "image_url": null },
      { "id": "b", "text": "5", "image_url": null },
      { "id": "c", "text": "6", "image_url": null },
      { "id": "d", "text": "8", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "c"
  }
}
```

---

# 7. Recommended Next Math Wave

The next structured math gap-fill wave should be:

- Grade 2 → `g2_math_place_value_blocks`
- Grades 3–4 → `g34_math_share_and_divide`
- Grades 5–6 → `g56_math_decimal_money`

## Why these next
- Grade 2 still needs explicit `place_value`
- Grades 3–4 need stronger `division` in sharing contexts
- Grades 5–6 need a cleaner `decimals` bridge using money contexts

---

# 8. Final Summary

You now have:
- a **math domain skill master map by band usage**
- a **first math curriculum map**
- a **Wave 1 of math packs** using the same structured content system already used for reading

This is enough to begin the math track properly without breaking your current architecture.

