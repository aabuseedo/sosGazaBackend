<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    // عرض جميع الإشعارات
    public function index()
    {
        $notifications = Notification::latest()->get();
        return response()->json($notifications);
    }

    // عرض تفاصيل إشعار محدد
    public function show($id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        return response()->json($notification);
    }
}
