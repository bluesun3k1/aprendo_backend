<?php

namespace Database\Seeders;

use App\Models\Badge;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BadgeSeeder extends Seeder
{
    public function run(): void
    {
        $badges = [
            // ---------------------------------------------------------------
            // Onboarding
            // ---------------------------------------------------------------
            [
                'name'              => 'Primer paso',
                'description_es'    => 'Completaste tu primera sesión',
                'description_en'    => 'You completed your first session',
                'icon_url'          => null,
                'trigger_type'      => 'first_session',
                'category'          => 'onboarding',
                'threshold_value'   => 1,
                'sort_order'        => 1,
                'celebration_level' => 'small',
                'is_hidden'         => false,
            ],

            // ---------------------------------------------------------------
            // Streaks
            // ---------------------------------------------------------------
            [
                'name'              => 'Primera racha',
                'description_es'    => 'Completaste 3 días seguidos',
                'description_en'    => 'You completed 3 days in a row',
                'icon_url'          => null,
                'trigger_type'      => 'streak_3',
                'category'          => 'streak',
                'threshold_value'   => 3,
                'sort_order'        => 10,
                'celebration_level' => 'small',
                'is_hidden'         => false,
            ],
            [
                'name'              => 'Constancia',
                'description_es'    => 'Completaste 5 días seguidos',
                'description_en'    => 'You completed 5 days in a row',
                'icon_url'          => null,
                'trigger_type'      => 'streak_5',
                'category'          => 'streak',
                'threshold_value'   => 5,
                'sort_order'        => 11,
                'celebration_level' => 'medium',
                'is_hidden'         => false,
            ],
            [
                'name'              => 'Imparable',
                'description_es'    => 'Completaste 10 días seguidos',
                'description_en'    => 'You completed 10 days in a row',
                'icon_url'          => null,
                'trigger_type'      => 'streak_10',
                'category'          => 'streak',
                'threshold_value'   => 10,
                'sort_order'        => 12,
                'celebration_level' => 'big',
                'is_hidden'         => false,
            ],
            [
                'name'              => 'Racha legendaria',
                'description_es'    => 'Completaste 20 días seguidos',
                'description_en'    => 'You completed 20 days in a row',
                'icon_url'          => null,
                'trigger_type'      => 'streak_20',
                'category'          => 'streak',
                'threshold_value'   => 20,
                'sort_order'        => 13,
                'celebration_level' => 'big',
                'is_hidden'         => false,
            ],

            // ---------------------------------------------------------------
            // Sessions
            // ---------------------------------------------------------------
            [
                'name'              => 'Sesiones en marcha',
                'description_es'    => 'Completaste 5 sesiones',
                'description_en'    => 'You completed 5 sessions',
                'icon_url'          => null,
                'trigger_type'      => 'sessions_5',
                'category'          => 'sessions',
                'threshold_value'   => 5,
                'sort_order'        => 20,
                'celebration_level' => 'small',
                'is_hidden'         => false,
            ],
            [
                'name'              => 'Buen ritmo',
                'description_es'    => 'Completaste 10 sesiones',
                'description_en'    => 'You completed 10 sessions',
                'icon_url'          => null,
                'trigger_type'      => 'sessions_10',
                'category'          => 'sessions',
                'threshold_value'   => 10,
                'sort_order'        => 21,
                'celebration_level' => 'medium',
                'is_hidden'         => false,
            ],
            [
                'name'              => 'Sigue creciendo',
                'description_es'    => 'Completaste 25 sesiones',
                'description_en'    => 'You completed 25 sessions',
                'icon_url'          => null,
                'trigger_type'      => 'sessions_25',
                'category'          => 'sessions',
                'threshold_value'   => 25,
                'sort_order'        => 22,
                'celebration_level' => 'medium',
                'is_hidden'         => false,
            ],
            [
                'name'              => 'Entrenamiento sólido',
                'description_es'    => 'Completaste 50 sesiones',
                'description_en'    => 'You completed 50 sessions',
                'icon_url'          => null,
                'trigger_type'      => 'sessions_50',
                'category'          => 'sessions',
                'threshold_value'   => 50,
                'sort_order'        => 23,
                'celebration_level' => 'big',
                'is_hidden'         => false,
            ],

            // ---------------------------------------------------------------
            // Points / XP
            // ---------------------------------------------------------------
            [
                'name'              => 'Primeros puntos',
                'description_es'    => 'Acumulaste 100 puntos',
                'description_en'    => 'You accumulated 100 points',
                'icon_url'          => null,
                'trigger_type'      => 'points_100',
                'category'          => 'points',
                'threshold_value'   => 100,
                'sort_order'        => 30,
                'celebration_level' => 'small',
                'is_hidden'         => false,
            ],
            [
                'name'              => 'Puntos en ascenso',
                'description_es'    => 'Acumulaste 250 puntos',
                'description_en'    => 'You accumulated 250 points',
                'icon_url'          => null,
                'trigger_type'      => 'points_250',
                'category'          => 'points',
                'threshold_value'   => 250,
                'sort_order'        => 31,
                'celebration_level' => 'medium',
                'is_hidden'         => false,
            ],
            [
                'name'              => 'Coleccionista',
                'description_es'    => 'Acumulaste 500 puntos',
                'description_en'    => 'You accumulated 500 points',
                'icon_url'          => null,
                'trigger_type'      => 'points_500',
                'category'          => 'points',
                'threshold_value'   => 500,
                'sort_order'        => 32,
                'celebration_level' => 'big',
                'is_hidden'         => false,
            ],
        ];

        foreach ($badges as $badge) {
            Badge::updateOrCreate(
                ['trigger_type' => $badge['trigger_type']],
                array_merge($badge, [
                    'id' => Badge::where('trigger_type', $badge['trigger_type'])->value('id') ?? Str::uuid()->toString(),
                ])
            );
        }
    }
}