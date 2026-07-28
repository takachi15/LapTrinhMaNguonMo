<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(10); //lay danh sach san pham, phan trang 10 sp moi trang
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([   //để kiểm tra dữ liệu trc khi luu
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Tạo sản phẩm thành công.');
    }//để chuyển hướng về trang danh sách kèm theo thông báo flash message

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([ //để kiểm tra dữ liệu trc khi luu
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công.');
    }//để chuyển hướng về trang danh sách kèm theo thông báo flash message

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Đã xoá sản phẩm.');
    }
}