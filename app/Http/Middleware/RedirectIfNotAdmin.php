<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
             // Check if the user is authenticated and their type is "admin"
             if (Auth::check() && Auth::user()->type == 'admin') {
                return $next($request);
            }
            // Redirect user to the frontend side if not an admin
            return redirect('/');
    }
}
