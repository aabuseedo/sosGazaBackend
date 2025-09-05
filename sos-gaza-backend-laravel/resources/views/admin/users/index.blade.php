@extends('admin.layout')
@section('title','المستخدمين')
@section('content')
<h4 class="mb-3">قائمة المستخدمين</h4>

<a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">إضافة مستخدم</a>

<div class="content-card p-3">
    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>الاسم</th>
                <th>الهاتف</th>
                <th>العنوان</th>
                <th>الحالة الصحية</th>
                <th>فصيلة الدم</th>
                <th>صورة</th>
                <th>خيارات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->address ?? '-' }}</td>
                    <td>{{ $user->health_status }}</td>
                    <td>{{ $user->blood_type ?? '-' }}</td>
                    <td>
                        @if($user->photo)
                            <img src="{{ asset('storage/'.$user->photo) }}" alt="user" width="50" height="50" class="rounded-circle">
                        @else
                            —
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">لا يوجد مستخدمين</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $users->links() }}
</div>
@endsection
