<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckModuleRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Check if the user is authenticated
        if (!Auth::check()) {
            return redirect('/login'); // Redirect unauthenticated users
        }

        // 2. Check if the authenticated user's module_role matches the required role
        $requiredRole = (int) $role;

        if (Auth::user()->module_role !== $requiredRole && Auth::user()->module_role !== 3) {
            // Redirect or abort if the role doesn't match
            // Abort with 403 Forbidden is standard for authorization failure
            abort(403, 'Unauthorized access to this module.'); 
        }

        return $next($request);
    }
}