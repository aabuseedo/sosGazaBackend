<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class UserApiController extends Controller
{
    // تسجيل مستخدم جديد
    public function register(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|string|max:20|unique:users,phone',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return response()->json([
            'message' => 'تم تسجيل الحساب بنجاح',
            'user' => $user,
            'token' => $user->createToken('mobile')->plainTextToken
        ]);
    }

    // تسجيل الدخول
    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('phone', $request->phone)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'phone' => ['رقم الهاتف أو كلمة المرور غير صحيحة.'],
            ]);
        }

        return response()->json([
            'message' => 'تم تسجيل الدخول بنجاح',
            'user' => $user,
            'token' => $user->createToken('mobile')->plainTextToken
        ]);
    }

    // عرض البروفايل
    public function profile(Request $request)
    {
        return response()->json($request->user());
    }

    // تعديل الملف الشخصي
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'health_status' => 'nullable|in:سليم,قلب,ضغط,سكري,ربو,مرض اخر',
            'blood_type' => 'nullable|in:A+,A-,B+,B-,O+,O-,AB+,AB-,لا أعرف',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $validated['photo'] = $request->file('photo')->store('users', 'public');
        }

        $user->update($validated);

        return response()->json([
            'message' => 'تم تحديث الملف الشخصي',
            'user' => $user
        ]);
    }

    // تعديل رقم الطوارئ
    public function updateEmergency(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'emergency_contact' => 'required|string|max:20',
        ]);

        $user->update(['emergency_contact' => $request->emergency_contact]);

        return response()->json([
            'message' => 'تم تحديث رقم الطوارئ',
            'user' => $user
        ]);
    }

    // تعديل رقم الهاتف
    public function updatePhone(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'phone' => 'required|string|max:20|unique:users,phone,'.$user->id,
        ]);

        $user->update(['phone' => $request->phone]);

        return response()->json([
            'message' => 'تم تحديث رقم الهاتف',
            'user' => $user
        ]);
    }

    // تعديل كلمة المرور
    public function updatePassword(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'كلمة المرور الحالية غير صحيحة'], 422);
        }

        $user->update(['password' => Hash::make($request->new_password)]);

        return response()->json(['message' => 'تم تحديث كلمة المرور']);
    }
}
