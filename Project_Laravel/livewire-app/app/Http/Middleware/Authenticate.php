<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

use Illuminate\Auth\Middleware\Authenticate as Middleware;



class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
    public function handle(Request $request, Closure $next): Response
    {
        // if ($this->auth->guest())
        // {
        //     if ($request->ajax())
        //     {
        //         return response('Unauthorized.', 401);
        //     }
        //     else
        //     {
        //         return redirect()->guest('auth/login');
        //     }
        // }
        
        if (!Auth::check()) {
            return redirect()->route('guestSearch');
        }

        return $next($request);
    }

    protected function redirectTo(Request $request)
    {
        // return $request->expectsJson() ? null : route('guestSearch');
    }

}
