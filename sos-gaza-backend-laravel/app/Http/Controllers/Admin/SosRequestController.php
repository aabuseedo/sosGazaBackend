<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SosRequest;
use Illuminate\Http\Request;

class SosRequestController extends Controller
{
    // عرض كل طلبات الطوارئ
    public function index()
    {
        $sosRequests = SosRequest::with('user')->latest()->paginate(20);
        return view('admin.sos_requests.index', compact('sosRequests'));
    }

    // عرض طلب معين
    public function show(SosRequest $sosRequest)
    {
        $sosRequest->load('user');
        return view('admin.sos_requests.show', compact('sosRequest'));
    }

    // تعديل حالة الطلب
    public function edit(SosRequest $sosRequest)
    {
        return view('admin.sos_requests.edit', compact('sosRequest'));
    }

    public function update(Request $request, SosRequest $sosRequest)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,resolved',
        ]);

        $sosRequest->update($validated);

        return redirect()->route('admin.sos-requests.index')
            ->with('success', 'تم تحديث حالة الطلب بنجاح');
    }

    // حذف طلب
    public function destroy(SosRequest $sosRequest)
    {
        $sosRequest->delete();
        return redirect()->route('admin.sos-requests.index')
            ->with('success', 'تم حذف الطلب بنجاح');
    }
}
