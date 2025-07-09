<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\admin\AdminDashboardController;
use App\Http\Controllers\backend\admin\AdminStudentController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;


Route::prefix('admin')->middleware([AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    
    Route::get('/all-students', [AdminStudentController::class, 'index'])->name('admin.all_students');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});