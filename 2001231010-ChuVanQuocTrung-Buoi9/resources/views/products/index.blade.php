<h2>Danh sách sản phẩm</h2>
@foreach($products as $product)
    <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
        <h3>{{ $product->name }}</h3>
        <p>Giá: {{ number_format($product->price) }} VNĐ</p>
        
        <!-- Hiển thị tồn kho -->
        <p>
            Kho: 
            @if($product->stock > 0)
                <span style="color: green;">Còn {{ $product->stock }} sản phẩm</span>
            @else
                <span style="color: red;">Hết hàng</span>
            @endif
        </p>
    </div>
@endforeach