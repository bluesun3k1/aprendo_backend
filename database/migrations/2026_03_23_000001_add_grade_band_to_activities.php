<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add grade_band to activities — existing rows default to 'middle'
        Schema::table('activities', function (Blueprint $table) {
            $table->enum('grade_band', ['early', 'middle', 'upper'])
                ->default('middle')
                ->after('is_active');
        });

        // Add placement_band to students — null until set at first login
        Schema::table('students', function (Blueprint $table) {
            $table->enum('placement_band', ['early', 'middle', 'upper'])
                ->nullable()
                ->after('age_band');
        });
    }

    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn('grade_band');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('placement_band');
        });
    }
};
