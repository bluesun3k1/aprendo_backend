<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('progress_snapshots', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('student_id')->index();
            $table->string('domain_id')->nullable()->index();
            $table->uuid('skill_id')->nullable()->index();
            $table->unsignedTinyInteger('mastery_score');
            $table->date('recorded_at');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')->cascadeOnDelete();
            $table->foreign('domain_id')->references('id')->on('skill_domains')->nullOnDelete();
            $table->foreign('skill_id')->references('id')->on('skills')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progress_snapshots');
    }
};
