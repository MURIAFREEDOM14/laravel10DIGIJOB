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
        $isi = 0;
        return view('perusahaan/kandidat/cari_staff',compact('perusahaan','notif','pesan','cabang','isi'));
    }

    public function pencarianKandidatStaff(Request $request)
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        $provinsi = Provinsi::where('id',$request->provinsi_id)->first();
        $kota = Kota::where('id',$request->kota_id)->first();
        $prov = $provinsi->provinsi;
        $kab = $kota->kota;
        dd($request);
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_perusahaan','not like',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $kandidat = Kandidat::
        where('usia','>=',$request->usia)
        ->where('jenis_kelamin','like','%'.$request->jenis_kelamin.'%')
        ->where('pendidikan','like','%'.$request->pendidikan.'%')
        ->where('tinggi','like','%'.$request->tinggi.'%')
        ->where('berat','like','%'.$request->berat.'%')
        ->where('provinsi','like','%'.$prov.'%')
        ->where('kabupaten','like','%'.$kab.'%')
        ->where('lama_kerja','like','%'.$request->pengalaman.'%')
        ->get();
        $isi = $kandidat->count();
        return view('perusahaan/kandidat/cari_staff',compact('perusahaan','notif','pesan','cabang','isi'));
    }
}