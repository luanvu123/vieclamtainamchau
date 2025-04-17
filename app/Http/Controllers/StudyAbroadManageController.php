<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\StudyAbroad;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;

class StudyAbroadManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $studyAbroads = StudyAbroad::with('employer')->latest()->get();
        return view('admin.study_abroad.index', compact('studyAbroads'));
    }

    public function create()
    {
        $categories = Category::where('status', 'active')->get();
        $countries = Country::where('status', 'active')->get();
        return view('admin.study_abroad.create', compact('categories', 'countries'));
    }

    public function edit($id)
    {
        $studyAbroad = StudyAbroad::with(['categories', 'countries'])->findOrFail($id);
        $categories = Category::where('status', 'active')->get();
        $countries = Country::where('status', 'active')->get();
        return view('admin.study_abroad.edit', compact('studyAbroad', 'categories', 'countries'));
    }


    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads', 'public');
        }
       

        $studyAbroad = StudyAbroad::create($data);
        $studyAbroad->categories()->sync($request->categories);
        $studyAbroad->countries()->sync($request->countries);

        return redirect()->route('study-abroad-manage.index')->with('success', 'Đã thêm thành công!');
    }

    public function update(Request $request, $id)
    {
        $studyAbroad = StudyAbroad::findOrFail($id);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads', 'public');
        }

        $studyAbroad->update($data);
        $studyAbroad->categories()->sync($request->categories);
        $studyAbroad->countries()->sync($request->countries);

        return redirect()->route('study-abroad-manage.index')->with('success', 'Đã cập nhật thành công!');
    }

    public function destroy(StudyAbroad $studyAbroad)
    {
        $studyAbroad->delete();
        return back()->with('success', 'Đã xóa!');
    }
}
