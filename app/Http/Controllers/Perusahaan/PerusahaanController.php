<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Models\Kandidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Perusahaan;
use App\Models\PerusahaanCabang;
use App\Models\Negara;
use App\Models\Akademi;
use Carbon\Carbon;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Interview;
use App\Models\PengalamanKerja;
use App\Models\Pembayaran;
use App\Models\notifyPerusahaan;
use App\Models\messagePerusahaan;
use App\Models\LowonganPekerjaan;
use App\Models\PMIID;
use App\Models\PermohonanLowongan;
use App\Models\PerusahaanNegara;
use App\Models\Pekerjaan;

class PerusahaanController extends Controller
{
    // DATA PERUSAHAAN //
    public function index()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_perusahaan','not like',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $interview = Interview::where('status',"terjadwal")->where('id_perusahaan',$perusahaan->id_perusahaan)->get();        
        return view('perusahaan/index',compact('perusahaan','cabang','notif','interview','pesan'));
    }

    public function gantiPerusahaan($id)
    {
        $user = Auth::user();
        $perusahaanData = PerusahaanCabang::where('no_nib',$user->no_nib)->where('id_perusahaan_cabang',$id)->first();
        Perusahaan::where('no_nib',$perusahaanData->no_nib)->update([
            'penempatan_kerja' => $perusahaanData->penempatan_kerja,
            'nama_pemimpin' => $perusahaanData->nama_pemimpin,
            'tmp_perusahaan' => $perusahaanData->tmp_perusahaan,
            'foto_perusahaan' => $perusahaanData->foto_perusahaan,
            'logo_perusahaan' => $perusahaanData->logo_perusahaan,
            'alamat' => $perusahaanData->alamat,
            'provinsi' => $perusahaanData->provinsi,
            'kota' => $perusahaanData->kota,
            'no_telp_perusahaan' => $perusahaanData->no_telp_perusahaan,
        ]);
        return redirect()->route('perusahaan')->with('success',"Beralih Perusahaan");
    }

    public function profil()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_perusahaan','not like',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $lowongan = LowonganPekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        if($perusahaan->nama_pemimpin == null)
        {
            return redirect()->route('perusahaan')->with('warning',"Harap lengkapi profil perusahaan terlebih dahulu");
        } else {
            return view('perusahaan/profil_perusahaan',compact('cabang','perusahaan','notif','pesan','lowongan'));
        }
    }

    public function isi_perusahaan_data()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->first();
        // if ($cabang->penempatan_kerja !== $perusahaan->penempatan_kerja) {
        //     if($cabang->penempatan_kerja == $perusahaan->penempatan_kerja){
        //         PerusahaanCabang::create([
        //             'id_perusahaan' => $perusahaan->id_perusahaan,
        //             'nama_perusahaan' => $perusahaan->nama_perusahaan,
        //             'no_nib' => $perusahaan->no_nib,
        //             'referral_code' => $perusahaan->referral_code,
        //             'email_perusahaan' => $perusahaan->email_perusahaan,
        //             'penempatan_kerja' => $perusahaan->penempatan_kerja,
        //         ]);
        //     }
        // }
        return view('perusahaan/isi_perusahaan_data',compact('perusahaan'));
    }

    public function simpan_perusahaan_data(Request $request)
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        if($request->file('foto_perusahaan') !== null){
            // $this->validate($request, [
            //     'foto_perusahaan' => 'required|file|image|mimes:jpeg,png,jpg|max:1024',
            // ]);
            $hapus_foto_perusahaan = public_path('gambar/Perusahaan/'.$perusahaan->nama_perusahaan.'/Foto Perusahaan/').$perusahaan->foto_perusahaan;
            if(file_exists($hapus_foto_perusahaan)){
                @unlink($hapus_foto_perusahaan);
            }
            $photo_perusahaan = $perusahaan->nama_perusahaan.time().'.'.$request->foto_perusahaan->extension();  
            $simpan_photo_perusahaan = $request->file('foto_perusahaan');
            $simpan_photo_perusahaan->move('gambar/Perusahaan/'.$perusahaan->nama_perusahaan.'/Foto Perusahaan/',$perusahaan->nama_perusahaan.time().'.'.$simpan_photo_perusahaan->extension());
        } else {
            if($perusahaan->foto_perusahaan !== null){
                $photo_perusahaan = $perusahaan->foto_perusahaan;                
            } else {
                $photo_perusahaan = null;    
            }
        }

        if($request->file('logo_perusahaan') !== null){
            // $this->validate($request, [
            //     'foto_ktp_izin' => 'required|file|image|mimes:jpeg,png,jpg|max:1024',
            // ]);
            $hapus_logo_perusahaan = public_path('gambar/Perusahaan/'.$perusahaan->nama_perusahaan.'/Logo Perusahaan/').$perusahaan->logo_perusahaan;
            if(file_exists($hapus_logo_perusahaan)){
                @unlink($hapus_logo_perusahaan);
            }
            $logo = $perusahaan->nama_perusahaan.time().'.'.$request->logo_perusahaan->extension();  
            $simpan_logo = $request->file('logo_perusahaan');
            $simpan_logo->move('gambar/Perusahaan/'.$perusahaan->nama_perusahaan.'/Logo Perusahaan/',$perusahaan->nama_perusahaan.time().'.'.$simpan_logo->extension());
        } else {
            if($perusahaan->logo_perusahaan !== null){
                $logo = $perusahaan->logo_perusahaan;                
            } else {
                $logo = null;    
            }
        }

        if ($photo_perusahaan !== null) {
            $foto_perusahaan = $photo_perusahaan;
        } else {
            $foto_perusahaan = null;
        }

        if ($logo !== null) {
            $logo_perusahaan = $logo;
        } else {
            $logo_perusahaan = null;
        }

        if($request->tmp_perusahaan == "Dalam negeri"){
            $negara_id = 2;
        } else {
            $negara_id = null;
        }

        Perusahaan::where('no_nib',$id->no_nib)->update([
            'nama_perusahaan' => $perusahaan->nama_perusahaan,
            'no_nib' => $perusahaan->no_nib,
            'nama_pemimpin' => $request->nama_pemimpin,
            'foto_perusahaan' => $foto_perusahaan,
            'logo_perusahaan' => $logo_perusahaan,
            'tmp_perusahaan' => $request->tmp_perusahaan,
            'negara_id' => $negara_id,
        ]);

        PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->update([
            'id_perusahaan' => $perusahaan->id_perusahaan,
            'nama_perusahaan' => $perusahaan->nama_perusahaan,
            'no_nib' => $perusahaan->no_nib,
            'nama_pemimpin' => $request->nama_pemimpin,
            'foto_perusahaan' => $foto_perusahaan,
            'logo_perusahaan' => $logo_perusahaan,
            'tmp_perusahaan' => $request->tmp_perusahaan,
            'negara_id' => $negara_id,
        ]);
        return redirect()->route('perusahaan.alamat')->with('success',"Data anda tersimpan");
    }

    public function isi_perusahaan_alamat()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        $negara = Negara::where('negara_id','not like',2)->get();
        return view('perusahaan/isi_perusahaan_alamat',compact('perusahaan','negara'));
    }

    public function simpan_perusahaan_alamat(Request $request)
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        
        if($perusahaan->tmp_perusahaan == "Dalam negeri"){
            $cari_provinsi = Provinsi::where('id',$request->provinsi_id)->first();
            $cari_kota = Kota::where('id',$request->kota_id)->first();
            $cari_kecamatan = Kecamatan::where('id',$request->kecamatan_id)->first();
            $cari_kelurahan = kelurahan::where('id',$request->kelurahan_id)->first();    

            $provinsi = $cari_provinsi->provinsi;
            $kota = $cari_kota->kota;
            $kecamatan = $cari_kecamatan->kecamatan;
            $kelurahan = $cari_kelurahan->kelurahan;
            $negara_id = 2;
        } else {
            $provinsi = null;
            $kota = null;
            $kecamatan = null;
            $kelurahan = null;
            $negara_id = $request->negara_id;
        }

        Perusahaan::where('no_nib',$id->no_nib)->update([
            'provinsi'=>$provinsi,
            'kota'=>$kota,
            'kecamatan'=>$kecamatan,
            'kelurahan'=>$kelurahan,
            'no_telp_perusahaan'=>$request->no_telp_perusahaan,
            'negara_id' => $negara_id,
            'alamat' => $request->alamat,
        ]);

        PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->update([
            'provinsi'=>$provinsi,
            'kota'=>$kota,
            'kecamatan'=>$kecamatan,
            'kelurahan'=>$kelurahan,
            'no_telp_perusahaan'=>$request->no_telp_perusahaan,
            'negara_id' => $negara_id,
            'alamat' => $request->alamat,
        ]);
        return redirect()->route('perusahaan.operator');
    }

    public function isi_perusahaan_operator()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        return view('perusahaan/isi_perusahaan_operator',compact('perusahaan'));
    }

    public function simpan_perusahaan_operator(Request $request)
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        // if($request->file('foto_operator') !== null){
        //     // $this->validate($request, [
        //     //     'foto_ktp_izin' => 'required|file|image|mimes:jpeg,png,jpg|max:1024',
        //     // ]);
        //     $operator = time().'.'.$request->foto_operator->extension();  
        //     $request->foto_operator->move(public_path('/gambar/Perusahaan/Operator'), $operator);
        // } else {
        //     if($perusahaan->foto_operator !== null){
        //         $operator = $perusahaan->foto_operator;                
        //     } else {
        //         $operator = null;    
        //     }
        // }

        // if ($operator !== null) {
        //     $foto_operetor = $operator;
        // } else {
        //     $foto_operetor = null;
        // }

        Perusahaan::where('no_nib',$id->no_nib)->update([
            'nama_operator'=>$request->nama_operator,
            'no_telp_operator'=>$request->no_telp_operator,
            'email_operator'=>$request->email_operator,
            // 'foto_operator'=>$foto_operetor,
            'company_profile'=>$request->company_profile
        ]);

        PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->update([
            'nama_operator'=>$request->nama_operator,
            'no_telp_operator'=>$request->no_telp_operator,
            'email_operator'=>$request->email_operator,
            // 'foto_operator'=>$foto_operetor,
            'company_profile'=>$request->company_profile
        ]);
        return redirect()->route('perusahaan');
    }

    public function tambahCabangData()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_perusahaan','not like',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        return view('perusahaan/cabang/tambah_perusahaan_data',compact('perusahaan','notif','pesan'));
    }

    public function simpanCabangData(Request $request)
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();        
        $cabang = PerusahaanCabang::where('penempatan_kerja',$id->penempatan_kerja)->where('no_nib',$id->no_nib)->first();

        if($request->file('foto_perusahaan') !== null){
            // $this->validate($request, [
            //     'foto_perusahaan' => 'required|file|image|mimes:jpeg,png,jpg|max:1024',
            // ]);
            $hapus_foto_perusahaan = public_path('gambar/Perusahaan/'.$perusahaan->nama_perusahaan.'/Foto Perusahaan/').$perusahaan->foto_perusahaan;
            if(file_exists($hapus_foto_perusahaan)){
                @unlink($hapus_foto_perusahaan);
            }
            $photo_perusahaan = $perusahaan->nama_perusahaan.time().'.'.$request->foto_perusahaan->extension();  
            $simpan_photo_perusahaan = $request->file('foto_perusahaan');
            $simpan_photo_perusahaan->move('gambar/Perusahaan/'.$perusahaan->nama_perusahaan.'/Foto Perusahaan/',$perusahaan->nama_perusahaan.time().'.'.$simpan_photo_perusahaan->extension());
        } else {
            if($perusahaan->foto_perusahaan !== null){
                $photo_perusahaan = $perusahaan->foto_perusahaan;                
            } else {
                $photo_perusahaan = null;    
            }
        }

        if($request->file('logo_perusahaan') !== null){
            // $this->validate($request, [
            //     'foto_ktp_izin' => 'required|file|image|mimes:jpeg,png,jpg|max:1024',
            // ]);
            $hapus_logo_perusahaan = public_path('gambar/Perusahaan/'.$perusahaan->nama_perusahaan.'/Logo Perusahaan/').$perusahaan->logo_perusahaan;
            if(file_exists($hapus_logo_perusahaan)){
                @unlink($hapus_logo_perusahaan);
            }
            $logo = $perusahaan->nama_perusahaan.time().'.'.$request->logo_perusahaan->extension();  
            $simpan_logo = $request->file('logo_perusahaan');
            $simpan_logo->move('gambar/Perusahaan/'.$perusahaan->nama_perusahaan.'/Logo Perusahaan/',$perusahaan->nama_perusahaan.time().'.'.$simpan_logo->extension());
        } else {
            if($perusahaan->logo_perusahaan !== null){
                $logo = $perusahaan->logo_perusahaan;                
            } else {
                $logo = null;    
            }
        }

        if ($photo_perusahaan !== null) {
            $foto_perusahaan = $photo_perusahaan;
        } else {
            $foto_perusahaan = null;
        }

        if ($logo !== null) {
            $logo_perusahaan = $logo;
        } else {
            $logo_perusahaan = null;
        }

        if($request->tmp_perusahaan == "Dalam negeri"){
            $negara_id = 2;
        } else {
            $negara_id = null;
        }
        
        PerusahaanCabang::create([
            'id_perusahaan' => $perusahaan->id_perusahaan,
            'nama_perusahaan' => $request->nama_perusahaan,
            'no_nib' => $perusahaan->no_nib,
            'referral_code' => $perusahaan->referral_code,
            'email_perusahaan' => $perusahaan->email_perusahaan,
            'penempatan_kerja' => $request->penempatan_kerja,
            'nama_pemimpin' => $request->nama_pemimpin,
            'foto_perusahaan' => $foto_perusahaan,
            'logo_perusahaan' => $logo_perusahaan,
            'tmp_perusahaan' => $request->tmp_perusahaan,
            'negara_id' => $negara_id,        
        ]);
        return redirect()->route('cabang.alamat')->with('success',"Data anda tersimpan");
    }

    public function tambahCabangAlamat()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        $negara = Negara::where('negara_id','not like',2)->get();
        return view('perusahaan/isi_perusahaan_alamat',compact('perusahaan','negara'));
    }

    public function simpanCabangAlamat(Request $request)
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        
        if($perusahaan->tmp_perusahaan == "Dalam negeri"){
            $cari_provinsi = Provinsi::where('id',$request->provinsi_id)->first();
            $cari_kota = Kota::where('id',$request->kota_id)->first();
            $cari_kecamatan = Kecamatan::where('id',$request->kecamatan_id)->first();
            $cari_kelurahan = kelurahan::where('id',$request->kelurahan_id)->first();    

            $provinsi = $cari_provinsi->provinsi;
            $kota = $cari_kota->kota;
            $kecamatan = $cari_kecamatan->kecamatan;
            $kelurahan = $cari_kelurahan->kelurahan;
            $negara_id = 2;
        } else {
            $provinsi = null;
            $kota = null;
            $kecamatan = null;
            $kelurahan = null;
            $negara_id = $request->negara_id;
        }

        Perusahaan::where('no_nib',$id->no_nib)->update([
            'provinsi'=>$provinsi,
            'kota'=>$kota,
            'kecamatan'=>$kecamatan,
            'kelurahan'=>$kelurahan,
            'no_telp_perusahaan'=>$request->no_telp_perusahaan,
            'negara_id' => $negara_id,
            'alamat' => $request->alamat,
        ]);
        return redirect()->route('cabang.operator')->with('success',"Data anda tersimpan");
    }

    public function tambahCabangOperator()
    {

    }

    public function simpanCabangOperator()
    {

    }

    public function contactUsPerusahaan()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_perusahaan','not like',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        return view('perusahaan/contact_us',compact('perusahaan','notif','pesan','cabang'));
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
        ]);
        return redirect('/perusahaan/list/lowongan')->with('success');
    }

    public function hapusLowongan($id)
    {
        LowonganPekerjaan::where('id_lowongan',$id)->delete();
        return redirect('/perusahaan/list/lowongan')->with('success');
    }

    public function listPermohonanLowongan()
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_perusahaan','not like',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $permohonan = PermohonanLowongan::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        return view('perusahaan/list_permohonan_lowongan',compact('perusahaan','permohonan','pesan','notif','cabang'));
    }

    public function permohonanLowonganPekerjaan()
    {

    }

    public function confirmLowonganPekerjaan()
    {

    }

    public function listPmiID()
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_perusahaan','not like',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $pmi_id = PMIID::join(
            'kandidat', 'perusahaan_kebutuhan.id_kandidat','=','kandidat.id_kandidat'
        )->where('perusahaan_kebutuhan.id_perusahaan',$perusahaan->id_perusahaan)->get();
        return view('perusahaan/list_pmi_id',compact('perusahaan','pmi_id','pesan','notif','cabang'));
    }

    public function pembuatanPmiID(Request $request)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $kandidat = Kandidat::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_perusahaan','not like',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $id_kandidat = null;
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        return view('perusahaan/pembuatan_pmi_id',compact('perusahaan','kandidat','pesan','notif','id_kandidat','cabang'));
    }

    public function selectKandidatID(Request $request)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $id_kandidat = Kandidat::where('id_kandidat',$request->id_kandidat)->first();
        $kandidat = Kandidat::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_perusahaan','not like',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $tgl = Carbon::create($id_kandidat->tgl_lahir)->isoformat('d MMM Y');
        $negara = Negara::all();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        return view('perusahaan/pembuatan_pmi_id',compact('perusahaan','kandidat','pesan','notif','id_kandidat','tgl','negara','cabang'));
    }

    public function simpanPembuatanPmiID(Request $request)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        PMIID::create([
            'isi' => $request->isi,
            'agency' => $request->agency,
            'jabatan' => $request->jabatan,
            'sektor_usaha' => $request->sektor_usaha,
            'nominal' => $request->nominal,
            'berlaku' => $request->berlaku,
            'habis_berlaku' => $request->habis_berlaku,
            'id_perusahaan' => $perusahaan->id_perusahaan,
            'id_kandidat' => $request->id_kandidat,
            'negara_id' => $request->negara_id,
        ]);

        Kandidat::where('id_kandidat',$request->id_kandidat)->update([
            'negara_id' => $request->negara_id,
        ]);
        return redirect('/perusahaan/list/pmi_id')->with('success',"Data anda tersimpan");
    }

    public function lihatPmiID($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $pmi_id = PMIID::join(
            'kandidat', 'perusahaan_kebutuhan.id_kandidat','=','kandidat.id_kandidat'
        )
        ->join(
            'ref_negara', 'perusahaan_kebutuhan.negara_id','=','ref_negara.negara_id'
        )
        ->where('perusahaan_kebutuhan.pmi_id',$id)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_perusahaan','not like',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $berlaku = Carbon::create($pmi_id->berlaku)->isoformat('d MMM Y');
        $habis_berlaku = Carbon::create($pmi_id->habis_berlaku)->isoformat('d MMM Y');
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        return view('perusahaan/lihat_pmi_id',compact('perusahaan','pmi_id','notif','pesan','berlaku','habis_berlaku','cabang'));
    }

    public function cetakPmiID($id)
    {
        $pmi_id = PMIID::join(
            'kandidat', 'perusahaan_kebutuhan.id_kandidat','kandidat.id_kandidat'
        )
        ->join(
            'ref_negara', 'perusahaan_kebutuhan.negara_id','ref_negara.negara_id'
        )
        ->where('perusahaan_kebutuhan.pmi_id',$id)->first();
        $berlaku = Carbon::create($pmi_id->berlaku)->isoformat('d MMM Y');
        $habis_berlaku = Carbon::create($pmi_id->habis_berlaku)->isoformat('d MMM Y');
        return view('Output/cetak_pmi_id',compact('pmi_id','berlaku','habis_berlaku'));
    }

    public function editPmiID($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $pmi_id = PMIID::join(
            'kandidat', 'perusahaan_kebutuhan.id_kandidat','=','kandidat.id_kandidat'
        )
        ->where('pmi_id',$id)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_perusahaan','not like',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $tgl = Carbon::create($pmi_id->tgl_lahir)->isoformat('d MMM Y');
        $negara = Negara::all();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        return view('perusahaan/edit_pmi_id',compact('perusahaan','pmi_id','pesan','notif','tgl','negara','cabang'));
    }

    public function updatePmiID(Request $request, $id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $pmi_id = PMIID::where('pmi_id',$id)->update([
            'isi' => $request->isi,
            'agency' => $request->agency,
            'jabatan' => $request->jabatan,
            'sektor_usaha' => $request->sektor_usaha,
            'nominal' => $request->nominal,
            'berlaku' => $request->berlaku,
            'habis_berlaku' => $request->habis_berlaku,
            'negara_id' => $request->negara_id,
        ]);
        Kandidat::where('id_kandidat',$request->id_kandidat)->update([
            'negara_id' => $request->negara_id,
        ]);
        return redirect('/perusahaan/list/pmi_id')->with('success',"Data anda tersimpan");
    }

    public function hapusPmiID($id)
    {
        PMIID::where('pmi_id',$id)->delete();
        return redirect('/perusahaan/list/pmi_id')->with('success',"Data telah dihapus");
    }

    public function akademi()
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $akademi = Akademi::all();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_perusahaan','not like',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        return view('perusahaan/akademi/list_akademi', compact('perusahaan','akademi','notif','pesan','cabang'));
    }

    public function lihatProfilAkademi($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_perusahaan','not like',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $akademi = Akademi::where('id_akademi',$id)->first();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        return view('perusahaan/akademi/profil_akademi',compact('perusahaan','akademi','notif','pesan','cabang'));
    }

    // DATA KANDIDAT //
    public function kandidat()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        $kandidat = Kandidat::where('id_perusahaan',$perusahaan->id_perusahaan)->get();        
        $isi = $kandidat->count();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_perusahaan','not like',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        return view('perusahaan/kandidat/kandidat',compact('kandidat','perusahaan','isi','notif','pesan','cabang'));
    }

    public function pencarianKandidat()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        $kandidat = Kandidat::where('penempatan','like','%'.$perusahaan->penempatan_kerja.'%')->whereNull('id_perusahaan')->get();        
        $isi = $kandidat->count();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_perusahaan','not like',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        return view('perusahaan/kandidat/pencarian_kandidat',compact('kandidat','perusahaan','isi','notif','pesan','cabang'));
    }

    public function cariKandidat(Request $request)
    {
        $usia = $request->usia;
        $jk = $request->jenis_kelamin;
        $pendidikan = $request->pendidikan;
        $tinggi = $request->tinggi;
        $berat = $request->berat;
        $usia = $request->usia;
        $lama_kerja = $request->lama_kerja;
        $kabupaten = Kota::where('id',$request->kota_id)->first();
        $provinsi = Provinsi::where('id',$request->provinsi_id)->first();
        if($provinsi !== null){
            $prov = $provinsi->provinsi;
            $kab = $kabupaten->kota;
        } else {
            $prov = "";
            $kab = "";
        }
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$auth->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_perusahaan','not like',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $kandidat = Kandidat::
        where('penempatan','like','%Luar negeri%')
        ->where('kandidat.jenis_kelamin','like',"%".$jk."%")
        ->where('kandidat.usia','>=',"%".$usia."%")
        ->where('kandidat.pendidikan','like',"%".$pendidikan."%")
        ->where('kandidat.tinggi','>=',"%".$tinggi."%")
        ->where('kandidat.berat','>=',"%".$berat."%")
        ->where('kandidat.kabupaten','like',"%".$kab."%")
        ->where('kandidat.provinsi','like',"%".$prov."%")
        ->where('kandidat.lama_kerja','like',"%".$lama_kerja."%")
        ->limit(15)->get();
        $isi = $kandidat->count();
        return view('perusahaan/kandidat/pilih_kandidat',compact('jk','perusahaan','kandidat','isi','notif','pesan','cabang'));
    }

    public function pilihKandidat(Request $request)
    {
        $auth = Auth::user();
        $id_kandidat = $request->id_kandidat;
        $usia = $request->usia;
        $jk = $request->jk;
        $nama = $request->nama;
        $pengalaman_kerja = $request->pengalaman_kerja;
        $perusahaan = Perusahaan::where('no_nib',$auth->no_nib)->first();
        
        if($id_kandidat == null){
            return redirect('/perusahaan/list/kandidat')->with('error','anda harus memilih minimal 1 kandidat');
        } else {
            for($a = 0; $a < count($id_kandidat); $a++){                
                $input['id_kandidat'] = $id_kandidat[$a];
                $input['nama_kandidat'] = $nama[$a];
                $input['status'] = "pilih";
                $input['usia'] = $usia[$a];
                $input['jenis_kelamin'] = $jk[$a];
                $input['pengalaman_kerja'] = $pengalaman_kerja[$a];
                $input['id_perusahaan'] = $perusahaan->id_perusahaan;
            Interview::create($input);
            }
            
            // $interview = Interview::create([
            //     'id_kandidat'=>$kandidat->id_kandidat,
            //     'nama_kandidat'=>$kandidat->nama,
            //     'status'=>"pilih",
            //     'usia'=>$kandidat->usia,
            //     'jenis_kelamin'=>$kandidat->jenis_kelamin,
            //     'pengalaman_kerja'=>$kandidat->pengalaman_kerja,
            //     'id_perusahaan'=>$perusahaan->id_perusahaan,
            // ]);
        }
        
        return redirect('/perusahaan/interview');
    }

    public function lihatProfilKandidat($id)
    {
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$auth->no_nib)->first();
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        $info_kandidat = PengalamanKerja::where('id_kandidat',$id)->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $semua_kandidat = Kandidat::where('kandidat.penempatan','like','%'.$perusahaan->penempatan_kerja.'%')
        ->where('kandidat.id_kandidat','not like',$id)->limit(12)->get();
        $usia = Carbon::parse($kandidat->tgl_lahir)->age;
        $tgl_user = Carbon::create($kandidat->tgl_lahir)->isoFormat('D MMM Y');
        $interview = Interview::where('id_kandidat',$kandidat->id_kandidat)->first();
        return view('perusahaan/kandidat/profil_kandidat',compact(
            'kandidat',
            'info_kandidat',
            'perusahaan',
            'usia',
            'tgl_user',
            'semua_kandidat',
            'interview',
            'notif',
            'pesan',
            'cabang',
        ));
    }

    public function lihatVideoKandidat($id)
    {
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$auth->no_nib)->first();
        $kandidat = PengalamanKerja::where('pengalaman_kerja_id',$id)->first();
        $pengalaman_kerja = PengalamanKerja::where('id_kandidat',$kandidat->id_kandidat)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        return view('perusahaan/kandidat/video_kandidat',compact('perusahaan','kandidat','pengalaman_kerja','cabang'));
    }

    // DATA INTERVIEW //
    public function JadwalInterview()
    {
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$auth->no_nib)->first();
        $interview = Interview::where('id_perusahaan',$perusahaan->id_perusahaan)->where('status',"pilih")->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $pilih = null;
        foreach($interview as $item){
            if($item->status == "pilih"){
                $pilih = 1;
            } 
        }
        if($pilih !== null){
            $pilih;
        } else {
            $pilih = null;
        }
        $terjadwal = Interview::where('id_perusahaan',$perusahaan->id_perusahaan)->where('status',"terjadwal")->get();
        $jml_kandidat = $interview->count();
        $biaya = 15000;
        $total = $jml_kandidat * $biaya;
        return view('perusahaan/interview',compact(
            'perusahaan',
            'interview',
            'terjadwal',
            'jml_kandidat',
            'biaya','total',
            'pilih','notif',
            'pesan','cabang',
        ));
    }

    public function tentukanJadwal()
    {
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$auth->no_nib)->first();
        $interview = Interview::where('id_perusahaan',$perusahaan->id_perusahaan)->where('status',"pilih")->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();       
        return view('perusahaan/jadwal_interview',compact('perusahaan','interview','notif','pesan','cabang'));
    }

    public function simpanJadwal(Request $request)
    {
        $jadwal = $request->jadwal_interview;
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$auth->no_nib)->first();        
        $time = date('Y-m-d h:m:sa');
        $timeBefore = date('Y-m-d', strtotime('-2 days', strtotime($time)));
        for($i = 0; $i < count($jadwal); $i++){
            $data['jadwal_interview'] = $jadwal[$i];
            $data['status'] = "terjadwal";
            Interview::where('id_perusahaan',$perusahaan->id_perusahaan)->update($data);
        }

        
        $interview = Interview::where('id_perusahaan',$perusahaan->id_perusahaan)->count();
        // $interview = Interview::where('id_perusahaan',$perusahaan->id_perusahaan)->update([
        //     'jadwal_interview'=>$request->jadwal_interview,
        //     'status'=>"terjadwal"
        // ]);
        Pembayaran::create([
            'id_perusahaan'=>$perusahaan->id_perusahaan,
            'nama_perusahaan'=>$perusahaan->nama_perusahaan,
            'nib'=>$perusahaan->no_nib,
            'nominal_pembayaran'=>15000 * $interview,
            'stats_pembayaran'=>"belum dibayar",
        ]);

        // $pembayaran = [
        //     'nama_perusahaan'=>$perusahaan->nama_perusahaan,
        //     'nib'=>$perusahaan->no_nib,
        //     'nominal_pembayaran'=>15000,
        // ];
        // Mail::to($perusahaan->email_perusahaan)->send(new Payment($pembayaran));
        return redirect('/perusahaan/interview')->with('success','Tagihan sudah muncul di email anda, silahkan selesaikan pembayaran untuk melanjutkan');
    }

    public function DeleteKandidatInterview($id)
    {
        Interview::where('id_interview',$id)->delete();
        return redirect('/perusahaan/interview');
    }

    public function pembayaran()
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $pembayaran = Pembayaran::
        where('pembayaran.id_perusahaan',$perusahaan->id_perusahaan)
        ->where('pembayaran.stats_pembayaran',"belum dibayar")->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        return view('perusahaan/pembayaran/list_pembayaran', compact('perusahaan','pembayaran','notif','pesan','cabang'));
    }

    public function Payment($id)
    {
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$auth->no_nib)->first();
        $interview = Interview::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $tglInterview = Interview::where('id_perusahaan',$perusahaan->id_perusahaan)->first();
        $total = $interview->count();
        $ttlBayar = $total * 15000;
        $tgl = Carbon::create($tglInterview->jadwal_interview)->isoformat('D MMM Y');
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $pembayaran = Pembayaran::where('id_pembayaran',$id)->first();
        return view('perusahaan/pembayaran/pembayaran',compact('perusahaan','total','ttlBayar','notif','tgl','pembayaran','pesan','cabang'));
    }

    public function paymentCheck(Request $request)
    {
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$auth->no_nib)->first();
        // $this->validate($request, [
        //     'foto_ktp_izin' => 'required|file|image|mimes:jpeg,png,jpg|max:1024',
        // ]);
        $pembayaran = $perusahaan->nama_perusahaan.time().'.'.$request->foto_pembayaran->extension();  
        $request->foto_pembayaran->move(public_path('/gambar/Perusahaan/Pembayaran/'.$perusahaan->nama_perusahaan), $pembayaran);
        $pembayaran = Pembayaran::where('id_perusahaan',$perusahaan->id_perusahaan)->update([
            'foto_pembayaran'=>$pembayaran
        ]);
        return redirect('/perusahaan')->with('success','Metode pembayaran sedang diproses mohon tunggu');
    }    
}
