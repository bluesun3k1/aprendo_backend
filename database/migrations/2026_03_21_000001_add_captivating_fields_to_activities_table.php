<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Extend the type enum to include illustrated_clue
        DB::statement("ALTER TABLE activities MODIFY COLUMN type ENUM('multiple_choice', 'drag_to_sort', 'tap_sequence', 'illustrated_clue') NOT NULL");

        Schema::table('activities', function (Blueprint $table) {
            $table->string('lesson_mood', 20)->nullable()->after('type');
            $table->string('mission_title', 60)->nullable()->after('lesson_mood');
            $table->string('mission_description', 140)->nullable()->after('mission_title');
        });
    }

    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn(['lesson_mood', 'mission_title', 'mission_description']);
        });

        DB::statement("ALTER TABLE activities MODIFY COLUMN type ENUM('multiple_choice', 'drag_to_sort', 'tap_sequence') NOT NULL");
    }
};
