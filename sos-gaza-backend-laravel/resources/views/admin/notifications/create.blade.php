@extends('admin.layout')
@section('title','إنشاء إشعار')
@section('content')
<h4 class="mb-3">إنشاء إشعار جديد</h4>
<div class="content-card p-4">
<form action="{{ route('admin.notifications.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
@csrf
<div class="col-12">
<label class="form-label">العنوان</label>
<input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
</div>
<div class="col-12">
<label class="form-label">النص</label>
<textarea name="body" rows="5" class="form-control" required>{{ old('body') }}</textarea>
</div>
<div class="col-md-6">
<label class="form-label">الجهة المرسلة (اختياري)</label>
<input type="text" name="sender" class="form-control" value="{{ old('sender') }}">
</div>
<div class="col-md-6">
<label class="form-label">الصورة (اختياري)</label>
<input type="file" name="image" class="form-control" accept="image/*">
</div>
<div class="col-md-6">
<label class="form-label">وقت البداية</label>
<input type="datetime-local" name="start_at" class="form-control" value="{{ old('start_at') }}" required>
</div>
<div class="col-md-6">
<label class="form-label">وقت الانتهاء</label>
<input type="datetime-local" name="end_at" class="form-control" value="{{ old('end_at') }}" required>
</div>
<div class="col-12 d-flex gap-2">
<button class="btn btn-primary" type="submit">حفظ</button>
<a class="btn btn-light border" href="{{ route('admin.notifications.index') }}">رجوع</a>
</div>
</form>
</div>
@endsection
