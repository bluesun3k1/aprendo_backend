# Skill Detail API Contract

**Version:** 1.0  
**Status:** Pending backend implementation  
**Frontend status:** Screens implemented with mock data  
**Base URL:** `https://api.aprendo.app/api/v1`

---

## Overview

This contract extends the existing skill-map API with three new endpoints that power the
skill detail drilldown screens. The flow is:

```
Skill list (SkillMapDetailScreen)
  └── Skill detail  GET /student/skills/{skillId}/detail
        ├── Score history  GET /student/skills/{skillId}/score-history
        │     └── Evidence detail  GET /student/sessions/{sessionId}/skill-evidence
        └── Insight & next step  (data bundled in the detail response)
```

The skill-map endpoint (`GET /student/skill-map`) is also extended with a `short_description`
field per skill so the list screen can show a preview hint without an extra round-trip.

---

## 1. Extended Skill Map Response — `short_description`

**Endpoint:** `GET /student/skill-map` *(existing — additive change)*

Each skill object inside `domains[].skills[]` gains one new optional field:

```json
{
  "id": "reading_comprehension",
  "name": "Idea principal",
  "mastery_score": 48,
  "mastery_level": "weak",
  "recent_scores": [28, 31, 35, 38, 40],
  "short_description": "Estás mejorando en encontrar de qué trata principalmente un texto."
}
```

| Field | Type | Required | Notes |
|---|---|---|---|
| `short_description` | string | No | One-sentence teaser shown in the skill list. If absent the client hides the subtitle. |

The `short_description` should reflect the student's current state — it is not a static
skill label. Suggested pattern: positive phrasing when `mastery_level = strong`, growth
phrasing when `developing`, actionable phrasing when `weak`.

---

## 2. Skill Detail

**Endpoint:** `GET /student/skills/{skillId}/detail`

Returns full enriched data for a single skill: what it means, why it matters, a coaching
note on what the student is doing well, what to practice next, and the headline insight
tip shown in Screen 3.

### Path parameters

| Name | Type | Notes |
|---|---|---|
| `skillId` | string | e.g. `reading_comprehension`, `inference`, `vocabulary` |

### Response `200 OK`

```json
{
  "skill_id": "reading_comprehension",
  "skill_label": "Idea principal",
  "domain_label": "Comprensión lectora",
  "mastery": 48,
  "mastery_level": "weak",
  "status": "Creciendo constantemente",
  "recent_activities_count": 8,
  "correct_count": 5,
  "total_count": 8,
  "average_accuracy": 62,
  "last_updated": "Hoy",
  "description": "Encontrar la idea principal significa entender de qué trata principalmente un párrafo o historia, aunque haya muchos detalles a su alrededor.",
  "why_it_matters": "Esta habilidad te ayuda a comprender textos más rápido, recordar información importante y responder preguntas con más confianza.",
  "doing_well": "Estás empezando a notar la pista más grande en textos cortos, especialmente cuando la respuesta está claramente conectada al problema o tema.",
  "practice_next": "Practica ignorar los detalles extra y elige la oración que mejor explique todo el texto, no solo una parte.",
  "insight_tip": "Busca la oración que abarca todo el texto",
  "insight_tip_body": "Una idea principal generalmente conecta la mayoría de los detalles. Si una respuesta solo coincide con una pequeña parte, probablemente no es la mejor opción.",
  "insight_example": "Si una historia habla sobre tierra seca, flores marchitas y un plan de riego, la idea principal no es solo 'flores'. Es que el jardín necesitaba ayuda y alguien resolvió el problema.",
  "recommended_activity_title": "Practicar desafíos de idea principal",
  "recommended_activity_description": "2 actividades cortas pueden ayudar a mejorar esta habilidad.",
  "recommended_activities_count": 2,
  "recent_evidence": [
    {
      "title": "Desafío de idea principal",
      "result": "correct",
      "date": "Hoy"
    },
    {
      "title": "Resumen de historia corta",
      "result": "needs_work",
      "date": "Ayer"
    },
    {
      "title": "Encuentra el mejor título",
      "result": "correct",
      "date": "Hace 2 días"
    }
  ]
}
```

### Field reference

