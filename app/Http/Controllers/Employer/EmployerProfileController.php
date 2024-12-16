<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EmployerProfileController extends Controller
{
    public function edit()
    {
        $employer = Auth::guard('employer')->user();
        return view('employer.profile.edit', compact('employer'));
    }

    public function update(Request $request)
    {
        $employer = Auth::guard('employer')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'business_license' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
            'detail' => 'nullable|string',
            'scale' => 'nullable|string|max:255',
            'mst' => 'nullable|string|max:50',
        ]);

        $data = $request->except(['logo', 'business_license']);
        $data['slug'] = Str::slug($request->company_name);

        if ($request->hasFile('logo')) {
            if ($employer->logo) {
                Storage::delete($employer->logo);
            }
            $data['logo'] = $request->file('logo')->store('employer/logos');
        }

        if ($request->hasFile('business_license')) {
            if ($employer->business_license) {
                Storage::delete($employer->business_license);
            }
            $data['business_license'] = $request->file('business_license')->store('employer/licenses');
        }

        $employer->update($data);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
