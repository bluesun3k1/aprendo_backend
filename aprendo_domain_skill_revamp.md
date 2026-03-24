## The domains and skills should stay stable.

## The content, difficulty, mastery expectations, and session paths should vary by grade band.

So:

* **Do not rebuild the whole skill framework per grade**
* **Do not assess every student in exactly the same way**
* **Do not make students repeat the exact same content next year**
* **Do reuse the same skills with new content, deeper difficulty, and higher expectations**

That is the correct model.

---

## Best way to think about it

### 1. Domains are universal

These can stay the same across grades:

* Attention & Focus
* Reading Comprehension
* Critical Thinking
* Working Memory
* etc.

A 4th grader and a 7th grader both need reading comprehension.
The difference is **how it is trained and measured**.

### 2. Skills are mostly universal

Many skills also remain the same:

* main_idea
* inference
* sequencing
* classification
* decision_making
* selective_attention

These skills do not disappear from one grade to the next.

### 3. What changes by grade

What should change is:

* content complexity
* text length
* vocabulary difficulty
* abstraction level
* distractor quality
* expected speed
* expected accuracy
* activity presentation style

That is where grade matters.

---

## So what should happen from 4th to 5th grade?

The student should **not** repeat the same content.
But they **may** keep working on the same skill family.

Example:

### Grade 4

`main_idea`

* short passages
* concrete topics
* obvious distractors
* simpler summaries

### Grade 5

`main_idea`

* longer passages
* more subtle distractors
* denser information
* more inferential summaries

Same skill.
Different level of mastery and challenge.

That is exactly how it should work.

---

## Best structure

You should model the system like this:

### Domain

Broad category
Example: `reading`

### Skill

Specific competency
Example: `main_idea`

### Level band / grade band

Complexity layer
Example:

* lower_elementary
* upper_elementary
* middle_school

or

* grades 1–2
* grades 3–5
* grades 6–8

### Content item / activity

Actual exercise shown to student
This is what changes the most.

---

## What should be grade-based?

### Should be grade-banded

* diagnostic difficulty
* activity content
* recommended session sequence
* mastery thresholds
* pacing expectations
* wording / UI tone
* examples and story style

### Should not be completely grade-separate

* domain definitions
* most skill definitions
* global skill progression logic

---

## Best practical recommendation

Do **not** use “grade” as a hard wall.
Use it as the **starting placement context**.

So when a student starts:

* grade helps choose the right entry band
* diagnostic confirms or adjusts it
* system personalizes from there

That is much better than:

* same assessment for everyone
  or
* completely separate isolated grade systems

---

## Best model for your app

I would recommend this:

### Each skill has:

* `skill_code`
* `domain_code`

### Each activity has:

* `skill_code`
* `grade_band`
* `difficulty`
* `content_version`
* `presentation_mode`

### Each student has:

* current grade
* placement band
* mastery by skill
* progress history

This way:

* the same skill can live across years
* content changes
* mastery can continue growing
* students do not feel like they are repeating the same material

---

## Very important point

A student should not “finish” a skill forever in one grade.

Because skills like:

* inference
* decision making
* main idea
* problem solving

can deepen across many years.

So the app should treat skills as:

* **progressive**
* **spiral**
* **continuously refined**

not:

* one-and-done

---

## Best curriculum logic

Use a **spiral progression model**:

* same skills come back
* but with richer content
* deeper complexity
* higher standards
* more independence

That is the most educationally sound answer.

---

## My final answer

Yes — the platform should be **grade-aware**, but not by creating completely separate skills per grade.

The best model is:

* **same domains**
* **mostly same skills**
* **different content, difficulty, expectations, and progression by grade band**
* **diagnostic + performance adjust within that grade band**

So from 4th to 5th grade, the student should **not repeat the same content**, but can absolutely continue developing the **same skills at a more advanced level**.

That is the right design.

I can turn this next into a **grade-band progression model** for your domains and skills.

# Aprendo — Persona & Grade-Adaptive Layout Contract

This document describes what the backend must send so the Flutter app can automatically
apply the correct visual layout (child-friendly vs. formal) for each student.
It also clarifies which images live in the app vs. which are loaded from the backend.

---

## Background

The Flutter app has two visual modes controlled by a concept called **Persona**:

| Persona | Who it targets | Visual style |
|---|---|---|
| `student` | Primary-school students | Warm palette, larger touch targets, rounded cards, playful typography, colourful domain art |
| `adult` | Secondary students, teachers, parents | Calm navy/slate palette, tighter layout, formal typography, flat icons |

Within the `student` persona there are also three **Age Bands** that fine-tune
font sizes, icon styles, and spacing:

