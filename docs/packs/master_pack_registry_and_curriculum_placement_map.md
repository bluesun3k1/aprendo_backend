# Master Pack Registry and Curriculum Placement Map

This document converts the authored pack waves into a **usable content structure**.

It does two jobs:
1. provides a **master pack registry** for content operations
2. provides a **curriculum placement map** so packs can be sequenced by grade band, domain, and curriculum unit

This is the structure that makes the content library usable by:
- product
- curriculum planning
- backend seeding
- adaptive delivery
- reporting

---

# 1. How to use this document

## What a wave is
A wave is only a **writing batch**.
It is not the final structure used by the app.

## What the app actually uses
The app should use this hierarchy:

**Domain → Curriculum Unit → Pack → Session Blueprint → Activities**

## What this document standardizes
Every authored pack should be organized with:
- `pack_code`
- `domain`
- `grade_band`
- `curriculum_unit_code`
- `pack_role`
- `recommended_sequence_order`
- `unlock_stage`
- `primary_skills`
- `secondary_skills`
- `estimated_session_count`
- `status`

---

# 2. Recommended pack metadata standard

Use this structure for every pack going forward.

```json
{
  "pack_code": "g34_best_evidence",
  "domain": "reading",
  "grade_band": "grades_3_4",
  "curriculum_unit_code": "middle_reading_interpretation",
  "pack_role": "core",
  "recommended_sequence_order": 8,
  "unlock_stage": "unit_core",
  "primary_skills": ["evidence_selection", "supporting_details", "inference"],
  "secondary_skills": ["summarization", "decision_making"],
  "estimated_session_count": 2,
  "status": "drafted"
}
```

## Suggested status values
- `drafted`
- `reviewed`
- `seed_ready`
- `seeded`

## Suggested unlock_stage values
- `unit_entry`
- `unit_core`
- `unit_late`
- `review_only`
- `support_only`

---

# 3. Master Pack Registry

## Grade 2 — Reading

| pack_code | domain | grade_band | curriculum_unit_code | pack_role | seq | unlock_stage | primary_skills | secondary_skills | est_sessions | status |
|---|---|---|---|---|---:|---|---|---|---:|---|
| g2_bus_stop_morning | reading | grade_2 | early_reading_basics | core | 1 | unit_entry | sequencing, supporting_details, main_idea | instruction_following, selective_attention | 2 | drafted |
| g2_rainy_day_plans | reading | grade_2 | early_reading_basics | core | 2 | unit_core | cause_effect, sequencing, supporting_details | main_idea, decision_making | 2 | drafted |
| g2_helping_a_friend | reading | grade_2 | early_reading_basics | core | 3 | unit_core | supporting_details, sequencing, main_idea | cause_effect, decision_making | 2 | drafted |
| g2_school_garden | reading | grade_2 | early_reading_basics | core | 4 | unit_core | main_idea, supporting_details, sequencing | classification, cause_effect | 2 | drafted |
| g2_class_pet | reading | grade_2 | early_reading_basics | core | 5 | unit_core | supporting_details, classification, sequencing | main_idea, inference | 2 | drafted |
| g2_garden_helpers | reading | grade_2 | early_reading_basics | core | 6 | unit_core | supporting_details, classification, sequencing | main_idea, cause_effect | 2 | drafted |
| g2_animal_homes | reading | grade_2 | early_reading_basics | core | 7 | unit_core | main_idea, classification, supporting_details | compare_contrast, sequencing | 2 | drafted |
| g2_day_and_night | reading | grade_2 | early_reading_basics | core | 8 | unit_late | compare_contrast, sequencing, main_idea | classification, supporting_details | 2 | drafted |
| g2_market_morning | reading | grade_2 | early_reading_basics | core | 9 | unit_late | supporting_details, sequencing, main_idea | classification, decision_making | 2 | drafted |
| g2_rain_after_school | reading | grade_2 | early_reading_basics | core | 10 | unit_late | cause_effect, sequencing, supporting_details | main_idea, decision_making | 2 | drafted |
| g2_classroom_rules_day | reading | grade_2 | early_reading_basics | core | 11 | support_only | instruction_following, sequencing, supporting_details | main_idea, selective_attention | 2 | drafted |
| g2_listen_and_sort | reading | grade_2 | early_reading_basics | core | 12 | support_only | instruction_following, classification, selective_attention | supporting_details, sequencing | 2 | drafted |
| g2_find_the_rule | reading | grade_2 | early_reading_basics | core | 13 | support_only | instruction_following, patterns, selective_attention | classification, supporting_details | 2 | drafted |
| g2_same_and_different | reading | grade_2 | early_reading_basics | core | 14 | support_only | compare_contrast, classification, supporting_details | selective_attention, main_idea | 2 | drafted |
| g2_follow_the_clues | reading | grade_2 | early_reading_basics | core | 15 | support_only | supporting_details, inference, selective_attention | main_idea, instruction_following | 2 | drafted |
| g2_sort_the_signs | reading | grade_2 | early_reading_basics | core | 16 | support_only | classification, instruction_following, visual_discrimination | supporting_details, selective_attention | 2 | drafted |
| g2_which_one_belongs | reading | grade_2 | early_reading_basics | core | 17 | support_only | classification, compare_contrast, visual_discrimination | supporting_details, selective_attention | 2 | drafted |
| g2_rule_or_not | reading | grade_2 | early_reading_basics | core | 18 | support_only | instruction_following, classification, response_control | selective_attention, supporting_details | 2 | drafted |
| g2_find_the_match | reading | grade_2 | early_reading_basics | core | 19 | support_only | classification, visual_discrimination, selective_attention | compare_contrast, supporting_details | 2 | drafted |
| g2_same_group | reading | grade_2 | early_reading_basics | core | 20 | support_only | classification, compare_contrast, selective_attention | visual_discrimination, supporting_details | 2 | drafted |
| g2_match_the_rule | reading | grade_2 | early_reading_basics | core | 21 | support_only | instruction_following, classification, selective_attention | response_control, supporting_details | 2 | drafted |

