<?php

namespace App\Http\Controllers;

use App\Models\messagePerusahaan;
use App\Models\notifyKandidat;
use App\Models\notifyAkademi;
use App\Models\notifyPerusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kandidat;
use App\Models\Akademi;
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

    public function notifyAkademi()
    {
        $id = Auth::user();
        $akademi = Akademi::where('referral_code',$id->referral_code)->first();
        $notif = notifyAkademi::where('id_akademi',$akademi->id_akademi)->limit(3)->get();
        $semua_notif = notifyAkademi::where('id_akademi',$akademi->id_akademi)->get();
        return view('akademi/', compact('notif','pesan','akademi','semua_notif'));
    }

    public function notifyPerusahaan()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('referral_code',$id->referral_code)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $semua_pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        return view('perusahaan/semua_notif',compact('perusahaan','notif','pesan','semua_pesan'));
    }
}
