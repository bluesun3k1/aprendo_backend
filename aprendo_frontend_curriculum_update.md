# Frontend Contract — Curriculum System Update

**Date:** 2026-03-23  
**Status:** Backend complete — frontend integration required  
**Scope:** Replaces the pure adaptive loop with a grade-band curriculum: ordered units → session queue → adaptive assembly per slot

---

## What changed and why

| Before | After |
|---|---|
| `GET /session/today` picked activities by chasing weak skills — no guaranteed roadmap | Same endpoint now returns a session built from the current unit's curriculum blueprint |
| No concept of "where am I in the curriculum" | Every student has a track → 3 units → 4 sessions per unit, all ordered |
| `POST /session/{id}/complete` generated one bonus session | Now advances the queue, checks unit mastery, unlocks next unit automatically |
| No unit/track visibility | 3 new read-only endpoints expose the full curriculum state |

The old endpoints still work with the same request shape. **Only the responses have new optional fields added.**

---

## Curriculum structure

```
placement_band (early | middle | upper)
└── CurriculumTrack  (e.g. middle_v1)
    ├── Unit 1 — Reading Foundations      [sort_order 1]
    │   ├── Session 1 · Introducción      (core, ~12 min, diff 1)
    │   ├── Session 2 · Práctica          (core, ~15 min, diff 1–2)
    │   ├── Session 3 · Desafío           (core, ~15 min, diff 2–3)
    │   └── Session 4 · Repaso            (review, ~12 min, adaptive)
    ├── Unit 2 — Reading Interpretation   [sort_order 2, locked until Unit 1 mastery ≥ 65%]
    └── Unit 3 — Critical Thinking        [sort_order 3, locked until Unit 2 mastery ≥ 65%]
```

**Early band (grades 1–2):** Attention Foundations → Early Reading → Basic Thinking  
**Middle band (grades 3–5):** Reading Foundations → Reading Interpretation → Critical Thinking  
**Upper band (grades 6–9):** Advanced Reading → Language & Purpose → Deep Reasoning

---

## New trigger points

| Event | Backend behaviour (automatic) |
|---|---|
| Student logs in | `PlacementService::ensureTrackAssigned()` — creates track + seeds queue if missing |
| Diagnostic submitted | Same `ensureTrackAssigned()` called with fresh mastery data |
| Session completed | Queue advances, unit mastery checked, next unit unlocked if threshold met |
| Band advanced | New track assigned on next `ensureTrackAssigned()` call |

No frontend action required to trigger any of these — they run server-side.

---

## Changed response shapes

### `POST /api/v1/auth/student/login` — no request change

New field in `student` object (already added in previous update):

```json
{
  "token": "...",
  "student": {
    "id": "uuid",
    "display_name": "...",
    "grade": "4",
    "age_band": "middle",
    "placement_band": "middle",   ← already present
    ...
  }
}
```

---

### `GET /api/v1/student/session/today` — no request change

Response is unchanged in shape. The session is now built from the curriculum blueprint instead of the adaptive engine, but it returns the same fields:

```json
{
  "session_id": "uuid",
  "status": "pending",
  "estimated_duration_minutes": 15,
  "domains": ["reading", "attention"],
  "activities": [ ... ]
}
```

**No frontend code change needed.** The session plays exactly the same way.

---

### `POST /api/v1/student/session/{id}/complete` — two new response fields

```json
{
  "success": true,
  "xp_awarded": 85,
  "new_level": 3,
  "levelled_up": false,
  "streak_days": 4,
  "band_advanced": false,
  "placement_band": "middle",
  "unit_completed": true,        ← NEW
  "next_unit_unlocked": true     ← NEW
}
```

| Field | Type | Use on screen |
|---|---|---|
| `unit_completed` | bool | Trigger unit completion celebration screen |
| `next_unit_unlocked` | bool | Show "next unit unlocked" toast / banner |

**Both are safely ignorable** until the celebration screen is built. When `unit_completed: true`, you can display the unit trophy screen before navigating back to the home screen.

---

## Three new read-only endpoints

All require `Authorization: Bearer {student_token}` and respect `Accept-Language: es` / `en`.

---

### `GET /api/v1/student/curriculum-track`

Returns the student's full track with the status of every unit.

**Response:**
```json
{
  "curriculum_track": {
    "track_id": "uuid",
    "code": "middle_v1",
    "label": "Currículo Medio v1",
    "version": "v1",
    "band": "middle",
    "status": "active",
    "started_at": "2026-03-23T10:00:00+00:00",
    "units": [
      {
        "unit_id": "uuid",
        "code": "middle_reading_foundations",
        "title": "Fundamentos de Lectura",
        "description": "Identificación de idea principal, detalles y secuencia.",
        "sort_order": 1,
        "estimated_sessions": 4,
        "mastery_threshold": 65,
        "status": "completed",
        "started_at": "2026-03-23T10:00:00+00:00",
        "completed_at": "2026-03-23T16:00:00+00:00"
      },
      {
        "unit_id": "uuid",
        "code": "middle_reading_interpretation",
        "title": "Interpretación Lectora",
        "description": "Inferencia, pistas de contexto y resumen de textos.",
        "sort_order": 2,
        "estimated_sessions": 4,
        "mastery_threshold": 65,
        "status": "active",
        "started_at": "2026-03-23T16:01:00+00:00",
        "completed_at": null
      },
      {
        "unit_id": "uuid",
        "code": "middle_critical_thinking_basics",
        "title": "Pensamiento Crítico Básico",
        "description": "...",
        "sort_order": 3,
        "estimated_sessions": 4,
        "mastery_threshold": 65,
        "status": "locked",
        "started_at": null,
        "completed_at": null
      }
    ]
  }
}
```

