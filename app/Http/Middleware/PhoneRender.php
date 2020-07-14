<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PhoneRender
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
        if ($request->input('phone')) {
            $del = [' ', '(', ')', '-'];
            $phone = str_replace($del, '', $request->input('phone'));
            $request->merge([
                'phone' => $phone,
            ]);
        }

        return $next($request);
    }
}
