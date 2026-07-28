@extends('layouts.app')
@section('title', 'Sửa sản phẩm')

@section('content')
<h2>Sửa sản phẩm #{{ $product->id }}</h2>

<form action="{{ route('products.update', $product->id) }}" method="post">
    @csrf
    @method('PUT')

    <x-input name="name" label="Tên sản phẩm" :value="$product->name" />
    <x-input name="price" label="Giá" type="number" :value="$product->price" />
    <x-input name="stock" label="Tồn kho" type="number" :value="$product->stock" />

    <label style="display:block;margin:8px 0 4px">Danh mục</label>
    <select name="category_id" style="width:100%;padding:8px">
        @foreach($categories as $c)
            <option value="{{ $c->id }}" @selected(old('category_id', $product->category_id) == $c->id)>{{ $c->name }}</option>
        @endforeach
    </select>
    @error('category_id')
        <div style="color:#991B1B;margin-top:4px">{{ $message }}</div>
    @enderror

    <button type="submit" style="margin-top:10px">Cập nhật</button>
</form>
@endsection