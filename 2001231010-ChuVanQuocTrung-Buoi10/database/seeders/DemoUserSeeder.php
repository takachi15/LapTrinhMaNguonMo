<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DemoUserSeeder extends Seeder
{
    public function run(): void
    {
        // Tài khoản User thường
        User::updateOrCreate(
            ['email' => 'demo@huit.edu.vn'],
            [
                'name' => 'Demo User',
                'password' => Hash::make('password123'),
                'is_admin' => 0,
            ]
        );

        // Tài khoản Admin
        User::updateOrCreate(
            ['email' => 'admin@huit.edu.vn'],
            [
                'name' => 'Admin HUIT',
                'password' => Hash::make('password123'),
                'is_admin' => 1,
            ]
        );
    }
}
