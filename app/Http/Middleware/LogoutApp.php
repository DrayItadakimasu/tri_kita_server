<?php

namespace App\Http\Middleware;

use App\clients\NotificationFcm;
use Cookie;
use Closure;
use Illuminate\Http\Request;

class LogoutApp
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
        //echo  $request->cookie('key'); echo ' <br>  saved ';
        //echo  $request->cookie('saved_key'); die();

        $response = $next($request);

        if ($fcm = NotificationFcm::where('fcm_token', $request->cookie('saved_key'))->get()->first()) {
            $fcm->delete();
        }

        if ($request->cookie('saved_key'))
            return $response
                ->withCookie(Cookie::forget('saved_key'))
                ->withCookie(Cookie::forget('key'));

        return $response;

    }
}
