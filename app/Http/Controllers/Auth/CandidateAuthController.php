<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;

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

     public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Phương thức callback từ Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $candidate = Candidate::where('email', $googleUser->getEmail())->first();

            // Nếu user đã tồn tại
            if ($candidate) {
                Auth::guard('candidate')->login($candidate);
            } else {
                // Nếu user chưa tồn tại, tạo mới
                $candidate = Candidate::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt(uniqid()), // Mật khẩu ngẫu nhiên
                ]);

                Auth::guard('candidate')->login($candidate);
            }

            return redirect()->route('candidate.dashboard');
        } catch (\Exception $e) {
            return redirect()->route('candidate.auth.register')->with('error', 'Đăng ký bằng Google thất bại.');
        }
    }
}
