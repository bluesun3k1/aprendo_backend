<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_sessions', function (Blueprint $table) {
            $table->enum('session_type', ['core', 'bonus', 'review', 'practice'])
                  ->default('core')
                  ->after('status');
            $table->unsignedTinyInteger('sequence_number')
                  ->nullable()
                  ->after('session_type');
        });
    }

    public function down(): void
    {
        Schema::table('student_sessions', function (Blueprint $table) {
            $table->dropColumn(['session_type', 'sequence_number']);
        });
    }
};
