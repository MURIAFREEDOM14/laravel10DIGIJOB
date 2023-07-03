<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Perusahaan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()){
            if(auth()->user()->type == 2){
                if(auth()->user()->verify_confirmed !== null)
                {
                    return $next($request);
                } else {
                    return redirect('/verifikasi');
                }
            } else {
                return redirect()->route('laman');
            }
        } else {
            return redirect()->route('laman');
        }
    }
}
