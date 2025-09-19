<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $params;
    public $subject;

    public function __construct($params)
    {
        $this->params = $params;
        $this->subject = 'Регистрация нового пользователя';
    }

    public function build()
    {
        return $this->subject($this->subject)
                    ->view('emails.registration');
    }
}
