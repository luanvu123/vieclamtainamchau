<?php
// app/Mail/NewSupportNotification.php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewSupportNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $supportData;

    public function __construct($supportData)
    {
        $this->supportData = $supportData;
    }

    public function build()
    {
        return $this->view('candidate.emails.new-support')
                    ->subject('Thông báo: Yêu cầu tư vấn mới')
                    ->with(['supportData' => $this->supportData]);
    }
}
