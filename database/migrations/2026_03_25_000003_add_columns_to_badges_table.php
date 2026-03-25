<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('badges', function (Blueprint $table) {
            $table->string('category', 40)->nullable()->after('trigger_type');   // onboarding | streak | sessions | points
            $table->unsignedTinyInteger('sort_order')->default(0)->after('category');
            $table->unsignedSmallInteger('threshold_value')->nullable()->after('sort_order');
            $table->string('celebration_level', 20)->nullable()->after('threshold_value'); // small | medium | big
            $table->boolean('is_hidden')->default(false)->after('celebration_level');
        });
    }

    public function down(): void
    {
        Schema::table('badges', function (Blueprint $table) {
            $table->dropColumn(['category', 'sort_order', 'threshold_value', 'celebration_level', 'is_hidden']);
        });
    }
};