| Field | Type | Notes |
|---|---|---|
| `skill_id` | string | Matches the skill ID from `GET /student/skill-map` |
| `skill_label` | string | Localized display name |
| `domain_label` | string | Localized domain name |
| `mastery` | int | 0–100 (mirrors `mastery_score` in skill-map) |
| `mastery_level` | string | `strong` \| `developing` \| `weak` |
| `status` | string | Human-readable growth status line, e.g. "Creciendo constantemente" |
| `recent_activities_count` | int | Number of activities used to compute the score |
| `correct_count` | int | How many of those activities the student got correct |
| `total_count` | int | Same as `recent_activities_count` (kept separate for clarity) |
| `average_accuracy` | int | Percentage, 0–100 |
| `last_updated` | string | Relative date string, e.g. "Hoy", "Ayer" |
| `description` | string | "What this skill means" — 1–2 sentences, student-friendly |
| `why_it_matters` | string | "Why it matters" — 1–2 sentences |
| `doing_well` | string | Coaching note — what the student is already doing right |
| `practice_next` | string | Coaching note — specific next action to improve |
| `insight_tip` | string | Short tip headline for the insight panel |
| `insight_tip_body` | string | Explanation body for the tip |
| `insight_example` | string | Concrete example paragraph for the tip |
| `recommended_activity_title` | string | CTA label for the recommended next step |
| `recommended_activity_description` | string | One-line description of the recommended practice |
| `recommended_activities_count` | int | How many activities are queued, shown as social proof |
| `recent_evidence` | array | Last 3 activity evidence entries (see below) |

**`recent_evidence[]` fields:**

| Field | Type | Notes |
|---|---|---|
| `title` | string | Activity display name |
| `result` | string | `correct` \| `needs_work` |
| `date` | string | Relative date string |

### Error responses

| Code | Meaning |
|---|---|
| `404` | `skill_not_found` — skill ID does not exist |
| `403` | Student does not have access to this skill |

---

## 3. Skill Score History

**Endpoint:** `GET /student/skills/{skillId}/score-history`

Returns the ordered list of session activities that contributed to the skill's current score,
plus the same summary stats shown in Screen 0.

### Path parameters

| Name | Type | Notes |
|---|---|---|
| `skillId` | string | Same skill ID used in the detail endpoint |

### Query parameters

| Name | Type | Default | Notes |
|---|---|---|---|
| `limit` | int | 10 | Maximum number of history entries to return |

### Response `200 OK`

```json
{
  "skill_id": "reading_comprehension",
  "skill_label": "Idea principal",
  "mastery": 48,
  "recent_activities_count": 8,
  "correct_count": 5,
  "total_count": 8,
  "last_updated": "Hoy",
  "entries": [
    {
      "session_id": "sess_012",
      "session_title": "Sesión 12 · Misión lectora",
      "activity_title": "Desafío de idea principal",
      "score_change": 8,
      "date": "Hoy"
    },
    {
      "session_id": "sess_011",
      "session_title": "Sesión 11 · Práctica de historias",
      "activity_title": "Resumen de historia corta",
      "score_change": -3,
      "date": "Ayer"
    },
    {
      "session_id": "sess_010",
      "session_title": "Sesión 10 · Misión lectora",
      "activity_title": "Encuentra el mejor título",
      "score_change": 5,
      "date": "Hace 2 días"
    },
    {
      "session_id": "sess_009",
      "session_title": "Sesión 9 · Repaso",
      "activity_title": "Verificación de idea principal",
      "score_change": 2,
      "date": "Hace 3 días"
    }
  ]
}
```

### Field reference

| Field | Type | Notes |
|---|---|---|
| `skill_id` | string | |
| `skill_label` | string | |
| `mastery` | int | Current mastery score (0–100) |
| `recent_activities_count` | int | Activities window size used for scoring |
| `correct_count` | int | |
| `total_count` | int | |
| `last_updated` | string | |
| `entries[]` | array | Ordered newest-first |
| `entries[].session_id` | string | Used to navigate to evidence detail |
| `entries[].session_title` | string | Display name for the session |
| `entries[].activity_title` | string | Display name for the specific activity |
| `entries[].score_change` | int | Signed delta. Positive = score increased, negative = decreased |
| `entries[].date` | string | Relative date |

---

## 4. Skill Evidence Detail

**Endpoint:** `GET /student/sessions/{sessionId}/skill-evidence`

Returns a detailed breakdown of one session's contribution to a specific skill score.
Used by Screen 0b (session evidence detail).

### Path parameters

| Name | Type | Notes |
|---|---|---|
| `sessionId` | string | Session ID from a history entry |

### Query parameters

| Name | Type | Required | Notes |
|---|---|---|---|
| `skill_id` | string | Yes | Which skill the evidence is for |

### Response `200 OK`

```json
{
  "session_id": "sess_012",
  "session_title": "Sesión 12",
  "session_type": "Misión lectora",
  "activity_title": "Desafío de idea principal",
  "is_correct": true,
  "score_impact": 8,
  "time_seconds": 42,
  "date": "Hoy",
  "explanation": "Identificaste la oración que mejor explicaba todo el texto, lo que ayudó a aumentar tu puntuación en Idea principal.",
  "skill_id": "reading_comprehension",
  "skill_label": "Idea principal",
  "skill_domain_label": "Comprensión lectora",
  "skill_mastery_level": "weak"
}
```

