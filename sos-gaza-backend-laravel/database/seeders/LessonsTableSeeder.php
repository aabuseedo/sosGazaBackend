<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;

class LessonsTableSeeder extends Seeder
{
    public function run()
    {
        Lesson::create([
            'course_id' => 1,
            'title' => 'إسعاف الجروح البسيطة',
            'description' => 'خطوات تنظيف وتضميد الجروح البسيطة.',
            'video_url' => 'https://www.youtube.com/watch?v=abc123',
            'order' => 1,
        ]);

        Lesson::create([
            'course_id' => 1,
            'title' => 'التعامل مع الحروق',
            'description' => 'طرق الإسعاف الأولي للحروق الطفيفة.',
            'video_url' => 'https://www.youtube.com/watch?v=def456',
            'order' => 2,
        ]);
    }
}
