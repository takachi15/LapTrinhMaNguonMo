<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProfileController;

Route::get('/', [ProductController::class, 'index']);
Route::get('/students', [StudentController::class,'index']);
Route::get('/profile', [ProfileController::class, 'showProfile']);
Route::get('/products', [ProductController::class, 'index']);
Route::resource('products', ProductController::class);