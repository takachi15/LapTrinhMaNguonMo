<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(10);
       
        return view('products.index', compact('products'));
    }
    public function create()
    {
        return view('products.create');
    }

    // 2. Xử lý lưu dữ liệu thêm mới
    public function store(Request $request)
    {
        // Validate dữ liệu
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            // Thêm category_id nếu bảng bắt buộc
            // 'category_id' => 'required|exists:categories,id' 
        ], [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'price.numeric' => 'Giá phải là số',
        ]);

        Product::create($validatedData);

        return redirect('/products')->with('success', 'Thêm sản phẩm thành công!');
    }

    // 3. Hiển thị form sửa sản phẩm
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // 4. Xử lý cập nhật dữ liệu
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validatedData);

        return redirect('/products')->with('success', 'Cập nhật thành công!');
    }
}
?>