@extends('admin.layout')

@section('title','النصائح الذكية')
@section('content')

<h4 class="mb-4">جميع النصائح الذكية</h4>

<div class="content-card p-4">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3 text-end">
        <a href="{{ route('admin.smart-assistants.create') }}" class="btn btn-primary">إنشاء نصيحة جديدة</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>العنوان</th>
                    <th>الوصف</th>
                    <th>تاريخ الإنشاء</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($assistants as $index => $assistant)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $assistant->title }}</td>
                    <td>{{ Str::limit($assistant->description, 50) }}</td>
                    <td>{{ $assistant->created_at ? $assistant->created_at->format('Y-m-d H:i') : '-' }}</td>
                    <td class="d-flex justify-content-center gap-1">
                        <a href="{{ route('admin.smart-assistants.show', $assistant) }}" class="btn btn-sm btn-light border">عرض</a>
                        <a href="{{ route('admin.smart-assistants.edit', $assistant) }}" class="btn btn-sm btn-warning text-dark">تعديل</a>
                        <form action="{{ route('admin.smart-assistants.destroy', $assistant) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف النصيحة؟')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">حذف</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">لا توجد نصائح حالياً</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $assistants->links() }}
    </div>
</div>

@endsection