| `age_band` value | Grades | Description |
|---|---|---|
| `early` | 1 – 2 | Largest fonts, most illustrative art, maximum spacing |
| `middle` | 3 – 5 | Default student experience |
| `upper` | 6 – 9 | Transitional — student palette but tighter spacing |

> `upper` maps to the `adult` persona in the UI theme. `early` and `middle`
> both map to the `student` persona.

The app already contains all the logic to apply these modes. The only thing
the backend needs to supply is the `age_band` string for each student.

---

## What the Backend Must Send

### 1. `age_band` in the student login response

Add `age_band` to the `student` object returned by `POST /api/v1/auth/student/login`.

**Updated response shape:**
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
    "avatar_url": null,
    "age_band": "middle"
  }
}
```

**Accepted values:** `"early"` | `"middle"` | `"upper"`

If `age_band` is `null` or absent, the app falls back to deriving it from
the numeric prefix of `grade` (e.g. `"5"` → `middle`, `"7"` → `upper`).
The fallback is a safety net — **always send `age_band` explicitly**.

---

### 2. Derivation rule (for backend reference)

The backend should compute `age_band` from the student's enrolled grade when
the student record is created or updated:

```
grade 1–2  → age_band = "early"
grade 3–5  → age_band = "middle"
grade 6+   → age_band = "upper"
teachers / adults → age_band = "upper"  (maps to adult persona in the app)
```

Store `age_band` as a denormalised string column on the `students` table so
the login endpoint can return it without a join.

---

### 3. No other layout-related fields are needed

The app derives **all** visual decisions (palette, font scale, spacing, icon
set, mascot visibility) from a single `age_band` string. No additional flags,
no layout IDs, no theme tokens from the server.

---

## Images — What Lives Where

There are two categories of images in the app. They are handled completely differently.

### A. UI / Persona artwork — **bundled inside the app (no URL from backend)**

These are static design assets that belong to a specific visual mode:

| Asset type | Example | How the app picks it |
|---|---|---|
| Home screen banner | Cartoon vs. clean illustration | `age_band` |
| Domain icons | Sticker-style vs. flat icon | `age_band` |
| Activity card background art | Colourful scene vs. plain | `age_band` |
| Mascot / character | Visible for `early`/`middle`, hidden for `upper` | `age_band` |
| Session result illustration | Celebratory cartoon vs. clean tick | `age_band` |

**The backend does not send URLs for any of these.** They are included in the
app bundle at build time and selected at runtime using the student's `age_band`.

**Why bundled?**
- No network latency — assets render instantly
- Works fully offline (critical for low-connectivity schools)
- Not student-specific — all students in the same age band see the same art
- App store submission already bundles them; no CDN required

---

### B. Dynamic / content images — **URL from backend**

These images are part of actual learning content and differ per activity:

| Image type | Where it appears | Backend field | Notes |
|---|---|---|---|
| Activity option illustration | Inside a `multiple_choice` option | `options[].image_url` | Optional; `null` for text-only options |
| Drag-to-sort item illustration | Inside a `drag_to_sort` item | `items[].image_url` | Optional |
| Illustrated clue | Full-screen image clue activity | `content.image_url` | Required for `illustrated_clue` type |
| Badge icon | Rewards screen, session summary | `badges[].icon_url` | Required; use a square PNG ≥ 128 px |
| Avatar | Student profile (future) | `student.avatar_url` | Currently `null` — reserved for future |

**Requirements for backend-served images:**
- Serve over HTTPS
- At least **300 × 300 px** for activity images; **128 × 128 px** minimum for badge icons
- Prefer square aspect ratios (the app crops to square where needed)
- Use a CDN or object-storage URL (S3, Cloudflare R2, etc.) — do not serve
  directly from the Laravel app server
- URLs must be stable (don't regenerate pre-signed URLs that expire in minutes;
  either use public URLs or long-lived signed URLs of ≥ 7 days)

**The app caches these images on device** using `cached_network_image`. A
broken or slow URL degrades the activity experience noticeably, so image
delivery reliability matters.

---

## Summary Checklist for the Backend Team

- [ ] Add `age_band: "early" | "middle" | "upper"` to the `students` table
- [ ] Return `age_band` in `POST /api/v1/auth/student/login` → `student` object
- [ ] Return `age_band` in `GET /api/v1/student/dashboard` → `student` object (for re-sync after token restore)
- [ ] Ensure `badges[].icon_url` resolves to a stable, HTTPS, square image ≥ 128 px
- [ ] Ensure `options[].image_url` and `items[].image_url` in activity content resolve to stable HTTPS images ≥ 300 px when provided
- [ ] **Do not** add any other layout/theme/persona fields — the app handles everything else internally from `age_band` alone

---

## Change Log

| Date | Change |
|---|---|
| 2026-03-23 | Initial document — persona & grade layout contract |

