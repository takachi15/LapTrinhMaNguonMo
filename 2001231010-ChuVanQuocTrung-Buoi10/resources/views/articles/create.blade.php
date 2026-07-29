@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Quản Lý Bài Viết') }}
</h2>
@endsection

@section('content')
<div class="py-8">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-8 border border-gray-100">

            <!-- Tiêu đề trang -->
            <div class="mb-6 pb-4 border-b border-gray-200">
                <h3 class="text-2xl font-bold text-gray-800">Tạo bài viết mới</h3>
                <p class="text-sm text-gray-500 mt-1">Điền đầy đủ thông tin bên dưới để đăng tải bài viết lên hệ thống.</p>
            </div>

            <!-- Form tạo bài viết -->
            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Tiêu đề -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Tiêu đề bài viết</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Nhập tiêu đề bài viết..."
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5 px-3 border">
                    @error('title')
                    <p class="text-red-600 text-xs mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nội dung -->
                <div>
                    <label for="body" class="block text-sm font-semibold text-gray-700 mb-2">Nội dung chi tiết</label>
                    <textarea name="body" id="body" rows="6" placeholder="Nhập nội dung bài viết..."
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm p-3 border">{{ old('body') }}</textarea>
                    @error('body')
                    <p class="text-red-600 text-xs mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Hình ảnh minh hoạ -->
                <div>
                    <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Hình ảnh minh hoạ (tuỳ chọn)</label>
                    <input type="file" name="image" id="image" accept="image/*"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition cursor-pointer border border-gray-200 rounded-lg">
                    @error('image')
                    <p class="text-red-600 text-xs mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nút thao tác -->
                <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-100">
                    <a href="{{ route('articles.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-200 transition shadow-sm">
                        Quay lại
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition shadow-sm">
                        Lưu bài viết
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection