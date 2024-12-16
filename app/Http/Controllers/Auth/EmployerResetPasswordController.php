<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class EmployerResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/employer/dashboard';

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.employer_passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    protected function guard()
    {
        return Auth::guard('employer');
    }

    protected function broker()
    {
        return Password::broker('employers');
    }
}
