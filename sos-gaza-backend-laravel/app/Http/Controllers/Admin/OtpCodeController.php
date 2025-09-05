<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OtpCode;
use Illuminate\Http\Request;

class OtpCodeController extends Controller
{
    public function index()
    {
        $otpCodes = OtpCode::latest()->paginate(20);
        return view('admin.otp_codes.index', compact('otpCodes'));
    }

    public function create()
    {
        return view('admin.otp_codes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|string|max:20',
            'code' => 'required|string|max:6',
            'expires_at' => 'required|date',
        ]);

        OtpCode::create($validated);

        return redirect()->route('admin.otp_codes.index')
            ->with('success', 'تم إنشاء الكود بنجاح');
    }

    public function edit(OtpCode $otpCode)
    {
        return view('admin.otp_codes.edit', compact('otpCode'));
    }

    public function update(Request $request, OtpCode $otpCode)
    {
        $validated = $request->validate([
            'phone' => 'required|string|max:20',
            'code' => 'required|string|max:6',
            'expires_at' => 'required|date',
        ]);

        $otpCode->update($validated);

        return redirect()->route('admin.otp_codes.index')
            ->with('success', 'تم تحديث الكود بنجاح');
    }

    public function destroy(OtpCode $otpCode)
    {
        $otpCode->delete();
        return redirect()->route('admin.otp_codes.index')
            ->with('success', 'تم حذف الكود بنجاح');
    }
}
