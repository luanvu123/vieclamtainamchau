<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GenreController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:genre-list|genre-create|genre-edit|genre-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:genre-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:genre-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:genre-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $genres = Genre::all();
        return view('admin.genres.index', compact('genres'));
    }

    public function create()
    {
        return view('admin.genres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:genres,slug',
            'status' => 'required|in:active,inactive',
        ]);
        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);

        // Kiểm tra slug trùng
        if (Genre::where('slug', $slug)->exists()) {
            return redirect()->back()->withErrors(['slug' => 'Slug đã tồn tại. Vui lòng chọn tên khác.'])->withInput();
        }
        Genre::create([
            'name' => $request->name,
            'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->name),
            'status' => $request->status,
        ]);

        return redirect()->route('genres.index')->with('success', 'Thể loại đã được tạo thành công.');
    }

    public function show(Genre $genre)
    {
        return view('admin.genres.show', compact('genre'));
    }

    public function edit(Genre $genre)
    {
        return view('admin.genres.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {


        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:genres,slug,' . $genre->id,
            'status' => 'required|in:active,inactive',
        ]);
        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);

        // Kiểm tra slug trùng nhưng không bao gồm bản ghi hiện tại
        if (Genre::where('slug', $slug)->where('id', '!=', $genre->id)->exists()) {
            return redirect()->back()->withErrors(['slug' => 'Slug đã tồn tại. Vui lòng chọn tên khác.'])->withInput();
        }
        $genre->update([
            'name' => $request->name,
            'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->name),
            'status' => $request->status,
             'hot' => $request->hot ?? 1,
        ]);

        return redirect()->route('genres.index')->with('success', 'Thể loại đã được cập nhật.');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();

        return redirect()->route('genres.index')->with('success', 'Thể loại đã được xóa.');
    }
}
