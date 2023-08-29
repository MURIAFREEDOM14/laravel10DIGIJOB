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
use App\Models\PerusahaanCabang;
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
    public function negaraTujuan()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        $negara_perusahaan = PerusahaanNegara::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $negara = Negara::where('negara_id','not like',2)->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/recruitment/negara_tujuan',compact('perusahaan','negara_perusahaan','notif','pesan','negara','cabang','credit'));
    }

    public function tambahNegaraTujuan()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/recruitment/tambah_negara_tujuan',compact('perusahaan','notif','pesan','cabang','credit'));
    }

    public function simpanNegaraTujuan(Request $request)
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        $negara = Negara::where('negara_id',$request->negara_id)->first();
        PerusahaanNegara::create([
            'nama_negara' => $negara->negara,
            'negara_id' => $negara->negara_id,
            'id_perusahaan' => $perusahaan->id_perusahaan,
            'mata_uang' => $negara->mata_uang,
        ]);
        return redirect()->route('perusahaan.negara');
    }

    public function lihatPerusahaanJob($id, $nama)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $pekerjaan = Pekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('negara_id',$id)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/recruitment/lihat_job',compact('id','nama','perusahaan','notif','pesan','pekerjaan','cabang','credit'));
    }

    public function tambahPerusahaanJob($id, $nama)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/recruitment/tambah_job',compact('perusahaan','notif','pesan','id','nama','cabang','credit'));
    }

    public function simpanPerusahaanJob(Request $request,$id,$nama)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        Pekerjaan::create([
            'nama_pekerjaan' => $request->nama_pekerjaan,
            'syarat_umur' => $request->syarat_umur,
            'syarat_kelamin' => $request->syarat_kelamin,
            'negara_id' => $id,
            'id_perusahaan' => $perusahaan->id_perusahaan,
        ]);
        return redirect('/perusahaan/pekerjaan/'.$id.'/'.$nama)
        // ->with('toast_success',"Data Ditambahkan");
        ->with('success',"Data Ditambahkan");
    }

    public function editPerusahaanJob($kerjaid,$id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pekerjaan = Pekerjaan::where('id_pekerjaan',$kerjaid)->first();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/recruitment/edit_job',compact('perusahaan','notif','pesan','pekerjaan','id','kerjaid','cabang','credit'));
    }

    public function ubahPerusahaanJob(Request $request, $kerjaid,$id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $negara = Negara::where('negara_id',$id)->first();
        Pekerjaan::where('id_pekerjaan',$kerjaid)->update([
            'nama_pekerjaan' => $request->nama_pekerjaan,
            'syarat_umur' => $request->syarat_umur,
            'syarat_kelamin' => $request->syarat_kelamin,
        ]);
        return redirect('/perusahaan/pekerjaan/'.$negara->negara_id.'/'.$negara->negara)
        // ->with('toast_success',"Data diubah");
        ->with('success',"Data diubah");
    }

    public function hapusPerusahaanJob($kerjaid)
    {
        Pekerjaan::where('id_pekerjaan',$kerjaid)->delete();
        return back()
        // ->with('toast_success','Pekerjaan Berhasil Dihapus');
        ->with('success','Pekerjaan Berhasil Dihapus');
    }

    public function cariKandidatStaff()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $isi = "";
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/kandidat/cari_staff',compact('perusahaan','notif','pesan','cabang','isi','credit'));
    }

    public function pencarianKandidatStaff(Request $request)
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        $provinsi = Provinsi::where('id',$request->provinsi_id)->first();
        $kota = Kota::where('id',$request->kota_id)->first();
        if($provinsi !== null){
            $prov = $provinsi->provinsi;
            if ($kota !== null) {
                $kab = $kota->kota;
            } else {
                $kab = "";
            }
        } else {
            $prov = "";
            $kab ="";
        }

        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $kandidat = Kandidat::
        where('usia','>=',$request->usia)
        ->where('jenis_kelamin','like','%'.$request->jenis_kelamin.'%')
        ->where('pendidikan','like','%'.$request->pendidikan.'%')
        ->where('tinggi','>=','%'.$request->tinggi.'%')
        ->where('berat','>=','%'.$request->berat.'%')
        ->where('provinsi','like','%'.$prov.'%')
        ->where('kabupaten','like','%'.$kab.'%')
        ->where('lama_kerja','>=','%'.$request->pengalaman.'%')
        ->get();
        $isi = $kandidat->count();
        return view('perusahaan/kandidat/cari_staff',compact('perusahaan','notif','pesan','cabang','isi','credit'));
    }

    public function lowonganPekerjaan($type)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        if($type == "dalam"){
            $lowongan = LowonganPekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('negara','like','%Indonesia%')->get();            
        } else {
            $lowongan = LowonganPekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('negara','not like','%Indonesia%')->get();
        }
        return view('perusahaan/lowongan/lowongan_pekerjaan',compact('perusahaan','notif','pesan','lowongan','cabang','credit','type'));
    }

    public function tambahLowongan($type)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $benefit = Benefit::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $fasilitas = Fasilitas::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        if($type == "dalam"){
            $negara = Negara::where('negara','like',"%Indonesia%")->first();
        } else {
            $negara = Negara::where('negara','not like',"%Indonesia%")->get();
        }
        $jenis_pekerjaan = JenisPekerjaan::all();
        return view('perusahaan/lowongan/tambah_lowongan',compact('perusahaan','notif','pesan','cabang','credit','negara','jenis_pekerjaan','type','benefit','fasilitas'));
    }

    protected function lowonganNegara(Request $request)
    {
        $data = Negara::where('negara',$request->negara)->first();
        return response()->json($data);
    }

    protected function lowonganBenefit(Request $request)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $benefits = $request->validate([
            'data' => 'required',
        ]);
        Benefit::create([
            'benefit' => $request->data,
            'id_perusahaan' => $perusahaan->id_perusahaan,
        ]);
        $data = Benefit::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        return response()->json($data);
    }

    protected function lowonganFasilitas(Request $request)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $fasilitas = $request->validate([
            'data' => 'required',
        ]);
        Fasilitas::create([
            'fasilitas' => $request->data,
            'id_perusahaan' => $perusahaan->id_perusahaan,
        ]);
        $data = Fasilitas::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        return response()->json($data);
    }

    public function simpanLowongan(Request $request,$type)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $penempatan = Negara::where('negara',$request->penempatan)->first();
        if($type == "dalam"){
            $lvl_pekerjaan = $request->lvl_pekerjaan;
        } else {
            $jenis_pekerjaan = JenisPekerjaan::where('judul',$request->lvl_pekerjaan)->first();
            $lvl_pekerjaan = $jenis_pekerjaan->nama;
        }
        if($request->berat_badan == "ideal"){
            $berat_min = $request->tinggi - 110;
            $berat_maks = $request->tinggi - 90;
        } else {
            $validated = $request->validate([
                'berat_min' => 'required',
                'berat_maks' => 'required',
            ]);
            $berat_min = $request->berat_min;
            $berat_maks = $request->berat_maks;
        }
        if($request->benefit !== null){
            $benefit = implode(", ",$request->benefit); 
        } else {
            $benefit = null;
        }
        if($request->fasilitas !== null){
            $fasilitas = implode(", ",$request->fasilitas);
        } else {
            $fasilitas = null;
        }
        if($request->pengalaman_kerja !== null){
            $pengalaman = implode(", ",$request->pengalaman_kerja);
        } else {
            $pengalaman = null;
        }
        if($request->file('gambar') !== null) {
            $gambar = $perusahaan->nama_perusahaan.$request->jabatan.time().'.'.$request->gambar->extension();  
            $gambar_lowongan = $request->file('gambar');
            $gambar_lowongan->move('gambar/Perusahaan/'.$perusahaan->nama_perusahaan.'/Lowongan Pekerjaan/',$perusahaan->nama_perusahaan.$request->jabatan.time().'.'.$gambar_lowongan->extension());
        } else {
            $gambar = null;
        }
        if($gambar !== null) {
            $gambar_flyer = $gambar;
        } else {
            $gambar_flyer = null;
        }

        if ($penempatan !== null) {
            $mata_uang = $penempatan->mata_uang;
            $negara_id = $penempatan->negara_id;
            $penempatan = $penempatan->negara;
        } else {
            $mata_uang = null;
            $negara_id=null;
            $penempatan = null;
        }
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

    public function lihatLowongan($id,$type)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->first();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/lowongan/lihat_lowongan',compact('perusahaan','lowongan','pesan','notif','cabang','credit','type'));
    }

    public function editLowongan($id,$type)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->first();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $benefit = Benefit::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $fasilitas = Fasilitas::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        if($type == "dalam") {
            $negara = Negara::where('negara','like',"%Indonesia%")->first();
        } else {
            $negara = Negara::where('negara','not like',"%Indonesia%")->get();
        }        
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $jenis_pekerjaan = JenisPekerjaan::all();
        return view('perusahaan/lowongan/edit_lowongan',compact('perusahaan','pesan','notif','lowongan','cabang','negara','credit','jenis_pekerjaan','type','benefit','fasilitas'));
    }

    public function updateLowongan(Request $request, $id, $type)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->first();
        $penempatan = Negara::where('negara',$request->penempatan)->first();
        if($request->file('gambar') !== null){
            // $this->validate($request, [
            //     'foto_perusahaan' => 'required|file|image|mimes:jpeg,png,jpg|max:1024',
            // ]);
            $hapus_gambar_lowongan = public_path('gambar/Perusahaan/'.$perusahaan->nama_perusahaan.'/Lowongan Pekerjaan/').$lowongan->gambar_lowongan;
            if(file_exists($hapus_gambar_lowongan)){
                @unlink($hapus_gambar_lowongan);
            }
            $gambar = $perusahaan->nama_perusahaan.$request->jabatan.time().'.'.$request->gambar->extension();  
            $gambar_lowongan = $request->file('gambar');
            $gambar_lowongan->move('gambar/Perusahaan/'.$perusahaan->nama_perusahaan.'/Lowongan Pekerjaan/',$perusahaan->nama_perusahaan.$request->jabatan.time().'.'.$gambar_lowongan->extension());
        } else {
            if($lowongan->gambar_lowongan !== null){
                $gambar = $lowongan->gambar_lowongan;                
            } else {
                $gambar = null;    
            }
        }
        if($request->berat_badan == "ideal"){
            $berat_min = $request->tinggi - 110;
            $berat_maks = $request->tinggi - 90;
        } else {
            $validated = $request->validate([
                'berat_min' => 'required',
                'berat_maks' => 'required',
            ]);
            $berat_min = $request->berat_min;
            $berat_maks = $request->berat_maks;
        }
        if($gambar !== null) {
            $gambar_flyer = $gambar;
        } else {
            $gambar_flyer = null;
        }
        if($request->benefit !== null){
            $benefit = implode(", ",$request->benefit); 
        } else {
            $benefit = null;
        }
        if($request->fasilitas !== null){
            $fasilitas = implode(", ",$request->fasilitas);
        } else {
            $fasilitas = null;
        }
        if($request->pengalaman_kerja !== null){
            $pengalaman = implode(", ",$request->pengalaman_kerja);
        } else {
            $pengalaman = null;
        }
        if($penempatan !== null){
            $mata_uang = $penempatan->mata_uang;
            $negara_id = $penempatan->negara_id;
            $penempatan = $penempatan->negara;
        } else {
            $mata_uang = null;
            $negara_id = null;
            $penempatan = null;
        }
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

    public function hapusLowongan($id,$type)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->delete();
        $datetime  = date('y-m-d');
        // if($lowongan->ttp_lowongan == 'y-m-d'){
        //     LowonganPekerjaan::where('ttp_lowongan',$datetime)->delete();
        // }
        if($perusahaan->penempatan_kerja == "Dalam negeri"){
            return redirect('/perusahaan/list/lowongan/dalam')->with('success','Lowongan telah dihapus');
        } elseif($perusahaan->penempatan_kerja == "Luar negeri"){
            return redirect('/perusahaan/list/lowongan/luar')->with('success','Lowongan telah dihapus');
        }
    }

    public function lowonganKandidatSesuai($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        if($lowongan->usia_min == null || $lowongan->usia_maks == null || $lowongan->berat_min == null || $lowongan->berat_maks == null){
            if($lowongan->negara == "Indonesia")
            {
                return redirect('/perusahaan/edit_lowongan/'.$id.'/dalam')->with('warning',"Maaf data lowongan anda ada yang kosong. Harap lengkapi kembali lowongan anda");
            } else {
                return redirect('/perusahaan/edit_lowongan/'.$id.'/luar')->with('warning',"Maaf data lowongan anda ada yang kosong. Harap lengkapi kembali lowongan anda");
            }
        }
        $kandidat = Kandidat::join(
            'pendidikans', 'kandidat.pendidikan','=','pendidikans.nama_pendidikan'
        )
        ->where('kandidat.tinggi','>=',$lowongan->tinggi)
        ->where('kandidat.usia','>=',$lowongan->usia_min)
        ->where('kandidat.usia','<=',$lowongan->usia_maks)
        ->where('kandidat.berat','>=',$lowongan->berat_min)
        ->where('kandidat.berat','<=',$lowongan->berat_maks)
        ->whereNull('kandidat.stat_pemilik')->get();
        // dd("Tinggi == ".$kandidat->tinggi, "Lowongan tinggi == ".$lowongan->tinggi,
        // "Usia == ".$kandidat->usia, "Lowongan Usia Min == ".$lowongan->usia_min, "Lowongan Usia Maks == ".$lowongan->usia_maks,
        // "Berat == ".$kandidat->berat, "Lowongan Berat Min == ".$lowongan->berat_min, "Lowongan Berat Maks == ".$lowongan->berat_maks);
        $p_lowongan = Pendidikan::where('nama_pendidikan','like','%'.$lowongan->pendidikan.'%')->first();
        $isi = $kandidat->count();
        return view('perusahaan/lowongan/lowongan_sesuai',compact('perusahaan','lowongan','isi','kandidat','pesan','notif','credit','p_lowongan','id'));
    }

    public function listPermohonanLowongan()
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $lowongan = LowonganPekerjaan::where('lowongan_pekerjaan.id_perusahaan',$perusahaan->id_perusahaan)->get();
        return view('perusahaan/lowongan/list_permohonan_lowongan',compact('perusahaan','lowongan','pesan','notif','cabang','credit'));
    }

    public function lihatPermohonanLowongan($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $interview = KandidatInterview::where('id_lowongan',$id)->where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $permohonan = PermohonanLowongan::join(
            'kandidat', 'permohonan_lowongan.id_kandidat','=','kandidat.id_kandidat'
        )
        ->where('kandidat.id_perusahaan',$perusahaan->id_perusahaan)->whereNull('kandidat.stat_pemilik')->where('id_lowongan',$id)->get();
        $isi = $permohonan->count();
        return view('perusahaan/lowongan/lihat_permohonan_lowongan',compact('perusahaan','permohonan','pesan','notif','cabang','isi','credit','id','interview'));
    }

    public function confirmPermohonanLowongan(Request $request, $id)
    {
        $auth = Auth::user();
        $id_kandidat = $request->id_kandidat;
        $perusahaan = Perusahaan::where('no_nib',$auth->no_nib)->first();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->where('id_perusahaan',$perusahaan->id_perusahaan)->first();
        if($id_kandidat == null){
            return redirect()->back()->with('error','Anda harus memilih minimal 1 kandidat');
        }
        
        for($a = 0; $a < count($id_kandidat); $a++){                
            $kandidat = Kandidat::where('id_kandidat',$id_kandidat[$a])->first();
            
            $k['id_lowongan'] = $id;
            $k['id_perusahaan'] = $perusahaan->id_perusahaan;
            $k['id_kandidat'] = $kandidat->id_kandidat;
            $k['nama'] = $kandidat->nama;
            $k['usia'] = $kandidat->usia;
            $k['jenis_kelamin'] = $kandidat->jenis_kelamin;
            KandidatInterview::create($k);

            $permohonan_data = PermohonanLowongan::where('id_kandidat',$kandidat->id_kandidat)->where('id_perusahaan',$perusahaan->id_perusahaan)->first();
                if($permohonan_data !== null){
                    PermohonanLowongan::where('id_kandidat',$kandidat->id_kandidat)->where('id_perusahaan',$perusahaan->id_perusahaan)->update([
                        'confirm'=>$kandidat->id_kandidat,
                    ]);

                    Kandidat::where('id_kandidat',$id_kandidat[$a])->update([
                        'stat_pemilik' => "diambil",
                    ]);                    
                } 
        }                  
        return redirect('/perusahaan/kandidat_lowongan_dipilih/'.$id);
    }

    public function kandidatLowonganDipilih($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $kandidat = KandidatInterview::join(
            'kandidat', 'kandidat_interviews.id_kandidat','=','kandidat.id_kandidat'
        )
        ->where('kandidat_interviews.id_lowongan',$id)->where('kandidat_interviews.id_perusahaan',$perusahaan->id_perusahaan)->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $interview = Interview::where('id_lowongan',$id)->first();
        if($interview !== null){
            $pembayaran = Pembayaran::where('id_interview',$interview->id_interview)->where('stats_pembayaran',"sudah dibayar")->first();
        } else {
            $pembayaran = null;
        }
        $isi = $kandidat->count();
        return view('perusahaan/lowongan/kandidat_lowongan_dipilih',compact('perusahaan','kandidat','notif','pesan','credit','id','interview','isi','pembayaran'));
    }

    public function cancelKandidatLowongan($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $kandidat = KandidatInterview::join(
            'kandidat', 'kandidat_interviews.id_kandidat','=','kandidat.id_kandidat'
        )
        ->where('kandidat_interviews.id_lowongan',$id)->where('kandidat_interviews.id_perusahaan',$perusahaan->id_perusahaan)->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/lowongan/batal_kandidat',compact('perusahaan','kandidat','notif','pesan','credit','id'));
    }

    public function confirmCancelKandidatLowongan(Request $request, $id)
    {
        if($request->id_kandidat == null){
            return redirect()->back()->with('warning','Anda harus memilih setidaknya 1 kandidat');
        }
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $id_kandidat = $request->id_kandidat;
        for($a = 0; $a < count($id_kandidat); $a++){
            KandidatInterview::where('id_lowongan',$id)->where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_kandidat',$id_kandidat[$a])->delete();
            Kandidat::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_kandidat',$id_kandidat[$a])->update([
                'stat_pemilik' => null,
            ]);
        }
        $interview = KandidatInterview::where('id_lowongan',$id)->where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        if($interview == null){
            Interview::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_lowongan',$id)->delete();
        }
        return redirect()->back()->with('success',"Kandidat telah dibatalkan");
    }

    public function kandidatDipilihInterview(Request $request, $id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $kandidat = KandidatInterview::where('id_lowongan',$id)->get();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->first();        
        $id_kandidat = $request->id_kandidat;
        $interview = Interview::create([
            'status' => "pilih",
            'id_lowongan' => $id,
            'id_perusahaan' => $perusahaan->id_perusahaan,
            'jadwal_interview_awal' => $lowongan->tgl_interview_awal,
            'jadwal_interview_akhir' => $lowongan->tgl_interview_akhir,
        ]);

        for($k = 0; $k < count($id_kandidat); $k++){
            KandidatInterview::where('id_kandidat',$id_kandidat[$k])->update([
                'id_interview' => $interview->id,
            ]);    
        }
        
        return redirect('/perusahaan/jadwal_interview/'.$id)->with('success','Kandidat Telah ditentukan');
    }

    public function jadwalInterview($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $lowongan = LowonganPekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_lowongan',$id)->first();
        $interview_awal = new Carbon ($lowongan->tgl_interview_awal);
        $interview_akhir = new Carbon ($lowongan->tgl_interview_akhir);
        $jadwal = CarbonPeriod::create($interview_awal, $interview_akhir);
        $kandidat = Interview::join(
            'kandidat_interviews', 'interview.id_interview','=','kandidat_interviews.id_interview'
        )
        ->where('interview.id_perusahaan',$perusahaan->id_perusahaan)->where('kandidat_interviews.id_lowongan',$id)->get();
        $check = $kandidat->count();
        if($check > 0){
            return view('perusahaan/jadwal_interview',compact('perusahaan','notif','pesan','cabang','credit','lowongan','kandidat','jadwal','check'));
        } else {
            return redirect('/perusahaan/list_permohonan_lowongan')->with('error',"Maaf anda harus punya pelamar untuk mengatur jadwal interview");
        }
    }

    public function confirmJadwalInterview(Request $request, $id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $kandidat = KandidatInterview::where('id_lowongan',$id)->get();
        $jadwal = $request->dater;
        $flag = $request->urutan;
        $id_kandidat = $request->id_kandidat;
        for($t = 0; $t < count($jadwal); $t++){
            KandidatInterview::where('id_lowongan',$id)->where('id_kandidat',$id_kandidat[$t])->update([
                'jadwal_interview' => $jadwal[$t],
                'urutan' => $flag[$t],
            ]);
        }
        return redirect('/perusahaan/waktu_interview/'.$id)->with('success',"Jadwal Ditentukan");
    }

    public function waktuInterview($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $kandidat = KandidatInterview::where('id_lowongan',$id)->orderBy('urutan','asc')->get();
        return view('perusahaan/waktu_interview',compact('perusahaan','notif','pesan','cabang','credit','kandidat'));
    }

    public function confirmWaktuInterview(Request $request, $id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->first();
        Interview::where('id_lowongan',$id)->where('id_perusahaan',$perusahaan->id_perusahaan)->update([
            'status' => "terjadwal",
        ]);
        $interview = Interview::where('id_lowongan',$id)->where('id_perusahaan',$perusahaan->id_perusahaan)->first();
        $id_kandidat = $request->id_kandidat;
        $timer = $request->timer;
        $durasi = $request->durasi;
        for($w = 0; $w < count($durasi); $w++){
            $waktu_akhir = Carbon::create($timer[$w])->addMinutes($durasi[$w]);
            KandidatInterview::where('id_lowongan',$id)->update([
                'waktu_interview_awal' => $timer[$w],
                'waktu_interview_akhir' => $waktu_akhir,
                'durasi_interview' => $durasi[$w],
                'status' => "terjadwal",
            ]);
        }

        $total = count($id_kandidat);
        $payment = 15000 * $total;
        $nama_rec = "PT HARAPAN MENTARI PAGI";
        $bank = "PT Bank Central Asia Tbk";
        $nomo_rec = 4399997272;
        $token = User::where('no_nib',$perusahaan->no_nib)->first();
        Pembayaran::create([
            'id_perusahaan' => $perusahaan->id_perusahaan,
            'nama_pembayaran' => $perusahaan->nama_perusahaan,
            'nominal_pembayaran' => $payment,
            'stats_pembayaran' => "belum dibayar",
            'nib' => $perusahaan->no_nib,
            'id_lowongan' => $id,
            'id_interview' => $interview->id_interview,
        ]);
        Mail::mailer('payment')->to($perusahaan->email_perusahaan)->send(new Payment($perusahaan->nama_perusahaan, $token->token, $payment, 'Pembayaran Interview', 'digijobaccounting@ugiport.com', $nama_rec, $nomo_rec, $bank));
        return redirect('/perusahaan/list/pembayaran')->with('success',"Proses Pembayaran sedang dikirimkan ke email anda.");
    }



    public function lihatJadwalInterview($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $lowongan = LowonganPekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_lowongan',$id)->first();
        $interview = Interview::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_lowongan',$id)->first();
        $kandidat = KandidatInterview::where('id_interview',$interview->id_interview)->get();
        $kandidat_berakhir = KandidatInterview::where('status','like',"berakhir")->get();
        if($interview->status == "terjadwal"){
            return view('perusahaan/lihat_jadwal_interview',compact('perusahaan','notif','pesan','credit','kandidat','kandidat_berakhir','id'));
        } else {
            return redirect('/perusahaan/jadwal_interview/'.$lowongan->id_lowongan)->with('warning',"Harap selesaikan penjadwalan interview terlebih dahulu");
        }
    }

    // public function persetujuanKandidat($id)
    // {
    //     $user = Auth::user();
    //     $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
    //     $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
    //     $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
    //     $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
    //     $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
    //     $interview = Interview::where('id_lowongan',$id)->first();
    //     $persetujuan = PersetujuanKandidat::where('id_lowongan',$id)->where('id_interview',$interview->id_interview)->get();
    //     $isi = $persetujuan->count();
    //     return view('perusahaan/recruitment/persetujuan_kandidat',compact('perusahaan','notif','pesan','cabang','persetujuan','isi','credit'));
    // }

    // public function confirmPersetujuanKandidat(Request $request,$id)
    // {   
    //     $user = Auth::user();
    //     $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
    //     $kandidat_menerima = $request->menerima;
    //     $kandidat_menolak = $request->menolak;
    //     $interview = Interview::where('id_lowongan',$id)->first();
    //     $persetujuan = PersetujuanKandidat::join(
    //         'kandidat_interviews', 'persetujuan_kandidat.id_kandidat','=','kandidat_interviews.id_kandidat'
    //     )->where('kandidat_interviews.id_interview',$interview->id_interview)->where('kandidat_interviews.id_lowongan',$id)->where('persetujuan_kandidat.persetujuan','like','ya')->get();
    //     dd($persetujuan);
    //     if($kandidat_menerima == null){
    //         return redirect('/perusahaan/persetujuan_kandidat')->with('error',"Maaf belum ada kandidat yang menyetujui");
    //     }
    //     foreach($persetujuan as $key){
    //         if($key->id_kandidat == $kandidat_interview)
    //         notifyKandidat::create([
    //             'id_kandidat' => $key->id_kandidat,
    //             'isi' => "Anda mendapat pesan dari perusahaan",
    //             'pengirim' => "Sistem",
    //             'url' => '/semua_pesan',
    //         ]);

    //         messageKandidat::create([
    //             'id_kandidat' => $key->id_kandidat,
    //             'pesan' => "Terima kasih untuk konfirmasi persetujuan interview anda. Berikut ini adalah jadwal interview perusahaan untuk anda. Harap untuk mengigat jadwal interview ini dan jangan sampai terlambat. Jadwal interview anda : ".date('d m Y',strtotime($key->jadwal_interview)).", dan waktu interview anda : ".date('h:i:s',strtotime($key->waktu_interview_awal))." sampai ".date('h:i:s',strtotime($key->waktu_interview_akhir))." .",
    //             'pengirim' => "Admin",
    //             'kepada' => $key->nama_kandidat,
    //             'id_interview' => $interview->id_interview,
    //         ]);
    //     }
    //     return redirect('/perusahaan/lihat_jadwal_interview/'.$id)->with('success',"");
    // }

    public function seleksiKandidat($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $lowongan = LowonganPekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_lowongan',$id)->first();
        $interview = Interview::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_lowongan',$lowongan->id_lowongan)->first();
        $kandidat = KandidatInterview::where('id_interview',$interview->id_interview)->where('id_lowongan',$id)->get();
        // $kandidat_interview = KandidatInterview::join(
        //     'kandidat', 'kandidat_interviews.id_kandidat','=','kandidat.id_kandidat'
        // )
        // ->where('kandidat_interviews.id_interview',$interview->id_interview)->where('kandidat_interviews.status',"berakhir")->get();
        return view('perusahaan/lowongan/seleksi_kandidat',compact('perusahaan','lowongan','kandidat','notif','pesan','credit','id'));
    }

    public function terimaSeleksiKandidat(Request $request, $id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $id_kandidat = $request->id_kandidat;
        $now = date('Y-m-d');
        $lowongan = LowonganPekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_lowongan',$id)->first();
        $interview = Interview::where('id_lowongan',$id)->where('id_perusahaan',$perusahaan->id_perusahaan)->first();
        if($id_kandidat == null){
            return redirect()->back()->with('error',"Harap pilih setidaknya 1 kandidat");
        }
        for($k = 0; $k < count($id_kandidat); $k++){
            Kandidat::where('id_kandidat',$id_kandidat[$k])->where('id_perusahaan',$perusahaan->id_perusahaan)->update([
                'stat_pemilik' => "diterima", 
                'jabatan_kandidat' => $lowongan->jabatan,
            ]);

            $kandidat = Kandidat::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_kandidat',$id_kandidat[$k])->first();
            $data['nama_kandidat'] = $kandidat->nama;
            $data['id_kandidat'] = $id_kandidat[$k];
            $data['tmp_bekerja'] = $perusahaan->nama_perusahaan;
            $data['jabatan'] = $lowongan->jabatan;
            $data['tgl_kerja'] = $now;
            LaporanPekerja::create($data);

            $notyK['id_kandidat'] = $id_kandidat[$k];
            $notyK['isi'] = "Selamat!! Anda diterima di sebuah perusahaan. Periksa pesan untuk detail";
            $notyK['pengirim'] = "Admin";
            $notyK['url'] = '/semua_pesan';
            notifyKandidat::create($notyK);

            $mesgeK['id_kandidat'] = $id_kandidat[$k];
            $mesgeK['pesan'] = "Selamat!! Anda kini telah di terima di Perusahaan ".$perusahaan->nama_perusahaan.". Untuk info selanjutnya, harap untuk selalu memeriksa pesan dari kami.";
            $mesgeK['pengirim'] = "Admin";
            $mesgeK['kepada'] = $kandidat->nama;
            messageKandidat::create($mesgeK);
            
            PermohonanLowongan::where('id_lowongan',$lowongan->id_lowongan)->where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_kandidat',$id_kandidat[$k])->delete();
            KandidatInterview::where('id_interview',$interview->id_interview)->where('id_lowongan',$id)->delete();
        }
        notifyPerusahaan::create([
            'id_perusahaan' => $perusahaan->id_perusahaan,
            'isi' => "Selamat!! Ada mendapat kandidat baru di Perusahaan anda.",
            'pengirim' => "Admin",
            'url' => '/perusahaan/list/kandidat/lowongan/'.$id,
        ]);
        $kandidat_interview = KandidatInterview::where('id_interview',$interview->id_interview)->where('id_lowongan',$id)->get();
        if($kandidat_interview->count() !== 0){
            foreach($kandidat_interview as $key){
                Kandidat::where('id_kandidat',$key->id_kandidat)->update([
                    'stat_pemilik' => null,
                    'id_perusahaan' => null,
                ]);
                notifyKandidat::create([
                    'id_kandidat' => $key->id_kandidat,
                    'isi' => "Anda mendapat pesan dari Perusahaan",
                    'pengirim' => "Admin",
                    'url' => '/semua_pesan',
                ]);
                messageKandidat::create([
                    'id_kandidat' => $key->id_kandidat,
                    'pesan' => "Mohon maaf, Anda tidak diterima dalam perusahaan ".$perusahaan->nama_perusahaan.". Jangan terlalu cepat menyerah, dan cobalah untuk melamar di perusahaan lain yang masih membutuhkan kandidat seperti anda.",
                    'pengirim' => "Admin",
                    'kepada' => $key->nama,
                ]);
                KandidatInterview::where('id_interview',$interview->id_interview)->where('id_lowongan',$id)->where('id_kandidat',$key->id_kandidat)->delete();
                PermohonanLowongan::where('id_lowongan',$lowongan->id_lowongan)->where('id_kandidat',$key->id_kandidat)->delete();
            }
        }
        Interview::where('id_interview',$interview->id_interview)->delete();
        return redirect('/perusahaan/list/kandidat/lowongan/'.$id)->with('success',"Selammat!! Anda kini memiliki kandidat baru");
    }

    public function tolakSeleksiKandidat($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $interview = Interview::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_lowongan',$id)->first();
        $kandidat_interview = KandidatInterview::where('id_interview',$interview->id_interview)->where('id_lowongan',$id)->get();
        foreach($kandidat_interview as $key){
            Kandidat::where('id_kandidat',$key->id_kandidat)->update([
                'stat_pemilik' => null,
                'id_perusahaan' => null,
            ]);
            notifyKandidat::create([
                'id_kandidat' => $key->id_kandidat,
                'isi' => "Anda mendapat pesan dari Perusahaan",
                'pengirim' => "Admin",
                'url' => '/semua_pesan',
            ]);
            messageKandidat::create([
                'id_kandidat' => $key->id_kandidat,
                'pesan' => "Mohon maaf, Anda tidak diterima dalam perusahaan ".$perusahaan->nama_perusahaan.". Jangan terlalu cepat menyerah, dan cobalah untuk melamar di perusahaan lain yang masih membutuhkan kandidat seperti anda.",
                'pengirim' => "Admin",
                'kepada' => $key->nama,
            ]);
            KandidatInterview::where('id_interview',$interview->id_interview)->where('id_lowongan',$id)->where('id_kandidat',$key->id_kandidat)->delete();
        }
        Interview::where('id_interview',$interview->id_interview)->delete();
        return redirect('/perusahaan')->with('success',"Penolakan kandidat interview berhasil");
    }
}