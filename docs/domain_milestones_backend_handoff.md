# Domain Milestones — Backend Implementation Handoff

This document explains how to implement the milestone system for the student app.

It is written for backend use and assumes the app already has:

- domains
- skills
- mastery scores
- curriculum tracks / units
- student progress
- gamification / XP concepts

The goal is to make milestones:

- easy to seed
- easy to query
- meaningful for students
- flexible enough to expand later

---

# 1. Recommendation Summary

## Keep domain milestones
Yes — keep **domain-based milestones** as the primary mastery milestone system.

This is a good fit because domain milestones map well to:

- the skill map
- progress reporting
- student motivation
- teacher / parent interpretation

Current domains:
- `reading`
- `attention`
- `reasoning`
- `math`

## Expand the milestone ladder
Do not keep only 3 milestones per domain at thresholds 40 / 60 / 80.

That is too sparse for a student-facing experience.

Recommended first production ladder:

- **20** → early progress milestone
- **40** → explorer milestone
- **60** → builder / navigator milestone
- **80** → advanced milestone
- **95** → mastery milestone

This creates more visible progress and earlier reinforcement.

## Keep thresholds domain-based
Domain milestones should continue to be unlocked using the student's **domain mastery score**.

Do not switch the main domain milestone system to XP-only or streak-only logic.

XP, streak, and behavior milestones can exist later as separate milestone families.

---

# 2. Recommended Milestone Model

## Current model
Current fields:

- `domain_id`
- `threshold`
- `name`
- `description`
- `sort_order`
- `created_at`
- `updated_at`

This is a valid start, but it should be expanded slightly.

## Recommended table design

### Table: `milestones`

Suggested columns:

- `id`
- `milestone_type` enum/string
- `domain_id` nullable
- `skill_id` nullable
- `threshold` nullable
- `name`
- `description`
- `sort_order`
- `icon` nullable
- `reward_xp` nullable default 0
- `celebration_level` nullable
- `is_hidden` boolean default false
- `created_at`
- `updated_at`

## Meaning of fields

### `milestone_type`
Recommended values:

- `domain`
- `skill`
- `streak`
- `sessions`
- `unit_completion`

For now, the system can launch with only `domain`.

### `domain_id`
Used for domain milestones such as Reading or Math.

### `skill_id`
Reserved for future skill-level milestones.

### `threshold`
For domain milestones, this means the minimum domain mastery required.

Examples:
- 20
- 40
- 60
- 80
- 95

### `icon`
Optional string for frontend rendering.
Examples:
- `book-open`
- `sparkles`
- `target`
- `brain`
- `calculator`

### `reward_xp`
Optional XP bonus awarded when milestone is first unlocked.

### `celebration_level`
Recommended values:
- `small`
- `medium`
- `big`

This lets the frontend vary the celebration intensity.

### `is_hidden`
Useful later for secret or surprise milestones.
Can remain `false` for domain milestones.

---

# 3. Recommended Student Progress Table

A milestone definition table is not enough.
You also need a table that records what the student has actually unlocked.

### Table: `student_milestones`

Suggested columns:

- `id`
- `student_id`
- `milestone_id`
- `unlocked_at`
- `source_domain_score` nullable
- `source_skill_score` nullable
- `meta` JSON nullable
- `created_at`
- `updated_at`

## Notes

### Unique constraint
Add a unique constraint on:

- `(student_id, milestone_id)`

This prevents duplicate unlocks.

### `source_domain_score`
For domain milestones, store the domain score that triggered the unlock.

Example:
- student unlocked Reading milestone at 62

### `meta`
Optional JSON for future use.
Can store extra context such as:
- previous score
- new score
- domain code
- milestone family

---

# 4. Recommended Unlock Logic

## Domain milestone unlock rule
A student unlocks a domain milestone when:

- the student's domain mastery score
- is greater than or equal to the milestone threshold
- and the milestone has not already been unlocked for that student

## Example
If a student's `reading` domain score becomes `61`:

