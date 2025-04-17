<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
  public function index()
    {
        $employerId = Auth::guard('employer')->id();
        $newsList = News::where('employer_id', $employerId)->get();

        return view('employer.news.index', compact('newsList'));
    }

    public function create()
    {
        return view('employer.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image',
            'description' => 'nullable',
            'website' => 'nullable|url',
        ]);

        $data = $request->all();
        $data['employer_id'] = Auth::guard('employer')->id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        News::create($data);

        return redirect()->route('employer.news.index')->with('success', 'Thêm tin tức thành công!');
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);

        if ($news->employer_id !== Auth::guard('employer')->id()) {
            abort(403);
        }

        return view('employer.news.edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        if ($news->employer_id !== Auth::guard('employer')->id()) {
            abort(403);
        }

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        $news->update($data);

        return redirect()->route('employer.news.index')->with('success', 'Cập nhật tin tức thành công!');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);

        if ($news->employer_id !== Auth::guard('employer')->id()) {
            abort(403);
        }

        $news->delete();

        return redirect()->back()->with('success', 'Xóa tin tức thành công!');
    }
}
