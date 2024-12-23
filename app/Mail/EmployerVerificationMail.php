<?php
namespace App\Mail;

use App\Models\Employer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmployerVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $employer;

    public function __construct(Employer $employer)
    {
        $this->employer = $employer;
    }

    public function build()
    {
        $verificationLink = route('employer.verify', ['token' => $this->employer->verification_token]);

        return $this->subject('Xác thực tài khoản nhà tuyển dụng')
                    ->view('employer.auth.employer_verification')
                    ->with([
                        'employerName' => $this->employer->name,
                        'verificationLink' => $verificationLink,
                    ]);
    }
}
