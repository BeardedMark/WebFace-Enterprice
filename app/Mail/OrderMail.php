<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function build()
    {
        return $this->subject('Новый Заказ')
                    ->view('emails.order');
    }
}
