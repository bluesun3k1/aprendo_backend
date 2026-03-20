# Aprendo Backend — Build Progress

**Date:** March 20, 2026  
**Framework:** Laravel 12  
**Database:** MySQL (`aprendo_backend`)  
**Auth:** Laravel Sanctum (token-based, supports both `User` and `Student` models)

---

## Environment

| Setting | Value |
|---|---|
| `DB_CONNECTION` | `mysql` |
| `DB_DATABASE` | `aprendo_backend` |
| `DB_HOST` | `127.0.0.1` |
| `DB_PORT` | `3306` |
| `DB_USERNAME` | `root` |
| `CACHE_STORE` | `file` (no Redis required) |
| `QUEUE_CONNECTION` | `database` |
| `SESSION_DRIVER` | `database` |

---

## Packages Installed

| Package | Version | Purpose |
|---|---|---|
| `laravel/sanctum` | ^4.3 | Token-based API authentication |

---

## Database — Migrations

All 17 migrations run successfully via `php artisan migrate:fresh --seed`.

| # | Migration | Tables Created |
|---|---|---|
| 1 | `0001_01_01_000000_create_users_table` | `users`, `password_reset_tokens`, `sessions` |
| 2 | `0001_01_01_000001_create_cache_table` | `cache`, `cache_locks` |
| 3 | `0001_01_01_000002_create_jobs_table` | `jobs`, `job_batches`, `failed_jobs` |
| 4 | `2026_03_20_000001_create_schools_table` | `schools` |
| 5 | `2026_03_20_000002_create_students_table` | `students` |
| 6 | `2026_03_20_000003_create_skill_domains_and_skills_table` | `skill_domains`, `skills` |
| 7 | `2026_03_20_000004_create_activities_table` | `activities` |
| 8 | `2026_03_20_000005_create_mastery_scores_table` | `mastery_scores` |
| 9 | `2026_03_20_000006_create_learning_paths_and_sessions_table` | `learning_paths`, `student_sessions`, `session_activities` |
| 10 | `2026_03_20_000007_create_attempts_table` | `attempts` |
| 11 | `2026_03_20_000008_create_diagnostics_table` | `diagnostics`, `diagnostic_activities` |
| 12 | `2026_03_20_000009_create_badges_table` | `badges`, `student_badges` |
| 13 | `2026_03_20_000010_create_missions_table` | `weekly_missions`, `student_missions` |
| 14 | `2026_03_20_000011_create_streaks_table` | `streaks` |
| 15 | `2026_03_20_000012_create_progress_snapshots_table` | `progress_snapshots` |
| 16 | `2026_03_20_000013_create_device_tokens_table` | `device_tokens` |
| 17 | `2026_03_20_193115_create_personal_access_tokens_table` | `personal_access_tokens` (UUID-compatible `tokenable_id`) |

> **Note:** The `users` migration was updated to use UUIDs as primary keys and includes `role` and `school_id` columns. The `personal_access_tokens` migration uses `char(36)` for `tokenable_id` to support UUID-keyed polymorphic models (`User` and `Student`).

---

## Models

All models use UUID primary keys via `HasUuids`.