## Grades 3–4 — Reading

| pack_code | domain | grade_band | curriculum_unit_code | pack_role | seq | unlock_stage | primary_skills | secondary_skills | est_sessions | status |
|---|---|---|---|---|---:|---|---|---|---:|---|
| g34_lost_backpack | reading | grades_3_4 | middle_reading_interpretation | core | 1 | unit_entry | inference, supporting_details, summarization | decision_making, context_clues | 2 | drafted |
| g34_recycling_day | reading | grades_3_4 | middle_reading_interpretation | core | 2 | unit_core | main_idea, supporting_details, cause_effect | context_clues, decision_making | 2 | drafted |
| g34_maps_and_neighborhoods | reading | grades_3_4 | middle_reading_interpretation | core | 3 | unit_core | context_clues, compare_contrast, supporting_details | decision_making, sequencing | 2 | drafted |
| g34_bee_helper | reading | grades_3_4 | middle_reading_interpretation | core | 4 | unit_core | inference, context_clues, summarization | supporting_details, compare_contrast | 2 | drafted |
| g34_river_trip | reading | grades_3_4 | middle_reading_interpretation | core | 5 | unit_core | inference, summarization, supporting_details | cause_effect, decision_making | 2 | drafted |
| g34_growing_plants | reading | grades_3_4 | middle_reading_interpretation | core | 6 | unit_core | context_clues, compare_contrast, supporting_details | decision_making, sequencing | 2 | drafted |
| g34_weather_watchers | reading | grades_3_4 | middle_reading_interpretation | core | 7 | unit_core | supporting_details, summarization, cause_effect | context_clues, decision_making | 2 | drafted |
| g34_inventors_notebook | reading | grades_3_4 | middle_reading_interpretation | core | 8 | unit_late | main_idea, problem_solving, supporting_details | cause_effect, summarization | 2 | drafted |
| g34_park_cleanup | reading | grades_3_4 | middle_reading_interpretation | core | 9 | unit_late | main_idea, cause_effect, summarization | supporting_details, decision_making | 2 | drafted |
| g34_tool_trouble | reading | grades_3_4 | middle_reading_interpretation | core | 10 | support_only | problem_solving, decision_making, context_clues | supporting_details, summarization | 2 | drafted |
| g34_clue_letters | reading | grades_3_4 | middle_reading_interpretation | core | 11 | support_only | inference, context_clues, decision_making | supporting_details, summarization | 2 | drafted |
| g34_two_solutions | reading | grades_3_4 | middle_reading_interpretation | core | 12 | support_only | problem_solving, compare_contrast, decision_making | supporting_details, summarization | 2 | drafted |
| g34_missing_steps | reading | grades_3_4 | middle_reading_interpretation | core | 13 | support_only | sequencing, problem_solving, supporting_details | decision_making, summarization | 2 | drafted |
| g34_best_evidence | reading | grades_3_4 | middle_reading_interpretation | core | 14 | support_only | evidence_selection, supporting_details, inference | summarization, decision_making | 2 | drafted |
| g34_clue_or_not | reading | grades_3_4 | middle_reading_interpretation | core | 15 | support_only | evidence_selection, supporting_details, filtering_distractions | inference, decision_making | 2 | drafted |
| g34_fact_or_clue | reading | grades_3_4 | middle_reading_interpretation | core | 16 | support_only | fact_vs_opinion, evidence_selection, supporting_details | filtering_distractions, inference | 2 | drafted |
| g34_strongest_clue | reading | grades_3_4 | middle_reading_interpretation | core | 17 | support_only | evidence_selection, supporting_details, argument_analysis | filtering_distractions, summarization | 2 | drafted |
| g34_what_proves_it | reading | grades_3_4 | middle_reading_interpretation | core | 18 | support_only | evidence_selection, supporting_details, cause_effect | summarization, inference | 2 | drafted |
| g34_which_detail_matters | reading | grades_3_4 | middle_reading_interpretation | core | 19 | support_only | supporting_details, evidence_selection, filtering_distractions | inference, summarization | 2 | drafted |
| g34_which_sentence_helps | reading | grades_3_4 | middle_reading_interpretation | core | 20 | support_only | evidence_selection, supporting_details, summarization | filtering_distractions, inference | 2 | drafted |

