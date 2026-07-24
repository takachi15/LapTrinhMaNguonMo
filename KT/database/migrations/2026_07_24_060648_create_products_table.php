<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            
            // Khóa ngoại trỏ đến categories.id với cơ chế nullOnDelete
            $table->foreignId('category_id')
                  ->nullable()
                  ->constrained('categories')
                  ->nullOnDelete();

            $table->string('name', 200);
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();
            
            // Đường dẫn ảnh đại diện
            $table->string('image_path')->nullable();
            
            // Đường dẫn tài liệu kỹ thuật/hướng dẫn (PDF/DOCX)
            $table->string('document_path')->nullable();
            
            // Trạng thái sản phẩm
            $table->enum('status', ['draft', 'published'])->default('draft');
            
            $table->softDeletes(); // Thêm cột deleted_at (SoftDeletes)
            $table->timestamps();  // Cột created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};