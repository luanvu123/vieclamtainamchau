<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'institution_name' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'field_of_study' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        $education = new Education();
        $education->candidate_id = Auth::guard('candidate')->id();
        $education->institution_name = $request->input('institution_name');
        $education->degree = $request->input('degree');
        $education->field_of_study = $request->input('field_of_study');
        $education->start_date = $request->input('start_date');
        $education->end_date = $request->input('end_date');
        $education->description = $request->input('description');
        $education->save();

        return redirect()->route('candidate.profile.edit')->with('success', 'Học vấn đã được thêm thành công.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Education $education)
    {
        if ($education->candidate_id != Auth::guard('candidate')->id()) {
            abort(403, 'Bạn không có quyền chỉnh sửa mục này.');
        }

        $request->validate([
            'institution_name' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'field_of_study' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        $education->institution_name = $request->input('institution_name');
        $education->degree = $request->input('degree');
        $education->field_of_study = $request->input('field_of_study');
        $education->start_date = $request->input('start_date');
        $education->end_date = $request->input('end_date');
        $education->description = $request->input('description');
        $education->save();

        return redirect()->route('candidate.profile.edit')->with('success', 'Học vấn đã được cập nhật.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Education $education)
    {
        if ($education->candidate_id != Auth::guard('candidate')->id()) {
            abort(403, 'Bạn không có quyền xóa mục này.');
        }

        $education->delete();

        return redirect()->route('candidate.profile.edit')->with('success', 'Học vấn đã được xóa.');
    }
}
