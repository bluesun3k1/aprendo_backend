<?php

namespace Database\Seeders\Traits;

use App\Models\Activity;
use App\Models\Skill;
use Illuminate\Support\Str;

trait InsertsPackActivities
{
    /**
     * Insert all activities from a pack definition array.
     *
     * Each activity entry must have:
     *   domain, skill_name, grade_band, type, difficulty,
     *   instructions_es, lesson_mood, mission_title, mission_description,
     *   content, correct_answer
     *
     * Dedup key: (skill_id, grade_band, mission_title) — mission titles are
     * unique per activity across all packs, so re-running is safe.
     */
    protected function insertPack(array $activities): void
    {
        foreach ($activities as $data) {
            $skill = Skill::whereHas('domain', fn ($q) => $q->where('id', $data['domain']))
                ->where('name', $data['skill_name'])
                ->first();

            if (!$skill) {
                $this->command->warn("Skill not found: {$data['domain']}.{$data['skill_name']}");
                continue;
            }

            $exists = Activity::where('skill_id', $skill->id)
                ->where('grade_band', $data['grade_band'])
                ->where('mission_title', $data['mission_title'])
                ->exists();

            if ($exists) continue;

            Activity::create([
                'id'                  => (string) Str::uuid(),
                'skill_id'            => $skill->id,
                'type'                => $data['type'],
                'difficulty'          => $data['difficulty'],
                'grade_band'          => $data['grade_band'],
                'lesson_mood'         => $data['lesson_mood'] ?? null,
                'mission_title'       => $data['mission_title'] ?? null,
                'mission_description' => $data['mission_description'] ?? null,
                'instructions_es'     => $data['instructions_es'],
                'instructions_en'     => $data['instructions_es'], // EN translations deferred
                'duration_seconds'    => $data['duration_seconds'] ?? null,
                'content'             => $data['content'],
                'correct_answer'      => $data['correct_answer'],
                'is_diagnostic'       => false,
                'is_active'           => true,
            ]);
        }
    }
}
