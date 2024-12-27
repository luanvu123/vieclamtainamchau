<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CountryController extends Controller
{
    public function __construct()
    {
        // Middleware permissions as per your existing code
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
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Generate slug from name
        $slug = $this->generateSlug($request->name);

        $imagePath = $request->file('image')->store('flags', 'public');

        Country::create([
            'name' => $request->name,
            'slug' => $slug,
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
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Generate slug if the name has changed
        $slug = $this->generateSlug($request->name);

        $data = $request->only(['name', 'status']);
        $data['slug'] = $slug;

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

    // Method to generate slug
    private function generateSlug($name)
    {
        $slug = Str::slug($name);
        // Ensure slug is unique by appending a number if necessary
        $count = Country::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }
        return $slug;
    }
}
