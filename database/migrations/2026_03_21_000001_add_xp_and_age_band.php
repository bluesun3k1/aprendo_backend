<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->enum('age_band', ['early', 'middle', 'upper'])->nullable()->after('age');
            $table->unsignedSmallInteger('current_level')->default(1)->after('points_total');
            $table->unsignedInteger('current_xp')->default(0)->after('current_level');
        });

        Schema::table('student_sessions', function (Blueprint $table) {
            $table->unsignedInteger('xp_earned')->default(0)->after('completed_at');
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['age_band', 'current_level', 'current_xp']);
        });

        Schema::table('student_sessions', function (Blueprint $table) {
            $table->dropColumn('xp_earned');
        });
    }
};
