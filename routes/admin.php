<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\admin\AdminDashboardController;
use App\Http\Controllers\backend\admin\AdminStudentController;
use App\Http\Controllers\backend\admin\AdminClassController;
use App\Http\Controllers\backend\admin\AdminSectionController;

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



    //Class Routes
    Route::get('/all-classes', [AdminClassController::class, 'allClasses'])->name('admin.all_classes');
    Route::get('/add-class', [AdminClassController::class, 'addClass'])->name('admin.add_class');
    Route::post('/store-class', [AdminClassController::class, 'storeClass'])->name('admin.store_class');
    Route::get('/edit-class/{id}', [AdminClassController::class, 'editClass'])->name('admin.edit_class');
    Route::post('/update-class/{id}', [AdminClassController::class, 'updateClass'])->name('admin.update_class');
    Route::delete('/delete-class/{id}', [AdminClassController::class, 'deleteClass'])->name('admin.delete_class');
    Route::post('/update-class-status', [AdminClassController::class, 'updateClassStatus'])->name('admin.update_class_status');
    //Route::get('/check-class-name', [AdminClassController::class, 'checkClassName'])->name('admin.check_class_name');
    //Section Routes
    Route::get('/all-sections', [AdminSectionController::class, 'allSections'])->name('admin.all_sections');
    Route::get('/add-section', [AdminSectionController::class, 'addSection'])->name('admin.add_section');
    Route::post('/store-section', [AdminSectionController::class, 'storeSection'])->name('admin.store_section');
    Route::get('/edit-section/{slug}', [AdminSectionController::class, 'editSection'])->name('admin.edit_section');
    Route::post('/update-section/{slug}', [AdminSectionController::class, 'updateSection'])->name('admin.update_section');
    Route::delete('/delete-section/{slug}', [AdminSectionController::class, 'deleteSection'])->name('admin.delete_section');
    Route::post('/update-section-status', [AdminSectionController::class, 'updateSectionStatus'])->name('admin.update_section_status');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});