<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendReservedPassword extends Mailable
{
    use Queueable, SerializesModels;
    public $password;
    public $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($password, $name)
    {
        $this->password = $password;
        $this->name = $name;
        $this->subject = "Резервный пароль";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.reservedPassword');
    }
}
