<?php

return [

    'accepted'             => 'Trường :attribute phải được chấp nhận.',
    'active_url'           => 'Trường :attribute không phải là một URL hợp lệ.',
    'after'                => 'Trường :attribute phải là một ngày sau ngày :date.',
    'alpha'                => 'Trường :attribute chỉ có thể chứa các chữ cái.',
    'alpha_dash'           => 'Trường :attribute chỉ có thể chứa chữ cái, số và dấu gạch ngang.',
    'alpha_num'            => 'Trường :attribute chỉ có thể chứa chữ cái và số.',
    'array'                => 'Trường :attribute phải là dạng mảng.',
    'email'                => 'Trường :attribute định dạng email không hợp lệ.',
    'max'                  => [
        'numeric' => 'Trường :attribute không được lớn hơn :max.',
        'file'    => 'Trường :attribute không được lớn hơn :max kilobytes.',
        'string'  => 'Trường :attribute không được vượt quá :max ký tự.',
        'array'   => 'Trường :attribute không được có nhiều hơn :max items.',
    ],

    // Đảm bảo dòng required có cấu trúc chuẩn như thế này:
    'required'             => 'Trường :attribute không được để trống.',

    'attributes' => [
        'title' => 'tiêu đề bài viết',
        'body' => 'nội dung chi tiết',
        'image' => 'hình ảnh minh hoạ',
    ],

];
