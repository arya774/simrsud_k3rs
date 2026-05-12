<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     * @param  string[]|null             ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        /*
        |--------------------------------------------------------------------------
        | Default Guard
        |--------------------------------------------------------------------------
        */

        $guards = empty($guards)
            ? [null]
            : $guards;

        /*
        |--------------------------------------------------------------------------
        | Check Authenticated User
        |--------------------------------------------------------------------------
        */

        foreach ($guards as $guard) {

            if (Auth::guard($guard)->check()) {

                /*
                |--------------------------------------------------------------------------
                | Prevent Redirect Loop
                |--------------------------------------------------------------------------
                */

                if ($request->routeIs('dashboard')) {
                    return $next($request);
                }

                /*
                |--------------------------------------------------------------------------
                | Redirect to Dashboard
                |--------------------------------------------------------------------------
                */

                return redirect()->route('dashboard');

            }

        }

        /*
        |--------------------------------------------------------------------------
        | Continue Request
        |--------------------------------------------------------------------------
        */

        return $next($request);
    }
}