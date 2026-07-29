<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">

        <!-- Thanh Nav trên cùng với nút Đăng ký / Đăng nhập / Đăng xuất -->
        <nav class="bg-white border-b border-gray-100 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                <div class="flex items-center space-x-6">
                    <a href="{{ route('articles.index') }}" class="font-bold text-xl text-gray-800 hover:text-blue-600">
                        Quản Lý Bài Viết
                    </a>
                    <a href="{{ route('articles.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                        Danh sách bài viết
                    </a>
                    @auth
                    <a href="{{ route('articles.create') }}" class="text-sm text-gray-600 hover:text-gray-900">
                        + Thêm bài viết mới
                    </a>
                    @endauth
                </div>

                <!-- Auth Status & Links -->
                <div class="flex items-center space-x-4">
                    @auth
                    <span class="text-sm text-gray-700">
                        Xin chào, <strong>{{ Auth::user()->name }}</strong>
                    </span>

                    @if(Auth::user()->is_admin)
                    <a href="{{ url('/admin/articles') }}" class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded border border-red-300 font-semibold">
                        Admin
                    </a>
                    @include('layouts.admin-menu-item')
                    @endif

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-red-600 hover:underline ms-2 font-medium">
                            Đăng xuất
                        </button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-gray-900 font-medium">
                        Đăng nhập
                    </a>
                    <a href="{{ route('register') }}" class="text-sm bg-blue-600 text-white px-3 py-1.5 rounded-md hover:bg-blue-700 font-medium transition">
                        Đăng ký
                    </a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Page Heading (Nếu có từ Breeze) -->
        @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main class="py-6">
            {{ $slot ?? '' }}
            @yield('content')
        </main>
    </div>
</body>

</html>