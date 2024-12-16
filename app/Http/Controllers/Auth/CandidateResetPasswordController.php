<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class CandidateResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected function broker()
    {
        return Password::broker('candidates');
    }

    protected function redirectTo()
    {
        return route('candidate.dashboard');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('candidate.auth.passwords_reset')->with([
            'token' => $token,
            'email' => $request->email,
        ]);
    }
}
