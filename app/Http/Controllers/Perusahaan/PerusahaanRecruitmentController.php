<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\Auth;
use App\Models\Negara;
use App\Models\PerusahaanNegara;
use App\Models\Pekerjaan;
use App\Models\notifyPerusahaan;
use App\Models\messagePerusahaan;
use App\Models\LowonganPekerjaan;
use App\Models\PMIID;
use App\Models\PencarianStaff;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kandidat;
use App\Models\PermohonanLowongan;
use App\Models\PersetujuanKandidat;
use App\Models\CreditPerusahaan;
use App\Models\Interview;
use App\Models\notifyKandidat;
use App\Models\messageKandidat;
use App\Models\notifyAkademi;
use App\Models\messageAkademi;
use App\Models\JenisPekerjaan;
use App\Models\Benefit;
use App\Models\Fasilitas;
use Carbon\Carbon;
use App\Models\KandidatInterview;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Mail;
use App\Mail\Payment;
use App\Models\Pendidikan;
use App\Models\Pembayaran;
use App\Models\User;
use App\Models\LaporanPekerja;

class PerusahaanRecruitmentController extends Controller
{    
    // halaman data lowongan pekerjaan dalam / luar negeri
    public function lowonganPekerjaan($type)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        // apabila memilih lowongan dalam negeri
        if($type == "dalam"){
            $lowongan = LowonganPekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('negara','like','%Indonesia%')->get();            
        } else {
            $lowongan = LowonganPekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('negara','not like','%Indonesia%')->get();
        }
        return view('perusahaan/lowongan/lowongan_pekerjaan',compact('perusahaan','notif','pesan','lowongan','credit','type'));
    }

    // halaman tambah lowongan pekerjaan dalam / luar negeri
    public function tambahLowongan($type)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $benefit = Benefit::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $fasilitas = Fasilitas::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        // apabila memilih lowongan dalam negeri
        if($type == "dalam"){
            $negara = Negara::where('negara','like',"%Indonesia%")->first();
            $provinsi = Provinsi::all();
        } else {
            $negara = Negara::where('negara','not like',"%Indonesia%")->get();
            $provinsi = Provinsi::all();
        }
        $jenis_pekerjaan = JenisPekerjaan::all();
        return view('perusahaan/lowongan/tambah_lowongan',compact('perusahaan','notif','pesan','credit','negara','provinsi','jenis_pekerjaan','type','benefit','fasilitas'));
    }

    // Ajax lowongan negara tujuan
    protected function lowonganNegara(Request $request)
    {
        $data = Negara::where('negara',$request->negara)->first();
        return response()->json($data);
    }

    // Ajax tambah data benefit
    protected function lowonganBenefit(Request $request)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $benefits = $request->validate([
            'data' => 'required',
        ]);
        // menambah data opsi benefit dari perusahaan
        Benefit::create([
            'benefit' => $request->data,
            'id_perusahaan' => $perusahaan->id_perusahaan,
        ]);
        $data = Benefit::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        return response()->json($data);
    }

    // Ajax tambah data fasilitas
    protected function lowonganFasilitas(Request $request)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $fasilitas = $request->validate([
            'data' => 'required',
        ]);
        // menambah data opsi fasilitas dari perusahaan
        Fasilitas::create([
            'fasilitas' => $request->data,
            'id_perusahaan' => $perusahaan->id_perusahaan,
        ]);
        $data = Fasilitas::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        return response()->json($data);
    }

    // AJAX tambah data jenis pekerjaan
    protected function lowonganJenisPekerja(Request $request)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $jenis_pekerja = $request->validate([
            'judul' => 'required',
            'nama' => 'required',
        ]);
        // menambah data opsi jenis pekerja dari perusahaan
        JenisPekerjaan::create([
            'judul' => $request->judul,
            'nama' => $request->nama,
        ]);
        $data = JenisPekerjaan::all();
        return \response()->json($data);        
    }

    // sistem simpan data lowongan
    public function simpanLowongan(Request $request,$type)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $penempatan = Negara::where('negara',$request->penempatan)->first();
        // mengecekan apabila lowongan berada dalam / luar negeri
        if($type == "dalam"){
            // dalam negeri
            $lvl_pekerjaan = $request->lvl_pekerjaan;
        } else {
            // luar negeri
            $jenis_pekerjaan = JenisPekerjaan::where('judul',$request->lvl_pekerjaan)->first();
            $lvl_pekerjaan = $jenis_pekerjaan->nama;
        }
        // apabila pilihan berat badan ideal
        if($request->berat_badan == "ideal"){
            $berat_min = $request->tinggi - 110;
            $berat_maks = $request->tinggi - 90;
        } else {
            // apabila pilihan berat badan kustom / diatur manual
            $validated = $request->validate([
                'berat_min' => 'required',
                'berat_maks' => 'required',
            ]);
            $berat_min = $request->berat_min;
            $berat_maks = $request->berat_maks;
        }
        // mengubah data array benefit menjadi string
        // apabila ada
        if($request->benefit !== null){
            $benefit = implode(", ",$request->benefit); 
        } else {
            $benefit = null;
        }
        // mengubah data array fasilitas menjadi string
        // apabila ada
        if($request->fasilitas !== null){
            $fasilitas = implode(", ",$request->fasilitas);
        } else {
            $fasilitas = null;
        }
        // mengubah data array pengalaman kerja menjadi string
        // apabila ada
        if($request->pengalaman_kerja !== null){
            $pengalaman = implode(", ",$request->pengalaman_kerja);
        } else {
            $pengalaman = null;
        }
        // cek foto / gambar flyer
        // apabila ada
        if($request->file('gambar') !== null) {
            // memasukkan file gambar ke dalam aplikasi
            $gambar = $request->file('gambar');
            $gambar_lowongan = $perusahaan->nama_perusahaan.$request->jabatan.time().'.'.$gambar->extension();  
            $gambar->move('gambar/Perusahaan/'.$perusahaan->nama_perusahaan.'/Lowongan Pekerjaan/',$gambar_lowongan);
        } else {
            $gambar_lowongan = null;
        }
        // cek file gambar
        if($gambar_lowongan !== null) {
            $gambar_flyer = $gambar_lowongan;
        } else {
            $gambar_flyer = null;
        }
        // cek penempatan negara lowongan
        if ($penempatan !== null) {
            $mata_uang = $penempatan->mata_uang;
            $negara_id = $penempatan->negara_id;
            $penempatan = $penempatan->negara;
        } else {
            $mata_uang = null;
            $negara_id=null;
            $penempatan = null;
        }
        // membuat data lowongan pekerjaan
        LowonganPekerjaan::create([
            'usia_min' => $request->usia_min,
            'usia_maks' => $request->usia_maks,
            'jabatan' => $request->jabatan,
            'pendidikan' => $request->pendidikan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pengalaman_kerja' => $pengalaman,
            'berat_min' => $berat_min,
            'berat_maks' => $berat_maks,
            'tinggi' => $request->tinggi,
            'pencarian_tmp' => $request->pencarian_tmp,
            'id_perusahaan' => $perusahaan->id_perusahaan,
            'isi' => $request->deskripsi,
            'negara' => $penempatan,
            'negara_id' => $negara_id,
            'ttp_lowongan' => $request->ttp_lowongan,
            'gambar_lowongan' => $gambar_flyer,
            'lvl_pekerjaan' => $lvl_pekerjaan,
            'mata_uang' => $mata_uang,
            'gaji_minimum' => $request->gaji_minimum,
            'gaji_maksimum' => $request->gaji_maksimum,
            'benefit' => $benefit,
            'fasilitas' => $fasilitas,
            'tgl_interview_awal' => $request->tgl_interview_awal,
            'tgl_interview_akhir' => $request->tgl_interview_akhir,
        ]);
        return redirect('perusahaan/list/lowongan/'.$type)->with('success');
    }

    // halaman lihat lowongan dalam / luar negeri
    public function lihatLowongan($id,$type)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/lowongan/lihat_lowongan',compact('perusahaan','lowongan','pesan','notif','credit','type'));
    }

    // halaman edit lowongan dalam / luar negeri
    public function editLowongan($id,$type)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->first();
        $benefit = Benefit::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $fasilitas = Fasilitas::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        // apabila memilih lowongan dalam negeri
        if($type == "dalam") {
            $negara = Negara::where('negara','like',"%Indonesia%")->first();
        } else {
            $negara = Negara::where('negara','not like',"%Indonesia%")->get();
        }        
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $jenis_pekerjaan = JenisPekerjaan::all();
        return view('perusahaan/lowongan/edit_lowongan',compact('perusahaan','pesan','notif','lowongan','negara','credit','jenis_pekerjaan','type','benefit','fasilitas'));
    }

    // sistem ubah lowongan dalam / luar negeri
    public function updateLowongan(Request $request, $id, $type)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->first();
        $penempatan = Negara::where('negara',$request->penempatan)->first();
        // cek file gambar flyer lowongan
        // apabila ada
        if($request->file('gambar') !== null){
            // cek file gambar sebelumnya dan hapus bila ada
            $hapus_gambar_lowongan = public_path('gambar/Perusahaan/'.$perusahaan->nama_perusahaan.'/Lowongan Pekerjaan/').$lowongan->gambar_lowongan;
            if(file_exists($hapus_gambar_lowongan)){
                @unlink($hapus_gambar_lowongan);
            }
            $gambar = $request->file('gambar');
            $gambar_lowongan = $perusahaan->nama_perusahaan.$request->jabatan.time().'.'.$gambar->extension();  
            $gambar->move('gambar/Perusahaan/'.$perusahaan->nama_perusahaan.'/Lowongan Pekerjaan/',$gambar_lowongan);
        } else {
            if($lowongan->gambar_lowongan !== null){
                $gambar_lowongan = $lowongan->gambar_lowongan;                
            } else {
                $gambar_lowongan = null;    
            }
        }
        // cek pilihan berat badan ideal 
        if($request->berat_badan == "ideal"){
            $berat_min = $request->tinggi - 110;
            $berat_maks = $request->tinggi - 90;
        // cek pilihan berar badan kustom / manual
        } else {
            // apabila memilih kustom berat badan
            $validated = $request->validate([
                'berat_min' => 'required',
                'berat_maks' => 'required',
            ]);
            $berat_min = $request->berat_min;
            $berat_maks = $request->berat_maks;
        }
        // apabila gambar flyer ada
        if($gambar !== null) {
            $gambar_flyer = $gambar;
        } else {
            $gambar_flyer = null;
        }
        // apabila benefit ada
        if($request->benefit !== null){
            $benefit = implode(", ",$request->benefit); 
        } else {
            $benefit = null;
        }
        // apabila fasilitas ada
        if($request->fasilitas !== null){
            $fasilitas = implode(", ",$request->fasilitas);
        } else {
            $fasilitas = null;
        }
        // apabila pengalaman kerja ada
        if($request->pengalaman_kerja !== null){
            $pengalaman = implode(", ",$request->pengalaman_kerja);
        } else {
            $pengalaman = null;
        }
        // apabila penempatan ada
        if($penempatan !== null){
            $mata_uang = $penempatan->mata_uang;
            $negara_id = $penempatan->negara_id;
            $penempatan = $penempatan->negara;
        } else {
            $mata_uang = null;
            $negara_id = null;
            $penempatan = null;
        }
        // tambah / ubah data lowongan pekerjaan
        LowonganPekerjaan::where('id_lowongan',$id)->update([
            'usia_min' => $request->usia_min,
            'usia_maks' => $request->usia_maks,
            'jabatan' => $request->jabatan,
            'pendidikan' => $request->pendidikan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pengalaman_kerja' => $pengalaman,
            'berat_min' => $berat_min,
            'berat_maks' => $berat_maks,
            'tinggi' => $request->tinggi,
            'pencarian_tmp' => $request->pencarian_tmp,
            'id_perusahaan' => $perusahaan->id_perusahaan,
            'isi' => $request->deskripsi,
            'ttp_lowongan' => $request->ttp_lowongan,
            'gambar_lowongan' => $gambar_flyer,
            'negara' => $penempatan,
            'negara_id' => $negara_id,
            'lvl_pekerjaan' => $request->lvl_pekerjaan,
            'mata_uang' => $mata_uang,
            'gaji_minimum' => $request->gaji_minimum,
            'gaji_maksimum' => $request->gaji_maksimum,
            'benefit' => $benefit,
            'fasilitas' => $fasilitas,
            'tgl_interview_awal' => $request->tgl_interview_awal,
            'tgl_interview_akhir' =>$request->tgl_interview_akhir,
        ]);
        return redirect('/perusahaan/list/lowongan/'.$type)->with('success');
    }

    // sistem hapus lowongan pekerjaan
    public function hapusLowongan($id,$type)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        Interview::where('id_lowongan',$id)->where('id_perusahaan',$perusahaan->id_perusahaan)->delete();
        KandidatInterview::where('id_lowongan',$id)->where('id_perusahaan',$perusahaan->id_perusahaan)->delete();
        PermohonanLowongan::where('id_lowongan',$id)->where('id_perusahaan',$perusahaan->id_perusahaan)->delete();        
        PersetujuanKandidat::where('id_lowongan',$id)->where('id_perusahaan',$perusahaan->id_perusahaan)->delete(); 
        LowonganPekerjaan::where('id_lowongan',$id)->where('id_perusahaan',$perusahaan->id_perusahaan)->delete();
        $datetime  = date('y-m-d');
        // apabila penempatan kerja ada di dalam negeri
        if($perusahaan->penempatan_kerja == "Dalam negeri"){
            return redirect('/perusahaan/list/lowongan/dalam')->with('success','Lowongan telah dihapus');
        } elseif($perusahaan->penempatan_kerja == "Luar negeri"){
            return redirect('/perusahaan/list/lowongan/luar')->with('success','Lowongan telah dihapus');
        }
    }

    // halaman data kandidat yang sesuai dengan syarat lowongan pekerjaan
    public function lowonganKandidatSesuai($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        // sistem pengecekan apabila ada data lowongan yang belum lengkap
        if($lowongan->usia_min == null || $lowongan->usia_maks == null || $lowongan->berat_min == null || $lowongan->berat_maks == null){
            // apabila lowongan ditujukan untuk indonesia
            if($lowongan->negara == "Indonesia")
            {
                return redirect('/perusahaan/edit_lowongan/'.$id.'/dalam')->with('warning',"Maaf data lowongan anda ada yang kosong. Harap lengkapi kembali lowongan anda");
            } else {
                return redirect('/perusahaan/edit_lowongan/'.$id.'/luar')->with('warning',"Maaf data lowongan anda ada yang kosong. Harap lengkapi kembali lowongan anda");
            }
        }
        $p_lowongan = Pendidikan::where('pendidikan','like','%'.$lowongan->pendidikan.'%')->first();
        // menampilkan data kandidat + pendidikan
        // sistem validasi kandidat dengan pencarian database
        $kandidat = Kandidat::join(
            'pendidikans', 'kandidat.pendidikan','=','pendidikans.pendidikan'
        )
        // apabila tinggi kandidat lebih besar dari tinggi lowongan
        ->where('kandidat.tinggi','>=',$lowongan->tinggi)
        // apabila usia kandidat lebih besar dari usia min lowongan
        ->where('kandidat.usia','>=',$lowongan->usia_min)
        // apabila usia kandidat lebih kecil dari usia maks lowongan
        ->where('kandidat.usia','<=',$lowongan->usia_maks)
        // apabila berat kandidat lebih besar dari berat min lowongan
        ->where('kandidat.berat','>=',$lowongan->berat_min)
        // apabila berat kandidat lebih kecil dari berat maks lowongan
        ->where('kandidat.berat','<=',$lowongan->berat_maks)
        // apabila stat pemilik kandidat masih kosong
        ->whereNull('kandidat.stat_pemilik')
        // apabila pendidikan kandidat lebih besar dari pendidikan lowongan
        ->where('pendidikans.no_urutan','>=',$p_lowongan->no_urutan)
        ->get();
        $kandidat_interview = KandidatInterview::where('id_lowongan',$id)->get();
        return view('perusahaan/lowongan/lowongan_sesuai',compact('perusahaan','lowongan','kandidat','pesan','notif','credit','p_lowongan','id','kandidat_interview'));
    }

    // halaman data permohonan lowongan / pelamar dari kandidat
    public function listPermohonanLowongan()
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $lowongan = LowonganPekerjaan::where('lowongan_pekerjaan.id_perusahaan',$perusahaan->id_perusahaan)->get();
        // looping data lowongan dari perusahaan
        // menampilkan tombol interview bila sudah ada anggota dan sudah melakukan pembayaran
        foreach($lowongan as $key){
            // menampilkan data interview + pembayaran + lowongan pekerjaan
            $interview = Interview::join(
                'pembayaran','interview.id_interview','=','pembayaran.id_interview'
            )
            ->join(
                'lowongan_pekerjaan','interview.id_lowongan','=','lowongan_pekerjaan.id_lowongan'
            )->where('pembayaran.stats_pembayaran','like',"sudah dibayar")->get();
        }
        return view('perusahaan/lowongan/list_permohonan_lowongan',compact('perusahaan','lowongan','pesan','notif','credit','interview'));
    }

    // halaman lihat data permohonan lowongan / pelamar dari kandidat
    public function lihatPermohonanLowongan($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $interview = KandidatInterview::where('id_lowongan',$id)->where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        // menampilkan data permohonan lowongan + kandidat
        $permohonan = PermohonanLowongan::join(
            'kandidat', 'permohonan_lowongan.id_kandidat','=','kandidat.id_kandidat'
        )
        ->where('kandidat.id_perusahaan',$perusahaan->id_perusahaan)->whereNull('kandidat.stat_pemilik')->where('id_lowongan',$id)->get();
        $isi = $permohonan->count();
        return view('perusahaan/lowongan/lihat_permohonan_lowongan',compact('perusahaan','permohonan','pesan','notif','isi','credit','id','interview'));
    }

    // sistem memberi penanda jika kandidat sudah dipilih oleh perusahaan
    public function confirmPermohonanLowongan(Request $request, $id)
    {
        $auth = Auth::user();
        $id_kandidat = $request->id_kandidat;
        $perusahaan = Perusahaan::where('no_nib',$auth->no_nib)->first();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->where('id_perusahaan',$perusahaan->id_perusahaan)->first();
        $interview = Interview::where('id_lowongan',$id)->where('id_perusahaan',$perusahaan->id_perusahaan)->first();
        // apabila tidak memilih satupun kandidat untuk interview
        if($id_kandidat == null){
            return redirect()->back()->with('error','Anda harus memilih minimal 1 kandidat');
        // apabila masih ada jadwal interview di lowongan
        } elseif($interview !== null){
            return redirect()->back()->with('error',"Maaf anda masih memiliki jadwal interview di lowongan ini");
        }
        // mendata jumlah kandidat yang dipilih melalui id
        for($a = 0; $a < count($id_kandidat); $a++){                
            // mendata dan membuat data kandidat interview
            $kandidat = Kandidat::where('id_kandidat',$id_kandidat[$a])->first();   
            $ki['id_lowongan'] = $id;
            $ki['id_perusahaan'] = $perusahaan->id_perusahaan;
            $ki['id_kandidat'] = $kandidat->id_kandidat;
            $ki['nama'] = $kandidat->nama;
            $ki['usia'] = $kandidat->usia;
            $ki['jenis_kelamin'] = $kandidat->jenis_kelamin;
            KandidatInterview::create($ki);

            // menambah data kandidat & memberi penanda agar kandidat tidak dapat diambil oleh perusahaan lain
            $k['stat_pemilik'] = "kosong";
            Kandidat::where('id_kandidat',$kandidat->id_kandidat)->update($k);

            // mengambil data permohonan lowongan /  pelamar dari kandidat di lowongan
            $permohonan_data = PermohonanLowongan::where('id_kandidat',$kandidat->id_kandidat)->where('id_perusahaan',$perusahaan->id_perusahaan)->first();
                // jika permohonan lowongan ada
                if($permohonan_data !== null){
                    // menambah data permohonan lowongan / pelamar kandidat
                    PermohonanLowongan::where('id_kandidat',$kandidat->id_kandidat)->where('id_perusahaan',$perusahaan->id_perusahaan)->update([
                        'confirm'=>$kandidat->id_kandidat,
                    ]);
                    // menambah data kandidat supaya tidak bisa diambil oleh perusahaan lain
                    Kandidat::where('id_kandidat',$id_kandidat[$a])->update([
                        'stat_pemilik' => "kosong",
                    ]);                    
                } 
        }                  
        return redirect('/perusahaan/kandidat_lowongan_dipilih/'.$id);
    }

    // halaman kandidat yang telah dipilih
    public function kandidatLowonganDipilih($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        // menampilkan data kandidat interview + kandidat
        $kandidat = KandidatInterview::join(
            'kandidat', 'kandidat_interviews.id_kandidat','=','kandidat.id_kandidat'
        )
        ->where('kandidat_interviews.id_lowongan',$id)->where('kandidat_interviews.id_perusahaan',$perusahaan->id_perusahaan)->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $interview = Interview::where('id_lowongan',$id)->first();
        // apabila interview di lowongan masih ada
        if($interview !== null){
            $pembayaran = Pembayaran::where('id_interview',$interview->id_interview)->where('id_lowongan',$id)->first();
        } else {
            $pembayaran = null;
        }
        $isi = $kandidat->count();
        return view('perusahaan/lowongan/kandidat_lowongan_dipilih',compact('perusahaan','kandidat','notif','pesan','credit','id','interview','isi','pembayaran'));
    }

    // membatalkan pemilihan kandidat interview
    public function cancelKandidatLowongan($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        // menampilkan data kandidat interview + kandidat
        $kandidat = KandidatInterview::join(
            'kandidat', 'kandidat_interviews.id_kandidat','=','kandidat.id_kandidat'
        )
        ->where('kandidat_interviews.id_lowongan',$id)->where('kandidat_interviews.id_perusahaan',$perusahaan->id_perusahaan)->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/lowongan/batal_kandidat',compact('perusahaan','kandidat','notif','pesan','credit','id'));
    }

    // sistem konfirmasi pembatalan pemilihan kandidat yang akan diinterview
    public function confirmCancelKandidatLowongan(Request $request, $id)
    {
        // apabila tidak memilih satupun kandidat
        if($request->id_kandidat == null){
            return redirect()->back()->with('warning','Anda harus memilih setidaknya 1 kandidat');
        }
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $id_kandidat = $request->id_kandidat;
        // mendata jumlah kandidat yang dibatalkan
        for($a = 0; $a < count($id_kandidat); $a++){
            // menghapus data kandidat interview yang dibatalkan
            KandidatInterview::where('id_lowongan',$id)->where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_kandidat',$id_kandidat[$a])->delete();
            // mengubah data stat pemilik kandidat menjadi kosong / belum ada yang mengambil
            Kandidat::where('id_kandidat',$id_kandidat[$a])->update([
                'stat_pemilik' => null,
            ]);
        }
        // menjumlah data kandidat yang termasuk dalam interview
        $interview = KandidatInterview::where('id_lowongan',$id)->where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        // apabila tidak ada / kosong
        if($interview->count() == 0){
            Interview::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_lowongan',$id)->delete();
        }
        return redirect()->back()->with('success',"Kandidat telah dibatalkan");
    }

    // sistem konfirmasi pemilihan kandidat yang akan diinterview
    public function kandidatDipilihInterview(Request $request, $id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $kandidat = KandidatInterview::where('id_lowongan',$id)->get();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->first();        
        $id_kandidat = $request->id_kandidat;
        // membuat data interview
        $interview = Interview::create([
            'status' => "pilih",
            'id_lowongan' => $id,
            'id_perusahaan' => $perusahaan->id_perusahaan,
            'jadwal_interview_awal' => $lowongan->tgl_interview_awal,
            'jadwal_interview_akhir' => $lowongan->tgl_interview_akhir,
        ]);
        // mendata kandidat yang dipilih untuk diinterview
        for($k = 0; $k < count($id_kandidat); $k++){
            // menambah data kandidat interview
            KandidatInterview::where('id_kandidat',$id_kandidat[$k])->update([
                'id_interview' => $interview->id,
            ]);    
        }
        return redirect('/perusahaan/jadwal_interview/'.$id)->with('success','Kandidat Telah ditentukan');
    }


    // halaman mengatur jadwal interview
    public function jadwalInterview($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('check_click',"n")->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $lowongan = LowonganPekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_lowongan',$id)->first();
        // membuat ket tanggal awal menggunakan carbon
        $interview_awal = new Carbon ($lowongan->tgl_interview_awal);
        // membuat ket tanggal akhir menggunakan carbon
        $interview_akhir = new Carbon ($lowongan->tgl_interview_akhir);
        // memgambil tanggal interval dari tanggal awal sampai tanggal akhir
        $jadwal = CarbonPeriod::create($interview_awal, $interview_akhir);
        // menampilkan data interview + kandidat interview
        $kandidat = Interview::join(
            'kandidat_interviews', 'interview.id_interview','=','kandidat_interviews.id_interview'
        )
        ->where('interview.id_perusahaan',$perusahaan->id_perusahaan)->where('kandidat_interviews.id_lowongan',$id)->get();
        // mendata kandidat yang interview
        $check = $kandidat->count();
        // apabila kandidat interview tidak kosong
        if($check > 0){
            return view('perusahaan/interview/jadwal_interview',compact('perusahaan','notif','pesan','credit','lowongan','kandidat','jadwal','check','id'));
        } else {
            return redirect('/perusahaan/list_permohonan_lowongan')->with('error',"Maaf anda harus punya pelamar untuk mengatur jadwal interview");
        }
    }

    // sistem konfirmasi jadwal interview
    public function confirmJadwalInterview(Request $request, $id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('check_click',"n")->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $lowongan = LowonganPekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_lowongan',$id)->first();
        $jadwal = $request->dater;
        $flag = $request->urutan;
        $id_kandidat = $request->id_kandidat;
        // mendata kandidat interview
        for($t = 0; $t < count($jadwal); $t++){
            KandidatInterview::where('id_lowongan',$id)->where('id_kandidat',$id_kandidat[$t])->update([
                'jadwal_interview' => $jadwal[$t],
                'urutan' => $flag[$t],
            ]);
        }

        $kandidat = KandidatInterview::where('id_lowongan',$id)->orderBy('urutan','asc')->get();        
        
        // membuat ket tanggal awal menggunakan carbon
        $interview_awal = new Carbon ($lowongan->tgl_interview_awal);
        // membuat ket tanggal akhir menggunakan carbon
        $interview_akhir = new Carbon ($lowongan->tgl_interview_akhir);
        // memgambil tanggal interval dari tanggal awal sampai tanggal akhir
        $periode = CarbonPeriod::create($interview_awal, $interview_akhir);
        return view('perusahaan/interview/waktu_interview',compact('perusahaan','notif','pesan','credit','kandidat','id','periode'));
    }

    // sistem konfirmasi waktu interview
    public function confirmWaktuInterview(Request $request, $id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('check_click',"n")->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        // ubah data interview lowongan
        Interview::where('id_lowongan',$id)->where('id_perusahaan',$perusahaan->id_perusahaan)->update([
            'status' => "terjadwal",
        ]);
        $interview = Interview::where('id_lowongan',$id)->where('id_perusahaan',$perusahaan->id_perusahaan)->first();
        $id_kandidat = $request->id_kandidat;
        $timer = $request->timer;
        $durasi = $request->durasi;
        for($w = 0; $w < count($durasi); $w++){
            $waktu_akhir = Carbon::create($timer[$w])->addMinutes($durasi[$w]);
            // ubah data kandidat interview lowongan
            KandidatInterview::where('id_lowongan',$id)->where('id_kandidat',$id_kandidat[$w])->update([
                'waktu_interview_awal' => $timer[$w],
                'waktu_interview_akhir' => $waktu_akhir,
                'durasi_interview' => $durasi[$w],
                'status' => "terjadwal",
            ]);
        }
        $kandidat_interview = KandidatInterview::where('id_interview',$interview->id_interview)->where('id_lowongan',$id)->orderBy('urutan','asc')->get();
        return view('/perusahaan/interview/konfirmasi_interview',compact('perusahaan','notif','pesan','credit','kandidat_interview','id'));
    }

    // mengkonfirmasi data keseluruhan interview
    public function konfirmasiInterview(Request $request, $id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $id_kandidat = $request->id_kandidat;
        $interview_awal = $request->interview_awal;
        $durasi = $request->durasi;
        // mendata kandidat yang akan diinterview
        for($w = 0; $w < count($id_kandidat); $w++){
            $interview_akhir = Carbon::create($interview_awal[$w])->addMinutes($durasi[$w]);
            KandidatInterview::where('id_lowongan',$id)->where('id_kandidat',$id_kandidat[$w])->update([
                'waktu_interview_awal' => $interview_awal[$w],
                'waktu_interview_akhir' => $interview_akhir,
            ]);
        }
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('check_click',"n")->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->where('id_perusahaan',$perusahaan->id_perusahaan)->first();
        $kandidat_interview = KandidatInterview::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_lowongan',$id)->orderBy('urutan','asc')->get();
        return view('perusahaan/interview/pembayaran_interview',compact('perusahaan','pesan','notif','credit','id','lowongan','id_kandidat','kandidat_interview'));
    }

    // melakukan pengiriman proses pembayaran interview
    public function pembayaranInterview(Request $request, $id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $biaya = $request->biaya;
        // 1 kandidat dinilai 15000 / $1 dan dikalikan dengan credit yang dimiliki perusahaan
        $credit = 15000 * $request->credit;
        $interview = Interview::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_lowongan',$id)->first();
        // apabila menggunakan credit
        if($request->konfirmasi == "ya"){
            $total = $credit - $biaya;
            // apabila credit yang dimiliki masih ada
            if($total > 0){
                $payment = 0;
                $credit_now = $total / 15000;
            } else {
                $payment = $total;
                $credit_now = 0;
            }
        } else {
            $total = $biaya;
            $payment = $biaya;
            $credit_now = $credit / 15000;
        }
        Pembayaran::create([
            'id_perusahaan' => $perusahaan->id_perusahaan,
            'nama_pembayaran' => $perusahaan->nama_perusahaan,
            'nominal_pembayaran' => $payment,
            'stats_pembayaran' => "belum dibayar",
            'nib' => $perusahaan->no_nib,
            'id_interview' => $interview->id_interview,
            'id_lowongan' => $id,
        ]);
        CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->update([
            'credit' => $credit_now,
        ]);
        $nama_rec = "PT HARAPAN MENTARI PAGI";
        $bank = "PT Bank Central Asia Tbk";
        $nomo_rec = 4399997272;
        $token = User::where('no_nib',$perusahaan->no_nib)->first();
        // mengirim email pembayaran
        Mail::mailer('payment')->to($perusahaan->email_perusahaan)->send(new Payment($perusahaan->nama_perusahaan, $token, $payment, "Pembayaran Interview", 'digijobaccounting@ugiport.com', $nama_rec, $nomo_rec, $bank));
        return redirect('/perusahaan/list/pembayaran')->with('success',"Proses Pembayaran sedang dikirimkan ke email anda.");
    }

    // halaman lihat jadwal interview
    public function lihatJadwalInterview($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('check_click',"n")->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $lowongan = LowonganPekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_lowongan',$id)->first();
        $interview = Interview::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_lowongan',$id)->first();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->first();
        // jika data interview lowongan kosong
        if($interview == null){
            return redirect('/perusahaan/list_permohonan_lowongan')->with('error',"Maaf tidak ada kandidat yang ingin interview");
        }
        $kandidat = KandidatInterview::where('id_interview',$interview->id_interview)->where('status',"terjadwal")->orderBy('urutan','asc')->get();
        // mencari waktu saat ini
        $time = date('h:i:s A');
        // mencari tanggal saat ini
        $day = date('Y-m-d');
        // menampilkan data kandidat interview
        foreach($kandidat as $key){
            // jika tanggal sekarang sama dengan tanggal interview berlangsung
            if(date('Y-m-d',strtotime($key->jadwal_interview)) == $day){
                // jika waktu interview dikurangi 5 menit kurang dari waktu saat ini dan kandidat menolak interview
                if(date('h:i:s A',strtotime($key->waktu_interview_awal.('-5 minutes'))) <= $time && $key->persetujuan !== "ya"){
                    // ubah data stat pemilik kandidat menjadi kosong
                    Kandidat::where('id_kandidat',$key->id_kandidat)->update([
                        'stat_pemilik' => null,
                    ]);
                    PersetujuanKandidat::where('id_kandidat',$key->id_kandidat)->where('nama_kandidat',$key->nama)->delete();
                    // membuat pesan kepada kandidat bahwa telah melewatkan interview
                    messageKandidat::create([
                        'id_kandidat' => $key->id_kandidat,
                        'id_perusahaan' => $perusahaan->id_perusahaan,
                        'pesan' => "Mohon maaf, Anda secara otomatis telah menolak undangan interview dari perusahaan ".$perusahaan->nama_perusahaan." karena belum konfirmasi sampai pada batas waktu. Harap kedepannya untuk selalu melihat pesan dan notifikasi anda agar tidak terlambat dalam konfirmasi undangan interview.",
                        'pengirim' => $perusahaan->nama_perusahaan,
                        'kepada' => $key->nama,
                    ]);
                    // membatasi pesan kandidat sebanyak 30 pesan
                    $allMessageKandidat = messageKandidat::where('id_kandidat',$key->id_kandidat)->get();
                    $total = 30;
                    if ($allMessageKandidat->count() > $total) {
                        $operator = $allMessageKandidat->count() - $total;
                        messageKandidat::where('id_kandidat',$key->id_kandidat)->orderBy('id','asc')->limit($operator)->delete();
                    }
                    // membuat pesan kepada perusahaan bahwa kandidat yang ingin diinterview dianggap mengundurkan diri
                    messagePerusahaan::create([
                        'id_perusahaan' => $perusahaan->id_perusahaan,
                        'id_kandidat' => $key->id_kandidat,
                        'pesan' => "Maaf Kandidat atas nama ".$key->nama." secara otomatis telah menolak undangan interview anda karena belum ada konfirmasi persetujuan sampai batas waktu. Sebagai gantinya, kami akan memberikan anda credit yang dapat anda gunakan di interview berikutnya.",
                        'pengirim' => $key->nama,
                        'kepada' => $perusahaan->nama_perusahaan,
                    ]);
                    // membatasi pesan perusahaan sebanyak 30 pesan
                    $allMessagePerusahaan = messagePerusahaan::where('id_kandidat',$key->id_kandidat)->get();
                    $total = 30;
                    if ($allMessagePerusahaan->count() > $total) {
                        $operator = $allMessagePerusahaan->count() - $total;
                        messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('id','asc')->limit($operator)->delete();
                    }
                    KandidatInterview::where('id_kandidat',$key->id_kandidat)->where('id_lowongan',$key->id_lowongan)->delete();
                    // jika belum terdaftar memiliki credit
                    if($credit == null){
                        CreditPerusahaan::create([
                            'id_perusahaan' => $perusahaan->id_perusahaan,
                            'nama_perusahaan' => $perusahaan->nama_perusahaan,
                            'no_nib' => $perusahaan->no_nib,
                            'credit' => 1,
                        ]);
                    } else {
                        // menambah credit
                        CreditPerusahaan::where('credit_id',$credit->credit_id)->update([
                            'credit' => $credit->credit+1,                    
                        ]);
                    }
                }
            }
        }
        // mencari data kandidat interview yang terjadwal
        $kandidat_interview_check = KandidatInterview::where('id_interview',$interview->id_interview)->where('status',"terjadwal")->get();
        // jika data kandidat interview kosong
        if($kandidat_interview_check->count() == 0){
            Interview::where('id_interview',$interview->id_interview)->where('id_lowongan',$id)->delete();
        }
        // jika interview lowongan terjadwal
        if($interview->status == "terjadwal"){
            return view('perusahaan/interview/lihat_jadwal_interview',compact('perusahaan','notif','pesan','credit','kandidat','id'));
        } else {
            return redirect('/perusahaan/jadwal_interview/'.$lowongan->id_lowongan)->with('warning',"Harap selesaikan penjadwalan interview terlebih dahulu");
        }
    }

    // halaman seleksi kandidat setelah interview
    public function seleksiKandidat($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('check_click',"n")->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $lowongan = LowonganPekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_lowongan',$id)->first();
        $interview = Interview::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_lowongan',$lowongan->id_lowongan)->first();
        $kandidat = KandidatInterview::where('id_interview',$interview->id_interview)->where('id_lowongan',$id)->where('persetujuan',"ya")->get();
        // $kandidat_interview = KandidatInterview::join(
        //     'kandidat', 'kandidat_interviews.id_kandidat','=','kandidat.id_kandidat'
        // )
        // ->where('kandidat_interviews.id_interview',$interview->id_interview)->where('kandidat_interviews.status',"berakhir")->get();
        return view('perusahaan/lowongan/seleksi_kandidat',compact('perusahaan','lowongan','kandidat','notif','pesan','credit','id'));
    }

    // sistem terima kandidat di perusahaan
    public function terimaSeleksiKandidat(Request $request, $id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $id_kandidat = $request->id_kandidat;
        $now = date('Y-m-d');
        $lowongan = LowonganPekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_lowongan',$id)->first();
        $interview = Interview::where('id_lowongan',$id)->where('id_perusahaan',$perusahaan->id_perusahaan)->first();
        // jika tidak ada kandidat dipilih
        if($id_kandidat == null){
            return redirect()->back()->with('error',"Harap pilih setidaknya 1 kandidat");
        }
        // mendata kandidat yang dipilih
        for($k = 0; $k < count($id_kandidat); $k++){
            // ubah data kandidat menjadi sudah diambil / diterima di perusahaan
            Kandidat::where('id_kandidat',$id_kandidat[$k])->where('id_perusahaan',$perusahaan->id_perusahaan)->update([
                'stat_pemilik' => "diterima", 
                'jabatan_kandidat' => $lowongan->jabatan,
            ]);

            // membuat laporan kandidat sudah bekerja di perusahaan
            $kandidat = Kandidat::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_kandidat',$id_kandidat[$k])->first();
            $data['nama_kandidat'] = $kandidat->nama;
            $data['id_kandidat'] = $id_kandidat[$k];
            $data['tmp_bekerja'] = $perusahaan->nama_perusahaan;
            $data['jabatan'] = $lowongan->jabatan;
            $data['tgl_kerja'] = $now;
            LaporanPekerja::create($data);

            // membuat pesan kepada kandidat bahwa sudah diterima di perusahaan
            $mesgeK['id_kandidat'] = $id_kandidat[$k];
            $mesgeK['pesan'] = "Selamat!! Anda kini telah di terima di Perusahaan ".$perusahaan->nama_perusahaan.". Untuk info selanjutnya, harap untuk selalu memeriksa pesan dari kami.";
            $mesgeK['pengirim'] = $perusahaan->nama_perusahaan;
            $mesgeK['kepada'] = $kandidat->nama;
            $mesgeK['id_perusahaan'] = $perusahaan->id_perusahaan;
            messageKandidat::create($mesgeK);
            
            // membatasi pesan kandidat sebanyak 30 pesan
            $allMessage = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->get();
            $total = 30;
            if ($allMessage->count() > $total) {
                $operator = $allMessage->count() - $total;
                messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('id','asc')->limit($operator)->delete();
            }
            
            // menghapus data permohonan lowongan / pelamar dan kandidat interview
            PermohonanLowongan::where('id_lowongan',$lowongan->id_lowongan)->where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_kandidat',$id_kandidat[$k])->delete();
            KandidatInterview::where('id_interview',$interview->id_interview)->where('id_lowongan',$id)->delete();
        }
        // mencari data kandidat yang tidak diterima di perusahaan
        $kandidat_interview = KandidatInterview::where('id_interview',$interview->id_interview)->where('id_lowongan',$id)->get();
        if($kandidat_interview->count() !== 0){
            foreach($kandidat_interview as $key){
                messageKandidat::create([
                    'id_kandidat' => $key->id_kandidat,
                    'pesan' => "Mohon maaf, Anda tidak diterima dalam perusahaan ".$perusahaan->nama_perusahaan.". Jangan terlalu cepat menyerah, dan cobalah untuk melamar di perusahaan lain yang masih membutuhkan kandidat seperti anda.",
                    'pengirim' => $perusahaan->nama_perusahaan,
                    'kepada' => $key->nama,
                    'id_perusahaan' => $perusahaan->id_perusahaan,
                ]);
                
                $allMessage = messageKandidat::where('id_kandidat',$key->id_kandidat)->get();
                $total = 30;
                if ($allMessage->count() > $total) {
                    $operator = $allMessage->count() - $total;
                    messageKandidat::where('id_kandidat',$key->id_kandidat)->orderBy('id','asc')->limit($operator)->delete();
                }
                // ubah data kandidat menjadi stat pemilik kosong
                Kandidat::where('id_kandidat',$key->id_kandidat)->where('id_perusahaan',$perusahaan->id_perusahaan)->update([
                    'stat_pemilik' => null, 
                    'jabatan_kandidat' => null,
                    'id_perusahaan' => null,
                ]);
                KandidatInterview::where('id_interview',$interview->id_interview)->where('id_lowongan',$id)->where('id_kandidat',$key->id_kandidat)->delete();
                PermohonanLowongan::where('id_lowongan',$lowongan->id_lowongan)->where('id_kandidat',$key->id_kandidat)->delete();
            }
        }
        Interview::where('id_interview',$interview->id_interview)->delete();
        return redirect('/perusahaan/list/kandidat/lowongan/'.$id)->with('success',"Selammat!! Anda kini memiliki kandidat baru");
    }

    // sistem menolak semua kandidat interview
    public function tolakSeleksiKandidat($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $interview = Interview::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_lowongan',$id)->first();
        $kandidat_interview = KandidatInterview::where('id_interview',$interview->id_interview)->where('id_lowongan',$id)->get();
        // mendata semua kandidat yang interview
        foreach($kandidat_interview as $key){
            // ubah data stat pemilik kandidat menjadi kosong
            Kandidat::where('id_kandidat',$key->id_kandidat)->update([
                'stat_pemilik' => null,
                'id_perusahaan' => null,
            ]);
            
            messageKandidat::create([
                'id_kandidat' => $key->id_kandidat,
                'pesan' => "Mohon maaf, Anda tidak diterima dalam perusahaan ".$perusahaan->nama_perusahaan.". Jangan terlalu cepat menyerah, dan cobalah untuk melamar di perusahaan lain yang masih membutuhkan kandidat seperti anda.",
                'pengirim' => $perusahaan->nama_perusahaan,
                'kepada' => $key->nama,
                'id_perusahaan' => $perusahaan->id_perusahaan,
            ]);
            
            $allMessage = messageKandidat::where('id_kandidat',$key->id_kandidat)->get();
            $total = 30;
            if ($allMessage->count() > $total) {
                $operator = $allMessage->count() - $total;
                messageKandidat::where('id_kandidat',$key->id_kandidat)->orderBy('id','asc')->limit($operator)->delete();
            }
            KandidatInterview::where('id_interview',$interview->id_interview)->where('id_lowongan',$id)->where('id_kandidat',$key->id_kandidat)->delete();
            PermohonanLowongan::where('id_lowongan',$id)->where('id_kandidat',$key->id_kandidat)->delete();
        }
        Interview::where('id_interview',$interview->id_interview)->delete();
        return redirect('/perusahaan')->with('success',"Penolakan kandidat interview berhasil");
    }
}