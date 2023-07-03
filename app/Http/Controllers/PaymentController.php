<?php

namespace App\Http\Controllers;

use App\Mail\Payment;
use App\Models\messageKandidat;
use App\Models\notifyKandidat;
use Illuminate\Http\Request;
use App\Models\Kandidat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Notification;
use App\Models\Pembayaran;
use App\Models\Perusahaan;
use App\Models\User;

class PaymentController extends Controller
{
    public function paymentKandidat()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $pembayaran = Pembayaran::where('id_kandidat',$kandidat->id_kandidat)->first();
        $notif = notifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->where('pengirim','not like',$kandidat->nama)->limit(3)->get();
        return view('kandidat/pembayaran',compact('kandidat','notif','pesan','pembayaran'));
    }

    public function kandidatConfirm(Request $request)
    {   
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $payment = 15000;
        $namarec = "Hamepa";
        $nomorec = 4399997272;
        Mail::mailer('payment')->to($kandidat->email)->send(new Payment($kandidat->nama,$payment,'Pembayaran','digijobaccounting@ugiport.com',$payment,$namarec,$nomorec));

        Pembayaran::create([
            'id_kandidat' => $kandidat->id_kandidat,
            'nama_pembayaran' => $kandidat->nama,
            'nominal_pembayaran' => $payment,
            'stats_pembayaran' => "belum dibayar",
            'nik' => $kandidat->nik,
        ]);
        return redirect()->back()->with('success',"Terkonfirmasi");
    }

    public function paymentKandidatCheck(Request $request)
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $pembayaran = $kandidat->nama.time().'.'.$request->foto_pembayaran->extension();
        $request->foto_pembayaran->move('gambar/Kandidat/'.$kandidat->nama.'/Pembayaran/',$pembayaran);
        
        Pembayaran::where('id_kandidat',$kandidat->id_kandidat)->update([
            'foto_pembayaran'=>$pembayaran,
        ]);
        return redirect()->route('kandidat');
    }

    public function pembayaranKandidat()
    {
        $id = Auth::user();
        $manager = User::where('referral_code',$id->referral)->first();
        $pembayaran = Pembayaran::join(
            'kandidat','pembayaran.id_kandidat','=','kandidat.id_kandidat'
        )
        ->where('stats_pembayaran',"belum dibayar")->get();
        return view('manager/kandidat/pembayaran',compact('manager','pembayaran'));
    }

    public function cekPembayaranKandidat($id){
        $manager = Auth::user();
        $pembayaran = Pembayaran::where('id_pembayaran',$id)->first();
        return view('manager/kandidat/cek_pembayaran',compact('manager','pembayaran'));
    }

    public function cekConfirmKandidat($id)
    {
        Pembayaran::where('id_pembayaran',$id)->update([
            'stats_pembayaran'=>"sudah dibayar"
        ]);
        return redirect('manager/pembayaran/kandidat');
    }

    public function pembayaranPerusahaan()
    {
        $id = Auth::user();
        $manager = User::where('referral_code',$id->referral_code)->first();
        $pembayaran = Pembayaran::join(
            'perusahaan', 'pembayaran.id_perusahaan','=','perusahaan.id_perusahaan'
        )
        ->where('pembayaran.stats_pembayaran',"belum dibayar")->get();
        return view('manager/perusahaan/pembayaran',compact('manager','pembayaran'));
    }

    public function cekPembayaranPerusahaan($id)
    {
        $auth = Auth::user();
        $manager = User::where('referral_code',$auth->referral_code)->first();
        $pembayaran = Pembayaran::join(
            'perusahaan', 'pembayaran.id_perusahaan','=','perusahaan.id_perusahaan'
        )
        ->where('pembayaran.id_pembayaran',$id)->first();
        return view('manager/perusahaan/cek_pembayaran',compact('manager','pembayaran'));
    }

    public function cekConfirmPerusahaan(Request $request, $id)
    {
        $auth = Auth::user();
        $manager = User::where('type',3)->first();
        $pembayaran = Pembayaran::where('id_pembayaran',$id)->update([
            'stats_pembayaran'=>$request->stats_pembayaran
        ]);
        $perusahaan = Perusahaan::join(
            'pembayaran','perusahaan.id_perusahaan','=','pembayaran.id_perusahaan'
        )
        ->where('pembayaran.id_pembayaran',$id)->first();
        $notify = Notification::create([
            'pengirim_notifikasi'=>"Admin",
            'isi'=>"Selamat pembayaran anda telah selesai",
            'id_perusahaan'=>$perusahaan->id_perusahaan,
        ]);
        return redirect('/manager/pembayaran/perusahaan');
    }
}
