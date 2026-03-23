<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_curriculum_tracks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('student_id');
            $table->uuid('curriculum_track_id');
            $table->enum('status', ['active', 'completed', 'paused'])->default('active');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->unique(['student_id', 'curriculum_track_id']);
            $table->foreign('student_id')
                  ->references('id')->on('students')
                  ->onDelete('cascade');
            $table->foreign('curriculum_track_id')
                  ->references('id')->on('curriculum_tracks')
                  ->onDelete('cascade');
        });

        Schema::create('student_unit_progress', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('student_id');
            $table->uuid('curriculum_unit_id');
            $table->enum('status', ['locked', 'active', 'completed', 'paused'])->default('locked');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->json('mastery_snapshot')->nullable(); // {skill_id: score} at time of completion
            $table->timestamps();

            $table->unique(['student_id', 'curriculum_unit_id']);
            $table->foreign('student_id')
                  ->references('id')->on('students')
                  ->onDelete('cascade');
            $table->foreign('curriculum_unit_id')
                  ->references('id')->on('curriculum_units')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_unit_progress');
        Schema::dropIfExists('student_curriculum_tracks');
    }
};
