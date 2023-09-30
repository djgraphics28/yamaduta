<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockAdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Check if the current request is for the "/admin" route
         if ($request->is('admin')) {
            // You can return a response here to deny access
            // For example, redirect to the home page with a message
            return redirect()->route('home')->with('error', 'Access to /admin is denied.');
        }

        // If not accessing the "/admin" route, continue with the request
        return $next($request);
    }
}
