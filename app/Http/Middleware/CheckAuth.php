<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (empty(session('user'))) {
            return redirect()->route('auth.login')->with('error', 'Нужен профиль на сайте');
        }

        return $next($request);
    }
}
