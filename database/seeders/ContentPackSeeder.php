<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Orchestrator — runs all 6 band/domain content pack seeders in order.
 *
 * Run with:
 *   php artisan db:seed --class=ContentPackSeeder
 */
class ContentPackSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ContentPackSeeder_G2Reading::class,
            ContentPackSeeder_G34Reading::class,
            ContentPackSeeder_G56Reading::class,
            ContentPackSeeder_G2Math::class,
            ContentPackSeeder_G34Math::class,
            ContentPackSeeder_G56Math::class,
        ]);
    }
}
