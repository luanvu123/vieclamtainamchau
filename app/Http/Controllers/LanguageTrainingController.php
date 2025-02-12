<?php

namespace App\Http\Controllers;

use App\Models\LanguageTraining;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LanguageTrainingController extends Controller
{
    public function index()
    {
        $languageTrainings = LanguageTraining::all();
        return view('admin.language_trainings.index', compact('languageTrainings'));
    }

    public function create()
    {
        return view('admin.language_trainings.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|boolean',
    ]);

    LanguageTraining::create([
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'description' => $request->description,
        'status' => $request->status,
    ]);

    return redirect()->route('language-trainings.index')->with('success', 'Chương trình đào tạo ngôn ngữ đã được thêm thành công.');
}

public function update(Request $request, LanguageTraining $languageTraining)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|boolean',
    ]);

    $languageTraining->update([
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'description' => $request->description,
        'status' => $request->status,
    ]);

    return redirect()->route('language-trainings.index')->with('success', 'Cập nhật thành công.');
}

    public function show(LanguageTraining $languageTraining)
    {
        return view('admin.language_trainings.show', compact('languageTraining'));
    }

    public function edit(LanguageTraining $languageTraining)
    {
        return view('admin.language_trainings.edit', compact('languageTraining'));
    }



    public function destroy(LanguageTraining $languageTraining)
    {
        $languageTraining->delete();
        return redirect()->route('language-trainings.index')->with('success', 'Xóa thành công.');
    }
}
