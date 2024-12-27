<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class CandidateForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    protected function broker()
    {
        return Password::broker('candidates');
    }

    public function showLinkRequestForm()
    {
        return view('candidate.auth.forgot-password');
    }
}

