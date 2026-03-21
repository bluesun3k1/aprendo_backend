# Backend API Contract — Aprendo

**Version:** MVP Phase 1  
**Client:** Flutter 3.32.5 (iOS / Android / Web)  
**Auth:** Bearer token in `Authorization` header after login  
**Base URL:** `https://api.aprendo.app/api/v1`  
**Content-Type:** `application/json`

---

## Authentication

### POST `/auth/student/login`

Student PIN login.

**Request**
```json
{
  "school_code": "string",
  "username": "string",
  "pin": "string"
}
```

**Response 200**
```json
{
  "token": "string",
  "student": {
    "id": "string",
    "display_name": "string",
    "grade": "string",
    "age": 10,
    "school_id": "string",
    "school_name": "string",
    "diagnostic_completed": true,
    "avatar_url": "string | null",
    "age_band": "early | middle | upper | null"
  }
}
```

> **`age_band`** is optional. When provided, the client uses it directly. When absent, the client derives it from `grade` using a fallback rule: grades 1–2 → `early`, grades 3–5 → `middle`, grades 6–9 → `upper`. Providing `age_band` explicitly is recommended for students whose grade cannot be parsed (e.g. kindergarten, special programs).

**Errors:** 401 on invalid credentials, 404 on school not found.

---

### POST `/auth/login`

Teacher / staff login.

**Request**
```json
{
  "email": "string",
  "password": "string"
}
```

**Response 200**
```json
{
  "token": "string",
  "user": {
    "id": "string",
    "name": "string",
    "email": "string",
    "role": "teacher | admin | platform_admin",
    "school_id": "string"
  }
}
```

---

### POST `/auth/logout`

Invalidate the current bearer token (no body required).

**Response 200** `{}`

---

## Student Dashboard

### GET `/student/dashboard`

**Response 200**
```json
{
  "student_id": "string",
  "display_name": "string",
  "streak_days": 3,
  "sessions_completed_today": 0,
  "sessions_goal_today": 1,
  "current_level": 4,
  "current_xp": 340,
  "xp_to_next_level": 150,
  "domains": [
    {
      "id": "reading | attention | reasoning",
      "mastery_score": 72,
      "last_activity_at": "2026-03-20T10:00:00Z"
    }
  ],
  "recent_badge": {
    "id": "string",
    "name": "string",
    "icon_url": "string | null"
  } | null
}
```

---

## Sessions

### GET `/student/session/today`

Returns today's adaptive session for the authenticated student.

**Response 200**
```json
{
  "session_id": "string",
  "estimated_duration_minutes": 12,
  "domains": ["reading", "attention"],
  "activities": [
    {
      "id": "string",
      "type": "multiple_choice | drag_to_sort | tap_sequence",
      "domain": "reading | attention | reasoning",
      "skill_id": "string",
      "skill_name": "string",
      "difficulty": 3,
      "instructions": "string",
      "duration_seconds": 30,
      "content": { /* see Activity Content section below */ }
    }
  ]
}
```

**Response 204** — No session available today (student has already completed one, or none scheduled).

---

### POST `/student/session/{session_id}/attempts/bulk`

Submit all activity attempts at session completion.

**Request**
```json
{
  "attempts": [
    {
      "activity_id": "string",
      "type": "multiple_choice | drag_to_sort | tap_sequence",
      "response": { /* type-specific, see below */ },
      "response_time_ms": 4200,
      "hints_used": 0,
      "completed": true,
      "is_correct": true
    }
  ]
}
```

**Response 200** `{ "success": true }`

> The `is_correct` field is the client-evaluated result. The server **should** independently validate correctness server-side and may override this value for scoring.

---

### POST `/student/session/{session_id}/complete`

Finalise the session after all attempts have been submitted.

**Request**
```json
{
  "completed_at": "2026-03-21T14:32:00Z"
}
```

**Response 200**
```json
{
  "success": true,
  "xp_awarded": 95,
  "new_level": 5,
  "levelled_up": false,
  "streak_days": 4
}
```

> The client currently computes XP locally for immediate feedback (Phase 1). The server response should be treated as the authoritative XP value. A future phase will reconcile the two.

---

## Diagnostic

### GET `/student/diagnostic`

