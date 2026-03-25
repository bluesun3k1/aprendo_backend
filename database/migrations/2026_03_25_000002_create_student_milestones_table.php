<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_milestones', function (Blueprint $table) {
            $table->id();
            $table->uuid('student_id')->index();
            $table->unsignedBigInteger('milestone_id');
            $table->timestamp('unlocked_at');
            $table->unsignedTinyInteger('source_domain_score')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();

            $table->unique(['student_id', 'milestone_id']);
            $table->foreign('student_id')->references('id')->on('students')->cascadeOnDelete();
            $table->foreign('milestone_id')->references('id')->on('domain_milestones')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_milestones');
    }
};
