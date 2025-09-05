<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    // عرض الدروس التابعة لكورس معيّن
    public function byCourse(Course $course)
    {
        $lessons = $course->lessons()->orderBy('order')->orderBy('id')->paginate(20);
        return view('admin.lessons.index', compact('lessons', 'course'));
    }

    // عرض الفورم لإضافة درس جديد
    public function create(Request $request)
    {
        $courses = Course::orderBy('title')->get();
        return view('admin.lessons.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id'   => 'required|exists:courses,id',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'video_url'   => 'required|string|max:255',
        ]);

        // تحديد ترتيب الدرس تلقائيًا
        $maxOrder = Lesson::where('course_id', $validated['course_id'])->max('order');
        $validated['order'] = $maxOrder ? $maxOrder + 1 : 1;

        $lesson = Lesson::create($validated);

        $course = $lesson->course;
        $course->status = 'active';
        $course->save();

        return redirect()
            ->route('admin.lessons.byCourse', $validated['course_id'])
            ->with('success', 'تم إنشاء الدرس بنجاح');
    }

    public function show(Lesson $lesson)
    {
        $lesson->load('course');
        return view('admin.lessons.show', compact('lesson'));
    }

    public function edit(Lesson $lesson)
    {
        $courses = Course::orderBy('title')->get();
        return view('admin.lessons.edit', compact('lesson', 'courses'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $validated = $request->validate([
            'course_id'   => 'required|exists:courses,id',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'video_url'   => 'required|string|max:255',
            'order'       => 'nullable|integer|min:1',
        ]);

        $lesson->update($validated);

        $course = $lesson->course;
        $course->status = $course->lessons()->count() > 0 ? 'active' : 'inactive';
        $course->save();

        return redirect()
            ->route('admin.lessons.byCourse', $validated['course_id'])
            ->with('success', 'تم تحديث الدرس بنجاح');
    }

    public function destroy(Lesson $lesson)
    {
        $courseId = $lesson->course_id;
        $lesson->delete();

        $course = Course::find($courseId);
        if ($course) {
            $course->status = $course->lessons()->count() > 0 ? 'active' : 'inactive';
            $course->save();
        }

        return redirect()
            ->route('admin.lessons.byCourse', $courseId)
            ->with('success', 'تم حذف الدرس بنجاح');
    }
}
