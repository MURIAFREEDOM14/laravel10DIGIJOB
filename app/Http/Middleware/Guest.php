<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Guest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()){
            if(auth()->user()->type == 3){
                return redirect()->route('manager');
            } elseif(auth()->user()->type == 2){
                return redirect()->route('perusahaan');
            } elseif(auth()->user()->type == 1){
                return redirect()->route('akademi');
            } elseif(auth()->user()->type == 0) {
                return redirect()->route('kandidat');
            } else {
                return redirect()->back();
            }
        } else {
            return $next($request);
        }
    }
}
