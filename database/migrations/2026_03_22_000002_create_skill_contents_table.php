<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skill_contents', function (Blueprint $table) {
            $table->id();
            $table->uuid('skill_id')->unique()->index();
            $table->text('description');
            $table->text('why_it_matters');
            $table->text('doing_well_high');   // shown when student accuracy >= 70%
            $table->text('doing_well_low');    // shown when student accuracy < 70%
            $table->text('practice_next_high');
            $table->text('practice_next_low');
            $table->string('insight_tip', 255);
            $table->text('insight_tip_body');
            $table->text('insight_example');
            $table->timestamps();

            $table->foreign('skill_id')->references('id')->on('skills')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skill_contents');
    }
};
