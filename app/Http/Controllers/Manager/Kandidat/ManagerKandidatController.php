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
use App\Models\notifyKandidat;
use App\Models\FotoKerja;
use App\Models\VideoKerja;
use App\Models\ContactUsKandidat;
use App\Models\Interview;
use App\Models\LaporanPekerja;

class ManagerKandidatController extends Controller
{
    // Kandidat Data //
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

    public function isi_personal($id)
    {
        $timeNow = Carbon::now();
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        return view('manager/kandidat/isi_personal',compact('timeNow','kandidat','manager'));
    }

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
        // dd($kandidat);
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

    public function simpan_document(Request $request,$id)
    {
        $kandidat = Kandidat::where('id_kandidat', $id)->first();    
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
        // cek foto kk
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
        // cek foto set badan
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
        // cek foto 4x6
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
        // cek foto ket lahir
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
        // cek foto ijazah
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

        if ($ktp !== null) {
            $foto_ktp = $ktp;
        } else {
            $foto_ktp = null;
        }
        
        if ($kk !== null) {
            $foto_kk = $kk;
        } else {
            $foto_kk = null;
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
        
        if($buku_nikah !== null){
            $foto_buku_nikah = $buku_nikah;
        } else {
            $foto_buku_nikah = null;
        }
        
        if($cerai !== null){
            $foto_cerai = $cerai;
        } else {
            $foto_cerai = null;
        }

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

    public function isi_vaksin($id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $kandidat = Kandidat::where('id_kandidat', $id)->first(); 
        return view('manager/kandidat/isi_vaksin',['kandidat'=>$kandidat,'manager'=>$manager]);
    }

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

        Kandidat::where('id_kandidat', $id)->update([
            'vaksin1' => $request->vaksin1,
            'no_batch_v1' => $request->no_batch_v1,
            'tgl_vaksin1' => $request->tgl_vaksin1,
            'sertifikat_vaksin1' => 
            // null ,
            $foto_sertifikat_vaksin1,
            'vaksin2' => $request->vaksin2,
            'no_batch_v2' => $request->no_batch_v2,
            'tgl_vaksin2' => $request->tgl_vaksin2,
            'sertifikat_vaksin2' => 
            // null,
            $foto_sertifikat_vaksin2,
            'vaksin3' => $request->vaksin3,
            'no_batch_v3' => $request->no_batch_v3,
            'tgl_vaksin3' => $request->tgl_vaksin3,
            'sertifikat_vaksin3' => 
            // null,
            $foto_sertifikat_vaksin3
        ]);
        return redirect('/manager/kandidat/lihat_profil/'.$id);
    }

    public function isi_parent($id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $kandidat = Kandidat::where('id_kandidat', $id)->first();
        return view('manager/kandidat/isi_parent',['kandidat'=>$kandidat,'manager'=>$manager]);
    }

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

    public function isi_company($id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $kandidat = Kandidat::where('id_kandidat', $id)->first();
        return view('manager/kandidat/isi_company', ['kandidat'=>$kandidat,'manager'=>$manager]);
    }

    public function simpan_company(Request $request,$id)
    {
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        //video1
        if($request->file('video_kerja1') !== null){
            $validated = $request->validate([
                'video_kerja1' => 'mimes:mp4,mov,ogg,qt | max:2000',
            ]);
            $video_kerja1 = $request->file('video_kerja1');
            $video_kerja1->move('gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/Pengalaman Kerja1',$kandidat->nama.$video_kerja1->getClientOriginalName());
            $simpan_kerja1 = $kandidat->nama.$video_kerja1->getClientOriginalName();
            dd($simpan_kerja1);
        } else {
            if($kandidat->video_kerja1 !== null){
                $simpan_kerja1 = $kandidat->video_kerja1;
            } else {
                $simpan_kerja1 = null;
            }
        }
        //video2
        if ($request->file('video_kerja2') !== null){
            $validated = $request->validate([
                'video_kerja2' => 'mimes:mp4,mov,ogg,qt | max:2000',
            ]);
            $video_kerja2 = $request->file('video_kerja2');
            $video_kerja2->move('gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/Pengalaman Kerja2',$kandidat->nama.$video_kerja2->getClientOriginalName());
            $simpan_kerja2 = $kandidat->nama.$video_kerja2->getClientOriginalName();
        } else {
            if($kandidat->video_kerja2 !== null){
                $simpan_kerja2 = $kandidat->video_kerja2;
            } else {
                $simpan_kerja2 = null;                 
            }
        }
        //video3
        if ($request->file('video_kerja3') !== null){
            $validated = $request->validate([
                'video_kerja3' => 'mimes:mp4,mov,ogg,qt | max:20000',
            ]);
            $video_kerja3 = $request->file('video_kerja3');
            $video_kerja3->move('gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/Pengalaman Kerja3',$kandidat->nama.$video_kerja3->getClientOriginalName());
            $simpan_kerja3 = $kandidat->nama.$video_kerja3->getClientOriginalName();
        } else {
            if($kandidat->video_kerja3 !== null){
                $simpan_kerja3 = $kandidat->video_kerja3;                   
            } else {
                $simpan_kerja3 = null;
            }
        }
        //cek_video1
        if($simpan_kerja1 !== null){
            $video1 = $simpan_kerja1;
        } else {
            $video1 = null;
        }
        //cek_video2
        if($simpan_kerja2 !== null){
            $video2 = $simpan_kerja2;
        } else {
            $video2 = null;
        }
        // cek_video3
        if($simpan_kerja3 !== null){
            $video3 = $simpan_kerja3;
        } else {
            $video3 = null;
        }

        Kandidat::where('id_kandidat', $id)->update([
            'nama_perusahaan1' => $request->nama_perusahaan1,
            'alamat_perusahaan1' => $request->alamat_perusahaan1,
            'jabatan1' => $request->jabatan1,
            'periode_awal1' => $request->periode_awal1,
            'periode_akhir1' => $request->periode_akhir1,
            'alasan1' => $request->alasan1,
            'video_kerja1' => $video1,
            'nama_perusahaan2' => $request->nama_perusahaan2,
            'alamat_perusahaan2' => $request->alamat_perusahaan2,
            'jabatan2' => $request->jabatan2,
            'periode_awal2' => $request->periode_awal2,
            'periode_akhir2' => $request->periode_akhir2,
            'alasan2' => $request->alasan2,
            'video_kerja2' => $video2,
            'nama_perusahaan3' => $request->nama_perusahaan3,
            'alamat_perusahaan3' => $request->alamat_perusahaan3,
            'jabatan3' => $request->jabatan3,
            'periode_awal3' => $request->periode_awal3,
            'periode_akhir3' => $request->periode_akhir3,
            'alasan3' => $request->alasan3,
            'video_kerja3' => $video3,
        ]);

        $pengalaman_kerja = PengalamanKerja::create([
            'id_kandidat'=>$kandidat->id_kandidat,
            'pengalaman_kerja'=>$request->jabatan1.','.$request->jabatan2.','.$request->jabatan3,
        ]);
        return redirect('/manager/kandidat/lihat_profil/'.$id);
    }

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

    public function isi_job($id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        $umur = Carbon::parse($kandidat->tgl_lahir)->age;
            $pekerjaan = Pekerjaan::join(
                'ref_negara', 'pekerjaan.negara_id','=','ref_negara.negara_id'
            )
            ->where('pekerjaan.negara_id',$kandidat->negara_id)
            ->where('pekerjaan.syarat_umur','>=',$umur)
            ->get();
        return view('manager/kandidat/isi_job',compact('pekerjaan','kandidat','manager'));
    }

    public function simpan_job(Request $request,$id)
    {
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        Kandidat::where('id_kandidat',$id)->update([
            'id_pekerjaan'=> $request->id_pekerjaan
        ]);
        return redirect('/manager/kandidat/lihat_profil/'.$id);
    }

    public function kandidatBaru()
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $kandidat = Kandidat::whereNull('penempatan')->get();
        return view('manager/kandidat/kandidat_baru',compact('kandidat','manager'));
    }

    public function dalamNegeri()
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $kandidat = Kandidat::where('penempatan','like','%dalam negeri%')->get();
        return view('manager/kandidat/dalam_negeri',compact('kandidat','manager'));
    }
    public function luarNegeri()
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $kandidat = Kandidat::where('penempatan','like',"%luar negeri%")->get();
        return view('manager/kandidat/luar_negeri',compact('kandidat','manager'));
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
}
