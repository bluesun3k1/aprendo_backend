# Aprendo Backend — Frontend Change Log

**Last updated:** 2026-03-25  
**Covers:** All changes made after the initial contract (`aprendo_backend_contract.md`) was written.  
**Audience:** Flutter / frontend team.

> Where an original contract shape is shown, it is labelled **[WAS]**. The correct live shape is labelled **[NOW]**.

---

## Summary of Breaking / Additive Changes

| # | Area | Type | Impact |
|---|---|---|---|
| 1 | Activity object | Additive | 3 new fields on every activity |
| 2 | Activity types | Additive | 3 new `type` values |
| 3 | Attempt submission | Additive (old names still work) | New preferred field names |
| 4 | `GET session/today` response | Additive | New `status` field |
| 5 | `POST session/complete` response | **Breaking** | Shape completely changed |
| 6 | New endpoints | Additive | Session queue, curriculum, skill detail |
| 7 | `math` domain | Additive | New domain + skills not in original contract |
| 8 | New skills across all domains | Additive | New skill slugs |
| 9 | `illustrated_clue` scoring | Known limitation | Always scores as incorrect server-side |
| 10 | `POST session/complete` — `milestones_unlocked` | Additive | New field in session complete response |
| 11 | Domain milestones system | New feature | New endpoint + expanded data shape |
| 12 | Badge system — expanded columns | Additive + Breaking | Badge objects now have 5 new fields; response sorted by `sort_order` |
| 13 | Mission system — expanded table + new types | Additive + Breaking | Mission objects have 6 new fields; 5 new mission types; missions now in `/rewards` response |

---

## 1. Activity Object — New Fields

Every activity returned from any session or diagnostic endpoint now includes three additional fields.

**[WAS]** (original contract shape):
```json
{
  "id": "uuid",
  "type": "multiple_choice",
  "domain": "reading",
  "skill_id": "uuid",
  "skill_name": "main_idea",
  "difficulty": 2,
  "instructions": "string",
  "duration_seconds": null,
  "content": {}
}
```

**[NOW]** (live shape):
```json
{
  "id": "uuid",
  "type": "multiple_choice",
  "domain": "reading",
  "skill_id": "uuid",
  "skill_name": "main_idea",
  "difficulty": 2,
  "instructions": "string",
  "lesson_mood": "curious | calm | mission | friendly_challenge | puzzle | null",
  "mission_title": "string | null",
  "mission_description": "string | null",
  "duration_seconds": null,
  "content": {}
}
```

### New Fields

| Field | Type | Description |
|---|---|---|
| `lesson_mood` | `string \| null` | Tone hint for UI theming/animation. Values: `curious`, `calm`, `mission`, `friendly_challenge`, `puzzle`. Most activities have one; diagnostic activities will be `null`. |
| `mission_title` | `string \| null` | Short title (≤60 chars) displayed as the activity header in the Flutter UI. |
| `mission_description` | `string \| null` | Subtitle/context line (≤140 chars) displayed below the title. |

> **Recommendation:** Render `mission_title` as the activity card heading. Fall back to `instructions` if null.

---

## 2. New Activity Types

Two new `type` values have been added to the ENUM. One additional type (`illustrated_clue`) was added in a prior phase but was never documented.

### Full type list (live)

| Value | Was in contract | Notes |
|---|---|---|
| `multiple_choice` | ✅ | Unchanged |
| `drag_to_sort` | ✅ | Unchanged (new preferred response shape — see §3) |
| `tap_sequence` | ✅ | Unchanged (new preferred response shape — see §3) |
| `illustrated_clue` | ❌ | New — image + passage + MC question. See §2.1 |
| `storybook_reading` | ❌ | New — multi-page story + MC question at end. See §2.2 |
| `story_strip_sequencing` | ❌ | New — ordered visual strips (like `tap_sequence` but with comic-panel UI). See §2.3 |

---

### 2.1 `illustrated_clue`

A single image + short passage + multiple-choice question. Used to activate inference and reasoning through a visual prompt.

**Content shape:**
```json
{
  "image_url": null,
  "image_prompt": "small school garden with dry soil and drooping flowers",
  "passage": "Las hojas estaban bajas y la tierra no tenía humedad.",
  "question": "¿Qué podemos inferir?",
  "options": [
    { "id": "a", "text": "Las plantas necesitaban agua.", "image_url": null },
    { "id": "b", "text": "Las plantas tenían demasiada sombra.", "image_url": null },
    { "id": "c", "text": "Las plantas eran nuevas.", "image_url": null }
  ]
}
```

**Response payload (attempt submission):**
```json
{
  "response": {
    "selected_option_id": "a"
  }
}
```

> **`image_url`** will be `null` in V1. `image_prompt` is the description that will be used to generate/select images in a later phase. Render a placeholder or themed illustration in the meantime.

> ⚠️ **Known backend limitation:** `illustrated_clue` submissions are currently always evaluated server-side as **incorrect** (the type is not yet handled in the correctness checker). This means it will always return `"correct": false` and apply a negative `score_delta`. A fix will be deployed in the next backend patch. For now, the Flutter app may want to suppress the "incorrect" feedback animation for this type, or treat it as a non-scored observation activity.

---

### 2.2 `storybook_reading`

A multi-page illustrated story followed by a comprehension question. Pages are presented sequentially (like a book/slideshow). The question appears after the last page.

