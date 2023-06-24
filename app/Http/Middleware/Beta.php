<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Beta
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user())
        {
            if(auth()->user()->type == 6)
            {
                return $next($request);
            } elseif(auth()->user()->type == 0)
            {
                return redirect('/profil_kandidat')->with('warning',"Maaf halaman dalam perbaikan");
            } else {
                return redirect()->route('laman');
            }
        } else {
            return redirect()->route('laman');
        }
    }
}
