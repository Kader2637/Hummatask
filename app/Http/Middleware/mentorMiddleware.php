<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class mentorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() && Auth::logout() && auth()->user()->is_login === false) {
            return back();
        } else if (Auth::check() && Auth::user()->peran_id === 2) {
            return $next($request);
        }
        return back()->with('unauthorize', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}