**Content shape:**
```json
{
  "pages": [
    {
      "id": "p1",
      "title": "La rutina de Eva",
      "text": "Eva esperó el autobús en la esquina con su mochila roja.",
      "image_prompt": "child with red backpack waiting at bus stop on a sunny morning"
    },
    {
      "id": "p2",
      "title": "Eva sube al autobús",
      "text": "Cuando llegó el autobús, Eva esperó su turno y subió sin empujar.",
      "image_prompt": "child politely boarding school bus one at a time"
    }
  ],
  "question": {
    "prompt": "¿Cuál es la idea principal de la historia?",
    "options": [
      { "id": "a", "text": "Eva siguió la rutina segura en la parada.", "image_url": null },
      { "id": "b", "text": "Eva llegó tarde al autobús.", "image_url": null },
      { "id": "c", "text": "El autobús era de color rojo.", "image_url": null }
    ]
  }
}
```

**Response payload (attempt submission):**
```json
{
  "response": {
    "selected_option_id": "a"
  }
}
```

**Evaluation:** identical to `multiple_choice` — `selected_option_id` is compared against `correct_option_id` server-side.

> `image_prompt` on each page is a V1 placeholder. Render a themed scene illustration or solid-color card in the meantime.

---

### 2.3 `story_strip_sequencing`

A set of illustrated story panels (strips) that the student must drag into the correct narrative order. Functionally identical to `tap_sequence` but the UI should present visual story cards rather than text chips.

**Content shape:**
```json
{
  "strips": [
    {
      "id": "s1",
      "text": "Samuel llegó a la escuela y fue al gimnasio.",
      "image_prompt": "child entering school gym with backpack"
    },
    {
      "id": "s2",
      "text": "Samuel fue al aula y no encontró su mochila.",
      "image_prompt": "child looking around empty desk for backpack"
    },
    {
      "id": "s3",
      "text": "Samuel repasó mentalmente sus pasos de la mañana.",
      "image_prompt": "child thinking with thought bubble showing morning steps"
    },
    {
      "id": "s4",
      "text": "Samuel fue al gimnasio y encontró su mochila.",
      "image_prompt": "happy child picking up backpack in gym"
    }
  ],
  "instructions": "Arrastra las tiras en el orden correcto."
}
```

**Response payload (attempt submission):**
```json
{
  "response": {
    "tapped_ids": ["s1", "s2", "s3", "s4"]
  }
}
```

**Evaluation:** the submitted `tapped_ids` array is compared in order against the server-side `sequence`.

---

## 3. Attempt Submission — Updated Field Names

The server now accepts **both** the original field names and new preferred names for all activity types. The old names will continue to work indefinitely, but new code should use the new names.

| Type | Old field name | New preferred name |
|---|---|---|
| `multiple_choice` | `chosen_option_id` | `selected_option_id` |
| `storybook_reading` | `chosen_option_id` | `selected_option_id` |
| `illustrated_clue` | `chosen_option_id` | `selected_option_id` |
| `drag_to_sort` | `zones: { zone_id: [item_ids] }` | `placements: [{ item_id, zone_id }]` |
| `tap_sequence` | `sequence: [ids]` | `tapped_ids: [ids]` |
| `story_strip_sequencing` | `sequence: [ids]` | `tapped_ids: [ids]` |

### New `drag_to_sort` response shape (preferred)

**[WAS]:**
```json
{
  "response": {
    "zones": {
      "zone_a": ["item_1", "item_3"],
      "zone_b": ["item_2", "item_4"]
    }
  }
}
```

**[NOW — preferred]:**
```json
{
  "response": {
    "placements": [
      { "item_id": "item_1", "zone_id": "zone_a" },
      { "item_id": "item_3", "zone_id": "zone_a" },
      { "item_id": "item_2", "zone_id": "zone_b" },
      { "item_id": "item_4", "zone_id": "zone_b" }
    ]
  }
}
```

Both shapes are accepted. The server normalises internally before evaluating.

---

## 4. `GET /api/v1/student/session/today` — New `status` Field

**[WAS]:**
```json
{
  "session_id": "uuid",
  "estimated_duration_minutes": 12,
  "domains": ["reading", "attention"],
  "activities": [...]
}
```

**[NOW]:**
```json
{
  "session_id": "uuid",
  "status": "pending | in_progress | completed",
  "estimated_duration_minutes": 12,
  "domains": ["reading", "attention"],
  "activities": [...]
}
```

`status` reflects the current state of the session. Use it to decide whether to show a "Resume" vs "Start" CTA.

---

## 5. `POST /api/v1/student/session/{session_id}/complete` — Breaking Change

The response shape has changed entirely.

**[WAS] (original contract):**
```json
{
  "session_summary": {
    "total_activities": 5,
    "correct": 4,
    "accuracy_pct": 80,
    "average_response_time_ms": 4100,
    "domains_covered": ["reading", "attention"],
    "points_earned": 25
  },
  "badges_unlocked": [
    {
      "id": "uuid",
      "name": "Primera racha",
      "description": "Completaste 3 días seguidos",
      "icon_url": "string"
    }
  ],
  "streak": {
    "current": 3,
    "best": 5
  }
}
```

**[NOW] (live):**
```json
{
  "success": true,
  "xp_awarded": 45,
  "new_level": 3,
  "levelled_up": false,
  "streak_days": 3,
  "band_advanced": false,
  "placement_band": "early | middle | upper",
  "unit_completed": false,
  "next_unit_unlocked": false
}
```

### Field reference

