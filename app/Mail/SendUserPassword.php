<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendUserPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;

//    public $name;

    public function __construct($data)
    {
        $this->data = $data;
        $this->subject = "Доступ для входа в систему IT 2.0 Tools";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Доступ для входа в систему IT 2.0 Tools';
        return $this->view('mail.sendUserPassword')->subject($subject);
    }
}
