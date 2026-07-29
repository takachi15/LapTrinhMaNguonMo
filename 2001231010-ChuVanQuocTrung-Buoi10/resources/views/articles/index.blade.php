@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Quản Lý Bài Viết') }}
</h2>
@endsection

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <!-- Banner tiêu đề trang & Nút thêm bài viết -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-white p-6 rounded-lg shadow-sm">
            <div>
                <h3 class="text-xl font-bold text-gray-800">Danh sách bài viết</h3>
                <p class="text-sm text-gray-500 mt-1">Tổng hợp và quản lý toàn bộ các bài viết trong hệ thống</p>
            </div>
            @authp
            <a href="{{ route('articles.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 transition shadow-sm">
                + Thêm bài viết mới
            </a>
            @authp
        </div>

        <!-- Thông báo Success -->
        @if(session('success'))
        <div class="p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-lg shadow-sm flex items-center justify-between">
            <span class="font-medium text-sm">{{ session('success') }}</span>
        </div>
        @endif

        <!-- Bảng danh sách bài viết -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 border-b">
                        <tr>
                            <th scope="col" class="px-6 py-4 w-16 text-center">ID</th>
                            <th scope="col" class="px-6 py-4">Tiêu đề</th>
                            <th scope="col" class="px-6 py-4 text-center">Hình ảnh</th>
                            <th scope="col" class="px-6 py-4">Tác giả</th>
                            <th scope="col" class="px-6 py-4 text-center w-56">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($articles as $article)
                        <tr class="hover:bg-gray-50 transition">
                            <!-- ID -->
                            <td class="px-6 py-4 font-semibold text-center text-gray-500">
                                {{ $article->id }}
                            </td>

                            <!-- Tiêu đề -->
                            <td class="px-6 py-4 font-medium text-gray-900">
                                <a href="{{ route('articles.show', $article) }}" class="hover:text-blue-600 transition">
                                    {{ $article->title }}
                                </a>
                            </td>

                            <!-- Hình ảnh -->
                            <td class="px-6 py-4 text-center">
                                @if($article->image_path)
                                <img src="{{ asset('storage/' . $article->image_path) }}"
                                    alt="{{ $article->title }}"
                                    class="w-14 h-14 object-cover rounded-md mx-auto shadow-sm border">
                                @else
                                <span class="text-xs text-gray-400 italic">Không có ảnh</span>
                                @endif
                            </td>

                            <!-- Tác giả -->
                            <td class="px-6 py-4 text-gray-700">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    {{ $article->user->name ?? 'Vô danh' }}
                                </span>
                            </td>

                            <!-- Nút hành động -->
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <!-- Nút Xem (Công khai) -->
                                    <a href="{{ route('articles.show', $article) }}"
                                        class="px-3 py-1 bg-gray-100 text-gray-700 hover:bg-gray-200 rounded text-xs font-semibold transition">
                                        Xem
                                    </a>

                                    <!-- Nút Sửa (Chỉ Tác giả) -->
                                    @can('update', $article)
                                    <a href="{{ route('articles.edit', $article) }}"
                                        class="px-3 py-1 bg-blue-600 text-white hover:bg-blue-700 rounded text-xs font-bold transition inline-block">
                                        Sửa
                                    </a>
                                    @endcan

                                    <!-- Nút Xóa (Chỉ Tác giả) -->
                                    @can('delete', $article)
                                    <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Bạn có chắc muốn xóa bài viết này?')"
                                            class="px-3 py-1 bg-red-600 text-white hover:bg-red-700 rounded text-xs font-semibold transition">
                                            Xóa
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                Chưa có bài viết nào được tạo.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Thanh Phân Trang (Nếu Controller dùng paginate) -->
            @if(method_exists($articles, 'links') && $articles->hasPages())
            <div class="p-4 border-t bg-gray-50">
                {{ $articles->links() }}
            </div>
            @endif
        </div>

    </div>
</div>
@endsection