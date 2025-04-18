<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceWeek;
use App\Models\Typeservice;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:service-list|service-create|service-edit|service-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:service-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:service-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:service-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

   public function create()
{
    $typeservices = Typeservice::where('status', 'active')->get();
    return view('admin.services.create', compact('typeservices'));
}



public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png',
        'price' => 'required|numeric|min:0',
        'description' => 'nullable|string',
        'status' => 'required|in:active,inactive',
        'number_of_weeks' => 'required|array',
        'number_of_weeks.*' => 'in:1,2,4',
        'typeservice_id' => 'required|exists:typeservices,id',

    ]);

    $data = $request->except('number_of_weeks');
$data['typeservice_id'] = $request->typeservice_id;
    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('services', 'public');
    }

    $service = Service::create($data);

    foreach ($request->number_of_weeks as $week) {
        ServiceWeek::create([
            'service_id' => $service->id,
            'number_of_weeks' => $week,
        ]);
    }

    return redirect()->route('services.index')->with('success', 'Service created successfully.');
}


   public function edit(Service $service)
{
    $typeservices = Typeservice::where('status', 'active')->get();
    return view('admin.services.edit', compact('service', 'typeservices'));
}


public function update(Request $request, Service $service)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png',
        'price' => 'required|numeric|min:0',
        'description' => 'nullable|string',
        'status' => 'required|in:active,inactive',
        'number_of_weeks' => 'nullable|array',
        'number_of_weeks.*' => 'in:1,2,4',
        'typeservice_id' => 'required|exists:typeservices,id',

    ]);

$data = $request->only(['name', 'price', 'description', 'status', 'typeservice_id']);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('services', 'public');
    }

    $service->update($data);

    // Cập nhật số tuần: xóa cũ - thêm mới
    $service->weeks()->delete();
    if ($request->has('number_of_weeks')) {
        foreach ($request->number_of_weeks as $week) {
            $service->weeks()->create(['number_of_weeks' => $week]);
        }
    }

    return redirect()->route('services.index')->with('success', 'Dịch vụ đã được cập nhật.');
}

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }
}
