<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attempts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('student_id')->index();
            $table->uuid('session_id')->nullable()->index();
            $table->uuid('activity_id')->index();
            $table->json('response');
            $table->boolean('correct')->nullable();
            $table->tinyInteger('score_delta')->default(0);
            $table->string('feedback_text')->nullable();
            $table->unsignedInteger('response_time_ms')->nullable();
            $table->unsignedTinyInteger('hints_used')->default(0);
            $table->boolean('completed')->default(true);
            $table->timestamp('client_timestamp')->nullable();
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')->cascadeOnDelete();
            $table->foreign('session_id')->references('id')->on('student_sessions')->nullOnDelete();
            $table->foreign('activity_id')->references('id')->on('activities')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attempts');
    }
};
