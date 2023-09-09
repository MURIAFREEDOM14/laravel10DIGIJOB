<?php

namespace App\Http\Controllers\Manager\Kandidat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Kandidat;
use App\Models\Perusahaan;
use App\Models\Negara;
use App\Models\Kelurahan;
use App\Models\Kecamatan;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\PengalamanKerja;
use App\Models\Pekerjaan;
use Carbon\Carbon;
use App\Models\LowonganPekerjaan;
use App\Models\PermohonanLowongan;
use App\Models\PersetujuanKandidat;
use App\Models\messageKandidat;
use App\Models\messagePerusahaan;
use App\Models\notifyKandidat;
use App\Models\notifyPerusahaan;
use App\Models\FotoKerja;
use App\Models\VideoKerja;
use App\Models\ContactUsKandidat;
use App\Models\Interview;
use App\Models\LaporanPekerja;
use App\Models\DisnakerInfo;
use App\Mail\DisnakerSender;
use Illuminate\Support\Facades\Mail;

class ManagerKandidatController extends Controller
{
    //===== Kandidat =====//
    // halaman data kandidat baru masuk / daftar
    public function kandidatBaru()
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $kandidat = Kandidat::whereNull('penempatan')->get();
        return view('manager/kandidat/kandidat_baru',compact('kandidat','manager'));
    }

    // halaman data kandidat dengan penempatan kerja dalam negeri
    public function dalamNegeri()
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $kandidat = Kandidat::where('penempatan','like','%dalam negeri%')->get();
        return view('manager/kandidat/dalam_negeri',compact('kandidat','manager'));
    }
    
    // halaman data kandidat dengan penempatan kerja luar negeri
    public function luarNegeri()
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $kandidat = Kandidat::where('penempatan','like',"%luar negeri%")->get();
        return view('manager/kandidat/luar_negeri',compact('kandidat','manager'));
    }
    
    // halaman edit data kandidat personal dari manager
    public function isi_personal($id)
    {
        $timeNow = Carbon::now();
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        return view('manager/kandidat/isi_personal',compact('timeNow','kandidat','manager'));
    }

    // proses simpan data kandidat personal dari manager
    public function simpan_personal(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_panggilan' => 'required|max:20',
            'email' => 'required',
        ]);
        $usia = Carbon::parse($request->tgl_lahir)->age;
        Kandidat::where('id_kandidat',$id)->update([
            'nama' => $request->nama,
            'nama_panggilan' => $request->nama_panggilan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'no_telp' => $request->no_telp,
            'agama' => $request->agama,
            'berat' => $request->berat,
            'tinggi' => $request->tinggi,
            'email' => $request->email,
            'penempatan' => $request->penempatan,
            'usia'=> $usia,
        ]);
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        if($kandidat->penempatan == "dalam negeri")
            {
                Kandidat::where('id_kandidat',$id)->update([
                    'negara_id' => 2
                ]);
            } else {
                Kandidat::where('id_kandidat',$id)->update([
                    'negara_id' => null,
                ]);
            }

        $userId = Kandidat::where('id_kandidat',$id)->first();
        User::where('referral_code', $userId->referral_code)->update([
            'name' => $request->nama,
            'no_telp' => $request->no_telp,
            'email' => $request->email
        ]);
        return redirect('/manager/kandidat/lihat_profil/'.$id);
    }

    // halaman edit data kandidat document dari manager
    public function isi_document($id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $kandidat = Kandidat::where('id_kandidat', $id)->first();
        $kelurahan = Kelurahan::all();
        $kecamatan = Kecamatan::all();
        $kota = Kota::all();
        $provinsi = Provinsi::all();
        $negara = Negara::all();
        return view('manager/kandidat/isi_document',compact('kandidat','kelurahan','kecamatan','kota','provinsi','negara','manager'));
    }

    // proses simpan data kandidat document dari manager
    public function simpan_document(Request $request,$id)
    {
        $kandidat = Kandidat::where('id_kandidat', $id)->first();    
        // cek foto ktp + simpan data
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
        // cek foto kk + simpan data
        if ($request->file('foto_kk') !== null) {    
            $hapus_kk = public_path('/gambar/Kandidat/'.$kandidat->nama.'/KK/').$kandidat->foto_kk;
            if(file_exists($hapus_kk)){
                @unlink($hapus_kk);
            }
            $kk = $kandidat->nama.time().'.'.$request->foto_kk->extension();  
            $request->foto_kk->move(public_path('/gambar/Kandidat/KK'), $kk);
        } else {
            if ($kandidat->foto_kk !== null) {
                $kk = $kandidat->foto_kk;
            } else {
                $kk = null;
            }
        }
        // cek foto set badan + simpan data
        if($request->file('foto_set_badan') !== null){
            $hapus_set_badan = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Set_badan/').$kandidat->foto_set_badan;
            if(file_exists($hapus_set_badan)){
                @unlink($hapus_set_badan);
            }
            $set_badan = $kandidat->nama.time().'.'.$request->foto_set_badan->extension();  
            $request->foto_set_badan->move(public_path('/gambar/Kandidat/Set_badan'), $set_badan);
        } else {
            if ($kandidat->foto_set_badan !== null) {
                $set_badan = $kandidat->foto_set_badan;   
            } else {
                $set_badan = null;    
            }
        }
        // cek foto 4x6 + simpan data
        if($request->file('foto_4x6') !== null){
            $hapus_4x6 = public_path('/gambar/Kandidat/'.$kandidat->nama.'/4x6/').$kandidat->foto_4x6;
            if(file_exists($hapus_4x6)){
                @unlink($hapus_4x6);
            }
            $foto_4x6 = $kandidat->nama.time().'.'.$request->foto_4x6->extension();  
            $request->foto_4x6->move(public_path('/gambar/Kandidat/4x6'), $foto_4x6);
        } else {
            if ($kandidat->foto_4x6 !== null) {
                $foto_4x6 = $kandidat->foto_4x6;
            } else {
                $foto_4x6 = null;
            }
        }
        // cek foto ket lahir + simpan data
        if($request->file('foto_ket_lahir') !== null){
            $hapus_ket_lahir = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Ket_lahir/').$kandidat->foto_ket_lahir;
            if(file_exists($hapus_ket_lahir)){
                @unlink($hapus_ket_lahir);
            }
            $ket_lahir = $kandidat->nama.time().'.'.$request->foto_ket_lahir->extension();  
            $request->foto_ket_lahir->move(public_path('/gambar/Kandidat/Ket_lahir'), $ket_lahir);
        } else {
            if ($kandidat->foto_ket_lahir !== null) {
                $ket_lahir = $kandidat->foto_ket_lahir;    
            } else {
                $ket_lahir = null;
            }
        }
        // cek foto ijazah + simpan data
        if($request->file('foto_ijazah') !== null){
            $hapus_ijazah = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Ijazah/').$kandidat->foto_ijazah;
            if(file_exists($hapus_ijazah)){
                @unlink($hapus_ijazah);
            }
            $ijazah = $kandidat->nama.time().'.'.$request->foto_ijazah->extension();  
            $request->foto_ijazah->move(public_path('/gambar/Kandidat/Ijazah'), $ijazah);            
        } else {
            if ($kandidat->foto_ijazah !== null) {
                $ijazah = $kandidat->foto_ijazah;
            } else {
                $ijazah = null;                   
            }
        }
        // cek bila data ktp sudah ada
        if ($ktp !== null) {
            $foto_ktp = $ktp;
        } else {
            $foto_ktp = null;
        }
        // cek bila data kk sudah ada
        if ($kk !== null) {
            $foto_kk = $kk;
        } else {
            $foto_kk = null;
        }
        // cek bila data set badan sudah ada
        if ($set_badan !== null) {
            $foto_set_badan = $set_badan;
        } else {
            $foto_set_badan = null;
        }
        // cek bila data foto 4x6 sudah ada
        if ($foto_4x6 !== null) {
            $photo_4x6 = $foto_4x6;
        } else {
            $photo_4x6 = null;
        }
        // cek apabila data ket lahir sudah ada
        if ($ket_lahir !== null) {
            $foto_ket_lahir = $ket_lahir;
        } else {
            $foto_ket_lahir = null;
        }
        // cek apabila data ijazah sudah ada
        if ($ijazah !== null) {
            $foto_ijazah = $ijazah;
        } else {
            $foto_ijazah = null;
        }
        
        $provinsi = Provinsi::where('id',$request->provinsi_id)->first();
        $kota = Kota::where('id',$request->kota_id)->first();
        $kecamatan = Kecamatan::where('id',$request->kecamatan_id)->first();
        $kelurahan = kelurahan::where('id',$request->kelurahan_id)->first();

        Kandidat::where('id_kandidat',$id)->update([
            'nik' => $request->nik,
            'pendidikan' => $request->pendidikan,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'dusun' => $request->dusun,
            'kelurahan' => $kelurahan->kelurahan,
            'kecamatan' => $kecamatan->kecamatan,
            'kabupaten' => $kota->kota,
            'provinsi' => $provinsi->provinsi,
            'foto_ktp' => 
            $foto_ktp,
            'foto_kk' => 
            $foto_kk,
            'foto_set_badan' => 
            $foto_set_badan,
            'foto_4x6' => 
            $photo_4x6,
            'foto_ket_lahir' =>
            $foto_ket_lahir,
            'foto_ijazah' => 
            $foto_ijazah,
            'stats_nikah' => $request->stats_nikah
        ]);
            return redirect('/manager/kandidat/lihat_profil/'.$id);
    }

    // halaman edit data kandidat family / keluarga jika sudah berkeluarga dari manager
    public function isi_family($id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        if ($kandidat->stats_nikah == null) {
            return redirect('/manager/kandidat/lihat_profil/'.$id);
        } elseif($kandidat->stats_nikah !== "Single") {
            return view('manager/kandidat/isi_family',compact('kandidat','manager'));    
        } else {
            return redirect('/manager/kandidat/lihat_profil/'.$id);
        }
    }

    // proses simpan data kandidat keluarga / family bisa sudah berkeluarga dari manager
    public function simpan_family(Request $request,$id)
    {
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        // cek buku nikah
        if($request->file('foto_buku_nikah') !== null){
            $hapus_buku_nikah = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Buku Nikah/').$kandidat->foto_buku_nikah;
            if(file_exists($hapus_buku_nikah)){
                @unlink($hapus_buku_nikah);
            }
            $buku_nikah = $kandidat->nama.time().'.'.$request->foto_buku_nikah->extension();  
            $request->foto_buku_nikah->move(public_path('/gambar/Kandidat/Buku Nikah'), $buku_nikah);
        } else {
            if($kandidat->foto_buku_nikah !== null){
                $buku_nikah = $kandidat->foto_buku_nikah;
            } else {
                $buku_nikah = null;
            }
        }
        // cek foto cerai
        if($request->file('foto_cerai')){
            $hapus_foto_cerai = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Cerai/').$kandidat->foto_foto_cerai;
            if(file_exists($hapus_foto_cerai)){
                @unlink($hapus_foto_cerai);
            }
            $cerai = $kandidat->nama.time().'.'.$request->foto_cerai->extension();  
            $request->foto_cerai->move(public_path('/gambar/Kandidat/Cerai'), $cerai);
        } else {
            if($kandidat->foto_cerai !== null){
                $cerai = $kandidat->foto_buku_nikah;
            } else {
                $cerai = null;
            }
        }
        // cek foto kematian pasangan
        if($request->file('foto_kematian_pasangan')){
            $hapus_kematian_pasangan = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Kematian Pasangan/').$kandidat->foto_kematian_pasangan;
            if(file_exists($hapus_kematian_pasangan)){
                @unlink($hapus_kematian_pasangan);
            }
            $kematian_pasangan = $kandidat->nama.time().'.'.$request->foto_kematian_pasangan->extension();  
            $request->foto_kematian_pasangan->move(public_path('/gambar/Kandidat/Kematian Pasangan'), $kematian_pasangan);
        } else {
            if($kandidat->foto_kematian_pasangan !== null){
                $kematian_pasangan = $kandidat->foto_buku_nikah;
            } else {
                $kematian_pasangan = null;
            }
        }
        // cek data buku nikah bila sudah ada
        if($buku_nikah !== null){
            $foto_buku_nikah = $buku_nikah;
        } else {
            $foto_buku_nikah = null;
        }
        // cek data ket cerai bila sudah ada
        if($cerai !== null){
            $foto_cerai = $cerai;
        } else {
            $foto_cerai = null;
        }
        // cek data ket kematian pasangan bila sudah ada
        if($kematian_pasangan !== null){
            $foto_kematian_pasangan = $kematian_pasangan;
        } else {
            $foto_kematian_pasangan = null;
        }

        Kandidat::where('id_kandidat', $id)->update([
            'foto_buku_nikah' => $foto_buku_nikah,
            'nama_pasangan' => $request->nama_pasangan,
            'umur_pasangan' => $request->umur_pasangan,
            'pekerjaan_pasangan' => $request->pekerjaan_pasangan,
            'jml_anak_lk' => $request->jml_anak_lk,
            'umur_anak_lk' => $request->umur_anak_lk,
            'jml_anak_pr' => $request->jml_anak_pr,
            'umur_anak_pr' => $request->umur_anak_pr,
            'foto_cerai' => $foto_cerai,
            'foto_kematian_pasangan' => $foto_kematian_pasangan,
        ]);
        return redirect('/manager/kandidat/lihat_profil/'.$id);
    }

    // halaman edit data kandidat vaksin dari manager
    public function isi_vaksin($id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $kandidat = Kandidat::where('id_kandidat', $id)->first(); 
        return view('manager/kandidat/isi_vaksin',['kandidat'=>$kandidat,'manager'=>$manager]);
    }

    // proses simpan data kandidat vaksin dari manager
    public function simpan_vaksin(Request $request,$id)
    {
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        // cek vaksin1
        if($request->file('sertifikat_vaksin1') !== null){
            $hapus_sertifikat_vaksin1 = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Vaksin Pertama/').$kandidat->sertifikat_vaksin1;
            if(file_exists($hapus_sertifikat_vaksin1)){
                @unlink($hapus_sertifikat_vaksin1);
            }
            $sertifikat_vaksin1 = $kandidat->nama.time().'.'.$request->sertifikat_vaksin1->extension();  
            $request->sertifikat_vaksin1->move(public_path('/gambar/Kandidat/Vaksin Pertama'), $sertifikat_vaksin1);
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
            $request->sertifikat_vaksin2->move(public_path('/gambar/Kandidat/Vaksin Kedua'), $sertifikat_vaksin2);    
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
            $request->sertifikat_vaksin3->move(public_path('/gambar/Kandidat/Vaksin Ketiga'), $sertifikat_vaksin3);
        } else {
            if($kandidat->sertifikat_vaksin3 !== null){
                $sertifikat_vaksin3 = $kandidat->sertifikat_vaksin3;
            } else {
                $sertifikat_vaksin3 = null;
            }
        }
        // pengecekan bukti vaksin1 bila ada
        if($sertifikat_vaksin1 !== null){
            $foto_sertifikat_vaksin1 = $sertifikat_vaksin1;
        } else {
            $foto_sertifikat_vaksin1 = null;
        }
        // pengecekan bukti vaksin2 bila ada
        if($sertifikat_vaksin2 !== null){
            $foto_sertifikat_vaksin2 = $sertifikat_vaksin2;
        } else {
            $foto_sertifikat_vaksin2 = null;
        }
        // pengecekan bukti vaksin3 bila ada
        if($sertifikat_vaksin3 !== null){
            $foto_sertifikat_vaksin3 = $sertifikat_vaksin3;
        } else {
            $foto_sertifikat_vaksin3 = null;
        }

        Kandidat::where('id_kandidat', $id)->update([
            'vaksin1' => $request->vaksin1,
            'no_batch_v1' => $request->no_batch_v1,
            'tgl_vaksin1' => $request->tgl_vaksin1,
            'sertifikat_vaksin1' => $foto_sertifikat_vaksin1,
            'vaksin2' => $request->vaksin2,
            'no_batch_v2' => $request->no_batch_v2,
            'tgl_vaksin2' => $request->tgl_vaksin2,
            'sertifikat_vaksin2' => $foto_sertifikat_vaksin2,
            'vaksin3' => $request->vaksin3,
            'no_batch_v3' => $request->no_batch_v3,
            'tgl_vaksin3' => $request->tgl_vaksin3,
            'sertifikat_vaksin3' => $foto_sertifikat_vaksin3
        ]);
        return redirect('/manager/kandidat/lihat_profil/'.$id);
    }

    // halaman edit data kandidat parent / orang tua dari manager
    public function isi_parent($id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $kandidat = Kandidat::where('id_kandidat', $id)->first();
        return view('manager/kandidat/isi_parent',['kandidat'=>$kandidat,'manager'=>$manager]);
    }

    // proses simpan data kandidat parent / orang tua dari manager
    public function simpan_parent(Request $request,$id)
    {
        Kandidat::where('id_kandidat', $id)->update([
            'nama_ayah' => $request->nama_ayah,
            'umur_ayah' => $request->umur_ayah,
            'nama_ibu' => $request->nama_ibu,
            'umur_ibu' => $request->umur_ibu,
            'jml_sdr_lk' => $request->jml_sdr_lk,
            'jml_sdr_pr' => $request->jml_sdr_pr,
            'anak_ke' => $request->anak_ke
        ]);

        $ket = 1;
        if ($ket == $request->confirm) {
            return redirect('/manager/kandidat/lihat_profil/'.$id);
        } else {
            return redirect('/manager/kandidat/lihat_profil/'.$id);
        }        
    }

    // halaman edit data kandidat company / pengalaman kerja dari manager
    public function isi_company($id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $kandidat = Kandidat::where('id_kandidat', $id)->first();
        return view('manager/kandidat/isi_company', ['kandidat'=>$kandidat,'manager'=>$manager]);
    }

    public function simpanPengalamanKerja(Request $request,$id)
    {
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        if($request->file('video') !== null){
            // $validated = $request->validate([
            //     'video' => 'mimes:mp4,mov,ogg,qt',
            // ]);
            $video = $request->file('video');
            $video->move('gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/',$kandidat->nama.$jabatan.$video->getClientOriginalName());
            $simpan_video = $kandidat->nama.$jabatan.$video->getClientOriginalName();
        } else {
            $simpan_video = null;
        }
        if($simpan_video !== null){
            $video_pengalaman = $simpan_video;
        } else {
            $video_pengalaman = null;
        }

        if($request->file('foto') !== null){
            $simpan_foto = $kandidat->nama.time().'.'.$request->foto->extension();
            $foto = $request->file('foto');  
            $foto->move('gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/',$kandidat->nama.time().'.'.$foto->extension());
        } else {            
            $simpan_foto = null;
        }

        if($simpan_foto !== null){
            $foto_pengalaman = $simpan_foto;
        } else {
            $foto_pengalaman = null;
        }

        $periodeAwal = new \Datetime($request->periode_awal);
        $periodeAkhir = new \DateTime($request->periode_akhir);
        $tahun = $periodeAkhir->diff($periodeAwal)->y;

        $pengalaman = PengalamanKerja::create([
            'nama_perusahaan'=>$request->nama_perusahaan,
            'alamat_perusahaan'=>$request->alamat_perusahaan,
            'jabatan'=>$request->jabatan,
            'periode_awal'=>$request->periode_awal,
            'periode_akhir'=>$request->periode_akhir,
            'alasan_berhenti'=>$request->alasan_berhenti,
            'id_kandidat'=>$kandidat->id_kandidat,
            'nama_kandidat' => $kandidat->nama,
            'lama_kerja' => $tahun,
            'deskripsi' => $request->deskripsi,
        ]);

        if($request->type == "video"){
            VideoKerja::create([
                'video' => $video_pengalaman,
                'pengalaman_kerja_id' => $pengalaman->id,
                'jabatan' => $request->jabatan,
            ]);
        } elseif($request->type == "foto") {
            FotoKerja::create([
                'foto'=> $foto_pengalaman,
                'pengalaman_kerja_id' => $pengalaman->id,
                'jabatan'=>$request->jabatan,
            ]);
        }
    }

    // proses simpan data kandidat company / pengalaman kerja dari manager
    public function simpan_company(Request $request,$id)
    {
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        $jabatan = $request->jabatan;
        $lama_kerja = $request->lama_kerja;
        if($jabatan !== null){
            $jabatanValues = implode(", ",$jabatan);
            $lamaKerjaValues = array_sum($lama_kerja);
        } else {
            $jabatanValues = null;
            $lamaKerjaValues = null;
        }
        Kandidat::where('id_kandidat', $id)->update([
            'pengalaman_kerja' => $jabatanValues,
            'lama_kerja' => $lamaKerjaValues,
        ]);

        $pengalaman_kerja = PengalamanKerja::create([
            'id_kandidat'=>$kandidat->id_kandidat,
            'pengalaman_kerja'=>$request->jabatan1.','.$request->jabatan2.','.$request->jabatan3,
        ]);
        return redirect('/manager/kandidat/lihat_profil/'.$id);
    }

    // halaman edit data kandidat personal dari manager
    public function isi_permission($id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $kandidat = Kandidat::where('id_kandidat', $id)->first();
        $provinsi = Provinsi::all();
        $kota = Kota::all();
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();
        return view('manager/kandidat/isi_permission',compact('kandidat','provinsi','kecamatan','kelurahan','kota','manager'));
    }

    public function simpan_permission(Request $request,$id)
    {
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        // cek foto ktp izin
        if($request->file('foto_ktp_izin') !== null){
            // $this->validate($request, [
            //     'foto_ktp_izin' => 'required|file|image|mimes:jpeg,png,jpg|max:1024',
            // ]);
            $hapus_foto_ktp_izin = public_path('/gambar/Kandidat/'.$kandidat->nama.'/KTP Perizin/').$kandidat->foto_ktp_izin;
            if(file_exists($hapus_foto_ktp_izin)){
                @unlink($hapus_foto_ktp_izin);
            }
            $ktp_izin = $kandidat->nama.time().'.'.$request->foto_ktp_izin->extension();
            $request->foto_ktp_izin->move(public_path('/gambar/Kandidat/KTP Perizin'), $ktp_izin);
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
        
        $provinsi = Provinsi::where('id',$request->provinsi_perizin)->first();
        $kota = Kota::where('id',$request->kota_perizin)->first();
        $kecamatan = Kecamatan::where('id',$request->kecamatan_perizin)->first();
        $kelurahan = Kelurahan::where('id',$request->kelurahan_perizin)->first();

        Kandidat::where('id_kandidat', $id)->update([
            'nama_perizin' => $request->nama_perizin,
            'nik_perizin' => $request->nik_perizin,
            'no_telp_perizin' => $request->no_telp_perizin,
            'tmp_lahir_perizin' => $request->tmp_lahir_perizin,
            'tgl_lahir_perizin' => $request->tgl_lahir_perizin,
            'rt_perizin' => $request->rt_perizin,
            'rw_perizin' => $request->rw_perizin,
            'dusun_perizin' => $request->dusun_perizin,
            'kelurahan_perizin' => $kelurahan->kelurahan,
            'kecamatan_perizin' => $kecamatan->kecamatan,
            'kabupaten_perizin' => $kota->kota,
            'provinsi_perizin' => $provinsi->provinsi,
            'negara_perizin' => "Indonesia",
            'foto_ktp_izin' => 
            $foto_ktp_izin,
            'hubungan_perizin' => $request->hubungan_perizin
        ]);

            return redirect('/manager/kandidat/lihat_profil/'.$id);
    }

    // halaman edit data kandidat personal dari manager
    public function isi_paspor($id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        return view('manager/kandidat/isi_paspor',compact('kandidat','manager'));
    }

    public function simpan_paspor(Request $request,$id)
    {
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        if($request->file('foto_paspor') !== null){
            // $this->validate($request, [
            //     'foto_ktp_izin' => 'required|file|image|mimes:jpeg,png,jpg|max:1024',
            // ]);
            $hapus_paspor = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Paspor/').$kandidat->foto_paspor;
            if(file_exists($hapus_paspor)){
                @unlink($hapus_paspor);
            }
            $paspor = $kandidat->nama.time().'.'.$request->foto_paspor->extension();  
            $request->foto_paspor->move(public_path('/gambar/Kandidat/Paspor'), $paspor);
        } else {
            if($kandidat->foto_paspor !== null){
                $paspor = $kandidat->foto_paspor;                
            } else {
                $paspor = null;    
            }
        }

        if ($paspor !== null) {
            $foto_paspor = $paspor;
        } else {
            $foto_paspor = null;
        }

        Kandidat::where('id_kandidat',$id)->update([
            'no_paspor'=>$request->no_paspor,
            'tgl_terbit_paspor'=>$request->tgl_terbit_paspor,
            'tgl_akhir_paspor'=>$request->tgl_akhir_paspor,
            'tmp_paspor'=>$request->tmp_paspor,
            'foto_paspor'=>$foto_paspor,
        ]);
        if ($kandidat->penempatan == "luar negeri") {
            return redirect('/manager/kandidat/lihat_profil/'.$id);
        } else {
            return redirect('/manager/kandidat/lihat_profil/'.$id);
        }
    }

    // halaman edit data kandidat personal dari manager
    public function isi_placement($id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $kandidat = Kandidat::where('id_kandidat', $id)->first();
        $negara = Negara::where('negara_id','not like',2)->get();
        // if ($kandidat->penempatan == "luar negeri"){
            return view('manager/kandidat/isi_placement',compact('negara','kandidat','manager'));
        // }
        // return redirect('/manager/kandidat/lihat_profil/'.$id);
    }

    public function simpan_placement(Request $request,$id)
    {
        if($request->negara_id == 2){
            $penempatan = "dalam negeri";
        } else {
            $penempatan = "luar negeri";
        }
        Kandidat::where('id_kandidat', $id)->update([
            'penempatan' => $penempatan,
            'negara_id' => $request->negara_id,
            // 'jabatan_kandidat' => $request->jabatan_kandidat,
            // 'kontrak' => $request->kontrak,
        ]);
        return redirect('/manager/kandidat/lihat_profil/'.$id);
    }
    
    //halaman lihat video pengalaman kerja kandidat
    public function lihatVideoKandidat($id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $kandidat = Kandidat::join(
            'pengalaman_kerja','kandidat.id_kandidat','=','pengalaman_kerja.id_kandidat'
        )
        ->where('pengalaman_kerja.pengalaman_kerja_id',$id)->first();
        $pengalaman_kerja = PengalamanKerja::where('id_kandidat',$kandidat->id_kandidat)->where('pengalaman_kerja_id','not like',$kandidat->pengalaman_kerja_id)->get();
        return view('manager/kandidat/lihat_video_kandidat',compact('manager','kandidat','pengalaman_kerja'));
    }

    public function pelamarLowongan()
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $lowongan = LowonganPekerjaan::all();
        return view('manager/kandidat/lowongan_pelamar',compact('lowongan','manager'));
    }

    public function lihatPelamarLowongan($id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $lowongan = LowonganPekerjaan::join(
            'perusahaan','lowongan_pekerjaan.id_perusahaan','=','perusahaan.id_perusahaan'
        )
        ->where('lowongan_pekerjaan.id_lowongan',$id)->first();
        $kandidat = Kandidat::where('id_perusahaan',$lowongan->id_perusahaan)->get();
        return view('manager/kandidat/lihat_lowongan_pelamar',compact('manager','lowongan','kandidat'));
    }

    public function penolakanKandidat(){
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $penolakan = PersetujuanKandidat::join(
            'kandidat','persetujuan_kandidat.id_kandidat','=','kandidat.id_kandidat'
        )
        ->join(
            'perusahaan','persetujuan_kandidat.id_perusahaan','=','perusahaan.id_perusahaan'
        )
        ->get();
        return view('manager/kandidat/penolakan_kandidat',compact('manager','penolakan'));
    }

    public function lihatPenolakanKandidat($id){
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $penolakan = PersetujuanKandidat::join(
            'kandidat','persetujuan_kandidat.id_kandidat','=','kandidat.id_kandidat'
        )
        ->join(
            'perusahaan','persetujuan_kandidat.id_perusahaan','=','perusahaan.id_perusahaan'
        )
        ->where('persetujuan_kandidat.persetujuan_id',$id)->first();
        return view('manager/kandidat/lihat_penolakan',compact('manager','penolakan'));
    }

    public function penghapusanKandidat()
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $kandidat = Kandidat::all();
        return view('manager/kandidat/penghapusan_kandidat',compact('manager','kandidat'));
    }

    public function confirmPenghapusanKandidat($id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $kandidat = Kandidat::where('id_kandidat',$id)->first();

        notifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->delete();
        messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->delete();
        PermohonanLowongan::where('id_kandidat',$kandidat->id_kandidat)->delete();
        PersetujuanKandidat::where('id_kandidat',$kandidat->id_kandidat)->delete();
        ContactUsKandidat::where('id_kandidat',$kandidat->id_kandidat)->delete();
        Interview::where('id_kandidat',$kandidat->id_kandidat)->delete();

        $hapus_ktp = public_path('gambar/Kandidat/'.$kandidat->nama.'/KTP/').$kandidat->foto_ktp;
            if(file_exists($hapus_ktp)){
                @unlink($hapus_ktp);
            }
        $hapus_kk = public_path('gambar/Kandidat/'.$kandidat->nama.'/KK/').$kandidat->foto_kk;
            if(file_exists($hapus_kk)){
                @unlink($hapus_kk);
            }
        $hapus_set_badan = public_path('gambar/Kandidat/'.$kandidat->nama.'/Set_badan/').$kandidat->foto_set_badan;
            if(file_exists($hapus_set_badan)){
                @unlink($hapus_set_badan);
            }
        $hapus_4x6 = public_path('gambar/Kandidat/'.$kandidat->nama.'/4x6/').$kandidat->foto_4x6;
            if(file_exists($hapus_4x6)){
                @unlink($hapus_4x6);
            }
        $hapus_ket_lahir = public_path('gambar/Kandidat/'.$kandidat->nama.'/Ket_lahir/').$kandidat->foto_ket_lahir;
            if(file_exists($hapus_ket_lahir)){
                @unlink($hapus_ket_lahir);
            }
        $hapus_ijazah = public_path('gambar/Kandidat/'.$kandidat->nama.'/Ijazah/').$kandidat->foto_ijazah;
            if(file_exists($hapus_ijazah)){
                @unlink($hapus_ijazah);
            }
        $hapus_buku_nikah = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Buku Nikah/').$kandidat->foto_buku_nikah;
            if(file_exists($hapus_buku_nikah)){
                @unlink($hapus_buku_nikah);
            }
        $hapus_cerai = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Cerai/').$kandidat->foto_cerai;
            if(file_exists($hapus_cerai)){
                @unlink($hapus_cerai);
            }
        $hapus_kematian_pasangan = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Kematian Pasangan/').$kandidat->foto_kematian_pasangan;
            if(file_exists($hapus_kematian_pasangan)){
                @unlink($hapus_kematian_pasangan);
            }
        $hapus_sertifikat_vaksin1 = public_path('gambar/Kandidat/'.$kandidat->nama.'/Vaksin Pertama/').$kandidat->sertifikat_vaksin1;
            if(file_exists($hapus_sertifikat_vaksin1)){
                @unlink($hapus_sertifikat_vaksin1);
            }
        $hapus_sertifikat_vaksin2 = public_path('gambar/Kandidat/'.$kandidat->nama.'/Vaksin Kedua/').$kandidat->sertifikat_vaksin2;
            if(file_exists($hapus_sertifikat_vaksin2)){
                @unlink($hapus_sertifikat_vaksin2);
            }
        $hapus_sertifikat_vaksin3 = public_path('gambar/Kandidat/'.$kandidat->nama.'/Vaksin Ketiga/').$kandidat->sertifikat_vaksin3;
            if(file_exists($hapus_sertifikat_vaksin3)){
                @unlink($hapus_sertifikat_vaksin3);
            }
        $hapus_foto_ktp_izin = public_path('gambar/Kandidat/'.$kandidat->nama.'/KTP Perizin/').$kandidat->foto_ktp_izin;
            if(file_exists($hapus_foto_ktp_izin)){
                @unlink($hapus_foto_ktp_izin);
            }
        $hapus_paspor = public_path('gambar/Kandidat/'.$kandidat->nama.'/Paspor/').$kandidat->foto_paspor;
            if(file_exists($hapus_paspor)){
                @unlink($hapus_paspor);
            }
        $pengalaman = PengalamanKerja::where('id_kandidat',$kandidat->id_kandidat)->first();
        if($pengalaman){
            $foto = FotoKerja::where('pengalaman_kerja_id',$pengalaman->pengalaman_kerja_id)->first();
            $video = VideoKerja::where('pengalaman_kerja_id',$pengalaman->pengalaman_kerja_id)->first();
            
        $hapus_video_kerja = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/').$video->video;
            if(file_exists($hapus_video_kerja)){
                @unlink($hapus_video_kerja);
            }
        $hapus_foto = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/').$foto->foto;
            if(file_exists($hapus_foto)){
                @unlink($hapus_foto);
            }
            
            VideoKerja::where('pengalaman_kerja_id',$pengalaman->pengalaman_kerja_id)->delete();
            FotoKerja::where('pengalaman_kerja_id',$pengalaman->pengalaman_kerja_id)->delete();
            PengalamanKerja::where('id_kandidat',$kandidat->id_kandidat)->delete();    
        }

        User::where('id',$kandidat->id)->delete();
        Kandidat::where('id_kandidat',$id)->delete();
        return back()->with('success',"Data Kandidat Telah Dihapus");
    }

    public function laporanKandidat()
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $laporan = LaporanPekerja::join(
            'kandidat','laporan_pekerja.id_kandidat','=','kandidat.id_kandidat'
        )->get();
        return view('manager/kandidat/laporan_kandidat',compact('manager','laporan'));
    }

    public function lihatLaporanKandidat($id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $laporan = LaporanPekerja::join(
            'kandidat','laporan_pekerja.id_kandidat','=','kandidat.id_kandidat'
        )->where('kandidat.id_kandidat',$id)->first();
        return view('manager/kandidat/lihat_laporan_kandidat',compact('manager','laporan'));   
    }

    public function penerimaanPerusahaan()
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $kandidat = Kandidat::all();
        return view('manager/kandidat/penerimaan_perusahaan',compact('manager','kandidat'));
    }

    public function lihatPenerimaanPerusahaan($id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $perusahaan = null;
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        $semua_perusahaan = Perusahaan::all();
        return view('manager/kandidat/lihat_penerimaan_perusahaan',compact('manager','perusahaan','kandidat','semua_perusahaan','id'));
    }

    public function cariPenerimaanPerusahaan(Request $request, $id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $perusahaan = Perusahaan::where('id_perusahaan',$request->id_perusahaan)->first();
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        $semua_perusahaan = Perusahaan::all();
        $lowongan = LowonganPekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        return view('manager/kandidat/lihat_penerimaan_perusahaan',compact('manager','perusahaan','kandidat','semua_perusahaan','id','lowongan'));
    }

    public function konfirmasiPenerimaanPerusahaan(Request $request, $id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $perusahaan = Perusahaan::where('id_perusahaan',$request->id_perusahaan)->first();
        Kandidat::where('id_kandidat',$id)->update([
            'stat_pemilik' => "diterima",
        ]);
        $kandidat = Kandidat::where('id_kandidat',$id)->first();        
        $disnaker = DisnakerInfo::where('alamat_disnaker','like','%'.$kandidat->kabupaten.'%')->first();
        if($disnaker == null){
            return redirect('/manager/kandidat/lihat_penerimaan_perusahaan/'.$id)->with('error',"Maaf belum ada kontak disnaker dengan alamat ".$kandidat->kabupaten);
        }
        $now = Carbon::create(now());
        // LaporanPekerja::create([
        //     'nama_kandidat' => $kandidat->nama,
        //     'id_kandidat' => $kandidat->id_kandidat,
        //     'tmp_bekerja' => $perusahaan->nama_perusahaan,
        //     'jabatan' => $request->jabatan,
        //     'tgl_kerja' => $now,
        // ]);
        // notifyKandidat::create([
        //     'id_kandidat' => $kandidat->id_kandidat,
        //     'isi' => "Selamat!! anda diterima di sebuah perusahaan. periksa pesan untuk detail",
        //     'pengirim' => "Admin",
        //     'url' => '/semua_pesan',
        // ]);
        // notifyPerusahaan::create([
        //     'id_perusahaan' => $perusahaan->id_perusahaan,
        //     'isi' => "Selamat!! Ada mendapat kandidat baru di Perusahaan anda. periksa pesan untuk detail",
        //     'pengirim' => "Admin",
        //     'url' => "/perusahaan/semua_pesan",
        // ]);
        // messageKandidat::create([
        //     'id_kandidat' => $kandidat->id_kandidat,
        //     'pesan' => "Selamat!! Anda kini telah di terima di Perusahaan ".$perusahaan->nama_perusahaan.". Untuk info selanjutnya, harap untuk selalu memeriksa pesan dari kami.",
        //     'pengirim' => "Admin",
        //     'kepada' => $kandidat->nama,
        // ]);
        // messagePerusahaan::create([
        //     'id_perusahaan' => $perusahaan->id_perusahaan,
        //     'pesan' => "Selamat anda mendapat kandidat baru atas nama ".$kandidat->nama.".",
        //     'pengirim' => "Admin",
        //     'kepada' => $perusahaan->nama_perusahaan, 
        // ]);    
        
        $disnakerNama = $disnaker->nama_disnaker;
        $disnakerEmail = $disnaker->email_disnaker;
        $disnakerAlamat = $disnaker->alamat_disnaker;
        
        $kandidatNama = $kandidat->nama;
        $kandidatNIK = $kandidat->nik;
        $kandidatDSN = $kandidat->dusun;
        $kandidatRT = $kandidat->rt;
        $kandidatRW = $kandidat->rw;
        $kandidatKEL = $kandidat->kelurahan;
        $kandidatKEC = $kandidat->kecamatan;
        $kandidatKAB = $kandidat->kabupaten;
        $kandidatPROV = $kandidat->provinsi;
        $kandidatAlamat = "DSN. ".$kandidatDSN.", RT. ".$kandidatRT.", RW. ".$kandidatRW.", KEL. ".$kandidatKEL.", KEC. ".$kandidatKEC.", KAB/KOTA. ".$kandidatKAB.", ".$kandidatPROV;
        
        // Mail::mailer('verification')->to($disnakerEmail)->send(new DisnakerSender($disnakerNama, $kandidatNama, 'no-reply@ugiport.com', 'Konfirmasi Disnaker'));    
        Mail::mailer('verification')->to($kandidat->email)->send(new DisnakerSender($disnakerNama, $disnakerEmail, $disnakerAlamat, $kandidatNama, $kandidatNIK, $kandidatAlamat,'no-reply@ugiport.com', 'Konfirmasi Disnaker'));    
        return redirect('/manager/kandidat/penerimaan_perusahaan')->with('success',"Kandidat sudah terverifikasi");
    }
}
