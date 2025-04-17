<?php
namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsManageController extends Controller
{
    // Hiển thị danh sách tất cả tin tức
    public function index()
    {
        $news = News::all();
        return view('admin.news.index', compact('news'));
    }

    // Hiển thị form thêm tin tức
    public function create()
    {
        return view('admin.news.create');
    }

    // Lưu tin tức mới vào database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'description' => 'nullable|string',
            'website' => 'nullable|url',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        $data['employer_id'] = Auth::id(); // hoặc Auth::guard('employer')->id() nếu bạn dùng guard riêng
        News::create($data);

        return redirect()->route('news-manage.index')->with('success', 'Thêm tin tức thành công');
    }

    // Hiển thị form sửa tin tức
    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }

    // Cập nhật tin tức đã có
    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'description' => 'nullable|string',
            'website' => 'nullable|url',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu tồn tại
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }

            $data['image'] = $request->file('image')->store('news', 'public');
        }

        $news->update($data);

        return redirect()->route('news-manage.index')->with('success', 'Cập nhật tin tức thành công');
    }

    // Xóa tin tức
    public function destroy($id)
    {
        $news = News::findOrFail($id);

        // Xóa hình ảnh nếu có
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()->route('news-manage.index')->with('success', 'Xóa tin tức thành công');
    }
    public function show($id)
{
    $news = News::findOrFail($id);
    return view('admin.news.show', compact('news'));
}

}
