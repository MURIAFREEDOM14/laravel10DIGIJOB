<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Kandidat;
use App\Models\Pembayaran;
class prioritas
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $pembayaran = Pembayaran::where('id_kandidat',$kandidat->id_kandidat)->first();
        if ($pembayaran) {
            if ($pembayaran->stats_pembayaran == "sudah dibayar") {
                return $next($request);                            
            } else {
                return redirect('/kandidat')->with('warning',"Maaf kamu belum dapat mengakses fitur ini, Harap tunggu hingga proses selesai");
            }            
        } else {
            return redirect('/kandidat')->with('warning',"Maaf kamu belum dapat mengakses fitur ini, upgrade akunmu sekarang");
        }
    }
}
