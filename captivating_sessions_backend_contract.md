# Captivating Sessions — Backend Contract Additions

**Status:** Frontend implementing now (March 2026)  
**Scope:** New optional fields for the session/activity API to support mission framing, illustrated lessons, and explanatory feedback. All fields are **backwards-compatible additive changes** — the client handles missing fields gracefully.

---

## Summary of Changes

| Change | Required? | Blocking? |
|---|---|---|
| `lesson_mood` on every activity | Strongly recommended | No — defaults to `challenge` |
| `mission_title` + `mission_description` on activities | Recommended | No — plain mode used when absent |
| `explanation` on each activity option | Recommended | No — feedback shows without it |
| `is_correct` on options in session response | **Not recommended** (security) | N/A — see note |
| New activity type: `illustrated_clue` | Required for that type | Only for `illustrated_clue` activities |
| `image_url` + `image_caption` in `illustrated_clue` content | Required for that type | Only for `illustrated_clue` activities |

---

## 1. New Field: `lesson_mood` (on every activity)

Add this field to every activity object in `GET /api/v1/student/session/today` and `GET /api/v1/student/diagnostic` responses.

**Type:** `string` (enum)  
**Values:** `"illustrated"` | `"challenge"`  
**Default when absent:** Client treats as `"challenge"`

**When to use each value:**

| Mood | Activity types | Domains |
|---|---|---|
| `illustrated` | `multiple_choice`, `illustrated_clue` | `reading` (comprehension, inference, context clues) |
| `challenge` | `tap_sequence`, `drag_to_sort`, any timed activity | `attention`, `reasoning` |

The frontend uses this field to activate the **Mission Card wrapper** visual around the activity. Without it, the header renders as plain text.

```json
{
  "id": "act_mc_001",
  "type": "multiple_choice",
  "lesson_mood": "illustrated",
  ...
}
```

---

## 2. New Fields: `mission_title` and `mission_description` (on activities)

These two string fields appear on the activity header card, providing narrative context before the student sees the question.

**Type:** `string | null`  
**Required:** No — card adapts gracefully when absent  
**Max length:** `mission_title` ≤ 60 chars; `mission_description` ≤ 140 chars

```json
{
  "id": "act_mc_001",
  "type": "multiple_choice",
  "lesson_mood": "illustrated",
  "mission_title": "Help the garden team",
  "mission_description": "Read the short story and pick the idea that best explains what solved the problem.",
  ...
}
```

**Mission title guidelines:**
- Use an imperative action phrase or a scene description
- Always write in the student's language (Spanish for `es` locale)
- Should connect to the passage or scenario being presented
- Examples: `"Ayuda al equipo del jardín"`, `"Elige la pista correcta"`, `"Ordena la historia"`

---

## 3. New Field: `explanation` on answer options

Add an optional `explanation` string to each option in `multiple_choice` and `illustrated_clue` activities. The client will display this immediately after the student answers correctly, making the answer *teach* rather than just confirm.

**Field location:** Inside `content.options[]`  
**Type:** `string | null`  
**Required:** No — `FeedbackOverlay` renders without it

```json
{
  "content": {
    "question": "¿Por qué el sol parece moverse por el cielo?",
    "options": [
      {
        "id": "opt_a",
        "text": "Porque el sol gira alrededor de la Tierra",
        "explanation": null
      },
      {
        "id": "opt_b",
        "text": "Porque la Tierra gira sobre su propio eje",
        "explanation": "¡Correcto! La Tierra gira de oeste a este, lo que hace que el sol parezca moverse por el cielo."
      },
      {
        "id": "opt_c",
        "text": "Porque el viento mueve al sol",
        "explanation": null
      }
    ]
  }
}
```

> **Note on `is_correct`:** The option `is_correct` field must **NOT** be included in production API responses — the correct answer must stay server-side. The client evaluates correctness server-side (via the attempt endpoint) and uses the `explanation` text for the correct option from the **attempt result response** (see section 6 below).

---

## 4. New Activity Type: `illustrated_clue`

A new activity type that presents an illustration, a text passage, and a multiple-choice question. Designed for reading comprehension, inference, and context clue activities.

**`type`:** `"illustrated_clue"`

### Content schema

```json
{
  "id": "act_ic_001",
  "type": "illustrated_clue",
  "domain": "reading",
  "skill_id": "inference",
  "skill_name": "Inferencia",
  "difficulty": 2,
  "instructions": "Observa la imagen y lee el texto. Luego elige la mejor respuesta.",
  "lesson_mood": "illustrated",
  "mission_title": "Encuentra la mejor pista",
  "mission_description": "La imagen y el texto juntos te ayudan a encontrar la respuesta.",
  "content": {
    "image_url": "https://cdn.aprendo.app/images/activities/garden_dry.png",
    "image_caption": "El jardín de la escuela",
    "passage": "Camila miró el jardín y vio tierra seca, flores dobladas y ningún charco cerca de las plantas.",
    "question": "¿Qué necesita el jardín?",
    "options": [
      {
        "id": "opt_a",
        "text": "El jardín necesita más luz solar.",
        "explanation": null
      },
      {
        "id": "opt_b",
        "text": "El jardín necesita agua.",
        "explanation": "Las pistas visuales (tierra seca, flores dobladas) y el texto muestran que le falta agua."
      },
      {
        "id": "opt_c",
        "text": "El jardín necesita macetas más grandes.",
        "explanation": null
      }
    ]
  }
}
```

