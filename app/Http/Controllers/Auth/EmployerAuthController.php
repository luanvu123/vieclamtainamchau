<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmployerVerificationMail;
use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EmployerAuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('employer.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employers',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:20',
            'company_name' => 'required|string|max:255',
        ]);

        $verificationToken = Str::random(32);

        $employer = Employer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'company_name' => $request->company_name,
            'slug' => Str::slug($request->company_name),
            'status' => 0, // Chưa kích hoạt
            'isVerify' => 0,
            'isVerifyEmail' => 0,
            'verification_token' => $verificationToken, // Sử dụng verification_token
        ]);

        Mail::to($employer->email)->send(new EmployerVerificationMail($employer));

        return redirect()->route('employer.register')
            ->with('success', 'Vui lòng kiểm tra email để xác thực tài khoản của bạn.');
    }


    public function verify($token)
    {
        $employer = Employer::where('verification_token', $token)->first();

        if (!$employer) {
            return redirect()->route('employer.register')->with('error', 'Mã xác thực không hợp lệ.');
        }

        $employer->update([
            'status' => 1, // Kích hoạt tài khoản
            'isVerify' => 1,
            'isVerifyEmail' => 1,
            'verification_token' => null, // Xóa token sau khi xác thực
        ]);

        return redirect()->route('employer.login')->with('success', 'Tài khoản đã được xác thực thành công. Bạn có thể đăng nhập.');
    }


    public function showLoginForm()
    {
        return view('employer.auth.login');
    }

   public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Kiểm tra thông tin đăng nhập
    $employer = Employer::where('email', $credentials['email'])->first();

    // Kiểm tra nếu employer tồn tại và có verification_token khác null
    if ($employer && $employer->verification_token !== null) {
        return back()->withErrors([
            'email' => 'Tài khoản của bạn chưa được xác thực. Vui lòng kiểm tra email để xác thực.',
        ])->withInput($request->only('email', 'remember'));
    }

    // Thêm kiểm tra status của employer
    if (!$employer || $employer->status !== 1) {
        return back()->withErrors([
            'email' => 'Tài khoản của bạn đang chờ xác thực.',
        ])->withInput($request->only('email', 'remember'));
    }

    // Thử đăng nhập
    if (Auth::guard('employer')->attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended(route('employer.job-posting.index'));
    }

    return back()->withErrors([
        'email' => 'Thông tin đăng nhập không chính xác.',
    ])->withInput($request->only('email', 'remember'));
}

    public function logout(Request $request)
    {
        Auth::guard('employer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('employer.login');
    }

}
