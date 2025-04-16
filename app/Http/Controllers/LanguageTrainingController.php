<?php
namespace App\Http\Controllers;

use App\Models\CandidateLanguageTraining;
use App\Models\LanguageTraining;
use App\Models\TypeLanguageTraining;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LanguageTrainingController extends Controller
{
    public function __construct()
    {
        $this->middleware('employer');
    }

  public function index()
{
    $employerId = Auth::guard('employer')->id();

    $languageTrainings = LanguageTraining::with('candidateRegistrations.candidate') // load candidate luôn
        ->where('employer_id', $employerId)
        ->get();

    return view('employer.languagetrainings.index', compact('languageTrainings'));
}


    public function create()
    {
        $types = TypeLanguageTraining::where('status', true)->get();
        return view('employer.languagetrainings.create', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type_language_training_id' => 'required|exists:type_language_training,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'name',
            'type_language_training_id',
            'start_date',
            'end_date',
            'description',
        ]);

        $data['slug'] = Str::slug($request->name) . '-' . uniqid();
        $data['employer_id'] = Auth::guard('employer')->id();
        $data['status'] = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('language_trainings', 'public');
        }

        LanguageTraining::create($data);

        return redirect()->route('employer.languagetrainings.index')->with('success', 'Tạo thành công khóa đào tạo ngôn ngữ!');
    }

    public function edit(LanguageTraining $languagetraining)
    {
        $this->authorizeEmployer($languagetraining);

        $types = TypeLanguageTraining::where('status', true)->get();
        return view('employer.languagetrainings.edit', compact('languagetraining', 'types'));
    }

    public function update(Request $request, LanguageTraining $languagetraining)
    {
        $this->authorizeEmployer($languagetraining);

        $request->validate([
            'name' => 'required|string|max:255',
            'type_language_training_id' => 'required|exists:type_language_training,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'name',
            'type_language_training_id',
            'start_date',
            'end_date',
            'description',
        ]);

        $data['slug'] = Str::slug($request->name) . '-' . uniqid();
        $data['status'] = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('language_trainings', 'public');
        }

        $languagetraining->update($data);

        return redirect()->route('employer.languagetrainings.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy(LanguageTraining $languagetraining)
    {
        $this->authorizeEmployer($languagetraining);
        $languagetraining->delete();

        return redirect()->route('employer.languagetrainings.index')->with('success', 'Đã xóa thành công!');
    }

    private function authorizeEmployer(LanguageTraining $training)
    {
        if ($training->employer_id !== Auth::guard('employer')->id()) {
            abort(403);
        }
    }
    public function showCandidates($id)
{
    $training = LanguageTraining::with('candidateRegistrations')->findOrFail($id);

    // Optional: Kiểm tra quyền employer
    if ($training->employer_id != Auth::guard('employer')->id()) {
        abort(403);
    }

    return view('employer.languagetrainings.candidates', compact('training'));
}
public function destroyCandidateRegistration($id)
{
    $registration = CandidateLanguageTraining::findOrFail($id);

    // Kiểm tra quyền: chỉ employer tạo khóa học đó mới được xoá
    $training = $registration->training;
    if ($training->employer_id !== Auth::guard('employer')->id()) {
        abort(403, 'Bạn không có quyền xóa đăng ký này');
    }

    $registration->delete();

    return redirect()->back()->with('success', 'Xóa đăng ký thành công');
}
}