| Field | Type | Description |
|---|---|---|
| `success` | `bool` | Always `true` on 200. |
| `xp_awarded` | `int` | XP points awarded for this session. Show in the post-session celebration screen. |
| `new_level` | `int` | Student's current level after this session. |
| `levelled_up` | `bool` | `true` if the student crossed a level threshold — trigger level-up animation. |
| `streak_days` | `int` | Current consecutive-day streak after this session. |
| `band_advanced` | `bool` | `true` if the student was promoted to the next grade band (`early→middle→upper`). |
| `placement_band` | `string` | Student's current band after the session. |
| `unit_completed` | `bool` | `true` if this session completed a curriculum unit. |
| `next_unit_unlocked` | `bool` | `true` if completing this unit unlocked the next one. |

> **What to display post-session:** Use `xp_awarded` + `levelled_up` for the XP bar animation. Use `streak_days` for the streak card. Poll `GET /api/v1/student/rewards` for badge details — badge unlocks are computed server-side but not returned inline here.

> **Session summary stats** (accuracy %, correct count, etc.) are computed from the attempts already submitted during the session. Compute them client-side from the running attempt results, or call `GET /api/v1/student/sessions/{session_id}` for the completed session record.

---

## 6. New Endpoints

All require `Authorization: Bearer {token}` and `Content-Type: application/json`.

---

### 6.1 `GET /api/v1/student/sessions`

Session queue listing. **Replaces** `GET /session/today` as the primary session discovery endpoint. `GET /session/today` still works and is kept for backwards compatibility.

**Without query params** — full structured queue:
```json
{
  "current_session": { ...session_queue_item },
  "next_sessions":   [ ...session_queue_item ],
  "completed_sessions": [ ...session_queue_item ],
  "bonus_sessions":  [ ...session_queue_item ]
}
```

**With `?status=available`** — flat playable list (recommended for home screen):
```json
{
  "sessions": [ ...session_queue_item ]
}
```

**With `?status=available&limit=N`** — capped at N items (default 5, max 20).

#### Session queue item shape
```json
{
  "session_id": "uuid",
  "title": "Sesión 3 · Lectura y Atención",
  "status": "pending | in_progress | completed",
  "session_type": "core | bonus | review | practice",
  "sequence_number": 3,
  "estimated_duration_minutes": 12,
  "domains": ["reading", "attention"],
  "activities_completed": 2,
  "total_activities": 5,
  "is_resumable": true,
  "is_bonus": false,
  "unlocked": true,
  "completed_at": "2026-03-24T14:30:00Z | null"
}
```

| Field | Notes |
|---|---|
| `title` | Auto-generated by the server from `session_type` + `sequence_number` + domains. Display as-is. |
| `is_resumable` | `true` when `status = in_progress` AND at least one activity already completed. Show "Continuar" instead of "Iniciar". |
| `is_bonus` | `true` for non-core session types. Render with a bonus badge in the UI. |
| `unlocked` | `false` means prior core sessions must be completed first. Render as locked. |

---

### 6.2 `GET /api/v1/student/sessions/{session_id}`

Full session detail including all activities. Use this to load a session before starting it (instead of `GET /session/today`).

```json
{
  "session_id": "uuid",
  "status": "pending | in_progress | completed",
  "session_type": "core | bonus | review | practice",
  "sequence_number": 3,
  "title": "Sesión 3 · Lectura",
  "estimated_duration_minutes": 12,
  "domains": ["reading"],
  "activities_completed": 0,
  "total_activities": 5,
  "activities": [ ...activity objects ]
}
```

Activity objects follow the shape in §1 (including the new `lesson_mood`, `mission_title`, `mission_description` fields).

---

### 6.3 `GET /api/v1/student/sessions/{session_id}/skill-evidence`

Per-skill evidence breakdown for a completed session. Use on the post-session summary screen.

---

### 6.4 `GET /api/v1/student/curriculum-track`

Full curriculum track overview with all units and their completion status.

```json
{
  "curriculum_track": {
    "track_id": "uuid",
    "code": "reading-early-v1",
    "label": "Lectura temprana",
    "version": "1.0",
    "band": "early",
    "status": "active | completed",
    "started_at": "2026-03-20T10:00:00Z",
    "units": [
      {
        "unit_id": "uuid",
        "code": "U01",
        "title": "Idea principal",
        "description": "Comprende la idea central de textos cortos.",
        "sort_order": 1,
        "estimated_sessions": 4,
        "mastery_threshold": 70,
        "status": "completed | active | locked",
        "started_at": "2026-03-20T10:00:00Z | null",
        "completed_at": "2026-03-22T09:15:00Z | null"
      }
    ]
  }
}
```

Returns `{ "curriculum_track": null }` if no track has been assigned yet.

---

### 6.5 `GET /api/v1/student/current-unit`

Active curriculum unit with per-skill mastery progress. Use for the learning map / unit progress screen.

```json
{
  "current_unit": {
    "unit_id": "uuid",
    "code": "U02",
    "title": "Detalles de apoyo",
    "description": "Identifica los detalles que apoyan la idea principal.",
    "sort_order": 2,
    "mastery_threshold": 70,
    "sessions_total": 4,
    "sessions_completed": 2,
    "started_at": "2026-03-22T09:15:00Z",
    "skills": [
      {
        "skill_id": "uuid",
        "skill_name": "supporting_details",
        "skill_label": "Detalles de apoyo",
        "priority_weight": 1.0,
        "target_mastery_min": 60,
        "target_mastery_goal": 75,
        "current_mastery": 55,
        "trend": "up | stable | down"
      }
    ]
  }
}
```

Returns `{ "current_unit": null }` if no active unit.

---

### 6.6 `GET /api/v1/student/session-queue`