| Model | Table | Key Notes |
|---|---|---|
| `User` | `users` | Roles: `teacher`, `admin`, `platform_admin`. Has `HasApiTokens`. |
| `Student` | `students` | School-scoped login (school + username + PIN). Has `HasApiTokens`. |
| `School` | `schools` | Identified by `school_code` (e.g. `SCH-001`). |
| `SkillDomain` | `skill_domains` | String PK: `reading`, `attention`, `reasoning`. |
| `Skill` | `skills` | Belongs to domain. Slug `name` field (e.g. `main_idea`). |
| `Activity` | `activities` | Types: `multiple_choice`, `drag_to_sort`, `tap_sequence`. `correct_answer` is server-only JSON. |
| `MasteryScore` | `mastery_scores` | 0–100 score per student/skill pair. Tracks `trend`. |
| `LearningPath` | `learning_paths` | One per student, created after diagnostic. |
| `StudentSession` | `student_sessions` | Statuses: `pending`, `in_progress`, `completed`. Stores `domains` JSON. |
| `SessionActivity` | `session_activities` | Pivot with `order_index`. |
| `Attempt` | `attempts` | Per-activity response, correctness, score delta, feedback. |
| `Diagnostic` | `diagnostics` | One-time placement assessment. |
| `Badge` | `badges` | Trigger-based (e.g. `first_session`, `streak_3`). |
| `StudentBadge` | `student_badges` | Earned badges with `earned_at` timestamp. |
| `WeeklyMission` | `weekly_missions` | Mission definitions with `target` count. |
| `StudentMission` | `student_missions` | Per-student per-week progress tracking. |
| `Streak` | `streaks` | Current/best streak + date history array. |
| `ProgressSnapshot` | `progress_snapshots` | Daily mastery snapshots per domain (for charts). |
| `DeviceToken` | `device_tokens` | FCM push tokens (stubbed, ready for Firebase). |

---

## Services

### `AdaptiveEngineService`
Generates (or retrieves) today's session for a student using the V1 composition rules:

| Slot | % | Strategy |
|---|---|---|
| Weakest skill | 50% | 3 activities at appropriate/reduced difficulty |
| Reinforcement | 30% | 2 activities from average-mastery skills at level |
| Stretch | 20% | 1 activity from strongest skill at higher difficulty |

Difficulty is auto-scaled based on mastery score (0–100):
- Score < 40 → difficulty 1
- Score 40–79 → difficulty 2
- Score ≥ 80 → difficulty 3 (stretch)

### `MasteryScoreService`
- Evaluates correctness for all 3 activity types server-side
- Calculates score delta (difficulty × base points, with speed bonus)
- Updates `mastery_scores` and emits `progress_snapshots` (once per day per domain)
- Returns trend: `up`, `stable`, or `down`

### `DiagnosticService`
- Selects 9 diagnostic activities (3 domains × 3 difficulties, flagged `is_diagnostic = true`)
- Processes bulk submissions and bootstraps `mastery_scores` for new students
- Creates `learning_path` record on completion
- Sets `student.diagnostic_completed = true`

### `RewardService`
- Updates streaks (current + best, rolling 30-day history)
- Increments weekly mission progress for `sessions_completed` type
- Checks and awards badges based on trigger conditions:
  - `first_session`, `streak_3`, `streak_5`, `streak_10`
  - `sessions_5`, `sessions_10`, `points_100`, `points_500`

---

## Middleware

| Class | Alias | Purpose |
|---|---|---|
| `SetLocale` | `setlocale` | Reads `Accept-Language: es|en` header, sets `app()->locale()`. Applied globally to all API routes. |
| `EnsureIsStudent` | `student` | Guards student routes — verifies Sanctum token resolves to a `Student` instance and `is_active = true`. |
| `EnsureIsTeacher` | `teacher` | Guards teacher routes — verifies Sanctum token resolves to a `User` instance and `is_active = true`. |

---

## API Routes

All routes are prefixed `/api/v1/`.

### Public

| Method | Endpoint | Controller | Description |
|---|---|---|---|
| `POST` | `/auth/student/login` | `AuthController@studentLogin` | Login with school code + username + PIN |
| `POST` | `/auth/login` | `AuthController@login` | Login with email + password (teacher/admin) |
| `POST` | `/auth/logout` | `AuthController@logout` | Revoke current Sanctum token |

### Student (requires `auth:sanctum` + `student` middleware)

