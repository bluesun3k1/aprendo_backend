<?php

namespace Database\Seeders;

use App\Models\WeeklyMission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MissionSeeder extends Seeder
{
    public function run(): void
    {
        $missions = [
            // ---------------------------------------------------------------
            // Sessions — easy
            // ---------------------------------------------------------------
            [
                'label_es'      => 'Completa 3 sesiones esta semana',
                'label_en'      => 'Complete 3 sessions this week',
                'mission_type'  => 'sessions_completed',
                'target'        => 3,
                'category'      => 'sessions',
                'domain_id'     => null,
                'grade_band'    => null,
                'reward_xp'     => 20,
                'difficulty'    => 'easy',
                'sort_order'    => 1,
                'is_repeatable' => true,
                'is_active'     => true,
            ],

            // ---------------------------------------------------------------
            // Sessions — medium
            // ---------------------------------------------------------------
            [
                'label_es'      => 'Completa 5 sesiones esta semana',
                'label_en'      => 'Complete 5 sessions this week',
                'mission_type'  => 'sessions_completed',
                'target'        => 5,
                'category'      => 'sessions',
                'domain_id'     => null,
                'grade_band'    => null,
                'reward_xp'     => 35,
                'difficulty'    => 'medium',
                'sort_order'    => 2,
                'is_repeatable' => true,
                'is_active'     => true,
            ],

            // ---------------------------------------------------------------
            // Sessions — hard
            // ---------------------------------------------------------------
            [
                'label_es'      => 'Completa 7 sesiones esta semana',
                'label_en'      => 'Complete 7 sessions this week',
                'mission_type'  => 'sessions_completed',
                'target'        => 7,
                'category'      => 'sessions',
                'domain_id'     => null,
                'grade_band'    => null,
                'reward_xp'     => 55,
                'difficulty'    => 'hard',
                'sort_order'    => 3,
                'is_repeatable' => true,
                'is_active'     => true,
            ],

            // ---------------------------------------------------------------
            // Accuracy — easy
            // ---------------------------------------------------------------
            [
                'label_es'      => 'Responde correctamente 10 actividades esta semana',
                'label_en'      => 'Answer 10 activities correctly this week',
                'mission_type'  => 'correct_answers',
                'target'        => 10,
                'category'      => 'accuracy',
                'domain_id'     => null,
                'grade_band'    => null,
                'reward_xp'     => 20,
                'difficulty'    => 'easy',
                'sort_order'    => 10,
                'is_repeatable' => true,
                'is_active'     => true,
            ],

            // ---------------------------------------------------------------
            // Accuracy — hard (near-perfect sessions)
            // ---------------------------------------------------------------
            [
                'label_es'      => 'Completa 3 sesiones con muy pocos errores',
                'label_en'      => 'Complete 3 sessions with very few mistakes',
                'mission_type'  => 'near_perfect_sessions',
                'target'        => 3,
                'category'      => 'accuracy',
                'domain_id'     => null,
                'grade_band'    => null,
                'reward_xp'     => 40,
                'difficulty'    => 'hard',
                'sort_order'    => 11,
                'is_repeatable' => true,
                'is_active'     => true,
            ],

            // ---------------------------------------------------------------
            // Domain — reading (medium)
            // ---------------------------------------------------------------
            [
                'label_es'      => 'Completa 2 sesiones de lectura esta semana',
                'label_en'      => 'Complete 2 reading sessions this week',
                'mission_type'  => 'domain_sessions_completed',
                'target'        => 2,
                'category'      => 'domain',
                'domain_id'     => 'reading',
                'grade_band'    => null,
                'reward_xp'     => 25,
                'difficulty'    => 'medium',
                'sort_order'    => 20,
                'is_repeatable' => true,
                'is_active'     => true,
            ],

            // ---------------------------------------------------------------
            // Domain — math (medium)
            // ---------------------------------------------------------------
            [
                'label_es'      => 'Completa 2 sesiones de matemáticas esta semana',
                'label_en'      => 'Complete 2 math sessions this week',
                'mission_type'  => 'domain_sessions_completed',
                'target'        => 2,
                'category'      => 'domain',
                'domain_id'     => 'math',
                'grade_band'    => null,
                'reward_xp'     => 25,
                'difficulty'    => 'medium',
                'sort_order'    => 21,
                'is_repeatable' => true,
                'is_active'     => true,
            ],

            // ---------------------------------------------------------------
            // Streak — medium
            // ---------------------------------------------------------------
            [
                'label_es'      => 'Mantén una racha de 3 días',
                'label_en'      => 'Maintain a 3-day streak',
                'mission_type'  => 'streak_days',
                'target'        => 3,
                'category'      => 'streak',
                'domain_id'     => null,
                'grade_band'    => null,
                'reward_xp'     => 30,
                'difficulty'    => 'medium',
                'sort_order'    => 30,
                'is_repeatable' => true,
                'is_active'     => true,
            ],
        ];

        foreach ($missions as $mission) {
            WeeklyMission::updateOrCreate(
                [
                    'mission_type' => $mission['mission_type'],
                    'target'       => $mission['target'],
                    'domain_id'    => $mission['domain_id'],
                    'grade_band'   => $mission['grade_band'],
                ],
                array_merge($mission, [
                    'id' => WeeklyMission::where([
                        'mission_type' => $mission['mission_type'],
                        'target'       => $mission['target'],
                        'domain_id'    => $mission['domain_id'],
                        'grade_band'   => $mission['grade_band'],
                    ])->value('id') ?? Str::uuid()->toString(),
                ])
            );
        }
    }
}