## Grades 5–6 — Reading

| pack_code | domain | grade_band | curriculum_unit_code | pack_role | seq | unlock_stage | primary_skills | secondary_skills | est_sessions | status |
|---|---|---|---|---|---:|---|---|---|---:|---|
| g56_weather_warning | reading | grades_5_6 | upper_advanced_reading | core | 1 | unit_entry | evaluating_evidence, identifying_purpose, decision_making | inference, fact_vs_opinion | 2 | drafted |
| g56_weather_warning_followup | reading | grades_5_6 | upper_advanced_reading | core | 2 | unit_core | evaluating_evidence, problem_solving, compare_contrast | identifying_purpose, inference | 2 | drafted |
| g56_school_news_article | reading | grades_5_6 | upper_advanced_reading | core | 3 | unit_core | fact_vs_opinion, identifying_purpose, evaluating_evidence | compare_contrast, summarization | 2 | drafted |
| g56_local_news_comparison | reading | grades_5_6 | upper_advanced_reading | core | 4 | unit_core | compare_contrast, fact_vs_opinion, evaluating_evidence | identifying_purpose, inference | 2 | drafted |
| g56_plastic_in_the_ocean | reading | grades_5_6 | upper_advanced_reading | core | 5 | unit_core | evaluating_evidence, summarization, identifying_purpose | fact_vs_opinion, compare_contrast | 2 | drafted |
| g56_school_energy_project | reading | grades_5_6 | upper_advanced_reading | core | 6 | unit_core | evaluating_evidence, problem_solving, compare_contrast | identifying_purpose, inference | 2 | drafted |
| g56_water_use_report | reading | grades_5_6 | upper_advanced_reading | core | 7 | unit_core | evaluating_evidence, compare_contrast, problem_solving | identifying_purpose, fact_vs_opinion | 2 | drafted |
| g56_ancient_city_discovery | reading | grades_5_6 | upper_advanced_reading | core | 8 | unit_late | inference, evaluating_evidence, compare_contrast | identifying_purpose, fact_vs_opinion | 2 | drafted |
| g56_science_fair_article | reading | grades_5_6 | upper_advanced_reading | core | 9 | unit_late | identifying_purpose, evaluating_evidence, compare_contrast | fact_vs_opinion, summarization | 2 | drafted |
| g56_claims_and_sources | reading | grades_5_6 | upper_advanced_reading | core | 10 | support_only | fact_vs_opinion, evaluating_evidence, identifying_purpose | compare_contrast, summarization | 2 | drafted |
| g56_article_and_ad | reading | grades_5_6 | upper_advanced_reading | core | 11 | support_only | fact_vs_opinion, compare_contrast, identifying_purpose | evaluating_evidence, summarization | 2 | drafted |
| g56_data_vs_claims | reading | grades_5_6 | upper_advanced_reading | core | 12 | support_only | evaluating_evidence, fact_vs_opinion, compare_contrast | identifying_purpose, summarization | 2 | drafted |
| g56_source_strength | reading | grades_5_6 | upper_advanced_reading | core | 13 | support_only | evaluating_evidence, identifying_purpose, compare_contrast | fact_vs_opinion, summarization | 2 | drafted |
| g56_limits_of_a_claim | reading | grades_5_6 | upper_advanced_reading | core | 14 | support_only | evaluating_evidence, fact_vs_opinion, argument_analysis | compare_contrast, summarization | 2 | drafted |
| g56_biased_message | reading | grades_5_6 | upper_advanced_reading | core | 15 | support_only | argument_analysis, fact_vs_opinion, identifying_purpose | evaluating_evidence, compare_contrast | 2 | drafted |
| g56_claim_and_counterpoint | reading | grades_5_6 | upper_advanced_reading | core | 16 | support_only | argument_analysis, compare_contrast, evaluating_evidence | fact_vs_opinion, identifying_purpose | 2 | drafted |
| g56_missing_evidence | reading | grades_5_6 | upper_advanced_reading | core | 17 | support_only | evaluating_evidence, argument_analysis, identifying_purpose | fact_vs_opinion, compare_contrast | 2 | drafted |
| g56_reliable_or_not | reading | grades_5_6 | upper_advanced_reading | core | 18 | support_only | evaluating_evidence, argument_analysis, compare_contrast | identifying_purpose, fact_vs_opinion | 2 | drafted |
| g56_fair_or_one_sided | reading | grades_5_6 | upper_advanced_reading | core | 19 | support_only | argument_analysis, compare_contrast, bias_detection | identifying_purpose, evaluating_evidence | 2 | drafted |
| g56_loaded_language | reading | grades_5_6 | upper_advanced_reading | core | 20 | support_only | bias_detection, argument_analysis, identifying_purpose | compare_contrast, fact_vs_opinion | 2 | drafted |

