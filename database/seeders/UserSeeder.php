<?php

namespace Database\Seeders;

use App\Models\School;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $school = School::where('school_code', 'SCH-001')->first();

        if (!$school) return;

        // ---------------------------------------------------------------
        // Teacher
        // ---------------------------------------------------------------
        User::firstOrCreate(
            ['email' => 'teacher@school.com'],
            [
                'id'        => Str::uuid(),
                'name'      => 'Prof. Ana García',
                'email'     => 'teacher@school.com',
                'password'  => Hash::make('password'),
                'role'      => 'teacher',
                'school_id' => $school->id,
                'is_active' => true,
            ]
        );

        // Platform admin
        User::firstOrCreate(
            ['email' => 'admin@aprendo.com'],
            [
                'id'        => Str::uuid(),
                'name'      => 'Platform Admin',
                'email'     => 'admin@aprendo.com',
                'password'  => Hash::make('admin1234'),
                'role'      => 'platform_admin',
                'school_id' => null,
                'is_active' => true,
            ]
        );

        // ---------------------------------------------------------------
        // Students
        // ---------------------------------------------------------------
        Student::firstOrCreate(
            ['school_id' => $school->id, 'username' => 'maria.lopez'],
            [
                'id'                   => Str::uuid(),
                'school_id'            => $school->id,
                'display_name'         => 'María López',
                'username'             => 'maria.lopez',
                'pin'                  => Hash::make('1234'),
                'grade'                => '5',
                'age'                  => 10,
                'is_active'            => true,
                'diagnostic_completed' => false,
                'points_total'         => 0,
            ]
        );

        Student::firstOrCreate(
            ['school_id' => $school->id, 'username' => 'carlos.ramirez'],
            [
                'id'                   => Str::uuid(),
                'school_id'            => $school->id,
                'display_name'         => 'Carlos Ramírez',
                'username'             => 'carlos.ramirez',
                'pin'                  => Hash::make('5678'),
                'grade'                => '4',
                'age'                  => 9,
                'is_active'            => true,
                'diagnostic_completed' => false,
                'points_total'         => 0,
            ]
        );

        Student::firstOrCreate(
            ['school_id' => $school->id, 'username' => 'sofia.torres'],
            [
                'id'                   => Str::uuid(),
                'school_id'            => $school->id,
                'display_name'         => 'Sofía Torres',
                'username'             => 'sofia.torres',
                'pin'                  => Hash::make('0000'),
                'grade'                => '6',
                'age'                  => 11,
                'is_active'            => true,
                'diagnostic_completed' => false,
                'points_total'         => 0,
            ]
        );
    }
}
