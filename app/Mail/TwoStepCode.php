<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TwoStepCode extends Mailable
{
    use Queueable, SerializesModels;
    public $code;
    public $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code, $name)
    {
        $this->code = $code;
        $this->name = $name;
        $this->subject = "Подтверждение входа в систему IT 2.0 Tools";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.twostepEmail');
    }
}
