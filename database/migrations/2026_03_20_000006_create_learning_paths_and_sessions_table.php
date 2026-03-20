<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('learning_paths', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('student_id')->unique();
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')->cascadeOnDelete();
        });

        Schema::create('student_sessions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('student_id')->index();
            $table->uuid('learning_path_id')->nullable()->index();
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
            $table->unsignedTinyInteger('estimated_duration_minutes')->default(12);
            $table->json('domains')->nullable(); // cached list of domains for this session
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')->cascadeOnDelete();
            $table->foreign('learning_path_id')->references('id')->on('learning_paths')->nullOnDelete();
        });

        Schema::create('session_activities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('session_id')->index();
            $table->uuid('activity_id')->index();
            $table->unsignedTinyInteger('order_index')->default(0);
            $table->timestamps();

            $table->foreign('session_id')->references('id')->on('student_sessions')->cascadeOnDelete();
            $table->foreign('activity_id')->references('id')->on('activities')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('session_activities');
        Schema::dropIfExists('student_sessions');
        Schema::dropIfExists('learning_paths');
    }
};
