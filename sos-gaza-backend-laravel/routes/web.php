<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\SosRequestController;
use App\Http\Controllers\Admin\OtpCodeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SmartAssistantController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| هنا نعرّف جميع Routes الخاصة بالتطبيق
| يمكننا تنظيمها حسب النوع: عامة، أدمن، وغيرها.
*/

// =====================
// Routes عامة
// =====================
Route::get('/', function () {
    return view('welcome');
});

// اختبار مسار
Route::get('/test-route', function() {
    return 'Hello Test';
});

// =====================
// Routes تسجيل دخول الأدمن وخروجه
// =====================
Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'login']);
Route::post('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// =====================
// Routes لوحة تحكم الأدمن - محمية بالـ Guard
// =====================
Route::middleware('auth:admin')->prefix('admin')->group(function() {

    // لوحة تحكم الأدمن
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // إدارة الكورسات
    Route::resource('courses', CourseController::class, ['as' => 'admin']);

    // إدارة الدروس
     Route::resource('lessons', LessonController::class, ['as' => 'admin']); 
    
    // عرض الدروس حسب الكورس
    Route::get('lessons/by-course/{course}', [LessonController::class, 'byCourse'])->name('admin.lessons.byCourse');

    // إدارة الإشعارات
    Route::resource('notifications', NotificationController::class, ['as' => 'admin']);

    // إدارة طلبات الطوارئ SOS
    Route::resource('sos-requests', SosRequestController::class, ['as' => 'admin']);

    // إدارة رموز OTP
    Route::resource('otp-codes', OtpCodeController::class, ['as' => 'admin']);

    // إدارة المستخدمين
    Route::resource('users', UserController::class, ['as' => 'admin']);

    // إدارة المساعد الذكي
    Route::resource('smart-assistants', SmartAssistantController::class, ['as' => 'admin']);
});











