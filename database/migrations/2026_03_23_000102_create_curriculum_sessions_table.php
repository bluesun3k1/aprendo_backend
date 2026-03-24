<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('curriculum_sessions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('curriculum_unit_id');
            $table->string('code', 60);
            $table->string('title_es', 120);
            $table->string('title_en', 120);
            $table->enum('session_type', ['core', 'review', 'bonus', 'diagnostic_check'])->default('core');
            $table->unsignedTinyInteger('sort_order');
            $table->unsignedTinyInteger('estimated_minutes')->default(15);
            $table->timestamps();

            $table->foreign('curriculum_unit_id')
                  ->references('id')->on('curriculum_units')
                  ->onDelete('cascade');
        });

        Schema::create('curriculum_session_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('curriculum_session_id');
            $table->uuid('skill_id');
            $table->string('activity_type', 40)->nullable();     // null = any type
            $table->unsignedTinyInteger('difficulty_min')->default(1);
            $table->unsignedTinyInteger('difficulty_max')->default(3);
            $table->unsignedTinyInteger('item_count')->default(2);
            $table->string('selection_rule', 40)->default('adaptive'); // adaptive | fixed | spaced_review
            $table->unsignedTinyInteger('sort_order');
            $table->timestamps();

            $table->foreign('curriculum_session_id')
                  ->references('id')->on('curriculum_sessions')
                  ->onDelete('cascade');
            $table->foreign('skill_id')
                  ->references('id')->on('skills')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('curriculum_session_items');
        Schema::dropIfExists('curriculum_sessions');
    }
};
