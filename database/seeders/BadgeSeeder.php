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
            [
                'name'            => 'Explorador',
                'description_es'  => 'Completaste tu primera sesión',
                'description_en'  => 'You completed your first session',
                'icon_url'        => null,
                'trigger_type'    => 'first_session',
            ],
            [
                'name'            => 'Primera racha',
                'description_es'  => 'Completaste 3 días seguidos',
                'description_en'  => 'You completed 3 days in a row',
                'icon_url'        => null,
                'trigger_type'    => 'streak_3',
            ],
            [
                'name'            => 'Constancia',
                'description_es'  => 'Completaste 5 días seguidos',
                'description_en'  => 'You completed 5 days in a row',
                'icon_url'        => null,
                'trigger_type'    => 'streak_5',
            ],
            [
                'name'            => 'Imparable',
                'description_es'  => 'Completaste 10 días seguidos',
                'description_en'  => 'You completed 10 days in a row',
                'icon_url'        => null,
                'trigger_type'    => 'streak_10',
            ],
            [
                'name'            => 'Lector veloz',
                'description_es'  => 'Completaste 5 sesiones',
                'description_en'  => 'You completed 5 sessions',
                'icon_url'        => null,
                'trigger_type'    => 'sessions_5',
            ],
            [
                'name'            => 'Maestro',
                'description_es'  => 'Completaste 10 sesiones',
                'description_en'  => 'You completed 10 sessions',
                'icon_url'        => null,
                'trigger_type'    => 'sessions_10',
            ],
            [
                'name'            => 'Coleccionista',
                'description_es'  => 'Acumulaste 100 puntos',
                'description_en'  => 'You accumulated 100 points',
                'icon_url'        => null,
                'trigger_type'    => 'points_100',
            ],
        ];

        foreach ($badges as $badge) {
            Badge::firstOrCreate(
                ['trigger_type' => $badge['trigger_type']],
                array_merge($badge, ['id' => Str::uuid()])
            );
        }
    }
}
