<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('school_id')->index();
            $table->string('display_name');
            $table->string('username');
            $table->string('pin'); // hashed
            $table->string('grade')->nullable();
            $table->unsignedTinyInteger('age')->nullable();
            $table->string('avatar_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('diagnostic_completed')->default(false);
            $table->unsignedInteger('points_total')->default(0);
            $table->timestamps();

            $table->unique(['school_id', 'username']);
            $table->foreign('school_id')->references('id')->on('schools')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
