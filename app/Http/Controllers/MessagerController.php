<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use App\Models\Akademi;
use App\Models\messageAkademi;
use App\Models\messageKandidat;
use App\Models\messagePerusahaan;
use App\Models\notifyAkademi;
use App\Models\notifyKandidat;
use App\Models\notifyPerusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\Message;
use App\Models\Perusahaan;
use App\Models\PerusahaanCabang;
use App\Models\Pembayaran;
use App\Models\CreditPerusahaan;
use Carbon\Carbon;

class MessagerController extends Controller
{
    public function messageKandidat()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $semua_pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $notif = notifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->where('check_click',"n")->get();
        return view('kandidat/semua_pesan',compact('kandidat','pesan','semua_pesan','notif'));
    }

    public function sendMessageKandidat($id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $notif = NotifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->where('check_click',"n")->get();
        messageKandidat::where('id',$id)->update([
            'check_click' => 'y',
        ]);
        $pengirim = messageKandidat::where('id',$id)->first();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->where('check_click',"n")->get();
        return view('kandidat/kirim_pesan',compact('kandidat','pesan','notif','pengirim','id'));
    }

    public function deleteMessageKandidat($id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $hapus_pesan = messageKandidat::where('id',$id)->delete();
        return redirect('/semua_pesan')->with('success',"Pesan telah dihapus");
    }

    public function messageAkademi()
    {
        $user = Auth::user();
        $akademi = Akademi::where('referral_code',$user->referral_code)->first();
        $pesan = messageAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $semua_pesan = messageAkademi::where('id_akademi',$akademi->id_akademi)->get();
        $notif = notifyAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->where('check_click',"n")->get();
        return view('akademi/semua_pesan',compact('akademi','pesan','semua_pesan','notif'));
    }

    public function sendMessageAkademi($id)
    {
        $auth = Auth::user();
        $akademi = akademi::where('referral_code',$auth->referral_code)->first();
        $notif = notifyAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $pesan = messageAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $pengirim = messageakademi::where('id',$id)->first();
        return view('akademi/kirim_pesan',compact('akademi','pesan','notif','pengirim'));
    }

    public function sendMessagePerusahaan($id)
    {
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('referral_code',$auth->referral_code)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_Perusahaan)->orderBy('created_at','desc')->where('check_click',"n")->get();
        messagePerusahaan::where('id',$id)->update([
            'check_click' => 'y',
        ]);
        $pengirim = messagePerusahaan::where('id',$id)->first();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/kirim_pesan',compact('perusahaan','pesan','notif','pengirim','cabang','credit'));
    }

    public function sendMessageConfirmPerusahaan()
    { 
        return redirect();
    }
}
