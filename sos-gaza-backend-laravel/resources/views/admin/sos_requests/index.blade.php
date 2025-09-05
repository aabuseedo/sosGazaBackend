@extends('admin.layout')
@section('title','طلبات الطوارئ SOS')
@section('content')

<h4 class="mb-4">جميع طلبات الطوارئ</h4>

<div class="content-card p-4 shadow-sm border rounded">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-hover align-middle text-center">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>المستخدم</th>
                <th>رقم الهاتف</th>
                <th>الإحداثيات</th>
                <th>طريقة الإرسال</th>
                <th>الحالة</th>
                <th>تاريخ الإنشاء</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sosRequests as $request)
            <tr>
                <td>{{ $request->id }}</td>

                {{-- اسم المستخدم فقط --}}
                <td>{{ $request->user->name }}</td>

                <td>{{ $request->user->phone }}</td>
                <td>{{ $request->latitude }}, {{ $request->longitude }}</td>
                <td>{{ ucfirst($request->sent_via) }}</td>

                {{-- الحالة مع Badges --}}
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

                {{-- الأزرار --}}
                <td class="d-flex justify-content-center gap-1">
                    <a href="{{ route('admin.sos-requests.show', $request->id) }}" class="btn btn-sm btn-light border">عرض</a>
                    <a href="{{ route('admin.sos-requests.edit', $request->id) }}" class="btn btn-sm btn-warning text-dark">تعديل</a>
                    <form action="{{ route('admin.sos-requests.destroy', $request->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف الطلب؟')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">حذف</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center text-muted">لا يوجد طلبات حالياً</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $sosRequests->links() }}
    </div>
</div>

@endsection
