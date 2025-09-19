<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\ExtensionService;
use App\Services\AntibotService;
use App\Mail\RegistrationMail;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    protected $extansion;

    public function __construct(ExtensionService $extansion)
    {
        $this->extansion = $extansion;
    }

    public function main(Request $request)
    {
        $userGuid = session('user')['guid'];

        $user = $this->extansion->cardUserByGuid(['guid' => $userGuid]);
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

        $user = $this->extansion->loginUser(['login' => $request['login'], 'password' => $request['password']]);
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

        $email = config('settings.contacts.email');
        Mail::to($email)->send(new RegistrationMail($params));

        return redirect()->route('auth.login');
    }

    public function logout(Request $request)
    {
        $request->session()->flush(); // полностью очищает сессию
        return redirect()->route('pages.main')->with('success', 'Вы вышли из профиля');
    }
}
