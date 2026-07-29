<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    /** Xem danh sách bài viết */
    public function before(User $user, string $ability): ?bool
    {
        if ($user->is_admin) {
            return true;
        }

        return null; // Tiếp tục kiểm tra các hàm bên dưới nếu không phải Admin
    }
    public function viewAny(?User $user): bool
    {
        return true; // Công khai
    }

    /** Xem chi tiết bài viết */
    public function view(?User $user, Article $article): bool
    {
        return true; // Công khai
    }

    /** Tạo bài viết: yêu cầu đăng nhập */
    public function create(User $user): bool
    {
        return $user !== null;
    }

    /** Chỉ tác giả được sửa */
    public function update(User $user, Article $article): bool
    {
        return $article->user_id === $user->id;
    }

    /** Chỉ tác giả được xóa */
    public function delete(User $user, Article $article): bool
    {
        return $article->user_id === $user->id;
    }

    public function restore(User $user, Article $article): bool
    {
        return false;
    }

    public function forceDelete(User $user, Article $article): bool
    {
        return false;
    }
}
