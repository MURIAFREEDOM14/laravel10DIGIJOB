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
    // halaman list data kandidat akademi
    public function listKandidat()
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $kandidat = Kandidat::where('id_akademi',$akademi->id_akademi)->get();
        $pesan = messageAkademi::where('id_akademi',$akademi->id_akademi)->where('check_click',"n")->get();
        $notif = notifyAkademi::where('id_akademi',$akademi->id_akademi)->limit(3)->get();
        return view('akademi/list_kandidat',compact('akademi','kandidat','pesan','notif'));
    }

    // halaman membuat data kandidat akademi
    public function tambahKandidat()
    {
        $user = Auth::user();
        $akademi = Akademi::where('referral_code',$user->referral_code)->first();
        return view('akademi/kandidat/tambah_kandidat');
    }

    // membuat data kandidat akademi
    public function simpanKandidat(Request $request)
    {
        $user = Auth::user();
        $akademi = Akademi::where('referral_code',$user->referral_code)->first();
        // validasi inputan
        $validated = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'no_telp' => 'required|unique:users|max:255',
            'nik' => 'required|unique:kandidat|max:255',
            'password' => 'required|min:6|max:20',
        ]);

        $nama = $request->nama;
        $email = $request->email;
        $no_telp = $request->no_telp;
        // merubah password menjadi kode acak
        $password = hash::make($request->password);
        // mencari usia kandidat melalui tanggal
        $usia = Carbon::parse($request->tgl)->age;

        // apabila usia kurang dari 18 thn
        if($usia < 18)
        {
            return redirect('/akademi/tambah_kandidat')->with('warning',"Maaf Umur anda masih belum cukup, syarat umur ialah 18 thn keatas");
        }

        // membuat data pengguna
        $user = User::create([
            'name' => $nama,
            'email' => $email,
            'no_telp' => $no_telp,
            'password' => $password,
            'check_password' => $request->password,
        ]);

        // mengambil id dari data pengguna
        $id = $user->id;
        // membuat kode kunci dari id + no telp (tipe integer / angka)
        $userId = \Hashids::encode($id.$no_telp);

        // menambah kode ke dalam data penggguna
        User::where('id',$id)->update([
            'referral_code' => $userId,
        ]);

        // membuat data kandidat + id akademi berasal
        Kandidat::create([
            'id' => $id,
            'nama' => $nama,
            'referral_code' => $userId,
            'email' => $email,
            'no_telp' => $no_telp,
            'tgl_lahir' => $request->tgl,
            'usia' => $usia,
            'id_akademi' => $akademi->id_akademi,
            'nik' => $request->nik,
        ]);

        return redirect('/akademi/isi_kandidat_personal/'.$nama.'/'.$id)
        // ->with('toast_success',"Data anda tersimpan");
        ->with('success',"Data anda tersimpan");
    }

    // halaman isi data kandidat personal dari akademi
    public function isi_personal($nama, $id)
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $kandidat = Kandidat::where('nama',$nama)->where('id',$id)->first();
        return view('akademi/kandidat/isi_personal',compact('akademi','kandidat'));
    }

    // simpan data kandidat personal dari akademi
    public function simpan_personal(Request $request, $nama, $id)
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();

        // apabila memilih penempatan dalam negeri
        if ($request->penempatan == "dalam negeri") {
            $negara_id = 2;
        } else {
            $negara_id = null;
        }
        
        // menambah data kandidat
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

    // halaman isi data document kandidat dari akademi
    public function isi_document($nama,$id)
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $kandidat = Kandidat::where('nama',$nama)->where('id',$id)->first();
        return view('akademi/kandidat/isi_document',compact('akademi','kandidat'));
    }

    // simpan data kandidat document dari akademi
    public function simpan_document(Request $request,$nama,$id)
    {
        // sistem validasi
        $validated = $request->validate([
            'nik' => 'required|max:16|min:16',
            'foto_ktp' => 'mimes:png,jpg,jpeg|max:2048',
            'foto_set_badan' => 'mimes:png,jpg,jpeg|max:2048',
            'foto_4x6' => 'mimes:png,jpg,jpeg|max:2048',
            'foto_ket_lahir' => 'mimes:png,jpg,jpeg|max:2048',
            'foto_ijazah' => 'mimes:png,jpg,jpeg|max:2048',
        ]);

        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $kandidat = Kandidat::where('nama',$nama)->where('id',$id)->first();
        // cek foto ktp
        // apabila ada inputan
        if($request->file('foto_ktp') !== null){
            // mencari file sebelumnya dan menghapus bila ada
            $hapus_ktp = public_path('/gambar/Kandidat/'.$kandidat->nama.'/KTP/').$kandidat->foto_ktp;
            if(file_exists($hapus_ktp)){
                @unlink($hapus_ktp);
            }
            // menyimpan data ke dalam aplikasi
            $ktp = $request->file('foto_ktp');
            $simpan_ktp = $kandidat->nama.time().'.'.$ktp->extension();  
            $ktp->move('/gambar/Kandidat/'.$kandidat->nama.'/KTP/', $simpan_ktp);
        } else {
            if($kandidat->foto_ktp !== null){
                $simpan_ktp = $kandidat->foto_ktp;
            } else {
                $simpan_ktp = null;
            }
        }
        // cek foto set badan
        // apabila ada inputan
        if($request->file('foto_set_badan') !== null){
            // mencari file sebelumnya dan menghapus bila ada
            $hapus_set_badan = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Set_badan/').$kandidat->foto_set_badan;
            if(file_exists($hapus_set_badan)){
                @unlink($hapus_set_badan);
            }
            // memasukkan gambar ke dalam aplikasi
            $set_badan = $request->file('foto_set_badan');
            $simpan_set_badan = $kandidat->nama.time().'.'.$set_badan->extension();  
            $set_badan->move('/gambar/Kandidat/'.$kandidat->nama.'/Set_badan/', $simpan_set_badan);
        } else {
            if ($kandidat->foto_set_badan !== null) {
                $simpan_set_badan = $kandidat->foto_set_badan;   
            } else {
                $simpan_set_badan = null;    
            }
        }
        // cek foto 4x6
        // apabila ada inputan
        if($request->file('foto_4x6') !== null){
            // mencari file sebelumnya dan menghapus bila ada
            $hapus_4x6 = public_path('/gambar/Kandidat/'.$kandidat->nama.'/4x6/').$kandidat->foto_4x6;
            if(file_exists($hapus_4x6)){
                @unlink($hapus_4x6);
            }
            // memasukkan file ke dalam aplikasi
            $foto_4x6 = $request->file('foto_4x6');
            $simpan_foto_4x6 = $kandidat->nama.time().'.'.$foto_4x6->extension();  
            $foto_4x6->move('/gambar/Kandidat/'.$kandidat->nama.'/4x6/', $simpan_foto_4x6);
        } else {
            if ($kandidat->foto_4x6 !== null) {
                $simpan_foto_4x6 = $kandidat->foto_4x6;
            } else {
                $simpan_foto_4x6 = null;
            }
        }
        // cek foto ket lahir
        // apabila ada inputan
        if($request->file('foto_ket_lahir') !== null){
            // mencari file sebelumnya dan menghapus bila ada
            $hapus_ket_lahir = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Ket_lahir/').$kandidat->foto_ket_lahir;
            if(file_exists($hapus_ket_lahir)){
                @unlink($hapus_ket_lahir);
            }
            // memasukkan gambar ke dalam aplikasi
            $ket_lahir = $request->file('foto_ket_lahir');
            $simpan_ket_lahir = $kandidat->nama.time().'.'.$ket_lahir->extension();  
            $ket_lahir->move('/gambar/Kandidat/'.$kandidat->nama.'/Ket_lahir/', $simpan_ket_lahir);            
        } else {
            if ($kandidat->foto_ket_lahir !== null) {
                $simpan_ket_lahir = $kandidat->foto_ket_lahir;    
            } else {
                $simpan_ket_lahir = null;
            }
        }
        // cek foto ijazah
        // apabila ada inputan
        if($request->file('foto_ijazah') !== null){
            // mencari file sebelumnya dan menghapus bila ada
            $hapus_ijazah = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Ijazah/').$kandidat->foto_ijazah;
            if(file_exists($hapus_ijazah)){
                @unlink($hapus_ijazah);
            }
            // memasukkan data ke dalam aplikasi
            $ijazah = $request->file('foto_ijazah');
            $simpan_ijazah = $kandidat->nama.time().'.'.$ijazah->extension();  
            $ijazah->move('/gambar/Kandidat/'.$kandidat->nama.'/Ijazah/', $simpan_ijazah);
        } else {
            if ($kandidat->foto_ijazah !== null) {
                $simpan_ijazah = $kandidat->foto_ijazah;
            } else {
                $simpan_ijazah = null;                   
            }
        }
        
        // apabila data file ada
        if ($simpan_ktp !== null) {
            $foto_ktp = $simpan_ktp;
        } else {
            $foto_ktp = null;
        }
        
        if ($simpan_set_badan !== null) {
            $foto_set_badan = $simpan_set_badan;
        } else {
            $foto_set_badan = null;
        }
        
        if ($simpan_foto_4x6 !== null) {
            $photo_4x6 = $simpan_foto_4x6;
        } else {
            $photo_4x6 = null;
        }
        
        if ($simpan_ket_lahir !== null) {
            $foto_ket_lahir = $simpan_ket_lahir;
        } else {
            $foto_ket_lahir = null;
        }
        
        if ($simpan_ijazah !== null) {
            $foto_ijazah = $simpan_ijazah;
        } else {
            $foto_ijazah = null;
        }

        // mencari alamat melalui input id
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

    // halaman isi data vaksin kandidat dari akademi
    public function isi_vaksin($nama, $id)
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $kandidat = Kandidat::where('nama',$nama)->where('id',$id)->first();
        return view('akademi/kandidat/isi_vaksin',compact('akademi','kandidat'));
    }

    // simpan data kandidat vaksin dari akademi
    public function simpan_vaksin(Request $request, $nama, $id)
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $kandidat = Kandidat::where('nama',$nama)->where('id',$id)->first();
        
        // cek vaksin1
        // apabila ada inputan
        if($request->file('sertifikat_vaksin1') !== null){
            // mencari file sebelumnya dan menghapusnya bila ada
            $hapus_sertifikat_vaksin1 = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Vaksin Pertama/').$kandidat->sertifikat_vaksin1;
            if(file_exists($hapus_sertifikat_vaksin1)){
                @unlink($hapus_sertifikat_vaksin1);
            }
            // memasukkan file ke dalam aplikasi
            $sertifikat_vaksin1 = $request->file('sertifikat_vaksin1');
            $simpan_sertifikat_vaksin1 = $kandidat->nama.time().'.'.$sertifikat_vaksin1->extension();  
            $sertifikat_vaksin1->move('/gambar/Kandidat/'.$kandidat->nama.'/Vaksin Pertama/', $simpan_sertifikat_vaksin1);
        } else {
            if($kandidat->sertifikat_vaksin1 !== null){
                $simpan_sertifikat_vaksin1 = $kandidat->sertifikat_vaksin1;
            } else {
                $simpan_sertifikat_vaksin1 = null;
            }
        }
        // cek vaksin2
        // apabila ada inputan
        if($request->file('sertifikat_vaksin2') !== null){
            // mencari file sebelumnya dan menghapusnya bila ada
            $hapus_sertifikat_vaksin2 = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Vaksin Kedua/').$kandidat->sertifikat_vaksin2;
            if(file_exists($hapus_sertifikat_vaksin2)){
                @unlink($hapus_sertifikat_vaksin2);
            }
            // memasukkan file ke dalam aplikasi
            $sertifikat_vaksin2 = $request->file('sertifikat_vaksin2');
            $simpan_sertifikat_vaksin2 = $kandidat->nama.time().'.'.$sertifikat_vaksin2->extension();  
            $sertifikat_vaksin2->move('/gambar/Kandidat/'.$kandidat->nama.'/Vaksin Kedua/', $simpan_sertifikat_vaksin2);
        } else {
            if($kandidat->sertifikat_vaksin2 !== null){
                $simpan_sertifikat_vaksin2 = $kandidat->sertifikat_vaksin2;
            } else {
                $simpan_sertifikat_vaksin2 = null;
            }
        }
        // cek vaksin3
        // apabila ada inputan
        if($request->file('sertifikat_vaksin3') !== null){
            // mencari file sebelumnya dan menghapusnya bila ada
            $hapus_sertifikat_vaksin3 = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Vaksin Ketiga/').$kandidat->sertifikat_vaksin3;
            if(file_exists($hapus_sertifikat_vaksin3)){
                @unlink($hapus_sertifikat_vaksin3);
            }
            // memasukkan file ke dalam aplikasi
            $sertifikat_vaksin3 = $request->file('sertifikat_vaksin3');
            $simpan_sertifikat_vaksin3 = $kandidat->nama.time().'.'.$sertifikat_vaksin3->extension();  
            $sertifikat_vaksin3->move('/gambar/Kandidat/'.$kandidat->nama.'/Vaksin Ketiga/', $simpan_sertifikat_vaksin3);
        } else {
            if($kandidat->sertifikat_vaksin3 !== null){
                $simpan_sertifikat_vaksin3 = $kandidat->sertifikat_vaksin3;
            } else {
                $simpan_sertifikat_vaksin3 = null;
            }
        }

        // mengecek apabila data file ada
        if($simpan_sertifikat_vaksin1 !== null){
            $foto_sertifikat_vaksin1 = $simpan_sertifikat_vaksin1;
        } else {
            $foto_sertifikat_vaksin1 = null;
        }

        if($simpan_sertifikat_vaksin2 !== null){
            $foto_sertifikat_vaksin2 = $simpan_sertifikat_vaksin2;
        } else {
            $foto_sertifikat_vaksin2 = null;
        }

        if($simpan_sertifikat_vaksin3 !== null){
            $foto_sertifikat_vaksin3 = $simpan_sertifikat_vaksin3;
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

    // halaman isi data parent / orang tua kandidat dari akademi
    public function isi_parent($nama,$id)
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $kandidat = Kandidat::where('nama',$nama)->where('id',$id)->first();
        return view('akademi/kandidat/isi_parent',compact('akademi','kandidat'));
    }

    // simpan data kandidat parent / orang tua dari akademi
    public function simpan_parent(Request $request, $nama, $id)
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $kandidat = Kandidat::where('nama',$nama)->where('id_kandidat',$id)->first();
        // mencari umur ayah melalui tanggal lahir
        $umur_ayah = Carbon::parse($request->tgl_lahir_ayah)->age;
        // mencari umur ibu melalui tanggal lahir
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

    // halaman isi data permission / perizinan / kontak darurat kandidat dari akademi
    public function isi_permission($nama,$id)
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $kandidat = Kandidat::where('nama',$nama)->where('id',$id)->first();
        return view('akademi/kandidat/isi_permission',compact('akademi','kandidat'));
    }

    // simpan data kandidat permission / perizinan / kontak darurat kandidat dari akademi
    public function simpan_permission(Request $request, $nama, $id)
    {
        // validasi inputan
        $validated = $request->validate([
            'nik_perizin' => 'required|max:16|min:16',
            'foto_ktp_izin' => 'mimes:png,jpg,jpeg|max:2048',
            'no_telp_perizin' => 'min:10|max:13'
        ]);
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $kandidat = Kandidat::where('nama',$nama)->where('id',$id)->first();
        
        // cek foto ktp pemberi izin / kontak darurat
        if($request->file('foto_ktp_izin') !== null){
            // mencari file sebelumnya dan menghapusnya bila ada
            $hapus_foto_ktp_izin = public_path('/gambar/Kandidat/'.$kandidat->nama.'/KTP Perizin/').$kandidat->foto_ktp_izin;
            if(file_exists($hapus_foto_ktp_izin)){
                @unlink($hapus_foto_ktp_izin);
            }
            // memasukkan file ke dalam aplikasi
            $ktp_izin = $request->file('foto_ktp_izin');
            $simpan_ktp_izin = $kandidat->nama.time().'.'.$ktp_izin->extension();
            $ktp_izin->move('/gambar/Kandidat/'.$kandidat->nama.'/KTP Perizin/', $simpan_ktp_izin);
        } else {
            if($kandidat->foto_ktp_izin !== null){
                $simpan_ktp_izin = $kandidat->foto_ktp_izin;                
            } else {
                $simpan_ktp_izin = null;    
            }
        }

        if ($simpan_ktp_izin !== null) {
            $foto_ktp_izin = $simpan_ktp_izin;
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
        // apabila kandidat ingin bekerja di dalam negeri
        if ($kandidat->penempatan == "dalam negeri") {
            // menuju data kandidat akademi
            return redirect('/akademi/list_kandidat')->with('success',"data anda telah kami terima");
        } else {
            // menuju halaman penempatan negara luar negeri
            return redirect('/akademi/isi_kandidat_placement/'.$nama.'/'.$id);
        }        
    }

    // halaman isi data penempatan kerja kandidat dari akademi
    public function isi_placement($nama,$id)
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $negara = Negara::where('negara_id','not like',2)->get();
        $kandidat = Kandidat::where('nama',$nama)->where('id',$id)->first();
        // apabila kandidat memilih dalam negeri
        if ($kandidat->penempatan == "dalam negeri") {
            // menuju data kandidat akademi
            return redirect('/akademi/list_kandidat')->with('success',"data anda telah kami terima");
        } else {
            // menuju halaman penempatan negara luar negeri
            return view('akademi/kandidat/isi_placement',compact('akademi','kandidat','negara'));
        }
    }

    // simpan data kandidat penempatan kerja dari akademi
    public function simpan_placement(Request $request, $nama, $id)
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $kandidat = Kandidat::where('nama',$nama)->where('id',$id)->first();
        Kandidat::where('nama',$nama)->where('id',$id)->update([
            'negara_id' => $request->negara_id,
        ]);
    }
}
