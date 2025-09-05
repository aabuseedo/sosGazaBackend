<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;

class NotificationsTableSeeder extends Seeder
{
    public function run()
    {
        Notification::create([
            'title' => 'تحذير من العواصف',
            'body' => 'تنبيه لجميع المواطنين: من المتوقع هطول أمطار غزيرة اليوم.',
            'image' => null,
            'sender' => 'Civil Defense',
            'start_at' => now(),
            'end_at' => now()->addDay(),
            'status' => 'active',
        ]);

        Notification::create([
            'title' => 'مركز طبي مفتوح',
            'body' => 'مركز غزة الطبي مفتوح اليوم لتقديم الإسعافات الطارئة.',
            'image' => null,
            'sender' => 'Health Ministry',
            'start_at' => now(),
            'end_at' => now()->addDay(),
            'status' => 'active',
        ]);
    }
}
