# Normalized Starter Packs — Waves 2 to 7

This document normalizes the early starter pack waves into the newer registry structure used by the later reading and math packs.

## Normalization rules used

- Added `grade_band`, `pack_role`, `recommended_sequence_order`, `unlock_stage`, `estimated_session_count`, `activity_count`, and `status` to every pack.
- Kept the original `pack_code`, `domain`, `curriculum_unit_code`, primary skills, and secondary skills.
- Classified all of these legacy packs as `core` packs because they are curriculum-progression content, not support-only gap-fill packs.
- Mapped sequence order within each band using the order implied by Waves 2–7.
- Flagged any pack using `story_strip_sequencing` as a legacy template that may require renderer support or conversion.

## Grade 2 — Normalized registry

| pack_code | domain | curriculum_unit_code | pack_role | seq | unlock_stage | primary_skills | secondary_skills | est_sessions | activities | legacy_flags | status |
|---|---|---|---|---:|---|---|---|---:|---:|---|---|
| g2_rainy_day_plans | reading | early_reading_basics | core | 1 | unit_entry | sequencing, supporting_details, main_idea | instruction_following, cause_effect | 2 | 4 |  | normalized_from_legacy_wave |
| g2_class_pet | reading | early_reading_basics | core | 2 | unit_entry | supporting_details, main_idea, sequencing | classification, instruction_following | 2 | 4 |  | normalized_from_legacy_wave |
| g2_day_and_night | reading | early_reading_basics | core | 3 | unit_core | compare_contrast, sequencing, main_idea | classification, supporting_details | 2 | 4 |  | normalized_from_legacy_wave |
| g2_helping_a_friend | reading | early_reading_basics | core | 4 | unit_core | main_idea, cause_effect, sequencing | supporting_details, decision_making | 2 | 4 |  | normalized_from_legacy_wave |
| g2_garden_helpers | reading | early_reading_basics | core | 5 | unit_late | supporting_details, classification, sequencing | main_idea, cause_effect | 2 | 4 |  | normalized_from_legacy_wave |
| g2_market_morning | reading | early_reading_basics | core | 6 | unit_late | supporting_details, sequencing, main_idea | classification, decision_making | 2 | 4 |  | normalized_from_legacy_wave |

## Grades 3–4 — Normalized registry

| pack_code | domain | curriculum_unit_code | pack_role | seq | unlock_stage | primary_skills | secondary_skills | est_sessions | activities | legacy_flags | status |
|---|---|---|---|---:|---|---|---|---:|---:|---|---|
| g34_lost_backpack | reading | middle_reading_interpretation | core | 1 | unit_entry | inference, supporting_details, summarization | decision_making, sequencing | 2 | 5 | uses_story_strip_sequencing | normalized_from_legacy_wave |
| g34_river_trip | reading | middle_reading_interpretation | core | 2 | unit_entry | compare_contrast, context_clues, summarization | supporting_details, cause_effect | 2 | 4 |  | normalized_from_legacy_wave |
| g34_inventors_notebook | reading | middle_reading_interpretation | core | 3 | unit_core | main_idea, context_clues, problem_solving | supporting_details, compare_contrast | 2 | 4 |  | normalized_from_legacy_wave |
| g34_growing_plants | reading | middle_reading_interpretation | core | 4 | unit_core | sequencing, supporting_details, summarization | cause_effect, context_clues | 2 | 4 | uses_story_strip_sequencing | normalized_from_legacy_wave |
| g34_maps_and_neighborhoods | reading | middle_reading_interpretation | core | 5 | unit_late | context_clues, compare_contrast, supporting_details | decision_making, sequencing | 2 | 4 |  | normalized_from_legacy_wave |
| g34_recycling_day | reading | middle_reading_interpretation | core | 6 | unit_late | main_idea, supporting_details, cause_effect | context_clues, decision_making | 2 | 4 |  | normalized_from_legacy_wave |

## Grades 5–6 — Normalized registry

| pack_code | domain | curriculum_unit_code | pack_role | seq | unlock_stage | primary_skills | secondary_skills | est_sessions | activities | legacy_flags | status |
|---|---|---|---|---:|---|---|---|---:|---:|---|---|
| g56_school_news_article | reading | upper_advanced_reading | core | 1 | unit_entry | identifying_purpose, fact_vs_opinion, evaluating_evidence | compare_contrast, inference | 2 | 5 |  | normalized_from_legacy_wave |
| g56_plastic_in_the_ocean | reading | upper_advanced_reading | core | 2 | unit_entry | evaluating_evidence, summarization, identifying_purpose | fact_vs_opinion, inference | 2 | 5 |  | normalized_from_legacy_wave |
| g56_ancient_city_discovery | reading | upper_advanced_reading | core | 3 | unit_core | inference, evaluating_evidence, compare_contrast | identifying_purpose, fact_vs_opinion | 2 | 4 |  | normalized_from_legacy_wave |
| g56_weather_warning_followup | reading | upper_advanced_reading | core | 4 | unit_core | evaluating_evidence, decision_making, identifying_purpose | fact_vs_opinion, compare_contrast | 2 | 4 |  | normalized_from_legacy_wave |
| g56_school_energy_project | reading | upper_advanced_reading | core | 5 | unit_late | evaluating_evidence, problem_solving, compare_contrast | identifying_purpose, inference | 2 | 4 |  | normalized_from_legacy_wave |
| g56_local_news_comparison | reading | upper_advanced_reading | core | 6 | unit_late | compare_contrast, fact_vs_opinion, evaluating_evidence | identifying_purpose, inference | 2 | 4 |  | normalized_from_legacy_wave |

## Notes

- `g34_lost_backpack` and `g34_growing_plants` use `story_strip_sequencing`. If your current renderer does not support that template, either add explicit frontend support or convert those activities to `tap_sequence` or `drag_to_sort` equivalents during seeding.
- These packs are structurally compatible with the newer system after metadata normalization; they do not need to be rewritten.
- They can now be inserted into the same master pack registry and curriculum placement map as the later packs.
