<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OtpCode;

class OtpCodesTableSeeder extends Seeder
{
    public function run()
    {
        OtpCode::create([
            'phone' => '0591234567',
            'code' => '123456',
            'expires_at' => now()->addMinutes(5),
        ]);

        OtpCode::create([
            'phone' => '0592345678',
            'code' => '654321',
            'expires_at' => now()->addMinutes(5),
        ]);
    }
}
