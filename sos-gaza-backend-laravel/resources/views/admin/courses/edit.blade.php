@extends('admin.layout')
@section('title','تعديل كورس')
@section('content')
<h4 class="mb-3">تعديل كورس: {{ $course->title }}</h4>
<div class="content-card p-4">
<form action="{{ route('admin.courses.update',$course) }}" method="POST" enctype="multipart/form-data" class="row g-3">
@csrf @method('PUT')
<div class="col-md-8">
<label class="form-label">العنوان</label>
<input type="text" name="title" class="form-control" value="{{ old('title',$course->title) }}" required>
</div>
<div class="col-md-4">
<label class="form-label">الحالة</label>
<select name="status" class="form-select">
<option value="active" {{ old('status',$course->status)=='active'?'selected':'' }}>فعال</option>
<option value="inactive" {{ old('status',$course->status)=='inactive'?'selected':'' }}>متوقف</option>
</select>
</div>
<div class="col-12">
<label class="form-label">الوصف</label>
<textarea name="description" rows="6" class="form-control" required>{{ old('description',$course->description) }}</textarea>
</div>
<div class="col-md-6">
<label class="form-label">صورة الكورس (اختياري)</label>
<input type="file" name="image" class="form-control" accept="image/*">
@if($course->image)
<div class="mt-2"><img src="{{ Storage::url($course->image) }}" class="rounded" style="max-height: 80px"></div>
@endif
</div>
<div class="col-12 d-flex gap-2">
<button class="btn btn-primary" type="submit">تحديث</button>
<a class="btn btn-light border" href="{{ route('admin.courses.index') }}">رجوع</a>
</div>
</form>
</div>
@endsection