### Content field reference

| Field | Type | Required | Notes |
|---|---|---|---|
| `image_url` | `string \| null` | No | Absolute URL to illustration. Client renders color placeholder when null. |
| `image_caption` | `string \| null` | No | Short label shown below image. Max 60 chars. |
| `passage` | `string` | **Yes** | Reading text. Max ~300 chars for early band; ~500 chars for upper. |
| `question` | `string` | **Yes** | Question prompt. |
| `options` | `ActivityOption[]` | **Yes** | Same shape as `multiple_choice` options. |

### Attempt response format (unchanged)

```json
{ "chosen_option_id": "opt_b" }
```

---

## 5. Age Band Field (`age_band` on student login response)

The client already derives `age_band` from `grade` on login, but an explicit server field takes priority. This is already documented in the main contract — reminder that it controls how the UI adapts:

| Band | Grades | Illustrated activity layout |
|---|---|---|
| `early` (1–2) | 1–2 | 1:1 image, large text (storybook feel) |
| `middle` (3–5) | 3–5 | 4:3 image, normal body text |
| `upper` (6–9) | 6–9 | Wide 2:1 image, compact clean text |

No action required — field already supported.

---

## 6. Attempt Result Response — `correct_explanation`

Currently the `/student/session/{id}/attempts/bulk` endpoint returns `{"success": true}`. When this endpoint is evolved (Phase 2), include the explanation for the correct option in the response so the client can display it after a wrong answer too:

```json
{
  "success": true,
  "results": [
    {
      "activity_id": "act_mc_001",
      "is_correct": true,
      "correct_option_id": "opt_b",
      "correct_explanation": "La Tierra gira de oeste a este, lo que hace que el sol parezca moverse."
    }
  ]
}
```

> **Phase 1 (current):** The client shows the `explanation` from the selected option when correct. This means explanation text is only shown to students who choose correctly. Phase 2 reconciliation will allow showing the explanation after wrong answers too.

---

## 7. Updated Session Response Example

Full example of `GET /api/v1/student/session/today` with all new fields:

