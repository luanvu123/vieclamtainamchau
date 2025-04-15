<?php

// app/Http/Controllers/TypeLanguageTrainingController.php

namespace App\Http\Controllers;

use App\Models\TypeLanguageTraining;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TypeLanguageTrainingController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:type-language-training-list|type-language-training-create|type-language-training-edit|type-language-training-delete', ['only' => ['index', 'store']]);
    //     $this->middleware('permission:type-language-training-create', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:type-language-training-edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:type-language-training-delete', ['only' => ['destroy']]);
    // }

    public function index()
    {
        $types = TypeLanguageTraining::all();
        return view('admin.typeLanguagetrainings.index', compact('types'));
    }

    public function create()
    {
        return view('admin.typeLanguagetrainings.create');
    }

 public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'status' => 'required|boolean'
    ]);

    $requestData = $request->all();
    $requestData['slug'] = Str::slug($request->name);

    TypeLanguageTraining::create($requestData);

    return redirect()->route('typeLanguagetrainings.index')->with('success', 'Tạo thành công.');
}


    public function edit(TypeLanguageTraining $typeLanguagetraining)
    {
        return view('admin.typeLanguagetrainings.edit', compact('typeLanguagetraining'));
    }

  public function update(Request $request, TypeLanguageTraining $typeLanguagetraining)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'status' => 'required|boolean'
    ]);

    $requestData = $request->all();
    $requestData['slug'] = Str::slug($request->name);

    $typeLanguagetraining->update($requestData);

    return redirect()->route('typeLanguagetrainings.index')->with('success', 'Cập nhật thành công.');
}


    public function destroy(TypeLanguageTraining $typeLanguagetraining)
    {
        $typeLanguagetraining->delete();

        return redirect()->route('typeLanguagetrainings.index')->with('success', 'Xoá thành công.');
    }
}
