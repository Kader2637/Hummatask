<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProjectStatus
{
    public function handle($request, Closure $next)
{
    if ($request->project->deskripsi !== null) {
        return $next($request);
    }
    
    return back()->with('tolak', 'Tolong lengkapi deskripsi terlebih dahulu');
}

}
