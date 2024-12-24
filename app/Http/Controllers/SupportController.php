<?php

namespace App\Http\Controllers;

use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|string|max:15',
            'email' => 'required|email',
            'type_title' => 'required|string|max:255',
            'description-info' => 'required|string|max:500',
        ]);

        Support::create([
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'type_title' => $validated['type_title'],
            'description_info' => $validated['description-info'],
            'status' => 'pending',
        ]);

        return response()->json(['message' => 'Thông tin tư vấn đã được gửi thành công.'], 200);
    }
}
