<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use DB;
use Auth;

class SmsValidate
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {

        // Проверка на верификацию
        if (Auth::user()->phone_verified_at) return redirect('/lk');

        return $next($request);
    }
}
