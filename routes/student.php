<?php

use App\Http\Controllers\backend\student\StudentDashboardController;
use App\Http\Middleware\StudentMiddleware;
use Illuminate\Support\Facades\Route;



Route::prefix('student')->middleware([StudentMiddleware::class])->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
});