| Method | Endpoint | Controller | Description |
|---|---|---|---|
| `PATCH` | `/student/profile` | `ProfileController@update` | Update grade/age (onboarding) |
| `GET` | `/student/dashboard` | `DashboardController@index` | Dashboard data |
| `GET` | `/student/diagnostic` | `DiagnosticController@show` | Get/create diagnostic session (9 activities) |
| `POST` | `/student/diagnostic/{id}/submit` | `DiagnosticController@submit` | Submit diagnostic answers |
| `GET` | `/student/session/today` | `SessionController@today` | Get/generate today's adaptive session |
| `POST` | `/student/session/{id}/attempt` | `SessionController@attempt` | Submit single activity attempt |
| `POST` | `/student/session/{id}/attempts/bulk` | `SessionController@bulkAttempt` | Submit queued offline attempts |
| `POST` | `/student/session/{id}/complete` | `SessionController@complete` | Finalize session, get summary + badges |
| `GET` | `/student/skill-map` | `SkillMapController@index` | Full skill map with mastery scores |
| `GET` | `/student/progress` | `ProgressController@index` | Progress history (`?domain=reading&days=30`) |
| `GET` | `/student/rewards` | `RewardsController@index` | Points, badges, streak, weekly missions |
| `POST` | `/student/device-token` | `DeviceTokenController@store` | Register FCM push token (stubbed) |

### Teacher (requires `auth:sanctum` + `teacher` middleware)

| Method | Endpoint | Controller | Description |
|---|---|---|---|
| `POST` | `/teacher/students/{id}/reset-pin` | `StudentController@resetPin` | Reset a student's PIN |

---

## Seed Data

Run via `php artisan db:seed` (or `migrate:fresh --seed`).

### Schools
| School Code | Name |
|---|---|
| `SCH-001` | Colegio San Martín |
| `SCH-002` | Colegio Simón Bolívar |

### Users (linked to SCH-001)
| Email | Password | Role |
|---|---|---|
| `teacher@school.com` | `password` | `teacher` |
| `admin@aprendo.com` | `admin1234` | `platform_admin` |

### Students (linked to SCH-001)
| Username | PIN | Display Name | Grade |
|---|---|---|---|
| `maria.lopez` | `1234` | María López | 5 |
| `carlos.ramirez` | `5678` | Carlos Ramírez | 4 |
| `sofia.torres` | `0000` | Sofía Torres | 6 |

### Domains & Skills
All 3 domains and 27 skills from the contract seeded with ES/EN labels.

### Activities
- **9 diagnostic activities** — 3 per domain × 1 per difficulty (1/2/3), `is_diagnostic = true`
- **16 session activities** — across all domains and all 3 activity types, `is_diagnostic = false`

### Badges (7)
`Explorador` · `Primera racha` · `Constancia` · `Imparable` · `Lector veloz` · `Maestro` · `Coleccionista`

### Weekly Missions (1 active)
"Completa 3 sesiones esta semana"

---

## Key Design Decisions

1. **Dual-model Sanctum auth** — Both `User` and `Student` implement `HasApiTokens`. The `AppServiceProvider` registers a custom `authenticateAccessTokensUsing` callback so Sanctum resolves to whichever model issued the token. `personal_access_tokens.tokenable_id` uses `char(36)` (UUID-compatible).

2. **`correct_answer` never sent to client** — Activities have separate `content` (public) and `correct_answer` (server-only) JSON columns. All controllers strip `correct_answer` before returning responses.

3. **Localization** — `SetLocale` middleware reads `Accept-Language: es|en` on every request. All user-facing strings (`instructions`, `label`, `description`) are stored as `_es` / `_en` column pairs and resolved at response time.

4. **No Redis** — Cache uses `file` driver, queues use `database` driver.

5. **MySQL compatibility** — `Builder::defaultStringLength(191)` set in `AppServiceProvider` for older MySQL/MariaDB versions. Composite unique indexes on `skills` use explicit column lengths.

6. **Offline bulk attempts** — `POST /student/session/{id}/attempts/bulk` processes an array of queued attempts (with optional `client_timestamp`) and returns an array of attempt results.

---

## What's Not Yet Built (Future Phases)

- Push notifications (FCM) — endpoint stubbed, token storage ready
- Parent role and parent-facing endpoints
- Teacher web portal (teacher dashboard, class analytics, student management UI)
- Admin school management endpoints
- Activity content management (CMS / admin panel for adding new activities)
