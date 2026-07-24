<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Xác định xem người dùng có quyền thực hiện request này không.
     */
    public function authorize(): bool
    {
        return true; // Bật true để cho phép request được xử lý
    }

    /**
     * Định nghĩa các quy tắc kiểm soát dữ liệu đầu vào (Validation Rules).
     */
    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:200'],
            'category_id' => ['required', 'exists:categories,id'],
            'price'       => ['required', 'numeric', 'gt:0'],
            'image_up'    => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:20'], 
            'document_up' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:50'],      
            'status'      => ['required', 'in:draft,published'],
        ];
    }

    /**
     * Đặc tả các thông điệp báo lỗi được Việt hóa 100%.
     */
    public function messages(): array
    {
        return [
            // Tên sản phẩm
            'name.required'        => 'Vui lòng nhập tên sản phẩm.',
            'name.string'          => 'Tên sản phẩm phải là chuỗi ký tự.',
            'name.max'             => 'Tên sản phẩm không được vượt quá 200 ký tự.',

            // Danh mục
            'category_id.required' => 'Vui lòng chọn danh mục sản phẩm.',
            'category_id.exists'   => 'Danh mục được chọn không tồn tại trên hệ thống.',

            // Giá sản phẩm
            'price.required'       => 'Vui lòng nhập giá sản phẩm.',
            'price.numeric'        => 'Giá sản phẩm phải là định dạng số.',
            'price.gt'             => 'Giá sản phẩm phải lớn hơn 0.',

            // Ảnh đại diện
            'image_up.image'       => 'Tệp tải lên phải là hình ảnh.',
            'image_up.mimes'       => 'Ảnh đại diện chỉ chấp nhận các định dạng: jpg, png, webp.',
            'image_up.max'         => 'Dung lượng ảnh đại diện không được vượt quá 20KB.',

            // Tài liệu kỹ thuật
            'document_up.file'     => 'Tệp tải lên phải là một tài liệu hợp lệ.',
            'document_up.mimes'    => 'Tài liệu chỉ chấp nhận các định dạng tệp: pdf, doc, docx.',
            'document_up.max'      => 'Dung lượng tài liệu không được vượt quá 50KB.',

            // Trạng thái
            'status.required'      => 'Vui lòng chọn trạng thái sản phẩm.',
            'status.in'            => 'Trạng thái sản phẩm không hợp lệ (chỉ chấp nhận draft hoặc published).',
        ];
    }
}