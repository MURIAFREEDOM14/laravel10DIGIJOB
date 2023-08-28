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
use App\Models\KandidatInterview;
use App\Models\Pendidikan;
use Carbon\Carbon;

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
        $pekerjaan = Pekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
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

    public function listLowonganPekerjaan()
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $notif = notifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->limit(3)->get();
        $lowongan = LowonganPekerjaan::join(
            'perusahaan', 'lowongan_pekerjaan.id_perusahaan','=','perusahaan.id_perusahaan'
        )
        ->where('perusahaan.penempatan_kerja','like','%'.$kandidat->penempatan.'%')->get();
        return view('kandidat/perusahaan/list_lowongan_pekerjaan',compact('kandidat','lowongan','notif','pesan'));
    }

    public function LowonganPekerjaan($id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $notif = NotifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->limit(3)->get();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->first();
        $permohonan = PermohonanLowongan::where('id_kandidat',$kandidat->id_kandidat)->where('id_lowongan',$id)->first();
        $perusahaan = Perusahaan::where('id_perusahaan',$lowongan->id_perusahaan)->first();
        $kandidat_interview = KandidatInterview::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_kandidat',$kandidat->id_kandidat)->first();
        $usia = Carbon::parse($kandidat->tgl_lahir)->age;
        Kandidat::where('id_kandidat',$kandidat->id_kandidat)->update([
            'usia' => $usia,
        ]);
        if($permohonan == null){
            $jabatan = null;
        } else {
            // dd($permohonan, $kandidat_interview);
            $jabatan = $permohonan->id_lowongan;
        }
        if($kandidat_interview !== null){
            $interview = $kandidat_interview;
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
        $pendidikan_lowongan = Pendidikan::where('nama_pendidikan','like','%'.$lowongan->pendidikan.'%')->first();
        $pendidikan_kandidat = Pendidikan::where('nama_pendidikan','like','%'.$kandidat->pendidikan.'%')->first();

        $data = Kandidat::
        where('referral_code',$user->referral_code)
        ->where('tinggi','>=',$lowongan->tinggi)
        ->first();
        
        if($data){
            if($pendidikan_kandidat >= $pendidikan_lowongan){
                if($kandidat->jenis_kelamin == $lowongan->jenis_kelamin || $lowongan->jenis_kelamin == "MF"){
                    if($kandidat->kabupaten == $lowongan->pencarian_tmp || $kandidat->provinsi == $lowongan->pencarian_tmp || $lowongan->pencarian_tmp == "Se-indonesia"){
                        if($kandidat->usia >= $lowongan->usia_min && $kandidat->usia <= $lowongan->usia_maks){
                            if($kandidat->berat >= $lowongan->berat_min && $kandidat->berat <= $lowongan->berat_maks){
                                return view('kandidat/perusahaan/permohonan_lowongan',compact('kandidat','notif','pesan','lowongan'));
                            } elseif($kandidat->berat >= $lowongan->berat_min) {
                                return view('kandidat/perusahaan/permohonan_lowongan',compact('kandidat','notif','pesan','lowongan'));                                
                            } else {
                                return redirect()->back()->with('warning',"Maaf berat badan anda tidak sesuai untuk lowongan ini");
                            }
                        } elseif($kandidat->usia >= $lowongan->usia_min) {
                            if($kandidat->berat >= $lowongan->berat_min && $kandidat->berat <= $lowongan->berat_maks){
                                return view('kandidat/perusahaan/permohonan_lowongan',compact('kandidat','notif','pesan','lowongan'));
                            } elseif($kandidat->berat >= $lowongan->berat_min) {
                                return view('kandidat/perusahaan/permohonan_lowongan',compact('kandidat','notif','pesan','lowongan'));                                
                            } else {
                                return redirect()->back()->with('warning',"Maaf berat badan anda tidak sesuai untuk lowongan ini");                                
                            }
                        } else {
                            return redirect()->back()->with('warning',"Maaf usia anda tidak sesuai untuk lowongan ini");
                        }
                    } else {
                        return redirect()->back()->with('warning',"Maaf pencarian kandidat ini tidak sesuai dengan tempat anda");
                    }
                } else {
                    return redirect()->back()->with('warning',"Maaf anda tidak bisa melamar di lowongan ini");
                }
            } else {
                return redirect()->back()->with('warning',"Maaf pendidikan anda kurang untuk pekerjaan ini");
            }
        } else {
            return redirect()->back()->with('warning',"Maaf anda tidak bisa melamar di lowongan ini");
        }
    }

    public function kirimPermohonan(Request $request,$id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->first();
        $permohonan = PermohonanLowongan::where('id_kandidat',$kandidat->id_kandidat)->first();
        if($permohonan !== null){  
            PermohonanLowongan::where('id_kandidat',$kandidat->id_kandidat)->where('id_perusahaan',$lowongan->id_perusahaan)->update([
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
        KandidatInterview::where('id_kandidat',$kandidat->id_kandidat)->where('id_perusahaan',$perusahaan->id_perusahaan)->delete();
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
                LaporanPekerja::create([
                    'alasan_lain' => $request->alasan_lain,
                ]);
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
