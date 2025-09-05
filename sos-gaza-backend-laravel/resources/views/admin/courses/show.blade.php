@extends('admin.layout')
@section('title','تفاصيل كورس')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">تفاصيل الكورس</h4>
    <div class="d-flex gap-2">
        <a class="btn btn-primary" href="{{ route('admin.courses.edit',$course) }}">تعديل</a>
        <a class="btn btn-light border" href="{{ route('admin.courses.index') }}">رجوع</a>
    </div>
</div>

<div class="content-card p-4 mb-4">
    <div class="row g-4">
        <div class="col-md-8">
            <h5 class="mb-2">{{ $course->title }}</h5>
            <div class="mb-2">
                الحالة:
                <span class="badge {{ $course->status=='active' ? 'text-bg-success' : 'text-bg-secondary' }}">
                    {{ $course->status=='active'?'فعال':'متوقف' }}
                </span>
            </div>
            <p class="mb-0">{!! nl2br(e($course->description)) !!}</p>
        </div>
        <div class="col-md-4">
            @if($course->image)
                <img class="img-fluid rounded border" src="{{ Storage::url($course->image) }}" alt="course image">
            @else
                <div class="text-muted">لا توجد صورة</div>
            @endif
        </div>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-2">
    <h5 class="mb-0">الدروس</h5>
    <a class="btn btn-outline-primary" href="{{ route('admin.lessons.create', ['course_id' => $course->id]) }}">
        <i class="bi bi-plus-lg ms-1"></i> إضافة درس
    </a>
</div>

<div class="content-card p-3">
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>العنوان</th>
                    <th>الترتيب</th>
                    <th>رابط الفيديو</th>
                    <th class="text-center" style="width: 220px;">إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($course->lessons->sortBy('order') as $index => $lesson)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-medium">{{ $lesson->title }}</td>
                        <td>{{ $lesson->order }}</td>
                        <td class="text-truncate" style="max-width:240px;">
                            <a target="_blank" href="{{ $lesson->video_url }}">{{ $lesson->video_url }}</a>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-light border" href="{{ route('admin.lessons.show',$lesson) }}">عرض</a>
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.lessons.edit',$lesson) }}">تعديل</a>
                            <form action="{{ route('admin.lessons.destroy',$lesson) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا الدرس؟');">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">حذف</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">لا توجد دروس</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
