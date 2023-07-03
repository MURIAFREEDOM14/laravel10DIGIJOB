<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kandidat;
use Illuminate\Support\Facades\Auth;
use App\Models\notifyKandidat;
use App\Models\Pembayaran;
use App\Models\Perusahaan;
use App\Models\MessageKandidat;
use App\Models\LowonganPekerjaan;
use App\Models\PermohonanLowongan;

class KandidatPerusahaanController extends Controller
{
    public function listPerusahaan()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $notif = notifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->limit(3)->get();
        $perusahaan = Perusahaan::where('tmp_negara','like','%'.$kandidat->penempatan.'%')->whereNotNull('email_operator')->get();
        $cari_perusahaan = null;
        return view('kandidat/perusahaan/list_informasi_perusahaan',compact('kandidat','perusahaan','notif','pesan','cari_perusahaan'));
    }

    public function cari_perusahaan(Request $request)
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $notif = notifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->limit(3)->get();
        $pembayaran = Pembayaran::where('id_kandidat',$kandidat->id_kandidat)->first();
        $lowongan = LowonganPekerjaan::all();
        $cari_perusahaan = Perusahaan::where('referral_code',$request->referral_code)->whereNotNull('email_operator')->first();
        if($kandidat->negara_id == null){
            $perusahaan = Perusahaan::where('tmp_negara','Dalam negeri')->limit(5)->get();    
        } else {
            $perusahaan = Perusahaan::where('tmp_negara','like',"%".$kandidat->penempatan."%")->limit(5)->get();
        }
        return view('kandidat/perusahaan/list_informasi_perusahaan',compact('kandidat','notif','perusahaan','pembayaran','pesan','lowongan','cari_perusahaan'));
    }

    public function Perusahaan($id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $perusahaan = Perusahaan::where('id_perusahaan',$id)->first();
        $notif = NotifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->limit(3)->get();
        $pembayaran = Pembayaran::where('id_kandidat',$kandidat->id_kandidat)->first();
        return view('kandidat/perusahaan/profil_perusahaan',compact('kandidat','perusahaan','notif','pembayaran','pesan'));
    }

    public function listLowonganPekerjaan()
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $notif = NotifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->limit(3)->get();
        $lowongan = LowonganPekerjaan::join(
            'perusahaan', 'lowongan_pekerjaan.id_perusahaan','=','perusahaan.id_perusahaan'
        )
        // ->where('perusahaan.tmp_negara','like','%'.$kandidat->penempatan.'%')
        ->get();
        return view('kandidat/perusahaan/list_lowongan_pekerjaan',compact('kandidat','lowongan','pesan','notif'));
    }

    public function LowonganPekerjaan($id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $notif = NotifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->limit(3)->get();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->first();
        $perusahaan = Perusahaan::where('id_perusahaan',$lowongan->id_perusahaan)->first();
        return view('kandidat/perusahaan/lihat_lowongan_pekerjaan',compact('kandidat','pesan','notif','lowongan','perusahaan'));
    }

    public function permohonanLowongan($id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $notif = NotifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->limit(3)->get();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->first();
        return view('kandidat/perusahaan/permohonan_lowongan',compact('kandidat','notif','pesan','lowongan'));
    }

    public function kirimPermohonan(Request $request,$id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->first();
        PermohonanLowongan::create([
            'nama_lowongan' => $lowongan->nama_lowongan,
            'nama_kandidat' => $kandidat->nama,
            'id_kandidat' => $kandidat->id_kandidat,
            'id_perusahaan' => $lowongan->id_perusahaan,
            'pesan' => $request->pesan,
        ]);
        return redirect('/kandidat')->with('success',"Permohonan anda terkirim");
    }
}
