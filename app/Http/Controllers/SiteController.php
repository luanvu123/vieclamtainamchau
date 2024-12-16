<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function countries()
    {
        $countries = Country::where('status', true)->get();
        return view('pages.country', compact('countries'));
    }

    public function index()
    {
        $categories = Category::where('status', 'active')->get();
        return view('pages.home', compact('categories'));
    }
}
