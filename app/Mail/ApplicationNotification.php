<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $application;

    /**
     * Create a new message instance.
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Ứng viên đã ứng tuyển vào công việc của bạn')
            ->view('employer.emails_application_notification')
            ->with([
                'jobTitle' => $this->application->jobPosting->title,
                'candidateName' => $this->application->candidate->name,
                'cvPath' => asset('storage/' . $this->application->cv_path),
            ]);
    }
}
