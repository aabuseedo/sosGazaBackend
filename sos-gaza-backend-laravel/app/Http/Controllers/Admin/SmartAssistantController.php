<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SmartAssistant;
use Illuminate\Http\Request;

class SmartAssistantController extends Controller
{
    // عرض جميع النصائح
    public function index()
    {
        $assistants = SmartAssistant::latest()->paginate(15);
        return view('admin.smart_assistants.index', compact('assistants'));
    }

    // إظهار نموذج إنشاء نصيحة جديدة
    public function create()
    {
        return view('admin.smart_assistants.create');
    }

    // حفظ النصيحة الجديدة
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        SmartAssistant::create($validated);

        // تصحيح اسم route
        return redirect()->route('admin.smart-assistants.index')
            ->with('success', 'تم إنشاء النصيحة بنجاح');
    }

    // عرض نصيحة محددة
    public function show(SmartAssistant $smart_assistant)
    {
        return view('admin.smart_assistants.show', [
            'assistant' => $smart_assistant
        ]);
    }

    // إظهار نموذج تعديل نصيحة
    public function edit(SmartAssistant $smart_assistant)
    {
        return view('admin.smart_assistants.edit', [
            'assistant' => $smart_assistant
        ]);
    }

    // تحديث النصيحة
    public function update(Request $request, SmartAssistant $smart_assistant)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $smart_assistant->update($validated);

        // تصحيح اسم route
        return redirect()->route('admin.smart-assistants.index')
            ->with('success', 'تم تحديث النصيحة بنجاح');
    }

    // حذف النصيحة
    public function destroy(SmartAssistant $smart_assistant)
    {
        $smart_assistant->delete();

        // تصحيح اسم route
        return redirect()->route('admin.smart-assistants.index')
            ->with('success', 'تم حذف النصيحة بنجاح');
    }
}
