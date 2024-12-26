<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $candidateName;
    public $jobTitle;

    public function __construct($candidateName, $jobTitle)
    {
        $this->candidateName = $candidateName;
        $this->jobTitle = $jobTitle;
    }

    public function build()
    {
        return $this->view('candidate.emails_application_submitted')
                    ->subject('Ứng tuyển thành công')
                    ->with([
                        'candidateName' => $this->candidateName,
                        'jobTitle' => $this->jobTitle,
                    ]);
    }
}
