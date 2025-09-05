@extends('admin.layout')

@section('title','تعديل النصيحة')
@section('content')

<h4 class="mb-3">تعديل النصيحة</h4>

<div class="content-card p-4">
<form action="{{ route('admin.smart-assistants.update', $assistant) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">العنوان</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $assistant->title) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">الوصف</label>
            <textarea name="description" class="form-control" rows="5" required>{{ old('description', $assistant->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">تحديث</button>
        <a href="{{ route('admin.smart-assistants.index') }}" class="btn btn-light border">رجوع</a>
    </form>
</div>

@endsection
