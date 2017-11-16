<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth as IlluminateAuth;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (IlluminateAuth::guard($guard)->check()) {
            return redirect('/home');
        }

        return $next($request);
    }
}
