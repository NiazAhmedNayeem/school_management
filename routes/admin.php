<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\admin\AdminDashboardController;
use App\Http\Controllers\backend\admin\AdminStudentController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;


Route::prefix('admin')->middleware([AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    
    Route::get('/all-students', [AdminStudentController::class, 'index'])->name('admin.all_students');
    Route::get('/add-student', [AdminStudentController::class, 'create'])->name('admin.add_student');
    Route::post('/store-student', [AdminStudentController::class, 'store'])->name('admin.store_student');
    Route::get('/edit-student/{id}', [AdminStudentController::class, 'edit'])->name('admin.edit_student');
    Route::post('/update-student/{id}', [AdminStudentController::class, 'update'])->name('admin.update_student');
    Route::delete('/delete-student/{id}', [AdminStudentController::class, 'destroy'])->name('admin.delete_student');

    Route::get('/parents/check-nid', [AdminStudentController::class, 'checkNid'])->name('parents.checkNid');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});