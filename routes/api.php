<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Student\CurriculumController;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\DeviceTokenController;
use App\Http\Controllers\Student\DiagnosticController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Student\ProgressController;
use App\Http\Controllers\Student\RewardsController;
use App\Http\Controllers\Student\SessionController;
use App\Http\Controllers\Student\SessionQueueController;
use App\Http\Controllers\Student\SkillDetailController;
use App\Http\Controllers\Student\SkillMapController;
use App\Http\Controllers\Teacher\StudentController as TeacherStudentController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    // -----------------------------------------------------------------------
    // Auth — public
    // -----------------------------------------------------------------------
    Route::prefix('auth')->group(function () {
        Route::post('student/login', [AuthController::class, 'studentLogin']);
        Route::post('login',         [AuthController::class, 'login']);
        Route::post('logout',        [AuthController::class, 'logout'])->middleware('auth:sanctum');
    });

    // -----------------------------------------------------------------------
    // Student — authenticated
    // -----------------------------------------------------------------------
    Route::middleware(['auth:sanctum', 'student'])->prefix('student')->group(function () {

        // Onboarding / profile
        Route::patch('profile', [ProfileController::class, 'update']);

        // Dashboard
        Route::get('dashboard', [DashboardController::class, 'index']);

        // Diagnostic
        Route::get('diagnostic',                                   [DiagnosticController::class, 'show']);
        Route::post('diagnostic/{diagnostic_id}/submit',           [DiagnosticController::class, 'submit']);

        // Sessions — legacy single-session endpoint (kept for backwards compatibility)
        Route::get('session/today',                                [SessionController::class, 'today']);
        Route::post('session/{session_id}/attempts/bulk',          [SessionController::class, 'bulkAttempt']);
        Route::post('session/{session_id}/complete',               [SessionController::class, 'complete']);

        // Sessions — queue (new)
        Route::get('sessions',                                     [SessionQueueController::class, 'queue']);
        Route::get('sessions/{session_id}/skill-evidence',         [SkillDetailController::class, 'skillEvidence']);
        Route::get('sessions/{session_id}',                        [SessionQueueController::class, 'show']);

        // Curriculum track, unit progress, session queue
        Route::get('curriculum-track',                             [CurriculumController::class, 'track']);
        Route::get('current-unit',                                 [CurriculumController::class, 'currentUnit']);
        Route::get('session-queue',                                [CurriculumController::class, 'sessionQueue']);

        // Skill map
        Route::get('skill-map', [SkillMapController::class, 'index']);

        // Skill detail
        Route::get('skills/{skill_id}/detail',                     [SkillDetailController::class, 'detail']);
        Route::get('skills/{skill_id}/score-history',              [SkillDetailController::class, 'scoreHistory']);

        // Progress
        Route::get('progress', [ProgressController::class, 'index']);

        // Rewards
        Route::get('rewards', [RewardsController::class, 'index']);

        // Device token (push notifications — stubbed)
        Route::post('device-token', [DeviceTokenController::class, 'store']);
    });

    // -----------------------------------------------------------------------
    // Teacher — authenticated
    // -----------------------------------------------------------------------
    Route::middleware(['auth:sanctum', 'teacher'])->prefix('teacher')->group(function () {
        Route::post('students/{student_id}/reset-pin', [TeacherStudentController::class, 'resetPin']);
    });
});
