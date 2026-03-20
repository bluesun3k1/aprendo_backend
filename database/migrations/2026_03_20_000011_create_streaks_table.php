<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('streaks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('student_id')->unique();
            $table->unsignedSmallInteger('current_streak')->default(0);
            $table->unsignedSmallInteger('best_streak')->default(0);
            $table->date('last_activity_date')->nullable();
            $table->json('history')->nullable(); // array of dates for last N days
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('streaks');
    }
};
