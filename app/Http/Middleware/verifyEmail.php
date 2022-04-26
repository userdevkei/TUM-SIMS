<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class verifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user()->email_verified_at){
            auth()->logout();

            return redirect()->route('openLogin')->with('success', 'Confirm your email first');
        }
        return $next($request);
    }
}
