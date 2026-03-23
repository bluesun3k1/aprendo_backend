<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SchoolSeeder::class,
            DomainSkillSeeder::class,
            ActivitySeeder::class,
            BadgeSeeder::class,
            MissionSeeder::class,
            UserSeeder::class,
            SessionSeeder::class,
            SkillCmsSeeder::class,
            CurriculumTrackSeeder::class,
        ]);
    }
}
