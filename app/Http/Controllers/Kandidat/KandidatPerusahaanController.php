<?php

namespace App\Http\Controllers\Kandidat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kandidat;
use Illuminate\Support\Facades\Auth;
use App\Models\notifyKandidat;
use App\Models\notifyPerusahaan;
use App\Models\Pembayaran;
use App\Models\Perusahaan;
use App\Models\messageKandidat;
use App\Models\LowonganPekerjaan;
use App\Models\PermohonanLowongan;
use App\Models\PerusahaanNegara;
use App\Models\Pekerjaan;
use App\Models\Negara;
use App\Models\PekerjaPerusahaan;
use RealRashid\SweetAlert\Facades\Alert;

class KandidatPerusahaanController extends Controller
{
    public function listPerusahaan()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $notif = notifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->limit(3)->get();
        $perusahaan = Perusahaan::where('penempatan_kerja','like','%'.$kandidat->penempatan.'%')->whereNotNull('email_operator')->get();
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
            $perusahaan = Perusahaan::where('penempatan_kerja','Dalam negeri')->limit(5)->get();    
        } else {
            $perusahaan = Perusahaan::where('penempatan_kerja','like',"%".$kandidat->penempatan."%")->whereNotNull('email_operator')->limit(5)->get();
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
        $lowongan = LowonganPekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $penempatan = PerusahaanNegara::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        return view('kandidat/perusahaan/profil_perusahaan',compact('kandidat','perusahaan','notif','pembayaran','pesan','lowongan','penempatan'));
    }

    public function lihatPekerjaanPerusahaan($negaraid,$nama)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $perusahaan = Perusahaan::where('nama_perusahaan',$nama)->first();
        $lowongan = LowonganPekerjaan::where('negara_id',$negaraid)->where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $negara = Negara::where('negara_id',$negaraid)->first();
        $notif = NotifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->limit(3)->get();
        return view('kandidat/perusahaan/perusahaan_pekerjaan',compact('kandidat','perusahaan','pekerjaan','notif','pesan','negara','nama'));
    }

    public function detailPekerjaanPerusahaan($id,$nama)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->first();
        dd($lowongan);
        $notif = NotifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->limit(3)->get();
        return view('kandidat/perusahaan/detail_pekerjaan',compact('kandidat','lowongan','notif','pesan'));
    }

    public function terimaPekerjaanPerusahaan(Request $request, $kerjaid, $nama)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $perusahaan = Perusahaan::where('nama_perusahaan',$nama)->first();
        $pekerjaan = Pekerjaan::where('id_pekerjaan',$kerjaid)->first();
        PekerjaPerusahaan::create([
            'id_kandidat' => $kandidat->id_kandidat,
            'id_perusahaan' => $perusahaan->id_perusahaan,
            'nama_pekerjaan' => $pekerjaan->nama_pekerjaan,
        ]);

        Kandidat::where('id_kandidat',$kandidat->id_kandidat)->update([
            'id_perusahaan' => $perusahaan->id_perusahaan,
            'jabatan_kandidat' => $pekerjaan->nama_pekerjaan,
        ]);
        notifyPerusahaan::create([
            'id_perusahaan' => $perusahaan->id_perusahaan,
            'id_kandidat' => $kandidat->id_kandidat,
            'isi' => "Kandidat baru telah masuk kedalam perusahaan anda",
            'pengirim' => "System",
            'url' => '/perusahaan/lihat/kandidat/'.$kandidat->id_kandidat,
        ]);
        Alert::success('Selamat',"Anda telah masuk dalam Perusahaan ".$nama);
        return redirect('/profil_perusahaan/'.$perusahaan->id_perusahaan);
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
            'negara' => $lowongan->negara,
            'nama_kandidat' => $kandidat->nama,
            'id_kandidat' => $kandidat->id_kandidat,
            'id_perusahaan' => $lowongan->id_perusahaan,
            'jabatan' => $lowongan->jabatan,
        ]);
        Kandidat::where('id_kandidat',$kandidat->id_kandidat)->update([
            'id_perusahaan' => $lowongan->id_perusahaan,
        ]);
        return redirect('/kandidat')->with('success',"Permohonan anda terkirim");
    }
}
