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

class PerusahaanRecruitmentController extends Controller
{
    public function negaraTujuan()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        $negara_perusahaan = PerusahaanNegara::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $negara = Negara::where('negara_id','not like',2)->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_perusahaan','not like',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        return view('perusahaan/recruitment/negara_tujuan',compact('perusahaan','negara_perusahaan','notif','pesan','negara','cabang'));
    }

    public function tambahNegaraTujuan()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_perusahaan','not like',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        return view('perusahaan/recruitment/tambah_negara_tujuan',compact('perusahaan','notif','pesan','cabang'));
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
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_perusahaan','not like',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $pekerjaan = Pekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('negara_id',$id)->get();
        return view('perusahaan/recruitment/lihat_job',compact('id','nama','perusahaan','notif','pesan','pekerjaan','cabang'));
    }

    public function tambahPerusahaanJob($id, $nama)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_perusahaan','not like',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        return view('perusahaan/recruitment/tambah_job',compact('perusahaan','notif','pesan','id','nama','cabang'));
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
        return redirect('/perusahaan/pekerjaan/'.$id.'/'.$nama)->with('toast_success',"Data Ditambahkan");
    }

    public function editPerusahaanJob($kerjaid,$id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_perusahaan','not like',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pekerjaan = Pekerjaan::where('id_pekerjaan',$kerjaid)->first();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        return view('perusahaan/recruitment/edit_job',compact('perusahaan','notif','pesan','pekerjaan','id','kerjaid','cabang'));
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
        return redirect('/perusahaan/pekerjaan/'.$negara->negara_id.'/'.$negara->negara)->with('toast_success',"Data diubah");
    }

    public function hapusPerusahaanJob($kerjaid)
    {
        Pekerjaan::where('id_pekerjaan',$kerjaid)->delete();
        return back()->with('toast_success','Pekerjaan Berhasil Dihapus');
    }

    public function cariKandidatStaff()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_perusahaan','not like',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $isi = "";
        return view('perusahaan/kandidat/cari_staff',compact('perusahaan','notif','pesan','cabang','isi'));
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
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_perusahaan','not like',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
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
        return view('perusahaan/kandidat/cari_staff',compact('perusahaan','notif','pesan','cabang','isi'));
    }

    public function lowonganPekerjaan()
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $lowongan = LowonganPekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_perusahaan','not like',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        return view('perusahaan/lowongan_pekerjaan',compact('perusahaan','notif','pesan','lowongan','cabang'));
    }

    public function tambahLowongan()
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_perusahaan','not like',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $negara = Negara::where('negara_id','not like',2)->get();
        return view('perusahaan/tambah_lowongan',compact('perusahaan','notif','pesan','cabang','negara'));
    }

    public function simpanLowongan(Request $request)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $negara = Negara::where('negara_id',$request->negara_id)->first();
        
        if($request->file('gambar') !== null) {
            $gambar = $perusahaan->nama_perusahaan.$request->jabatan.time().'.'.$request->gambar->extension();  
            $gambar_lowongan = $request->file('gambar');
            $gambar_lowongan->move('gambar/Perusahaan/'.$perusahaan->nama_perusahaan.'/Lowongan Pekerjaan/',$perusahaan->nama_perusahaan.$request->jabatan.time().'.'.$gambar_lowongan->extension());
        } else {
            $gambar = null;
        }

        if($gambar !== null) {
            $gambar = $gambar;
        } else {
            $gambar = null;
        }
        LowonganPekerjaan::create([
            'usia' => $request->usia,
            'jabatan' => $request->jabatan,
            'pendidikan' => $request->pendidikan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pengalaman_kerja' => $request->pengalaman_kerja,
            'berat' => $request->berat,
            'tinggi' => $request->tinggi,
            'pencarian_tmp' => $request->pencarian_tmp,
            'id_perusahaan' => $perusahaan->id_perusahaan,
            'isi' => $request->isi,
            'negara' => $negara->negara,
            'ttp_lowongan' => $request->ttp_lowongan,
            'gambar_lowongan' => $gambar,
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
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_perusahaan','not like',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        return view('perusahaan/lihat_lowongan',compact('perusahaan','lowongan','pesan','notif','cabang'));
    }

    public function editLowongan($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_perusahaan','not like',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->first();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $negara = Negara::where('negara_id','not like',2)->get();
        return view('perusahaan/edit_lowongan',compact('perusahaan','pesan','notif','lowongan','cabang','negara'));
    }

    public function updateLowongan(Request $request, $id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->first();
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
            $gambar = $gambar;
        } else {
            $gambar = null;
        }
        
        LowonganPekerjaan::where('id_lowongan',$id)->update([
            'usia' => $request->usia,
            'jabatan' => $request->jabatan,
            'pendidikan' => $request->pendidikan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pengalaman_kerja' => $request->pengalaman_kerja,
            'berat' => $request->berat,
            'tinggi' => $request->tinggi,
            'pencarian_tmp' => $request->pencarian_tmp,
            'id_perusahaan' => $perusahaan->id_perusahaan,
            'isi' => $request->isi,
            'ttp_lowongan' => $request->ttp_lowongan,
            'gambar_lowongan' => $gambar,
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
}