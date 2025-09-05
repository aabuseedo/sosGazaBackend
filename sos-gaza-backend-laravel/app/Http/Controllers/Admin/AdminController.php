<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SosRequest;     // ✅ استيراد الموديل الصحيح
use App\Models\Notification;   // ✅
use App\Models\User;           // اختياري لو بدك تعدّ المستخدمين
use App\Models\Course;         // اختياري لو بدك تعدّ الكورسات


class AdminController extends Controller
{
    public function index()
    {
                // حساب الإحصائيات
        $sosCount   = SosRequest::count();
        $notifCount = Notification::count();
        $courseCount = Course::count(); 
        $userCount   = User::count();

        return view('admin.dashboard', compact('sosCount', 'notifCount', 'courseCount' , 'userCount'));
       /**return view('admin.dashboard'); // نعرض لوحة الأدمن */
    }
}