```json
{
  "session_id": "ses_today_001",
  "date": "2026-03-21",
  "status": "pending",
  "total_activities": 5,
  "estimated_duration_minutes": 12,
  "domains": ["reading", "attention", "reasoning"],
  "activities": [
    {
      "id": "act_mc_001",
      "type": "multiple_choice",
      "domain": "reading",
      "skill_id": "reading_comprehension",
      "skill_name": "Comprensión lectora",
      "difficulty": 2,
      "instructions": "Lee el texto y responde la pregunta.",
      "lesson_mood": "illustrated",
      "mission_title": "Ayuda al equipo del jardín",
      "mission_description": "Lee la historia corta y elige la idea que mejor explica lo que resolvió el problema.",
      "content": {
        "passage": "Camila notó que el jardín de la escuela estaba reseco. Organizó un pequeño grupo de compañeros para regar las plantas cada mañana antes de clase.",
        "question": "¿Por qué Camila organizó a sus compañeros?",
        "options": [
          { "id": "opt_a", "text": "Le gustaba llegar temprano a la escuela.", "explanation": null },
          { "id": "opt_b", "text": "Quería que el jardín se recuperara.", "explanation": "¡Exacto! Camila vio el problema y tomó acción para que el jardín volviera a estar verde." },
          { "id": "opt_c", "text": "Quería quedarse después de la escuela.", "explanation": null },
          { "id": "opt_d", "text": "La pidieron participar en un concurso de jardines.", "explanation": null }
        ]
      }
    },
    {
      "id": "act_ic_001",
      "type": "illustrated_clue",
      "domain": "reading",
      "skill_id": "inference",
      "skill_name": "Inferencia",
      "difficulty": 2,
      "instructions": "Observa la imagen y lee el texto. Luego elige la mejor respuesta.",
      "lesson_mood": "illustrated",
      "mission_title": "Encuentra la mejor pista",
      "mission_description": "La imagen y el texto juntos te ayudan a encontrar la respuesta.",
      "content": {
        "image_url": "https://cdn.aprendo.app/images/activities/garden_dry.png",
        "image_caption": "El jardín de la escuela",
        "passage": "Camila miró el jardín y vio tierra seca, flores dobladas y ningún charco cerca de las plantas.",
        "question": "¿Qué necesita el jardín?",
        "options": [
          { "id": "opt_a", "text": "El jardín necesita más luz solar.", "explanation": null },
          { "id": "opt_b", "text": "El jardín necesita agua.", "explanation": "Las pistas visuales (tierra seca, flores dobladas) y el texto muestran que le falta agua." },
          { "id": "opt_c", "text": "El jardín necesita macetas más grandes.", "explanation": null }
        ]
      }
    },
    {
      "id": "act_ds_001",
      "type": "drag_to_sort",
      "domain": "reasoning",
      "skill_id": "logical_sequencing",
      "skill_name": "Secuenciación lógica",
      "difficulty": 2,
      "instructions": "Ordena los pasos del ciclo del agua.",
      "lesson_mood": "challenge",
      "mission_title": "Ordena los pasos",
      "mission_description": "Coloca cada paso en el orden correcto del ciclo.",
      "content": {
        "items": [
          { "id": "item_a", "text": "El agua se evapora del mar" },
          { "id": "item_b", "text": "Se forman nubes" },
          { "id": "item_c", "text": "Llueve sobre la tierra" },
          { "id": "item_d", "text": "El agua regresa al mar por los ríos" }
        ],
        "zones": [
          { "id": "zone_1", "label": "Paso 1", "correct_item_id": "item_a" },
          { "id": "zone_2", "label": "Paso 2", "correct_item_id": "item_b" },
          { "id": "zone_3", "label": "Paso 3", "correct_item_id": "item_c" },
          { "id": "zone_4", "label": "Paso 4", "correct_item_id": "item_d" }
        ]
      }
    },
    {
      "id": "act_ts_001",
      "type": "tap_sequence",
      "domain": "attention",
      "skill_id": "working_memory",
      "skill_name": "Memoria de trabajo",
      "difficulty": 2,
      "instructions": "Toca los números en orden del menor al mayor.",
      "lesson_mood": "challenge",
      "mission_title": "Misión de enfoque",
      "mission_description": "Toca rápido y con precisión.",
      "content": {
        "time_limit_seconds": 30,
        "items": [
          { "id": "seq_3", "text": "3", "correct_order": 1 },
          { "id": "seq_7", "text": "7", "correct_order": 4 },
          { "id": "seq_1", "text": "1", "correct_order": 0 },
          { "id": "seq_5", "text": "5", "correct_order": 2 },
          { "id": "seq_9", "text": "9", "correct_order": 5 },
          { "id": "seq_6", "text": "6", "correct_order": 3 }
        ]
      }
    },
    {
      "id": "act_mc_002",
      "type": "multiple_choice",
      "domain": "attention",
      "skill_id": "selective_attention",
      "skill_name": "Atención selectiva",
      "difficulty": 3,
      "instructions": "¿Cuál de estas figuras es diferente a las demás?",
      "lesson_mood": "challenge",
      "mission_title": "Encuentra el intruso",
      "mission_description": "Observa bien. Solo una figura es diferente.",
      "content": {
        "passage": null,
        "question": "Observa: 🔺🔺🔺🔷🔺 — ¿Cuál es el intruso?",
        "options": [
          { "id": "opt_a", "text": "Primera figura", "explanation": null },
          { "id": "opt_b", "text": "Segunda figura", "explanation": null },
          { "id": "opt_c", "text": "Cuarta figura", "explanation": "La cuarta figura es un rombo (🔷), mientras que las demás son triángulos (🔺)." },
          { "id": "opt_d", "text": "Quinta figura", "explanation": null }
        ]
      }
    }
  ]
}
```

---

## 8. Content Skeleton Admin Tool

When creating activities in the CMS/admin panel, the following fields should be exposed as optional text inputs per activity:

| Field | UI label | Notes |
|---|---|---|
| `lesson_mood` | Mood | Dropdown: Illustrated / Challenge |
| `mission_title` | Mission title | Short headline for the card |
| `mission_description` | Mission description | 1–2 sentence story context |

For options within `multiple_choice` and `illustrated_clue`:

| Field | UI label | Notes |
|---|---|---|
| `explanation` | Explanation (for correct answer) | Only fill for the correct option |

---

## 9. Validation Rules

- `lesson_mood` must be one of `"illustrated"` or `"challenge"` (or omitted).
- `mission_title` max 60 characters.
- `mission_description` max 140 characters.
- `explanation` max 200 characters.
- `image_url` for `illustrated_clue` must be an absolute HTTPS URL or null.
- `image_caption` max 60 characters.
- `passage` in `illustrated_clue` must be non-empty.
- `illustrated_clue` must have at least 2 and at most 4 options.

---

## 10. Rollout

These are **non-breaking additive changes**. The frontend gracefully degrades:

- Missing `lesson_mood` → renders plain activity header (no mission card)
- Missing `mission_title` / `mission_description` → uses raw `instructions` text
- Missing `explanation` → feedback overlay shows message without explanation
- Missing `image_url` on `illustrated_clue` → renders domain-color placeholder block

Recommend deploying `lesson_mood` + `mission_title` + `mission_description` together in the first backend release, and `explanation` + `illustrated_clue` support in a follow-up since they require more content authoring effort.
