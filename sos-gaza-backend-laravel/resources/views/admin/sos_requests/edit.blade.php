@extends('admin.layout')
@section('title','تعديل حالة طلب الطوارئ SOS')
@section('content')
<h4 class="mb-3">تعديل حالة طلب الطوارئ</h4>

<div class="content-card p-4">
    <form action="{{ route('admin.sos-requests.update', $sosRequest->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">الحالة الحالية</label>
            <select name="status" class="form-select" required>
                <option value="pending" {{ $sosRequest->status == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                <option value="in_progress" {{ $sosRequest->status == 'in_progress' ? 'selected' : '' }}>قيد التنفيذ</option>
                <option value="resolved" {{ $sosRequest->status == 'resolved' ? 'selected' : '' }}>تم الحل</option>
            </select>
        </div>

        <div class="mb-3">
            <strong>محتوى الطلب / وصف الحالة:</strong>
            <p>{{ $sosRequest->content ?? 'لا يوجد محتوى إضافي' }}</p>
        </div>

        <button type="submit" class="btn btn-primary">تحديث الحالة</button>
        <a href="{{ route('admin.sos-requests.index') }}" class="btn btn-light border">رجوع</a>
    </form>
</div>
@endsection
