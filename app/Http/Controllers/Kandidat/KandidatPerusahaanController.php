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
    // halaman lihat profil perusahaan
    public function Perusahaan($id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $perusahaan = Perusahaan::where('id_perusahaan',$id)->first();
        $notif = NotifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $pembayaran = Pembayaran::where('id_kandidat',$kandidat->id_kandidat)->first();
        $lowongan = LowonganPekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $penempatan = PerusahaanNegara::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $kandidat_interview = KandidatInterview::where('id_kandidat',$kandidat->id_kandidat)->where('status',"terjadwal")->first();
        // apabila hubungan perizin / kontak darurat data kandidat ada
        if($kandidat->hubungan_perizin){
            return view('kandidat/perusahaan/profil_perusahaan',compact('kandidat','perusahaan','notif','pembayaran','pesan','lowongan','penempatan','kandidat_interview'));
        } else {
            return redirect()->route('kandidat')->with('warning',"Harap Lengkapi Profil Anda Terlebih Dahulu");
        }
    }

    // halaman data lowongan pekerjaan perusahaan
    public function listLowonganPekerjaan()
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $notif = notifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->where('check_click',"n")->get();
        // menampilkan data lowongan + perusahaan
        $lowongan = LowonganPekerjaan::join(
            'perusahaan', 'lowongan_pekerjaan.id_perusahaan','=','perusahaan.id_perusahaan'
        )
        ->where('perusahaan.penempatan_kerja','like','%'.$kandidat->penempatan.'%')->get();
        return view('kandidat/perusahaan/list_lowongan_pekerjaan',compact('kandidat','lowongan','notif','pesan'));
    }

    // halaman lihat lowongan pekerjaan perusahaan
    public function LowonganPekerjaan($id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $notif = NotifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->first();
        $permohonan = PermohonanLowongan::where('id_kandidat',$kandidat->id_kandidat)->first();
        $kandidat_interview = KandidatInterview::where('id_kandidat',$kandidat->id_kandidat)->where('persetujuan',"ya")->first();
        $perusahaan = Perusahaan::where('id_perusahaan',$lowongan->id_perusahaan)->first();
        $persetujuan = PersetujuanKandidat::where('id_kandidat',$kandidat->id_kandidat)->first();
        $usia = Carbon::parse($kandidat->tgl_lahir)->age;
        // mengupdate data usia kandidat
        Kandidat::where('id_kandidat',$kandidat->id_kandidat)->update([
            'usia' => $usia,
        ]);
        if($permohonan == null){
            $jabatan = null;
        } else {
            $jabatan = $permohonan;
        }
        if($kandidat_interview !== null){
            $interview = $kandidat_interview;
        } else {
            $interview = null;
        }
        if($persetujuan !== null){
            $konfirmasi = $persetujuan;
        } else {
            $konfirmasi = null;
        }
        return view('kandidat/perusahaan/lihat_lowongan_pekerjaan',compact('kandidat','pesan','notif','lowongan','jabatan','perusahaan','interview','konfirmasi'));
    }

    // halaman kirim permohonan lowongan dari kandidat 
    public function permohonanLowongan($id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $notif = NotifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->first();
        $perusahaan = Perusahaan::where('id_perusahaan',$lowongan->id_perusahaan)->first();
        $pendidikan_lowongan = Pendidikan::where('pendidikan','like','%'.$lowongan->pendidikan.'%')->first();
        $pendidikan_kandidat = Pendidikan::where('pendidikan','like','%'.$kandidat->pendidikan.'%')->first();
        
        // bagian filterisasi data kandidat dengan syarat lowongan
        $data = Kandidat::
        where('referral_code',$user->referral_code)
        // apabila tinggi kandidat lebih tinggi daripada syarat tinggi lowongan
        ->where('tinggi','>=',$lowongan->tinggi)
        ->first();

        // apabila kondisi terpenuhi / ada
        if($data){
            // apabila pendidikan kandidat lebih besar dari pendidikan lowongan
            if($pendidikan_kandidat >= $pendidikan_lowongan){
                // apabila jenis kelamin kandidat sama dengan jenis kelamin lowongan atau jenis kelamin lowongan adalah "MF"
                if($kandidat->jenis_kelamin == $lowongan->jenis_kelamin || $lowongan->jenis_kelamin == "MF"){
                    // apabila tempat tinggal kandidat sama dengan tempat / lokasi lowongan atau tempat / lokasi lowongan "se-indonesia"
                    if($kandidat->kabupaten == $lowongan->pencarian_tmp || $kandidat->provinsi == $lowongan->pencarian_tmp || $lowongan->pencarian_tmp == "Se-indonesia"){
                        // apabila usia kandidat lebih besar dari usia min lowongan dan usia kandidat lebih kecil dari lowongan maks
                        if($kandidat->usia >= $lowongan->usia_min && $kandidat->usia <= $lowongan->usia_maks){
                            // apabila berat kandidat lebih besar dari berat min lowongan dan berat kandidat lebih kecil dari berat maks lowongan
                            if($kandidat->berat >= $lowongan->berat_min && $kandidat->berat <= $lowongan->berat_maks){
                                return view('kandidat/perusahaan/permohonan_lowongan',compact('kandidat','notif','pesan','lowongan','perusahaan'));
                            // apabila berat kandidat lebih besar dari berat min lowongan
                            } elseif($kandidat->berat >= $lowongan->berat_min) {
                                return view('kandidat/perusahaan/permohonan_lowongan',compact('kandidat','notif','pesan','lowongan','perusahaan'));                                
                            // apabila tidak sesuai
                            } else {
                                return redirect()->back()->with('warning',"Maaf berat badan anda tidak sesuai untuk lowongan ini");
                            }
                        // apabila usia kandidat lebih besar dari usia min lowongan
                        } elseif($kandidat->usia >= $lowongan->usia_min) {
                            // apabila berat kandidat lebih besar dari berat min lowongan dan berat kandidat lebih kecil dari berat maks lowongan
                            if($kandidat->berat >= $lowongan->berat_min && $kandidat->berat <= $lowongan->berat_maks){
                                return view('kandidat/perusahaan/permohonan_lowongan',compact('kandidat','notif','pesan','lowongan','perusahaan'));
                            // apabila berat kandidat lebih besar dari berat min lowongan
                            } elseif($kandidat->berat >= $lowongan->berat_min) {
                                return view('kandidat/perusahaan/permohonan_lowongan',compact('kandidat','notif','pesan','lowongan','perusahaan'));                                
                            // apabila tidak sesuai
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

    // sistem kirim permohonan lowongan kepada perusahaan
    public function kirimPermohonan(Request $request,$id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->first();
        $permohonan = PermohonanLowongan::where('id_kandidat',$kandidat->id_kandidat)->first();
        // apabila permohonan lowongan ada
        if($permohonan !== null){  
            // merubah data permohonan
            PermohonanLowongan::where('id_kandidat',$kandidat->id_kandidat)->where('id_perusahaan',$lowongan->id_perusahaan)->update([
                'jabatan' => $lowongan->jabatan,
                'nama_kandidat' => $kandidat->nama,
                'id_kandidat' => $kandidat->id_kandidat,
                'id_perusahaan' => $lowongan->id_perusahaan,
                'negara' => $lowongan->negara,
                'id_lowongan' => $lowongan->id_lowongan,
            ]);
        } else {
            // membuat data permohonan
            PermohonanLowongan::create([
                'negara' => $lowongan->negara,
                'nama_kandidat' => $kandidat->nama,
                'id_kandidat' => $kandidat->id_kandidat,
                'id_perusahaan' => $lowongan->id_perusahaan,
                'jabatan' => $lowongan->jabatan,
                'id_lowongan' => $lowongan->id_lowongan,
            ]);
        }
        // merubah id perusahaan di data kandidat
        Kandidat::where('id_kandidat',$kandidat->id_kandidat)->update([
            'id_perusahaan' => $lowongan->id_perusahaan,
        ]);
        return redirect('/kandidat')->with('success',"Permohonan anda terkirim");
    }

    // sistem keluar perusahaan / batal lowongan
    public function keluarPerusahaan($id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $perusahaan = Perusahaan::where('id_perusahaan',$id)->first();
        $interview = KandidatInterview::where('id_kandidat',$kandidat->id_kandidat)->where('id_perusahaan',$perusahaan->id_perusahaan)->where('status',"terjadwal")->first();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        // apabila data interview ada
        if($interview){
            // membuat data pesan perusahaan
            messagePerusahaan::create([
                'id_perusahaan' => $perusahaan->id_perusahaan,
                'id_kandidat' => $kandidat->id_kandidat,
                'pesan' => "Maaf Kandidat dengan atas nama ".$kandidat->nama." telah mengundurkan diri dari jadwal interview anda. Maka dari hal tersebut anda akan mendapatkan Credit yang dapat anda gunakan pada interview kandidat berikutnya.",
                'pengirim' => $kandidat->nama,
                'kepada' => $perusahaan->nama_perusahaan,
            ]);
            // jika keluar perusahaan dalam kondisi sudah terdaftar dalam interview, maka perusahaan akan mendapat credit.
            // apabila credit sudah ada
            if($credit){
                // menambah credit
                CreditPerusahaan::where('credit_id',$credit->credit_id)->update([
                    'credit' => $credit->credit+1,                    
                ]);
            // apabila belum ada
            } else {
                // membuat data credit perusahaan
                CreditPerusahaan::create([
                    'id_perusahaan' => $perusahaan->id_perusahaan,
                    'nama_perusahaan' => $perusahaan->nama_perusahaan,
                    'no_nib' => $perusahaan->no_nib,
                    'credit' => 1,
                ]);
            }
        }
        // menghapus data permohonan (jika ada)
        PermohonanLowongan::where('id_kandidat',$kandidat->id_kandidat)->where('id_perusahaan',$perusahaan->id_perusahaan)->delete();
        // menghapus data kandidat interview (jika ada)
        KandidatInterview::where('id_kandidat',$kandidat->id_kandidat)->delete();        
        // menghapus data persetujuan kandidat (jika ada)
        PersetujuanKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('id_perusahaan',$perusahaan->id_perusahaan)->delete();
        
        // mengapus isi dalam data kandidat
        Kandidat::where('id_perusahaan',$id)->where('id_kandidat',$kandidat->id_kandidat)->update([
            'id_perusahaan' => null,
            'stat_pemilik' => null
        ]);
        return redirect('/kandidat')->with('success',"Anda telah keluar dari ".$perusahaan->nama_perusahaan);
    }

    // sistem persetujuan kandidat ketika mendapat undangan interview dari perusahaan
    public function persetujuanKandidat(Request $request, $nama, $id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();  
        // menampilkan data persetujuan + kandidat interview
        $persetujuan = PersetujuanKandidat::join(
            'kandidat_interviews', 'persetujuan_kandidat.id_interview','=','kandidat_interviews.id_interview'
        )
        ->where('persetujuan_kandidat.persetujuan_id',$request->persetujuan_id)->where('persetujuan_kandidat.id_kandidat',$kandidat->id_kandidat)->first();
        $perusahaan = Perusahaan::where('id_perusahaan',$persetujuan->id_perusahaan)->first();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        // apabila menolak
        if($request->persetujuan == "tidak"){
            // sebab "bekerja"
            if($request->pilih == "bekerja"){
                $validated = $request->validate([
                    'tmp_bekerja' => 'required',
                    'jabatan' => 'required',
                    'tgl_mulai_kerja' => 'required'
                ]);
                // akan terdata dalam laporan kandidat telah bekerja
                LaporanPekerja::create([
                    'nama_kandidat' => $kandidat->nama,
                    'id_kandidat' => $kandidat->id_kandidat,
                    'tmp_bekerja' => $request->tmp_bekerja,
                    'jabatan' => $request->jabatan,
                    'tgl_kerja' => $request->tgl_mulai_kerja,
                ]);
            // sebab "alasan lain"
            } else {
                $validated = $request->validate([
                    'alasan_lain' => 'required',
                ]);
                // akan terdata dalam laporan kandidat telah bekerja
                LaporanPekerja::create([
                    'alasan_lain' => $request->alasan_lain,
                ]);
            }
            // membuat pesan kepada perusahaan
            messagePerusahaan::create([
                'id_perusahaan' => $perusahaan->id_perusahaan,
                'id_kandidat' => $kandidat->id_kandidat,
                'pesan' => "Kandidat dengan nama ".$kandidat->nama." telah menolak persetujuan interview dengan perusahaan anda",
                'pengirim' => $kandidat->nama,
                'kepada' => $perusahaan->nama_perusahaan,
            ]);
            // menghapus data permohonan
            PermohonanLowongan::where('id_kandidat',$kandidat->id_kandidat)->where('id_perusahaan',$perusahaan->id_perusahaan)->delete();
            // menghapus isi dalam data kandidat
            Kandidat::where('id_kandidat',$kandidat->id_kandidat)->where('id_perusahaan',$kandidat->id_perusahaan)->update([
                'stat_pemilik' => null,
                'id_perusahaan' => null,
            ]);
            // apabila sudah ada data credit
            if($credit){
                // menambah data credit
                CreditPerusahaan::where('credit_id',$credit->credit_id)->update([
                    'credit' => $credit->credit+1,                    
                ]);
            } else {
                // membuat data credit
                CreditPerusahaan::create([
                    'id_perusahaan' => $perusahaan->id_perusahaan,
                    'nama_perusahaan' => $perusahaan->nama_perusahaan,
                    'no_nib' => $perusahaan->no_nib,
                    'credit' => 1,
                ]);
            }
            // menghapus data interview
            KandidatInterview::where('id_kandidat',$kandidat->id_kandidat)->where('id_perusahaan',$perusahaan->id_perusahaan)->delete();
        // apabila menerima
        } else {
            // mendapat pesan tanggal & waktu interview
            messageKandidat::create([
                'id_kandidat' => $kandidat->id_kandidat,
                'id_perusahaan' => $perusahaan->id_perusahaan,
                'pesan' => "Terima kasih untuk konfirmasi persetujuan interview anda. Berikut ini adalah jadwal interview perusahaan untuk anda. Harap untuk mengigat jadwal interview ini dan jangan sampai terlambat. Jadwal interview anda : ".date('d-m-Y',strtotime($persetujuan->jadwal_interview)).", dan waktu interview anda : ".date('h:i:s',strtotime($persetujuan->waktu_interview_awal))." sampai ".date('h:i:s',strtotime($persetujuan->waktu_interview_akhir))." .",
                'pengirim' => $perusahaan->nama_perusahaan,
                'kepada' => $kandidat->nama,
                'id_interview' => $persetujuan->id_interview,
            ]);
            // sistem pembatasan 30 pesan 
            $allMessage = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->get();
            $total = 30;
            if ($allMessage->count() > $total) {
                $operator = $allMessage->count() - $total;
                messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('id','asc')->limit($operator)->delete();
            }
            // menambah data kandidat
            Kandidat::where('id_kandidat',$kandidat->id_kandidat)->where('nama',$kandidat->nama)->update([
                'stat_pemilik' => "diambil",
                'id_perusahaan' => $perusahaan->id_perusahaan
            ]);
            // merubah data kandidat interview
            KandidatInterview::where('id_kandidat',$kandidat->id_kandidat)->where('id_perusahaan',$perusahaan->id_perusahaan)->update([
                'persetujuan' => $request->persetujuan,
            ]);
        }
        // menghapus data persetujuan
        PersetujuanKandidat::where('nama_kandidat',$nama)->where('id_kandidat',$kandidat->id_kandidat)->delete();
        // mencari data kandidat interview
        $kandidat_interview = KandidatInterview::where('id_interview',$persetujuan->id_interview)->where('id_lowongan',$persetujuan->id_lowongan)->get();
        // mengecek total data kandidat interview
        if($kandidat_interview->count() == 0){
            Interview::where('id_interview',$persetujuan->id_interview)->where('id_lowongan',$persetujuan->id_lowongan)->delete();
        }
        return redirect('/kandidat')->with('success',"Terima kasih atas konfirmasi anda");
    }

    // halaman jadwal interview dengan perusahaan
    public function interviewPerusahaan()
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $notif = notifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->where('check_click',"n")->get();
        // menampilkan data kandidat interview + kandidat + lowongan pekerjaan + perusahaan
        $kandidat_interview = KandidatInterview::join(
            'kandidat','kandidat_interviews.id_kandidat','=','kandidat.id_kandidat'
        )
        ->join(
            'lowongan_pekerjaan','kandidat_interviews.id_lowongan','=','lowongan_pekerjaan.id_lowongan'
        )
        ->join(
            'perusahaan', 'lowongan_pekerjaan.id_perusahaan','=','perusahaan.id_perusahaan'
        )
        ->where('kandidat.id_kandidat',$kandidat->id_kandidat)->where('kandidat_interviews.status','like',"terjadwal")
        ->where('kandidat_interviews.persetujuan','like','ya')->first();
        // apabila kandidat interview ada
        if($kandidat_interview){
            $interview = $kandidat_interview;
        } else {
            return redirect('/kandidat');
        }
        return view('kandidat/perusahaan/interview_perusahaan',compact('kandidat','notif','pesan','interview'));
    }
}
