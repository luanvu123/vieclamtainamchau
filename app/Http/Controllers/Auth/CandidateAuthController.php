<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\CandidateVerificationMail;
class CandidateAuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('candidate.auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:candidates',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Họ và tên không được để trống.',
            'email.required' => 'Email không được để trống.',
            'password.required' => 'Mật khẩu không được để trống.',
            'email.email' => 'Email phải là địa chỉ email hợp lệ.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Tạo mã xác thực ngẫu nhiên
        $verificationToken = Str::random(32);

        // Tạo một bản ghi ứng viên tạm thời với trạng thái chưa kích hoạt
        $candidate = Candidate::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'status' => 0,
            'verification_token' => $verificationToken,
        ]);
        Mail::to($candidate->email)->send(new CandidateVerificationMail($candidate));

        return redirect()->route('candidate.register')->with('success', 'Vui lòng kiểm tra email để xác thực tài khoản.');
    }


    public function verify($token)
    {
        // Tìm ứng viên với mã xác thực
        $candidate = Candidate::where('verification_token', $token)->first();

        if (!$candidate) {
            return redirect()->route('candidate.register')->with('error', 'Mã xác thực không hợp lệ.');
        }

        // Cập nhật trạng thái và xóa mã xác thực
        $candidate->status = 1;
        $candidate->verification_token = null;
        $candidate->save();

        return redirect()->route('candidate.login')->with('success', 'Tài khoản của bạn đã được xác thực thành công.');
    }



   public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    // Thử kiểm tra thông tin đăng nhập của candidate
    if (Auth::guard('candidate')->attempt($credentials)) {
        $candidate = Auth::guard('candidate')->user();

        // Kiểm tra trạng thái của tài khoản
        if ($candidate->status !== 1) {
            Auth::guard('candidate')->logout(); // Đăng xuất ngay lập tức nếu trạng thái không phải là 1
            return redirect()->back()->withInput()->withErrors(['email' => 'Tài khoản của bạn đang chờ xác thực.']);
        }

        // Kiểm tra nếu tài khoản đã xác thực
        if ($candidate->verification_token !== null) {
            Auth::guard('candidate')->logout(); // Đăng xuất nếu chưa xác thực
            return redirect()->back()->withInput()->withErrors(['email' => 'Bạn chưa xác thực tài khoản. Vui lòng kiểm tra email.']);
        }

        // Nếu đã xác thực và trạng thái là 1
        return redirect()->route('/')->with('success', 'Xin chào ' . $candidate->name);
    } else {
        return redirect()->back()->withInput()->withErrors(['email' => 'Thông tin đăng nhập không chính xác']);
    }
}

    public function showLoginForm()
    {
        return view('candidate.auth.login');
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