- unlock reading milestone at `20`
- unlock reading milestone at `40`
- unlock reading milestone at `60`

Do not wait for the student to pass each one separately if some were skipped by a large jump.
The system should backfill all missed thresholds.

## When to evaluate milestone unlocks
Run milestone checks when any of the following happen:

- mastery score update completes
- session completion updates domain aggregates
- backfill / repair job runs
- student band transition recalculates domain state

## Recommended service
Create a service like:

- `MilestoneUnlockService`

Suggested responsibilities:
- read the student's current domain mastery
- find all matching milestone definitions
- find which ones are not yet unlocked
- create `student_milestones` rows
- optionally emit events / notifications / XP awards

---

# 5. How Domain Mastery Should Be Read

Domain milestones should not be based on:
- single activity correctness
- XP totals
- raw streak count

They should be based on **aggregated domain mastery**.

## Recommended source
If the app already computes domain progress from skill mastery, use that computed domain score.

Example sources:
- aggregate of skill scores inside a domain
- weighted average of active skills in unlocked units
- existing student-domain progress snapshot table if available

## Important
Use the same domain score source that powers:
- skill map summaries
- progress bars
- teacher reports

The milestone system should not invent a second progress system.

---

# 6. Recommended Domain Milestone Ladder

Below is a seed-ready recommendation for the first production version.

## Reading

### 20
- **Name:** Primer lector
- **Description:** Ya estás dando tus primeros pasos para entender mejor lo que lees.

### 40
- **Name:** Explorador de lectura
- **Description:** Sigues descubriendo pistas importantes en los textos. ¡Sigue avanzando!

### 60
- **Name:** Navegante lector
- **Description:** Estás comprendiendo mejor las ideas principales y los detalles importantes.

### 80
- **Name:** Guía lector
- **Description:** Lees con más seguridad y entiendes mejor lo que un texto quiere decir.

### 95
- **Name:** Maestro lector
- **Description:** Has alcanzado un nivel muy alto de comprensión lectora. ¡Excelente trabajo!

---

## Attention

### 20
- **Name:** Primer enfoque
- **Description:** Ya estás empezando a concentrarte mejor en las actividades.

### 40
- **Name:** Explorador de enfoque
- **Description:** Tu atención está creciendo. Cada vez detectas mejor lo importante.

### 60
- **Name:** Guardián de atención
- **Description:** Tu enfoque mejora mucho y te ayuda a resolver actividades con más cuidado.

### 80
- **Name:** Centinela del enfoque
- **Description:** Mantienes la atención con mucha más fuerza y control.

### 95
- **Name:** Maestro de atención
- **Description:** Has desarrollado un gran dominio del enfoque y la atención.

---

## Reasoning

### 20
- **Name:** Primer pensador
- **Description:** Ya estás comenzando a resolver problemas con más lógica.

### 40
- **Name:** Explorador lógico
- **Description:** Sigues desarrollando tu razonamiento paso a paso.

### 60
- **Name:** Navegante lógico
- **Description:** Tus decisiones y conclusiones muestran un pensamiento más fuerte.

### 80
- **Name:** Estratega lógico
- **Description:** Resuelves problemas con más claridad y mejores decisiones.

### 95
- **Name:** Maestro del razonamiento
- **Description:** Has alcanzado un nivel muy alto de pensamiento lógico y crítico.

---

## Math

### 20
- **Name:** Primer matemático
- **Description:** Ya estás dando tus primeros pasos en el pensamiento matemático.

### 40
- **Name:** Explorador matemático
- **Description:** Sigues descubriendo patrones, cantidades y relaciones numéricas.

### 60
- **Name:** Navegante matemático
- **Description:** Comprendes mejor los números y resuelves situaciones con más seguridad.

### 80
- **Name:** Estratega matemático
- **Description:** Tu pensamiento matemático es cada vez más sólido y flexible.

### 95
- **Name:** Maestro matemático
- **Description:** Has alcanzado un dominio muy alto del razonamiento matemático.

