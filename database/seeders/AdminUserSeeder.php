<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if the admin user already exists to avoid duplicates
        if (!User::where('username', 'admin')->exists()) {
            User::create([
                'full_name' => 'Administrator',
                'username' => 'admin',
                'user_email' => 'admin@automate.com',
                'password' => Hash::make('admin'), // Hashes the password securely
                'user_role' => 'admin',
            ]);
        }
    }
}
