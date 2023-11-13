<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use function Laravel\Prompts\alert;

class CheckProjectStatus
{
    public function handle($request, Closure $next)
{
    $tim = $request->route('tim');

    if ($tim && $tim->project && $tim->project->deskripsi) {
        return $next($request);
    }
    
    return back()->with('error', 'Tolong lengkapi deskripsi terlebih dahulu', 'Error');
}

}
