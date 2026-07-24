@extends('admin.layouts.main')

@section('title', 'Thêm sản phẩm mới')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm mb-2">
        <i class="bi bi-arrow-left"></i> Quay lại
    </a>
    <h3 class="fw-bold">Thêm Sản Phẩm Mới</h3>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                <!-- Tên sản phẩm -->
                <div class="col-md-8">
                    <label class="form-label fw-bold">Tên sản phẩm <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
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
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
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
                    <input type="number" step="any" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Trạng thái -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Trạng thái <span class="text-danger">*</span></label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Upload Ảnh đại diện -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Ảnh đại diện (jpg, png, webp <= 2MB)</label>
                    <input type="file" name="image_up" class="form-control @error('image_up') is-invalid @enderror">
                    @error('image_up')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Upload File tài liệu -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">File tài liệu (pdf, doc, docx < 5MB)</label>
                    <input type="file" name="document_up" class="form-control @error('document_up') is-invalid @enderror">
                    @error('document_up')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Mô tả -->
                <div class="col-12">
                    <label class="form-label fw-bold">Mô tả sản phẩm</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                </div>

                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Lưu sản phẩm</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection