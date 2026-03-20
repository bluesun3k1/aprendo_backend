<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    public function run(): void
    {
        School::firstOrCreate(
            ['school_code' => 'SCH-001'],
            ['id' => \Illuminate\Support\Str::uuid(), 'name' => 'Colegio San Martín', 'is_active' => true]
        );

        School::firstOrCreate(
            ['school_code' => 'SCH-002'],
            ['id' => \Illuminate\Support\Str::uuid(), 'name' => 'Colegio Simón Bolívar', 'is_active' => true]
        );
    }
}
