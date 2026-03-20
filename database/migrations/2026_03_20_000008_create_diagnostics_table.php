<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diagnostics', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('student_id')->index();
            $table->enum('status', ['pending', 'completed'])->default('pending');
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')->cascadeOnDelete();
        });

        Schema::create('diagnostic_activities', function (Blueprint $table) {
            $table->uuid('diagnostic_id')->index();
            $table->uuid('activity_id')->index();
            $table->unsignedTinyInteger('order_index')->default(0);

            $table->primary(['diagnostic_id', 'activity_id']);
            $table->foreign('diagnostic_id')->references('id')->on('diagnostics')->cascadeOnDelete();
            $table->foreign('activity_id')->references('id')->on('activities')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diagnostic_activities');
        Schema::dropIfExists('diagnostics');
    }
};
