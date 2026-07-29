<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    use AuthorizesRequests;

    /**
     * Hiển thị danh sách tất cả bài viết
     */
    public function index()
    {
        // Dùng paginate thay vì get để hỗ trợ {{ $articles->links() }}
        $articles = Article::with('user')->latest()->paginate(10);

        return view('articles.index', compact('articles'));
    }

    /**
     * Màn hình tạo bài viết mới
     */
    public function create()
    {
        $this->authorize('create', Article::class);
        return view('articles.create');
    }

    /**
     * Lưu bài viết mới vào CSDL
     */
    public function store(StoreArticleRequest $request)
    {
        $this->authorize('create', Article::class);

        $data = $request->validated();

        // Gán tác giả là người dùng đang đăng nhập
        $data['user_id'] = Auth::id();
        // Xử lý upload ảnh nếu có
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('articles', 'public');
        }

        Article::create($data);

        return redirect()->route('articles.index')
            ->with('success', 'Tạo bài viết thành công');
    }

    /**
     * Xem chi tiết một bài viết
     */
    public function show(Article $article)
    {
        // Tải sẵn thông tin tác giả để tránh query N+1 và lỗi không tìm thấy user
        $article->load('user');

        return view('articles.show', compact('article'));
    }

    /**
     * Màn hình chỉnh sửa bài viết
     */
    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        return view('articles.edit', compact('article'));
    }

    /**
     * Cập nhật thông tin bài viết
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $this->authorize('update', $article);

        $data = $request->validated();

        // Nếu người dùng upload ảnh mới
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu tồn tại
            if ($article->image_path && Storage::disk('public')->exists($article->image_path)) {
                Storage::disk('public')->delete($article->image_path);
            }

            // Lưu ảnh mới
            $data['image_path'] = $request->file('image')->store('articles', 'public');
        }

        $article->update($data);

        return redirect()->route('articles.show', $article)
            ->with('success', 'Cập nhật bài viết thành công');
    }

    /**
     * Xóa bài viết
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        // Xóa tập tin ảnh minh họa trong ổ đĩa nếu có
        if ($article->image_path && Storage::disk('public')->exists($article->image_path)) {
            Storage::disk('public')->delete($article->image_path);
        }

        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Đã xóa bài viết thành công');
    }
}
