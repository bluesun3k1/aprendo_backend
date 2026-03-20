<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skill_domains', function (Blueprint $table) {
            $table->string('id')->primary(); // reading, attention, reasoning
            $table->string('label_es');
            $table->string('label_en');
            $table->timestamps();
        });

        Schema::create('skills', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('domain_id', 50)->index();
            $table->string('name', 100);
            $table->string('label_es', 191);
            $table->string('label_en', 191);
            $table->timestamps();

            $table->unique(['domain_id', 'name']);
            $table->foreign('domain_id')->references('id')->on('skill_domains')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skills');
        Schema::dropIfExists('skill_domains');
    }
};
