<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grade_bands', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code', 20)->unique();        // early | middle | upper
            $table->string('label_es', 60);
            $table->string('label_en', 60);
            $table->tinyInteger('min_grade');
            $table->tinyInteger('max_grade');
            $table->unsignedTinyInteger('sort_order');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grade_bands');
    }
};
