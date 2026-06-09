<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Menggunakan null-safe operator agar IDE tahu kita menangani kondisi user belum login
        if ($request->user()?->role !== 'admin') {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
