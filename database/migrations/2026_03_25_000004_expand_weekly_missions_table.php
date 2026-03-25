<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('weekly_missions', function (Blueprint $table) {
            // Grouping / discovery
            $table->string('category', 40)->nullable()->after('mission_type');      // sessions | accuracy | domain | streak
            $table->string('domain_id', 50)->nullable()->after('category');         // null = any domain; 'reading', 'math', etc.
            $table->string('grade_band', 20)->nullable()->after('domain_id');       // null = all bands; early | middle | upper
            // Reward
            $table->unsignedSmallInteger('reward_xp')->default(0)->after('grade_band');
            // UX metadata
            $table->string('difficulty', 20)->nullable()->after('reward_xp');       // easy | medium | hard
            $table->unsignedTinyInteger('sort_order')->default(0)->after('difficulty');
            $table->boolean('is_repeatable')->default(true)->after('sort_order');   // reset each week

            $table->foreign('domain_id')->references('id')->on('skill_domains')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('weekly_missions', function (Blueprint $table) {
            $table->dropForeign(['domain_id']);
            $table->dropColumn([
                'category', 'domain_id', 'grade_band', 'reward_xp',
                'difficulty', 'sort_order', 'is_repeatable',
            ]);
        });
    }
};