Curriculum-backed session queue (blueprint-level detail). Lower-level than `GET /sessions` — use `GET /sessions` for the home screen and this one only if you need curriculum blueprint metadata.

```json
{
  "queue": [
    {
      "queue_item_id": "uuid",
      "queue_order": 1,
      "session_kind": "core | bonus | review",
      "status": "pending | available | completed | skipped",
      "available_at": "2026-03-25T00:00:00Z | null",
      "session_id": "uuid | null",
      "blueprint": {
        "curriculum_session_id": "uuid",
        "title": "Sesión de comprensión lectora",
        "session_type": "core",
        "estimated_minutes": 12,
        "unit_title": "Idea principal"
      }
    }
  ]
}
```

---

### 6.7 `GET /api/v1/student/skills/{skill_id}/detail`

Detailed mastery stats for a single skill. Use on the skill detail drill-down screen.

---

### 6.8 `GET /api/v1/student/skills/{skill_id}/score-history`

Score history timeseries for a single skill. Use for the per-skill progress chart.

---

## 7. New `math` Domain

The `math` domain was not in the original contract. It is now fully seeded and active.

| Field | Value |
|---|---|
| `id` | `math` |
| `label_es` | `Matemáticas` |
| `label_en` | `Mathematics` |

Math activities are now included in sessions for students whose curriculum track includes math units. The `domains` array on session objects may include `"math"`.

---

## 8. Updated Skills Reference

### New skills added in Phase 10

| Domain | Slug | Label (es) | Label (en) |
|---|---|---|---|
| `reading` | `cause_effect` | Causa y efecto | Cause & Effect |
| `math` | `multiplication` | Multiplicación | Multiplication |
| `math` | `division` | División | Division |
| `math` | `data_analysis` | Análisis de datos | Data Analysis |
| `math` | `operations_with_decimals` | Operaciones con decimales | Operations with Decimals |

### Full math domain skills (previously undocumented)

| Slug | Label (es) | Label (en) |
|---|---|---|
| `number_sense` | Sentido numérico | Number Sense |
| `place_value` | Valor posicional | Place Value |
| `addition_subtraction` | Suma y resta | Addition & Subtraction |
| `multiplication` | Multiplicación | Multiplication |
| `division` | División | Division |
| `fractions` | Fracciones | Fractions |
| `decimals` | Decimales | Decimals |
| `operations_with_decimals` | Operaciones con decimales | Operations with Decimals |
| `data_analysis` | Análisis de datos | Data Analysis |
| `data_interpretation` | Interpretación de datos | Data Interpretation |
| `patterns_sequences` | Patrones y secuencias | Patterns & Sequences |
| `measurement` | Medición | Measurement |
| `geometry_basics` | Geometría básica | Basic Geometry |
| `word_problems` | Problemas de palabras | Word Problems |
| `multiplication_division` | Multiplicación y división | Multiplication & Division |
| `percentages` | Porcentajes | Percentages |
| `ratios_proportions` | Razones y proporciones | Ratios & Proportions |
| `integers` | Números enteros | Integers |
| `algebra_basics` | Álgebra básica | Basic Algebra |
| `equations` | Ecuaciones | Equations |
| `statistics_basics` | Estadística básica | Basic Statistics |

### `reading` domain — new skill

| Slug | Label (es) | Label (en) |
|---|---|---|
| `cause_effect` | Causa y efecto | Cause & Effect |

> Note: `cause_effect` also exists in the `reasoning` domain (`reasoning.cause_effect`). These are separate skills with separate mastery scores. `reading.cause_effect` is exercised through reading comprehension activities; `reasoning.cause_effect` through logical reasoning activities.

---

## 9. Activity Content Shapes — Full Reference (Updated)

### `multiple_choice`
```json
{
  "passage": "string | null",
  "question": "string",
  "options": [
    { "id": "a", "text": "string", "image_url": null }
  ]
}
```
**Submit:** `{ "selected_option_id": "a" }` (or legacy `chosen_option_id`)

---

### `drag_to_sort`
```json
{
  "instructions": "string",
  "items": [
    { "id": "item_1", "text": "string", "image_url": null }
  ],
  "zones": [
    { "id": "zone_a", "label": "string" },
    { "id": "zone_b", "label": "string" }
  ]
}
```
**Submit (preferred):** `{ "placements": [{ "item_id": "item_1", "zone_id": "zone_a" }, ...] }`  
**Submit (legacy):** `{ "zones": { "zone_a": ["item_1"], "zone_b": ["item_2"] } }`

---

### `tap_sequence`
```json
{
  "instructions": "string",
  "items": [
    { "id": "item_1", "text": "string" }
  ],
  "time_limit_seconds": 30
}
```
**Submit:** `{ "tapped_ids": ["item_2", "item_1", "item_3"] }` (or legacy `sequence`)

---

### `illustrated_clue` ⚠️
```json
{
  "image_url": null,
  "image_prompt": "description of image for rendering/generation",
  "passage": "string",
  "question": "string",
  "options": [
    { "id": "a", "text": "string", "image_url": null }
  ]
}
```
**Submit:** `{ "selected_option_id": "a" }`  
⚠️ Server always returns `"correct": false` for this type until the backend fix is deployed. Do not penalise the student in the UI for this type.

---

### `storybook_reading`
```json
{
  "pages": [
    {
      "id": "p1",
      "title": "string",
      "text": "string",
      "image_prompt": "string"
    }
  ],
  "question": {
    "prompt": "string",
    "options": [
      { "id": "a", "text": "string", "image_url": null }
    ]
  }
}
```
**Submit:** `{ "selected_option_id": "a" }` (same as `multiple_choice`)  
**Flow:** Render pages one by one (swipe/next). Show `question` after the last page.

