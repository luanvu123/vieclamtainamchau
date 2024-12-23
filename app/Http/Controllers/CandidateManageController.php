<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateManageController extends Controller
{
    /**
     * Hiển thị danh sách ứng viên.
     */
    public function index()
    {
        $candidates = Candidate::paginate(10); // Phân trang
        return view('admin.candidates.index', compact('candidates'));
    }

    /**
     * Hiển thị form chỉnh sửa ứng viên.
     */
    public function edit($id)
    {
        $candidate = Candidate::findOrFail($id);
        return view('admin.candidates.edit', compact('candidate'));
    }

    /**
     * Cập nhật thông tin ứng viên.
     */
    public function update(Request $request, $id)
    {
        $candidate = Candidate::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:candidates,email,' . $id,
            'phone' => 'nullable|string|max:15',
        ]);

        $candidate->update($request->all());

        return redirect()->route('candidate-manage.index')->with('success', 'Cập nhật ứng viên thành công.');
    }

    /**
     * Xóa ứng viên.
     */
    public function destroy($id)
    {
        $candidate = Candidate::findOrFail($id);
        $candidate->delete();

        return redirect()->route('candidate-manage.index')->with('success', 'Xóa ứng viên thành công.');
    }
}

