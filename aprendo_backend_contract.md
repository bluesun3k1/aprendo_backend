# Aprendo — Laravel 12 Backend Contract

This document is maintained by the Flutter team and updated as each feature is built.
Share this with the Laravel backend developer. All Flutter API calls, request shapes,
response shapes, auth mechanisms, and data model requirements are documented here.

---

## Stack

- **Framework:** Laravel 12
- **Database:** MySQL
- **Cache/Queue:** Redis (I can't afford Redis right now)
- **API style:** REST, JSON
- **Auth:** Token-based (Sanctum recommended)
- **Versioning:** All routes prefixed with `/api/v1/`

---

## Auth

### Student login
Students do not use email. They authenticate with school code + username + PIN.

```
POST /api/v1/auth/student/login
```

**Request:**
```json
{
  "school_code": "SCH-001",
  "username": "maria.lopez",
  "pin": "1234"
}
```

**Response (200):**
```json
{
  "token": "string",
  "token_type": "Bearer",
  "student": {
    "id": "uuid",
    "display_name": "María López",
    "grade": "5",
    "age": 10,
    "school_id": "uuid",
    "school_name": "Colegio San Martín",
    "diagnostic_completed": false,
    "avatar_url": null
  }
}
```

**Errors:**
- `401` — invalid credentials
- `403` — account inactive
- `422` — validation error

---

### Teacher / Admin login
```
POST /api/v1/auth/login
```

**Request:**
```json
{
  "email": "teacher@school.com",
  "password": "string"
}
```

**Response (200):**
```json
{
  "token": "string",
  "token_type": "Bearer",
  "user": {
    "id": "uuid",
    "name": "string",
    "email": "string",
    "role": "teacher | admin | platform_admin",
    "school_id": "uuid"
  }
}
```

---

### Logout
```
POST /api/v1/auth/logout
Authorization: Bearer {token}
```

**Response (200):**
```json
{ "message": "Logged out" }
```

---

### Student PIN reset (teacher-triggered)
Flutter shows students "Ask your teacher to reset your PIN." The reset endpoint is
called from the teacher web portal, not the Flutter app. Document for web team.

```
POST /api/v1/teacher/students/{student_id}/reset-pin
Authorization: Bearer {teacher_token}
```

**Request:**
```json
{ "new_pin": "5678" }
```

---

## Onboarding

### Confirm student grade/age
Called after login if `diagnostic_completed = false` and the student is going
through onboarding for the first time.

```
PATCH /api/v1/student/profile
Authorization: Bearer {token}
```

**Request:**
```json
{
  "grade": "5",
  "age": 10
}
```

**Response (200):**
```json
{
  "id": "uuid",
  "display_name": "María López",
  "grade": "5",
  "age": 10
}
```

---

## Diagnostic

### Get diagnostic session
Returns a short fixed diagnostic activity set (approx. 9 items: 3 per domain).
This is NOT the same as a regular session — it is a placement assessment.

```
GET /api/v1/student/diagnostic
Authorization: Bearer {token}
```

**Response (200):**
```json
{
  "diagnostic_id": "uuid",
  "activities": [
    {
      "id": "uuid",
      "type": "multiple_choice",
      "domain": "reading",
      "skill_id": "uuid",
      "skill_name": "main_idea",
      "difficulty": 2,
      "instructions": "Lee el texto y elige la idea principal.",
      "duration_seconds": null,
      "content": {
        "passage": "El sol es una estrella...",
        "question": "¿Cuál es la idea principal del texto?",
        "options": [
          { "id": "a", "text": "El sol da calor" },
          { "id": "b", "text": "El sol es una estrella que da luz y calor" },
          { "id": "c", "text": "Las estrellas son grandes" },
          { "id": "d", "text": "La Tierra gira alrededor del sol" }
        ],
        "correct_option_id": "b"
      }
    }
  ]
}
```

> **Note:** `correct_option_id` must NOT be sent to the client in production.
> The Flutter app submits the chosen answer and the server evaluates correctness.
> The mock interceptor includes it for local development only.

---

### Submit diagnostic results
```
POST /api/v1/student/diagnostic/{diagnostic_id}/submit
Authorization: Bearer {token}
```

**Request:**
```json
{
  "attempts": [
    {
      "activity_id": "uuid",
      "chosen_option_id": "b",
      "response_time_ms": 4200,
      "hints_used": 0
    }
  ]
}
```

**Response (200):**
```json
{
  "mastery_scores": [
    { "domain": "reading", "skill_id": "uuid", "skill_name": "main_idea", "score": 65 },
    { "domain": "attention", "skill_id": "uuid", "skill_name": "selective_attention", "score": 50 },
    { "domain": "reasoning", "skill_id": "uuid", "skill_name": "classification", "score": 70 }
  ],
  "learning_path_id": "uuid",
  "diagnostic_completed": true
}
```

---

## Sessions

### Get today's session
Returns the personalized session for the student based on their current learning path.

```
GET /api/v1/student/session/today
Authorization: Bearer {token}
```

**Response (200):**
```json
{
  "session_id": "uuid",
  "estimated_duration_minutes": 12,
  "domains": ["reading", "attention"],
  "activities": [
    {
      "id": "uuid",
      "type": "multiple_choice | drag_to_sort | tap_sequence",
      "domain": "reading | attention | reasoning",
      "skill_id": "uuid",
      "skill_name": "string",
      "difficulty": 1,
      "instructions": "string",
      "duration_seconds": null,
      "content": {}
    }
  ]
}
```

**Activity content shapes by type — see Activity Content Shapes section below.**

---

### Submit session attempt (per activity)
Called after each individual activity is completed inside a session.

```
POST /api/v1/student/session/{session_id}/attempt
Authorization: Bearer {token}
```

**Request:**
```json
{
  "activity_id": "uuid",
  "type": "multiple_choice",
  "response": {
    "chosen_option_id": "b"
  },
  "response_time_ms": 3800,
  "hints_used": 0,
  "completed": true
}
```

**Response shape for `drag_to_sort`:**
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

**Response shape for `tap_sequence`:**
```json
{
  "response": {
    "sequence": ["item_3", "item_1", "item_4", "item_2"]
  }
}
```

**Attempt response (200):**
```json
{
  "attempt_id": "uuid",
  "correct": true,
  "score_delta": 5,
  "feedback_text": "¡Muy bien!",
  "mastery_score_updated": {
    "skill_id": "uuid",
    "new_score": 70,
    "trend": "up"
  }
}
```

---

### Finalize session
Called when the student completes all activities in a session.

```
POST /api/v1/student/session/{session_id}/complete
Authorization: Bearer {token}
```

**Request:**
```json
{
  "completed_at": "2026-03-20T14:30:00Z"
}
```

**Response (200):**
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

---

## Student Dashboard

### Get dashboard data
```
GET /api/v1/student/dashboard
Authorization: Bearer {token}
```

**Response (200):**
```json
{
  "student": {
    "id": "uuid",
    "display_name": "María López",
    "grade": "5",
    "school_name": "Colegio San Martín"
  },
  "streak": {
    "current": 3,
    "best": 5
  },
  "today_session": {
    "session_id": "uuid",
    "estimated_duration_minutes": 12,
    "completed": false,
    "domains": ["reading", "attention"]
  },
  "domain_progress": [
    { "domain": "reading", "overall_mastery": 65, "trend": "up" },
    { "domain": "attention", "overall_mastery": 50, "trend": "stable" },
    { "domain": "reasoning", "overall_mastery": 70, "trend": "up" }
  ],
  "last_badge": {
    "id": "uuid",
    "name": "Explorador",
    "icon_url": "string"
  },
  "points_total": 340
}
```

---

## Skill Map

### Get skill map
```
GET /api/v1/student/skill-map
Authorization: Bearer {token}
```

**Response (200):**
```json
{
  "domains": [
    {
      "id": "reading",
      "label": "Comprensión lectora",
      "overall_mastery": 65,
      "skills": [
        {
          "id": "uuid",
          "name": "main_idea",
          "label": "Idea principal",
          "mastery_score": 80,
          "trend": "up",
          "last_practiced": "2026-03-19"
        }
      ]
    },
    {
      "id": "attention",
      "label": "Atención y enfoque",
      "overall_mastery": 50,
      "skills": []
    },
    {
      "id": "reasoning",
      "label": "Pensamiento crítico",
      "overall_mastery": 70,
      "skills": []
    }
  ]
}
```

---

## Progress

### Get student progress history
```
GET /api/v1/student/progress?domain=reading&days=30
Authorization: Bearer {token}
```

**Response (200):**
```json
{
  "domain": "reading",
  "snapshots": [
    { "date": "2026-03-01", "mastery_score": 55 },
    { "date": "2026-03-08", "mastery_score": 60 },
    { "date": "2026-03-15", "mastery_score": 65 }
  ]
}
```

---

## Rewards

### Get rewards and badges
```
GET /api/v1/student/rewards
Authorization: Bearer {token}
```

**Response (200):**
```json
{
  "points_total": 340,
  "streak": {
    "current": 3,
    "best": 5,
    "history": ["2026-03-18", "2026-03-19", "2026-03-20"]
  },
  "badges": [
    {
      "id": "uuid",
      "name": "Explorador",
      "description": "Completaste tu primera sesión",
      "icon_url": "string",
      "earned": true,
      "earned_at": "2026-03-15"
    },
    {
      "id": "uuid",
      "name": "Lector veloz",
      "description": "Completa 10 actividades de lectura",
      "icon_url": "string",
      "earned": false,
      "earned_at": null
    }
  ],
  "weekly_missions": [
    {
      "id": "uuid",
      "label": "Completa 3 sesiones esta semana",
      "progress": 2,
      "target": 3,
      "completed": false
    }
  ]
}
```

---

## Activity Content Shapes

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
Evaluation: `chosen_option_id` matched server-side against correct answer.

---

### `drag_to_sort`
```json
{
  "instructions": "Arrastra cada elemento a la categoría correcta.",
  "items": [
    { "id": "item_1", "text": "Perro", "image_url": null },
    { "id": "item_2", "text": "Rosa", "image_url": null }
  ],
  "zones": [
    { "id": "zone_a", "label": "Animales" },
    { "id": "zone_b", "label": "Plantas" }
  ]
}
```
Evaluation: `zones` map of `zone_id → [item_ids]` matched server-side.

---

### `tap_sequence`
```json
{
  "instructions": "Toca los eventos en el orden en que ocurrieron.",
  "items": [
    { "id": "item_1", "text": "El sol salió" },
    { "id": "item_2", "text": "Los niños despertaron" },
    { "id": "item_3", "text": "Comenzó la escuela" }
  ],
  "time_limit_seconds": 30
}
```
Evaluation: `sequence` array of item IDs matched server-side.

---

## Offline / Queued Attempts

When a student is offline, the Flutter app queues attempts locally in Isar and submits
them in bulk on reconnect.

```
POST /api/v1/student/session/{session_id}/attempts/bulk
Authorization: Bearer {token}
```

**Request:**
```json
{
  "attempts": [
    {
      "activity_id": "uuid",
      "type": "multiple_choice",
      "response": { "chosen_option_id": "b" },
      "response_time_ms": 3800,
      "hints_used": 0,
      "completed": true,
      "client_timestamp": "2026-03-20T14:25:00Z"
    }
  ]
}
```

**Response:** same shape as single attempt response, but wrapped in an array.

---

## General Conventions

### All authenticated requests
```
Authorization: Bearer {token}
Content-Type: application/json
Accept: application/json
Accept-Language: es | en
```

### Error response shape (all errors)
```json
{
  "message": "string",
  "errors": {
    "field_name": ["Validation message"]
  }
}
```

### Pagination (where applicable)
```json
{
  "data": [],
  "meta": {
    "current_page": 1,
    "last_page": 3,
    "per_page": 20,
    "total": 60
  }
}
```

### UUIDs
All entity IDs are UUIDs (v4). No auto-increment integers exposed in the API.

### Timestamps
All timestamps in ISO 8601 UTC: `"2026-03-20T14:30:00Z"`

### Localization
Pass `Accept-Language: es` or `Accept-Language: en` on every request.
The backend should return `instructions`, `feedback_text`, `label`, and all
user-facing strings in the requested language.

---

## Domains & Skills Reference

### Domains
| ID | Label (es) |
|---|---|
| `reading` | Comprensión lectora |
| `attention` | Atención y enfoque |
| `reasoning` | Pensamiento crítico |

### Skills per domain (V1 seed data required)

**reading**
- `main_idea` — Idea principal
- `supporting_details` — Detalles de apoyo
- `sequencing` — Secuencia
- `inference` — Inferencia
- `context_clues` — Pistas de contexto
- `summarization` — Resumen
- `compare_contrast` — Comparar y contrastar
- `identifying_purpose` — Identificar el propósito
- `fact_vs_opinion` — Hecho vs. opinión
- `evaluating_evidence` — Evaluar evidencia

**attention**
- `selective_attention` — Atención selectiva
- `sustained_attention` — Atención sostenida
- `visual_discrimination` — Discriminación visual
- `impulse_control` — Control de impulsos
- `instruction_following` — Seguir instrucciones
- `filtering_distractions` — Filtrar distracciones
- `speed_accuracy` — Velocidad con precisión
- `response_control` — Control de respuesta

**reasoning**
- `classification` — Clasificación
- `analogies` — Analogías
- `patterns` — Patrones
- `cause_effect` — Causa y efecto
- `deductive_logic` — Lógica deductiva
- `argument_analysis` — Análisis de argumentos
- `problem_solving` — Resolución de problemas
- `decision_making` — Toma de decisiones
- `evidence_selection` — Selección de evidencia

---

## Roles

| Role | Value | Description |
|---|---|---|
| Student | `student` | Accesses Flutter app only |
| Teacher | `teacher` | Accesses web portal |
| School Admin | `admin` | Accesses web portal |
| Platform Admin | `platform_admin` | Internal superadmin |
| Parent | `parent` | Future phase |

---

## Adaptive Engine Requirements

The backend adaptive engine must implement the following V1 rules when generating
the next session via `GET /api/v1/student/session/today`:

| Condition | Action |
|---|---|
| High accuracy + good speed | Increase difficulty |
| High accuracy + slow speed | Maintain level, train fluency |
| Low accuracy + repeated errors | Reduce difficulty, add support content |
| Strong performance in a domain | Increase challenge ratio for that domain |
| Weak performance in a domain | Increase remediation ratio for that domain |

**Session composition rule (V1):**
- 50% weakest active skill
- 30% on-level reinforcement
- 20% stretch challenge

**Mastery score model:**
- Score: 0–100 per skill
- Confidence/stability indicator
- Recent trend direction: `up | stable | down`

---

## Notifications (stubbed in Flutter — implement when ready)

```
POST /api/v1/student/device-token
Authorization: Bearer {token}
```

**Request:**
```json
{
  "platform": "android | ios",
  "token": "firebase_fcm_token_string"
}
```

Flutter will call this endpoint after Firebase is integrated.
Not required for MVP launch.

---

## Database Seed Requirements

Backend team must seed the following for the Flutter app to function in development
and pilot:

1. At least 1 school (`schools` table) with `school_code = "SCH-001"`
2. At least 2 student accounts linked to that school
3. At least 1 teacher account linked to that school
4. All 3 domains seeded (`skill_domains`)
5. All skills listed above seeded (`skills`)
6. At least 3 difficulty levels per skill (`1 = easy, 2 = medium, 3 = hard`)
7. At least 9 diagnostic activities (3 per domain, 1 per difficulty)
8. At least 20 activities across all domains and templates for session generation
9. At least 5 badge definitions (`badges`)
10. At least 1 weekly mission definition

---

## Change Log

| Date | Change | Author |
|---|---|---|
| 2026-03-20 | Initial contract created from Flutter implementation plan | Flutter team |
