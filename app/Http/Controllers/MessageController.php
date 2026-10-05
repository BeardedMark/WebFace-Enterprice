<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AntibotService;

use App\Mail\MessageMail;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function send(Request $request)
    {
        AntibotService::check($request);

        $email = $request['email'] ?: $this->etp->GetBaseData()['email'];

        Mail::to($email)->send(new MessageMail($request));

        return back()->with('success', 'Сообщение отправлено нам на почту. Мы дадим обратную связь по указанным вами контакатам');
    }
}
