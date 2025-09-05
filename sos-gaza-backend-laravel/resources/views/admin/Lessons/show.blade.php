@extends('admin.layout')
@section('title','تفاصيل درس')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">تفاصيل الدرس</h4>
    <div class="d-flex gap-2">
        <a class="btn btn-primary" href="{{ route('admin.lessons.edit',$lesson) }}">تعديل</a>
        <a class="btn btn-light border" href="{{ route('admin.courses.show',$lesson->course_id) }}">رجوع للكورس</a>
    </div>
</div>
<div class="content-card p-4">
    <div class="row g-4">
        <div class="col-md-8">
            <h5 class="mb-2">{{ $lesson->title }}</h5>
            <div class="mb-2 text-muted">الترتيب: {{ $lesson->order }}</div>
            <p class="mb-0">{!! nl2br(e($lesson->description)) !!}</p>
        </div>
        <div class="col-md-4">
            <div class="mb-2 text-muted">رابط الفيديو:</div>
            <a href="{{ $lesson->video_url }}" target="_blank">{{ $lesson->video_url }}</a>
        </div>
    </div>
</div>
@endsection
