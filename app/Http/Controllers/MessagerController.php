<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use App\Models\messageKandidat;
use App\Models\notifyKandidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\Message;
use App\Models\Perusahaan;
use App\Models\Pembayaran;
use Carbon\Carbon;

class MessagerController extends Controller
{
    public function messageKandidat()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $semuaPesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)
        ->get();
        $pesan = Kandidat::join(
            'message_kandidat', 'kandidat.id_kandidat','=','message_kandidat.id_kandidat'
        )
        ->where('kandidat.id_kandidat',$kandidat->id_kandidat)
        ->limit(3)->get();
        $notif = notifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->get();
        return view('/kandidat/semua_pesan',compact('kandidat','pesan','semuaPesan','notif'));
    }

    public function sendMessageKandidat($id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $notif = Notification::where('id_kandidat',$kandidat->id_kandidat)->get();
        $pengirim = MessageKandidat::where('id',$id)->first();
        $pesan = Kandidat::join(
            'message_kandidat', 'kandidat.id_kandidat','=','message_kandidat.id_kandidat'
        )
        ->where('kandidat.id_kandidat',$kandidat->id_kandidat)
        ->limit(3)->get();
        return view('kandidat/kirim_pesan',compact('kandidat','pesan','notif','pengirim'));
    }

    public function sendMessageConfirmKandidat(Request $request,$id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $pesan = Message::where('id',$id)->first();
        Message::create([
            'id_kandidat'=>$kandidat->id_kandidat,
            'pesan'=>$request->pesan,
            'kepada'=>$pesan->pengirim,
            'pengirim'=>$kandidat->nama,
            'type'=>"0",
        ]);
        return redirect('/semua_pesan')->with('toast_success',"pesan berhasil dikirim");
    }

    public function messagePerusahaan()
    {
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('referral_code',$auth->referral_code)->first();
        $notif = Notification::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $semuaPesan = Message::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $pesan = Message::where('id_perusahaan',$perusahaan->id_Perusahaan)->limit(3)->get();
        return view('perusahaan/semua_pesan',compact('perusahaan','notif','pesan','semuaPesan'));
    }
}
