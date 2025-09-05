@extends('admin.layout')
@section('title','إضافة مستخدم')
@section('content')
<h4 class="mb-3">إضافة مستخدم جديد</h4>

<div class="content-card p-4">
    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
        @csrf
        <div class="col-md-6">
            <label class="form-label">الاسم</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">الهاتف</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">كلمة المرور</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">تأكيد كلمة المرور</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">العنوان</label>
            <input type="text" name="address" class="form-control" value="{{ old('address') }}">
        </div>
        <div class="col-md-6">
            <label class="form-label">الحالة الصحية</label>
            <select name="health_status" class="form-select" required>
                <option value="سليم" selected>سليم</option>
                <option value="قلب">قلب</option>
                <option value="ضغط">ضغط</option>
                <option value="سكري">سكري</option>
                <option value="ربو">ربو</option>
                <option value="مرض اخر">مرض اخر</option>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">فصيلة الدم</label>
            <select name="blood_type" class="form-select">
                <option value="">— اختر —</option>
                @foreach(['A+','A-','B+','B-','O+','O-','AB+','AB-','لا أعرف'] as $bt)
                    <option value="{{ $bt }}">{{ $bt }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">رقم الطوارئ</label>
            <input type="text" name="emergency_contact" class="form-control" value="{{ old('emergency_contact') }}">
        </div>
        <div class="col-md-6">
            <label class="form-label">الصورة</label>
            <input type="file" name="photo" class="form-control">
        </div>
        <div class="col-12 d-flex gap-2">
            <button class="btn btn-primary" type="submit">حفظ</button>
            <a class="btn btn-light border" href="{{ route('admin.users.index') }}">رجوع</a>
        </div>
    </form>
</div>
@endsection
