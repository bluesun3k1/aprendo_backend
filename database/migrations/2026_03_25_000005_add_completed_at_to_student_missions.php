<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_missions', function (Blueprint $table) {
            // Timestamp when the mission was first completed this week
            $table->timestamp('completed_at')->nullable()->after('completed');
        });
    }

    public function down(): void
    {
        Schema::table('student_missions', function (Blueprint $table) {
            $table->dropColumn('completed_at');
        });
    }
};
