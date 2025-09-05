@extends('admin.layout')
@section('title','تعديل مستخدم')
@section('content')
<h4 class="mb-3">تعديل المستخدم</h4>

<div class="content-card p-4">
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="row g-3">
        @csrf
        @method('PUT')
        <div class="col-md-6">
            <label class="form-label">الاسم</label>
            <input type="text" name="name" class="form-control" value="{{ old('name',$user->name) }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">الهاتف</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone',$user->phone) }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">كلمة المرور (اتركها فارغة إذا لا تريد تغييرها)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="col-md-6">
            <label class="form-label">تأكيد كلمة المرور</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
        <div class="col-md-6">
            <label class="form-label">العنوان</label>
            <input type="text" name="address" class="form-control" value="{{ old('address',$user->address) }}">
        </div>
        <div class="col-md-6">
            <label class="form-label">الحالة الصحية</label>
            <select name="health_status" class="form-select" required>
                @foreach(['سليم','قلب','ضغط','سكري','ربو','مرض اخر'] as $hs)
                    <option value="{{ $hs }}" {{ $user->health_status==$hs ? 'selected':'' }}>{{ $hs }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">فصيلة الدم</label>
            <select name="blood_type" class="form-select">
                <option value="">— اختر —</option>
                @foreach(['A+','A-','B+','B-','O+','O-','AB+','AB-','لا أعرف'] as $bt)
                    <option value="{{ $bt }}" {{ $user->blood_type==$bt ? 'selected':'' }}>{{ $bt }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">رقم الطوارئ</label>
            <input type="text" name="emergency_contact" class="form-control" value="{{ old('emergency_contact',$user->emergency_contact) }}">
        </div>
        <div class="col-md-6">
            <label class="form-label">الصورة الحالية</label><br>
            @if($user->photo)
                <img src="{{ asset('storage/'.$user->photo) }}" alt="user" width="80" class="rounded mb-2">
            @else
                —
            @endif
            <input type="file" name="photo" class="form-control mt-2">
        </div>
        <div class="col-12 d-flex gap-2">
            <button class="btn btn-primary" type="submit">تحديث</button>
            <a class="btn btn-light border" href="{{ route('admin.users.index') }}">رجوع</a>
        </div>
    </form>
</div>
@endsection
