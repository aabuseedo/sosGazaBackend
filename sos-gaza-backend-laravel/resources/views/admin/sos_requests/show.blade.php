@extends('admin.layout')
@section('title','تفاصيل طلب الطوارئ SOS')
@section('content')

<h3 class="mb-4">تفاصيل طلب الطوارئ</h3>

<div class="content-card p-4 shadow-sm border rounded">

    <div class="d-flex gap-4 mb-4 align-items-center">
        {{-- صورة المستخدم --}}
        <div>
            @if($sosRequest->user->photo)
                <img src="{{ asset('storage/' . $sosRequest->user->photo) }}" alt="صورة المستخدم" class="rounded-circle" style="width:120px; height:120px; object-fit:cover; border:1px solid #ccc;">
            @else
                <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center" style="width:120px; height:120px; font-size:36px;">
                    {{ substr($sosRequest->user->name,0,1) }}
                </div>
            @endif
        </div>

        {{-- معلومات المستخدم --}}
        <div>
            <h4 class="mb-2">{{ $sosRequest->user->name }}</h4>
            <p class="mb-1"><strong>رقم الهاتف:</strong> {{ $sosRequest->user->phone }}</p>
            <p class="mb-1"><strong>العنوان:</strong> {{ $sosRequest->user->address ?? 'غير محدد' }}</p>
            <p class="mb-1"><strong>فصيلة الدم:</strong> {{ $sosRequest->user->blood_type ?? 'غير معروف' }}</p>
            <p class="mb-1"><strong>الحالة الصحية:</strong> {{ $sosRequest->user->health_status }}</p>
            <p class="mb-0"><strong>جهة الاتصال للطوارئ:</strong> {{ $sosRequest->user->emergency_contact ?? 'غير محدد' }}</p>
        </div>
    </div>

    <hr>

    {{-- معلومات الطلب --}}
    <div class="mb-3">
        <p><strong>الإحداثيات:</strong> {{ $sosRequest->latitude }}, {{ $sosRequest->longitude }}</p>
        <p><strong>طريقة الإرسال:</strong> {{ ucfirst($sosRequest->sent_via) }}</p>
        <p><strong>الحالة:</strong> 
            @if($sosRequest->status == 'pending')
                <span class="badge bg-warning">قيد الانتظار</span>
            @elseif($sosRequest->status == 'in_progress')
                <span class="badge bg-info">قيد التنفيذ</span>
            @else
                <span class="badge bg-success">تم حل الطلب</span>
            @endif
        </p>
        <p><strong>تاريخ الإنشاء:</strong> {{ $sosRequest->created_at->format('Y-m-d H:i') }}</p>
    </div>

    <hr>

    {{-- محتوى الطلب --}}
    <div class="mb-3">
        <h5>محتوى الطلب / وصف الحالة:</h5>
        <div class="p-3 border rounded bg-light">
            {{ $sosRequest->content ?? 'لا يوجد محتوى إضافي' }}
        </div>
    </div>

    <a href="{{ route('admin.sos-requests.index') }}" class="btn btn-light border mt-3">رجوع</a>

</div>

@endsection
