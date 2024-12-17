<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class CandidateAuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('candidate.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:candidates,email',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $candidate = Candidate::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('candidate')->login($candidate);

        return redirect()->route('candidate.dashboard');
    }

    public function showLoginForm()
    {
        return view('candidate.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('candidate')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('/'));
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

 public function logout(Request $request)
{
    Auth::guard('candidate')->logout();
    return redirect()->route('candidate.login');
}

    public function dashboard()
    {
        return view('pages.home');
    }
}