Returns the initial diagnostic session (same structure as a regular session, uses `diagnostic_id` instead of `session_id`).

**Response 200**
```json
{
  "diagnostic_id": "string",
  "activities": [ /* same Activity shape as /session/today */ ]
}
```

---

### POST `/student/diagnostic/{diagnostic_id}/submit`

Submit all diagnostic attempts in bulk.

**Request** — same shape as `/session/{id}/attempts/bulk`

**Response 200** `{ "success": true }`

---

## Skill Map

### GET `/student/skill-map`

**Response 200**
```json
{
  "domains": [
    {
      "id": "reading | attention | reasoning",
      "label": "string",
      "skills": [
        {
          "id": "string",
          "name": "string",
          "mastery_score": 68,
          "status": "strong | developing | weak | not_started",
          "last_practiced_at": "2026-03-18T09:00:00Z | null"
        }
      ]
    }
  ]
}
```

---

## Rewards

### GET `/student/rewards`

**Response 200**
```json
{
  "badges": [
    {
      "id": "string",
      "name": "string",
      "description": "string",
      "icon_url": "string | null",
      "earned": true,
      "earned_at": "2026-03-10T11:00:00Z | null"
    }
  ],
  "streak_days": 4,
  "total_sessions": 28,
  "total_xp": 1240
}
```

---

## Progress

### GET `/student/progress`

**Response 200**
```json
{
  "weekly": [
    {
      "date": "2026-03-15",
      "sessions_completed": 1,
      "accuracy": 0.82,
      "xp_earned": 95
    }
  ],
  "domain_trends": [
    {
      "domain": "reading",
      "scores": [
        { "date": "2026-03-15", "mastery_score": 65 },
        { "date": "2026-03-21", "mastery_score": 72 }
      ]
    }
  ]
}
```

---

## Activity Content Schemas

### `multiple_choice`
```json
{
  "passage": "string | null",
  "question": "string",
  "options": [
    { "id": "string", "text": "string", "image_url": "string | null" }
  ]
}
```

**Attempt response:**
```json
{ "selected_option_id": "string" }
```

---

### `drag_to_sort`
```json
{
  "items": [
    { "id": "string", "text": "string", "image_url": "string | null" }
  ],
  "zones": [
    { "id": "string", "label": "string" }
  ]
}
```

**Attempt response:**
```json
{
  "placements": [
    { "item_id": "string", "zone_id": "string" }
  ]
}
```

---

### `tap_sequence`
```json
{
  "items": [
    { "id": "string", "text": "string" }
  ],
  "time_limit_seconds": 20
}
```

**Attempt response:**
```json
{
  "tapped_ids": ["id1", "id2", "id3"]
}
```

---

## Error Envelope

All error responses follow this shape:

```json
{
  "error": {
    "code": "string",
    "message": "string"
  }
}
```

| HTTP Status | Meaning |
|---|---|
| 400 | Bad request / validation error |
| 401 | Unauthenticated (token missing or expired) |
| 403 | Forbidden (wrong role) |
| 404 | Resource not found |
| 409 | Conflict (e.g. session already completed today) |
| 422 | Unprocessable entity (business rule violation) |
| 500 | Internal server error |

---

## Notes for Backend

1. **`age_band` field:** Adding this to the student login response is recommended but not blocking for Phase 1. The client falls back gracefully to grade-based derivation.

2. **`is_correct` on attempts:** The client evaluates correctness locally for immediate feedback. The server should validate independently. A reconciliation pass in a future phase will align the two sources of truth.

3. **Session 204 handling:** The client currently does not gracefully handle 204 on `/session/today` — it will show an error. This is a known Phase 1 limitation. Backend should return a 200 with an empty `activities` array or a custom message until the client handles it.

4. **XP in session complete response:** The server `xp_awarded` field in the `/session/{id}/complete` response is not yet consumed by the client. Phase 1 uses locally computed XP only. Plan to reconcile in Phase 2.

5. **Token expiry:** The client has no token-refresh flow in Phase 1. Expired tokens force a full re-login. JWT expiry of 30 days recommended for MVP.

6. **Bulk attempts endpoint path:** Must match exactly `/student/session/{session_id}/attempts/bulk` (POST). A `/attempts` path (without `/bulk`) is not used.
