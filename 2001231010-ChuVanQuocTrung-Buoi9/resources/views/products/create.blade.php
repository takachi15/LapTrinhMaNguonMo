<h2>Thêm Sản Phẩm Mới</h2>

<!-- Hiển thị lỗi Validate chung nếu có -->
@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/products" method="POST">
    @csrf
    <!-- Sử dụng Component x-input -->
    <x-input type="text" name="name" label="Tên sản phẩm" value="{{ old('name') }}" />
    <x-input type="number" name="price" label="Giá sản phẩm" value="{{ old('price') }}" />
    <x-input type="number" name="stock" label="Số lượng tồn kho" value="{{ old('stock') }}" />
    
    <button type="submit">Lưu sản phẩm</button>
</form>