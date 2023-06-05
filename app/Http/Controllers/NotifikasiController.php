<?php

namespace App\Http\Controllers;

use App\Models\notifyKandidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kandidat;
use App\Models\Notification;
use App\Models\Pembayaran;
use App\Models\Perusahaan;
use App\Models\Message;
use Carbon\Carbon;

class NotifikasiController extends Controller
{
    public function notifyKandidat()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $notif = notifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->limit(3)->get();
        $pesan = Kandidat::join(
            'message_kandidat', 'kandidat.id_kandidat','=','message_kandidat.id_kandidat'
        )
        ->where('kandidat.id_kandidat',$kandidat->id_kandidat)->limit(3)->get();
        $pembayaran = Pembayaran::where('id_kandidat',$kandidat->id_kandidat)->first();
        if($pembayaran !== null){
            if ($pembayaran->stats_pembayaran == "sudah dibayar") {
                return view('kandidat/prioritas/semua_notif',compact('kandidat','pembayaran','notif'));
            } else {
                return view('kandidat/semua_notif',compact('kandidat','notif','pembayaran','pesan'));
            }
        } else {
            return view('kandidat/semua_notif',compact('kandidat','notif','pembayaran','pesan'));
        }
    }

    public function notifyPerusahaan()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('referral_code',$id->referral_code)->first();
        $notif = Notification::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $pesan = Message::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        return view('perusahaan/semua_notif',compact('perusahaan','notif','pesan'));
    }
}
