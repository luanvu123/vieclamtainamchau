<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function countries()
    {
        $countries = Country::where('status', true)->get();
        return view('pages.country', compact('countries'));
    }
}
