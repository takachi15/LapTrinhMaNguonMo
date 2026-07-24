<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductAdminController extends Controller
{
    /**
     * Danh sách sản phẩm + Bộ lọc nâng cao + Phân trang
     */
    public function index(Request $request)
    {
        $query = Product::with('category');

        // 1. Lọc theo từ khóa tên
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        // 2. Lọc theo danh mục
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 3. Lọc theo trạng thái
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Phân trang 5 sản phẩm/trang
        $products = $query->orderBy('id', 'asc')->paginate(5);
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Form thêm mới
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Lưu sản phẩm mới
     */
    public function store(ProductRequest $request)
    {
        // Lấy dữ liệu đã qua kiểm tra hợp lệ
        $data = $request->validated();

        // Xử lý upload Ảnh đại diện
        if ($request->hasFile('image_up')) {
            $data['image_path'] = $request->file('image_up')->store('products/images', 'public');
        }

        // Xử lý upload File tài liệu
        if ($request->hasFile('document_up')) {
            $data['document_path'] = $request->file('document_up')->store('products/documents', 'public');
        }

        // Lưu vào CSDL
        Product::create($data);

        return redirect()->route('admin.products.index')->with('ok', 'Thêm mới sản phẩm thành công!');
    }

    /**
     * Form cập nhật - Truyền thêm $request để lấy trang hiện tại
     */
    public function edit(Request $request, Product $product)
    {
        $categories = Category::all();
        // Lấy toàn bộ tham số truy vấn trên URL (như page, keyword, category_id, status)
        $queryParams = $request->query();

        return view('admin.products.edit', compact('product', 'categories', 'queryParams'));
    }

    /**
     * Cập nhật sản phẩm & Quay về đúng trang cũ
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();

        // 1. Xử lý XÓA Ảnh nếu người dùng tick chọn "Xóa ảnh này"
        if ($request->boolean('delete_image')) {
            if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
                Storage::disk('public')->delete($product->image_path);
            }
            $data['image_path'] = null;
        }
        // Ngược lại nếu người dùng TẢI MỚI Ảnh lên
        elseif ($request->hasFile('image_up')) {
            if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
                Storage::disk('public')->delete($product->image_path);
            }
            $data['image_path'] = $request->file('image_up')->store('products/images', 'public');
        }

        // 2. Xử lý XÓA Tài liệu nếu người dùng tick chọn "Xóa tài liệu này"
        if ($request->boolean('delete_document')) {
            if ($product->document_path && Storage::disk('public')->exists($product->document_path)) {
                Storage::disk('public')->delete($product->document_path);
            }
            $data['document_path'] = null;
        }
        // Ngược lại nếu người dùng TẢI MỚI File lên
        elseif ($request->hasFile('document_up')) {
            if ($product->document_path && Storage::disk('public')->exists($product->document_path)) {
                Storage::disk('public')->delete($product->document_path);
            }
            $data['document_path'] = $request->file('document_up')->store('products/documents', 'public');
        }

        $product->update($data);

        $redirectUrl = $request->input('redirect_to', route('admin.products.index'));

        return redirect($redirectUrl)->with('ok', 'Cập nhật sản phẩm thành công!');
    }

    /**
     * Xóa mềm (Soft Delete) - Chuyển sản phẩm vào thùng rác (không xóa tệp ngay)
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->back()->with('ok', 'Đã chuyển sản phẩm vào thùng rác!');
    }

    /**
     * Tải tệp tài liệu đính kèm an toàn bằng Storage::download()
     */
    public function downloadDocument($id)
    {
        $product = Product::withTrashed()->findOrFail($id);

        if ($product->document_path && Storage::disk('public')->exists($product->document_path)) {
            // Lấy đường dẫn tuyệt đối tới file trong ổ đĩa
            $filePath = storage_path('app/public/' . $product->document_path);
            return response()->download($filePath);
        }

        return redirect()->back()->with('error', 'Tệp tài liệu không tồn tại hoặc đã bị xóa!');
    }

    /**
     * Màn hình Thùng rác (Danh sách sản phẩm đã xóa tạm)
     */
    public function trash(Request $request)
    {
        $query = Product::onlyTrashed()->with('category');

        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        $products = $query->orderBy('deleted_at', 'desc')->paginate(5)->withQueryString();

        return view('admin.products.trash', compact('products'));
    }

    /**
     * Khôi phục sản phẩm từ thùng rác
     */
    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->route('admin.products.trash')->with('ok', 'Đã khôi phục sản phẩm thành công!');
    }

    /**
     * Xóa vĩnh viễn sản phẩm & dọn dẹp triệt để tệp vật lý trong storage
     */
    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);

        // Xóa hẳn tệp ảnh vật lý trong storage
        if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
            Storage::disk('public')->delete($product->image_path);
        }

        // Xóa hẳn tệp tài liệu vật lý trong storage
        if ($product->document_path && Storage::disk('public')->exists($product->document_path)) {
            Storage::disk('public')->delete($product->document_path);
        }

        // Xóa bản ghi khỏi CSDL
        $product->forceDelete();

        return redirect()->route('admin.products.trash')->with('ok', 'Đã xóa vĩnh viễn sản phẩm và tệp đính kèm!');
    }
    public function importCsv(Request $request)
    {
        // 1. Validate file đẩy lên
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:5120',
        ], [
            'csv_file.required' => 'Vui lòng chọn file CSV!',
            'csv_file.mimes'    => 'Định dạng file phải là .csv!',
            'csv_file.max'      => 'Dung lượng file không được vượt quá 5MB!',
        ]);

        try {
            $file = $request->file('csv_file');

            // Mở file CSV để đọc
            $handle = fopen($file->getRealPath(), 'r');

            // Bỏ qua dòng đầu tiên (Header / Dòng tiêu đề cột)
            fgetcsv($handle, 10000, ',');

            $importedCount = 0;

            // 2. Đọc từng dòng dữ liệu trong file CSV
            while (($data = fgetcsv($handle, 10000, ',')) !== FALSE) {
                // Kiểm tra nếu dòng có tên sản phẩm (cột 1)
                if (!empty($data[1])) {
                    Product::create([
                        'category_id'   => !empty($data[0]) ? (int)$data[0] : 1,
                        'name'          => trim($data[1]),
                        'price'         => !empty($data[2]) ? (float)$data[2] : 0,
                        'description'   => isset($data[3]) ? trim($data[3]) : null,
                        'image_path'    => isset($data[4]) && !empty(trim($data[4])) ? trim($data[4]) : null,
                        'document_path' => isset($data[5]) && !empty(trim($data[5])) ? trim($data[5]) : null,
                        'status'        => isset($data[6]) && in_array(trim($data[6]), ['published', 'draft']) ? trim($data[6]) : 'published',
                    ]);
                    $importedCount++;
                }
            }

            fclose($handle);

            return redirect()->route('admin.products.index')->with('success', "Đã thêm thành công {$importedCount} sản phẩm từ file CSV!");
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra khi nhập file CSV: ' . $e->getMessage());
        }
    }
}
