<?php

namespace App\Http\Controllers;

use App\Models\RegisterStudy;
use App\Models\StudyAbroad;
use Illuminate\Http\Request;

class RegisterStudyController extends Controller
{
    /**
     * Hiển thị danh sách đăng ký du học.
     */
    public function index()
    {
        $registerStudies = RegisterStudy::with('studyAbroad')->paginate(10);
        return view('admin.register_study.index', compact('registerStudies'));
    }

    /**
     * Hiển thị form tạo đăng ký du học mới.
     */
    public function create()
    {
        $studyAbroads = StudyAbroad::where('status', 1)->get();
        return view('admin.register_study.create', compact('studyAbroads'));
    }

    /**
     * Lưu đăng ký du học mới.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'study_abroad_id' => 'required|exists:study_abroads,id',
            'notes' => 'nullable|string',
        ]);

        RegisterStudy::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'study_abroad_id' => $request->study_abroad_id,
            'status' => 'pending',
            'notes' => $request->notes,
        ]);

        return redirect()->route('register-study.index')->with('success', 'Đăng ký thành công!');
    }

    /**
     * Hiển thị chi tiết một đăng ký.
     */
    public function show(RegisterStudy $registerStudy)
    {
        return view('admin.register_study.show', compact('registerStudy'));
    }

    /**
     * Hiển thị form chỉnh sửa đăng ký.
     */
    public function edit(RegisterStudy $registerStudy)
    {
        $studyAbroads = StudyAbroad::where('status', 1)->get();
        return view('admin.register_study.edit', compact('registerStudy', 'studyAbroads'));
    }

    /**
     * Cập nhật đăng ký du học.
     */
    public function update(Request $request, RegisterStudy $registerStudy)
    {
        $request->validate([
            'status' => 'required|in:pending,completed',
            'notes' => 'nullable|string',
        ]);

        $registerStudy->update([
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        return redirect()->route('register-study.index')->with('success', 'Cập nhật thành công!');
    }

    /**
     * Xóa đăng ký du học.
     */
    public function destroy(RegisterStudy $registerStudy)
    {
        $registerStudy->delete();
        return redirect()->route('register-study.index')->with('success', 'Xóa đăng ký thành công!');
    }
}