## Grade 2 — Math

| pack_code | domain | grade_band | curriculum_unit_code | pack_role | seq | unlock_stage | primary_skills | secondary_skills | est_sessions | status |
|---|---|---|---|---|---:|---|---|---|---:|---|
| g2_math_number_friends | math | grade_2 | math_number_foundations | core | 1 | unit_entry | number_sense, addition_subtraction, patterns_sequences | word_problems, place_value | 2 | drafted |
| g2_math_place_value_blocks | math | grade_2 | math_number_foundations | core | 2 | unit_core | place_value, number_sense, addition_subtraction | word_problems, patterns_sequences | 2 | drafted |

## Grades 3–4 — Math

| pack_code | domain | grade_band | curriculum_unit_code | pack_role | seq | unlock_stage | primary_skills | secondary_skills | est_sessions | status |
|---|---|---|---|---|---:|---|---|---|---:|---|
| g34_math_equal_groups | math | grades_3_4 | math_multiplication_division_foundations | core | 1 | unit_entry | multiplication_division, word_problems, patterns_sequences | data_interpretation, place_value | 2 | drafted |
| g34_math_share_and_divide | math | grades_3_4 | math_multiplication_division_foundations | core | 2 | unit_core | multiplication_division, word_problems, number_sense | patterns_sequences, data_interpretation | 2 | drafted |

## Grades 5–6 — Math

| pack_code | domain | grade_band | curriculum_unit_code | pack_role | seq | unlock_stage | primary_skills | secondary_skills | est_sessions | status |
|---|---|---|---|---|---:|---|---|---|---:|---|
| g56_math_part_whole_and_data | math | grades_5_6 | math_data_statistics_and_interpretation | core | 1 | unit_entry | fractions, data_interpretation, percentages | word_problems, decimals | 2 | drafted |
| g56_math_decimal_money | math | grades_5_6 | math_decimals_percentages_and_ratios | core | 2 | unit_entry | decimals, word_problems, percentages | data_interpretation, number_sense | 2 | drafted |

---

# 4. Curriculum Placement Map

This section shows where the packs belong in the live curriculum by grade band and domain.

## Grade 2 — Reading Placement

### Domain
`reading`

### Unit
`early_reading_basics`

### Core progression
1. g2_bus_stop_morning
2. g2_rainy_day_plans
3. g2_helping_a_friend
4. g2_school_garden
5. g2_class_pet
6. g2_garden_helpers
7. g2_animal_homes
8. g2_day_and_night
9. g2_market_morning
10. g2_rain_after_school

### Support / skill-gap packs
11. g2_classroom_rules_day
12. g2_listen_and_sort
13. g2_find_the_rule
14. g2_same_and_different
15. g2_follow_the_clues
16. g2_sort_the_signs
17. g2_which_one_belongs
18. g2_rule_or_not
19. g2_find_the_match
20. g2_same_group
21. g2_match_the_rule

