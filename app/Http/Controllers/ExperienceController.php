<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function store(Request $request)
{
    $request->validate([
        'company_name' => 'required|string|max:255',
        'position' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'description' => 'nullable|string',
    ]);

    $experience = new Experience();
    $experience->candidate_id = Auth::guard('candidate')->id();
    $experience->company_name = $request->input('company_name');
    $experience->position = $request->input('position');
    $experience->start_date = $request->input('start_date');
    $experience->end_date = $request->input('end_date');
    $experience->description = $request->input('description');
    $experience->save();

    return redirect()->route('candidate.profile.edit')->with('success', 'Kinh nghiệm đã được thêm thành công.');
}

public function update(Request $request, Experience $experience)
{
    $request->validate([
        'company_name' => 'required|string|max:255',
        'position' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'description' => 'nullable|string',
    ]);

    $experience->company_name = $request->input('company_name');
    $experience->position = $request->input('position');
    $experience->start_date = $request->input('start_date');
    $experience->end_date = $request->input('end_date');
    $experience->description = $request->input('description');
    $experience->save();

    return redirect()->route('candidate.profile.edit')->with('success', 'Kinh nghiệm đã được cập nhật.');
}

public function destroy(Experience $experience)
{
    $experience->delete();
    return redirect()->route('candidate.profile.edit')->with('success', 'Kinh nghiệm đã được xóa.');
}

}
