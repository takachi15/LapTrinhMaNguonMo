<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Models\Article;

Route::get('/articles/show/{article}', function (Article $article) {
    return "Xem chi tiết bài viết ID: " . $article->id . " - Tiêu đề: " . $article->title;
})->name('articles.show.binding');
Route::resource('articles', ArticleController::class);

Route::get('/', function () {
    return view('welcome');
});
// 1. Route có tham số động
Route::get('/articles/page/{page}', function ($page) {
    return "Trang bài viết số: " . (int)$page;
})->whereNumber('page')->name('articles.page');
// 2. Tham số tuỳ chọn + regex slug
Route::get('/articles/slug/{slug?}', function ($slug = 'khong-co-slug') {
    return "Slug: " . $slug;
})->where('slug', '[a-z0-9-]+');
// 3. Route group với prefix
Route::prefix('admin')->group(function () {
    Route::get('/articles', fn() => 'Quản trị bài viết')
        ->name('admin.articles.index');
});
