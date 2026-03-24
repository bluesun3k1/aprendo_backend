<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('curriculum_tracks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('grade_band_id');
            $table->string('code', 40)->unique();        // e.g. early_v1, middle_v1
            $table->string('label_es', 100);
            $table->string('label_en', 100);
            $table->string('version', 10)->default('v1');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('grade_band_id')
                  ->references('id')->on('grade_bands')
                  ->onDelete('cascade');
        });

        Schema::create('curriculum_units', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('curriculum_track_id');
            $table->string('code', 60);
            $table->string('title_es', 120);
            $table->string('title_en', 120);
            $table->text('description_es')->nullable();
            $table->text('description_en')->nullable();
            $table->unsignedTinyInteger('sort_order');
            $table->unsignedTinyInteger('estimated_sessions')->default(4);
            $table->unsignedTinyInteger('mastery_threshold')->default(65); // avg mastery % to unlock next unit
            $table->timestamps();

            $table->foreign('curriculum_track_id')
                  ->references('id')->on('curriculum_tracks')
                  ->onDelete('cascade');
        });

        Schema::create('curriculum_unit_skills', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('curriculum_unit_id');
            $table->uuid('skill_id');
            $table->unsignedTinyInteger('priority_weight')->default(2);   // 1 low – 3 high
            $table->unsignedTinyInteger('target_mastery_min')->default(50);
            $table->unsignedTinyInteger('target_mastery_goal')->default(75);
            $table->timestamps();

            $table->unique(['curriculum_unit_id', 'skill_id']);
            $table->foreign('curriculum_unit_id')
                  ->references('id')->on('curriculum_units')
                  ->onDelete('cascade');
            $table->foreign('skill_id')
                  ->references('id')->on('skills')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('curriculum_unit_skills');
        Schema::dropIfExists('curriculum_units');
        Schema::dropIfExists('curriculum_tracks');
    }
};
