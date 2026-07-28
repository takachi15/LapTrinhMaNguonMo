@extends('layouts.app')
@section('title', 'Thêm sản phẩm')

@section('content')
<h2>Thêm sản phẩm</h2>

<form action="{{ route('products.store') }}" method="post">
    @csrf

    <x-input name="name" label="Tên sản phẩm" />
    <x-input name="price" label="Giá" type="number" />
    <x-input name="stock" label="Tồn kho" type="number" />

    <label style="display:block;margin:8px 0 4px">Danh mục</label>
    <select name="category_id" style="width:100%;padding:8px">
        @foreach($categories as $c)
            <option value="{{ $c->id }}" @selected(old('category_id') == $c->id)>{{ $c->name }}</option>
        @endforeach
    </select>
    @error('category_id')
        <div style="color:#991B1B;margin-top:4px">{{ $message }}</div>
    @enderror

    <button type="submit" style="margin-top:10px">Lưu</button>
</form>
@endsection