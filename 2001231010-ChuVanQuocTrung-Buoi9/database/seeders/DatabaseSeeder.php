<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Category::factory()
            ->count(5)
            ->hasProducts(10)
            ->create();

        $student = Student::firstOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User']
        );

        // 2. Tạo Profile cho sinh viên vừa tạo ở trên
        Profile::firstOrCreate(
            ['student_id' => $student->id],
            [
                'address' => 'Tân Phú, TP. Hồ Chí Minh',
                'phone' => '0987654321'
            ]
        );

        $this->call(StudentCourseSeeder::class);
    }
}