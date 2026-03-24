# Structured Content System + Wave 11

This document corrects the production approach so content is built in the right order:

**Grade band → Curriculum unit → Skill targets → Pack → Activity family**

The goal is to avoid writing broad topic packs without first knowing:
- which skills the pack must cover
- which curriculum unit it belongs to
- which activity types must appear
- whether the pack is core, review, or support content

---

# 1. Required Content Structure

## 1.1 Grade band
Every pack belongs to exactly one grade band.

Current production bands:
- `grade_2`
- `grades_3_4`
- `grades_5_6`

## 1.2 Curriculum unit
Every pack must map to exactly one curriculum unit.

Examples already in use:
- `early_reading_basics`
- `middle_reading_interpretation`
- `upper_advanced_reading`

## 1.3 Primary skill targets
Every pack must have:
- **2–3 primary skills**
- **1–2 secondary skills**

Primary skills are the skills the pack is supposed to generate strongest evidence for.

## 1.4 Activity family requirements
Every pack should contain at minimum:
- 1 anchor reading activity (`storybook_reading` or `illustrated_clue`)
- 2 skill questions tied to the same passage/scene
- 1 non-multiple-choice activity when appropriate
- 1 activity that produces clear mastery evidence for a primary skill

## 1.5 Pack role
Each pack should be labeled as one of:
- `core`
- `review`
- `support`
- `assessment_support`

Current content should mostly be treated as `core`.

---

# 2. Skill Coverage Rules by Grade Band

## Grade 2 — required recurring skills
### Core skill coverage targets
- `main_idea`
- `supporting_details`
- `sequencing`
- `classification`
- `cause_effect`
- `instruction_following`
- `compare_contrast` (intro)

### Activity balance target
- 1 storybook or illustrated anchor
- 1 sequencing / tap task
- 1 details / main idea question
- 1 simple classification or cause/effect task

## Grades 3–4 — required recurring skills
### Core skill coverage targets
- `inference`
- `context_clues`
- `summarization`
- `supporting_details`
- `compare_contrast`
- `cause_effect`
- `decision_making`
- `problem_solving`

### Activity balance target
- 1 illustrated anchor
- 2 reading interpretation tasks
- 1 sequence/sort/problem task
- 1 decision/evidence task when possible

## Grades 5–6 — required recurring skills
### Core skill coverage targets
- `evaluating_evidence`
- `identifying_purpose`
- `fact_vs_opinion`
- `compare_contrast`
- `inference`
- `problem_solving`
- `decision_making`
- `summarization`

### Activity balance target
- 1 article-style illustrated anchor
- 2 evidence/purpose/claim tasks
- 1 compare/problem/decision task
- 1 fact vs opinion or summary task

---

# 3. Wave 11 Strategy

Wave 11 should not just add more themes.
It should fill **curriculum and skill gaps**.

## Current priority gaps
### Grade 2
Need more:
- `instruction_following`
- `selective_attention`
- `compare_contrast`

### Grades 3–4
Need more:
- `problem_solving`
- `decision_making`
- `context_clues`

### Grades 5–6
Need more:
- `fact_vs_opinion`
- `decision_making`
- `summarization`

So Wave 11 is designed to target those gaps deliberately.

---

# 4. Wave 11 Packs

## Pack 31 — Grade 2

### Pack Code
`g2_classroom_rules_day`

### Pack Role
`core`

### Curriculum Unit
`early_reading_basics`

### Primary Skills
- `instruction_following`
- `sequencing`
- `supporting_details`

### Secondary Skills
- `main_idea`
- `selective_attention`

### Theme
A class follows simple classroom routines and rules during the day.

### Why this pack exists
This pack is intentionally designed to strengthen **instruction following**, which needs more repeated support in Grade 2.

### Activity Family

