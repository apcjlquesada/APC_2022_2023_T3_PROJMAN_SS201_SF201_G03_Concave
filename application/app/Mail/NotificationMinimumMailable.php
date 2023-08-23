<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificationMinimumMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $allData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($allData)
    {
        $this->allData = $allData;
    }

    public function build()
    {
        $subject = "Attention!";
        return $this->subject($subject)
                    ->view('backend.notification.notification_email');
    }
}
