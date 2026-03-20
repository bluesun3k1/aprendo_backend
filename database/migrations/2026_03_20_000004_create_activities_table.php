<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('skill_id')->index();
            $table->enum('type', ['multiple_choice', 'drag_to_sort', 'tap_sequence']);
            $table->unsignedTinyInteger('difficulty'); // 1=easy, 2=medium, 3=hard
            $table->text('instructions_es');
            $table->text('instructions_en');
            $table->unsignedSmallInteger('duration_seconds')->nullable();
            $table->json('content');          // public-facing content (no correct answer)
            $table->json('correct_answer');   // server-side only evaluation data
            $table->boolean('is_diagnostic')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('skill_id')->references('id')->on('skills')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
