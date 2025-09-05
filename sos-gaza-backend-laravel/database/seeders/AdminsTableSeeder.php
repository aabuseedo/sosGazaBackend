<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'name' => 'مشرف رئيسي',
            'email' => 'admin@sosgaza.com',
            'password' => Hash::make('admin1234'),
        ]);
    }
}
