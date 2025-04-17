<?php

namespace App\Http\Controllers;

use App\Models\Advertise;
use Illuminate\Http\Request;

class AdvertisesManageController extends Controller
{
    public function index()
    {
        $advertises = Advertise::with('employer')->get();
        return view('admin.advertises.index', compact('advertises'));
    }

    public function create()
    {
        return view('admin.advertises.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'content' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $advertise = new Advertise();
        $advertise->employer_id = auth()->guard('employer')->id();
        $advertise->title = $request->title;
        $advertise->content = $request->content;
        $advertise->status = $request->status;

        if ($request->hasFile('image')) {
            $advertise->image = $request->file('image')->store('advertises');
        }

        $advertise->save();

        return redirect()->route('advertises-manage.index')->with('success', 'Tin tức quảng cáo đã được thêm thành công!');
    }

    public function show($id)
    {
        $advertise = Advertise::findOrFail($id);
        return view('admin.advertises.show', compact('advertise'));
    }

    public function edit($id)
    {
        $advertise = Advertise::findOrFail($id);
        return view('admin.advertises.edit', compact('advertise'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'content' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $advertise = Advertise::findOrFail($id);
        $advertise->title = $request->title;
        $advertise->content = $request->content;
        $advertise->status = $request->status;

        if ($request->hasFile('image')) {
            $advertise->image = $request->file('image')->store('advertises');
        }

        $advertise->save();

        return redirect()->route('advertises-manage.index')->with('success', 'Tin tức quảng cáo đã được cập nhật!');
    }

    public function destroy($id)
    {
        $advertise = Advertise::findOrFail($id);
        $advertise->delete();

        return redirect()->route('advertises-manage.index')->with('success', 'Tin tức quảng cáo đã bị xóa!');
    }
}
