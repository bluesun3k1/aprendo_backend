# Aprendo — Grade-Band Content Progression
## Frontend Contract & Integration Guide

**Date:** 2026-03-23
**Status:** Ready for implementation

---

## Background

The backend now serves three separate content pools — `early`, `middle`, and `upper` — for every skill and domain. The content within each pool increases in complexity, vocabulary, and abstraction. The same skill (e.g. `main_idea`) exists in all three bands, but the passages, distractors, and questions are grade-appropriate.

This allows students to progress **through the same skills at greater depth** rather than repeating the same exercises year after year.

---

## Two Separate Concepts: `age_band` vs `placement_band`

These are different fields with different purposes. Do not conflate them.

| Field | Lives on | Controls | Changes when |
|---|---|---|---|
| `age_band` | `student` object | Visual persona (palette, font size, mascot) | Student's grade is updated |
| `placement_band` | `student` object + several responses | Which **content pool** activities are drawn from | Student advances through performance OR grade is updated |

- **`age_band`** was already in the API. Nothing about it changes.
- **`placement_band`** is new in this update.

Both share the same three values: `"early"` \| `"middle"` \| `"upper"`.

A student's `age_band` and `placement_band` start equal (both derived from grade) but can diverge:
- A high-performing grade-5 student (`age_band = "middle"`) may advance to `placement_band = "upper"` through strong session performance.
- Their UI stays student-themed (`age_band` unchanged); only the content gets harder.

---

## Changed Endpoints

### 1. `POST /api/v1/auth/student/login`

The `student` object now includes `placement_band`.

**Updated student object shape:**
```json
{
  "token": "string",
  "student": {
    "id": "uuid",
    "display_name": "María López",
    "grade": "5",
    "age": 10,
    "age_band": "middle",
    "placement_band": "middle",
    "school_id": "uuid",
    "school_name": "Colegio San Martín",
    "diagnostic_completed": false,
    "avatar_url": null
  }
}
```

**Use `placement_band` for:** Displaying the student's current content level in their profile or settings screen (e.g. "Nivel de contenido: Intermedio").

**Use `age_band` for:** All UI theming decisions (palette, mascot, font scale) — no change from before.

---

### 2. `GET /api/v1/student/skill-map`

The root response now includes `placement_band`.

**Updated root shape:**
```json
{
  "student_level": 3,
  "placement_band": "middle",
  "current_focus_domain_id": "reading",
  "next_unlock": { ... },
  "domains": [ ... ]
}
```

**Use `placement_band` for:** Optionally showing a badge or label on the skill-map screen indicating the student's content tier (e.g. "Contenido: Intermedio ⭐").

---

### 3. `POST /api/v1/student/session/{session_id}/complete`

Two new fields are returned: `band_advanced` and `placement_band`.

**Updated response shape:**
```json
{
  "success": true,
  "xp_awarded": 45,
  "new_level": 3,
  "levelled_up": false,
  "streak_days": 5,
  "band_advanced": true,
  "placement_band": "upper"
}
```

| Field | Type | Description |
|---|---|---|
| `band_advanced` | `boolean` | `true` when the student just advanced to a harder content tier this session |
| `placement_band` | `string` | The student's current placement band **after** this session (reflects the advance if `band_advanced` is true) |

When `band_advanced` is `false`, `placement_band` is the same tier they were already on. It is always safe to read `placement_band` to update local state regardless of `band_advanced`.

---

## Band Advancement Celebration Screen

When `band_advanced: true` is returned from session complete, show a **one-time celebration modal or screen** before continuing to the post-session summary.

### Trigger logic
```dart
if (sessionCompleteResponse.bandAdvanced) {
  // Show band advancement celebration, then continue
  showBandAdvancementModal(newBand: sessionCompleteResponse.placementBand);
}
```

### What to display

| `placement_band` | Spanish display | English display | Suggested icon |
|---|---|---|---|
| `"early"` | Principiante | Beginner | 🌱 |
| `"middle"` | Intermedio | Intermediate | ⭐ |
| `"upper"` | Avanzado | Advanced | 🚀 |

**Recommended copy (Spanish):**
> ¡Increíble progreso! 🚀  
> Has demostrado dominar el contenido de tu nivel.  
> A partir de ahora practicarás con material más avanzado.  
> **Nivel de contenido: Avanzado**

**Recommended copy (English):**
> Amazing progress! 🚀  
> You've mastered your current content level.  
> From now on you'll practice with more advanced material.  
> **Content level: Advanced**

### Advancement conditions (for reference, backend-enforced)
- Student has practiced at least 5 distinct skills
- Average mastery score across all practiced skills ≥ 80
- Not already at `upper` band (maximum tier)

The frontend never needs to compute this — always trust the `band_advanced` field from the server.

---

## Updating Local Student State

After a successful session complete response, update the locally cached student object:

```dart
// Always update placement_band from session complete response
localStudent.placementBand = sessionCompleteResponse.placementBand;

// If band advanced, also update any UI that shows content level
if (sessionCompleteResponse.bandAdvanced) {
  localStudent.placementBand = sessionCompleteResponse.placementBand;
  showBandAdvancementModal(...);
}
```

After a successful login, the `student.placement_band` in the response is the authoritative current value — always overwrite local state with this.

---

## What Does NOT Change

- `age_band` and all persona/visual theme logic — **completely unchanged**
- All other endpoints not mentioned above — **no changes**
- Activity structure, question format, response format — **no changes**
- Diagnostic flow — the backend automatically selects grade-appropriate diagnostic activities; no frontend change needed
- Session flow — the backend automatically serves the correct content pool; no frontend change needed

---

## Implementation Priority

| Item | Priority | Notes |
|---|---|---|
| Read `placement_band` from login + cache it | **High** | Needed for profile/settings display |
| Add `placement_band` to skill-map display | **Medium** | Nice-to-have label on skill-map screen |
| Band advancement celebration screen | **Medium** | `band_advanced` is safe to ignore until ready — sessions complete normally either way |
| Update local state from session complete | **High** | Always sync `placement_band` from session complete response |

The `band_advanced` and `placement_band` fields in session complete are **additive**. If you haven't built the celebration screen yet, the session will still complete successfully — just don't show the modal. Your existing session-complete handling will not break.

---

## Summary Checklist

- [ ] Add `placement_band` to the `Student` model / data class
- [ ] Read and persist `student.placement_band` from `POST /auth/student/login`
- [ ] Display content level label using `placement_band` on profile / settings screen
- [ ] Read `placement_band` from `GET /skill-map` root and display optionally
- [ ] After `POST /session/{id}/complete`, always update `localStudent.placementBand`
- [ ] When `band_advanced: true`, show band advancement celebration modal
- [ ] Dismiss celebration → continue to normal post-session summary

---

## Change Log

| Date | Change |
|---|---|
| 2026-03-23 | Initial document — grade-band content progression contract |
