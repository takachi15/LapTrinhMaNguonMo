@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white shadow sm:rounded-lg">
            <!-- Tiêu đề & Nội dung -->
            <h3 class="text-2xl font-bold mb-4 text-gray-800">{{ $article->title }}</h3>
            <div class="mb-6 text-gray-700 leading-relaxed">{{ $article->body }}</div>

            <!-- Hình ảnh bài viết -->
            @if($article->image_path)
            <div class="mb-6">
                <img src="{{ asset('storage/' . $article->image_path) }}" alt="Ảnh minh hoạ" class="max-w-full h-auto rounded-lg shadow-sm">
            </div>
            @endif

            <!-- Thông tin tác giả & ngày tạo -->
            <div class="text-sm text-gray-500 mb-6 border-b pb-4">
                Tác giả: <span class="font-semibold text-gray-700">{{ $article->user->name ?? 'Vô danh' }}</span> |
                Ngày tạo: {{ $article->created_at ? $article->created_at->format('d/m/Y H:i') : '' }}
            </div>

            <!-- Nút Sửa/Xóa dành riêng cho Tác giả -->
            <div class="flex items-center space-x-3">
                @can('update', $article)
                <a href="{{ route('articles.edit', $article) }}" class="inline-block bg-yellow-500 text-white px-4 py-2 rounded-md text-sm font-semibold hover:bg-yellow-600 transition">
                    Sửa bài viết
                </a>
                @endcan

                @can('delete', $article)
                <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Xóa bài viết này?')" class="bg-red-600 text-white px-4 py-2 rounded-md text-sm font-semibold hover:bg-red-700 transition">
                        Xóa bài viết
                    </button>
                </form>
                @endcan
            </div>

            <!-- Thông báo dành cho người KHÔNG PHẢI tác giả -->
            @cannot('update', $article)
            <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-md">
                <p class="text-blue-700 font-medium text-sm">
                    ℹ️ Bạn không phải tác giả bài viết này nên không có quyền Chỉnh sửa hoặc Xóa.
                </p>
            </div>
            @endcannot

            <div class="mt-6">
                <a href="{{ route('articles.index') }}" class="text-sm text-gray-600 hover:underline">
                    &larr; Quay lại danh sách bài viết
                </a>
            </div>

        </div>
    </div>
</div>
@endsection