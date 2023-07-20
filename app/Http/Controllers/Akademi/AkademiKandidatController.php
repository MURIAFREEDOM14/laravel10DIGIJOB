<?php

namespace App\Http\Controllers\Akademi;

use App\Http\Controllers\Controller;
use App\Models\Akademi;
use App\Models\AkademiKandidat;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Kota;
use App\Models\Negara;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Perusahaan;
use App\Models\Kandidat;
use App\Models\messageAkademi;
use App\Models\notifyAkademi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AkademiKandidatController extends Controller
{
    public function index()
    {
        $id = Auth::user();
        $akademi = Akademi::where('referral_code',$id->referral_code)->first();
        $perusahaan = Perusahaan::all();
        $pesan = messageAkademi::where('id_akademi',$akademi->id_akademi)->limit(3)->get();
        $notif = notifyAkademi::where('id_akademi',$akademi->id_akademi)->limit(3)->get();
        $akademi_kandidat = Kandidat::where('id_akademi',$akademi->id_akademi)->limit(10)->get();
        return view('/akademi/akademi_index',compact('akademi','perusahaan','akademi_kandidat','pesan','notif'));
    } 

    public function isi_akademi_data()
    {
        $id = Auth::user();
        $akademi = Akademi::where('referral_code',$id->referral_code)->first();
        return view('akademi/isi_akademi_data',compact('akademi'));
    }

    public function simpan_akademi_data(Request $request)
    {
        // dd($request);
        $id = Auth::user();
        $akademi = Akademi::where('referral_code',$id->referral_code)->first();
        if($request->file('foto_akademi') !== null){
            // $this->validate($request, [
            //     'foto_ktp_izin' => 'required|file|image|mimes:jpeg,png,jpg|max:1024',
            // ]);
            $hapus_foto_akademi = public_path('/gambar/Akademi/'.$akademi->nama_akademi.'/Foto/').$akademi->foto_akademi;
            if(file_exists($hapus_foto_akademi)){
                @unlink($hapus_foto_akademi);
            }
            $foto_akademi = $akademi->nama_akademi.time().'.'.$request->foto_akademi->extension();  
            $request->foto_akademi->move(public_path('/gambar/Akademi/'.$akademi->nama_akademi.'/Foto/'), $foto_akademi);
        } else {
            if($akademi->foto_akademi !== null){
                $foto_akademi = $akademi->foto_akademi;                
            } else {
                $foto_akademi = null;                        
            }
        }
        
        if($request->file('logo_akademi') !== null){
            // $this->validate($request, [
            //     'foto_ktp_izin' => 'required|file|image|mimes:jpeg,png,jpg|max:1024',
            // ]);
            $hapus_logo_akademi = public_path('/gambar/Akademi/'.$akademi->nama_akademi.'/Logo/').$akademi->logo_akademi;
            if(file_exists($hapus_logo_akademi)){
                @unlink($hapus_logo_akademi);
            }
            $logo_akademi = $akademi->nama_akademi.time().'.'.$request->logo_akademi->extension();  
            $request->logo_akademi->move(public_path('/gambar/Akademi/'.$akademi->nama_akademi.'/Logo/'), $logo_akademi);
        } else {
            if($akademi->logo_akademi !== null){
                $logo_akademi = $akademi->logo_akademi;                
            } else {
                $logo_akademi = null;                        
            }
        }

        if ($foto_akademi !== null) {
            $photo_akademi = $foto_akademi;
        } else {
            $photo_akademi = null;
        }

        if ($logo_akademi !== null) {
            $logos_akademi = $logo_akademi;
        } else {
            $logos_akademi = null;
        }

        $akademi = Akademi::where('referral_code',$id->referral_code)->update([
            'no_surat_izin' => $request->no_surat_izin,
            'alamat_akademi' => $request->alamat_akademi,
            'no_telp_akademi' => $request->no_telp_akademi,
            'foto_akademi' => $photo_akademi,
            'logo_akademi' => $logos_akademi,
        ]);

        return redirect()->route('akademi.operator')
        // ->with('toast_success',"Data anda tersimpan");
        ->with('success',"Data anda tersimpan");
    }

    public function isi_akademi_operator()
    {
        $id = Auth::user();
        $akademi = Akademi::where('referral_code',$id->referral_code)->first();
        return view('akademi/isi_akademi_operator',compact('akademi'));
    }

    public function simpan_akademi_operator(Request $request)
    {
        $id = Auth::user();
        $akademi = Akademi::where('referral_code',$id->referral_code)->update([
            'nama_kepala_akademi' => $request->nama_kepala_akademi,
            'nama_operator' => $request->nama_operator,
            'email_operator' => $request->email_operator,
            'no_telp_operator' => $request->no_telp_operator,
        ]);
        return redirect('/akademi')
        // ->with('toast_success',"Data anda tersimpan");
        ->with('success',"Data anda tersimpan");
    }

    public function contactUsAkademi()
    {
        $id = Auth::user();
        $akademi = Akademi::where('referral_code',$id->referral_code)->first();
        $pesan = messageAkademi::where('id_akademi',$akademi->id_akademi)->limit(3)->get();
        $notif = notifyAkademi::where('id_akademi',$akademi->id_akademi)->limit(3)->get();
        return view('akademi/contact_us',compact('akademi','pesan','notif'));
    }

    public function lihatProfilAkademi()
    {
        $user = Auth::user();
        $akademi = Akademi::where('referral_code',$user->referral_code)->first();
        $pesan = messageAkademi::where('id_akademi',$akademi->id_akademi)->limit(3)->get();
        $notif = notifyAkademi::where('id_akademi',$akademi->id_akademi)->limit(3)->get();
        if($akademi->nama_kepala_akademi == null){
            return redirect()->route('akademi')->with('warning',"Harap lengkapi profil akademi terlebih dahulu");
        } else {
            return view('akademi/lihat_profil_akademi',compact('akademi','pesan','notif'));
        }
    }

    public function editProfilAkademi()
    {
        return redirect()->route('akademi.data');
    }

    public function lihatProfilPerusahaan($id)
    {
        $user = Auth::user();
        $akademi = Akademi::where('referral_code',$user->referral_code)->first();
        $perusahaan = Perusahaan::where('id_perusahaan',$id)->first();
        $pesan = messageAkademi::where('id_akademi',$akademi->id_akademi)->limit(3)->get();
        $notif = notifyAkademi::where('id_akademi',$akademi->id_akademi)->limit(3)->get();
        return view('akademi/lihat_profil_perusahaan',compact('akademi','perusahaan','pesan','notif'));
    }

    public function listKandidat()
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $kandidat = Kandidat::where('id_akademi',$akademi->id_akademi)->get();
        $pesan = messageAkademi::where('id_akademi',$akademi->id_akademi)->limit(3)->get();
        $notif = notifyAkademi::where('id_akademi',$akademi->id_akademi)->limit(3)->get();
        return view('akademi/list_kandidat',compact('akademi','kandidat','pesan','notif'));
    }

    public function lihatProfilKandidat($nama, $id)
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $kandidat = Kandidat::where('id_kandidat',$id)->where('nama',$nama)->first();
        $tgl_user = Carbon::create($kandidat->tgl_lahir)->isoFormat('D MMM Y');
        $pesan = messageAkademi::where('id_akademi',$akademi->id_akademi)->limit(3)->get();
        $notif = notifyAkademi::where('id_akademi',$akademi->id_akademi)->limit(3)->get();
        $negara = Negara::join(
            'akademi_kandidat','ref_negara.negara_id','=','akademi_kandidat.negara_id'
        )
        ->first();
        return view('akademi/kandidat/profil_kandidat',compact('akademi','kandidat','negara','tgl_user','pesan','notif'));
    }

    public function tambahKandidat()
    {
        $user = Auth::user();
        $akademi = Akademi::where('referral_code',$user->referral_code)->first();
        return view('akademi/kandidat/tambah_kandidat');
    }

    public function simpanKandidat(Request $request)
    {
        $user = Auth::user();
        $akademi = Akademi::where('referral_code',$user->referral_code)->first();
        $validated = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'no_telp' => 'required|unique:users|max:255',
            'password' => 'required|min:6|max:20',
        ]);

        $nama = $request->nama;
        $email = $request->email;
        $no_telp = $request->no_telp;
        $password = hash::make($request->password);
        $usia = Carbon::parse($request->tgl)->age;

        if($usia < 18)
        {
            return redirect('/akademi/tambah_kandidat')->with('warning',"Maaf Umur anda masih belum cukup, syarat umur ialah 18 thn keatas");
        }

        $user = User::create([
            'name' => $nama,
            'email' => $email,
            'no_telp' => $no_telp,
            'password' => $password,
        ]);

        $id = $user->id;
        $userId = \Hashids::encode($id.$no_telp);

        User::where('id',$id)->update([
            'referral_code' => $userId,
        ]);

        Kandidat::create([
            'id' => $id,
            'nama' => $nama,
            'referral_code' => $userId,
            'email' => $email,
            'no_telp' => $no_telp,
            'tgl_lahir' => $request->tgl,
            'usia' => $usia,
            'id_akademi' => $akademi->id_akademi,
        ]);

        return redirect('/akademi/isi_kandidat_personal/'.$nama.'/'.$id)
        // ->with('toast_success',"Data anda tersimpan");
        ->with('success',"Data anda tersimpan");
    }

    public function isi_personal($nama, $id)
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $kandidat = Kandidat::where('nama',$nama)->where('id',$id)->first();
        return view('akademi/kandidat/isi_personal',compact('akademi','kandidat'));
    }

    public function simpan_personal(Request $request, $nama, $id)
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $validate = $request->validate([
            // 'no_telp' => 'required|unique:users|min:10|max:13',
            // 'email' => 'required|unique:users|max:255',
        ]);

        if ($request->penempatan == "dalam negeri") {
            $negara_id = 2;
        } else {
            $negara_id = null;
        }
        
        Kandidat::where('nama',$nama)->where('id',$id)->update([
            'nama_panggilan'=>$request->nama_panggilan,
            'jenis_kelamin'=>$request->jenis_kelamin,
            'tmp_lahir'=>$request->tmp_lahir,
            'tgl_lahir'=>$request->tgl_lahir,
            'agama'=>$request->agama,
            'berat'=>$request->berat,
            'tinggi'=>$request->tinggi,
            'penempatan'=>$request->penempatan,
            'negara_id'=>$negara_id,
        ]);
        return redirect('/akademi/isi_kandidat_document/'.$nama.'/'.$id);
    }

    public function isi_document($nama,$id)
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $kandidat = Kandidat::where('nama',$nama)->where('id',$id)->first();
        return view('akademi/kandidat/isi_document',compact('akademi','kandidat'));
    }

    public function simpan_document(Request $request,$nama,$id)
    {
        $validated = $request->validate([
            'nik' => 'required|max:16|min:16',
            'foto_ktp' => 'mimes:png,jpg,jpeg|max:2048',
            'foto_set_badan' => 'mimes:png,jpg,jpeg|max:2048',
            'foto_4x6' => 'mimes:png,jpg,jpeg|max:2048',
            'foto_ket_lahir' => 'mimes:png,jpg,jpeg|max:2048',
            'foto_ijazah' => 'mimes:png,jpg,jpeg|max:2048',
        ]);
        // dd($request);
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $kandidat = Kandidat::where('nama',$nama)->where('id',$id)->first();
        // cek foto ktp
        if($request->file('foto_ktp') !== null){
            $hapus_ktp = public_path('/gambar/Kandidat/'.$kandidat->nama.'/KTP/').$kandidat->foto_ktp;
            if(file_exists($hapus_ktp)){
                @unlink($hapus_ktp);
            }
            $ktp = $kandidat->nama.time().'.'.$request->foto_ktp->extension();  
            $request->foto_ktp->move(public_path('/gambar/Kandidat/'.$kandidat->nama.'/KTP/'), $ktp);
            
        } else {
            if($kandidat->foto_ktp !== null){
                $ktp = $kandidat->foto_ktp;
            } else {
                $ktp = null;
            }
        }
        // cek foto set badan
        if($request->file('foto_set_badan') !== null){
            $hapus_set_badan = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Set_badan/').$kandidat->foto_set_badan;
            if(file_exists($hapus_set_badan)){
                @unlink($hapus_set_badan);
            }
            $set_badan = $kandidat->nama.time().'.'.$request->foto_set_badan->extension();  
            $request->foto_set_badan->move(public_path('/gambar/Kandidat/'.$kandidat->nama.'/Set_badan/'), $set_badan);
        } else {
            if ($kandidat->foto_set_badan !== null) {
                $set_badan = $kandidat->foto_set_badan;   
            } else {
                $set_badan = null;    
            }
        }
        // cek foto 4x6
        if($request->file('foto_4x6') !== null){
            $hapus_4x6 = public_path('/gambar/Kandidat/'.$kandidat->nama.'/4x6/').$kandidat->foto_4x6;
            if(file_exists($hapus_4x6)){
                @unlink($hapus_4x6);
            }
            $foto_4x6 = $kandidat->nama.time().'.'.$request->foto_4x6->extension();  
            $request->foto_4x6->move(public_path('/gambar/Kandidat/'.$kandidat->nama.'/4x6/'), $foto_4x6);
        } else {
            if ($kandidat->foto_4x6 !== null) {
                $foto_4x6 = $kandidat->foto_4x6;
            } else {
                $foto_4x6 = null;
            }
        }
        // cek foto ket lahir
        if($request->file('foto_ket_lahir') !== null){
            $hapus_ket_lahir = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Ket_lahir/').$kandidat->foto_ket_lahir;
            if(file_exists($hapus_ket_lahir)){
                @unlink($hapus_ket_lahir);
            }
            $ket_lahir = $kandidat->nama.time().'.'.$request->foto_ket_lahir->extension();  
            $request->foto_ket_lahir->move(public_path('/gambar/Kandidat/'.$kandidat->nama.'/Ket_lahir/'), $ket_lahir);            
        } else {
            if ($kandidat->foto_ket_lahir !== null) {
                $ket_lahir = $kandidat->foto_ket_lahir;    
            } else {
                $ket_lahir = null;
            }
        }
        // cek foto ijazah
        if($request->file('foto_ijazah') !== null){
            $hapus_ijazah = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Ijazah/').$kandidat->foto_ijazah;
            if(file_exists($hapus_ijazah)){
                @unlink($hapus_ijazah);
            }
            $ijazah = $kandidat->nama.time().'.'.$request->foto_ijazah->extension();  
            $request->foto_ijazah->move(public_path('/gambar/Kandidat/'.$kandidat->nama.'/Ijazah/'), $ijazah);
        } else {
            if ($kandidat->foto_ijazah !== null) {
                $ijazah = $kandidat->foto_ijazah;
            } else {
                $ijazah = null;                   
            }
        }
        if ($ktp !== null) {
            $foto_ktp = $ktp;
        } else {
            $foto_ktp = null;
        }
        
        if ($set_badan !== null) {
            $foto_set_badan = $set_badan;
        } else {
            $foto_set_badan = null;
        }
        
        if ($foto_4x6 !== null) {
            $photo_4x6 = $foto_4x6;
        } else {
            $photo_4x6 = null;
        }
        
        if ($ket_lahir !== null) {
            $foto_ket_lahir = $ket_lahir;
        } else {
            $foto_ket_lahir = null;
        }
        
        if ($ijazah !== null) {
            $foto_ijazah = $ijazah;
        } else {
            $foto_ijazah = null;
        }

        $provinsi = Provinsi::where('id',$request->provinsi_id)->first();
        $kota = Kota::where('id',$request->kota_id)->first();
        $kecamatan = Kecamatan::where('id',$request->kecamatan_id)->first();
        $kelurahan = Kelurahan::where('id',$request->kelurahan_id)->first();
        Kandidat::where('nama',$nama)->where('id',$id)->update([
            'nik'=>$request->nik,
            'pendidikan'=>$request->pendidikan,
            'rt'=>$request->rt,
            'rw'=>$request->rw,
            'dusun'=>$request->dusun,
            'kelurahan'=>$kelurahan->kelurahan,
            'kecamatan'=>$kecamatan->kecamatan,
            'kabupaten'=>$kota->kota,
            'provinsi'=>$provinsi->provinsi,
            'stats_negara'=>"Indonesia",
            'foto_ktp' => $foto_ktp,
            'foto_set_badan' => $foto_set_badan,
            'foto_4x6' => $photo_4x6,
            'foto_ket_lahir' =>$foto_ket_lahir,
            'foto_ijazah' => $foto_ijazah,
        ]);
        return redirect('/akademi/isi_kandidat_vaksin/'.$nama.'/'.$id);
    }

    public function isi_vaksin($nama, $id)
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $kandidat = Kandidat::where('nama',$nama)->where('id',$id)->first();
        return view('akademi/kandidat/isi_vaksin',compact('akademi','kandidat'));
    }

    public function simpan_vaksin(Request $request, $nama, $id)
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $kandidat = Kandidat::where('nama',$nama)->where('id',$id)->first();
        
        // cek vaksin1
        if($request->file('sertifikat_vaksin1') !== null){
            $hapus_sertifikat_vaksin1 = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Vaksin Pertama/').$kandidat->sertifikat_vaksin1;
            if(file_exists($hapus_sertifikat_vaksin1)){
                @unlink($hapus_sertifikat_vaksin1);
            }
            $sertifikat_vaksin1 = $kandidat->nama.time().'.'.$request->sertifikat_vaksin1->extension();  
            $request->sertifikat_vaksin1->move(public_path('/gambar/Kandidat/'.$kandidat->nama.'/Vaksin Pertama/'), $sertifikat_vaksin1);
        } else {
            if($kandidat->sertifikat_vaksin1 !== null){
                $sertifikat_vaksin1 = $kandidat->sertifikat_vaksin1;
            } else {
                $sertifikat_vaksin1 = null;
            }
        }
        // cek vaksin2
        if($request->file('sertifikat_vaksin2') !== null){
            $hapus_sertifikat_vaksin2 = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Vaksin Kedua/').$kandidat->sertifikat_vaksin2;
            if(file_exists($hapus_sertifikat_vaksin2)){
                @unlink($hapus_sertifikat_vaksin2);
            }
            $sertifikat_vaksin2 = $kandidat->nama.time().'.'.$request->sertifikat_vaksin2->extension();  
            $request->sertifikat_vaksin2->move(public_path('/gambar/Kandidat/'.$kandidat->nama.'/Vaksin Kedua/'), $sertifikat_vaksin2);
        } else {
            if($kandidat->sertifikat_vaksin2 !== null){
                $sertifikat_vaksin2 = $kandidat->sertifikat_vaksin2;
            } else {
                $sertifikat_vaksin2 = null;
            }
        }
        // cek vaksin3
        if($request->file('sertifikat_vaksin3') !== null){
            $hapus_sertifikat_vaksin3 = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Vaksin Ketiga/').$kandidat->sertifikat_vaksin3;
            if(file_exists($hapus_sertifikat_vaksin3)){
                @unlink($hapus_sertifikat_vaksin3);
            }
            $sertifikat_vaksin3 = $kandidat->nama.time().'.'.$request->sertifikat_vaksin3->extension();  
            $request->sertifikat_vaksin3->move(public_path('/gambar/Kandidat/'.$kandidat->nama.'/Vaksin Ketiga/'), $sertifikat_vaksin3);
        } else {
            if($kandidat->sertifikat_vaksin3 !== null){
                $sertifikat_vaksin3 = $kandidat->sertifikat_vaksin3;
            } else {
                $sertifikat_vaksin3 = null;
            }
        }
        
        if($sertifikat_vaksin1 !== null){
            $foto_sertifikat_vaksin1 = $sertifikat_vaksin1;
        } else {
            $foto_sertifikat_vaksin1 = null;
        }

        if($sertifikat_vaksin2 !== null){
            $foto_sertifikat_vaksin2 = $sertifikat_vaksin2;
        } else {
            $foto_sertifikat_vaksin2 = null;
        }

        if($sertifikat_vaksin3 !== null){
            $foto_sertifikat_vaksin3 = $sertifikat_vaksin3;
        } else {
            $foto_sertifikat_vaksin3 = null;
        }

        Kandidat::where('id',$id)->where('nama',$nama)->update([
            'vaksin1'=>$request->vaksin1,
            'no_batch_v1'=>$request->no_batch_v1,
            'tgl_vaksin1'=>$request->tgl_vaksin1,
            'sertifikat_vaksin1'=>$foto_sertifikat_vaksin1,
            'vaksin2'=>$request->vaksin2,
            'no_batch_v2'=>$request->no_batch_v2,
            'tgl_vaksin2'=>$request->tgl_vaksin2,
            'sertifikat_vaksin2'=>$foto_sertifikat_vaksin2,
            'vaksin3'=>$request->vaksin3,
            'no_batch_v3'=>$request->no_batch_v3,
            'tgl_vaksin3'=>$request->tgl_vaksin3,
            'sertifikat_vaksin3'=>$foto_sertifikat_vaksin3,
        ]);
        return redirect('/akademi/isi_kandidat_parent/'.$nama.'/'.$id);
    }

    public function isi_parent($nama,$id)
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $kandidat = Kandidat::where('nama',$nama)->where('id',$id)->first();
        return view('akademi/kandidat/isi_parent',compact('akademi','kandidat'));
    }

    public function simpan_parent(Request $request, $nama, $id)
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $kandidat = Kandidat::where('nama',$nama)->where('id_kandidat',$id)->first();
        $umur_ayah = Carbon::parse($request->tgl_lahir_ayah)->age;
        $umur_ibu = Carbon::parse($request->tgl_lahir_ibu)->age;
        Kandidat::where('nama',$nama)->where('id',$id)->update([
            'nama_ayah'=>$request->nama_ayah,
            'tgl_lahir_ayah'=>$request->tgl_lahir_ayah,
            'umur_ayah'=>$umur_ayah,
            'nama_ibu'=>$request->nama_ibu,
            'tgl_lahir_ibu'=>$request->tgl_lahir_ibu,
            'umur_ibu'=>$umur_ibu,
            'jml_sdr_lk'=>$request->jml_sdr_lk,
            'jml_sdr_pr'=>$request->jml_sdr_pr,
            'anak_ke'=>$request->anak_ke,
        ]);
        return redirect('/akademi/isi_kandidat_permission/'.$nama.'/'.$id);
    }

    public function isi_permission($nama,$id)
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $kandidat = Kandidat::where('nama',$nama)->where('id',$id)->first();
        return view('akademi/kandidat/isi_permission',compact('akademi','kandidat'));
    }

    public function simpan_permission(Request $request, $nama, $id)
    {
        $validated = $request->validate([
            'nik_perizin' => 'required|max:16|min:16',
            'foto_ktp_izin' => 'mimes:png,jpg,jpeg|max:2048',
            'no_telp_perizin' => 'min:10|max:13'
        ]);
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $kandidat = Kandidat::where('nama',$nama)->where('id',$id)->first();
        
        if($request->file('foto_ktp_izin') !== null){
            // $this->validate($request, [
            //     'foto_ktp_izin' => 'required|file|image|mimes:jpeg,png,jpg|max:1024',
            // ]);
            $hapus_foto_ktp_izin = public_path('/gambar/Kandidat/'.$kandidat->nama.'/KTP Perizin/').$kandidat->foto_ktp_izin;
            if(file_exists($hapus_foto_ktp_izin)){
                @unlink($hapus_foto_ktp_izin);
            }
            $ktp_izin = $kandidat->nama.time().'.'.$request->foto_ktp_izin->extension();
            $request->foto_ktp_izin->move(public_path('/gambar/Kandidat/'.$kandidat->nama.'/KTP Perizin/'), $ktp_izin);
        } else {
            if($kandidat->foto_ktp_izin !== null){
                $ktp_izin = $kandidat->foto_ktp_izin;                
            } else {
                $ktp_izin = null;    
            }
        }

        if ($ktp_izin !== null) {
            $foto_ktp_izin = $ktp_izin;
        } else {
            $foto_ktp_izin = null;
        }
        
        $provinsi_perizin = Provinsi::where('id',$request->provinsi_perizin)->first();
        $kota_perizin = Kota::where('id',$request->kota_perizin)->first();
        $kecamatan_perizin = Kecamatan::where('id',$request->kecamatan_perizin)->first();
        $kelurahan_perizin = Kelurahan::where('id',$request->kelurahan_perizin)->first();

        Kandidat::where('nama',$nama)->where('id',$id)->update([
            'nama_perizin'=>$request->nama_perizin,
            'nik_perizin'=>$request->nik_perizin,
            'no_telp_perizin'=>$request->no_telp_perizin,
            'tmp_lahir_perizin'=>$request->tmp_lahir_perizin,
            'tgl_lahir_perizin'=>$request->tgl_lahir_perizin,
            'provinsi_perizin'=>$provinsi_perizin->provinsi,
            'kabupaten_perizin'=>$kota_perizin->kota,
            'kecamatan_perizin'=>$kecamatan_perizin->kecamatan,
            'kelurahan_perizin'=>$kelurahan_perizin->kelurahan,
            'dusun_perizin'=>$request->dusun_perizin,
            'rt_perizin'=>$request->rt_perizin,
            'rw_perizin'=>$request->rw_perizin,
            'foto_ktp_izin'=>$foto_ktp_izin,
            'hubungan_perizin'=>$request->hubungan_perizin,
            'negara_perizin'=>"Indonesia",
        ]);
        if ($kandidat->penempatan == "dalam negeri") {
            return redirect('/akademi/list_kandidat')->with('success',"data anda telah kami terima");
        } else {
            return redirect('/akademi/isi_kandidat_placement/'.$nama.'/'.$id);
        }        
    }

    public function isi_placement($nama,$id)
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $negara = Negara::where('negara_id','not like',2)->get();
        $kandidat = Kandidat::where('nama',$nama)->where('id',$id)->first();
        if ($kandidat->penempatan == "dalam negeri") {
            return redirect('/akademi/list_kandidat')->with('success',"data anda telah kami terima");
        } else {
            return view('akademi/kandidat/isi_placement',compact('akademi','kandidat','negara'));
        }
    }

    public function simpan_placement(Request $request, $nama, $id)
    {
        // dd($request);
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $kandidat = Kandidat::where('nama',$nama)->where('id',$id)->first();
        Kandidat::where('nama',$nama)->where('id',$id)->update([
            'negara_id' => $request->negara_id,
        ]);
    }
}