---

### `story_strip_sequencing`
```json
{
  "strips": [
    {
      "id": "s1",
      "text": "string",
      "image_prompt": "string"
    }
  ],
  "instructions": "string"
}
```
**Submit:** `{ "tapped_ids": ["s2", "s1", "s3", "s4"] }` (order matters — correct order wins)  
**Flow:** Render strips as draggable cards/panels in a shuffled order. Student reorders them. Submit the final order as `tapped_ids`.

---

## 10. Activity Count Reference (Seeded V1)

| Band | Grade | Activities |
|---|---|---|
| `early` | G2 | 109 |
| `middle` | G3–4 | 106 |
| `upper` | G5–6 | 107 |
| **Total** | | **322** |

| Domain | Activities |
|---|---|
| `reading` | 234 |
| `attention` | 32 |
| `reasoning` | 32 |
| `math` | 24 |

---

## 11. Domain Milestones System (Phase 11)

### Overview

Domain milestones are named achievements unlocked when a student's **aggregate domain mastery score** crosses a threshold. They are the primary visible progression system above individual skill scores.

- 5 thresholds per domain: **20 / 40 / 60 / 80 / 95**
- 4 domains: `reading`, `attention`, `reasoning`, `math`
- **20 milestones total**
- Each milestone awards a **XP bonus** when first unlocked
- Each milestone carries a **celebration level** to control animation intensity
- Unlocks are **backfilled** — if a student jumps from 30 to 65 in one session, both the 40 and 60 milestones unlock at once

---

### 11.1 New Endpoint: `GET /api/v1/student/milestones`

Returns all domain milestones with per-student unlock status, grouped by domain.

```
GET /api/v1/student/milestones
Authorization: Bearer {token}
```

**Response:**
```json
{
  "total_earned": 3,
  "total_available": 20,
  "domains": [
    {
      "domain_id": "reading",
      "domain_label": "Comprensión lectora",
      "domain_score": 47,
      "next_milestone": {
        "id": 3,
        "threshold": 60,
        "name": "Navegante lector",
        "description": "Estás comprendiendo mejor las ideas principales y los detalles importantes.",
        "icon": "map",
        "reward_xp": 25,
        "celebration_level": "medium",
        "earned": false,
        "earned_at": null,
        "source_score": null,
        "progress": 0.78
      },
      "milestones": [
        {
          "id": 1,
          "threshold": 20,
          "name": "Primer lector",
          "description": "Ya estás dando tus primeros pasos para entender mejor lo que lees.",
          "icon": "book-open",
          "reward_xp": 10,
          "celebration_level": "small",
          "earned": true,
          "earned_at": "2026-03-22T10:15:00Z",
          "source_score": 23,
          "progress": 1.0
        },
        {
          "id": 2,
          "threshold": 40,
          "name": "Explorador de lectura",
          "description": "Sigues descubriendo pistas importantes en los textos. ¡Sigue avanzando!",
          "icon": "compass",
          "reward_xp": 15,
          "celebration_level": "small",
          "earned": true,
          "earned_at": "2026-03-24T09:30:00Z",
          "source_score": 42,
          "progress": 1.0
        },
        {
          "id": 3,
          "threshold": 60,
          "name": "Navegante lector",
          "description": "Estás comprendiendo mejor las ideas principales y los detalles importantes.",
          "icon": "map",
          "reward_xp": 25,
          "celebration_level": "medium",
          "earned": false,
          "earned_at": null,
          "source_score": null,
          "progress": 0.78
        }
      ]
    }
  ]
}
```

#### Milestone object fields

| Field | Type | Description |
|---|---|---|
| `id` | `int` | Stable numeric ID for the milestone. |
| `threshold` | `int` | Domain mastery score required to unlock (20 / 40 / 60 / 80 / 95). |
| `name` | `string` | Short display name. Render as the milestone title. |
| `description` | `string` | One-sentence celebration text shown when unlocked or viewed in the map. |
| `icon` | `string` | Icon slug for asset lookup. See §11.3 for the full icon list. |
| `reward_xp` | `int` | XP bonus awarded at unlock. Show on the celebration screen. |
| `celebration_level` | `string` | `small` \| `medium` \| `big` — controls animation intensity. |
| `earned` | `bool` | Whether this student has unlocked this milestone. |
| `earned_at` | `ISO 8601 string \| null` | Timestamp of unlock. |
| `source_score` | `int \| null` | The domain score at the moment of unlock. |
| `progress` | `float` | `0.0–1.0`. Progress toward this threshold from the student's current domain score. `1.0` when earned. |

#### `next_milestone`
The first unearned milestone in that domain. Use this to drive progress bar UI — show `next_milestone.name` as the goal and `next_milestone.progress` as the fill percentage.

---

### 11.2 Updated: `POST /api/v1/student/session/{session_id}/complete`

The session completion response now includes `milestones_unlocked`.

**[WAS]:**
```json
{
  "success": true,
  "xp_awarded": 45,
  "new_level": 3,
  "levelled_up": false,
  "streak_days": 3,
  "band_advanced": false,
  "placement_band": "early",
  "unit_completed": false,
  "next_unit_unlocked": false
}
```

