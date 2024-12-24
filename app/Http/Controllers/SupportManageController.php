<?php

namespace App\Http\Controllers;

use App\Models\Support;
use Illuminate\Http\Request;

class SupportManageController extends Controller
{
    // Hiển thị danh sách tư vấn
    public function index()
    {
        $supports = Support::all();
        return view('admin.supports.index', compact('supports'));
    }

    // Hiển thị form chỉnh sửa tư vấn
    public function edit($id)
    {
        $support = Support::findOrFail($id);
        return view('admin.supports.edit', compact('support'));
    }

    // Cập nhật thông tin tư vấn
    public function update(Request $request, $id)
    {
        $request->validate([
            'phone' => 'required|string',
            'email' => 'required|email',
            'description_info' => 'required|string',
            'status' => 'required|in:pending,completed',
        ]);

        $support = Support::findOrFail($id);
        $support->update([
            'phone' => $request->phone,
            'email' => $request->email,
            'description_info' => $request->description_info,
            'status' => $request->status,
        ]);

        return redirect()->route('support-manage.index')->with('success', 'Cập nhật tư vấn thành công.');
    }

    // Xóa tư vấn
    public function destroy($id)
    {
        $support = Support::findOrFail($id);
        $support->delete();

        return redirect()->route('support-manage.index')->with('success', 'Xóa tư vấn thành công.');
    }
}
