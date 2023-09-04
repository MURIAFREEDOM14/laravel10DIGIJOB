<?php

namespace App\Http\Controllers;

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
use App\Models\PerusahaanCabang;
use App\Models\Message;
use App\Models\messageKandidat;
use App\Models\messageAkademi;
use App\Models\messagePerusahaan;
use Carbon\Carbon;
use App\Models\CreditPerusahaan;

class NotifikasiController extends Controller
{
    public function notifyKandidat()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $notif = notifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->limit(3)->where('check_click',"n")->get();
        $semua_notif = notifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->get();
        $pembayaran = Pembayaran::where('id_kandidat',$kandidat->id_kandidat)->first();
        if($pembayaran !== null){
            if ($pembayaran->stats_pembayaran == "sudah dibayar") {
                return view('kandidat/prioritas/semua_notif',compact('kandidat','pembayaran','notif'));
            } else {
                return view('kandidat/semua_notif',compact('kandidat','notif','pembayaran','pesan','semua_notif'));
            }
        } else {
            return view('kandidat/semua_notif',compact('kandidat','notif','pembayaran','pesan','semua_notif'));
        }
    }

    public function lihatNotifKandidat($id)
    {
        $user = Auth::user();
        notifyKandidat::where('id_notify',$id)->update([
            'check_click' => 'y',
        ]);
        $notify_kandidat = notifyKandidat::where('id_notify',$id)->first();
        return redirect($notify_kandidat->url);
    }

    public function notifyAkademi()
    {
        $id = Auth::user();
        $akademi = Akademi::where('referral_code',$id->referral_code)->first();
        $notif = notifyAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $semua_notif = notifyAkademi::where('id_akademi',$akademi->id_akademi)->get();
        $pesan = messageAkademi::where('id_akademi',$akademi->id_akademi)->where('pengirim','not like',$akademi->nama_akademi)->limit(3)->where('check_click',"n")->get();
        return view('akademi/semua_notif', compact('notif','pesan','akademi','semua_notif'));
    }

    public function lihatNotifAkademi($id)
    {
        $user = Auth::user();
        notifyAkademi::where('id_notify',$id)->update([
            'check_click' => 'y',
        ]);
        $notify_akademi = notifyAkademi::where('id_notify',$id)->first();
        return redirect($notify_akademi->url);
    }

    public function notifyPerusahaan()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('referral_code',$id->referral_code)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $semua_notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('pengirim','not like',$perusahaan->nama_perusahaan)->limit(3)->where('check_click',"n")->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/semua_notif',compact('perusahaan','notif','pesan','semua_notif','cabang','credit'));
    }

    public function lihatNotifPerusahaan($id)
    {
        $user = Auth::user();
        notifyPerusahaan::where('id_notify',$id)->update([
            'check_click' => 'y',
        ]);
        $notify_perusahaan = notifyPerusahaan::where('id_notify',$id)->first();
        return redirect($notify_perusahaan->url);
    }
}