**[NOW]:**
```json
{
  "success": true,
  "xp_awarded": 55,
  "new_level": 3,
  "levelled_up": false,
  "streak_days": 3,
  "band_advanced": false,
  "placement_band": "early",
  "unit_completed": false,
  "next_unit_unlocked": false,
  "milestones_unlocked": [
    {
      "id": 1,
      "domain_id": "reading",
      "name": "Primer lector",
      "description": "Ya estás dando tus primeros pasos para entender mejor lo que lees.",
      "threshold": 20,
      "icon": "book-open",
      "reward_xp": 10,
      "celebration_level": "small"
    }
  ]
}
```

`milestones_unlocked` is an **array** (empty `[]` when none unlocked this session). When non-empty, trigger a milestone celebration screen **after** the XP/level animations.

> **XP note:** `xp_awarded` now includes milestone bonus XP. If the student unlocked a `reward_xp: 10` milestone, that 10 XP is already folded into `xp_awarded`. Do not add it again.

---

### 11.3 Milestone Icons

The `icon` field is a string slug. Map these to your Flutter asset/icon system:

| Slug | Suggested use |
|---|---|
| `book-open` | Reading domain — entry milestone |
| `compass` | Explorer milestones (threshold 40 across all domains) |
| `map` | Navigator milestones (threshold 60 — reading, reasoning) |
| `star` | Threshold 80 — reading |
| `eye` | Attention domain — entry milestone |
| `shield` | Threshold 60 — attention |
| `zap` | Threshold 80 — attention |
| `lightbulb` | Reasoning domain — entry milestone |
| `target` | Threshold 80 — reasoning, math |
| `calculator` | Math domain — entry milestone |
| `chart-bar` | Threshold 60 — math |
| `trophy` | Mastery milestone (threshold 95, all domains) |

---

### 11.4 Milestone Ladder Reference

| Domain | Threshold | Name | `celebration_level` | `reward_xp` |
|---|---|---|---|---|
| `reading` | 20 | Primer lector | `small` | 10 |
| `reading` | 40 | Explorador de lectura | `small` | 15 |
| `reading` | 60 | Navegante lector | `medium` | 25 |
| `reading` | 80 | Guía lector | `big` | 40 |
| `reading` | 95 | Maestro lector | `big` | 60 |
| `attention` | 20 | Primer enfoque | `small` | 10 |
| `attention` | 40 | Explorador de enfoque | `small` | 15 |
| `attention` | 60 | Guardián de atención | `medium` | 25 |
| `attention` | 80 | Centinela del enfoque | `big` | 40 |
| `attention` | 95 | Maestro de atención | `big` | 60 |
| `reasoning` | 20 | Primer pensador | `small` | 10 |
| `reasoning` | 40 | Explorador lógico | `small` | 15 |
| `reasoning` | 60 | Navegante lógico | `medium` | 25 |
| `reasoning` | 80 | Estratega lógico | `big` | 40 |
| `reasoning` | 95 | Maestro del razonamiento | `big` | 60 |
| `math` | 20 | Primer matemático | `small` | 10 |
| `math` | 40 | Explorador matemático | `small` | 15 |
| `math` | 60 | Navegante matemático | `medium` | 25 |
| `math` | 80 | Estratega matemático | `big` | 40 |
| `math` | 95 | Maestro matemático | `big` | 60 |

---

### 11.5 Unlock Trigger & Timing

- Milestones are **evaluated once per session**, at `POST session/complete`
- Unlocks are **idempotent** — re-submitting complete never double-awards
- **Backfill:** if a student jumps past multiple thresholds in one session, all are unlocked at once and all appear in `milestones_unlocked`
- XP bonus from milestones is **included in** the `xp_awarded` total returned by `complete`
- The milestone screen should be shown **after** the XP bar animation completes

---

### 11.6 `GET /api/v1/student/skill-map` — `next_unlock` field

The `next_unlock` object already existed in the skill map response. It now uses the live seeded milestone data from `domain_milestones` instead of a static placeholder. Shape is unchanged:

```json
{
  "next_unlock": {
    "name": "Navegante lector",
    "description": "Estás comprendiendo mejor las ideas principales y los detalles importantes.",
    "progress": 0.78
  }
}
```

---

---

## 12. Badge System — Expanded Columns (Phase 13)

### 12.1 What Changed

Five new columns were added to the `badges` table and are now returned by `GET /api/v1/student/rewards`.

| Column | Type | Purpose |
|---|---|---|
| `category` | `string\|null` | Groups badges: `onboarding` / `streak` / `sessions` / `points` |
| `sort_order` | `integer` | Stable display order within the badge list |
| `threshold_value` | `integer\|null` | Numeric target for the badge (e.g. 10 for `streak_10`) |
| `celebration_level` | `string\|null` | Animation intensity hint: `small` / `medium` / `big` |
| `is_hidden` | `boolean` | If `true`, badge is secret — **not returned** in unearned list |

---

### 12.2 Updated `GET /api/v1/student/rewards` — Badge Shape

**[WAS]:**
```json
{
  "id": "uuid",
  "name": "Explorador",
  "description": "Completaste tu primera sesión",
  "icon_url": null,
  "earned": true,
  "earned_at": "2026-03-15T10:00:00+00:00"
}
```

**[NOW]:**
```json
{
  "id": "uuid",
  "name": "Primer paso",
  "description": "Completaste tu primera sesión",
  "icon_url": null,
  "category": "onboarding",
  "sort_order": 1,
  "threshold_value": 1,
  "celebration_level": "small",
  "is_hidden": false,
  "earned": true,
  "earned_at": "2026-03-15T10:00:00+00:00"
}
```

The full array is now **sorted by `sort_order` ascending**. Hidden badges (`is_hidden: true`) are omitted from the unearned list but will appear once earned.

---

