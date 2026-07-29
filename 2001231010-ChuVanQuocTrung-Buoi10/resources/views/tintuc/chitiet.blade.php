@extends('layout')
@section('title', $tin->tieude)
@section('content')
<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card shadow-sm">
            @if($tin->hinhanh)
            <img src="{{ asset('images/news/' . $tin->hinhanh) }}" class="card-img-top" alt="{{ $tin->tieude }}">
            @endif
            <div class="card-body">
                <h2 class="card-title mb-3">{{ $tin->tieude }}</h2>
                <p class="text-muted small mb-3">
                    Ngày đăng: {{ \Illuminate\Support\Carbon::parse($tin->ngaydang)->format('d/m/Y') }}
                </p>
                <p class="card-text fs-5 text-justify">
                    {!! nl2br(e($tin->noidung)) !!}
                </p>
                <hr>
                <a href="{{ route('tin.index') }}" class="btn btn-secondary">
                    ← Quay lại danh sách
                </a>
            </div>
        </div>
    </div>
</div>
@endsection