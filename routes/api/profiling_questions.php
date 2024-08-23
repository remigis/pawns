<?php

use App\Http\Controllers\ProfilingQuestionController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/get_profiling_questions', [ProfilingQuestionController::class, 'getProfilingQuestions'])->name('api.getProfilingQuestions');
    Route::post('/update_profile', [ProfilingQuestionController::class, 'updateProfile'])->name('api.updateProfile');
});
