<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kandidat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Kelurahan;
use App\Models\Kecamatan;
use App\Models\Kota;
use App\Models\Provinsi;
use App\Models\Negara;
use App\Models\Pekerjaan;
use App\Models\NotifyKandidat;
use App\Models\Pembayaran;
use App\Models\Perusahaan;
use App\Models\PengalamanKerja;
use App\Models\ContactUs;
use App\Models\MessageKandidat;
use Illuminate\Support\Facades\Storage;

class KandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $notif = NotifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->get();
        $pesan = Kandidat::join(
            'message_kandidat', 'kandidat.id_kandidat','=','message_kandidat.id_kandidat'
        )
        ->where('kandidat.id_kandidat',$kandidat->id_kandidat)
        ->limit(3)->get();
        $perusahaan = Perusahaan::limit(2)->get();
        $pembayaran = Pembayaran::where('id_kandidat',$kandidat->id_kandidat)->first();
        if ($kandidat->penempatan == null) {
            return redirect('/isi_kandidat_personal')->with('toast_warning','Harap Lengkapi Data Personal Dahulu');
        } elseif($kandidat->nik == null) {
            return redirect('/isi_kandidat_document')->with('toast_warning','Harap Isi Data Document Dahulu');
        } elseif($kandidat->negara_id == null) {
            return redirect('/isi_kandidat_placement')->with('toast_warning','Harap Tentukan negara Tujuan Kerja');
        } else {
        return view('kandidat/index',compact('kandidat','notif','perusahaan','pembayaran','pesan'));
        }
    }
    
    public function profil()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $negara = Negara::join(
            'kandidat', 'ref_negara.negara_id','=','kandidat.negara_id'
        )
        ->where('referral_code',$id->referral_code)
        ->first();
        $usia = Carbon::parse($kandidat->tgl_lahir)->age;
        $pembayaran = Pembayaran::where('id_kandidat',$kandidat->id_kandidat)->first();
        $tgl_user = Carbon::create($kandidat->tgl_lahir)->isoFormat('D MMM Y');
        if ($kandidat->periode_awal1 !== null) {
            $periode_awal1 = Carbon::create($kandidat->periode_awal1)->isoFormat('D MMM Y');
            $periode_akhir1 = Carbon::create($kandidat->periode_akhir1)->isoFormat('D MMM Y');
        } else {
            $periode_awal1 = null;
            $periode_akhir1 = null;
        }
        if ($kandidat->periode_awal2 !== null) {
            $periode_awal2 = Carbon::create($kandidat->periode_awal2)->isoFormat('D MMM Y');
            $periode_akhir2 = Carbon::create($kandidat->periode_akhir2)->isoFormat('D MMM Y');
        } else {
            $periode_awal2 = null;
            $periode_akhir2 = null;
        }
        if ($kandidat->periode_awal3 !== null){
            $periode_awal3 = Carbon::create($kandidat->periode_awal3)->isoFormat('D MMM Y');
            $periode_akhir3 = Carbon::create($kandidat->periode_akhir3)->isoFormat('D MMM Y');    
        } else {
            $periode_awal3 = null;
            $periode_akhir3 = null;
        }
        $notif = NotifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->get();
        $pesan = Kandidat::join(
            'message_kandidat', 'kandidat.id_kandidat','=','message_kandidat.id_kandidat'
        )
        ->where('kandidat.id_kandidat',$kandidat->id_kandidat)
        ->limit(3)->get();
        if(Auth::user()->type == 3){
            return redirect('/manager');
        } elseif(Auth::user()->type == 2) {
            return redirect('/perusahaan');
        } elseif(Auth::user()->type == 1) {
            return redirect('/akademi');
        } else {
            // if ($kandidat->penempatan == null) {
            //     return redirect('/isi_kandidat_personal')->with('toast_warning','Harap Lengkapi Data Personal Dahulu');
            // } elseif($kandidat->nik == null) {
            //     return redirect('/isi_kandidat_document')->with('toast_warning','Harap Isi Data Document Dahulu');
            // } elseif($kandidat->negara_id == null) {
            //     return redirect('/isi_kandidat_placement')->with('toast_warning','Harap Tentukan negara Tujuan Kerja');
            // } else {
                return view('kandidat/profil_kandidat',compact(
                    'kandidat',
                    'negara',
                    'tgl_user',
                    'usia',
                    'notif',
                    'pesan',
                    'pembayaran',
                    'periode_awal1',
                    'periode_awal2',
                    'periode_awal3',
                    'periode_akhir1',
                    'periode_akhir2',
                    'periode_akhir3',
                ));
            // }
        }                   
    }

    public function edit()
    {
        return redirect()->route('personal');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function isi_kandidat_personal()
    {
        $timeNow = Carbon::now();
        $id = Auth::user();
        $user = User::where('id',$id->id)->first();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        return view('kandidat/isi_kandidat_personal',compact('timeNow','user','kandidat'));
    }

    public function simpan_kandidat_personal(Request $request)
    {
        $validated = $request->validate([
            'nama_panggilan' => 'required|max:10',
        ]);
        $usia = Carbon::parse($request->tgl_lahir)->age;
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        Kandidat::where('referral_code',$id->referral_code)->update([
            'nama' => $kandidat->nama,
            'nama_panggilan' => $request->nama_panggilan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'no_telp' => $id->no_telp,
            'agama' => $request->agama,
            'berat' => $request->berat,
            'tinggi' => $request->tinggi,
            'email' => $kandidat->email,
            'penempatan' => $request->penempatan,
            'usia'=> $usia,
        ]);
        if($kandidat->penempatan == "dalam negeri")
            {
                Kandidat::where('referral_code',$id->referral_code)->update([
                    'negara_id' => 2
                ]);
            } else {
                Kandidat::where('referral_code',$id->referral_code)->update([
                    'negara_id' => null,
                ]);
            }

        $userId = Kandidat::where('referral_code',$id->referral_code)->first();
        User::where('referral_code', $userId->referral_code)->update([
            'name' => $kandidat->nama,
            'no_telp' => $kandidat->no_telp,
            'email' => $kandidat->email
        ]);

        
        $pengalaman_kerja = PengalamanKerja::where('id_kandidat',$kandidat->id_kandidat)->first();
        if($pengalaman_kerja == null){
            PengalamanKerja::create([
                'id_kandidat' => $kandidat->id_kandidat,
                'pengalaman_kerja'=>"",
                'lama_kerja'=>"",
            ]);
        }
        

        return redirect('/isi_kandidat_document');
    }

    public function isi_kandidat_document()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code', $id->referral_code)->first();
        $kelurahan = Kelurahan::all();
        $kecamatan = Kecamatan::all();
        $kota = Kota::all();
        $provinsi = Provinsi::all();
        $negara = Negara::all();
        return view('Kandidat/isi_kandidat_document',compact('kandidat','kelurahan','kecamatan','kota','provinsi','negara'));
    }

    public function simpan_kandidat_document(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|max:16|min:16',
            'foto_ktp' => 'mimes:png,jpg,jpeg|max:2048',
            'foto_kk' => 'mimes:png,jpg,jpeg|max:2048',
            'foto_set_badan' => 'mimes:png,jpg,jpeg|max:2048',
            'foto_4x6' => 'mimes:png,jpg,jpeg|max:2048',
            'foto_ket_lahir' => 'mimes:png,jpg,jpeg|max:2048',
            'foto_ijazah' => 'mimes:png,jpg,jpeg|max:2048',
        ]);
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code', $id->referral_code)->first();  
        // cek foto ktp
        if($request->file('foto_ktp') !== null){
            $hapus_ktp = public_path('/gambar/Kandidat/'.$kandidat->nama.'/KTP/').$kandidat->foto_ktp;
            if(file_exists($hapus_ktp)){
                @unlink($hapus_ktp);
            }
            $ktp = $kandidat->nama.time().'.'.$request->foto_ktp->extension();  
            $request->foto_ktp->move(public_path('/gambar/Kandidat/'.$kandidat->nama.'/KTP'), $ktp);
            
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
            $request->foto_kk->move(public_path('/gambar/Kandidat/'.$kandidat->nama.'/KK'), $kk);
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
            $request->foto_set_badan->move(public_path('/gambar/Kandidat/'.$kandidat->nama.'/Set_badan'), $set_badan);
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
            $request->foto_4x6->move(public_path('/gambar/Kandidat/'.$kandidat->nama.'/4x6'), $foto_4x6);
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
            $request->foto_ket_lahir->move(public_path('/gambar/Kandidat/'.$kandidat->nama.'/Ket_lahir'), $ket_lahir);
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
            $request->foto_ijazah->move(public_path('/gambar/Kandidat/'.$kandidat->nama.'/Ijazah'), $ijazah);            
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

        Kandidat::where('referral_code',$id->referral_code)->update([
            'nik' => $request->nik,
            'pendidikan' => $request->pendidikan,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'dusun' => $request->dusun,
            'kelurahan' => $kelurahan->kelurahan,
            'kecamatan' => $kecamatan->kecamatan,
            'kabupaten' => $kota->kota,
            'provinsi' => $provinsi->provinsi,
            'stats_negara' => "Indonesia",
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
        if ($request->stats_nikah !== "Single") {
            return redirect()->route('family');
        } else {
            return redirect('/isi_kandidat_vaksin');

        }        
    }

    public function isi_kandidat_family()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        if ($kandidat->stats_nikah == null) {
            return redirect()->route('company');
        } elseif($kandidat->stats_nikah !== "Single") {
            return view('Kandidat/isi_kandidat_family',compact('kandidat'));    
        } else {
            return redirect('/isi_kandidat_vaksin');
        }
    }

    public function simpan_kandidat_family(Request $request)
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        // cek buku nikah
        if($request->file('foto_buku_nikah') !== null){
            $hapus_buku_nikah = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Buku Nikah/').$kandidat->foto_buku_nikah;
            if(file_exists($hapus_buku_nikah)){
                @unlink($hapus_buku_nikah);
            }
            $buku_nikah = $kandidat->nama.time().'.'.$request->foto_buku_nikah->extension();  
            $request->foto_buku_nikah->move(public_path('/gambar/Kandidat/'.$kandidat->nama.'/Buku Nikah'), $buku_nikah);
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
            $request->foto_cerai->move(public_path('/gambar/Kandidat/'.$kandidat->nama.'/Cerai'), $cerai);
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
            $request->foto_kematian_pasangan->move(public_path('/gambar/Kandidat/'.$kandidat->nama.'/Kematian Pasangan'), $kematian_pasangan);
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

        $id = Auth::user();
        Kandidat::where('referral_code', $id->referral_code)->update([
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
        return redirect('/isi_kandidat_vaksin');
    }

    public function isi_kandidat_vaksin()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code', $id->referral_code)->first(); 
        return view('Kandidat/isi_kandidat_vaksinasi',['kandidat'=>$kandidat]);
    }

    public function simpan_kandidat_vaksin(Request $request)
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        // cek vaksin1
        if($request->file('sertifikat_vaksin1') !== null){
            $hapus_sertifikat_vaksin1 = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Vaksin Pertama/').$kandidat->sertifikat_vaksin1;
            if(file_exists($hapus_sertifikat_vaksin1)){
                @unlink($hapus_sertifikat_vaksin1);
            }
            $sertifikat_vaksin1 = $kandidat->nama.time().'.'.$request->sertifikat_vaksin1->extension();  
            $request->sertifikat_vaksin1->move(public_path('/gambar/Kandidat/'.$kandidat->nama.'/Vaksin Pertama'), $sertifikat_vaksin1);
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
            $request->sertifikat_vaksin2->move(public_path('/gambar/Kandidat/'.$kandidat->nama.'/Vaksin Kedua'), $sertifikat_vaksin2);    
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
            $request->sertifikat_vaksin3->move(public_path('/gambar/Kandidat/'.$kandidat->nama.'/Vaksin Ketiga'), $sertifikat_vaksin3);
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

        $id = Auth::user();
        Kandidat::where('referral_code', $id->referral_code)->update([
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
        return redirect('/isi_kandidat_parent');
    }

    public function isi_kandidat_parent()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code', $id->referral_code)->first();
        return view('Kandidat/isi_kandidat_parent',['kandidat'=>$kandidat]);
    }

    public function simpan_kandidat_parent(Request $request)
    {
        $umurAyah = Carbon::parse($request->tgl_lahir_ayah)->age;
        $umurIbu = Carbon::parse($request->tgl_lahir_ibu)->age;
        // dd($umur);
        $id = Auth::user();
        Kandidat::where('referral_code', $id->referral_code)->update([
            'nama_ayah' => $request->nama_ayah,
            'umur_ayah' => $umurAyah,
            'tgl_lahir_ayah' => $request->tgl_lahir_ayah,
            'nama_ibu' => $request->nama_ibu,
            'umur_ibu' => $umurIbu,
            'tgl_lahir_ibu' => $request->tgl_lahir_ibu,
            'jml_sdr_lk' => $request->jml_sdr_lk,
            'jml_sdr_pr' => $request->jml_sdr_pr,
            'anak_ke' => $request->anak_ke
        ]);

        $ket = 1;
        if ($ket == $request->confirm) {
            return redirect('/isi_kandidat_company');
        } else {
            return redirect('/isi_kandidat_permission');
        }        
    }

    public function isi_kandidat_company()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code', $id->referral_code)->first();
        return view('Kandidat/isi_kandidat_company', ['kandidat'=>$kandidat]);
    }

    public function simpan_kandidat_company(Request $request)
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        // dd($request);
        //video1
        if($request->file('video_kerja1') !== null){
            $validated = $request->validate([
                'video_kerja1' => 'mimes:mp4,mov,ogg,qt | max:3000',
            ]);
            $hapus_video_kerja1 = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/Pengalaman kerja1/').$kandidat->video_kerja1;
            if(file_exists($hapus_video_kerja1)){
                @unlink($hapus_video_kerja1);
            }
            $video_kerja1 = $request->file('video_kerja1');
            $video_kerja1->move('gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/Pengalaman Kerja1',$kandidat->nama.$video_kerja1->getClientOriginalName());
            $simpan_kerja1 = $kandidat->nama.$video_kerja1->getClientOriginalName();
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
                'video_kerja2' => 'mimes:mp4,mov,ogg,qt | max:3000',
            ]);
            $hapus_video_kerja2 = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/Pengalaman kerja2/').$kandidat->video_kerja2;
            if(file_exists($hapus_video_kerja2)){
                @unlink($hapus_video_kerja2);
            }
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
                'video_kerja3' => 'mimes:mp4,mov,ogg,qt | max:3000',
            ]);
            $hapus_video_kerja3 = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/Pengalaman kerja3/').$kandidat->video_kerja3;
            if(file_exists($hapus_video_kerja3)){
                @unlink($hapus_video_kerja3);
            }
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

        $id = Auth::user();
        Kandidat::where('referral_code', $id->referral_code)->update([
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

        $periodeAwal1 = new \Datetime($request->periode_awal1);
        $periodeAkhir1 = new \DateTime($request->periode_akhir1);
        $periodeAwal2 = new \Datetime($request->periode_awal2);
        $periodeAkhir2 = new \DateTime($request->periode_akhir2);
        $periodeAwal3 = new \Datetime($request->periode_awal3);
        $periodeAkhir3 = new \DateTime($request->periode_akhir3);
        $tahun1 = $periodeAkhir1->diff($periodeAwal1)->y;
        $tahun2 = $periodeAkhir2->diff($periodeAwal2)->y;
        $tahun3 = $periodeAkhir3->diff($periodeAwal3)->y;
        $lama_kerja = $tahun1+$tahun2+$tahun3;

        PengalamanKerja::where('id_kandidat',$kandidat->id_kandidat)->update([
            'id_kandidat'=>$kandidat->id_kandidat,
            'pengalaman_kerja'=>$request->jabatan1.','.$request->jabatan2.','.$request->jabatan3,
            'lama_kerja'=>$lama_kerja
        ]);
        return redirect('/isi_kandidat_permission');
    }

    public function isi_kandidat_permission()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code', $id->referral_code)->first();
        $provinsi = Provinsi::all();
        $kota = Kota::all();
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();
        return view('Kandidat/isi_kandidat_permission',compact('kandidat','provinsi','kecamatan','kelurahan','kota'));
    }

    public function simpan_kandidat_permission(Request $request)
    {
        $validated = $request->validate([
            'nik_perizin' => 'required|max:16|min:16',
            'foto_ktp_izin' => 'mimes:png,jpg,jpeg|max:2048',
            'no_telp_perizin' => 'min:10|max:13'
        ]);
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
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
            $request->foto_ktp_izin->move(public_path('/gambar/Kandidat/'.$kandidat->nama.'/KTP Perizin'), $ktp_izin);
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

        Kandidat::where('referral_code', $id->referral_code)->update([
            'nama_perizin' => $request->nama_perizin,
            'nik_perizin' => $request->nik_perizin,
            'no_telp_perizin' => $request->no_telp_perizin,
            'tmp_lahir_perizin' => $request->tmp_lahir_perizin,
            'tgl_lahir_perizin' => $request->tgl_lahir_perizin,
            'alamat_perizin' => $request->alamat_perizin,
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

            return redirect()->route('paspor');
    }

    public function isi_kandidat_paspor()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        return view('kandidat/isi_kandidat_paspor',compact('kandidat'));
    }

    public function simpan_kandidat_paspor(Request $request)
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        if($request->file('foto_paspor') !== null){
            // $this->validate($request, [
            //     'foto_ktp_izin' => 'required|file|image|mimes:jpeg,png,jpg|max:1024',
            // ]);
            $hapus_paspor = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Paspor/').$kandidat->foto_paspor;
            if(file_exists($hapus_paspor)){
                @unlink($hapus_paspor);
            }
            $paspor = $kandidat->nama.time().'.'.$request->foto_paspor->extension();  
            $request->foto_paspor->move(public_path('/gambar/Kandidat/'.$kandidat->nama.'/Paspor'), $paspor);
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

        Kandidat::where('referral_code',$id->referral_code)->update([
            'no_paspor'=>$request->no_paspor,
            'tgl_terbit_paspor'=>$request->tgl_terbit_paspor,
            'tgl_akhir_paspor'=>$request->tgl_akhir_paspor,
            'tmp_paspor'=>$request->tmp_paspor,
            'foto_paspor'=>$foto_paspor,
        ]);
        if ($kandidat->penempatan == "luar negeri") {
            return redirect()->route('placement');
        } else {
            return redirect('/');
        }
    }

    public function isi_kandidat_placement()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code', $id->referral_code)->first();
        $negara = Negara::where('negara_id','not like',2)->get();
        if ($kandidat->penempatan == "luar negeri"){
            return view('Kandidat/isi_kandidat_placement',compact('negara','kandidat'));
        }
        return redirect('/');
    }

    public function simpan_kandidat_placement(Request $request)
    {
        $id = Auth::user();
        Kandidat::where('referral_code', $id->referral_code)->update([
            'negara_id' => $request->negara_id,
            'jabatan_kandidat' => $request->jabatan_kandidat,
            'kontrak' => $request->kontrak,
        ]);
        return redirect('/isi_kandidat_job');
    }

    public function isi_kandidat_job()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $umur = Carbon::parse($kandidat->tgl_lahir)->age;
            $pekerjaan = Pekerjaan::join(
                'ref_negara', 'pekerjaan.negara_id','=','ref_negara.negara_id'
            )
            ->where('pekerjaan.negara_id',$kandidat->negara_id)
            ->where('pekerjaan.syarat_umur','>=',$umur)
            ->get();
        return view('kandidat/isi_kandidat_job',compact('pekerjaan','kandidat'));
    }

    public function simpan_kandidat_job(Request $request)
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        Kandidat::where('referral_code',$id->referral_code)->update([
            'id_pekerjaan'=> $request->id_pekerjaan
        ]);
        return redirect('/');
    }

    public function contactUsKandidat()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $notif = NotifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->get();
        $pesan = Kandidat::join(
            'message_kandidat', 'kandidat.id_kandidat','=','message_kandidat.id_kandidat'
        )
        ->where('kandidat.id_kandidat',$kandidat->id_kandidat)
        ->limit(3)->get();
        $pembayaran = Pembayaran::where('id_kandidat',$kandidat->id_kandidat)->first();
        return view('kandidat/contact_us',compact('kandidat','notif','pembayaran','pesan'));
    }

    public function sendContactUsKandidat(Request $request)
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        ContactUs::create([
            'id_kandidat'=>$kandidat->id_kandidat,
            'isi_pesan_kandidat'=>$request->isi_pesan_kandidat,
        ]);
        return redirect('/kandidat')->with('toast_success','Pesan anda sudah terkirim, mohon tunggu pesan dari admin');
    }

    public function Perusahaan($id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $perusahaan = Perusahaan::where('id_perusahaan',$id)->first();
        $notif = NotifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->get();
        $pesan = Kandidat::join(
            'message_kandidat', 'kandidat.id_kandidat','=','message_kandidat.id_kandidat'
        )
        ->where('kandidat.id_kandidat',$kandidat->id_kandidat)
        ->limit(3)->get();
        $pembayaran = Pembayaran::where('id_kandidat',$kandidat->id_kandidat)->first();
        return view('kandidat/profil_perusahaan',compact('kandidat','perusahaan','notif','pembayaran','pesan'));
    }
}
