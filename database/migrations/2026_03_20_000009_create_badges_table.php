<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('badges', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('description_es');
            $table->string('description_en');
            $table->string('icon_url')->nullable();
            $table->string('trigger_type'); // first_session, streak_3, streak_5, reading_10, etc.
            $table->json('trigger_config')->nullable(); // extra config for complex triggers
            $table->timestamps();
        });

        Schema::create('student_badges', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('student_id')->index();
            $table->uuid('badge_id')->index();
            $table->timestamp('earned_at');
            $table->timestamps();

            $table->unique(['student_id', 'badge_id']);
            $table->foreign('student_id')->references('id')->on('students')->cascadeOnDelete();
            $table->foreign('badge_id')->references('id')->on('badges')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_badges');
        Schema::dropIfExists('badges');
    }
};
