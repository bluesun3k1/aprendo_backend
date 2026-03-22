<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('domain_milestones', function (Blueprint $table) {
            $table->id();
            $table->string('domain_id', 50)->index();
            $table->tinyInteger('threshold')->unsigned();  // 0-100
            $table->string('name', 100);
            $table->text('description');
            $table->tinyInteger('sort_order')->unsigned()->default(0);
            $table->timestamps();

            $table->unique(['domain_id', 'threshold']);
            $table->foreign('domain_id')->references('id')->on('skill_domains')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('domain_milestones');
    }
};
