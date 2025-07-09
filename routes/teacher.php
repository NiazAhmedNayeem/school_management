<?php

use App\Http\Controllers\backend\teacher\TeacherDashboardController;
use App\Http\Middleware\TeacherMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('teacher')->middleware([TeacherMiddleware::class])->group(function () {
    Route::get('/dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
});