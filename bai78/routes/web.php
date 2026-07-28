<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;

Route::resource('products', ProductController::class);

Route::get('/students', [StudentController::class, 'index'])->name('students.index');

Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');