### Field reference

| Field | Type | Notes |
|---|---|---|
| `session_id` | string | |
| `session_title` | string | Short session identifier, e.g. "Sesión 12" |
| `session_type` | string | e.g. "Misión lectora", "Repaso" |
| `activity_title` | string | |
| `is_correct` | boolean | Whether the student answered correctly |
| `score_impact` | int | Signed score change (same as `score_change` in history) |
| `time_seconds` | int | Time the student spent on the activity |
| `date` | string | Relative date |
| `explanation` | string | Coaching explanation of what happened in plain language |
| `skill_id` | string | |
| `skill_label` | string | |
| `skill_domain_label` | string | |
| `skill_mastery_level` | string | `strong` \| `developing` \| `weak` |

---

## 5. Skills Reference

The following skill IDs exist in the system and are valid for all skill-detail endpoints.

### Reading domain (`reading`)

| Skill ID | Label (ES) |
|---|---|
| `reading_comprehension` | Idea principal |
| `inference` | Inferencias |
| `vocabulary` | Vocabulario |
| `text_structure` | Estructura del texto |
| `author_purpose` | Propósito del autor |
| `compare_contrast` | Comparar y contrastar |
| `cause_effect` | Causa y efecto |
| `sequence` | Secuencia |
| `fact_opinion` | Hecho y opinión |
| `summarizing` | Resumir |

### Attention domain (`attention`)

| Skill ID | Label (ES) |
|---|---|
| `working_memory` | Memoria de trabajo |
| `selective_attention` | Atención selectiva |
| `sustained_attention` | Atención sostenida |
| `divided_attention` | Atención dividida |
| `cognitive_flexibility` | Flexibilidad cognitiva |
| `inhibitory_control` | Control inhibitorio |
| `task_switching` | Cambio de tarea |
| `processing_speed` | Velocidad de procesamiento |

### Reasoning domain (`reasoning`)

| Skill ID | Label (ES) |
|---|---|
| `logical_sequencing` | Secuencia lógica |
| `pattern_recognition` | Reconocimiento de patrones |
| `abstract_reasoning` | Razonamiento abstracto |
| `spatial_reasoning` | Razonamiento espacial |
| `deductive_reasoning` | Razonamiento deductivo |
| `inductive_reasoning` | Razonamiento inductivo |
| `analogical_reasoning` | Razonamiento analógico |
| `problem_solving` | Resolución de problemas |
| `critical_thinking` | Pensamiento crítico |

---

## 6. Content Guidelines for Backend CMS

### `description` (What this skill means)
- 1–2 sentences, written to a student in grades 1–9.
- Explain the skill in first-person or third-person relatable terms.
- Avoid technical jargon.

### `why_it_matters`
- 1–2 sentences on real-world utility.
- Focus on benefits the student can experience immediately.

### `doing_well` (personalized per student)
- Dynamically generated based on recent correct activity patterns.
- Positive framing. Acknowledge specific progress, not generic praise.

### `practice_next` (personalized per student)
- Actionable. One thing the student should focus on in the next session.
- Written as a suggestion, not a directive.

### `insight_tip` + `insight_tip_body`
- `insight_tip` is a brief headline (≤ 8 words).
- `insight_tip_body` explains the strategy in 2–3 sentences.
- Should be a generalizable skill strategy, not specific to one activity.

### `insight_example`
- A concrete scenario that illustrates the insight tip.
- Relatable context (school, nature, everyday life).
- 3–5 sentences.

---

## 7. Backend Implementation Notes

1. **Performance:** The detail endpoint should be served from a materialized view or cache.
   Average response time target: < 200 ms.

2. **Personalization window:** `doing_well` and `practice_next` are computed from the last
   10 attempts for that skill. If fewer than 3 attempts exist, return generic content for
   the skill from the CMS.

3. **Score history window:** Return the last 10 entries by default. The adaptive engine
   keeps a sliding window of the last 8 activities for scoring; expose the full history
   for transparency.

4. **Relative dates:** Return localized relative date strings (`"Hoy"`, `"Ayer"`,
   `"Hace 2 días"`) matching the student's locale from the auth token or `Accept-Language`
   header.

5. **Evidence explanation generation:** The `explanation` field in the evidence detail
   endpoint can be generated from a template combining the skill label, activity result,
   and whether the student improved. Example template:
   ```
   Identificaste [correct_element] en [activity_context], lo que [helped/did not help] 
   mejorar tu puntuación en [skill_label].
   ```

6. **404 behaviour:** If a skill has no recorded history, `GET /student/skills/{skillId}/score-history`
   should return an empty `entries` array with `recent_activities_count: 0`, not a 404.
