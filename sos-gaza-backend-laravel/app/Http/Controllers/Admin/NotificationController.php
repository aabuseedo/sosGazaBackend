<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::orderBy('created_at', 'asc')->paginate(15);
        return view('admin.notifications.index', compact('notifications'));
    }

    public function create()
    {
        return view('admin.notifications.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'body'     => 'required|string',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sender'   => 'nullable|string|max:100',
            'start_at' => 'required|date',
            'end_at'   => 'required|date|after:start_at',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('notifications', 'public');
        }

        Notification::create($validated);

        return redirect()
            ->route('admin.notifications.index')
            ->with('success', 'تم إنشاء الإشعار بنجاح');
    }

    public function show(Notification $notification)
    {
        return view('admin.notifications.show', compact('notification'));
    }

    public function edit(Notification $notification)
    {
        return view('admin.notifications.edit', compact('notification'));
    }

    public function update(Request $request, Notification $notification)
    {
        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'body'     => 'required|string',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sender'   => 'nullable|string|max:100',
            'start_at' => 'required|date',
            'end_at'   => 'required|date|after:start_at',
        ]);

        if ($request->hasFile('image')) {
            if ($notification->image) {
                Storage::disk('public')->delete($notification->image);
            }
            $validated['image'] = $request->file('image')->store('notifications', 'public');
        }

        $notification->update($validated);

        return redirect()
            ->route('admin.notifications.index')
            ->with('success', 'تم تحديث الإشعار بنجاح');
    }

    public function destroy(Notification $notification)
    {
        if ($notification->image) {
            Storage::disk('public')->delete($notification->image);
        }

        $notification->delete();

        return redirect()
            ->route('admin.notifications.index')
            ->with('success', 'تم حذف الإشعار بنجاح');
    }
}
