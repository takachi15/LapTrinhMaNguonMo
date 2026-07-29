<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
{
    /**
     * Cho phép request thực thi (việc kiểm tra quyền chính xác đã có Policy xử lý)
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Các quy tắc validate khi cập nhật bài viết
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Vui lòng nhập tiêu đề bài viết.',
            'title.max'      => 'Tiêu đề không được vượt quá 255 ký tự.',
            'body.required'  => 'Vui lòng nhập nội dung bài viết.',
            'image.image'    => 'Tập tin tải lên phải là hình ảnh.',
            'image.mimes'    => 'Hình ảnh phải thuộc định dạng: jpeg, png, jpg, gif.',
            'image.max'      => 'Dung lượng hình ảnh không được vượt quá 2MB.',
        ];
    }
}
