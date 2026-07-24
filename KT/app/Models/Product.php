<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'price',
        'description',
        'image_path',
        'document_path',
        'status',
    ];

    /**
     * Mối quan hệ: Một Product thuộc về một Category (BelongsTo)
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}