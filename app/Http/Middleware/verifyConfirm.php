<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class verifyConfirm
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()) 
        {
            if(auth()->user()->verify_confirmed == null){
                return $next($request);
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/laman');
        }
    }
}
