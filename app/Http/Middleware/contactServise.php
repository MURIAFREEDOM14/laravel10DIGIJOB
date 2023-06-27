<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class contactServise
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()){
            if(auth()->user()->type == 4){
                return $next($request);
            } else {
                return redirect()->route('laman');
            }
        } else {
            return redirect()->route('laman');
        }
    }
}
