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

    public function lowonganPekerjaan()
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $lowongan = LowonganPekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/lowongan_pekerjaan',compact('perusahaan','notif','pesan','lowongan','cabang','credit'));
    }

    public function tambahLowongan()
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        if($perusahaan->penempatan_kerja == "Dalam negeri"){
            $negara = Negara::where('negara','like',"%Indonesia%")->get();
        } else {
            $negara = Negara::where('negara','not like',"%Indonesia%")->get();
        }
        $jenis_pekerjaan = JenisPekerjaan::all();
        return view('perusahaan/tambah_lowongan',compact('perusahaan','notif','pesan','cabang','credit','negara','jenis_pekerjaan'));
    }

    protected function lowonganNegara(Request $request)
    {
        $data = Negara::where('negara',$request->negara)->first();
        return response()->json($data);
    }

    public function simpanLowongan(Request $request)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $penempatan = Negara::where('negara',$request->penempatan)->first();
        if($request->benefit !== null){
            $benefit = implode(", ",$request->benefit); 
        } else {
            $benefit = null;
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
            'pengalaman_kerja' => $request->pengalaman_kerja,
            'berat_min' => $request->berat_min,
            'berat_maks' => $request->berat_maks,
            'tinggi' => $request->tinggi,
            'pencarian_tmp' => $request->pencarian_tmp,
            'id_perusahaan' => $perusahaan->id_perusahaan,
            'isi' => $request->deskripsi,
            'negara' => $penempatan,
            'negara_id' => $negara_id,
            'ttp_lowongan' => $request->ttp_lowongan,
            'gambar_lowongan' => $gambar_flyer,
            'lvl_pekerjaan' => $request->lvl_pekerjaan,
            'mata_uang' => $mata_uang,
            'gaji_minimum' => $request->gaji_minimum,
            'gaji_maksimum' => $request->gaji_maksimum,
            'benefit' => $benefit,
        ]);
        return redirect('perusahaan/list/lowongan')->with('success');
    }

    public function lihatLowongan($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->first();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/lihat_lowongan',compact('perusahaan','lowongan','pesan','notif','cabang','credit'));
    }

    public function editLowongan($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->first();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        if($perusahaan->penempatan_kerja == "Dalam negeri") {
            $negara = Negara::where('negara','like',"%Indonesia%")->first();
        } else {
            $negara = Negara::where('negara','not like',"%Indonesia%")->get();
        }        
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $jenis_pekerjaan = JenisPekerjaan::all();
        return view('perusahaan/edit_lowongan',compact('perusahaan','pesan','notif','lowongan','cabang','negara','credit','jenis_pekerjaan'));
    }

    public function updateLowongan(Request $request, $id)
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

        if($penempatan !== null){
            $mata_uang = $penempatan->mata_uang;
            $penempatan = $penempatan->negara;
            $negara_id = $penempatan->negara_id;
        } else {
            $mata_uang = null;
            $penempatan = null;
            $negara_id = null;
        }
        LowonganPekerjaan::where('id_lowongan',$id)->update([
            'usia_min' => $request->usia_min,
            'usia_maks' => $request->usia_maks,
            'jabatan' => $request->jabatan,
            'pendidikan' => $request->pendidikan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pengalaman_kerja' => $request->pengalaman_kerja,
            'berat_min' => $request->berat_min,
            'berat_maks' => $request->berat_maks,
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
        ]);
        return redirect('/perusahaan/list/lowongan')->with('success');
    }

    public function hapusLowongan($id)
    {
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->delete();
        $datetime  = date('y-m-d');
        // if($lowongan->ttp_lowongan == 'y-m-d'){
        //     LowonganPekerjaan::where('ttp_lowongan',$datetime)->delete();
        // }
        return redirect('/perusahaan/list/lowongan')->with('success');
    }

    public function listPermohonanLowongan()
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $lowongan = LowonganPekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        return view('perusahaan/list_permohonan_lowongan',compact('perusahaan','lowongan','pesan','notif','cabang','credit'));
    }

    public function lihatPermohonanLowongan($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $permohonan = PermohonanLowongan::join(
            'kandidat', 'permohonan_lowongan.id_kandidat','=','kandidat.id_kandidat'
        )
        ->where('kandidat.id_perusahaan',$perusahaan->id_perusahaan)->whereNull('kandidat.stat_pemilik')->where('id_lowongan',$id)->get();
        $isi = $permohonan->count();
        return view('perusahaan/lihat_permohonan_lowongan',compact('perusahaan','permohonan','pesan','notif','cabang','isi','credit','id'));
    }

    public function confirmPermohonanLowongan(Request $request, $id)
    {
        $auth = Auth::user();
        $id_kandidat = $request->id_kandidat;
        $id_lowongan = $request->id_lowongan;
        $perusahaan = Perusahaan::where('no_nib',$auth->no_nib)->first();
        $permohonan = PermohonanLowongan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_lowongan',$id_lowongan)->get();
        if($id_kandidat == null){
            return redirect('/perusahaan/lihat_permohonan_lowongan/'.$id)->with('error','anda harus memilih minimal 1 kandidat');
        }
        for($a = 0; $a < count($id_kandidat); $a++){                
            $kandidat = Kandidat::where('id_kandidat',$id_kandidat[$a])->first();
            $input['id_kandidat'] = $kandidat->id_kandidat;
            $input['nama_kandidat'] = $kandidat->nama;
            $input['status'] = "pilih";
            $input['usia'] = $kandidat->usia;
            $input['jenis_kelamin'] = $kandidat->jenis_kelamin;
            $input['pengalaman_kerja'] = $kandidat->pengalaman_kerja;
            $input['id_perusahaan'] = $perusahaan->id_perusahaan;
            Interview::create($input);
            
            $data['id_kandidat'] = $kandidat->id_kandidat;
            $data['nama_kandidat'] = $kandidat->nama;
            $data['id_perusahaan'] = $perusahaan->id_perusahaan;
            PersetujuanKandidat::create($data);

            // Kandidat::where('id_kandidat',$id_kandidat[$a])->update([
            //     'stat_pemilik' => "kosong",
            // ]);
            
            $permohonan_data = PermohonanLowongan::where('id_kandidat',$kandidat->id_kandidat)->where('id_perusahaan',$perusahaan->id_perusahaan)->first();
            $interview = Interview::where('id_kandidat',$id_kandidat[$a])->where('id_perusahaan',$perusahaan->id_perusahaan)->first();
                if($permohonan_data){
                    PermohonanLowongan::where('id_kandidat',$kandidat->id_kandidat)->where('id_perusahaan',$perusahaan->id_perusahaan)->update([
                        'confirm'=>$kandidat->id_kandidat,
                    ]);
                    notifyKandidat::create([
                        'id_kandidat' => $kandidat->id_kandidat,
                        'isi' => "Anda mendapat pesan masuk",
                        'pengirim' => "Sistem",
                        'url' => '/semua_pesan',
                    ]);
        
                    messageKandidat::create([
                        'id_kandidat' => $kandidat->id_kandidat, 
                        'pesan' => "Halo, Anda mendapat undangan interview dari ".$perusahaan->nama_perusahaan.". Apakah anda menyetujuinya?",
                        'pengirim' => "Sistem",
                        'kepada' => $kandidat->nama,
                        'id_interview' => $interview->id_interview,
                    ]);
                    $kandidat_akademi = Kandidat::where('id_kandidat',$id_kandidat[$a])->whereNotNull('id_akademi')->first();
                    if($kandidat_akademi !== null){
                        notifyAkademi::create([
                            'id_akademi' => $kandidat_akademi->id_akademi,
                            'id_kandidat' => $kandidat_akademi->id_kandidat,
                            'isi' => "Anda mendapat pesan masuk",
                            'pengirim' => "Sistem",
                            'url' => '/akademi/semua_notif',
                        ]);

                        messageAkademi::create([
                            'id_akademi' => $kandidat_akademi->id_akademi,
                            'id_kandidat' => $kandidat_akademi->id_kandidat,
                            'pesan' => "Selamat kandidat atas nama ".$kandidat_akademi->nama." telah diterima di ".$perusahaan->nama_perusahaan,
                            'pengirim' => "Sistem",
                            'kepada' => $kandidat_akademi->id_akademi,
                        ]);
                    }
                } 

                    
        }
        foreach($permohonan as $key){
            if($key->confirm == null){
                notifyKandidat::create([
                    'id_kandidat' => $key->id_kandidat,
                    'isi' => "Anda mendapat pesan masuk",
                    'pengirim' => "Sistem",
                    'url' => '/semua_pesan',
                ]);
            
                messageKandidat::create([
                    'id_kandidat' => $key->id_kandidat, 
                    'pesan' => "Maaf anda masih belum diterima di ".$perusahaan->nama_perusahaan.". Jangan menyerah, masih ada perusahaan lain yang bisa anda coba masuki.",
                    'pengirim' => "Sistem",
                    'kepada' => $key->nama_kandidat,
                ]);
                PermohonanLowongan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('jabatan',$key->jabatan)->delete();
            }
        }                  
        return redirect('/perusahaan/persetujuan_kandidat');
    }

    public function persetujuanKandidat()
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $kandidat = Kandidat::join(
            'perusahaan', 'kandidat.id_perusahaan','=','perusahaan.id_perusahaan'
        )
        ->join(
            'persetujuan_kandidat','kandidat.id_kandidat','=','persetujuan_kandidat.id_kandidat'
        )
        ->where('kandidat.id_perusahaan',$perusahaan->id_perusahaan)->where('kandidat.stat_pemilik','not like',"diambil")
        ->get();
        $isi = $kandidat->count();
        return view('perusahaan/recruitment/persetujuan_kandidat',compact('perusahaan','notif','pesan','cabang','kandidat','isi','credit'));
    }

    public function confirmPersetujuanKandidat(Request $request)
    {        
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $id_kandidat = $request->menerima;
        $kandidat_menolak = $request->menolak;
        $persetujuan = PersetujuanKandidat::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        if($id_kandidat == null){
            return redirect('/perusahaan/persetujuan_kandidat')->with('error',"Maaf belum ada kandidat yang menyetujui");
        }
        foreach($persetujuan as $key){
            if($key->persetujuan == "ya"){
                Kandidat::where('id_kandidat',$key->id_kandidat)->update([
                    'stat_pemilik' => "diambil"
                ]);
                PersetujuanKandidat::where('id_kandidat',$key->id_kandidat)->delete();
            } elseif($key->persetujuan == "tidak") {
                Kandidat::where('id_kandidat',$key->id_kandidat)->update([
                    'stat_pemilik' => null,
                    'id_perusahaan' => null,
                ]);
                Interview::where('id_kandidat',$key->id_kandidat)->delete();
            } else {
                Kandidat::where('id_kandidat',$key->id_kandidat)->update([
                    'stat_pemilik' => null,
                    'id_perusahaan' => null,
                ]);
                Interview::where('id_kandidat',$key->id_kandidat)->delete();
                notifyKandidat::create([
                    'id_kandidat'=>$key->id_kandidat,
                    'id_perusahaan'=>$key->id_perusahaan,
                    'isi'=>"",
                    'pengirim'=>"Admin",
                    'url'=>'/semua_pesan',
                ]);
                messageKandidat::create([
                    'id_kandidat'=>$key->id_kandidat,
                    'id_perusahaan'=>$key->id_perusahaan,
                    'pesan'=>"",
                    'pengirim'=>"Admin",
                    'kepada'=>$key->nama_kandidat,
                ]);
            }
        }
        for($k = 0; $k < count($persetujuan); $k++){
            if($id_kandidat !== null){
                
            } elseif($kandidat_menolak) {

            }
        }
        for($t = 0; $t < count($kandidat_menolak); $t++){
            $tolak['id_kandidat'] = $id_kandidat[$t];
            Kandidat::where('id_kandidat',$id_kandidat[$t])->update([
                'stat_pemilik' => null,
                'id_perusahaan' => null,
            ]);
            $kandidat = Kandidat::where('id_kandidat',$id_kandidat[$t])->first();
            Interview::where('id_kandidat',$kandidat->id_kandidat)->delete();
            PersetujuanKandidat::where('id_kandidat',$kandidat->id_kandidat)->delete();

        }
        return redirect('/perusahaan/interview')->with('success',"kandidat telah ditentukan");
    }
}