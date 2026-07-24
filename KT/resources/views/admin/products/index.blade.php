@extends('admin.layouts.main')

@section('title', 'Danh sách sản phẩm')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Quản Lý Sản Phẩm</h3>
    <div class="d-flex gap-2">
        <!-- Nút mở Modal Import CSV -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importCsvModal">
            <i class="bi bi-file-type-csv me-1"></i> Nhập từ File CSV
        </button>
        <a href="{{ route('admin.products.trash') }}" class="btn btn-outline-danger">
            <i class="bi bi-trash me-1"></i> Thùng rác
        </a>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Thêm sản phẩm mới
        </a>
    </div>
</div>

<!-- Bộ lọc tìm kiếm nâng cao -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('admin.products.index') }}" method="GET" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="keyword" class="form-control" placeholder="Tìm theo tên sản phẩm..." value="{{ request('keyword') }}">
            </div>
            <div class="col-md-3">
                <select name="category_id" class="form-select">
                    <option value="">-- Tất cả danh mục --</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">-- Tất cả trạng thái --</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-dark w-100"><i class="bi bi-filter"></i> Lọc</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary" title="Làm mới"><i class="bi bi-arrow-counterclockwise"></i></a>
            </div>
        </form>
    </div>
</div>

<!-- Bảng hiển thị -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">ID</th>
                        <th>Ảnh Thumbnail</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Giá</th>
                        <th>Trạng thái</th>
                        <th>File tài liệu</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $item)
                    <tr>
                        <td class="ps-3 fw-bold">#{{ $item->id }}</td>
                        <td>
                            @if($item->image_path && file_exists(public_path('storage/' . $item->image_path)))
                            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" class="rounded border shadow-sm" style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                            <div class="bg-light rounded border d-flex align-items-center justify-content-center text-muted" style="width: 50px; height: 50px; font-size: 10px;">
                                No Image
                            </div>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $item->name }}</td>
                        <td><span class="badge bg-light text-dark border">{{ $item->category->name ?? 'N/A' }}</span></td>
                        <td class="text-primary fw-bold">{{ number_format($item->price, 0, ',', '.') }} đ</td>
                        <td>
                            @if($item->status == 'published')
                            <span class="badge bg-success">Published</span>
                            @else
                            <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>
                        <td>
                            @if($item->document_path && file_exists(public_path('storage/' . $item->document_path)))
                            <a href="{{ route('admin.products.download', $item->id) }}" class="btn btn-sm btn-outline-info">
                                <i class="bi bi-file-earmark-arrow-down me-1"></i> Tải tài liệu
                            </a>
                            @else
                            <span class="badge bg-light text-muted border py-2 px-3">
                                <i class="bi bi-file-earmark-x me-1"></i> Chưa có file tài liệu
                            </span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.products.edit', array_merge(['product' => $item->id], request()->query())) }}" class="btn btn-sm btn-outline-warning me-1" title="Sửa">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn chuyển sản phẩm này vào thùng rác?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa tạm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">Không tìm thấy sản phẩm nào phù hợp.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Phân trang (Hiển thị luôn luôn để kiểm tra) -->
    <div class="card-footer bg-white py-3 border-top">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="text-muted small">
                Hiển thị <b>{{ $products->firstItem() ?? 0 }}</b> đến <b>{{ $products->lastItem() ?? 0 }}</b> trong tổng số <b>{{ $products->total() }}</b> sản phẩm
            </div>
            <div>
                {{ $products->withQueryString()->links() }}
            </div>
        </div>
    </div>
    <!-- Modal Import CSV -->
    <div class="modal fade" id="importCsvModal" tabindex="-1" aria-labelledby="importCsvModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.products.importCsv') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="importCsvModalLabel"><i class="bi bi-file-earmark-spreadsheet text-success me-2"></i>Nhập sản phẩm từ File CSV</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="csv_file" class="form-label fw-bold">Chọn file CSV (.csv)</label>
                            <input type="file" name="csv_file" id="csv_file" class="form-control" accept=".csv" required>
                        </div>
                        <div class="alert alert-info small mb-0">
                            <i class="bi bi-info-circle me-1"></i> <b>Cấu trúc file CSV chuẩn (theo các cột của table product):</b>
                            <p class="mb-1 mt-1">Thứ tự các cột từ trái qua phải:</p>
                            <code>category_id, name, price, description, image_path, document_path, status</code>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-success"><i class="bi bi-upload me-1"></i> Tải lên & Nhập</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection