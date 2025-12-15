<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RestoreMail extends Mailable
{
    use Queueable, SerializesModels;

    public $params;
    public $subject;

    public function __construct($params)
    {
        $this->params = $params;
        $this->subject = 'Запрос на восстановление доступа';
    }

    public function build()
    {
        return $this->subject($this->subject)
                    ->view('emails.restore');
    }
}
