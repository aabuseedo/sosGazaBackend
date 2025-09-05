@extends('admin.layout')

@section('title','إنشاء نصيحة جديدة')
@section('content')

<h4 class="mb-3">إنشاء نصيحة جديدة</h4>

<div class="content-card p-4">
    <form action="{{ route('admin.smart-assistants.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">العنوان</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">الوصف</label>
            <textarea name="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">حفظ</button>
        <a href="{{ route('admin.smart-assistants.index') }}" class="btn btn-light border">رجوع</a>
    </form>
</div>

@endsection
