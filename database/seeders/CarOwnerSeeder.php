<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CarOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if the car owner user already exists to avoid duplicates
        if (!User::where('username', 'carowner')->exists()) {
            User::create([
                'full_name' => 'hazeeq al fonso',
                'username' => 'hazeeq',
                'user_email' => 'hazeeq@automate.com',
                'password' => Hash::make('hazeeq'),
                'user_role' => 'car_owner',
            ]);
        }
    }
}