#### 1. Storybook reading
- Skill: `main_idea`
- Type: `storybook_reading`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Sigue el día de reglas del aula",
  "mission_description": "Lee la historia y descubre lo más importante sobre la clase.",
  "instructions_es": "Lee las páginas y responde la pregunta.",
  "content": {
    "pages": [
      {
        "id": "p1",
        "title": "Empieza la mañana",
        "text": "La maestra recordó tres reglas: escuchar, levantar la mano y guardar los materiales después de usarlos.",
        "image_prompt": "teacher in classroom showing simple class rules poster to children"
      },
      {
        "id": "p2",
        "title": "Todos colaboran",
        "text": "Durante el día, la clase siguió las reglas para trabajar en orden y terminar las actividades a tiempo.",
        "image_prompt": "students following classroom routines respectfully and organizing materials"
      }
    ],
    "question": {
      "prompt": "¿Cuál es la idea principal de la historia?",
      "options": [
        { "id": "a", "text": "La clase siguió reglas para trabajar mejor durante el día.", "image_url": null },
        { "id": "b", "text": "La clase olvidó todas las reglas del aula.", "image_url": null },
        { "id": "c", "text": "Nadie usó materiales en la clase.", "image_url": null }
      ]
    }
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

#### 2. Multiple choice — instruction following
- Skill: `instruction_following`
- Type: `multiple_choice`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Sigue la instrucción correcta",
  "mission_description": "Lee con cuidado antes de responder.",
  "instructions_es": "Lee toda la instrucción antes de responder.",
  "content": {
    "passage": "Si terminaste tu trabajo, guarda el lápiz y pon el cuaderno en la bandeja azul. Si todavía no terminas, sigue escribiendo.",
    "question": "Si ya terminaste tu trabajo, ¿qué haces?",
    "options": [
      { "id": "a", "text": "Guardo el lápiz y pongo el cuaderno en la bandeja azul.", "image_url": null },
      { "id": "b", "text": "Salgo del aula sin avisar.", "image_url": null },
      { "id": "c", "text": "Rompo la hoja y vuelvo a empezar.", "image_url": null },
      { "id": "d", "text": "Tiro el cuaderno al suelo.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

#### 3. Tap sequence — classroom routine
- Skill: `sequencing`
- Type: `tap_sequence`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Ordena la rutina del aula",
  "mission_description": "Toca los pasos en el orden correcto.",
  "instructions_es": "Toca los eventos en el orden correcto.",
  "content": {
    "items": [
      { "id": "item_1", "text": "Escuchar la instrucción" },
      { "id": "item_2", "text": "Hacer la actividad" },
      { "id": "item_3", "text": "Guardar los materiales" }
    ],
    "instructions": "Toca lo que pasa primero, después y al final.",
    "time_limit_seconds": 25
  },
  "correct_answer": {
    "sequence": ["item_1", "item_2", "item_3"]
  }
}
```

#### 4. Multiple choice — supporting details
- Skill: `supporting_details`
- Type: `multiple_choice`
- Difficulty: `1`
- Diagnostic: `0`

```json
{
  "lesson_mood": "friendly_challenge",
  "mission_title": "Busca el detalle importante",
  "mission_description": "Escoge la pista que apoya la idea principal.",
  "instructions_es": "Escoge el detalle correcto.",
  "content": {
    "passage": "La maestra recordó levantar la mano, escuchar y guardar materiales después de usarlos.",
    "question": "¿Qué detalle muestra cómo la clase trabajó en orden?",
    "options": [
      { "id": "a", "text": "Guardaron materiales después de usarlos.", "image_url": null },
      { "id": "b", "text": "Había ventanas en el aula.", "image_url": null },
      { "id": "c", "text": "La clase tenía reloj.", "image_url": null },
      { "id": "d", "text": "Algunos niños llevaban mochilas.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

## Pack 32 — Grades 3–4

### Pack Code
`g34_tool_trouble`

### Pack Role
`core`

### Curriculum Unit
`middle_reading_interpretation`

### Primary Skills
- `problem_solving`
- `decision_making`
- `context_clues`

### Secondary Skills
- `supporting_details`
- `summarization`

### Theme
During a classroom project, a group’s tool stops working and they must figure out the best next step.

### Why this pack exists
This pack is intentionally designed to increase **problem solving** and **decision making** evidence in Grades 3–4.

### Activity Family

#### 1. Illustrated clue reading — problem solving
- Skill: `problem_solving`
- Type: `illustrated_clue`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Resuelve el problema del proyecto",
  "mission_description": "Lee la situación y decide cuál es la mejor solución.",
  "instructions_es": "Lee y escoge la mejor solución.",
  "content": {
    "image_prompt": "students in classroom project with broken measuring cup and supplies on table",
    "passage": "Durante un experimento, el vaso medidor del grupo se rompió. Todavía quedaban materiales en la mesa y otro grupo ya había terminado de usar el suyo.",
    "question": "¿Cuál sería la mejor solución?",
    "options": [
      { "id": "a", "text": "Pedir prestado el vaso del otro grupo y continuar con cuidado.", "image_url": null },
      { "id": "b", "text": "Abandonar el proyecto sin intentarlo más.", "image_url": null },
      { "id": "c", "text": "Usar la mano para medir el agua exactamente.", "image_url": null },
      { "id": "d", "text": "Esconder el problema para que nadie lo note.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

#### 2. Multiple choice — decision making
- Skill: `decision_making`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Escoge la mejor decisión",
  "mission_description": "Piensa cuál acción ayuda más al grupo.",
  "instructions_es": "Escoge la mejor decisión.",
  "content": {
    "passage": "Tu grupo tiene poco tiempo para terminar el proyecto y necesita una herramienta que ya no funciona.",
    "question": "¿Qué decisión sería mejor?",
    "options": [
      { "id": "a", "text": "Buscar ayuda o una alternativa útil para terminar bien.", "image_url": null },
      { "id": "b", "text": "Pelear por otra herramienta con otro grupo.", "image_url": null },
      { "id": "c", "text": "Romper más materiales para empezar de nuevo.", "image_url": null },
      { "id": "d", "text": "Ignorar el problema y entregar el trabajo incompleto sin revisar.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

#### 3. Multiple choice — context clues
- Skill: `context_clues`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "friendly_challenge",
  "mission_title": "Usa las pistas del texto",
  "mission_description": "Escoge el significado correcto usando el contexto.",
  "instructions_es": "Lee y usa las pistas de la oración.",
  "content": {
    "passage": "El grupo buscó una alternativa para continuar el experimento sin detenerse por completo.",
    "question": "¿Qué significa 'alternativa' en este texto?",
    "options": [
      { "id": "a", "text": "Otra opción o solución", "image_url": null },
      { "id": "b", "text": "Una pared del aula", "image_url": null },
      { "id": "c", "text": "Una lista de asistencia", "image_url": null },
      { "id": "d", "text": "Un error imposible de corregir", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

#### 4. Multiple choice — summarization
- Skill: `summarization`
- Type: `multiple_choice`
- Difficulty: `2`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Resume lo más importante",
  "mission_description": "Escoge el resumen que mejor cuenta el problema y la solución.",
  "instructions_es": "Escoge el mejor resumen.",
  "content": {
    "passage": "Cuando una herramienta se dañó en medio del proyecto, el grupo pensó en una solución práctica para continuar sin rendirse.",
    "question": "¿Cuál es el mejor resumen?",
    "options": [
      { "id": "a", "text": "El grupo tuvo un problema durante el proyecto y buscó una manera útil de seguir trabajando.", "image_url": null },
      { "id": "b", "text": "El grupo decidió no hacer nada y esperar a otra clase.", "image_url": null },
      { "id": "c", "text": "Todas las herramientas del aula se rompieron a la vez.", "image_url": null },
      { "id": "d", "text": "El proyecto trataba sobre paredes y ventanas del aula.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

## Pack 33 — Grades 5–6

### Pack Code
`g56_claims_and_sources`

### Pack Role
`core`

### Curriculum Unit
`upper_advanced_reading`

### Primary Skills
- `fact_vs_opinion`
- `evaluating_evidence`
- `identifying_purpose`

### Secondary Skills
- `compare_contrast`
- `summarization`

### Theme
Students compare a bold online claim with a more careful informational source.

### Why this pack exists
This pack is intentionally designed to increase **fact vs opinion** and **source evaluation** coverage in Grades 5–6.

### Activity Family

#### 1. Illustrated article reading — evaluating evidence
- Skill: `evaluating_evidence`
- Type: `illustrated_clue`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "curious",
  "mission_title": "Compara una afirmación con su fuente",
  "mission_description": "Lee ambos mensajes y decide cuál está mejor respaldado.",
  "instructions_es": "Escoge la afirmación mejor respaldada por evidencia.",
  "content": {
    "image_prompt": "student looking at tablet with bold online claim and printed informational source side by side",
    "passage": "Mensaje A: 'Esta bebida mejora la memoria al instante en todos los estudiantes'. Fuente B: 'Un pequeño estudio observó cambios en algunos participantes, pero recomienda más investigación antes de sacar conclusiones generales'.",
    "question": "¿Qué conclusión está mejor respaldada?",
    "options": [
      { "id": "a", "text": "La segunda fuente es más cuidadosa y reconoce límites en la evidencia.", "image_url": null },
      { "id": "b", "text": "La primera afirmación demuestra un resultado seguro para todos.", "image_url": null },
      { "id": "c", "text": "Ambos mensajes dicen exactamente lo mismo con el mismo nivel de evidencia.", "image_url": null },
      { "id": "d", "text": "No hay ninguna diferencia entre una afirmación llamativa y una fuente explicativa.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

#### 2. Multiple choice — fact vs opinion
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
      { "id": "a", "text": "Ese producto es el mejor invento de la historia.", "image_url": null },
      { "id": "b", "text": "El estudio mencionado tuvo un grupo pequeño de participantes.", "image_url": null },
      { "id": "c", "text": "Las bebidas de colores siempre ayudan a pensar mejor.", "image_url": null },
      { "id": "d", "text": "Toda investigación emocionante es totalmente verdadera.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "b"
  }
}
```

#### 3. Multiple choice — identifying purpose
- Skill: `identifying_purpose`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "calm",
  "mission_title": "Identifica el propósito de la fuente",
  "mission_description": "Piensa por qué fue escrito el segundo texto.",
  "instructions_es": "Escoge el propósito principal.",
  "content": {
    "passage": "La segunda fuente explica qué observó un estudio, aclara que la evidencia todavía es limitada y recomienda investigar más antes de hacer afirmaciones amplias.",
    "question": "¿Cuál es el propósito principal del segundo texto?",
    "options": [
      { "id": "a", "text": "Informar con cuidado sobre lo que se sabe y lo que aún no está claro.", "image_url": null },
      { "id": "b", "text": "Vender un producto usando promesas exageradas.", "image_url": null },
      { "id": "c", "text": "Contar una historia de ficción sobre estudiantes.", "image_url": null },
      { "id": "d", "text": "Burlarse de toda investigación científica.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

#### 4. Multiple choice — compare and contrast
- Skill: `compare_contrast`
- Type: `multiple_choice`
- Difficulty: `3`
- Diagnostic: `0`

```json
{
  "lesson_mood": "mission",
  "mission_title": "Compara dos tipos de mensajes",
  "mission_description": "Observa cómo cambian el tono y la evidencia.",
  "instructions_es": "Escoge la mejor comparación.",
  "content": {
    "passage": "El mensaje A usa palabras absolutas como 'todos' e 'instantemente'. La fuente B usa expresiones como 'algunos participantes' y 'se necesita más investigación'.",
    "question": "¿Cuál es la mejor comparación?",
    "options": [
      { "id": "a", "text": "El mensaje A es más absoluto; la fuente B es más cuidadosa y limitada en sus conclusiones.", "image_url": null },
      { "id": "b", "text": "La fuente B es más exagerada que el mensaje A.", "image_url": null },
      { "id": "c", "text": "Ambos usan exactamente el mismo tono y las mismas palabras.", "image_url": null },
      { "id": "d", "text": "Ninguno de los textos intenta comunicar una idea clara.", "image_url": null }
    ]
  },
  "correct_answer": {
    "correct_option_id": "a"
  }
}
```

---

# Running Totals After Structured Wave 11

With structured Wave 11, the draft set now extends beyond broad pack expansion and starts to target specific skill gaps:
- Grade 2 gains stronger `instruction_following`
- Grades 3–4 gain stronger `problem_solving` and `decision_making`
- Grades 5–6 gain stronger `fact_vs_opinion` and source evaluation

This is the correct direction for future waves.

## Recommended next structured gap-fill wave
- Grade 2 → `g2_find_the_rule` or `g2_listen_and_sort`
- Grades 3–4 → `g34_two_solutions` or `g34_clue_letters`
- Grades 5–6 → `g56_data_vs_claims` or `g56_article_and_ad`

