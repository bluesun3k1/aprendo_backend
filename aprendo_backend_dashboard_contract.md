# Dashboard API Contract — Required Improvements

**Date:** 2026-03-23  
**Endpoint:** `GET /api/v1/student/dashboard`  
**Status:** Current payload is insufficient. This document specifies every field the frontend needs and exactly where it is used on screen.

---

## Current Payload (what the server sends today)

```json
{
  "student_id": "uuid",
  "display_name": "María López",
  "streak_days": 0,
  "sessions_completed_today": 2,
  "sessions_goal_today": 1,
  "current_level": 1,
  "current_xp": 0,
  "xp_to_next_level": 100,
  "domains": [
    { "id": "attention", "mastery_score": 9,  "last_activity_at": "..." },
    { "id": "reading",   "mastery_score": 5,  "last_activity_at": "..." },
    { "id": "reasoning", "mastery_score": 9,  "last_activity_at": "..." }
  ],
  "recent_badge": null
}
```

**Problems:**
- `domains[]` has no `label` → frontend hardcodes Spanish/English strings keyed on `id`
- `domains[]` has no `trend` → frontend cannot show improvement direction
- No `today_session` object → session hero card falls back to a hardcoded "~15 min" estimate
- Flat `streak_days` integer → frontend cannot show best-streak record
- No `weekly_missions` → missions section cannot render
- `recent_badge` has no `description` or `earned_at`

---

## Required Payload

```json
{
  "student_id": "uuid",
  "display_name": "María López",

  "streak": {
    "current": 3,
    "best": 7
  },

  "sessions_completed_today": 1,
  "sessions_goal_today": 1,

  "current_level": 2,
  "current_xp": 45,
  "xp_to_next_level": 105,

  "domains": [
    {
      "id": "reading",
      "label": "Comprensión lectora",
      "mastery_score": 40,
      "trend": "up",
      "last_activity_at": "2026-03-23T16:24:29+00:00"
    },
    {
      "id": "attention",
      "label": "Atención y enfoque",
      "mastery_score": 22,
      "trend": "stable",
      "last_activity_at": "2026-03-23T16:24:30+00:00"
    },
    {
      "id": "reasoning",
      "label": "Pensamiento crítico",
      "mastery_score": 18,
      "trend": "up",
      "last_activity_at": "2026-03-23T16:24:30+00:00"
    }
  ],

  "today_session": {
    "session_id": "uuid",
    "title": "Sesión 4 · Misión lectora",
    "estimated_duration_minutes": 12,
    "total_activities": 5,
    "activities_completed": 2,
    "status": "in_progress",
    "domains": ["reading", "attention"]
  },

  "recent_badge": {
    "id": "uuid",
    "name": "Primera sesión",
    "description": "Completaste tu primera sesión",
    "icon_url": null,
    "earned_at": "2026-03-23"
  },

  "weekly_missions": [
    {
      "id": "uuid",
      "label": "Completa 3 sesiones esta semana",
      "progress": 1,
      "target": 3,
      "completed": false
    }
  ]
}
```

---

## Field-by-Field Specification

### Streak
Replace the flat `streak_days` integer with a `streak` object.

| Field | Type | Used on screen |
|---|---|---|
| `streak.current` | int | Stats row 🔥 count |
| `streak.best` | int | Stats row subtitle |

---

### Domains array — every object must include

| Field | Type | Used on screen |
|---|---|---|
| `id` | string | Icon + color lookup (hardcoded map in app) |
| `label` | string ⚠️ **missing today** | Skill growth bar label |
| `mastery_score` | int 0–100 | Bar fill + percentage |
| `trend` | `"up"` \| `"stable"` \| `"down"` | Trend arrow |
| `last_activity_at` | ISO 8601 | Reserved for future |

---

### `today_session` object — **entirely missing today**

The hero card is the most prominent element on the screen. It currently
falls back to a hardcoded "~15 min" title.

| Field | Type | Used on screen |
|---|---|---|
| `session_id` | string (uuid) | Start/Continue button navigation |
| `title` | string | Hero card headline |
| `estimated_duration_minutes` | int | Duration badge |
| `total_activities` | int | "5 actividades" subtitle |
| `activities_completed` | int | Resume progress bar |
| `status` | `"pending"` \| `"in_progress"` \| `"completed"` | Which card variant to show |
| `domains` | string[] | Domain pill badges |

Send `today_session: null` when no session is assigned.

---

### `recent_badge` — add missing fields

| Field | Type | Used on screen |
|---|---|---|
| `description` | string | Badge subtitle |
| `earned_at` | `YYYY-MM-DD` | Relative date label |

---

### `weekly_missions` array — **entirely missing today**

| Field | Type | Used on screen |
|---|---|---|
| `label` | string | Mission description |
| `progress` | int | Bar fill numerator |
| `target` | int | Bar fill denominator |
| `completed` | bool | Check icon + style |

Send `[]` when there are no active missions.

---

## Accept-Language

All user-facing string fields (`domains[].label`, `today_session.title`,
`recent_badge.name/description`, `weekly_missions[].label`) must honour
the `Accept-Language` request header (`es` or `en`).

---

## Summary Checklist

- [ ] Replace flat `streak_days` with `streak: { current, best }`
- [ ] Add `label` and `trend` to every object in `domains[]`
- [ ] Add `today_session` object (fields above) or `null`
- [ ] Add `description` and `earned_at` to `recent_badge`
- [ ] Add `weekly_missions` array (or `[]`)
- [ ] All user-facing strings honour `Accept-Language`

---

## Change Log

| Date | Change |
|---|---|
| 2026-03-23 | Initial document |