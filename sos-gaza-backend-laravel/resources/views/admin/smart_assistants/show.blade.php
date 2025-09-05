@extends('admin.layout')

@section('title','عرض النصيحة')
@section('content')

<h4 class="mb-3">عرض النصيحة</h4>

<div class="content-card p-4">
    <div class="mb-3">
        <strong>العنوان:</strong>
        <p>{{ $assistant->title }}</p>
    </div>

    <div class="mb-3">
        <strong>الوصف:</strong>
        <p>{{ $assistant->description }}</p>
    </div>

    <div class="mb-3">
        <strong>تاريخ الإنشاء:</strong>
        <p>{{ $assistant->created_at ? $assistant->created_at->format('Y-m-d H:i') : '-' }}</p>
    </div>

    <a href="{{ route('admin.smart-assistants.index') }}" class="btn btn-light border">رجوع</a>
</div>

@endsection
