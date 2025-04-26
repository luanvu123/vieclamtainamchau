<?php

namespace App\Http\Controllers;

use App\Models\SoftSkill;
use Illuminate\Http\Request;

class SoftSkillController extends Controller
{
    public function index()
    {
        $softSkills = SoftSkill::all();
        return view('admin.softskills.index', compact('softSkills'));
    }

    public function create()
    {
        return view('admin.softskills.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        SoftSkill::create($request->only('name'));

        return redirect()->route('soft-skills.index')->with('success', 'Thêm kỹ năng mềm thành công.');
    }

    public function edit(SoftSkill $softSkill)
    {
        return view('admin.softskills.edit', compact('softSkill'));
    }

    public function update(Request $request, SoftSkill $softSkill)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $softSkill->update($request->only('name'));

        return redirect()->route('soft-skills.index')->with('success', 'Cập nhật thành công.');
    }

    public function destroy(SoftSkill $softSkill)
    {
        $softSkill->delete();
        return redirect()->route('soft-skills.index')->with('success', 'Xoá kỹ năng mềm thành công.');
    }
}
