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
            [
                'label_es'     => 'Completa 3 sesiones esta semana',
                'label_en'     => 'Complete 3 sessions this week',
                'target'       => 3,
                'mission_type' => 'sessions_completed',
                'is_active'    => true,
            ],
            [
                'label_es'     => 'Completa 5 sesiones esta semana',
                'label_en'     => 'Complete 5 sessions this week',
                'target'       => 5,
                'mission_type' => 'sessions_completed',
                'is_active'    => false,
            ],
        ];

        foreach ($missions as $mission) {
            WeeklyMission::firstOrCreate(
                ['label_es' => $mission['label_es']],
                array_merge($mission, ['id' => Str::uuid()])
            );
        }
    }
}
