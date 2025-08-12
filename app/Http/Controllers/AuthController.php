<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\ExtensionService;
use App\Domains\OData\Services\ODataService;

class AuthController extends Controller
{
    protected $extansion;
    protected $odata;
    protected $odataEntity = "Catalog_ВнешниеПользователи";

    public function __construct(ExtensionService $extansion, ODataService $odata)
    {
        $this->extansion = $extansion;
        $this->odata = $odata;
    }

    public function main(Request $request)
    {
        $userGuid = session('user')['guid'];

        $user = $this->extansion->cardUserByGuid(['guid' => $userGuid]);
        session(['user' => $user]);

        $odata = [];//$this->odata->get($this->odataEntity, $user['guid']);
        return view('auth.main', compact('user', 'odata'));
    }

    public function enter(Request $request)
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $user = $this->extansion->loginUser(['login' => $request['login'], 'password' => $request['password']]);
        session([
            'user' => [
                'guid' => $user['guid']
            ]
        ]);

        return redirect()->route('auth.main');
    }

    public function register(Request $request)
    {
        return view('auth.register');
    }

    public function registration(Request $request)
    {
        session([
            'user' => [
                'guid' => '0e062bef-5215-11f0-81b8-3cecef0ccd3c',
                'name' => 'Синельщиков Марк Романович',
            ]
        ]);

        return redirect()->route('auth.main');
    }

    public function logout(Request $request)
    {
        $request->session()->flush(); // полностью очищает сессию
        return redirect()->route('pages.main');
    }
}
