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

---

## 11. Session `status` Field — **BLOCKING for correct UX**

**Problem observed:** After a student completes a session and returns to the Session tab, `GET /student/session/today` returns the same session object again (even after the complete call). The frontend re-runs the session from scratch.

**Fix required:** The session response **must include a `status` field**, and that field **must reflect the current completion state**:

```json
{
  "session_id": "ses_today_001",
  "status": "completed",
  ...
}
```

| Value | Meaning |
|---|---|
| `pending` | Session has not been started |
| `in_progress` | Session started but not finalised |
| `completed` | Student finished this session (`/complete` was called successfully) |

The frontend now reads this field on every load. When `status == "completed"`, it shows a "¡Sesión completada!" screen instead of replaying the session. If the field is absent, the client defaults to `"pending"` (backwards-compatible), so no session will be skipped — but the student will see the session again.

**Affected endpoint:** `GET /api/v1/student/session/today`

---

## 12. Additional Sessions (Extra Practice)  — **Backlog item for Phase 2**

Currently the Session tab only surfaces one session per day (`/student/session/today`). Students who complete their daily session and want more practice have no pathway forward.

**Proposed backend support:**

### Option A: Extra practice on demand
```
GET /api/v1/student/session/extra
```
Returns a dynamically generated short session (3–5 activities) targeting the student's weakest domain. Returns `404` or `{"available": false}` if no extra practice is ready.

### Option B: Session history
```
GET /api/v1/student/sessions?status=available&limit=5
```
Returns a list of sessions the student can play: today's (if pending), plus up to 4 additional practice packs.

**Frontend display:** The Session tab will show a "Práctica extra" card below today's completed session card (similar to how the home tab shows domain progress). Already wired up to navigate to the session player — just needs the endpoint.

