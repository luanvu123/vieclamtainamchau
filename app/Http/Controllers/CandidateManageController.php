<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Mail\CandidateApprovalMail;
use Illuminate\Support\Facades\Mail;


class CandidateManageController extends Controller
{
     public function __construct()
    {
        $this->middleware('permission:candidate-list|candidate-create|candidate-edit|candidate-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:candidate-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:candidate-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:candidate-delete', ['only' => ['destroy']]);
    }
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
        'status' => 'required|integer|in:0,1', // Chỉ cho phép trạng thái 0 hoặc 1
    ]);

    $candidate->update($request->all());

    Mail::to($candidate->email)->send(new CandidateApprovalMail($candidate));

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

