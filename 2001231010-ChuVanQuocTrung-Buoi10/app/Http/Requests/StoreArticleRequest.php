<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\NoForbiddenWords;

class StoreArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'nullable|image',
        ];
    }
    public function attributes(): array
    {
        return [
            'title' => 'tiêu đề bài viết',
            'body' => 'nội dung chi tiết',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Trường tiêu đề bài viết không được để trống.',
            'body.required' => 'Trường nội dung chi tiết không được để trống.',
        ];
    }
}