**Content recommendations for extra sessions:**
- Focus on the 1–2 domains with lowest `mastery_score`
- Mix activity types (don't repeat the same type twice consecutively)
- 3 activities max for extra sessions (vs 5 for daily)
- Never repeat an activity the student answered correctly in the last 7 days

---

## 13. Session Queue Endpoint — **BLOCKING for session queue feature**

### Product Decisions (confirmed March 2026)

| # | Decision | Rule |
|---|---|---|
| 1 | **Core session ordering** | Strictly sequential — session N+1 is locked until session N is `completed`. |
| 2 | **Bonus/review/practice ordering** | Always freely available — never locked. |
| 3 | **Stacked incomplete sessions** | Oldest `in_progress` session = primary CTA ("Resume now"). Newer incomplete/pending sessions = secondary display ("Coming up"). Max 2 secondaries shown to avoid overwhelming the student. |

These decisions are final and inform the schema below.

---

### New Endpoint

```
GET /api/v1/student/sessions
```

Replaces `GET /student/session/today`. Returns the student's full session queue: current, upcoming, completed (recent), and bonus sessions.

---

### Response Schema

```json
{
  "current_session": "SessionQueueItem | null",
  "next_sessions": "SessionQueueItem[]",
  "completed_sessions": "SessionQueueItem[]",
  "bonus_sessions": "SessionQueueItem[]"
}
```

---

### `SessionQueueItem` Field Reference

| Field | Type | Required | Notes |
|---|---|---|---|
| `session_id` | `string` | Yes | Unique session identifier |
| `title` | `string` | Yes | e.g., `"Sesión 3 · Comprensión y memoria"` |
| `status` | `string` | Yes | `pending` \| `in_progress` \| `completed` |
| `session_type` | `string` | Yes | `core` \| `bonus` \| `review` \| `practice` |
| `sequence_number` | `integer \| null` | Yes for core | Position in the core track (1-indexed). `null` for non-core sessions. |
| `estimated_duration_minutes` | `integer` | Yes | Shown in the UI session card |
| `domains` | `string[]` | Yes | e.g., `["reading", "attention"]` |
| `activities_completed` | `integer` | Yes | `0` if not started. Used to resume mid-session. |
| `total_activities` | `integer` | Yes | Total activities in this session |
| `is_resumable` | `boolean` | Yes | `true` when `status == "in_progress"` and `activities_completed > 0` |
| `is_bonus` | `boolean` | Yes | `true` when `session_type != "core"` |
| `unlocked` | `boolean` | Yes | `true` if the student can access this session. Core: only true when all previous core sessions are `completed`. Bonus/review/practice: always `true`. |
| `completed_at` | `string \| null` | No | ISO 8601 datetime. Only present when `status == "completed"`. |

---

### Queue Cursor Rules (backend)

1. **`current_session`** — always the **oldest** `in_progress` session first. If no `in_progress` exists, the next unlocked `pending` core session. If the student has 3 stacked incomplete sessions from missed days, the oldest one becomes `current_session`; the newer ones appear in `next_sessions`.
2. **`next_sessions`** — next 1–3 sessions after `current_session` in the core sequence, regardless of lock state (student can see what's ahead). Include any newer stacked `in_progress` sessions here too (not in `completed_sessions`).
3. **`completed_sessions`** — last 5 completed sessions, most recent first.
4. **`bonus_sessions`** — all available `bonus` / `review` / `practice` sessions, always unlocked.

### Locking Rules

| Session type | Unlock condition |
|---|---|
| `core` | All core sessions with `sequence_number < N` must be `completed` |
| `bonus` | Always unlocked (`unlocked: true`) |
| `review` | Always unlocked |
| `practice` | Always unlocked |

---

### Example Response

```json
{
  "current_session": {
    "session_id": "ses_core_003",
    "title": "Sesión 3 · Comprensión y memoria",
    "status": "in_progress",
    "session_type": "core",
    "sequence_number": 3,
    "estimated_duration_minutes": 12,
    "domains": ["reading", "attention"],
    "activities_completed": 2,
    "total_activities": 5,
    "is_resumable": true,
    "is_bonus": false,
    "unlocked": true,
    "completed_at": null
  },
  "next_sessions": [
    {
      "session_id": "ses_core_004",
      "title": "Sesión 4 · Razonamiento y secuencias",
      "status": "pending",
      "session_type": "core",
      "sequence_number": 4,
      "estimated_duration_minutes": 10,
      "domains": ["reasoning"],
      "activities_completed": 0,
      "total_activities": 5,
      "is_resumable": false,
      "is_bonus": false,
      "unlocked": false,
      "completed_at": null
    }
  ],
  "completed_sessions": [
    {
      "session_id": "ses_core_002",
      "title": "Sesión 2 · Inferencia y atención",
      "status": "completed",
      "session_type": "core",
      "sequence_number": 2,
      "estimated_duration_minutes": 12,
      "domains": ["reading", "attention"],
      "activities_completed": 5,
      "total_activities": 5,
      "is_resumable": false,
      "is_bonus": false,
      "unlocked": true,
      "completed_at": "2026-03-20T15:42:00Z"
    }
  ],
  "bonus_sessions": [
    {
      "session_id": "ses_bonus_001",
      "title": "Práctica extra · Lectura rápida",
      "status": "pending",
      "session_type": "bonus",
      "sequence_number": null,
      "estimated_duration_minutes": 6,
      "domains": ["reading"],
      "activities_completed": 0,
      "total_activities": 3,
      "is_resumable": false,
      "is_bonus": true,
      "unlocked": true,
      "completed_at": null
    }
  ]
}
```

---

### Individual Session Detail Endpoint

When the player loads a session (new or resumed), it fetches full activity data:

```
GET /api/v1/student/sessions/{session_id}
```

The response must include `activities_completed` so the client can start the activity player at the correct index (skipping already-completed activities for resumed sessions).

```json
{
  "session_id": "ses_core_003",
  "status": "in_progress",
  "session_type": "core",
  "sequence_number": 3,
  "activities_completed": 2,
  "total_activities": 5,
  "activities": [ "...full activity objects as in Section 7..." ]
}
```

> The client will skip the first `activities_completed` items in the `activities` array and begin playback at that index.

---

### UX Rules (frontend reference)

These rules are derived from the product decisions above and inform how the queue data maps to UI states:

| Student state | Primary CTA | Secondary display |
|---|---|---|
| Has `in_progress` session | "Continuar sesión" (oldest `in_progress`) | Up to 2 newer sessions shown as "Próximamente" |
| No `in_progress`, has unlocked `pending` core | "Iniciar sesión N" | Next 1–2 pending shown as "Próximamente" |
| All core complete | "¡Lo lograste!" summary card | Bonus sessions shown prominently |
| No sessions available | Empty state / check back screen | — |

Bonus sessions are always shown below the core queue, never as the primary CTA unless all core sessions are complete.

---

### Deprecated Endpoint

`GET /api/v1/student/session/today` is **deprecated** in favor of `GET /api/v1/student/sessions`. Keep serving it for backwards compatibility until the frontend migration is released. Coordinate deprecation timing with the frontend team.

---

## 14. Skill Map — `student_level` and `next_unlock` Fields

**Endpoint:** `GET /api/v1/student/skill-map`  
**Status:** Frontend implementing now (March 2026) — displaying with placeholder mock data until backend delivers.  
**Type:** Additive, non-breaking — client handles missing fields gracefully.

---

### New Top-Level Fields

| Field | Type | Required? | Notes |
|---|---|---|---|
| `student_level` | `integer` | Recommended | Student's current level. Shown in the "Level N" pill on the Current Focus card. Defaults to `1` when absent. |
| `next_unlock` | `object \| null` | Recommended | Next achievement/milestone the student is working toward. Card is hidden when field is absent or null. |

---

### `next_unlock` Object Schema

| Field | Type | Required | Notes |
|---|---|---|---|
| `name` | `string` | Yes | Display name of the achievement, e.g. `"Reading Pathfinder"` |
| `progress` | `number` (0.0–1.0) | Yes | How far the student is toward unlocking. `0.66` = 66% |
| `description` | `string` | Recommended | Short motivating sentence. Max ~120 chars. Shown below the progress bar. |

---

### Updated Response Example

```json
{
  "student_level": 1,
  "current_focus_domain_id": "reading",
  "next_unlock": {
    "name": "Reading Pathfinder",
    "progress": 0.66,
    "description": "Completa 2 actividades mas de lectura para desbloquear este logro."
  },
  "domains": [
    {
      "id": "reading",
      "label": "Comprension lectora",
      "overall_mastery": 36,
      "is_current_focus": true,
      "description": "Estas mejorando en encontrar ideas principales.",
      "skills": [ "..." ]
    }
  ]
}
```

---

### What the frontend uses each field for

| Field | UI location | Behavior when absent |
|---|---|---|
| `student_level` | "Level N" pill in the Current Focus dark card header | Defaults to `1` |
| `next_unlock.name` | Title in the "Next unlock" white card below the domain list | Card hidden |
| `next_unlock.progress` | Indigo–violet gradient progress bar in the unlock card | Card hidden |
| `next_unlock.description` | Caption text below progress bar | Bar still shows; no caption |

---

### What determines `next_unlock`

The backend should compute this based on the student's current mastery trajectory. Recommended logic:

1. Find the domain with the highest `overall_mastery` that is **not yet at the next milestone threshold** (e.g., 40%, 60%, 80% thresholds).
2. Identify the named achievement tied to that threshold (e.g., `"Reading Pathfinder"` unlocks at 40% reading mastery).
3. Calculate `progress = current_mastery / threshold_mastery`.
4. Return the achievement name + progress + a contextual description sentence.

If no unlockable milestone exists (student has mastered everything), return `"next_unlock": null`.

---

### `current_focus_domain_id` — reminder

Already implemented (March 2026). The client uses this to select which domain appears in the top dark card. The matching domain object in `domains[]` should also have `"is_current_focus": true` as a redundant signal. No changes required — documenting for completeness.