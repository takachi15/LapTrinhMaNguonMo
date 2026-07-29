<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TinTucController;
use App\Http\Controllers\AdminController;

// 1. Điều hướng trang chủ (Dùng trang tin tức Chương 10 làm trang chủ chính)
Route::get('/', [TinTucController::class, 'index'])->name('tin.index');
Route::get('/tin/{id}', [TinTucController::class, 'show'])->name('tin.show');

// Điều hướng dashboard mặc định của Breeze
Route::get('/dashboard', function () {
    return redirect()->route('articles.index');
})->middleware(['auth', 'verified'])->name('dashboard');


// ==========================================
// 2. PHẦN QUẢN TRỊ ADMIN
// ==========================================
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

        // THÊM ROUTE NÀY VÀO ĐỂ KHẮC PHỤC LỖI 404:
        Route::get('/articles', [ArticleController::class, 'index'])->name('admin.articles.index');
    });


// ==========================================
// 3. PHẦN KIỂM TRA THROTTLE
// ==========================================
Route::get('/test-throttle', function () {
    return response()->json(['message' => 'Throttle OK (Limit test)']);
})->middleware('throttle:5,1');


// ==========================================
// 4. BÀI 8: KIỂM TRA CSRF (Webhook)
// ==========================================
Route::get('/api/webhook', function (Request $request) {
    return response()->json(['status' => 'Webhook received successfully!']);
});


// ==========================================
// 5. QUẢN LÝ BÀI VIẾT (Articles)
// ==========================================
// ĐẶT CÁC ROUTE TĨNH / TẠO MỚI LÊN TRÊN TRƯỚC
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
});

// ĐẶT ROUTE CÓ THAM SỐ ĐỘNG {article} XUỐNG DƯỚI CÙNG
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');


// ==========================================
// 6. PROFILE CỦA BREEZE
// ==========================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/// Chương 10
// Route danh sách tin tức (Trang chủ)
Route::get('/', [TinTucController::class, 'index'])->name('tin.index');

// Route xem chi tiết tin tức dựa vào ID
Route::get('/tin/{id}', [TinTucController::class, 'show'])->name('tin.show');
// Nạp các route xác thực mặc định của Laravel Breeze
require __DIR__ . '/auth.php';
