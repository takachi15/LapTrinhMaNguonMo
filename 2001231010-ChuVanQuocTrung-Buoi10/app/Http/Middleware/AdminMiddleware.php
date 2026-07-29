<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra xem đã đăng nhập VÀ có phải là admin không
        // (Tuỳ vào cột trong CSDL của bạn, ví dụ: is_admin == 1 hoặc role == 'admin')
        if ($request->user() && $request->user()->is_admin == 1) {
            return $next($request);
        }

        // Nếu không phải admin mà lết vào đây -> Báo lỗi 403 ngay lập tức
        abort(403, 'Bạn không có quyền truy cập khu vực này.');
    }
}
