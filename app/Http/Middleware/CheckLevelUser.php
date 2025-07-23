<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLevelUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $level
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
<<<<<<< HEAD
        if (!auth()->check() || auth()->user()->level != 1) {
=======
        if (!auth()->check() || !auth()->user()->level == 1) {
>>>>>>> b69a3f4038e55c285e211cca2e2ec313d8bffb3b
            abort(403);
        }
        return $next($request);
    }
}
