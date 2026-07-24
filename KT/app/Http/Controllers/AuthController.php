<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Hiển thị Form đăng nhập
     */
    public function showFormLogin()
    {
        // Nếu đã đăng nhập rồi thì chuyển thẳng vào trang quản trị
        if (Auth::check()) {
            return redirect()->route('admin.products.index');
        }

        return view('auth.login');
    }

    /**
     * Xử lý xác thực Đăng nhập
     */
    public function login(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Vui lòng nhập Email!',
            'email.email'       => 'Định dạng Email không hợp lệ!',
            'password.required' => 'Vui lòng nhập Mật khẩu!',
        ]);

        // Thực hiện đăng nhập
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.products.index'))
                ->with('ok', 'Đăng nhập thành công!');
        }

        // Đăng nhập thất bại
        return back()->withErrors([
            'email' => 'Thông tin đăng nhập (Email hoặc Mật khẩu) không chính xác!',
        ])->onlyInput('email');
    }

    /**
     * Xử lý Đăng xuất
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('ok', 'Đã đăng xuất thành công!');
    }
}
