<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE activities MODIFY COLUMN type ENUM(
            'multiple_choice',
            'drag_to_sort',
            'tap_sequence',
            'illustrated_clue',
            'storybook_reading',
            'story_strip_sequencing'
        ) NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE activities MODIFY COLUMN type ENUM(
            'multiple_choice',
            'drag_to_sort',
            'tap_sequence',
            'illustrated_clue'
        ) NOT NULL");
    }
};