---

# 7. Suggested Seed Data Shape

Example JSON-like structure:

```php
[
    [
        'milestone_type' => 'domain',
        'domain_id' => 'reading',
        'threshold' => 20,
        'name' => 'Primer lector',
        'description' => 'Ya estás dando tus primeros pasos para entender mejor lo que lees.',
        'sort_order' => 1,
        'icon' => 'book-open',
        'reward_xp' => 10,
        'celebration_level' => 'small',
        'is_hidden' => false,
    ],
    [
        'milestone_type' => 'domain',
        'domain_id' => 'reading',
        'threshold' => 40,
        'name' => 'Explorador de lectura',
        'description' => 'Sigues descubriendo pistas importantes en los textos. ¡Sigue avanzando!',
        'sort_order' => 2,
        'icon' => 'compass',
        'reward_xp' => 15,
        'celebration_level' => 'small',
        'is_hidden' => false,
    ],
]
```

Repeat the same pattern for:
- attention
- reasoning
- math

---

# 8. Recommended Query Behavior

## For student app
To show the next milestone in a domain:

1. get all milestones for `milestone_type = domain` and that `domain_id`
2. sort by `threshold`
3. compare against current domain score
4. find:
   - latest unlocked milestone
   - next locked milestone

## For profile / rewards screen
Return:
- unlocked milestones
- next milestones in progress
- threshold progress percentage
- optional reward info

## For teacher / parent view
Optional later:
- total milestones unlocked
- milestones unlocked by domain
- students near next milestone

---

# 9. Recommended Event Flow

## After mastery update
When a session updates skill mastery and then domain mastery:

1. domain score recalculated
2. `MilestoneUnlockService` runs
3. new milestone rows created in `student_milestones`
4. optional:
   - XP bonus awarded
   - in-app notification created
   - celebration event emitted

## Suggested events
Optional internal events:
- `MilestoneUnlocked`
- `DomainMilestoneUnlocked`

This will help:
- frontend celebration
- analytics
- notification system

---

# 10. Expansion Plan (later, not required now)

Do **not** block the first implementation on this.
But the milestone system should be built so these can be added later.

## Future milestone families
### Skill milestones
Examples:
- Main Idea Explorer
- Fraction Builder
- Pattern Finder

### Streak milestones
Examples:
- 3-day streak
- 7-day streak
- 14-day streak

### Session milestones
Examples:
- First 5 sessions
- 25 sessions completed
- 50 sessions completed

### Unit completion milestones
Examples:
- completed first reading unit
- completed first math unit

Because of this, the backend should not hardcode the milestone system as domain-only forever.
Use `milestone_type` from the start.

---

# 11. Recommended MVP Scope

For MVP / first production pass:

## Build now
- `milestones` table
- `student_milestones` table
- `milestone_type = domain`
- 5 thresholds per domain
- reading / attention / reasoning / math
- unlock-on-domain-mastery logic
- optional XP reward support

## Do not block on
- skill milestones
- hidden milestones
- rare achievements
- complicated reward bundles
- teacher milestone assignment

---

# 12. Final Implementation Recommendation

## Keep
- domain-based milestone logic
- mastery threshold unlocks

## Expand
- from 3 levels to 5 levels
- to include math
- with student unlock records

## Add
- `milestone_type`
- `icon`
- `reward_xp`
- `celebration_level`

## Do not replace with
- XP-only milestones
- streak-only milestones
- random achievement logic

The milestone system should stay anchored in **domain growth**, because that best matches the educational purpose of the app.

---

# 13. Seed Checklist

Before seeding, confirm:

- `math` exists in `domains`
- backend can read current domain mastery per student
- `milestones` table exists
- `student_milestones` table exists
- unique constraint on `(student_id, milestone_id)` exists
- unlock service exists
- frontend knows how to render milestone metadata

---

# 14. Suggested Backend Ticket Title

**Implement domain milestone system with 5 threshold levels per domain and student unlock tracking**
