<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra xem đã đăng nhập và có phải là admin không 
        // (Thay điều kiện tùy theo cột trong cơ sở dữ liệu của bạn, ví dụ: is_admin == 1)
        if ($request->user() && $request->user()->is_admin == 1) {
            return $next($request);
        }

        // Nếu là user thường -> Chặn lại và báo lỗi 403
        abort(403, 'Bạn không có quyền truy cập khu vực này.');
    }
}
