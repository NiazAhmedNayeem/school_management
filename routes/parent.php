<?php

use App\Http\Controllers\backend\parent\ParentDashboardController;
use App\Http\Middleware\ParentMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('parent')->middleware([ParentMiddleware::class])->group(function () {
    Route::get('/dashboard', [ParentDashboardController::class, 'index'])->name('parent.dashboard');
});