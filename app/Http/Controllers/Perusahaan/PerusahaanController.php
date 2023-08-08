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
use App\Mail\transfer;
use Illuminate\Support\Facades\Mail;
use App\Models\notifyKandidat;
use App\Models\messageKandidat;
use App\Models\notifyAkademi;
use App\Models\messageAkademi;
use App\Models\PersetujuanKandidat;
use App\Models\CreditPerusahaan;
use App\Models\User;
use App\Models\FotoKerja;
use App\Models\VideoKerja;

class PerusahaanController extends Controller
{
    // DATA PERUSAHAAN //
    public function index()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like','%'.$perusahaan->penempatan_kerja.'%')->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $interview = Interview::where('status',"terjadwal")->where('id_perusahaan',$perusahaan->id_perusahaan)->get();        
        $notifyP = notifyPerusahaan::where('created_at','<',Carbon::now()->subDays(14))->delete();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $penempatan = Negara::join(
            'pekerjaan', 'ref_negara.negara_id','=','pekerjaan.negara_id'
        )
        ->where('pekerjaan.id_perusahaan',$perusahaan->id_perusahaan)->get();
        $lowongan = LowonganPekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        if(!$credit){
            $credit = CreditPerusahaan::create([
                'id_perusahaan' => $perusahaan->id_perusahaan,
                'nama_perusahaan' => $perusahaan->nama_perusahaan,
                'no_nib' => $perusahaan->no_nib,
            ]);
        } 
        User::where('no_nib',$perusahaan->no_nib)->update([
            'counter' => null,
        ]);
        return view('perusahaan/index',compact('perusahaan','cabang','notif','interview','pesan','credit','penempatan','lowongan'));
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
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like','%'.$perusahaan->penempatan_kerja.'%')->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $lowongan = LowonganPekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        if($perusahaan->nama_pemimpin == null)
        {
            return redirect()->route('perusahaan')->with('warning',"Harap lengkapi profil perusahaan terlebih dahulu");
        } else {
            return view('perusahaan/profil_perusahaan',compact('cabang','perusahaan','notif','pesan','lowongan','credit'));
        }
    }

    public function isi_perusahaan_data()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->first();
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
        return redirect()->route('perusahaan.operator')->with('success',"Data anda tersimpan");
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
        return redirect()->route('perusahaan')->with('success',"Data anda tersimpan");
    }

    public function tambahCabangData()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        return view('perusahaan/cabang/tambah_perusahaan_data',compact('perusahaan'));
    }

    public function simpanCabangData(Request $request)
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
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like','%'.$perusahaan->penempatan_kerja.'%')->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/contact_us',compact('perusahaan','notif','pesan','cabang','credit'));
    }

    public function permohonanLowonganPekerjaan()
    {

    }

    public function listPmiID()
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like','%'.$perusahaan->penempatan_kerja.'%')->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $pmi_id = PMIID::join(
            'kandidat', 'perusahaan_kebutuhan.id_kandidat','=','kandidat.id_kandidat'
        )->where('perusahaan_kebutuhan.id_perusahaan',$perusahaan->id_perusahaan)->get();
        return view('perusahaan/list_pmi_id',compact('perusahaan','pmi_id','pesan','notif','cabang','credit'));
    }

    public function pembuatanPmiID(Request $request)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $kandidat = Kandidat::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $id_kandidat = null;
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like','%'.$perusahaan->penempatan_kerja.'%')->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/pembuatan_pmi_id',compact('perusahaan','kandidat','pesan','notif','id_kandidat','cabang','credit'));
    }

    public function selectKandidatID(Request $request)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $id_kandidat = Kandidat::where('id_kandidat',$request->id_kandidat)->first();
        $kandidat = Kandidat::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $tgl = Carbon::create($id_kandidat->tgl_lahir)->isoformat('d MMM Y');
        $negara = Negara::all();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like','%'.$perusahaan->penempatan_kerja.'%')->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/pembuatan_pmi_id',compact('perusahaan','kandidat','pesan','notif','id_kandidat','tgl','negara','cabang','credit'));
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
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $berlaku = Carbon::create($pmi_id->berlaku)->isoformat('d MMM Y');
        $habis_berlaku = Carbon::create($pmi_id->habis_berlaku)->isoformat('d MMM Y');
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/lihat_pmi_id',compact('perusahaan','pmi_id','notif','pesan','berlaku','habis_berlaku','cabang','credit'));
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
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $tgl = Carbon::create($pmi_id->tgl_lahir)->isoformat('d MMM Y');
        $negara = Negara::all();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/edit_pmi_id',compact('perusahaan','pmi_id','pesan','notif','tgl','negara','cabang','credit'));
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
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/akademi/list_akademi', compact('perusahaan','akademi','notif','pesan','cabang','credit'));
    }

    public function lihatProfilAkademi($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $akademi = Akademi::where('id_akademi',$id)->first();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/akademi/profil_akademi',compact('perusahaan','akademi','notif','pesan','cabang','credit'));
    }

    // DATA KANDIDAT //
    public function kandidat()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        $kandidat = Kandidat::where('id_perusahaan',$perusahaan->id_perusahaan)->where('stat_pemilik','diambil')->get();        
        $isi = $kandidat->count();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/kandidat/kandidat',compact('kandidat','perusahaan','isi','notif','pesan','cabang','credit'));
    }

    public function lihatProfilKandidat($id)
    {
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$auth->no_nib)->first();
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        $pengalaman_kerja_kandidat = PengalamanKerja::where('id_kandidat',$id)->get();
        $video = VideoKerja::first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $usia = Carbon::parse($kandidat->tgl_lahir)->age;
        $tgl_user = Carbon::create($kandidat->tgl_lahir)->isoFormat('D MMM Y');
        $interview = Interview::where('id_kandidat',$kandidat->id_kandidat)->first();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        
        // $semua_kandidat = Kandidat::join(
        //     'permohonan_lowongan', 'kandidat.id_kandidat','=','permohonan_lowongan.id_kandidat'
        // )
        // ->where('kandidat.id_perusahaan','like','%'.$perusahaan->id_perusahaan.'%')
        // ->where('kandidat.id_kandidat','not like',$id)->whereNull('stat_pemilik')->limit(12)->get();
        
        return view('perusahaan/kandidat/profil_kandidat',compact(
            'kandidat','pengalaman_kerja_kandidat','perusahaan',
            'usia','tgl_user','pesan',
            'interview','notif','cabang',
            'credit','video',
        ));
    }

    public function galeriKandidat($id)
    {
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$auth->no_nib)->first();
        $pengalaman_kandidat = PengalamanKerja::where('pengalaman_kerja.pengalaman_kerja_id',$id)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $video = VideoKerja::where('pengalaman_kerja_id',$pengalaman_kandidat->pengalaman_kerja_id)->get();
        $semua_video = VideoKerja::where('pengalaman_kerja_id',$pengalaman_kandidat->pengalaman_kerja_id)->get();
        $foto = FotoKerja::where('pengalaman_kerja_id',$pengalaman_kandidat->pengalaman_kerja_id)->get();
        $pengalaman_kerja = PengalamanKerja::where('id_kandidat',$pengalaman_kandidat->id_kandidat)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        return view('perusahaan/kandidat/galeri_kandidat',compact('perusahaan','pengalaman_kandidat','pengalaman_kerja','cabang','pesan','notif','credit','video','foto','semua_video'));
    }

    public function lihatGaleriKandidat($id,$type)
    {
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$auth->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        if($type == "video") {
            $video = VideoKerja::where('video_kerja_id',$id)->first();
            $pengalaman = PengalamanKerja::where('pengalaman_kerja_id',$video->pengalaman_kerja_id)->first();
            $semua_video = VideoKerja::where('pengalaman_kerja_id',$pengalaman->pengalaman_kerja_id)->get();    
            $semua_foto = FotoKerja::where('pengalaman_kerja_id',$pengalaman->pengalaman_kerja_id)->get();
            return view('perusahaan/kandidat/lihat_galeri_kandidat',compact('perusahaan','pengalaman','cabang','pesan','notif','credit','video','semua_video','semua_foto','type'));
        } else {
            $foto = FotoKerja::where('foto_kerja_id',$id)->first();
            $pengalaman = PengalamanKerja::where('pengalaman_kerja_id',$foto->pengalaman_kerja_id)->first();
            $semua_foto = FotoKerja::where('pengalaman_kerja_id',$pengalaman->pengalaman_kerja_id)->get();    
            $semua_video = VideoKerja::where('pengalaman_kerja_id',$pengalaman->pengalaman_kerja_id)->get();    
            return view('perusahaan/kandidat/lihat_galeri_kandidat',compact('perusahaan','pengalaman','cabang','pesan','notif','credit','foto','semua_video','semua_foto','type'));            
        }
    }

    public function pencarianKandidat()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        $kandidat = Kandidat::where('penempatan','like','%'.$perusahaan->penempatan_kerja.'%')->whereNull('stat_pemilik')->get();        
        $isi = $kandidat->count();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first(); 
        return view('perusahaan/kandidat/pencarian_kandidat',compact('kandidat','perusahaan','isi','notif','pesan','cabang','credit'));
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
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
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
        ->whereNull('stat_pemilik')
        ->limit(15)->get();
        $isi = $kandidat->count();
        return view('perusahaan/kandidat/pilih_kandidat',compact('jk','perusahaan','kandidat','isi','notif','pesan','cabang','credit'));
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
        $permohonan = PermohonanLowongan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('jabatan',)->get();
        dd($permohonan);
        if($id_kandidat == null){
            return redirect('/perusahaan/list_permohonan_lowongan')->with('error','anda harus memilih minimal 1 kandidat');
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
                
                $data['id_kandidat'] = $id_kandidat[$a];
                $data['nama_kandidat'] = $nama[$a];
                $data['id_perusahaan'] = $perusahaan->id_perusahaan;
                PersetujuanKandidat::create($data);

                Kandidat::where('id_kandidat',$id_kandidat[$a])->update([
                    'stat_pemilik' => "kosong",
                ]);
                
                $interview = Interview::where('id_kandidat',$id_kandidat[$a])->where('id_perusahaan',$perusahaan->id_perusahaan)->first();
                // if(){

                // } else {
        
                // }
                notifyKandidat::create([
                    'id_kandidat' => $id_kandidat[$a],
                    'isi' => "Anda mendapat pesan masuk",
                    'pengirim' => "Sistem",
                    'url' => '/semua_pesan',
                ]);

                messageKandidat::create([
                    'id_kandidat' => $id_kandidat[$a], 
                    'pesan' => "Halo, Anda mendapat undangan interview dari ".$perusahaan->nama_perusahaan.".apakah anda menyetujuinya?",
                    'pengirim' => "Sistem",
                    'kepada' => $nama[$a],
                    'id_interview' => $interview->id_interview,
                ]);

                $kandidat = Kandidat::where('id_kandidat',$id_kandidat[$a])->whereNotNull('id_akademi')->first();
                if($kandidat !== null){
                    notifyAkademi::create([
                        'id_akademi' => $kandidat->id_akademi,
                        'id_kandidat' => $kandidat->id_kandidat,
                        'isi' => "Anda mendapat pesan masuk",
                        'pengirim' => "Sistem",
                        'url' => '/akademi/semua_notif',
                    ]);

                    messageAkademi::create([
                        'id_akademi' => $kandidat->id_akademi,
                        'id_kandidat' => $kandidat->id_kandidat,
                        'pesan' => "Selamat kandidat atas nama ".$kandidat->nama." telah diterima di ".$perusahaan->nama_perusahaan,
                        'pengirim' => "Sistem",
                        'kepada' => $kandidat->id_akademi,
                    ]);
                }
            }
        }
        return redirect('/perusahaan/persetujuan_kandidat');
    }

    public function JadwalInterview()
    {
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$auth->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $pilih = null;
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $interview = Interview::join(
            'permohonan_lowongan', 'interview.id_kandidat','=','permohonan_lowongan.id_kandidat'
        )->where('interview.id_perusahaan',$perusahaan->id_perusahaan)->where('interview.status',"pilih")->get();
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
        $terjadwal = Interview::join(
            'permohonan_lowongan', 'interview.id_kandidat','=','permohonan_lowongan.id_kandidat'
        )->where('interview.id_perusahaan',$perusahaan->id_perusahaan)->where('interview.status',"terjadwal")->get();
        $jml_kandidat = $interview->count();
        $biaya = 15000;
        $total = $jml_kandidat * $biaya;
        return view('perusahaan/interview',compact(
            'perusahaan','interview',
            'terjadwal','jml_kandidat',
            'biaya','total','pilih','notif',
            'pesan','cabang','credit',
        ));
    }

    public function tentukanJadwal()
    {
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$auth->no_nib)->first();
        $interview = Interview::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();       
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/jadwal_interview',compact('perusahaan','interview','notif','pesan','cabang','credit'));
    }

    public function simpanJadwal(Request $request)
    {
        $jadwal = $request->jadwal_interview;
        $nama = $request->nama;
        $auth = Auth::user();
        $ttl_interview = count($nama);
        $perusahaan = Perusahaan::where('no_nib',$auth->no_nib)->first();        
        $interview = Interview::where('id_perusahaan',$perusahaan->id_perusahaan)->first();
        for($i = 0; $i < count($jadwal); $i++){
            $input['jadwal_interview'] = $jadwal[$i];
            $input['status'] = "terjadwal";
            $data['nama'] = $nama[$i];
            $kandidat = Kandidat::where('nama','like','%'.$nama[$i].'%')->where('id_perusahaan',$perusahaan->id_perusahaan)->first();
            Interview::where('id_perusahaan',$perusahaan->id_perusahaan)->where('nama_kandidat',$nama[$i])->update($input);
            $time = Carbon::create($jadwal[$i])->isoformat('D MMM Y | h A');
            notifyKandidat::create([
                'id_kandidat' => $kandidat->id_kandidat,
                'id_perusahaan' => $perusahaan->id_perusahaan,
                'isi' => "Anda mendapat jadwal interview dengan perusahaan. cek pesan anda.",
                'pengirim' => "Admin",
                'id_interview' => $interview->id_interview,
                'url' => '/semua_pesan',
            ]);

            messageKandidat::create([
                'id_kandidat'=>$kandidat->id_kandidat,
                'id_perusahaan'=>$perusahaan->id_perusahaan,
                'pesan'=>$perusahaan->nama_perusahaan." telah menentukan waktu interview anda pada ".$time.".",
                'pengirim'=>$perusahaan->nama_perusahaan,
                'kepada'=>$kandidat->nama,
                'id_interview'=>$interview->id_interview,
            ]);
        }

        $payment = 1500 * $ttl_interview;
        $namarec = "Hamepa";
        $nomorec = 4399997272;
        $message = "Pembayaran Interview";
        // Mail::mailer('transfer')->to($perusahaan->email_perusahaan)->send(new transfer($perusahaan->nama_perusahaan,$message,'Pembayaran','digijobaccounting@ugiport.com',$payment,$namarec,$nomorec));

        $pembayaran = Pembayaran::create([
            'id_perusahaan'=>$perusahaan->id_perusahaan,
            'nama_pembayaran'=>$perusahaan->nama_perusahaan,
            'nib'=>$perusahaan->no_nib,
            'nominal_pembayaran'=>15000 * $ttl_interview,
            'stats_pembayaran'=>"belum dibayar",
        ]);

        return redirect('/perusahaan/interview')
        // return back()->with('success',"yay")
        ->with('success','Tagihan sudah muncul di email anda, silahkan selesaikan pembayaran untuk melanjutkan');
    }

    public function editJadwalInterview($id)
    {
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$auth->no_nib)->first();
        $interview = Interview::where('id_interview',$id)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();       
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/edit_interview',compact('perusahaan','interview','notif','pesan','cabang','credit'));
    }

    public function ubahJadwalInterview(Request $request,$id)
    { 
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$auth->no_nib)->first();
        $interview = Interview::where('id_interview',$id)->first();
        $kandidat = Kandidat::where('id_kandidat',$interview->id_kandidat)->first();
        if($interview->kesempatan == 1){
            return back()->with('warning',"Maaf kesempatan anda mengubah jadwal telah habis. Harap hubungi admin");
        }
        if($interview->jadwal_interview !== $request->jadwal){
            notifyKandidat::create([
                'id_kandidat' => $interview->id_kandidat,
                'id_perusahaan' => $interview->id_perusahaan,
                'isi' => "Ada perubahan jadwal interview anda dengan perusahaan. cek pesan anda.",
                'pengirim' => "Admin",
                'id_interview' => $interview->id_interview,
                'url' => '/semua_pesan',
            ]);
            $time = Carbon::create($request->jadwal)->isoformat('D MMM Y | h A');
            messageKandidat::create([
                'id_kandidat'=>$interview->id_kandidat,
                'id_perusahaan'=>$interview->id_perusahaan,
                'pesan'=>$perusahaan->nama_perusahaan." mengubah waktu interview anda menjadi ".$time.".",
                'pengirim'=>$perusahaan->nama_perusahaan,
                'kepada'=>$kandidat->nama,
                'id_interview'=>$interview->id_interview,
            ]);
        }
        Interview::where('id_interview',$id)->update([
            'jadwal_interview'=>$request->jadwal,
            'kesempatan' => 1,
        ]);
        return redirect('/perusahaan/interview')->with('success',"Jadwal berhasil diubah");
    }

    public function deleteJadwalInterview($id)
    {
        $interview = Interview::where('id_interview',$id)->first();
        Interview::where('id_interview',$id)->delete();
        Kandidat::where('id_kandidat',$interview->id_kandidat)->where('id_perusahaan',$interview->id_perusahaan)->update([
            'stat_pemilik'=>"kosong"
        ]);
        return redirect('/perusahaan/interview')->with('error',"Jadwal Interview Dibatalkan");
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
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/pembayaran/list_pembayaran', compact('perusahaan','pembayaran','notif','pesan','cabang','credit'));
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
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/pembayaran/pembayaran',compact('perusahaan','total','ttlBayar','notif','tgl','pembayaran','pesan','cabang','credit'));
    }

    public function paymentCheck(Request $request, $id)
    {
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$auth->no_nib)->first();
        // $this->validate($request, [
        //     'foto_ktp_izin' => 'required|file|image|mimes:jpeg,png,jpg|max:1024',
        // ]);
        $interview = Interview::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $pembayaran = $perusahaan->nama_perusahaan.time().'.'.$request->foto_pembayaran->extension();  
        $simpan_pembayaran = $request->file('foto_pembayaran');
        $simpan_pembayaran->move('gambar/Perusahaan/'.$perusahaan->nama_perusahaan.'/Pembayaran/',$perusahaan->nama_perusahaan.time().'.'.$simpan_pembayaran);
        $pembayaran = Pembayaran::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_pembayaran',$id)->update([
            'foto_pembayaran'=>$pembayaran
        ]);
        return redirect('/perusahaan')->with('success','Metode pembayaran sedang diproses mohon tunggu');
    }    
}