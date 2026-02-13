<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\IeltsAuthController;
use App\Http\Controllers\Api\IeltsTestController;
use App\Http\Controllers\Api\IeltsExamSessionController;
use App\Http\Controllers\Api\IeltsAnswerController;
use App\Http\Controllers\Api\IeltsResultController;

// Public routes
Route::post('/auth/register', [IeltsAuthController::class, 'register']);
Route::post('/auth/login', [IeltsAuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/auth/logout', [IeltsAuthController::class, 'logout']);
    Route::get('/auth/me', [IeltsAuthController::class, 'me']);

    // Tests
    Route::get('/tests', [IeltsTestController::class, 'index']);
    Route::get('/tests/{test}', [IeltsTestController::class, 'show']);

    // Exam Sessions
    Route::post('/exam-sessions/start', [IeltsExamSessionController::class, 'start']);
    Route::get('/exam-sessions/{attempt}', [IeltsExamSessionController::class, 'show']);
    Route::post('/exam-sessions/{attempt}/submit', [IeltsExamSessionController::class, 'submit']);
    Route::post('/exam-sessions/{attempt}/tab-switch', [IeltsExamSessionController::class, 'recordTabSwitch']);

    // Answers
    Route::post('/answers', [IeltsAnswerController::class, 'store']);
    Route::put('/answers/{answer}', [IeltsAnswerController::class, 'update']);

    // Results
    Route::get('/results', [IeltsResultController::class, 'index']);
    Route::get('/results/{attempt}', [IeltsResultController::class, 'show']);
    Route::get('/statistics', [IeltsResultController::class, 'getStatistics']);

    // Admin routes
    Route::middleware('admin')->group(function () {
        Route::post('/tests', [IeltsTestController::class, 'store']);
        Route::put('/tests/{test}', [IeltsTestController::class, 'update']);
        Route::delete('/tests/{test}', [IeltsTestController::class, 'destroy']);
    });
});
