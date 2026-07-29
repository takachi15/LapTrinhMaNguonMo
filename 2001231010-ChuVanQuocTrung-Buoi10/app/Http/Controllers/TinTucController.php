<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TinTuc;

class TinTucController extends Controller
{
    /**
     * Hiển thị danh sách tin tức (có phân trang)
     */
    public function index()
    {
        $dsTin = TinTuc::query()
            ->orderByDesc('ngaydang')
            ->orderByDesc('id')
            ->paginate(9)
            ->withQueryString();

        return view('tintuc.index', compact('dsTin'));
    }

    /**
     * Hiển thị chi tiết bài viết theo id
     */
    public function show($id)
    {
        $tin = TinTuc::findOrFail($id);
        return view('tintuc.chitiet', compact('tin'));
    }
}
