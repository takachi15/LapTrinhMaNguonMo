<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'image_path', 'user_id'];

    // Mối quan hệ: Một bài viết thuộc về một User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
