<?php

namespace App\Http\Controllers;

use App\Models\LanguageTraining;
use App\Models\Employer;
use App\Models\TypeLanguageTraining;
use Illuminate\Http\Request;

class LanguageTrainingManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Lấy tất cả các khóa học đào tạo ngôn ngữ và quan hệ với nhà tuyển dụng
        $languageTrainings = LanguageTraining::with('employer')->get();

        return view('admin.language_training.index', compact('languageTrainings'));
    }

    public function create()
    {
        // Lấy tất cả nhà tuyển dụng và loại đào tạo ngôn ngữ để sử dụng trong form tạo mới
        $employers = Employer::all();
        $types = TypeLanguageTraining::all();
        return view('admin.language_training.create', compact('employers', 'types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employer_id' => 'required|exists:employers,id',
            'type_language_training_id' => 'required|exists:type_language_trainings,id',
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
        ]);

        $data = $request->all();

        // Xử lý ảnh nếu có
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/language_trainings');
        }

        // Tạo mới LanguageTraining
        LanguageTraining::create($data);

        return redirect()->route('language-training-manage.index')->with('success', 'Khóa học ngôn ngữ đã được tạo!');
    }

    public function edit($id)
    {
        $languageTraining = LanguageTraining::findOrFail($id);
        $employers = Employer::all();
        $types = TypeLanguageTraining::all();

        return view('admin.language_training.edit', compact('languageTraining', 'employers', 'types'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employer_id' => 'required|exists:employers,id',
            'type_language_training_id' => 'required|exists:type_language_trainings,id',
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
        ]);

        $languageTraining = LanguageTraining::findOrFail($id);

        $data = $request->all();

        // Xử lý ảnh nếu có
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($languageTraining->image) {
                \Storage::delete($languageTraining->image);
            }
            $data['image'] = $request->file('image')->store('images/language_trainings');
        }

        // Cập nhật LanguageTraining
        $languageTraining->update($data);

        return redirect()->route('language-training-manage.index')->with('success', 'Khóa học ngôn ngữ đã được cập nhật!');
    }

    public function destroy($id)
    {
        $languageTraining = LanguageTraining::findOrFail($id);

        // Xóa ảnh nếu có
        if ($languageTraining->image) {
            \Storage::delete($languageTraining->image);
        }

        $languageTraining->delete();

        return redirect()->route('language-training-manage.index')->with('success', 'Khóa học ngôn ngữ đã được xóa!');
    }
}
