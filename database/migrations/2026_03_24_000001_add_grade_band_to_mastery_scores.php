<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mastery_scores', function (Blueprint $table) {
            // Drop the existing unique so we can widen it to include grade_band
            $table->dropUnique(['student_id', 'skill_id']);

            // One mastery row per student × skill × band — scores never bleed across bands
            $table->string('grade_band', 20)->default('middle')->after('skill_id');
        });

        // Back-fill existing rows: use the student's current placement_band
        DB::statement("
            UPDATE mastery_scores ms
            JOIN   students s ON s.id = ms.student_id
            SET    ms.grade_band = COALESCE(s.placement_band, 'middle')
        ");

        Schema::table('mastery_scores', function (Blueprint $table) {
            $table->unique(['student_id', 'skill_id', 'grade_band']);
        });
    }

    public function down(): void
    {
        Schema::table('mastery_scores', function (Blueprint $table) {
            $table->dropUnique(['student_id', 'skill_id', 'grade_band']);
            $table->dropColumn('grade_band');
            $table->unique(['student_id', 'skill_id']);
        });
    }
};
