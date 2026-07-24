@extends('admin.layouts.main')

@section('title', 'Cập nhật sản phẩm')

@section('content')
<div class="mb-4">
    <a href="{{ request('redirect_to', url()->previous() != url()->current() ? url()->previous() : route('admin.products.index')) }}" class="btn btn-outline-secondary btn-sm mb-2">
        <i class="bi bi-arrow-left"></i> Quay lại
    </a>
    <h3 class="fw-bold">Cập Nhật Sản Phẩm #{{ $product->id }}</h3>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Lưu giữ URL trang nguồn (bao gồm số trang 'page' và các tham số lọc) -->
            <input type="hidden" name="redirect_to" value="{{ old('redirect_to', request('redirect_to', url()->previous() != url()->current() ? url()->previous() : route('admin.products.index'))) }}">

            <div class="row g-3">
                <!-- Tên sản phẩm -->
                <div class="col-md-8">
                    <label class="form-label fw-bold">Tên sản phẩm <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Danh mục -->
                <div class="col-md-4">
                    <label class="form-label fw-bold">Danh mục <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                        <option value="">-- Chọn danh mục --</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Giá sản phẩm -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Giá sản phẩm (VNĐ) <span class="text-danger">*</span></label>
                    <input type="number" step="any" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}">
                    @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Trạng thái -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Trạng thái <span class="text-danger">*</span></label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="published" {{ old('status', $product->status) == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ old('status', $product->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Upload / Quản lý Ảnh đại diện -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Thay đổi ảnh đại diện</label>
                    <input type="file" name="image_up" class="form-control @error('image_up') is-invalid @enderror">
                    @error('image_up')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="mt-2">
                        @if($product->image_path && file_exists(public_path('storage/' . $product->image_path)))
                        <small class="text-muted d-block mb-1">Ảnh hiện tại:</small>
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ asset('storage/' . $product->image_path) }}" class="rounded img-thumbnail" style="max-height: 80px;">
                            <div class="form-check text-danger">
                                <input class="form-check-input" type="checkbox" name="delete_image" value="1" id="delete_image">
                                <label class="form-check-label fw-semibold" for="delete_image">
                                    <i class="bi bi-trash"></i> Xóa ảnh này
                                </label>
                            </div>
                        </div>
                        @else
                        <span class="badge bg-light text-muted border py-2 px-3">
                            <i class="bi bi-image me-1"></i> Chưa có ảnh đại diện
                        </span>
                        @endif
                    </div>
                </div>

                <!-- Upload / Quản lý File tài liệu -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Thay đổi file tài liệu</label>
                    <input type="file" name="document_up" class="form-control @error('document_up') is-invalid @enderror">
                    @error('document_up')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="mt-2">
                        @if($product->document_path && file_exists(public_path('storage/' . $product->document_path)))
                        <small class="text-muted d-block mb-1">Tài liệu hiện tại:</small>
                        <div class="d-flex align-items-center gap-3">
                            <a href="{{ asset('storage/' . $product->document_path) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                <i class="bi bi-file-earmark-text me-1"></i> Xem tệp hiện tại
                            </a>
                            <div class="form-check text-danger">
                                <input class="form-check-input" type="checkbox" name="delete_document" value="1" id="delete_document">
                                <label class="form-check-label fw-semibold" for="delete_document">
                                    <i class="bi bi-trash"></i> Xóa tài liệu này
                                </label>
                            </div>
                        </div>
                        @else
                        <span class="badge bg-light text-muted border py-2 px-3">
                            <i class="bi bi-file-earmark-x me-1"></i> Chưa có file tài liệu
                        </span>
                        @endif
                    </div>
                </div>

                <!-- Mô tả -->
                <div class="col-12">
                    <label class="form-label fw-bold">Mô tả sản phẩm</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-warning text-white px-4"><i class="bi bi-pencil-square me-1"></i> Cập nhật sản phẩm</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection