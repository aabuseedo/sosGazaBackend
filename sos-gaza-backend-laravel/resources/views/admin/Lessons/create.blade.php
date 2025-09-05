@extends('admin.layout')
@section('title','إضافة درس')
@section('content')
<h4 class="mb-3">إضافة درس جديد</h4>
<div class="content-card p-4">
    <form action="{{ route('admin.lessons.store') }}" method="POST" class="row g-3">
        @csrf
        <div class="col-md-6">
            <label class="form-label">اختر الكورس</label>
            <select name="course_id" class="form-select" required>
                <option value="" disabled {{ old('course_id', request('course_id')) ? '' : 'selected' }}>— اختر —</option>
                @foreach(\App\Models\Course::orderBy('title')->get() as $c)
                    <option value="{{ $c->id }}" {{ (string)old('course_id', request('course_id')) === (string)$c->id ? 'selected' : '' }}>
                        {{ $c->title }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-12">
            <label class="form-label">العنوان</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>
        <div class="col-12">
            <label class="form-label">الوصف</label>
            <textarea name="description" rows="6" class="form-control" required>{{ old('description') }}</textarea>
        </div>
        <div class="col-12">
            <label class="form-label">رابط الفيديو</label>
            <input type="text" name="video_url" class="form-control" value="{{ old('video_url') }}" required>
        </div>
        <div class="col-12 d-flex gap-2">
            <button class="btn btn-primary" type="submit">حفظ</button>
            <a class="btn btn-light border" href="{{ url()->previous() }}">رجوع</a>
        </div>
    </form>
</div>
@endsection
