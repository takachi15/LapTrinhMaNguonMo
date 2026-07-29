@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Chỉnh Sửa Bài Viết') }}
</h2>
@endsection

@section('content')
<div class="py-8">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

            <h3 class="text-lg font-bold text-gray-800 mb-6">Cập nhật nội dung bài viết</h3>

            <!-- Thông báo lỗi validate nếu có -->
            @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-lg">
                <ul class="list-disc pl-5 text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Tiêu đề -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Tiêu đề bài viết</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $article->title) }}" required
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                </div>

                <!-- Nội dung -->
                <div>
                    <label for="body" class="block text-sm font-medium text-gray-700 mb-1">Nội dung bài viết</label>
                    <textarea name="body" id="body" rows="6" required
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">{{ old('body', $article->body) }}</textarea>
                </div>

                <!-- Hình ảnh hiện tại & Upload ảnh mới -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Hình ảnh</label>
                    @if($article->image_path)
                    <div class="mb-3">
                        <p class="text-xs text-gray-500 mb-1">Ảnh hiện tại:</p>
                        <img src="{{ asset('storage/' . $article->image_path) }}" alt="Current Image" class="w-32 h-32 object-cover rounded-md border shadow-sm">
                    </div>
                    @endif
                    <input type="file" name="image" id="image" accept="image/*"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>

                <!-- Action buttons -->
                <div class="flex items-center justify-end space-x-3 pt-4 border-t">
                    <a href="{{ route('articles.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md text-sm font-semibold hover:bg-gray-200 transition">
                        Hủy
                    </a>
                    <button type="submit" class="px-4 py-2 bg-amber-500 text-white rounded-md text-sm font-semibold hover:bg-amber-600 transition shadow-sm">
                        Cập nhật bài viết
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection