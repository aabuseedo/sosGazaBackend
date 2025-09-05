@extends('admin.layout')
@section('title','تفاصيل إشعار')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">تفاصيل الإشعار</h4>
    <div class="d-flex gap-2">
        <a class="btn btn-primary" href="{{ route('admin.notifications.edit',$notification) }}">تعديل</a>
                <form action="{{ route('admin.notifications.destroy', $notification) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا الإشعار؟');">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">حذف</button>
        </form>
        <a class="btn btn-light border" href="{{ route('admin.notifications.index') }}">رجوع</a>

    </div>
</div>

<div class="content-card p-4">
    <div class="row g-4">
        <div class="col-md-8">
            <div class="mb-2"><span class="text-muted">العنوان:</span> <span class="fw-bold">{{ $notification->title }}</span></div>
            <div class="mb-2"><span class="text-muted">الجهة:</span> {{ $notification->sender ?? '-' }}</div>
            <div class="mb-2"><span class="text-muted">من:</span> {{ $notification->start_at }} <span class="text-muted ms-2">إلى:</span> {{ $notification->end_at }}</div>
            <div class="mb-2"><span class="text-muted">الحالة:</span>
                @php
                    $now = now();
                    if ($now->lt($notification->start_at)) {
                        $statusText = 'لم يبدأ';
                        $statusClass = 'expired';
                    } elseif ($now->between($notification->start_at, $notification->end_at)) {
                        $statusText = 'فعال';
                        $statusClass = 'active';
                    } else {
                        $statusText = 'منتهي';
                        $statusClass = 'expired';
                    }
                @endphp
                <span class="badge badge-status {{ $statusClass }}">{{ $statusText }}</span>
            </div>
            <hr>
            <div>
                <div class="text-muted mb-2">النص:</div>
                <p class="mb-0">{!! nl2br(e($notification->body)) !!}</p>
            </div>
        </div>
        <div class="col-md-4">
            @if($notification->image)
                <img class="img-fluid rounded border" src="{{ Storage::url($notification->image) }}" alt="notification image">
            @else
                <div class="text-center text-muted">لا توجد صورة</div>
            @endif
        </div>
    </div>
</div>
@endsection
