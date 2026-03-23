<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mastery_scores', function (Blueprint $table) {
            $table->unsignedTinyInteger('evidence_count')->default(0)->after('trend');
            $table->unsignedTinyInteger('recent_accuracy')->default(0)->after('evidence_count'); // 0-100 %
        });
    }

    public function down(): void
    {
        Schema::table('mastery_scores', function (Blueprint $table) {
            $table->dropColumn(['evidence_count', 'recent_accuracy']);
        });
    }
};
