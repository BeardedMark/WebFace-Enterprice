<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AntibotService;
use App\Mail\RegistrationMail;
use App\Mail\RestoreMail;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function main(Request $request)
    {
        $userGuid = session('user')['guid'];

        $user = $this->etp->GetUserCard(['guid' => $userGuid]);
        session(['user' => $user]);

        return view('auth.main', compact('user'));
    }

    public function enter(Request $request)
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        AntibotService::check($request);

        $user = $this->etp->LoginUser(['login' => $request['login'], 'password' => $request['password']]);
        session([
            'user' => [
                'guid' => $user['guid']
            ]
        ]);

        return redirect()->route('auth.main')->with('success', 'Вы успешно авторизовались в профиль');
    }

    public function register(Request $request)
    {
        return view('auth.register');
    }

    public function registration(Request $request)
    {
        AntibotService::check($request);
        $params = $request->all();

        $this->etp->RegisterUser(['name' => $request['name'], 'login' => $request['login'], 'password' => $request['password']]);

        $email = $this->etp->GetBaseData()['email'];
        Mail::to($email)->send(new RegistrationMail($params));

        return redirect()->route('auth.login')->with('success', 'Запрос за авторизацию отправлен, менеджер с вами свяжется');
    }

    public function logout(Request $request)
    {
        $request->session()->flush(); // полностью очищает сессию
        return redirect()->route('pages.main')->with('success', 'Вы вышли из профиля');
    }

    public function restore(Request $request)
    {
        return view('auth.restore');
    }

    public function restored(Request $request)
    {
        AntibotService::check($request);
        $params = $request->all();

        $email = $this->etp->GetBaseData()['email'];
        Mail::to($email)->send(new RestoreMail($params));

        return redirect()->route('auth.login')->with('success', 'Напрос на восстановление доступа отправлен. Мы свяжемся с вами по указанным вами контактным данным');
    }
}
