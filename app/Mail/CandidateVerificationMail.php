<?php

namespace App\Mail;

use App\Models\Candidate;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CandidateVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $candidate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Candidate $candidate)
    {
        $this->candidate = $candidate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $verificationLink = route('candidate.verify', ['token' => $this->candidate->verification_token]);

        return $this->subject('Xác thực tài khoản của bạn')
                    ->view('candidate.auth.candidate_verification')
                    ->with([
                        'candidateName' => $this->candidate->fullname_candidate,
                        'verificationLink' => $verificationLink,
                    ]);
    }
}

