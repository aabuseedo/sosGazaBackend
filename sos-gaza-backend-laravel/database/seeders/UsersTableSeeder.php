<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'محمد أبو سيف',
            'phone' => '0591234567',
            'password' => Hash::make('password123'),
            'address' => 'غزة - الشجاعية',
            'health_status' => 'سليم',
            'blood_type' => 'O+',
            'emergency_contact' => '0597654321',
            'photo' => null,
        ]);

        User::create([
            'name' => 'سلمى حمد',
            'phone' => '0592345678',
            'password' => Hash::make('12345678'),
            'address' => 'غزة - الرمال',
            'health_status' => 'ضغط',
            'blood_type' => 'A+',
            'emergency_contact' => '0598765432',
            'photo' => null,
        ]);
    }
}
