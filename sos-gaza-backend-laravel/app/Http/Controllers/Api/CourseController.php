<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;

class CourseController extends Controller
{
    // جلب جميع الكورسات
    public function index()
    {
        $courses = Course::all();
        return response()->json($courses);
    }

    // جلب كورس محدد مع الدروس المرتبطة
    public function show($id)
    {
        $course = Course::with('lessons')->findOrFail($id);
        return response()->json($course);
    }
}
