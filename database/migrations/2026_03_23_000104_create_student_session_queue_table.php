<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_session_queue', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('student_id');
            $table->uuid('curriculum_session_id')->nullable(); // null for adaptive bonus/remediation
            $table->uuid('generated_session_id')->nullable();  // populated once session is built
            $table->enum('session_kind', ['core', 'bonus', 'review', 'remediation'])->default('core');
            $table->unsignedSmallInteger('queue_order')->default(0);
            $table->enum('status', ['queued', 'active', 'completed', 'expired'])->default('queued');
            $table->timestamp('available_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->foreign('student_id')
                  ->references('id')->on('students')
                  ->onDelete('cascade');
            $table->foreign('curriculum_session_id')
                  ->references('id')->on('curriculum_sessions')
                  ->onDelete('set null');
            $table->foreign('generated_session_id')
                  ->references('id')->on('student_sessions')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_session_queue');
    }
};
