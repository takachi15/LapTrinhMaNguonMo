<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Tạo tài khoản Admin
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Tạo 3 Danh mục sản phẩm mẫu
        $categoriesData = [
            'Điện thoại & Máy tính bảng',
            'Laptop & Máy tính xách tay',
            'Phụ kiện công nghệ',
        ];

        $categories = [];
        foreach ($categoriesData as $catName) {
            $categories[] = Category::create([
                'name' => $catName,
                'slug' => Str::slug($catName),
            ]);
        }

        // 3. Tạo 10 Sản phẩm mẫu
        $sampleProducts = [
            ['name' => 'iPhone 15 Pro Max', 'price' => 29990000.00, 'category_id' => $categories[0]->id, 'status' => 'published'],
            ['name' => 'Samsung Galaxy S24 Ultra', 'price' => 26990000.00, 'category_id' => $categories[0]->id, 'status' => 'published'],
            ['name' => 'iPad Air M2', 'price' => 16490000.00, 'category_id' => $categories[0]->id, 'status' => 'draft'],
            ['name' => 'MacBook Pro 14 M3 Pro', 'price' => 49990000.00, 'category_id' => $categories[1]->id, 'status' => 'published'],
            ['name' => 'Dell XPS 13 Plus', 'price' => 38500000.00, 'category_id' => $categories[1]->id, 'status' => 'published'],
            ['name' => 'ASUS ROG Zephyrus G14', 'price' => 32000000.00, 'category_id' => $categories[1]->id, 'status' => 'draft'],
            ['name' => 'Tai nghe AirPods Pro 2', 'price' => 5990000.00, 'category_id' => $categories[2]->id, 'status' => 'published'],
            ['name' => 'Sạc dự phòng Anker 20000mAh', 'price' => 1200000.00, 'category_id' => $categories[2]->id, 'status' => 'published'],
            ['name' => 'Chuột Logitech MX Master 3S', 'price' => 2450000.00, 'category_id' => $categories[2]->id, 'status' => 'published'],
            ['name' => 'Bàn phím cơ Keychron K2 V2', 'price' => 1850000.00, 'category_id' => $categories[2]->id, 'status' => 'draft'],
        ];

        foreach ($sampleProducts as $productData) {
            Product::create([
                'category_id'   => $productData['category_id'],
                'name'          => $productData['name'],
                'price'         => $productData['price'],
                'description'   => 'Mô tả chi tiết cho sản phẩm ' . $productData['name'],
                'image_path'    => 'uploads/products/sample-image.jpg',
                'document_path' => 'uploads/documents/user-manual.pdf',
                'status'        => $productData['status'],
            ]);
        }
    }
}