<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('domain_milestones', function (Blueprint $table) {
            $table->string('icon', 50)->nullable()->after('sort_order');
            $table->unsignedTinyInteger('reward_xp')->default(0)->after('icon');
            $table->string('celebration_level', 20)->nullable()->after('reward_xp');
            $table->boolean('is_hidden')->default(false)->after('celebration_level');
        });
    }

    public function down(): void
    {
        Schema::table('domain_milestones', function (Blueprint $table) {
            $table->dropColumn(['icon', 'reward_xp', 'celebration_level', 'is_hidden']);
        });
    }
};
