<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Info;

class InfoController extends Controller
{
    public function edit()
    {
        $info = Info::first(); // Chỉ lấy một bản ghi đầu tiên
        return view('admin.info.edit', compact('info'));
    }
     public function hotline()
    {
        $info = Info::first(); // Chỉ lấy một bản ghi đầu tiên
        return view('admin.info.hotline', compact('info'));
    }


   public function update(Request $request)
{
    $info = Info::first();
    if (!$info) {
        $info = new Info();
    }

    // Kiểm tra và lưu ảnh logo vào storage
    if ($request->hasFile('logo')) {
        $logoPath = $request->file('logo')->store('logos', 'public');
        $info->logo = $logoPath;
    }

    // Cập nhật tất cả các trường khác (trừ logo đã xử lý riêng)
    $info->fill($request->except('logo'));
    $info->save();

    return redirect()->back()->with('success', 'Cập nhật thông tin thành công!');
}

}
