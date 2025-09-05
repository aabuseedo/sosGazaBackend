<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SmartAssistant;

class SmartAssistantTableSeeder extends Seeder
{
    public function run()
    {
        SmartAssistant::create([
            'title' => 'أزمة ربو',
            'description' => 'إذا كان لديك أزمة ربو، خذ نفساً عميقاً واستخدم البخاخ المخصص.',
        ]);

        SmartAssistant::create([
            'title' => 'إغماء مفاجئ',
            'description' => 'ضع الشخص مستلقياً وارفع رجليه، واطلب المساعدة الطبية فوراً.',
        ]);
    }
}
