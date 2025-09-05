<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CoursesTableSeeder extends Seeder
{
    public function run()
    {
        Course::create([
            'title' => 'الإسعافات الأولية للمبتدئين',
            'description' => 'تعلم الأساسيات للتعامل مع الطوارئ الطبية البسيطة.',
            'image' => null,
            'status' => 'active',
        ]);

        Course::create([
            'title' => 'الإسعافات أثناء الكوارث',
            'description' => 'كيفية التصرف أثناء الحروب والعواصف والكوارث الطبيعية.',
            'image' => null,
            'status' => 'active',
        ]);
    }
}
