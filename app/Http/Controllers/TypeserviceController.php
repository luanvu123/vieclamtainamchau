<?php

namespace App\Http\Controllers;

use App\Models\Typeservice;
use Illuminate\Http\Request;

class TypeserviceController extends Controller
{
    public function index()
    {
        $typeservices = Typeservice::all();
        return view('admin.typeservice.index', compact('typeservices'));
    }

    public function create()
    {
        return view('admin.typeservice.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        Typeservice::create($request->all());

        return redirect()->route('typeservice.index')->with('success', 'Loại dịch vụ được tạo thành công.');
    }

    public function edit(Typeservice $typeservice)
    {
        return view('admin.typeservice.edit', compact('typeservice'));
    }

    public function update(Request $request, Typeservice $typeservice)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $typeservice->update($request->all());

        return redirect()->route('typeservice.index')->with('success', 'Loại dịch vụ được cập nhật thành công.');
    }

    public function destroy(Typeservice $typeservice)
    {
        $typeservice->delete();

        return redirect()->route('typeservice.index')->with('success', 'Loại dịch vụ đã bị xóa.');
    }
}
