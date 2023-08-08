<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Kandidat;
use App\Models\Pembayaran;
use App\Models\Akademi;
use App\Models\Negara;
use App\Models\Kelurahan;
use App\Models\Kecamatan;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\PengalamanKerja;
use App\Models\Pekerjaan;
use App\Models\Notification;
use App\Models\Perusahaan;
use App\Models\Interview;
use App\Models\notifyKandidat;
use App\Models\notifyAkademi;
use App\Models\notifyPerusahaan;
use App\Models\messageKandidat;
use App\Models\messageAkademi;
use App\Models\messagePerusahaan;
use App\Models\TemaPelatihan;
use App\Models\Pelatihan;
use App\Models\ContactUs;
use App\Models\PencarianStaff;
use App\Models\PerusahaanStaff;
use Carbon\Carbon;
use App\Models\LowonganPekerjaan;
use App\Models\PMIID;
use DB;
use App\Models\VideoKerja;
use App\Models\FotoKerja;
use Illuminate\Support\Facades\Mail;
use App\Mail\Payment;

class ManagerController extends Controller
{
    public function login()
    {
        return view('manager/manager_access');
    }

    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            'kode' => 'required',
        ]);
        $data = User::where(['email'=>$request->email, 'password'=>$request->password, 'referral_code'=>$request->kode])->first();
        if($data == null){
            return redirect()->back()->with('error',"maaf Email atau Password anda salah");
        } else {
            if($data->type == 3){
                $user = User::where('type',3)->first();
                Auth::login($user);
                return redirect()->route('manager');
            } elseif($data->type == 4) {
                $user = User::where('type',4)->first();
                Auth::login($user);
                return redirect()->route('cs');
            } else {
                return redirect()->back()->with('error', 'Email atau no telp salah');
            }
        }   
    }

    public function index()
    {
        $id = Auth::user();
        $manager = User::where('referral_code',$id->referral_code)->where('type','like',3)->first();

        $semua_kandidat = User::where('type',0)->count();
        $semua_akademi = User::where('type',1)->count();
        $semua_perusahaan = User::where('type',2)->count();
        
        $data = date('Y-m-d');
        $kandidat_baru = User::where('created_at','like','%'.$data.'%')->where('type',0)->get();
        $ttl_baru_kandidat = $kandidat_baru->count();
        $login_kandidat = User::where('updated_at','like','%'.$data.'%')->where('type',0)->get();
        $total_kandidat = $login_kandidat->count();
        
        $akademi_baru = User::where('created_at','like','%'.$data.'%')->where('type',1)->get();
        $ttl_baru_akademi = $akademi_baru->count();
        $login_akademi = User::where('updated_at','like','%'.$data.'%')->where('type',1)->get();
        $total_akademi = $login_akademi->count();        
        $akademi_list = Akademi::limit(10)->get();

        $perusahaan_baru = User::where('created_at','like','%'.$data.'%')->where('type',2)->get();
        $ttl_baru_perusahaan = $perusahaan_baru->count();
        $login_perusahaan = User::where('updated_at','like','%'.$data.'%')->where('type',2)->get();
        $total_perusahaan = $login_perusahaan->count();                
        $perusahaan_list = Perusahaan::limit(10)->get();

        $negara_tujuan = Negara::all();
        $kandidat = Kandidat::all();

        return view('manager/manager_home',compact(
            'manager','data','negara_tujuan','kandidat',
            'login_kandidat','total_kandidat','semua_kandidat','kandidat_baru','ttl_baru_kandidat',

            'login_akademi','total_akademi','semua_akademi','akademi_baru','ttl_baru_akademi',
            'akademi_list',
            'login_perusahaan','total_perusahaan','semua_perusahaan','perusahaan_baru','ttl_baru_perusahaan',
            'perusahaan_list',
        ));
    }

    public function suratIzin()
    {
        $id = Auth::user();
        $manager = User::where('referral_code',$id->referral_code)->first();
        $suratIzin = Kandidat::all();
        return view('/manager/kandidat/surat_izin',compact('manager','suratIzin'));
    }

    public function buatSuratIzin()
    {
        $id = Auth::user();
        $manager = User::where('referral_code',$id->referral_code)->first();
        $negara = Negara::all();
        return view('manager/kandidat/buat_surat_izin',compact('manager','negara'));
    }

    public function simpanSuratIzin(Request $request)
    {
        $validated = $request->validate([
            'no_telp' => 'unique:users',
            'nik' => 'unique:kandidat',
            'email' => 'unique:users',
        ]);
        // dd($request);
        $provinsi = Provinsi::where('id',$request->provinsi_id)->first('provinsi');
        $kota = Kota::where('id',$request->kota_id)->first();
        $kecamatan = Kecamatan::where('id',$request->kecamatan_id)->first();
        $kelurahan = kelurahan::where('id',$request->kelurahan_id)->first();
        
        $provinsiPerizin = Provinsi::where('id',$request->provinsi_perizin)->first();
        $kotaPerizin = Kota::where('id',$request->kota_perizin)->first();
        $kecamatanPerizin = Kecamatan::where('id',$request->kecamatan_perizin)->first();
        $kelurahanPerizin = Kelurahan::where('id',$request->kelurahan_perizin)->first();
        
        $password = Hash::make($request->nama);

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'password' => $password,
            'check_password' => $request->nama
        ]);

        $id = $user->id;
        $userId = \Hashids::encode($id.$request->no_telp);

        User::where('id',$id)->update([
            'referral_code' => $userId
        ]);

        if($request->negara_id !== 2){
            $penempatan = "luar negeri";
        } else {
            $penempatan = "dalam negeri";
        }

        $kandidat = Kandidat::create([
            'id' => $id,
            'stats_nikah'=>$request->stats_nikah,
            'nama' => $request->nama,
            'referral_code' => $userId,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'nama_panggilan'=>$request->nama_panggilan,
            'jenis_kelamin'=>$request->jk,
            'tmp_lahir'=>$request->tmp_lahir,
            'tgl_lahir'=>$request->tgl_lahir,
            'agama'=>$request->agama,
            'negara_id'=>$request->negara_id,
            'nik'=>$request->nik,
            'provinsi'=>$provinsi->provinsi,
            'kabupaten'=>$kota->kota,
            'kecamatan'=>$kecamatan->kecamatan,
            'kelurahan'=>$kelurahan->kelurahan,
            'dusun'=>$request->dusun,
            'rt'=>$request->rt,
            'rw'=>$request->rw,
            'nama_perizin'=>$request->nama_perizin,
            'nik_perizin'=>$request->nik_perizin,
            'no_telp_perizin'=>$request->no_telp_perizin,
            'tmp_lahir_perizin'=>$request->tmp_lahir_perizin,
            'tgl_lahir_perizin'=>$request->tgl_lahir_perizin,
            'provinsi_perizin'=>$provinsiPerizin->provinsi,
            'kabupaten_perizin'=>$kotaPerizin->kota,
            'kecamatan_perizin'=>$kecamatanPerizin->kecamatan,
            'kelurahan_perizin'=>$kelurahanPerizin->kelurahan,
            'dusun_perizin'=>$request->dusun_perizin,
            'rt_perizin'=>$request->rt_perizin,
            'rw_perizin'=>$request->rw_perizin,
            'hubungan_perizin'=>$request->hubungan_perizin,
            'negara_perizin'=>"Indonesia",
            'penempatan'=>$penempatan,
        ]);

        // dd($kandidat);
        // $pengalaman_kerja = PengalamanKerja::where('id_kandidat',$kandidat->id_kandidat)->first();
        // if($pengalaman_kerja == null){
        //     PengalamanKerja::create([
        //         'id_kandidat' => $kandidat->id_kandidat,
        //         'pengalaman_kerja'=>"",
        //         'lama_kerja'=>"",
        //     ]);
        // }
        return redirect('/manager/surat_izin')->with('success', 'Data berhasil ditambahkan');
    }

    public function cetakSurat($id)
    {
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        $tgl_print = Carbon::now()->isoFormat('D MMM Y');
        if ($kandidat->negara == "loc") {
            $negara = "Indonesia";
        }
        $negara = Negara::where('negara_id',$kandidat->negara_id)->first();
        $perusahaan = Perusahaan::where('id_perusahaan',$kandidat->id_perusahaan)->first();
        $tgl_user = Carbon::create($kandidat->tgl_lahir)->isoFormat('D MMM Y');
        $tgl_perizin = Carbon::create($kandidat->tgl_lahir_perizin)->isoFormat('D MMM Y');
        if($kandidat->negara_id == null){
            return redirect('/manager/edit/kandidat/placement/'.$kandidat->id_kandidat);
        }
        return view('manager/kandidat/cetak_surat', compact(
            'kandidat',
            'tgl_print',
            'tgl_user',
            'tgl_perizin',
            'negara','perusahaan',
        ));
    }

    public function cetakSuratKosong()
    {
        
        $tgl_print = Carbon::now()->isoFormat('D MMM Y');
        // $tgl_user = Carbon::create($kandidat->tgl_lahir)->isoFormat('D MMM Y');
        // $tgl_perizin = Carbon::create($kandidat->tgl_lahir_perizin)->isoFormat('D MMM Y');
        return view('manager/kandidat/surat_izin_waris', compact(
            // 'kandidat',
            'tgl_print',
            // 'tgl_user',
            // 'tgl_perizin',
        ));
    }

    public function barcode()
    {
        return view('barcode');
    }

    public function lihatProfil($id)
    {
        $manager = Auth::user();
        $negara = Negara::join(
            'kandidat','ref_negara.negara_id','=','kandidat.negara_id'
        )->first();
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        $tgl_user = Carbon::create($kandidat->tgl_lahir)->isoFormat('D MMM Y');
        $usia = Carbon::parse($kandidat->tgl_lahir)->age;
        $pengalaman_kerja = PengalamanKerja::where('id_kandidat',$id)->get();
        if($kandidat->negara_id == null){
            Kandidat::where('id_kandidat',$id)->update([
                'penempatan' => "dalam negeri",
                'negara_id' => 2,
            ]);
        }
        return view('manager/kandidat/lihat_profil',compact(
            'kandidat',
            'negara',
            'tgl_user',
            'usia',
            'manager',
            'pengalaman_kerja',
        ));
    }

    public function galeriKandidat($id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $pengalaman = PengalamanKerja::where('pengalaman_kerja_id',$id)->first();
        $video = VideoKerja::where('pengalaman_kerja_id',$pengalaman->pengalaman_kerja_id)->get();
        $foto = FotoKerja::where('pengalaman_kerja_id',$pengalaman->pengalaman_kerja_id)->get();
        return view('manager/kandidat/galeri_kandidat',compact('manager','pengalaman','foto','video'));
    }

    public function lihatGaleriKandidat($id, $type)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        if($type == "video"){
            $video = VideoKerja::where('video_kerja_id',$id)->first();
            $video_pengalaman = VideoKerja::where('pengalaman_kerja_id',$video->pengalaman_kerja_id)->get();
            $foto_pengalaman = FotoKerja::where('pengalaman_kerja_id',$video->pengalaman_kerja_id)->get();
            $pengalaman = PengalamanKerja::where('pengalaman_kerja_id',$video->pengalaman_kerja_id)->first();
            return view('manager/kandidat/lihat_galeri_kandidat',compact('manager','type','id','video_pengalaman','video','foto_pengalaman','pengalaman'));
        } elseif($type == "foto") {
            $foto = FotoKerja::where('foto_kerja_id',$id)->first();
            $foto_pengalaman = FotoKerja::where('pengalaman_kerja_id',$foto->pengalaman_kerja_id)->get();
            $video_pengalaman = VideoKerja::where('pengalaman_kerja_id',$foto->pengalaman_kerja_id)->get();
            $pengalaman = PengalamanKerja::where('pengalaman_kerja_id',$foto->pengalaman_kerja_id)->first();
            return view('manager/kandidat/lihat_galeri_kandidat',compact('manager','type','id','foto_pengalaman','foto','video_pengalaman','pengalaman'));
        }
    }

    // Perusahaan Data //
    public function perusahaan()
    {
        $id = Auth::user();
        $manager = User::where('referral_code',$id->referral_code)->where('type',3)->first();
        $perusahaan = Perusahaan::all();
        return view('manager/perusahaan/list_perusahaan',compact('manager','perusahaan'));
    }

    public function lihatProfilPerusahaan($id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $perusahaan = Perusahaan::where('id_perusahaan',$id)->first();
        $lowongan = LowonganPekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $kandidat = Kandidat::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        return view('manager/perusahaan/lihat_profil_perusahaan',compact('perusahaan','manager','lowongan','kandidat'));
    }

    public function lihatLowonganPekerjaan($id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->first();
        $perusahaan = Perusahaan::where('id_perusahaan',$lowongan->id_perusahaan)->first();
        return view('manager/perusahaan/lihat_lowongan',compact('lowongan','manager','perusahaan'));
    }

    public function IDPMI()
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $kandidat = Kandidat::all();
        $id_kandidat = null;
        $pmi_id = PMIID::join(
            'kandidat','perusahaan_kebutuhan.id_kandidat','=','kandidat.id_kandidat'
        )->join(
            'perusahaan','perusahaan_kebutuhan.id_perusahaan','=','perusahaan.id_perusahaan'
        )
        ->get();
        return view('manager/perusahaan/listIDPMI',compact('manager','kandidat','id_kandidat','pmi_id'));
    }

    public function buatIDPMI(Request $request)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $kandidat = Kandidat::all();
        $id_kandidat = Kandidat::where('id_kandidat',$request->id_kandidat)->first();
        $tgl = Carbon::create($id_kandidat->tgl_lahir)->isoformat('d MMM Y');
        $negara = Negara::all();
        $perusahaan = Perusahaan::all();
        $pmi_id = PMIID::join(
            'kandidat','perusahaan_kebutuhan.id_kandidat','=','kandidat.id_kandidat'
        )->join(
            'perusahaan','perusahaan_kebutuhan.id_perusahaan','=','perusahaan.id_perusahaan'
        )
        ->get();
        return view('manager/perusahaan/listIDPMI',compact('manager','kandidat','id_kandidat','tgl','negara','perusahaan','pmi_id'));
    }

    public function simpanIDPMI(Request $request)
    {
        // $perusahaan
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        PMIID::create([
            'isi' => $request->isi,
            'agency' => $request->agency,
            'jabatan' => $request->jabatan,
            'sektor_usaha' => $request->sektor_usaha,
            'nominal' => $request->nominal,
            'berlaku' => $request->berlaku,
            'habis_berlaku' => $request->habis_berlaku,
            'id_perusahaan' => $request->id_perusahaan,
            'id_kandidat' => $request->id_kandidat,
            'negara_id' => $request->negara_id,
        ]);
        Kandidat::where('id_kandidat',$request->id_kandidat)->update([
            'negara_id' => $request->negara_id,
        ]);
        return redirect('/manager/perusahaan/pembuatan_id_pmi');
    }

    public function lihatIDPMI($id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $pmi_id = PMIID::join(
            'kandidat','perusahaan_kebutuhan.id_kandidat','=','kandidat.id_kandidat'
        )->join(
            'perusahaan','perusahaan_kebutuhan.id_perusahaan','=','perusahaan.id_perusahaan'
        )->join(
            'ref_negara', 'kandidat.negara_id','=','ref_negara.negara_id'
        )
        ->where('perusahaan_kebutuhan.pmi_id',$id)->first();
        $berlaku = Carbon::create($pmi_id->berlaku)->isoformat('d MMM Y');
        $habis_berlaku = Carbon::create($pmi_id->habis_berlaku)->isoformat('d MMM Y');
        return view('manager/perusahaan/lihat_PMIID',compact('manager','pmi_id','berlaku','habis_berlaku'));
    }

    // Akademi Data //
    public function akademi()
    {
        $id = Auth::user();
        $manager = User::where('referral_code',$id->referral_code)->where('type',3)->first();
        $akademi = Akademi::all();
        return view('manager/akademi/list_akademi',compact('manager','akademi'));
    }

    public function lihatProfilAkademi($id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $akademi = Akademi::where('id_akademi',$id)->first();
        $kandidat = Kandidat::where('id_akademi',$akademi->id_akademi)->get();
        return view('manager/akademi/lihat_profil_akademi',compact('akademi','manager','kandidat'));
    }

    public function pelatihan()
    {
        $auth = Auth::user();
        $manager = User::where('referral_code',$auth->referral_code)->first();      
        $pelatihan = TemaPelatihan::all();
        return view('manager/kandidat/pelatihan',compact('manager','pelatihan'));
    }

    public function tambahTemaPelatihan()
    {
        $auth = Auth::user();
        $manager = User::where('referral_code',$auth->referral_code)->first();
        return view('manager/kandidat/tambah_tema_pelatihan',compact('manager'));
    }

    public function simpanTemaPelatihan(Request $request)
    {
        $auth = Auth::user();
        $manager = User::where('referral_code',$auth->referral_code)->first();        
        TemaPelatihan::create([
            'tema_pelatihan' => $request->tema,
        ]);
        return redirect('/manager/kandidat/pelatihan')->with('success',"Tema pelatihan ditambahkan");
    }

    public function lihatVideoPelatihan($id)
    {
        $auth = Auth::user();
        $manager = User::where('referral_code',$auth->referral_code)->first();        
        $pelatihan = TemaPelatihan::where('tema_pelatihan_id',$id)->first();
        $video = Pelatihan::where('tema',$pelatihan->tema_pelatihan)->get();
        return view('manager/kandidat/video_pelatihan',compact('manager','pelatihan','video'));
    }

    public function editTemaPelatihan($id)
    {
        $auth = Auth::user();
        $manager = User::where('referral_code',$auth->referral_code)->first();
        $pelatihan = TemaPelatihan::where('tema_pelatihan_id',$id)->first();
        $video = Pelatihan::where('tema',$pelatihan->tema_pelatihan)->get();
        return view('manager/kandidat/edit_tema_pelatihan',compact('manager','pelatihan','video'));
    }

    public function updateTemaPelatihan(Request $request,$id)
    {
        $auth = Auth::user();
        $manager = User::where('referral_code',$auth->referral_code)->first();
        TemaPelatihan::where('tema_pelatihan_id',$id)->update([
            'tema_pelatihan'=>$request->tema,
        ]);
        Pelatihan::where('tema_pelatihan_id',$id)->update([
            'tema_pelatihan_id'=>$id,
            'tema'=>$request->tema,
        ]);
        return redirect('/manager/kandidat/pelatihan')->with('success',"Tema berhasil diubah");
    }

    public function hapusTemaPelatihan($id)
    {
        $hapus = Pelatihan::where('tema_pelatihan_id',$id)->first();
        $file = public_path('/gambar/Manager/Pelatihan/'.$hapus->judul.'/Thumbnail/').$hapus->thumbnail;
        if(file_exists($file)){
            @unlink($file);
        }
        $hapus_video = public_path('/gambar/Manager/Pelatihan/'.$hapus->judul.'/Video/').$hapus->video;
            if(file_exists($hapus_video)){
                @unlink($hapus_video);
            }
        $auth = Auth::user();
        $manager = User::where('referral_code',$auth->referral_code)->first();
        TemaPelatihan::where('tema_pelatihan_id',$id)->delete();
        Pelatihan::where('tema_pelatihan_id',$id)->delete();
        return redirect('/manager/kandidat/pelatihan')->with('success',"Tema berhasil dihapus");
    }

    public function tambahVideoPelatihan($tema,$id)
    {
        $auth = Auth::user();
        $manager = User::where('referral_code',$auth->referral_code)->first();
        $negara = Negara::all();
        $pelatihan = TemaPelatihan::where('tema_pelatihan',$tema)->where('tema_pelatihan_id',$id)->first();
        return view('manager/kandidat/tambah_pelatihan',compact('manager','negara','pelatihan'));
    }

    public function simpanVideoPelatihan(Request $request,$tema,$id)
    {
        $auth = Auth::user();
        $manager = User::where('referral_code',$auth->referral_code)->first();
        
        // THUMBNAIL //
        if($request->file('thumbnail') !== null){
            $thumbnail = $request->judul.time().'.'.$request->thumbnail->extension();  
            $request->thumbnail->move(public_path('/gambar/Manager/Pelatihan/'.$request->judul.'/Thumbnail/'), $thumbnail);
        } else {
            $thumbnail = null;
        }

        // VIDEO PELATIHAN //
        $validated = $request->validate([
            'video' => 'mimes:mp4,mov,ogg,qt',
        ]);
        $video = $request->file('video');
        $video->move('gambar/Manager/Pelatihan/'.$request->judul.'/Video/',$request->judul.$video->getClientOriginalName());
        $simpanVideo = $request->judul.$video->getClientOriginalName();
        
        Pelatihan::create([
            'judul'=>$request->judul,
            'video'=>$simpanVideo,
            'deskripsi'=>$request->deskripsi,
            'thumbnail'=>$thumbnail,
            'url'=>$request->url,
            'negara_id'=>$request->negara_id,
            'tema'=>$tema,
            'tema_pelatihan_id'=>$id,
        ]);
        return redirect('/manager/kandidat/lihat_video_pelatihan/'.$id);
    }

    public function editVideoPelatihan($tema,$id)
    {
        $auth = Auth::user();
        $manager = User::where('referral_code',$auth->referral_code)->first();
        $pelatihan = Pelatihan::where('tema',$tema)->where('id',$id)->first();
        $negara = Negara::all();
        return view('manager/kandidat/edit_pelatihan',compact('pelatihan','manager','negara'));
    }

    public function updateVideoPelatihan(Request $request,$tema,$id)
    {
        $auth = Auth::user();
        $manager = User::where('referral_code',$auth->referral_code)->first();
        $pelatihan = Pelatihan::where('tema',$tema)->where('id',$id)->first();
        
        // THUMBNAIL //
        if ($request->file('thumbnail') !== null) {    
            $hapus_thumbnail = public_path('/gambar/Manager/Pelatihan/'.$pelatihan->judul.'/Thumbnail/').$pelatihan->thumbnail;
            if(file_exists($hapus_thumbnail)){
                @unlink($hapus_thumbnail);
            }
            $thumbnail = $request->judul.time().'.'.$request->thumbnail->extension();  
            $request->thumbnail->move(public_path('/gambar/Manager/Pelatihan/'.$request->judul.'/Thumbnail/'), $thumbnail);
        } else {
            if ($pelatihan->thumbnail !== null) {
                $thumbnail = $pelatihan->thumbnail;
            } else {
                $thumbnail = null;
            }
        }

        // VIDEO PELATIHAN //
        if($request->file('video') !== null){
            $validated = $request->validate([
                'video' => 'mimes:mp4,mov,ogg,qt | max:3000',
            ]);
            $hapus_video = public_path('/gambar/Manager/Pelatihan/'.$pelatihan->judul.'/Video/').$pelatihan->video;
            if(file_exists($hapus_video)){
                @unlink($hapus_video);
            }
            $video = $request->file('video');
            $video->move('gambar/Manager/Pelatihan/'.$request->judul.'/Video/',$request->judul.time().'.'.$video->getClientOriginalName());
            $simpan_video = $request->judul.time().'.'.$video->getClientOriginalName();
        } else {
            if($pelatihan->video !== null){
                $simpan_video = $pelatihan->video;
            } else {
                $simpan_video = null;
            }
        }
        
        // Cek thumbnail //
        if($thumbnail !== null){
            $thumbnailPelatihan = $thumbnail;
        } else {
            $thumbnailPelatihan = null;
        }
        // Cek video //
        if($simpan_video !== null){
            $videoPelatihan = $simpan_video;
        } else {
            $videoPelatihan = null;
        }
        Pelatihan::where('id',$id)->update([
            'judul'=>$request->judul,
            'video'=>$videoPelatihan,
            'deskripsi'=>$request->deskripsi,
            'thumbnail'=>$thumbnailPelatihan,
            'url'=>$request->url,
            'negara_id'=>$request->negara_id,
        ]);
        return redirect('/manager/kandidat/pelatihan');
    }

    public function hapusVideoPelatihan($temaid,$id)
    {
        $hapus = Pelatihan::findorfail($id);
        $file = public_path('/gambar/Manager/Pelatihan/'.$hapus->judul.'/Thumbnail/').$hapus->thumbnail;
        if(file_exists($file)){
            @unlink($file);
        }
        Pelatihan::where('id',$id)->delete();
        return redirect('/manager/kandidat/lihat_video_pelatihan/'.$temaid);
    }

    public function permohonanStaff()
    {
        $id = Auth::user();
        $manager = User::where('type',3)->first();
        $permohonan = PencarianStaff::join(
            'perusahaan', 'pencarian_staff.id_perusahaan','=','perusahaan.id_perusahaan',
        )->get();
        return view('manager/kandidat/permohonan_staff',compact('manager','permohonan'));
    }

    public function lihatPermohonanStaff($id)
    {
        $user = Auth::user();
        $manager = User::where('type',3)->first();
        $permohonan = PencarianStaff::where('pencarian_staff_id',$id)->first();
        $staff = Kandidat::where('penempatan','like',"dalam negeri")->get();
        return view('manager/kandidat/lihat_permohonan_staff',compact('manager','permohonan','staff'));
    }

    public function simpanPermohonanStaff($id)
    {
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        dd($kandidat);
        return redirect('/perusahaan/permohonan_pencarian_staff')->with('success',"Staff Terkirim");
    }

    public function pilihPermohonanStaff()
    {
        return view();
    }

    public function kirimPermohonanStaff()
    {
        return redirect();
    }
    
    // Pembayaran Data //
    public function pembayaranKandidat()
    {
        $id = Auth::user();
        $manager = User::where('referral_code',$id->referral_code)->first();
        $pembayaran = Pembayaran::join(
            'kandidat','pembayaran.id_kandidat','=','kandidat.id_kandidat'
        )
        ->where('stats_pembayaran',"belum dibayar")->get();
        return view('manager/kandidat/pembayaran',compact('manager','pembayaran'));
    }

    public function cekPembayaranKandidat($id){
        $manager = Auth::user();
        $pembayaran = Pembayaran::where('id_pembayaran',$id)->first();
        return view('manager/kandidat/cek_pembayaran',compact('manager','pembayaran'));
    }

    public function cekConfirmKandidat($id)
    {
        Pembayaran::where('id_pembayaran',$id)->update([
            'stats_pembayaran'=>"sudah dibayar"
        ]);
        return redirect('manager/pembayaran/kandidat');
    }

    public function pembayaranPerusahaan()
    {
        $id = Auth::user();
        $manager = User::where('referral_code',$id->referral_code)->first();
        $pembayaran = Pembayaran::join(
            'perusahaan', 'pembayaran.id_perusahaan','=','perusahaan.id_perusahaan'
        )
        ->where('pembayaran.stats_pembayaran',"belum dibayar")->get();
        return view('manager/perusahaan/pembayaran',compact('manager','pembayaran'));
    }

    public function cekPembayaranPerusahaan($id)
    {
        $auth = Auth::user();
        $manager = User::where('referral_code',$auth->referral_code)->first();
        $pembayaran = Pembayaran::join(
            'perusahaan', 'pembayaran.id_perusahaan','=','perusahaan.id_perusahaan'
        )
        ->where('pembayaran.id_pembayaran',$id)->first();
        $interview = Interview::join(
            'kandidat', 'interview.id_kandidat','=','kandidat.id_kandidat'
        )
        ->where('interview.id_perusahaan',$pembayaran->id_perusahaan)->get();
        return view('manager/perusahaan/cek_pembayaran',compact('manager','pembayaran','interview'));
    }

    public function cekConfirmPerusahaan(Request $request, $id)
    {
        // dd($request);
        $id_kandidat = $request->id_kandidat;
        $id_perusahaan = $request->id_perusahaan;
        $id_interview = $request->id_interview;
        $nama = $request->nama;
        $auth = Auth::user();
        $manager = User::where('type',3)->first();
        $perusahaan = Perusahaan::join(
            'pembayaran','perusahaan.id_perusahaan','=','pembayaran.id_perusahaan'
        )
        ->where('pembayaran.id_pembayaran',$id)->first();
           
        // sudah dibayar //
        $pembayaran = Pembayaran::where('id_pembayaran',$id)->update([
            'stats_pembayaran'=>$request->stats_pembayaran
        ]);
        $interview = Interview::join(
            'kandidat', 'interview.id_kandidat','=','kandidat.id_kandidat'
        )
        ->where('interview.id_perusahaan',$pembayaran->id_perusahaan)->get();
        foreach($interview as $item){
            $id_kandidat = $item->id_kandidat;
            $id_perusahaan = $item->id_perusahaan;
            $id_interview = $item->id_interview;
            $nama = $item->nama;
        }

        if($request->stats_pembayaran == "sudah dibayar"){
            // notifikasi kepada perusahaan //
            // $notifyCompany = Notification::create([
            //     'pengirim_notifikasi'=>"Admin",
            //     'isi'=>"Selamat pembayaran anda telah selesai",
            //     'id_perusahaan'=>$perusahaan->id_perusahaan,
            // ]);

            // notifikasi kepada kandidat //
            for($n = 0; $n < count($id_kandidat); $n++){
                $data1['id_kandidat'] = $id_kandidat[$n];
                $data1['id_perusahaan'] = $id_perusahaan;
                $data1['isi'] = "anda mendapat pesan dari perusahaan";
                $data1['pengirim_notifikasi'] = "Admin";
                $data1['id_interview'] = $id_interview[$n];
                notifyKandidat::create($data1);
            }

            // pesan kepada kandidat //
            for($m = 0; $m < count($id_kandidat); $m++){
                $data2['id_kandidat'] = $id_kandidat[$m];
                $data2['id_perusahaan'] = $id_perusahaan;
                $data2['pesan'] = "Anda mendapat undangan interview. Apakah anda menyetujuinya?";
                $data2['pengirim'] = "Admin";
                $data2['kepada'] = $nama[$m];
                $data2['id_interview'] = $id_interview[$m];
                messageKandidat::create($data2);
            }
            return redirect('/manager/pembayaran/perusahaan')->with('toast_success',"pembayaran telah selesai");    
        } else {
            return redirect('/manager/pembayaran/perusahaan');
        }
        
    }

    public function riwayatKandidat()
    {
        $id = Auth::user();
        $manager = User::where('referral_code',$id->referral_code)->first();
        $pembayaran = Pembayaran::where('stats_pembayaran',"sudah dibayar")->where('type','like',0)->get();
        return view('manager/riwayat_pembayaran_kandidat',compact('manager','pembayaran'));
    }

    public function riwayatPerusahaan()
    {
        $id = Auth::user();
        $manager = User::where('referral_code',$id->referral_code)->first();
        $pembayaran = Pembayaran::where('stats_pembayaran',"sudah dibayar")->where('type','like',2)->get();
        return view('manager/riwayat_pembayaran_perusahaan',compact('manager','pembayaran'));        
    }

    public function searchEmail()
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $pengguna = User::all();
        return view('manager/email_verify',compact('manager','pengguna'));        
    }

    public function emailVerify($id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $pengguna = User::where('id',$id)->first();
        return view('manager/send_email',compact('manager','pengguna'));
    }    

    public function sendEmailVerify(Request $request, $id)
    {
        $pengguna = User::where('email',$request->email)->first();
        if($request->type == 0){
            if($pengguna->type == 2){
                Mail::send('mail.mail', ['token' => $pengguna->token,'nama' => $pengguna->name_perusahaan], function($message) use($request){
                    $message->to($request->email);
                    $message->subject('Email Verification Mail');
                });    
            } elseif($pengguna->type == 1) {
                Mail::send('mail.mail', ['token' => $pengguna->token,'nama' => $pengguna->name_akademi], function($message) use($request){
                    $message->to($request->email);
                    $message->subject('Email Verification Mail');
                });
            } elseif($pengguna->type == 0) {
                Mail::send('mail.mail', ['token' => $pengguna->token,'nama' => $pengguna->name], function($message) use($request){
                    $message->to($request->email);
                    $message->subject('Email Verification Mail');
                });    
            }
        } elseif($request->type == 1) {
            $namarec = "Hamepa";
            $nomorec = 4399997272;
            $payment = 0;
            if($pengguna->type == 2){
                Mail::mailer('payment')->to($request->email)->send(new Payment($pengguna->name_perusahaan,$payment,'Pembayaran','digijobaccounting@ugiport.com',$payment,$namarec,$nomorec));
            } else {
                Mail::mailer('payment')->to($request->email)->send(new Payment($pengguna->name,$payment,'Pembayaran','digijobaccounting@ugiport.com',$payment,$namarec,$nomorec));
            }
        }
        return redirect('/manager/search_email')->with('success',"Email Terkirim");
    }
}