<?php

use App\Http\Controllers\backend\dashboard\DashboardController;
use App\Http\Controllers\backend\student\StudentController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\StudentMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');















require __DIR__.'/auth.php';
