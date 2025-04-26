<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'issuing_organization' => 'nullable|string|max:255',
            'issue_date' => 'nullable|date',
            'expiration_date' => 'nullable|date|after_or_equal:issue_date',
        ]);

        Certificate::create([
            'candidate_id' => Auth::guard('candidate')->id(),
            'name' => $request->name,
            'issuing_organization' => $request->issuing_organization,
            'issue_date' => $request->issue_date,
            'expiration_date' => $request->expiration_date,
        ]);

        return redirect()->route('candidate.profile.edit')->with('success', 'Chứng chỉ đã được thêm thành công.');
    }

    public function update(Request $request, Certificate $certificate)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'issuing_organization' => 'nullable|string|max:255',
            'issue_date' => 'nullable|date',
            'expiration_date' => 'nullable|date|after_or_equal:issue_date',
        ]);

        $certificate->update([
            'name' => $request->name,
            'issuing_organization' => $request->issuing_organization,
            'issue_date' => $request->issue_date,
            'expiration_date' => $request->expiration_date,
        ]);

        return redirect()->route('candidate.profile.edit')->with('success', 'Chứng chỉ đã được cập nhật.');
    }

    public function destroy(Certificate $certificate)
    {
        $certificate->delete();

        return redirect()->route('candidate.profile.edit')->with('success', 'Chứng chỉ đã được xóa.');
    }
}