### 12.3 Full Badge Reference (12 badges)

| `trigger_type` | `name` | `category` | `threshold_value` | `sort_order` | `celebration_level` |
|---|---|---|---|---|---|
| `first_session` | Primer paso | `onboarding` | 1 | 1 | `small` |
| `streak_3` | Primera racha | `streak` | 3 | 10 | `small` |
| `streak_5` | Constancia | `streak` | 5 | 11 | `medium` |
| `streak_10` | Imparable | `streak` | 10 | 12 | `big` |
| `streak_20` | Racha legendaria | `streak` | 20 | 13 | `big` |
| `sessions_5` | Sesiones en marcha | `sessions` | 5 | 20 | `small` |
| `sessions_10` | Buen ritmo | `sessions` | 10 | 21 | `medium` |
| `sessions_25` | Sigue creciendo | `sessions` | 25 | 22 | `medium` |
| `sessions_50` | Entrenamiento sólido | `sessions` | 50 | 23 | `big` |
| `points_100` | Primeros puntos | `points` | 100 | 30 | `small` |
| `points_250` | Puntos en ascenso | `points` | 250 | 31 | `medium` |
| `points_500` | Coleccionista | `points` | 500 | 32 | `big` |

---

### 12.4 `celebration_level` Guide

| Value | Suggested UI behaviour |
|---|---|
| `small` | Subtle confetti burst or toast notification |
| `medium` | Full-screen confetti + badge card slide-in |
| `big` | Lottie celebration + haptic + badge card with glow effect |

Matches the same `celebration_level` values used by domain milestones (Section 11).

---

### 12.5 Badge vs Milestone — Which is Which?

| System | Used for |
|---|---|
| **Badges** | First session, streaks, total session counts, total XP/points |
| **Domain Milestones** | Reading / Attention / Reasoning / Math domain score growth |

These two systems are independent. A student can earn badges and milestones simultaneously from the same `POST session/complete` call. The response includes both:
- `badges_unlocked` — array of badge objects (existing field)
- `milestones_unlocked` — array of milestone objects (added Phase 11)

---

## 13. Mission System — Expanded (Phase 14)

### 13.1 What Changed

The `weekly_missions` table gained 7 new columns and `student_missions` gained `completed_at`. The mission set grew from 2 → 8 definitions covering 4 mission categories and 5 mission types.

---

### 13.2 New `weekly_missions` Columns

| Column | Type | Purpose |
|---|---|---|
| `category` | `string\|null` | Groups missions: `sessions` / `accuracy` / `domain` / `streak` |
| `domain_id` | `string\|null` | Target domain for `domain_sessions_completed` type (e.g. `reading`, `math`) |
| `grade_band` | `string\|null` | `null` = all bands; `early`/`middle`/`upper` for band-specific missions |
| `reward_xp` | `integer` | XP awarded automatically when the student completes the mission |
| `difficulty` | `string\|null` | `easy` / `medium` / `hard` — use for visual difficulty badge |
| `sort_order` | `integer` | Stable display order |
| `is_repeatable` | `boolean` | Always `true` for current missions — resets each week |

### 13.3 New `student_missions` Columns

| Column | Type | Purpose |
|---|---|---|
| `completed_at` | `timestamp\|null` | When the student first completed this mission this week |

---

### 13.4 Mission Types

| `mission_type` | Tracked by | Progress logic |
|---|---|---|
| `sessions_completed` | Sessions finished | +1 per completed session |
| `correct_answers` | Correct attempt count | +N per session (N = correct answers in that session) |
| `domain_sessions_completed` | Domain match | +1 if session includes `domain_id` |
| `near_perfect_sessions` | Accuracy threshold | +1 if ≤1 wrong answer in a session with ≥1 activity |
| `streak_days` | Current streak | Progress = current streak value (not additive) |

---

### 13.5 Mission Set (8 missions)

| `mission_type` | `target` | `domain_id` | `category` | `difficulty` | `reward_xp` | `sort_order` |
|---|---|---|---|---|---|---|
| `sessions_completed` | 3 | null | `sessions` | `easy` | 20 | 1 |
| `sessions_completed` | 5 | null | `sessions` | `medium` | 35 | 2 |
| `sessions_completed` | 7 | null | `sessions` | `hard` | 55 | 3 |
| `correct_answers` | 10 | null | `accuracy` | `easy` | 20 | 10 |
| `near_perfect_sessions` | 3 | null | `accuracy` | `hard` | 40 | 11 |
| `domain_sessions_completed` | 2 | `reading` | `domain` | `medium` | 25 | 20 |
| `domain_sessions_completed` | 2 | `math` | `domain` | `medium` | 25 | 21 |
| `streak_days` | 3 | null | `streak` | `medium` | 30 | 30 |

---

### 13.6 Updated Mission Shape — `GET /dashboard` and `GET /rewards`

**[WAS]:**
```json
{
  "id": "uuid",
  "label": "Completa 3 sesiones esta semana",
  "progress": 2,
  "target": 3,
  "completed": false
}
```

**[NOW]:**
```json
{
  "id": "uuid",
  "mission_id": "uuid",
  "label": "Completa 3 sesiones esta semana",
  "progress": 2,
  "target": 3,
  "completed": false,
  "completed_at": "2026-03-25T14:00:00+00:00",
  "category": "sessions",
  "difficulty": "easy",
  "reward_xp": 20,
  "domain_id": null,
  "sort_order": 1
}
```

The array is sorted by `sort_order` ascending.

---

### 13.7 `GET /rewards` — `weekly_missions` Now Included

