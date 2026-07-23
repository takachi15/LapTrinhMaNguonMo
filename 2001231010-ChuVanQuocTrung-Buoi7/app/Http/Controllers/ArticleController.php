<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Tạm thời dùng mảng mô phỏng dữ liệu
        $articles = [
            ['id' => 1, 'title' => 'Giới thiệu Laravel 12', 'body' => 'Nội dung A'],

            ['id' => 2, 'title' => 'Blade Components', 'body' => 'Nội dung B'],
        ];
        return view('articles.index', compact('articles'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'min:10'],
        ]);
        // Tạm thời: giả lưu, thực tế sẽ lưu DB ở buổi sau
        return redirect()->route('articles.index')
            ->with('success', 'Tạo bài viết thành công (demo).');
    }
    public function show(string $id)
    {
        // Tạo mảng dữ liệu mẫu khớp với ID truyền vào từ nút Xem
        $article = [
            'id' => $id,
            'title' => 'Bài viết mẫu số ' . $id,
            'body' => 'Nội dung chi tiết của bài viết số ' . $id
        ];

        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Tạo mảng dữ liệu mẫu khớp với ID truyền vào từ nút Sửa
        $article = [
            'id' => $id,
            'title' => 'Bài viết mẫu số ' . $id,
            'body' => 'Nội dung chi tiết cần chỉnh sửa của bài viết số ' . $id
        ];

        return view('articles.edit', compact('article'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'min:10'],
        ]);
        return redirect()->route('articles.index')
            ->with('success', "Cập nhật bài viết #$id thành công (demo).");
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->route('articles.index')
            ->with('success', "Đã xoá bài viết #$id (demo).");
    }
}
