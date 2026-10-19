<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@aroma.com'],
            [
                'name' => 'Aroma Admin',
                'phone' => '9999999999',
                'password' => Hash::make('Admin@12345'),
                'address' => 'Rajkot, Gujarat, India',
                'role' => 'admin',
            ]
        );
    }
}