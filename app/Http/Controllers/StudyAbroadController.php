<?php

namespace App\Http\Controllers;

use App\Models\StudyAbroad;
use App\Models\Category;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudyAbroadController extends Controller
{
    public function index()
    {
        $studyAbroads = StudyAbroad::with(['categories', 'countries'])->get();
        return view('admin.study_abroads.index', compact('studyAbroads'));
    }

    public function create()
    {
        $categories = Category::where('status', true)->get();
        $countries = Country::where('status', true)->get();
        return view('admin.study_abroads.create', compact('categories', 'countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'short_detail' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'status' => 'required|boolean',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            'countries' => 'array',
            'countries.*' => 'exists:countries,id',
        ]);

        $imagePath = $request->hasFile('image') ? $request->file('image')->store('study_abroads', 'public') : null;

        $studyAbroad = StudyAbroad::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'short_detail' => $request->short_detail,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        $studyAbroad->categories()->sync($request->categories);
        $studyAbroad->countries()->sync($request->countries);

        return redirect()->route('study-abroads.index')->with('success', 'Tạo chương trình du học thành công!');
    }





    public function edit($id)
    {
        $studyAbroad = StudyAbroad::findOrFail($id);
        $categories = Category::all();
        $countries = Country::all();

        // Lấy danh sách ID của categories và countries đã chọn
        $selectedCategories = $studyAbroad->categories->pluck('id')->toArray();
        $selectedCountries = $studyAbroad->countries->pluck('id')->toArray();

        return view('admin.study_abroads.edit', compact('studyAbroad', 'categories', 'countries', 'selectedCategories', 'selectedCountries'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'short_detail' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            'countries' => 'array',
            'countries.*' => 'exists:countries,id',
        ]);

        $studyAbroad = StudyAbroad::findOrFail($id);
        $studyAbroad->update($request->except(['image', 'categories', 'countries']));

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('study_abroads', 'public');
            $studyAbroad->update(['image' => $imagePath]);
        }

        // Cập nhật categories và countries
        $studyAbroad->categories()->sync($request->categories);
        $studyAbroad->countries()->sync($request->countries);

        return redirect()->route('study-abroads.index')->with('success', 'Cập nhật chương trình du học thành công.');
    }




    public function destroy(StudyAbroad $studyAbroad)
    {
        $studyAbroad->categories()->detach();
        $studyAbroad->countries()->detach();
        $studyAbroad->delete();

        return redirect()->route('study-abroads.index')->with('success', 'Xóa chương trình du học thành công!');
    }
}
