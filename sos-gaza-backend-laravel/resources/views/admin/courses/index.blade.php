@extends('admin.layout')
@section('title','الكورسات')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">الكورسات</h4>
    <a href="{{ route('admin.courses.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg ms-1"></i> إنشاء كورس</a>
</div>
<div class="content-card p-3">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>العنوان</th>
                    <th>الحالة</th>
                    <th>عدد الدروس</th>
                    <th class="text-center" style="width: 200px;">إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses as $course)
                <tr>
                    {{-- الرقم التسلسلي --}}
                    <td>{{ $loop->iteration + ($courses->currentPage() - 1) * $courses->perPage() }}</td>

                    <td class="fw-medium">{{ $course->title }}</td>
                    <td>
                        <span class="badge {{ $course->status == 'active' ? 'text-bg-success' : 'text-bg-secondary' }}">
                            {{ $course->status=='active'?'فعال':'متوقف' }}
                        </span>
                    </td>
                    <td>{{ $course->lessons()->count() }}</td>
                    <td class="text-center">
                        <a class="btn btn-sm btn-light border" href="{{ route('admin.courses.show',$course) }}">عرض</a>
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.courses.edit',$course) }}">تعديل</a>
                        <form action="{{ route('admin.courses.destroy',$course) }}" method="POST" class="d-inline" onsubmit="return confirm('حذف هذا الكورس سيحذف الدروس التابعة له، متابعة؟');">
                            @csrf 
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">حذف</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">لا توجد بيانات</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $courses->links() }}</div>
</div>
@endsection
