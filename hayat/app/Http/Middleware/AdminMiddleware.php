<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'doctor')) {
            return $next($request);
        }

        return redirect('/')->with('error', 'شما دسترسی به این بخش را ندارید');
    }
}
