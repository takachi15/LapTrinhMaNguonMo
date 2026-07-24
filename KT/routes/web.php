<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductAdminController;

// 1. Route Đăng nhập & Đăng xuất (Công khai)
Route::get('/login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Chuyển hướng trang chủ về admin
Route::get('/', function () {
    return redirect()->route('admin.products.index');
});

// 2. Bảo vệ toàn bộ Route Admin bằng Middleware auth
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::prefix('products')->name('products.')->group(function () {
        // Tải tài liệu an toàn
        Route::get('{id}/download', [ProductAdminController::class, 'downloadDocument'])->name('download');

        // Import từ file CSV (Đưa vào đây để thừa hưởng prefix 'admin.products.')
        Route::post('import-csv', [ProductAdminController::class, 'importCsv'])->name('importCsv');

        // Quản lý Thùng rác
        Route::get('trash', [ProductAdminController::class, 'trash'])->name('trash');
        Route::patch('{id}/restore', [ProductAdminController::class, 'restore'])->name('restore');
        Route::delete('{id}/force-delete', [ProductAdminController::class, 'forceDelete'])->name('forceDelete');
    });

    // Resource routes cho Product (Đặt sau các route tùy chỉnh của products)
    Route::resource('products', ProductAdminController::class);
});
