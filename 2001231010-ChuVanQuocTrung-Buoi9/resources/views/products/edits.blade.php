<h2>Sửa Sản Phẩm</h2>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Form sửa cần truyền id sản phẩm và đổi method thành PUT -->
<form action="/products/{{ $product->id }}" method="POST">
    @csrf
    @method('PUT')
    
    <x-input type="text" name="name" label="Tên sản phẩm" value="{{ old('name', $product->name) }}" />
    <x-input type="number" name="price" label="Giá sản phẩm" value="{{ old('price', $product->price) }}" />
    <x-input type="number" name="stock" label="Số lượng tồn kho" value="{{ old('stock', $product->stock) }}" />
    
    <button type="submit">Cập nhật</button>
</form>