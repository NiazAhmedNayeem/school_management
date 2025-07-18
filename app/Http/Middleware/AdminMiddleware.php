<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check() && auth()->user()->role === 'admin'){
            return $next($request);
        } else {
            // Optionally, you can redirect to a specific route or show an error message
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }
    }
}
