<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SuspiciousMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->subject = "Обнаружен подозрительный вход в систему IT 2.0 Tools";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.suspicious');
    }
}