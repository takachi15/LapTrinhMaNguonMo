@extends('admin.layouts.main')

@section('title', 'Thùng rác sản phẩm')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-danger"><i class="bi bi-trash me-2"></i>Thùng Rác Sản Phẩm</h3>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Quay lại danh sách
    </a>
</div>

<!-- Bảng hiển thị danh sách xóa tạm -->
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
                        <th>Thời gian xóa</th>
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
                        <td class="text-muted small">{{ $item->deleted_at->format('d/m/Y H:i') }}</td>
                        <td class="text-center">
                            <!-- Nút Khôi phục -->
                            <form action="{{ route('admin.products.restore', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-outline-success me-1" title="Khôi phục">
                                    <i class="bi bi-arrow-counterclockwise"></i> Khôi phục
                                </button>
                            </form>

                            <!-- Nút Xóa vĩnh viễn -->
                            <form action="{{ route('admin.products.forceDelete', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('CẢNH BÁO: Hành động này sẽ xóa vĩnh viễn sản phẩm và toàn bộ file đính kèm trong lưu trữ!')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa vĩnh viễn">
                                    <i class="bi bi-x-circle"></i> Xóa vĩnh viễn
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Thùng rác rỗng.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Phân trang -->
    @if($products->hasPages())
    <div class="card-footer bg-white py-3 border-top">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="text-muted small">
                Hiển thị <b>{{ $products->firstItem() }}</b> đến <b>{{ $products->lastItem() }}</b> trong tổng số <b>{{ $products->total() }}</b> sản phẩm đã xóa
            </div>
            <div>
                {{ $products->links() }}
            </div>
        </div>
    </div>
    @endif
</div>
@endsection