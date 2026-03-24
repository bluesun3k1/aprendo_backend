# Normalized Starter Packs — Waves 8 to 10

These packs were normalized into the newer registry structure used by the later structured content waves.

## Normalization rules applied
- Added `grade_band`, `pack_role`, `recommended_sequence_order`, `unlock_stage`, `estimated_session_count`, `activity_count`, and `status`.
- Kept original `pack_code`, `domain`, `curriculum_unit_code`, `primary_skills`, and `secondary_skills`.
- Packs already represented in the current registry were aligned to their existing placement.
- Packs not previously placed in the registry were normalized as `support` with `support_only` unlock stage pending final curriculum sequencing.

## Normalized pack registry

| pack_code | domain | grade_band | curriculum_unit_code | pack_role | recommended_sequence_order | unlock_stage | primary_skills | secondary_skills | estimated_session_count | activity_count | status | normalization_notes |
|---|---|---|---|---|---|---|---|---|---|---|---|---|
| g2_animal_homes | reading | grade_2 | early_reading_basics | core | 7 | unit_core | main_idea, classification, supporting_details | compare_contrast, sequencing | 2 | 4 | drafted | Core progression pack from pre-structured wave; metadata aligned to current registry placement. |
| g34_weather_watchers | reading | grades_3_4 | middle_reading_interpretation | core | 7 | unit_core | supporting_details, summarization, cause_effect | context_clues, decision_making | 2 | 4 | drafted | Core progression pack from pre-structured wave; metadata aligned to current registry placement. |
| g56_water_use_report | reading | grades_5_6 | upper_advanced_reading | core | 7 | unit_core | evaluating_evidence, compare_contrast, problem_solving | identifying_purpose, fact_vs_opinion | 2 | 4 | drafted | Core progression pack from pre-structured wave; metadata aligned to current registry placement. |
| g2_bus_stop_morning | reading | grade_2 | early_reading_basics | core | 1 | unit_entry | sequencing, supporting_details, main_idea | instruction_following, selective_attention | 2 | 4 | drafted | Core entry pack from pre-structured wave; metadata aligned to current registry placement. |
| g34_park_cleanup | reading | grades_3_4 | middle_reading_interpretation | core | 9 | unit_late | main_idea, cause_effect, summarization | supporting_details, decision_making | 2 | 4 | drafted | Core late-unit pack from pre-structured wave; metadata aligned to current registry placement. |
| g56_science_fair_article | reading | grades_5_6 | upper_advanced_reading | core | 9 | unit_late | identifying_purpose, evaluating_evidence, compare_contrast | fact_vs_opinion, summarization | 2 | 4 | drafted | Core late-unit pack from pre-structured wave; metadata aligned to current registry placement. |
| g2_rain_after_school | reading | grade_2 | early_reading_basics | core | 10 | unit_late | cause_effect, sequencing, supporting_details | main_idea, decision_making | 2 | 4 | drafted | Core late-unit pack from pre-structured wave; metadata aligned to current registry placement. |
| g34_butterfly_garden | reading | grades_3_4 | middle_reading_interpretation | support | 21 | support_only | compare_contrast, supporting_details, summarization | cause_effect, context_clues | 2 | 4 | drafted | Pre-structured pack not yet placed in prior core registry; normalized as support/gap-fill pack pending final curriculum sequencing. |
| g56_city_trees_report | reading | grades_5_6 | upper_advanced_reading | support | 21 | support_only | evaluating_evidence, summarization, identifying_purpose | compare_contrast, fact_vs_opinion | 2 | 4 | drafted | Pre-structured pack not yet placed in prior core registry; normalized as support/gap-fill pack pending final curriculum sequencing. |

## Placement notes

- `g2_animal_homes`, `g34_weather_watchers`, `g56_water_use_report`, `g2_bus_stop_morning`, `g34_park_cleanup`, `g56_science_fair_article`, and `g2_rain_after_school` were aligned to the existing master pack registry placement already established in the later structured map.
- `g34_butterfly_garden` and `g56_city_trees_report` did not have prior explicit placement in the later registry, so they were normalized as support/gap-fill packs until you decide whether to promote them into the core progression.
- All packs were kept at `estimated_session_count = 2` and `activity_count = 4`, matching the working convention used in the registry and session blueprint guidance.