`curriculum_track` is `null` if no track has been assigned yet.

**Use on screen:** Curriculum roadmap / progress map screen. Unit `status` drives lock icons.

---

### `GET /api/v1/student/current-unit`

Returns the active unit with per-skill mastery and session progress.

**Response:**
```json
{
  "current_unit": {
    "unit_id": "uuid",
    "code": "middle_reading_interpretation",
    "title": "Interpretación Lectora",
    "description": "Inferencia, pistas de contexto y resumen de textos.",
    "sort_order": 2,
    "mastery_threshold": 65,
    "sessions_total": 4,
    "sessions_completed": 1,
    "started_at": "2026-03-23T16:01:00+00:00",
    "skills": [
      {
        "skill_id": "uuid",
        "skill_name": "inference",
        "skill_label": "Inferencia",
        "priority_weight": 1,
        "target_mastery_min": 50,
        "target_mastery_goal": 75,
        "current_mastery": 42,
        "trend": "up"
      },
      {
        "skill_id": "uuid",
        "skill_name": "context_clues",
        "skill_label": "Pistas de contexto",
        "priority_weight": 2,
        "target_mastery_min": 50,
        "target_mastery_goal": 75,
        "current_mastery": 18,
        "trend": "stable"
      },
      {
        "skill_id": "uuid",
        "skill_name": "summarization",
        "skill_label": "Resumen",
        "priority_weight": 3,
        "target_mastery_min": 50,
        "target_mastery_goal": 75,
        "current_mastery": 0,
        "trend": "stable"
      }
    ]
  }
}
```

`current_unit` is `null` if no active unit exists.

**Use on screen:** Unit detail panel, skill mastery progress bars inside the current unit card.

---

### `GET /api/v1/student/session-queue`

Returns the student's upcoming session queue (active + queued items only).

**Response:**
```json
{
  "queue": [
    {
      "queue_item_id": "uuid",
      "queue_order": 3,
      "session_kind": "core",
      "status": "active",
      "available_at": "2026-03-23T16:00:00+00:00",
      "session_id": "uuid",
      "blueprint": {
        "curriculum_session_id": "uuid",
        "title": "Interpretación Lectora · Desafío",
        "session_type": "core",
        "estimated_minutes": 15,
        "unit_title": "Interpretación Lectora"
      }
    },
    {
      "queue_item_id": "uuid",
      "queue_order": 4,
      "session_kind": "review",
      "status": "queued",
      "available_at": null,
      "session_id": null,
      "blueprint": {
        "curriculum_session_id": "uuid",
        "title": "Interpretación Lectora · Repaso",
        "session_type": "review",
        "estimated_minutes": 12,
        "unit_title": "Interpretación Lectora"
      }
    }
  ]
}
```

`session_id` is `null` until the student starts that session (it's built on demand).  
`blueprint` is `null` for adaptive bonus/remediation sessions without a fixed template.

**Use on screen:** "Coming up" section on the home screen, full queue preview screen.

---

## Unit completion celebration screen

Triggered when `unit_completed: true` in the session complete response.

### Display copy

**ES:**  
> 🏆 ¡Unidad completada!  
> Terminaste **"{unit_title}"**  
> Promedio de dominio: **{avg_mastery}%**  
> ¡Siguiente unidad desbloqueada!  *(show only if `next_unit_unlocked: true`)*

**EN:**  
> 🏆 Unit completed!  
> You finished **"{unit_title}"**  
> Average mastery: **{avg_mastery}%**  
> Next unit unlocked!  *(show only if `next_unit_unlocked: true`)*

The `unit_title` and `avg_mastery` are not in the session complete response directly — fetch them from `GET /current-unit` (which will now show the newly activated unit) or cache the previous unit title client-side before calling complete.

**Recommended approach:** store the current unit title locally before calling `POST /session/complete`, then use it in the celebration screen. Follow up with `GET /current-unit` to display the newly unlocked unit.

---

## Implementation priority checklist

### High — needed for correct app flow
- [ ] On session complete, check `unit_completed` — if `true`, show unit celebration screen before navigating away
- [ ] Add `GET /student/curriculum-track` call on app startup / home screen load — use to drive roadmap UI

### Medium — adds curriculum visibility
- [ ] `GET /student/current-unit` — use for the "current unit" card on the home/dashboard screen
- [ ] `GET /student/session-queue` — use for the "coming up" section showing next 2–3 sessions

### Low — polish / future
- [ ] Unit celebration screen with trophy animation
- [ ] Roadmap screen showing all 3 units with lock/active/complete states
- [ ] "Next unit unlocked" toast on home screen after returning from session complete

---

## Backward-compatibility notes

- `GET /session/today` — same shape, no changes required client-side
- `GET /sessions` — unchanged
- `POST /session/{id}/attempts/bulk` — unchanged  
- `POST /session/{id}/complete` — additive only (2 new fields, existing fields unchanged)
- `GET /skill-map` — unchanged
- All existing navigation flows continue working without modification

---

## Change log

| Date | Change |
|---|---|
| 2026-03-23 | Initial document — curriculum engine launch |
