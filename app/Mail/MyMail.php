<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $massages;
    public $from_email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($massages, $from_email)
    {
        $this->massages = $massages;
        $this->from_email = $from_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this
            ->from($this->from_email)
            ->view('mails.my_mail', ['ivan_mail' => $this->massages]);
    }
}