**[WAS]:** `/rewards` did not return missions.

**[NOW]:** `/rewards` includes `weekly_missions` array alongside badges:

```json
{
  "badges": [...],
  "streak_days": 4,
  "total_sessions": 12,
  "total_xp": 480,
  "weekly_missions": [
    {
      "id": "uuid",
      "mission_id": "uuid",
      "label": "Completa 3 sesiones esta semana",
      "progress": 2,
      "target": 3,
      "completed": false,
      "completed_at": null,
      "category": "sessions",
      "difficulty": "easy",
      "reward_xp": 20,
      "domain_id": null,
      "sort_order": 1
    }
  ]
}
```

Note: only missions the student has started this week appear. Missions that haven't been touched yet (no session this week) will not appear until the student completes their first session.

---

### 13.8 `POST session/complete` — New Fields

Two new fields are added to the session complete response:

```json
{
  "success": true,
  "xp_awarded": 95,
  "missions_xp_awarded": 20,
  "missions_completed": [
    {
      "id": "uuid",
      "mission_id": "uuid",
      "label": "Completa 3 sesiones esta semana",
      "category": "sessions",
      "difficulty": "easy",
      "reward_xp": 20,
      "celebration_level": "small",
      "completed_at": "2026-03-25T14:00:00+00:00"
    }
  ],
  "milestones_unlocked": [...],
  "...": "other existing fields"
}
```

| Field | Description |
|---|---|
| `missions_completed` | Array of missions newly completed by this session (empty array if none) |
| `missions_xp_awarded` | Total bonus XP earned from mission completions this session (0 if none) |

The `celebration_level` on a completed mission is derived from `reward_xp`: `big` (≥40), `medium` (≥25), `small` (otherwise). Show a mission completion celebration **after** the normal session XP animation if `missions_completed` is non-empty.

---

### 13.9 System Boundaries

| System | Duration | Reset | Trigger |
|---|---|---|---|
| **Badges** | Permanent | Never | Cumulative stats |
| **Domain Milestones** | Permanent | Never | Domain mastery score |
| **Missions** | Weekly | Monday midnight | Per-session events |

Missions do not carry over between weeks. A new `student_missions` row is created each Monday per mission × student.

## Change Log

| Date | Phase | Change |
|---|---|---|
| 2026-03-21 | Phase 9 | Added `illustrated_clue` type, `lesson_mood`, `mission_title`, `mission_description` fields to activities |
| 2026-03-21 | Phase 9 | `POST session/complete` response shape changed (XP/level/band model replaced summary model) |
| 2026-03-21 | Phase 9 | `GET sessions`, `GET sessions/{id}`, `GET curriculum-track`, `GET current-unit`, `GET session-queue` endpoints added |
| 2026-03-21 | Phase 9 | Updated attempt response field names (`selected_option_id`, `tapped_ids`, `placements`) |
| 2026-03-25 | Phase 10 | Added `storybook_reading` and `story_strip_sequencing` activity types |
| 2026-03-25 | Phase 10 | Added `math` domain with 21 skills |
| 2026-03-25 | Phase 10 | Added `reading.cause_effect` skill |
| 2026-03-25 | Phase 10 | 322 non-diagnostic activities seeded across all bands and domains |
| 2026-03-25 | Phase 11 | Domain milestones system implemented — 20 milestones seeded (5 per domain × 4 domains) |
| 2026-03-25 | Phase 11 | `GET /api/v1/student/milestones` endpoint added |
| 2026-03-25 | Phase 11 | `POST session/complete` response extended with `milestones_unlocked` array |
| 2026-03-25 | Phase 11 | `student_milestones` table created — tracks per-student unlock history |
| 2026-03-25 | Phase 12 | Seeder hygiene: SkillCmsSeeder no longer clobbers DomainMilestoneSeeder data |
| 2026-03-25 | Phase 12 | ActivitySeeder: 9 math diagnostic activities added (3 per band) |
| 2026-03-25 | Phase 12 | SessionSeeder: domain-filtered activity pools, math sessions added |
| 2026-03-25 | Phase 13 | `badges` table: added `category`, `sort_order`, `threshold_value`, `celebration_level`, `is_hidden` columns |
| 2026-03-25 | Phase 13 | Badge set expanded: 7 → 12 badges (new: `streak_20`, `sessions_25`, `sessions_50`, `points_250`) |
| 2026-03-25 | Phase 13 | `GET /rewards` badge objects now include 5 new fields; response sorted by `sort_order` |
| 2026-03-25 | Phase 13 | `RewardService` now checks `streak_20`, `sessions_25`, `sessions_50`, `points_250` trigger types |
| 2026-03-25 | Phase 14 | `weekly_missions` table expanded: added `category`, `domain_id`, `grade_band`, `reward_xp`, `difficulty`, `sort_order`, `is_repeatable` |
| 2026-03-25 | Phase 14 | `student_missions` table: added `completed_at` timestamp |
| 2026-03-25 | Phase 14 | Mission set expanded from 2 → 8 missions across 4 categories and 5 types |
| 2026-03-25 | Phase 14 | `RewardService::updateMissions()` now handles `sessions_completed`, `correct_answers`, `domain_sessions_completed`, `near_perfect_sessions`, `streak_days` |
| 2026-03-25 | Phase 14 | `POST session/complete` response now includes `missions_completed` array + `missions_xp_awarded` |
| 2026-03-25 | Phase 14 | `GET /rewards` now includes `weekly_missions` array |
| 2026-03-25 | Phase 14 | Mission XP bonuses now auto-awarded on mission completion via `XpService` |
