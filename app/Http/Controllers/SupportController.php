<?php

namespace App\Http\Controllers;

use App\Models\Support;
use Illuminate\Http\Request;
use App\Mail\NewSupportNotification;
use Illuminate\Support\Facades\Mail;
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

        // Create support record
        $support = Support::create([
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'type_title' => $validated['type_title'],
            'description_info' => $validated['description-info'],
            'status' => 'pending',
        ]);

        // Send email notification
        try {
            Mail::to('uwkbggegp24060411@vnetwork.io.vn')->send(new NewSupportNotification([
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'type_title' => $validated['type_title'],
                'description_info' => $validated['description-info'],
                'created_at' => $support->created_at->format('d/m/Y H:i:s')
            ]));
        } catch (\Exception $e) {
            \log::error('Failed to send support notification email: ' . $e->getMessage());
        }

        return response()->json(['message' => 'Thông tin tư vấn đã được gửi thành công.'], 200);
    }
}
