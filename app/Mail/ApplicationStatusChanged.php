<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $application;
    public $jobPosting;

    public function __construct($application)
    {
        $this->application = $application;
        $this->jobPosting = $application->jobPosting;
    }

    public function build()
    {
        return $this->to($this->application->candidate->email)
            ->subject("Cập nhật trạng thái đơn ứng tuyển")
            ->view('candidate.emails.application-status-changed')
            ->with([
                'candidateName' => $this->application->candidate->name,
                'jobTitle' => $this->jobPosting->title,
                'status' => ucfirst($this->application->status),
            ]);
    }
}
