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
use App\Models\messagePerusahaan;
use App\Models\LowonganPekerjaan;
use App\Models\PermohonanLowongan;
use App\Models\PerusahaanNegara;
use App\Models\Pekerjaan;
use App\Models\Negara;
use App\Models\PekerjaPerusahaan;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\PersetujuanKandidat;
use App\Models\Interview;
use App\Models\CreditPerusahaan;
use App\Models\LaporanPekerja;

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
        if($kandidat->hubungan_perizin){
            return view('kandidat/perusahaan/profil_perusahaan',compact('kandidat','perusahaan','notif','pembayaran','pesan','lowongan','penempatan'));
        } else {
            return redirect()->route('kandidat')->with('warning',"Harap Lengkapi Profil Anda Terlebih Dahulu");
        }
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

    public function LowonganPekerjaan($id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $notif = NotifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->limit(3)->get();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->first();
        $permohonan = PermohonanLowongan::where('id_kandidat',$kandidat->id_kandidat)->first();
        $perusahaan = Perusahaan::where('id_perusahaan',$lowongan->id_perusahaan)->first();
        $interview = Interview::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_kandidat',$kandidat->id_kandidat)->where('status','like',"terjadwal")->first();
        if($permohonan == null){
            $jabatan = null;
        } else {
            $jabatan = $permohonan->jabatan;
        }
        if($interview){
            $interview = $interview;
        } else {
            $interview = null;
        }
        return view('kandidat/perusahaan/lihat_lowongan_pekerjaan',compact('kandidat','pesan','notif','lowongan','jabatan','perusahaan','interview'));
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
        $permohonan = PermohonanLowongan::where('id_kandidat',$kandidat->id_kandidat)->first();
        if($permohonan !== null){
            PermohonanLowongan::where('jabatan',$permohonan->jabatan)->where('id_perusahaan',$lowongan->id_perusahaan)->update([
                'jabatan' => $lowongan->jabatan,
                'nama_kandidat' => $kandidat->nama,
                'id_kandidat' => $kandidat->id_kandidat,
                'id_perusahaan' => $lowongan->id_perusahaan,
                'negara' => $lowongan->negara,
                'id_lowongan' => $lowongan->id_lowongan,
            ]);
        } else {
            PermohonanLowongan::create([
                'negara' => $lowongan->negara,
                'nama_kandidat' => $kandidat->nama,
                'id_kandidat' => $kandidat->id_kandidat,
                'id_perusahaan' => $lowongan->id_perusahaan,
                'jabatan' => $lowongan->jabatan,
                'id_lowongan' => $lowongan->id_lowongan,
            ]);
        }
        Kandidat::where('id_kandidat',$kandidat->id_kandidat)->update([
            'id_perusahaan' => $lowongan->id_perusahaan,
        ]);
        return redirect('/kandidat')->with('success',"Permohonan anda terkirim");
    }

    public function keluarPerusahaan($id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $perusahaan = Perusahaan::where('id_perusahaan',$id)->first();
        $interview = Interview::where('id_kandidat',$kandidat->id_kandidat)->where('id_perusahaan',$perusahaan->id_perusahaan)->where('status',"terjadwal")->first();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        if($interview){
            notifyPerusahaan::create([
                'id_perusahaan' => $perusahaan->id_perusahaan,
                'id_kandidat' => $kandidat->id_kandidat,
                'isi' => "Terdapat kandidat yang mengundurkan diri dari jadwal interview anda.",
                'pengirim' => "Admin",
                'url' => '/perusahaan/semua_pesan',
            ]);
            messagePerusahaan::create([
                'id_perusahaan' => $perusahaan->id_perusahaan,
                'id_kandidat' => $kandidat->id_kandidat,
                'pesan' => "Maaf Kandidat dengan atas nama ".$kandidat->nama." telah mengundurkan diri dari jadwal interview anda. Maka dari hal tersebut anda akan mendapatkan Credit yang dapat anda gunakan pada interview kandidat berikutnya.",
                'pengirim' => "Admin",
                'kepada' => $perusahaan->nama_perusahaan,
            ]);
            if($credit){
                CreditPerusahaan::where('credit_id',$credit->credit_id)->update([
                    'credit' => $credit->credit+1,                    
                ]);
            } else {
                CreditPerusahaan::create([
                    'id_perusahaan' => $perusahaan->id_perusahaan,
                    'nama_perusahaan' => $perusahaan->nama_perusahaan,
                    'no_nib' => $perusahaan->no_nib,
                    'credit' => 1,
                ]);
            }
        }
        PermohonanLowongan::where('id_kandidat',$kandidat->id_kandidat)->where('id_perusahaan',$perusahaan->id_perusahaan)->delete();
        Interview::where('id_kandidat',$kandidat->id_kandidat)->where('id_perusahaan',$perusahaan->id_perusahaan)->delete();
        PersetujuanKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('id_perusahaan',$perusahaan->id_perusahaan)->delete();
        Kandidat::where('id_perusahaan',$id)->where('id_kandidat',$kandidat->id_kandidat)->update([
            'id_perusahaan' => null,
            'stat_pemilik' => null
        ]);
        return redirect('/kandidat')->with('success',"Anda telah keluar dari ".$perusahaan->nama_perusahaan);
    }

    public function persetujuanKandidat(Request $request, $nama, $id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();  
        $perusahaan = Perusahaan::where('id_perusahaan',$kandidat->id_perusahaan)->first();
        if($request->persetujuan == "tidak"){
            if($request->pilih == "bekerja"){
                $validated = $request->validate([
                    'tmp_bekerja' => 'required',
                    'jabatan' => 'required',
                    'tgl_mulai_kerja' => 'required'
                ]);
                LaporanPekerja::create([
                    'nama_kandidat' => $kandidat->nama,
                    'id_kandidat' => $kandidat->id_kandidat,
                    'tmp_bekerja' => $request->tmp_bekerja,
                    'jabatan' => $request->jabatan,
                    'tgl_kerja' => $request->tgl_kerja,
                ]);
            } else {
                $validated = $request->validate([
                    'alasan_lain' => 'required',
                ]);
                // $request->validate([
                //     'alasan_lain' => 'required'
                // ]);
            }
            notifyPerusahaan::create([
                'id_perusahaan' => $kandidat->id_perusahaan,
                'id_kandidat' => $kandidat->id_kandidat,
                'isi' => "Anda mendapat pesan tentang persetujuan kandidat. cek pesan anda",
                'pengirim' => "Admin",
                'url' => '/perusahaan/semua_pesan',
            ]);
            messagePerusahaan::create([
                'id_perusahaan' => $kandidat->id_perusahaan,
                'id_kandidat' => $kandidat->id_kandidat,
                'pesan' => "Kandidat dengan nama ".$kandidat->nama." telah menolak persetujuan dengan perusahaan anda",
                'pengirim' => "Admin",
                'kepada' => $perusahaan->nama_perusahaan,
            ]);
            PermohonanLowongan::where('id_kandidat',$kandidat->id_kandidat)->where('id_perusahaan',$perusahaan->id_perusahaan)->delete();
            Kandidat::where('id_kandidat',$kandidat->id_kandidat)->where('id_perusahaan',$kandidat->id_perusahaan)->update([
                'stat_pemilik' => null,
                'id_perusahaan' => null,
            ]);
            Interview::where('id_kandidat',$kandidat->id_kandidat)->where('id_perusahaan',$perusahaan->id_perusahaan)->delete();
        }
        PersetujuanKandidat::where('nama_kandidat',$nama)->where('id_kandidat',$kandidat->id_kandidat)->update([
            'persetujuan' => $request->persetujuan,
            'tmp_bekerja' => $request->tmp_bekerja,
            'jabatan' => $request->jabatan,
            'tgl_mulai_kerja' => $request->tgl_mulai_kerja,
            'alasan_lain' => $request->alasan_lain,
        ]);
        return redirect('/kandidat')->with('success',"Terima kasih atas konfirmasi anda");
    }
}
