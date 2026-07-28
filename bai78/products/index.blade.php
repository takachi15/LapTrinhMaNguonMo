@extends('layouts.app')
@section('title', 'Danh sách sản phẩm')

@section('content')
<h2>Danh sách sản phẩm</h2>

<p><a href="{{ route('products.create') }}">+ Thêm sản phẩm</a></p>

<table border="1" cellpadding="6" cellspacing="0" style="width:100%;border-collapse:collapse">
<tr>
    <th>Tên</th>
    <th>Giá</th>
    <th>Tồn kho</th>
    <th>Danh mục</th>
    <th>Hành động</th>
</tr>
@foreach($products as $p)
<tr>
    <td>{{ $p->name }}</td>
    <td>{{ number_format($p->price) }} đ</td>
    <td>{{ $p->stock }}</td>
    <td>{{ $p->category->name }}</td>
    <td>
        <a href="{{ route('products.edit', $p->id) }}">Sửa</a>
        <form action="{{ route('products.destroy', $p->id) }}" method="post" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Xoá sản phẩm này?')">Xoá</button>
        </form>
    </td>
</tr>
@endforeach
</table>

{{ $products->links() }}
@endsection