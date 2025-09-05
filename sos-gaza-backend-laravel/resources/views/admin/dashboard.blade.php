@extends('admin.layout')

@section('content')
<div class="row g-4 mb-4">

    <!-- كارد المستخدمين -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="content-card p-4 d-flex justify-content-between align-items-center">
            <div>
                <div class="text-muted">المستخدمين</div>
                <div class="fs-3 fw-bold">{{ $userCount }}</div>
            </div>
            <i class="bi bi-people fs-1 text-success"></i>
        </div>
    </div>
    <!-- كارد طلبات الاستغاثة -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="content-card p-4 d-flex justify-content-between align-items-center">
            <div>
                <div class="text-muted">طلبات الاستغاثة</div>
                <div class="fs-3 fw-bold">{{ $sosCount }}</div>
            </div>
            <i class="bi bi-exclamation-octagon fs-1 text-danger"></i>
        </div>
    </div>

    <!-- كارد الإشعارات -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="content-card p-4 d-flex justify-content-between align-items-center">
            <div>
                <div class="text-muted">الإشعارات</div>
                <div class="fs-3 fw-bold">{{ $notifCount }}</div>
            </div>
            <i class="bi bi-bell fs-1 text-warning"></i>
        </div>
    </div>

    <!-- كارد الكورسات -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="content-card p-4 d-flex justify-content-between align-items-center">
            <div>
                <div class="text-muted">الكورسات</div>
                <div class="fs-3 fw-bold">{{ $courseCount }}</div>
            </div>
            <i class="bi bi-journal-bookmark fs-1 text-primary"></i>
        </div>
    </div>

</div>

<div class="row g-4 mt-1">
    <!-- جدول آخر طلبات الاستغاثة -->
    <div class="col-12 col-xl-8">
        <div class="content-card p-4">
            <h5 class="mb-3">آخر طلبات الاستغاثة</h5>
            <div class="table-responsive">
                <table class="table align-middle mb-0 table-hover text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>المستخدم</th>
                            <th>رقم الهاتف</th>
                            <th>الإحداثيات</th>
                            <th>طريقة الإرسال</th>
                            <th>الحالة</th>
                            <th>تاريخ الإنشاء</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $lastSos = \App\Models\SosRequest::with('user')->latest()->take(6)->get();
                        @endphp
                        @forelse($lastSos as $index => $request)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $request->user->name }}</td>
                                <td>{{ $request->user->phone }}</td>
                                <td>{{ $request->latitude }}, {{ $request->longitude }}</td>
                                <td>{{ ucfirst($request->sent_via) }}</td>
                                <td>
                                    @if($request->status == 'pending')
                                        <span class="badge bg-warning text-dark">قيد الانتظار</span>
                                    @elseif($request->status == 'in_progress')
                                        <span class="badge bg-info text-dark">قيد التنفيذ</span>
                                    @else
                                        <span class="badge bg-success">تم حل الطلب</span>
                                    @endif
                                </td>
                                <td>{{ $request->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.sos-requests.show', $request) }}" class="btn btn-sm btn-outline-primary">عرض</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">لا توجد طلبات استغاثة</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- سريع -->
    <div class="col-12 col-xl-4">
        <div class="content-card p-4">
            <h5 class="mb-3">سريع</h5>
            <div class="d-grid gap-2">
                <a class="btn btn-primary" href="{{ route('admin.notifications.create') }}">
                    <i class="bi bi-plus-lg ms-1"></i> إشعار جديد
                </a>
                <a class="btn btn-outline-primary" href="{{ route('admin.courses.create') }}">
                    <i class="bi bi-plus-lg ms-1"></i> كورس جديد
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
