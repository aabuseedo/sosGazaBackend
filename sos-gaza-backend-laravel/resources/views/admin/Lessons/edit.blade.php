@extends('admin.layout')
@section('title','تعديل درس')
@section('content')
<h4 class="mb-3">تعديل درس: {{ $lesson->title }}</h4>
<div class="content-card p-4">
    <form action="{{ route('admin.lessons.update',$lesson) }}" method="POST" class="row g-3">
        @csrf @method('PUT')
        <div class="col-md-6">
            <label class="form-label">اختر الكورس</label>
            <select name="course_id" class="form-select" required>
                @foreach(\App\Models\Course::orderBy('title')->get() as $c)
                    <option value="{{ $c->id }}" {{ (string)old('course_id',$lesson->course_id) === (string)$c->id ? 'selected' : '' }}>{{ $c->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">الترتيب</label>
            <input type="number" min="1" name="order" class="form-control" value="{{ old('order',$lesson->order) }}">
        </div>
        <div class="col-12">
            <label class="form-label">العنوان</label>
            <input type="text" name="title" class="form-control" value="{{ old('title',$lesson->title) }}" required>
        </div>
        <div class="col-12">
            <label class="form-label">الوصف</label>
            <textarea name="description" rows="6" class="form-control" required>{{ old('description',$lesson->description) }}</textarea>
        </div>
        <div class="col-12">
            <label class="form-label">رابط الفيديو</label>
            <input type="text" name="video_url" class="form-control" value="{{ old('video_url',$lesson->video_url) }}" required>
        </div>
        <div class="col-12 d-flex gap-2">
            <button class="btn btn-primary" type="submit">تحديث</button>
            <a class="btn btn-light border" href="{{ route('admin.courses.show',$lesson->course_id) }}">رجوع</a>
        </div>
    </form>
</div>
@endsection
