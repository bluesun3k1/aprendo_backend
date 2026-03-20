<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mastery_scores', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('student_id')->index();
            $table->uuid('skill_id')->index();
            $table->unsignedTinyInteger('score')->default(0); // 0–100
            $table->enum('trend', ['up', 'stable', 'down'])->default('stable');
            $table->timestamp('last_practiced_at')->nullable();
            $table->timestamps();

            $table->unique(['student_id', 'skill_id']);
            $table->foreign('student_id')->references('id')->on('students')->cascadeOnDelete();
            $table->foreign('skill_id')->references('id')->on('skills')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mastery_scores');
    }
};
