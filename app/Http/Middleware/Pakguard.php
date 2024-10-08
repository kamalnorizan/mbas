<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Pakguard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // echo 'pakguard checking...';
        // check user dah login atau belum
        // check() -> return true jika user dah login
        if (Auth::check()) {
            // user dah login
            return $next($request);
        } else {
            // user belum login
            return redirect('/login');
        }
    }
}
