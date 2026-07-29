<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Định nghĩa Gate 'admin' dựa theo trường phân quyền hoặc email của bạn
        Gate::define('admin', function (User $user) {
            return $user->is_admin == 1; // Hoặc kiểm tra theo điều kiện của bạn, ví dụ: $user->email === 'admin@gmail.com'
        });
    }
}
