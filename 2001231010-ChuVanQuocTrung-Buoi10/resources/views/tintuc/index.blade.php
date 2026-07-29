@extends('layouts.app') {{-- Hoặc layout chính của bạn, ví dụ: layouts.layout --}}

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Danh sách Tin Tức</h2>

    <div class="row">
        @forelse($dsTin as $tin)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                @if(!empty($tin->hinhanh))
                <img src="{{ asset('images/news/' . $tin->hinhanh) }}" class="card-img-top" alt="{{ $tin->tieude ?? $tin->title }}">
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $tin->tieude ?? $tin->title }}</h5>
                    <p class="text-muted small mb-2">
                        Ngày đăng: {{ \Illuminate\Support\Carbon::parse($tin->ngaydang ?? $tin->created_at)->format('d/m/Y') }}
                    </p>
                    <p class="card-text text-truncate">
                        {{ $tin->nomota ?? $tin->content }}
                    </p>
                    <a href="{{ route('tin.show', $tin->id) }}" class="btn btn-primary mt-auto">Xem chi tiết</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-warning text-center">Chưa có bài viết nào trong cơ sở dữ liệu.</div>
        </div>
        @endforelse
    </div>

    <!-- Phân trang -->
    <div class="d-flex justify-content-center mt-4">
        {{ $dsTin->links() }}
    </div>
</div>
@endsection