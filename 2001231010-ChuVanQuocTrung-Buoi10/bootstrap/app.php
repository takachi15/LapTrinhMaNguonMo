<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckAdmin;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // 1. Đăng ký alias 'admin' cho CheckAdmin middleware
        $middleware->alias([
            'admin' => CheckAdmin::class,
        ]);

        // 2. Cấu hình loại trừ endpoint webhook khỏi kiểm tra CSRF (Bài 8)
        $middleware->validateCsrfTokens(except: [
            'api/webhook',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
