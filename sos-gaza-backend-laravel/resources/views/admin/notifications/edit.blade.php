@extends('admin.layout')
@section('title','تعديل إشعار')
@section('content')
<h4 class="mb-3">تعديل إشعار: {{ $notification->title }}</h4>
<div class="content-card p-4">
<form action="{{ route('admin.notifications.update',$notification) }}" method="POST" enctype="multipart/form-data" class="row g-3">
@csrf @method('PUT')
<div class="col-12">
<label class="form-label">العنوان</label>
<input type="text" name="title" class="form-control" value="{{ old('title',$notification->title) }}" required>
</div>
<div class="col-12">
<label class="form-label">النص</label>
<textarea name="body" rows="5" class="form-control" required>{{ old('body',$notification->body) }}</textarea>
</div>
<div class="col-md-6">
<label class="form-label">الجهة المرسلة (اختياري)</label>
<input type="text" name="sender" class="form-control" value="{{ old('sender',$notification->sender) }}">
</div>
<div class="col-md-6">
<label class="form-label">الصورة (اختياري)</label>
<input type="file" name="image" class="form-control" accept="image/*">
@if($notification->image)
<div class="mt-2">
<img src="{{ Storage::url($notification->image) }}" alt="image" class="rounded" style="max-height: 80px">
</div>
@endif
</div>
<div class="col-md-6">
<label class="form-label">وقت البداية</label>
<input type="datetime-local" name="start_at" class="form-control"
value="{{ old('start_at', optional(\Carbon\Carbon::parse($notification->start_at))->format('Y-m-d\TH:i')) }}" required>
</div>
<div class="col-md-6">
<label class="form-label">وقت الانتهاء</label>
<input type="datetime-local" name="end_at" class="form-control"
value="{{ old('end_at', optional(\Carbon\Carbon::parse($notification->end_at))->format('Y-m-d\TH:i')) }}" required>
</div>
<div class="col-md-6">
<label class="form-label">الحالة</label>
<select name="status" class="form-select" required>
<option value="active" {{ old('status',$notification->status)=='active'?'selected':'' }}>فعال</option>
<option value="expired" {{ old('status',$notification->status)=='expired'?'selected':'' }}>منتهي</option>
</select>
</div>
<div class="col-12 d-flex gap-2">
<button class="btn btn-primary" type="submit">تحديث</button>
<a class="btn btn-light border" href="{{ route('admin.notifications.index') }}">رجوع</a>
</div>
</form>
</div>
@endsection