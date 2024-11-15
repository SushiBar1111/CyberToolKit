<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->role === 'admin') {
            return $next($request); // Jika admin, lanjutkan request
        }

        // Jika bukan admin, beri error
        return redirect('dashboard')->with('status','IHHH BUKAN ATMIN');
    }
}
