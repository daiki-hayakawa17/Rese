<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminAllUsersMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $subjectLine;
    public $bodyMessage;

    public function __construct($user, $subjectLine, $bodyMessage)
    {
        $this->user = $user;
        $this->subjectLine = $subjectLine;
        $this->bodyMessage = $bodyMessage;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subjectLine)
                    ->view('emails.admin_mail');
    }
}
