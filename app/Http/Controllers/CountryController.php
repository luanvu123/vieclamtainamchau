<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
     public function __construct()
    {
        $this->middleware('permission:country-list|country-create|country-edit|country-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:country-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:country-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:country-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $countries = Country::where('status', 'active')->get();
        return view('admin.countries.index', compact('countries'));
    }

    public function create()
    {
        return view('admin.countries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:countries|max:255',
            'slug' => 'required|unique:countries|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('flags', 'public');

        Country::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $imagePath,
            'status' => $request->status ?? 'active',
        ]);

        return redirect()->route('countries.index')->with('success', 'Country created successfully.');
    }

    public function edit(Country $country)
    {
        return view('admin.countries.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        $request->validate([
            'name' => 'required|max:255|unique:countries,name,' . $country->id,
            'slug' => 'required|max:255|unique:countries,slug,' . $country->id,
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = $request->only(['name', 'slug', 'status']);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('flags', 'public');
            $data['image'] = $imagePath;
        }

        $country->update($data);

        return redirect()->route('countries.index')->with('success', 'Country updated successfully.');
    }

    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->route('countries.index')->with('success', 'Country deleted successfully.');
    }
}

