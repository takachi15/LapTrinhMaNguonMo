<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Hiển thị danh sách sản phẩm.
     */
    public function index()
    {
        // Lấy danh sách sản phẩm kèm theo thông tin danh mục, phân trang 10 sản phẩm/trang
        $products = Product::with('category')->latest()->paginate(10);
        
        return view('products.index', compact('products'));
    }

    /**
     * Hiển thị form thêm mới sản phẩm.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Xử lý lưu dữ liệu sản phẩm mới vào CSDL.
     * Sử dụng ProductRequest để tự động Validation.
     */
    public function store(ProductRequest $request)
    {
        // Lấy toàn bộ dữ liệu đã được validate (ngoại trừ các file upload)
        $data = $request->except(['image_up', 'document_up']);

        // Xử lý upload Ảnh đại diện (nếu có)
        if ($request->hasFile('image_up')) {
            // Lưu file vào thư mục storage/app/public/uploads/products
            $imagePath = $request->file('image_up')->store('uploads/products', 'public');
            $data['image_path'] = $imagePath; // Gán vào cột image_path trong DB
        }

        // Xử lý upload Tài liệu kỹ thuật (nếu có)
        if ($request->hasFile('document_up')) {
            // Lưu file vào thư mục storage/app/public/uploads/documents
            $documentPath = $request->file('document_up')->store('uploads/documents', 'public');
            $data['document_path'] = $documentPath; // Gán vào cột document_path trong DB
        }

        // Tạo sản phẩm mới
        Product::create($data);

        return redirect()->route('products.index')
                         ->with('success', 'Thêm sản phẩm thành công!');
    }

    /**
     * Hiển thị chi tiết một sản phẩm.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Hiển thị form cập nhật sản phẩm.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Xử lý cập nhật thông tin sản phẩm.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->except(['image_up', 'document_up']);

        // Xử lý cập nhật Ảnh đại diện
        if ($request->hasFile('image_up')) {
            // Xóa ảnh cũ nếu tồn tại
            if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
                Storage::disk('public')->delete($product->image_path);
            }
            // Lưu ảnh mới
            $data['image_path'] = $request->file('image_up')->store('uploads/products', 'public');
        }

        // Xử lý cập nhật Tài liệu kỹ thuật
        if ($request->hasFile('document_up')) {
            // Xóa tài liệu cũ nếu tồn tại
            if ($product->document_path && Storage::disk('public')->exists($product->document_path)) {
                Storage::disk('public')->delete($product->document_path);
            }
            // Lưu tài liệu mới
            $data['document_path'] = $request->file('document_up')->store('uploads/documents', 'public');
        }

        // Cập nhật dữ liệu vào DB
        $product->update($data);

        return redirect()->route('products.index')
                         ->with('success', 'Cập nhật sản phẩm thành công!');
    }

    /**
     * Xóa sản phẩm (Soft Delete).
     */
    public function destroy(Product $product)
    {
        // Vì trong Model đã dùng SoftDeletes, lệnh này chỉ cập nhật cột deleted_at
        $product->delete();

        return redirect()->route('products.index')
                         ->with('success', 'Đã xóa sản phẩm thành công!');
    }
}