@extends('admin.layout')

@section('title', 'قائمة الدروس')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">الدروس</h4>
    <a href="{{ route('admin.lessons.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg ms-1"></i> إضافة درس جديد
    </a>
</div>

<div class="content-card p-3">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>العنوان</th>
                    <th>الكورس</th>
                    <th>الترتيب</th>
                    <th>الحالة</th>
                    <th class="text-center">إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lessons as $lesson)
                    <tr>
                        <td>{{ $lesson->id }}</td>
                        <td class="fw-medium">{{ $lesson->title }}</td>
                        <td>{{ $lesson->course ? $lesson->course->title : '-' }}</td>
                        <td>{{ $lesson->order ?? '-' }}</td>
                        <td>
                            <span class="badge {{ $lesson->status == 'active' ? 'text-bg-success' : 'text-bg-secondary' }}">
                                {{ $lesson->status == 'active' ? 'نشط' : 'غير نشط' }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.lessons.show', $lesson->id) }}" class="btn btn-sm btn-light border">عرض</a>
                            <a href="{{ route('admin.lessons.edit', $lesson->id) }}" class="btn btn-sm btn-primary">تعديل</a>
                            <form action="{{ route('admin.lessons.destroy', $lesson->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا الدرس؟');">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">حذف</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">لا توجد بيانات</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $lessons->links() }}
    </div>
</div>
@endsection
