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
use App\Models\Pembayaran;
use App\Models\CreditPerusahaan;
use Carbon\Carbon;

class MessagerController extends Controller
{
    public function messageKandidat()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $semua_pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->get();
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
        return view('kandidat/hapus_pesan',compact('kandidat','pesan','notif','pengirim','id'));
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

    public function messagePerusahaan()
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();        
        $semua_pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->get();
        return view('perusahaan/semua_pesan',compact('perusahaan','notif','pesan','credit','semua_pesan'));
    }

    public function sendMessagePerusahaan($id)
    {
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('referral_code',$auth->referral_code)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->where('check_click',"n")->get();
        messagePerusahaan::where('id',$id)->update([
            'check_click' => 'y',
        ]);
        $pengirim = messagePerusahaan::where('id',$id)->first();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->where('check_click',"n")->get();
        return view('perusahaan/hapus_pesan',compact('perusahaan','pesan','notif','pengirim','credit','id'));
    }

    public function deleteMessagePerusahaan($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $hapus_pesan = messagePerusahaan::where('id',$id)->delete();
        return redirect('/perusahaan/semua_pesan')->with('success',"Pesan telah dihapus");
    }
}
