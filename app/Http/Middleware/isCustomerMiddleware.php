<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isCustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and has the "is_admin" role
        if (Auth::check() && Auth::user()->is_admin == false) {
            // If the user is an admin, allow access to the "/admin" route
            return $next($request);
        }

        // If the user is not an admin, deny access to the "/admin" route
        return redirect()->route('home')->with('error', 'Access to /admin is denied.');
    }
}
