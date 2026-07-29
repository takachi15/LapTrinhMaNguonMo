<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** 
     * Kiểm tra khách truy cập route bảo vệ trả về 302 chuyển hướng về login
     */
    public function test_khach_chua_dang_nhap_bi_chuyen_huong_khi_vao_trang_admin(): void
    {
        $response = $this->get('/admin/articles');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /** 
     * Kiểm tra đăng nhập thành công với thông tin đúng
     */
    public function test_nguoi_dung_dang_nhap_thanh_cong(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password123'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/dashboard');
    }

    /** 
     * Kiểm tra đăng nhập thất bại khi sai mật khẩu
     */
    public function test_nguoi_dung_dang_nhap_that_bai_khi_sai_mat_khau(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'sai-mat-khau',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors();
    }
}
