<?php
namespace App\Http\Controllers;

use App\Models\KeySearch;
use Illuminate\Http\Request;

class KeySearchController extends Controller
{
    public function index()
    {
        $keysearches = KeySearch::all();
        return view('admin.keysearch.index', compact('keysearches'));
    }

    public function create()
    {
        return view('admin.keysearch.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        KeySearch::create($request->only('name', 'url', 'status'));

        return redirect()->route('keysearch.index')->with('success', 'Từ khóa tìm kiếm đã được tạo.');
    }

    public function show(KeySearch $keysearch)
    {
        return view('admin.keysearch.show', compact('keysearch'));
    }

    public function edit(KeySearch $keysearch)
    {
        return view('admin.keysearch.edit', compact('keysearch'));
    }

    public function update(Request $request, KeySearch $keysearch)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $keysearch->update($request->only('name', 'url', 'status'));

        return redirect()->route('keysearch.index')->with('success', 'Từ khóa tìm kiếm đã được cập nhật.');
    }

    public function destroy(KeySearch $keysearch)
    {
        $keysearch->delete();
        return redirect()->route('keysearch.index')->with('success', 'Từ khóa tìm kiếm đã được xóa.');
    }
}