### Suggested checkpoints
- checkpoint A after pack 3
- checkpoint B after pack 7
- checkpoint C after pack 10

## Grade 2 — Math Placement

### Domain
`math`

### Unit
`math_number_foundations`

### Core progression
1. g2_math_number_friends
2. g2_math_place_value_blocks

### Immediate next expected packs
3. g2_math_measure_and_compare
4. g2_math_patterns_and_groups_intro
5. g2_math_story_problem_basics_intro

---

## Grades 3–4 — Reading Placement

### Domain
`reading`

### Unit
`middle_reading_interpretation`

### Core progression
1. g34_lost_backpack
2. g34_recycling_day
3. g34_maps_and_neighborhoods
4. g34_bee_helper
5. g34_river_trip
6. g34_growing_plants
7. g34_weather_watchers
8. g34_inventors_notebook
9. g34_park_cleanup

### Support / skill-gap packs
10. g34_tool_trouble
11. g34_clue_letters
12. g34_two_solutions
13. g34_missing_steps
14. g34_best_evidence
15. g34_clue_or_not
16. g34_fact_or_clue
17. g34_strongest_clue
18. g34_what_proves_it
19. g34_which_detail_matters
20. g34_which_sentence_helps

### Suggested checkpoints
- checkpoint A after pack 3
- checkpoint B after pack 7
- checkpoint C after pack 9

## Grades 3–4 — Math Placement

### Domain
`math`

### Unit
`math_multiplication_division_foundations`

### Core progression
1. g34_math_equal_groups
2. g34_math_share_and_divide

### Immediate next expected packs
3. g34_math_fraction_parts
4. g34_math_patterns_measurement_and_data_intro
5. g34_math_word_problem_groups_review

---

## Grades 5–6 — Reading Placement

### Domain
`reading`

### Unit
`upper_advanced_reading`

### Core progression
1. g56_weather_warning
2. g56_weather_warning_followup
3. g56_school_news_article
4. g56_local_news_comparison
5. g56_plastic_in_the_ocean
6. g56_school_energy_project
7. g56_water_use_report
8. g56_ancient_city_discovery
9. g56_science_fair_article

### Support / skill-gap packs
10. g56_claims_and_sources
11. g56_article_and_ad
12. g56_data_vs_claims
13. g56_source_strength
14. g56_limits_of_a_claim
15. g56_biased_message
16. g56_claim_and_counterpoint
17. g56_missing_evidence
18. g56_reliable_or_not
19. g56_fair_or_one_sided
20. g56_loaded_language

### Suggested checkpoints
- checkpoint A after pack 4
- checkpoint B after pack 7
- checkpoint C after pack 9

## Grades 5–6 — Math Placement

### Domain
`math`

### Unit progression
1. `math_data_statistics_and_interpretation`
   - g56_math_part_whole_and_data
2. `math_decimals_percentages_and_ratios`
   - g56_math_decimal_money

### Immediate next expected packs
3. g56_math_ratio_tables
4. g56_math_fraction_compare_and_operate
5. g56_math_pre_algebra_intro

---

# 5. Session Blueprint Guidance

Each pack should turn into **1–2 student sessions** depending on activity count and difficulty.

## Suggested default
- 4 activities per pack
- 2 sessions per pack
- 2 graded activities per session
- optional short review session generated adaptively

## Example
### Session 1
- anchor activity
- first skill check

### Session 2
- second skill check
- applied / transfer activity

### Adaptive review
- only if mastery or recent accuracy falls below threshold

---

# 6. What to do next operationally

## Immediately useful next steps
1. move all packs into a spreadsheet or DB seed registry using the metadata columns above
2. add `recommended_sequence_order` and `unlock_stage` to working content records
3. mark each pack as `drafted`, `reviewed`, `seed_ready`, or `seeded`
4. connect each pack to a session blueprint
5. continue authoring future packs directly into this structure instead of standalone wave lists

## Suggested future registry columns
- `pack_code`
- `title`
- `domain`
- `grade_band`
- `curriculum_unit_code`
- `pack_role`
- `recommended_sequence_order`
- `unlock_stage`
- `primary_skills`
- `secondary_skills`
- `estimated_session_count`
- `activity_count`
- `status`
- `notes`

---

# 7. Final summary

The authored content is now organized as:
- a **master pack registry**
- a **curriculum placement map**
- clear separation between:
  - core progression packs
  - support / gap-fill packs
  - reading vs math
  - grade-band placement

This is the structure that makes the pack library actually usable in product, curriculum, and backend systems.

