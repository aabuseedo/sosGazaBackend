<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SosRequest;

class SosRequestsTableSeeder extends Seeder
{
    public function run()
    {
        SosRequest::create([
            'user_id' => 1,
            'latitude' => 31.5010,
            'longitude' => 34.4665,
            'status' => 'pending',
            'sent_via' => 'internet',
        ]);

        SosRequest::create([
            'user_id' => 2,
            'latitude' => 31.5100,
            'longitude' => 34.4800,
            'status' => 'in_progress',
            'sent_via' => 'sms',
        ]);
    }
}
