<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {

        $guards = empty($guards) ? [null] : $guards;

        if (auth()->check()) {
            return auth()->user()->peran_id == 1 ? redirect()->intended(route('dashboard.mentor')) : redirect()->intended(route('dashboard.siswa'));
        }
        // foreach ($guards as $guard) {
        //     if (Auth::check()) {
        //         return back();
        //     } else if (Auth::guard($guard)->check()) {
        //         return Auth::user()->peran_id == 1 ? redirect()->intended(route('dashboard.mentor')) : redirect()->intended(route('dashboard.siswa'));
        //     }
        // }
        return $next($request);
    }
}
