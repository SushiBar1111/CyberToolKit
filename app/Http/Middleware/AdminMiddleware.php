<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request); // Izinkan akses
        }

        // Jika bukan admin, redirect atau kirim error
        return response()->json(['error' => 'Unauthorized access'], 403);
    }
}

