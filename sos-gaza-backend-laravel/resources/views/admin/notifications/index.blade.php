@extends('admin.layout')
@section('title','الإشعارات')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">الإشعارات</h4>
    <a href="{{ route('admin.notifications.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg ms-1"></i> إنشاء إشعار</a>
</div>
<div class="content-card p-3">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>العنوان</th>
                    <th>الجهة</th>
                    <th>الفترة</th>
                    <th>الحالة</th>
                    <th class="text-center" style="width: 180px;">إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($notifications as $index => $n)
                <tr>
                    <td>{{ $index + 1 }}</td> <!-- الرقم المتسلسل -->
                    <td class="fw-medium">{{ $n->title }}</td>
                    <td>{{ $n->sender ?? '-' }}</td>
                    <td>
                        <div class="small text-muted">من: {{ $n->start_at }}</div>
                        <div class="small text-muted">إلى: {{ $n->end_at }}</div>
                    </td>
                    <td>
                        @php
                            $now = now();
                            if ($now->lt($n->start_at)) {
                                $statusText = 'لم يبدأ';
                            } elseif ($now->between($n->start_at, $n->end_at)) {
                                $statusText = 'فعال';
                            } else {
                                $statusText = 'منتهي';
                            }
                        @endphp
                        <span class="badge badge-status {{ $statusText == 'فعال' ? 'active' : 'expired' }}">
                            {{ $statusText }}
                        </span>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-sm btn-light border" href="{{ route('admin.notifications.show',$n) }}">عرض</a>
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.notifications.edit',$n) }}">تعديل</a>
                        <form action="{{ route('admin.notifications.destroy',$n) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا الإشعار؟');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">حذف</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted">لا توجد بيانات</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $notifications->links() }}</div>
</div>
@endsection
