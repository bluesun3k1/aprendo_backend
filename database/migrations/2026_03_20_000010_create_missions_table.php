<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('weekly_missions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('label_es');
            $table->string('label_en');
            $table->unsignedTinyInteger('target')->default(3);
            $table->string('mission_type')->default('sessions_completed');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('student_missions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('student_id')->index();
            $table->uuid('mission_id')->index();
            $table->date('week_start');
            $table->unsignedTinyInteger('progress')->default(0);
            $table->boolean('completed')->default(false);
            $table->timestamps();

            $table->unique(['student_id', 'mission_id', 'week_start']);
            $table->foreign('student_id')->references('id')->on('students')->cascadeOnDelete();
            $table->foreign('mission_id')->references('id')->on('weekly_missions')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_missions');
        Schema::dropIfExists('weekly_missions');
    }
};
