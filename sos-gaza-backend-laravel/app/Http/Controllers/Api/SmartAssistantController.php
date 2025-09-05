<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SmartAssistant;
use Illuminate\Http\Request;

class SmartAssistantController extends Controller
{
    // عرض جميع النصائح
    public function index()
    {
        $assistants = SmartAssistant::all(['id', 'title']); // بس العناوين
        return response()->json($assistants);
    }

    // عرض تفاصيل نصيحة معينة
    public function show($id)
    {
        $assistant = SmartAssistant::find($id);

        if (!$assistant) {
            return response()->json(['message' => 'Assistant not found'], 404);
        }

        return response()->json($assistant); // بيرجع title + description
    }
}
