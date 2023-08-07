<?php

namespace App\Http\Controllers\Kandidat;

use App\Http\Controllers\Controller;
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
use App\Models\notifyKandidat;
use App\Models\Pembayaran;
use App\Models\Perusahaan;
use App\Models\PengalamanKerja;
use App\Models\ContactUs;
use App\Models\messageKandidat;
use App\Models\LowonganPekerjaan;
use App\Models\PermohonanLowongan;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use App\Models\PersetujuanKandidat;
use App\Models\Pelatihan;
use App\Models\VerifyOTP;
use Twilio\Rest\Client;
use App\Models\Interview;
use App\Models\Portofolio;
use App\Models\VideoKerja;
use App\Models\FotoKerja;

class KandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $notif = notifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->limit(3)->get();
        $pembayaran = Pembayaran::where('id_kandidat',$kandidat->id_kandidat)->first();
        $notifyK = notifyKandidat::where('created_at','<',Carbon::now()->subDays(14))->delete();
        $lowongan = LowonganPekerjaan::join(
            'perusahaan', 'lowongan_pekerjaan.id_perusahaan','=','perusahaan.id_perusahaan'
        )
        ->where('perusahaan.penempatan_kerja','like','%'.$kandidat->penempatan.'%')->get();
        $cari_perusahaan = null;
        $perusahaan_semua = Perusahaan::whereNotNull('email_operator')->where('penempatan_kerja','like','%'.$kandidat->penempatan.'%')->get();
        if($kandidat->id_perusahaan !== null){
            $perusahaan = Perusahaan::where('id_perusahaan',$kandidat->id_perusahaan)->first();
        } else {
            $perusahaan = null;
        }
        $persetujuan = PersetujuanKandidat::join(
            'perusahaan', 'persetujuan_kandidat.id_perusahaan','=','perusahaan.id_perusahaan'
        )
        ->where('persetujuan_kandidat.nama_kandidat',$kandidat->nama)->where('persetujuan_kandidat.id_kandidat',$kandidat->id_kandidat)->first();
        $interview = Interview::join(
            'perusahaan', 'interview.id_perusahaan','=','perusahaan.id_perusahaan'
        )->where('interview.id_kandidat',$kandidat->id_kandidat)->where('interview.id_perusahaan',$kandidat->id_perusahaan)->first();
        if($persetujuan !== null){
            if($persetujuan->persetujuan == null){
                $persetujuan = $persetujuan;
            } else {
                $persetujuan = null;
            }
        } else {
            $persetujuan == null;
        }
        if($interview){
            $interview = $interview;
        } else {
            $interview = null;
        }
        User::where('referral_code',$kandidat->referral_code)->update([
            'counter' => null,
        ]);
        return view('kandidat/index',compact('kandidat','notif','perusahaan_semua',
        'perusahaan','pembayaran','pesan','lowongan','cari_perusahaan','persetujuan'));
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
        $pengalaman_kerja = PengalamanKerja::where('id_kandidat',$kandidat->id_kandidat)->limit(3)->get();
        $notif = notifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->limit(3)->get();
        if($kandidat->hubungan_perizin == null){
            return redirect()->route('kandidat')->with('warning',"Harap lengkapi profil anda terlebih dahulu");
        } elseif($kandidat->negara_id == null) {
            return redirect()->route('kandidat')->with('warning',"Harap tentukan tempat kerja anda");
        } else {
            return view('kandidat/profil_kandidat',compact(
                'kandidat',
                'negara',
                'tgl_user',
                'usia',
                'notif',
                'pesan',
                'pembayaran',
                'pengalaman_kerja',
            ));    
        }
    }

    public function galeri($id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $notif = NotifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->limit(3)->get();
        $pengalaman_kerja = PengalamanKerja::where('pengalaman_kerja_id',$id)->first();
        $video = VideoKerja::where('pengalaman_kerja_id',$id)->get();
        $foto = FotoKerja::where('pengalaman_kerja_id',$id)->get();
        return view('kandidat/modalKandidat/galeri',compact('kandidat','notif','pesan','pengalaman_kerja','video','foto'));
    }

    public function lihatGaleri($id,$type)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $notif = NotifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->limit(3)->get();
        if($type == "video"){
            $video = VideoKerja::where('video_kerja_id',$id)->first();
            $video_pengalaman = VideoKerja::where('pengalaman_kerja_id',$video->pengalaman_kerja_id)->get();
            $foto_pengalaman = FotoKerja::where('pengalaman_kerja_id',$video->pengalaman_kerja_id)->get();
            $pengalaman = PengalamanKerja::where('pengalaman_kerja_id',$video->pengalaman_kerja_id)->first();
            return view('kandidat/modalKandidat/lihat_galeri',compact('kandidat','type','id','video_pengalaman','video','foto_pengalaman','pesan','notif','pengalaman'));
        } elseif($type == "foto"){
            $foto = FotoKerja::where('foto_kerja_id',$id)->first();
            $foto_pengalaman = FotoKerja::where('pengalaman_kerja_id',$foto->pengalaman_kerja_id)->get();
            $video_pengalaman = VideoKerja::where('pengalaman_kerja_id',$foto->pengalaman_kerja_id)->get();
            $pengalaman = PengalamanKerja::where('pengalaman_kerja_id',$foto->pengalaman_kerja_id)->first();
            return view('kandidat/modalKandidat/lihat_galeri',compact('kandidat','type','id','foto_pengalaman','foto','video_pengalaman','pesan','notif','pengalaman'));
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
        $show_negara = Negara::where('negara_id',$kandidat->negara_id)->first();
        if($show_negara == null){
            $negara = null;
        } else {
            $negara = $show_negara->negara;    
        }
        return view('kandidat/modalKandidat/edit_kandidat_personal',compact('timeNow','user','kandidat','negara'));
    }

    public function simpan_kandidat_personal(Request $request)
    {
        $usia = Carbon::parse($request->tgl_lahir)->age;
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        if($request->password !== null){
            $password =  Hash::make($request->password);
            $check_password = $request->password;
        } else {
            $password = $id->password;
            $check_password = $id->check_password;
        }
        Kandidat::where('referral_code',$id->referral_code)->update([
            'nama' => $kandidat->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'no_telp' => $id->no_telp,
            'agama' => $request->agama,
            'berat' => $request->berat,
            'tinggi' => $request->tinggi,
            'email' => $kandidat->email,
            'usia'=> $usia,
        ]);

        $userId = Kandidat::where('referral_code',$id->referral_code)->first();
        User::where('referral_code', $userId->referral_code)->update([
            'password' => $password,
            'check_password' => $check_password,
        ]);
        // Alert::toast('Data anda tersimpan','success');
        return redirect('/isi_kandidat_document')
        ->with('success',"Data anda tersimpan");
        // ->with('toast_success',"Data anda tersimpan");
    }

    public function ubah_kandidat_noTelp(Request $request)
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        User::where('referral_code',$id->referral_code)->update([
            'number_phone'=>$request->no_telp,
        ]);
        $verifyOTP = $this->confirmOTP($request->no_telp);

        $locate = "+62";
        $no_telp = $locate.$request->no_telp;

        // Your Account SID and Auth Token from console.twilio.com
        $sid = "ACb06a8933697ab7c78fb43bcb61277dda";
        $token = "bb18df3cb8e369ee635189c9fd3e0a22";

        $client = new Client($sid, $token);
        // Use the Client to make requests to the Twilio REST API
        $message = $client->messages->create(
            // The number you'd like to send the message to
            $no_telp,
            [
                // A Twilio phone number you purchased at https://console.twilio.com
                'from' => '+12294045420',
                // The body of the text message you'd like to send
                'body' => $verifyOTP->otp,
            ]
        );

        return view('kandidat/modalKandidat/otp_code',compact('kandidat'));
    }

    public function confirmOTP()
    {
        $id = Auth::user();
        $user = User::where('no_telp',$id->no_telp)->where('number_phone',$id->number_phone)->first();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $verifyOTP = VerifyOTP::where('id',$user->id)->latest()->first();

        $now = Carbon::now();
        if($verifyOTP && $now->isBefore($verifyOTP->expire_at)){
            return $verifyOTP;
        }

        return VerifyOTP::create([
            'id' => $user->id,
            'otp' => rand(123456789, 999999),
            'expire_at' => Carbon::now()->addMinutes(10),
        ]);
    }

    public function confirm_kandidat_OTP_Telp(Request $request)
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $verifyOTP = VerifyOTP::where('id',$id->id)->where('otp',$request->otp)->first();
        $now = Carbon::now();
        if($verifyOTP && $now->isAfter($verifyOTP->expire_at)){
            return back()->with('error',"Masa berlaku Kode OTP telah habis");
        }

        $user = User::whereId($id->id)->first();
        return redirect()->route('document')->with('success',"No Telp anda diperbarui");
    }

    public function isi_kandidat_document()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code', $id->referral_code)->first();
        $kelurahan = Kelurahan::all();
        $kecamatan = Kecamatan::all();
        $kota = Kota::all();
        $provinsi = Provinsi::all();
        // $negara = Negara::all();
        $show_negara = Negara::where('negara_id',$kandidat->negara_id)->first();
        if($show_negara == null){
            $negara = null;
        } else {
            $negara = $show_negara->negara;    
        }
        return view('kandidat/modalKandidat/edit_kandidat_document',compact('kandidat','kelurahan','kecamatan','kota','provinsi','negara'));
    }

    public function simpan_kandidat_document(Request $request)
    {
        $validated = $request->validate([
            'rt' => 'required|max:3|min:3',
            'rw' => 'required|max:3|min:3',
            'foto_ktp' => 'mimes:png,jpg,jpeg',
            'foto_kk' => 'mimes:png,jpg,jpeg',
            'foto_set_badan' => 'mimes:png,jpg,jpeg',
            'foto_4x6' => 'mimes:png,jpg,jpeg',
            'foto_ket_lahir' => 'mimes:png,jpg,jpeg',
            'foto_ijazah' => 'mimes:png,jpg,jpeg',
        ]);
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code', $id->referral_code)->first();  
        // cek foto ktp
        if($request->file('foto_ktp') !== null){
            $hapus_ktp = public_path('gambar/Kandidat/'.$kandidat->nama.'/KTP/').$kandidat->foto_ktp;
            if(file_exists($hapus_ktp)){
                @unlink($hapus_ktp);
            }
            $ktp = $kandidat->nama.time().'.'.$request->foto_ktp->extension();
            $simpan_ktp = $request->file('foto_ktp');  
            $simpan_ktp->move('gambar/Kandidat/'.$kandidat->nama.'/KTP/',$kandidat->nama.time().'.'.$simpan_ktp->extension());           
        } else {
            if($kandidat->foto_ktp !== null){
                $ktp = $kandidat->foto_ktp;
            } else {
                $ktp = null;
            }
        }
        // cek foto kk
        if ($request->file('foto_kk') !== null) {    
            $hapus_kk = public_path('gambar/Kandidat/'.$kandidat->nama.'/KK/').$kandidat->foto_kk;
            if(file_exists($hapus_kk)){
                @unlink($hapus_kk);
            }
            $kk = $kandidat->nama.time().'.'.$request->foto_kk->extension();  
            $simpan_kk = $request->file('foto_kk');
            $simpan_kk->move('gambar/Kandidat/'.$kandidat->nama.'/KK/',$kandidat->nama.time().'.'.$simpan_kk->extension());
        } else {
            if ($kandidat->foto_kk !== null) {
                $kk = $kandidat->foto_kk;
            } else {
                $kk = null;
            }
        }
        // cek foto set badan
        if($request->file('foto_set_badan') !== null){
            $hapus_set_badan = public_path('gambar/Kandidat/'.$kandidat->nama.'/Set_badan/').$kandidat->foto_set_badan;
            if(file_exists($hapus_set_badan)){
                @unlink($hapus_set_badan);
            }
            $set_badan = $kandidat->nama.time().'.'.$request->foto_set_badan->extension();
            $simpan_set_badan = $request->file('foto_set_badan');
            $simpan_set_badan->move('gambar/Kandidat/'.$kandidat->nama.'/Set_badan/',$kandidat->nama.time().'.'.$simpan_set_badan->extension());
        } else {
            if ($kandidat->foto_set_badan !== null) {
                $set_badan = $kandidat->foto_set_badan;   
            } else {
                $set_badan = null;    
            }
        }
        // cek foto 4x6
        if($request->file('foto_4x6') !== null){
            $hapus_4x6 = public_path('gambar/Kandidat/'.$kandidat->nama.'/4x6/').$kandidat->foto_4x6;
            if(file_exists($hapus_4x6)){
                @unlink($hapus_4x6);
            }
            $foto_4x6 = $kandidat->nama.time().'.'.$request->foto_4x6->extension();  
            $simpan_foto_4x6 = $request->file('foto_4x6');
            $simpan_foto_4x6->move('gambar/Kandidat/'.$kandidat->nama.'/4x6/',$kandidat->nama.time().'.'.$simpan_foto_4x6->extension());
        } else {
            if ($kandidat->foto_4x6 !== null) {
                $foto_4x6 = $kandidat->foto_4x6;
            } else {
                $foto_4x6 = null;
            }
        }
        // cek foto ket lahir
        if($request->file('foto_ket_lahir') !== null){
            $hapus_ket_lahir = public_path('gambar/Kandidat/'.$kandidat->nama.'/Ket_lahir/').$kandidat->foto_ket_lahir;
            if(file_exists($hapus_ket_lahir)){
                @unlink($hapus_ket_lahir);
            }
            $ket_lahir = $kandidat->nama.time().'.'.$request->foto_ket_lahir->extension();  
            $simpan_ket_lahir = $request->file('foto_ket_lahir');
            $simpan_ket_lahir->move('gambar/Kandidat/'.$kandidat->nama.'/Ket_lahir/',$kandidat->nama.time().'.'.$simpan_ket_lahir->extension());
        } else {
            if ($kandidat->foto_ket_lahir !== null) {
                $ket_lahir = $kandidat->foto_ket_lahir;    
            } else {
                $ket_lahir = null;
            }
        }
        // cek foto ijazah
        if($request->file('foto_ijazah') !== null){
            $hapus_ijazah = public_path('gambar/Kandidat/'.$kandidat->nama.'/Ijazah/').$kandidat->foto_ijazah;
            if(file_exists($hapus_ijazah)){
                @unlink($hapus_ijazah);
            }
            $ijazah = $kandidat->nama.time().'.'.$request->foto_ijazah->extension();
            $simpan_ijazah = $request->file('foto_ijazah');  
            $simpan_ijazah->move('gambar/Kandidat/'.$kandidat->nama.'/Ijazah',$kandidat->nama.time().'.'.$simpan_ijazah->extension());            
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
            'pendidikan' => $request->pendidikan,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'dusun' => $request->dusun,
            'kelurahan' => $kelurahan->kelurahan,
            'kecamatan' => $kecamatan->kecamatan,
            'kabupaten' => $kota->kota,
            'provinsi' => $provinsi->provinsi,
            // 'stats_negara' => "Indonesia",
            'foto_ktp' => $foto_ktp,
            'foto_kk' => $foto_kk,
            'foto_set_badan' => $foto_set_badan,
            'foto_4x6' => $photo_4x6,
            'foto_ket_lahir' =>$foto_ket_lahir,
            'foto_ijazah' => $foto_ijazah,
            'stats_nikah' => $request->stats_nikah
        ]);

        if ($request->stats_nikah == "Menikah") {
            return redirect()->route('family')
            // ->with('toast_success',"Data anda tersimpan");
            ->with('success',"Data anda tersimpan");
        } elseif($request->stats_nikah == "Cerai hidup"){
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
            Kandidat::where('id_kandidat',$kandidat->id_kandidat)->update([
                'nama_pasangan'=> null,
                'tgl_lahir_pasangan'=> null,
                'umur_pasangan'=> null,
                'pekerjaan_pasangan'=> null,
                'foto_buku_nikah' => null,
                'foto_cerai' =>null,
                'foto_kematian_pasangan' => null,
            ]);
            return redirect()->route('family')
            // ->with('toast_success',"Data anda tersimpan");
            ->with('success',"Data anda tersimpan");
        } elseif($request->stats_nikah == "Cerai mati"){
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
            Kandidat::where('id_kandidat',$kandidat->id_kandidat)->update([
                'nama_pasangan'=> null,
                'tgl_lahir_pasangan'=> null,
                'umur_pasangan'=> null,
                'pekerjaan_pasangan'=> null,
                'foto_buku_nikah' => null,
                'foto_cerai' =>null,
                'foto_kematian_pasangan' => null,
            ]);
            return redirect()->route('family')
            // ->with('toast_success',"Data anda tersimpan");
            ->with('success',"Data anda tersimpan");
        } else {
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
            Kandidat::where('id_kandidat',$kandidat->id_kandidat)->update([
                'nama_pasangan'=> null,
                'tgl_lahir_pasangan'=> null,
                'umur_pasangan'=> null,
                'pekerjaan_pasangan'=> null,
                'jml_anak_lk' => null,
                'umur_anak_lk' => null,
                'jml_anak_pr' => null,
                'umur_anak_pr' => null,
                'foto_buku_nikah' => null,
                'foto_cerai' =>null,
                'foto_kematian_pasangan' => null,
            ]);
            return redirect('/isi_kandidat_vaksin')
            // ->with('toast_success',"Data anda tersimpan");
            ->with('success',"Data anda tersimpan");
        }        
    }

    public function isi_kandidat_family()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $show_negara = Negara::where('negara_id',$kandidat->negara_id)->first();
        if($show_negara == null){
            $negara = null;
        } else {
            $negara = $show_negara->negara;    
        }

        if ($kandidat->stats_nikah == null) {
            return redirect()->route('vaksin');
        } elseif($kandidat->stats_nikah !== "Single") {
            return view('kandidat/modalKandidat/edit_kandidat_family',compact('kandidat','negara'));    
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
            $hapus_buku_nikah = public_path('gambar/Kandidat/'.$kandidat->nama.'/Buku Nikah/').$kandidat->foto_buku_nikah;
            if(file_exists($hapus_buku_nikah)){
                @unlink($hapus_buku_nikah);
            }
            $buku_nikah = $kandidat->nama.time().'.'.$request->foto_buku_nikah->extension();
            $simpan_buku_nikah = $request->file('foto_buku_nikah');  
            $simpan_buku_nikah->move('gambar/Kandidat/'.$kandidat->nama.'/Buku Nikah/',$kandidat->nama.time().'.'.$simpan_buku_nikah->extension());
        } else {
            if($kandidat->foto_buku_nikah !== null){
                $buku_nikah = $kandidat->foto_buku_nikah;
            } else {
                $buku_nikah = null;
            }
        }
        if($request->file('foto_cerai')){
            $hapus_foto_cerai = public_path('gambar/Kandidat/'.$kandidat->nama.'/Cerai/').$kandidat->foto_cerai;
            if(file_exists($hapus_foto_cerai)){
                @unlink($hapus_foto_cerai);
            }
            $cerai = $kandidat->nama.time().'.'.$request->foto_cerai->extension();
            $simpan_cerai = $request->file('foto_cerai');  
            $simpan_cerai->move('gambar/Kandidat/'.$kandidat->nama.'/Cerai/',$kandidat->nama.time().'.'.$simpan_cerai->extension());
        } else {
            if($kandidat->foto_cerai !== null){
                $cerai = $kandidat->foto_buku_nikah;
            } else {
                $cerai = null;
            }
        }
        if($request->file('foto_kematian_pasangan')){
            $hapus_kematian_pasangan = public_path('gambar/Kandidat/'.$kandidat->nama.'/Kematian Pasangan/').$kandidat->foto_kematian_pasangan;
            if(file_exists($hapus_kematian_pasangan)){
                @unlink($hapus_kematian_pasangan);
            }
            $kematian_pasangan = $kandidat->nama.time().'.'.$request->foto_kematian_pasangan->extension();
            $simpan_kematian_pasangan = $request->file('foto_kematian_pasangan');  
            $simpan_kematian_pasangan->move('gambar/Kandidat/'.$kandidat->nama.'/Kematian Pasangan/',$kandidat->nama.time().'.'.$simpan_kematian_pasangan->extension());
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

        $umur = Carbon::parse($request->tgl_lahir_pasangan)->age;

        $id = Auth::user();
        Kandidat::where('referral_code', $id->referral_code)->update([
            'foto_buku_nikah' => $foto_buku_nikah,
            'nama_pasangan' => $request->nama_pasangan,
            'umur_pasangan' => $umur,
            'tgl_lahir_pasangan' => $request->tgl_lahir_pasangan,
            'pekerjaan_pasangan' => $request->pekerjaan_pasangan,
            'jml_anak_lk' => $request->jml_anak_lk,
            'umur_anak_lk' => $request->umur_anak_lk,
            'jml_anak_pr' => $request->jml_anak_pr,
            'umur_anak_pr' => $request->umur_anak_pr,
            'foto_cerai' => $foto_cerai,
            'foto_kematian_pasangan' => $foto_kematian_pasangan,
        ]);
        return redirect('/isi_kandidat_vaksin')
        // ->with('toast_success',"Data anda tersimpan");
        ->with('success',"Data anda tersimpan");
    }

    public function isi_kandidat_vaksin()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code', $id->referral_code)->first(); 
        $show_negara = Negara::where('negara_id',$kandidat->negara_id)->first();
        if($show_negara == null){
            $negara = null;
        } else {
            $negara = $show_negara->negara;    
        }
        return view('kandidat/modalKandidat/edit_kandidat_vaksinasi',['kandidat'=>$kandidat,'negara'=>$negara]);
    }

    public function simpan_kandidat_vaksin(Request $request)
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        // cek vaksin1
        if($request->file('sertifikat_vaksin1') !== null){
            $hapus_sertifikat_vaksin1 = public_path('gambar/Kandidat/'.$kandidat->nama.'/Vaksin Pertama/').$kandidat->sertifikat_vaksin1;
            if(file_exists($hapus_sertifikat_vaksin1)){
                @unlink($hapus_sertifikat_vaksin1);
            }
            $sertifikat_vaksin1 = $kandidat->nama.time().'.'.$request->sertifikat_vaksin1->extension();
            $simpan_sertifikat_vaksin1 = $request->file('sertifikat_vaksin1');  
            $simpan_sertifikat_vaksin1->move('gambar/Kandidat/'.$kandidat->nama.'/Vaksin Pertama/',$kandidat->nama.time().'.'.$simpan_sertifikat_vaksin1->extension());
        } else {
            if($kandidat->sertifikat_vaksin1 !== null){
                $sertifikat_vaksin1 = $kandidat->sertifikat_vaksin1;
            } else {
                $sertifikat_vaksin1 = null;
            }
        }
        // cek vaksin2
        if($request->file('sertifikat_vaksin2') !== null){
            $hapus_sertifikat_vaksin2 = public_path('gambar/Kandidat/'.$kandidat->nama.'/Vaksin Kedua/').$kandidat->sertifikat_vaksin2;
            if(file_exists($hapus_sertifikat_vaksin2)){
                @unlink($hapus_sertifikat_vaksin2);
            }
            $sertifikat_vaksin2 = $kandidat->nama.time().'.'.$request->sertifikat_vaksin2->extension();
            $simpan_sertifikat_vaksin2 = $request->file('sertifikat_vaksin2');  
            $simpan_sertifikat_vaksin2->move('gambar/Kandidat/'.$kandidat->nama.'/Vaksin Kedua/',$kandidat->nama.time().'.'.$simpan_sertifikat_vaksin2->extension());    
        } else {
            if($kandidat->sertifikat_vaksin2 !== null){
                $sertifikat_vaksin2 = $kandidat->sertifikat_vaksin2;
            } else {
                $sertifikat_vaksin2 = null;
            }
        }
        // cek vaksin3
        if($request->file('sertifikat_vaksin3') !== null){
            $hapus_sertifikat_vaksin3 = public_path('gambar/Kandidat/'.$kandidat->nama.'/Vaksin Ketiga/').$kandidat->sertifikat_vaksin3;
            if(file_exists($hapus_sertifikat_vaksin3)){
                @unlink($hapus_sertifikat_vaksin3);
            }
            $sertifikat_vaksin3 = $kandidat->nama.time().'.'.$request->sertifikat_vaksin3->extension();
            $simpan_sertifikat_vaksin3 = $request->file('sertifikat_vaksin3');  
            $simpan_sertifikat_vaksin3->move('gambar/Kandidat/'.$kandidat->nama.'/Vaksin Ketiga/',$kandidat->nama.time().'.'.$simpan_sertifikat_vaksin3->extension());
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
        return redirect('/isi_kandidat_parent')
        // ->with('toast_success',"Data anda tersimpan");
        ->with('success',"Data anda tersimpan");
    }

    public function isi_kandidat_parent()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code', $id->referral_code)->first();
        $show_negara = Negara::where('negara_id',$kandidat->negara_id)->first();
        if($show_negara == null){
            $negara = null;
        } else {
            $negara = $show_negara->negara;    
        }
        return view('kandidat/modalKandidat/edit_kandidat_parent',['kandidat'=>$kandidat,'negara'=>$negara]);
    }

    public function simpan_kandidat_parent(Request $request)
    {
        $validated = $request->validate([
            'rt' => 'required|max:3|min:3',
            'rw' => 'required|max:3|min:3',
        ]);
        $umurAyah = Carbon::parse($request->tgl_lahir_ayah)->age;
        $umurIbu = Carbon::parse($request->tgl_lahir_ibu)->age;
        // dd($umur);
        $id = Auth::user();
        
        $provinsi = Provinsi::where('id',$request->provinsi_id)->first();
        $kota = Kota::where('id',$request->kota_id)->first();
        $kecamatan = Kecamatan::where('id',$request->kecamatan_id)->first();
        $kelurahan = kelurahan::where('id',$request->kelurahan_id)->first();
        
        Kandidat::where('referral_code', $id->referral_code)->update([
            'nama_ayah' => $request->nama_ayah,
            'umur_ayah' => $umurAyah,
            'tgl_lahir_ayah' => $request->tgl_lahir_ayah,
            'tmp_lahir_ayah' => $request->tmp_lahir_ayah,
            'nama_ibu' => $request->nama_ibu,
            'umur_ibu' => $umurIbu,
            'tgl_lahir_ibu' => $request->tgl_lahir_ibu,
            'tmp_lahir_ibu' => $request->tmp_lahir_ibu,
            'rt_parent' => $request->rt,
            'rw_parent' => $request->rw,
            'dusun_parent' => $request->dusun_parent,
            'kelurahan_parent' => $kelurahan->kelurahan,
            'kecamatan_parent' => $kecamatan->kecamatan,
            'kabupaten_parent' => $kota->kota,
            'provinsi_parent' => $provinsi->provinsi,
            'jml_sdr_lk' => $request->jml_sdr_lk,
            'jml_sdr_pr' => $request->jml_sdr_pr,
            'anak_ke' => $request->anak_ke
        ]);
        return redirect()->route('company')
        // ->with('toast_success',"Data anda tersimpan");
        ->with('success',"Data anda tersimpan");
    }

    public function isi_kandidat_company()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code', $id->referral_code)->first();
        $show_negara = Negara::where('negara_id',$kandidat->negara_id)->first();
        if($show_negara == null){
            $negara = null;
        } else {
            $negara = $show_negara->negara;    
        }
        $pengalaman_kerja = PengalamanKerja::where('id_kandidat',$kandidat->id_kandidat)->get();
        return view('kandidat/modalKandidat/edit_kandidat_company', [
            'kandidat'=>$kandidat,
            'pengalaman_kerja'=>$pengalaman_kerja,
            'negara'=>$negara,
        ]);
    }

    public function tambahPengalamanKerja()
    {
        return view('kandidat/modalKandidat/tambah_pengalaman_kerja');
    }

    public function simpanPengalamanKerja(Request $request)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $jabatan = $request->jabatan;
        $video_kandidat = PengalamanKerja::where('id_kandidat',$kandidat->id_kandidat)->first();
        
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
        
        return redirect()->route('company')
        // ->with('toast_success',"Data anda tersimpan");
        ->with('success',"Data anda tersimpan");
    }

    public function lihatPengalamanKerja($id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $pengalaman = PengalamanKerja::where('pengalaman_kerja_id',$id)->first();
        $video = VideoKerja::where('pengalaman_kerja_id',$id)->get();
        $foto = FotoKerja::where('pengalaman_kerja_id',$id)->get();
        return view('kandidat/modalKandidat/lihat_pengalaman_kerja',compact('kandidat','pengalaman','id','video','foto'));
    }

    public function tambahPortofolio($id, $type)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $code = "tambah";
        if($type == "video"){
            return view('kandidat/modalKandidat/video_kerja',compact('kandidat','code','id'));
        } elseif($type == "foto") {
            return view('kandidat/modalKandidat/foto_kerja',compact('kandidat','code','id'));
        } 
    }

    public function simpanPortofolio(Request $request,$id,$type)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $pengalaman = PengalamanKerja::where('pengalaman_kerja_id',$id)->first(); 
        if($type == "video"){
            if($request->file('video') !== null){
                $validated = $request->validate([
                    'video' => 'mimes:mp4,mov,ogg,qt',
                ]);
                $video_kerja = $request->file('video');
                $video_kerja->move('gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/',$kandidat->nama.$pengalaman->jabatan.$video_kerja->getClientOriginalName());
                $simpan_kerja = $kandidat->nama.$pengalaman->jabatan.$video_kerja->getClientOriginalName();
            } else {
                $simpan_kerja = null;
            }
    
            if($simpan_kerja !== null){
                $video = $simpan_kerja;
            } else {
                $video = null;
            }
            VideoKerja::create([
                'video' => $video,
                'pengalaman_kerja_id' => $pengalaman->pengalaman_kerja_id,
                'jabatan' => $pengalaman->jabatan,
            ]);
        } elseif($type == "foto"){
            if($request->file('foto') !== null){
                $foto_kerja = $kandidat->nama.time().'.'.$request->foto->extension();
                $simpan_foto_kerja = $request->file('foto');  
                $simpan_foto_kerja->move('gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/',$kandidat->nama.time().'.'.$simpan_foto_kerja->extension());
            } else {            
                $foto_kerja = null;
            }
    
            if($foto_kerja !== null){
                $foto = $foto_kerja;
            } else {
                $foto = null;
            }
            FotoKerja::create([
                'foto' => $foto,
                'pengalaman_kerja_id' => $pengalaman->pengalaman_kerja_id,
                'jabatan' => $pengalaman->jabatan,
            ]);
        }
        return redirect('/lihat_kandidat_pengalaman_kerja/'.$id)->with('success',"Portofolio ditambahkan");      
    }

    public function editPortofolio($id,$type)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $foto = FotoKerja::where('foto_kerja_id',$id)->first();
        $video = VideoKerja::where('video_kerja_id',$id)->first();
        $code = "edit";
        if($type == "video"){
            return view('kandidat/modalKandidat/video_kerja',compact('kandidat','video','code'));
        } elseif($type == "foto") {
            return view('kandidat/modalKandidat/foto_kerja',compact('kandidat','foto','code'));
        } else {
            return back();
        }
    }

    public function ubahPortofolio(Request $request,$id,$type)
    {   
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        if($type == "video"){
            $video = VideoKerja::where('video_kerja_id',$id)->first();
            if($request->file('video') !== null){
                $validated = $request->validate([
                    'video' => 'mimes:mp4,mov,ogg,qt',
                ]);
                $hapus_video_kerja = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/').$video->video;
                if(file_exists($hapus_video_kerja)){
                    @unlink($hapus_video_kerja);
                }
                $video_kerja = $request->file('video');
                $video_kerja->move('gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/',$kandidat->nama.$video_kerja->getClientOriginalName());
                $simpan_kerja = $kandidat->nama.$video_kerja->getClientOriginalName();
            } else {
                if($video->video !== null){
                    $simpan_kerja = $video->video;
                } else {
                    $simpan_kerja = null;
                }
            }
    
            if($simpan_kerja !== null){
                $video_pengalaman = $simpan_kerja;
            } else {
                $video_pengalaman = null;
            }
            VideoKerja::where('video_kerja_id',$id)->update([
                'video'=>$video_pengalaman,
            ]);
            return redirect('/lihat_kandidat_pengalaman_kerja/'.$video->pengalaman_kerja_id)->with('success',"Data diubah");
        } elseif($type == "foto"){
            $foto = FotoKerja::where('foto_kerja_id',$id)->first();
            if($request->file('foto') !== null){
                $hapus_foto = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/').$foto->foto;
                if(file_exists($hapus_foto)){
                    @unlink($hapus_foto);
                }
                $foto_kerja = $kandidat->nama.time().'.'.$request->foto->extension();
                $simpan_foto_kerja = $request->file('foto');  
                $simpan_foto_kerja->move('gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/',$kandidat->nama.time().'.'.$simpan_foto_kerja->extension());
            } else {
                if($foto->foto !== null){
                    $foto_kerja = $foto->foto;
                } else {
                    $foto_kerja = null;
                }           
            }
    
            if($foto_kerja !== null){
                $foto_pengalaman = $foto_kerja;
            } else {
                $foto_pengalaman = null;
            }
            FotoKerja::where('foto_kerja_id',$id)->update([
                'foto'=>$foto_pengalaman,
            ]);
            return redirect('/lihat_kandidat_pengalaman_kerja/'.$foto->pengalaman_kerja_id)->with('success',"Data diubah");
        }
    }

    public function hapusPortofolio($id,$type)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        if($type == "video"){
            $video = VideoKerja::where('video_kerja_id',$id)->first();
            $pengalaman = PengalamanKerja::where('pengalaman_kerja_id',$video->pengalaman_kerja_id)->first();
            $hapus_video_kerja = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/').$video->video;
                if(file_exists($hapus_video_kerja)){
                    @unlink($hapus_video_kerja);
                }
            VideoKerja::where('video_kerja_id',$id)->delete();
        } elseif($type == "foto"){
            $foto = FotoKerja::where('foto_kerja_id',$id)->first();
            $pengalaman = PengalamanKerja::where('pengalaman_kerja_id',$foto->pengalaman_kerja_id)->first();
            $hapus_foto = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/').$foto->foto;
                if(file_exists($hapus_foto)){
                    @unlink($hapus_foto);
                }
            FotoKerja::where('foto_kerja_id',$id)->delete();
        }
        return redirect('/lihat_kandidat_pengalaman_kerja/'.$pengalaman->pengalaman_kerja_id)->with('success',"Data Telah dihapus");
    }

    public function editPengalamanKerja($id)
    {
        $pengalaman_kerja = PengalamanKerja::where('pengalaman_kerja_id',$id)->first();
        return view('kandidat/modalKandidat/edit_pengalaman_kerja', compact('pengalaman_kerja'));
    }

    public function updatePengalamanKerja(Request $request, $id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $video_kandidat = PengalamanKerja::where('id_kandidat',$kandidat->id_kandidat)->first();

        $periodeAwal = new \Datetime($request->periode_awal);
        $periodeAkhir = new \DateTime($request->periode_akhir);
        $tahun = $periodeAkhir->diff($periodeAwal)->y;

        PengalamanKerja::where('pengalaman_kerja_id',$id)->update([
            'nama_perusahaan'=>$request->nama_perusahaan,
            'alamat_perusahaan'=>$request->alamat_perusahaan,
            'jabatan'=>$request->jabatan,
            'periode_awal'=>$request->periode_awal,
            'periode_akhir'=>$request->periode_akhir,
            'alasan_berhenti'=>$request->alasan_berhenti,
            'id_kandidat'=>$kandidat->id_kandidat,
            'nama_kandidat' => $kandidat->nama,
            'lama_kerja' => $tahun,
        ]);
        return redirect()->route('company')
        // ->with('toast_success',"Data anda tersimpan");
        ->with('success',"Data anda tersimpan");
    }

    public function hapusPengalamanKerja($id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $pengalaman = PengalamanKerja::where('pengalaman_kerja_id',$id)->first();
        // $portofolio = Portofolio::where('pengalaman_kerja_id',$id)->get();
        
        $video = VideoKerja::where('pengalaman_kerja_id',$pengalaman->pengalaman_kerja_id)->first();
        if($video){
            $hapus_video_kerja = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/').$video->video;
            if(file_exists($hapus_video_kerja)){
                @unlink($hapus_video_kerja);
            }
        }
        $foto = FotoKerja::where('pengalaman_kerja_id',$pengalaman->pengalaman_kerja_id)->first();    
        if($foto){
            $hapus_foto_kerja = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/').$foto->foto;
            if(file_exists($hapus_foto_kerja)){
                @unlink($hapus_foto_kerja);
            }
        }
           
        // Portofolio::where('pengalaman_kerja_id',$id)->delete();
        VideoKerja::where('pengalaman_kerja_id',$pengalaman->pengalaman_kerja_id)->delete();
        FotoKerja::where('pengalaman_kerja_id',$pengalaman->pengalaman_kerja_id)->delete();    
        PengalamanKerja::where('pengalaman_kerja_id',$id)->delete();
        return redirect()->route('company')->with('success',"Data berhasi dihapus");
    }

    public function simpan_kandidat_company(Request $request)
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $jabatan = $request->jabatan;
        $lama_kerja = $request->lama_kerja;
        if($jabatan !== null){
            $jabatanValues = implode(",",$jabatan);
            $lamaKerjaValues = array_sum($lama_kerja);
        } else {
            $jabatanValues = null;
            $lamaKerjaValues = null;
        }

        Kandidat::where('id_kandidat', $kandidat->id_kandidat)->update([
            'pengalaman_kerja' => $jabatanValues,
            'lama_kerja' => $lamaKerjaValues,
        ]);
        return redirect()->route('permission')
        // ->with('toast_success',"Data anda tersimpan");
        ->with('success',"Data anda tersimpan");
    }

    public function isi_kandidat_placement()
    {
        $negara_id = "";
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code', $id->referral_code)->first();
        $show_negara = Negara::where('negara_id',$kandidat->negara_id)->first();
        if($show_negara == null){
            $negara = null;
        } else {
            $negara = $show_negara->negara;    
        }
        $semua_negara = Negara::all();
        $pekerjaan = Pekerjaan::where('negara_id',$negara_id)->get();
        return view('kandidat/modalKandidat/edit_kandidat_placement',compact('negara','semua_negara','kandidat','pekerjaan','negara_id'));
    }

    public function placement(Request $request)
    {
        $data = Negara::where('negara_id','not like',2)->get();
        return response()->json($data);
    }

    public function deskripsiNegara(Request $request)
    {
        $data = Negara::where('negara_id',$request->dks)->first();
        return response()->json($data);
    }

    public function simpan_kandidat_placement(Request $request)
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        if($kandidat->id_perusahaan !== null){
            return redirect()->route('kandidat')
            // ->with('toast_error',"Maaf anda tidak bisa berganti penempatan kerja karena sudah masuk dalam lowonngan perusahaan");
            ->with('error',"Maaf anda tidak bisa berganti penempatan kerja karena sudah masuk dalam lowonngan perusahaan");
        }

        Kandidat::where('id_kandidat',$kandidat->id_kandidat)->update([
            'negara_id' => $request->negara_id,
            'penempatan' => $request->penempatan,
        ]);

        if($kandidat->negara_id == null)
        {
            Alert::success('Selamat','Semua data profil anda sudah lengkap');
            return redirect()->route('kandidat');
        } else {
            return redirect()->route('kandidat')
            // ->with('toast_success','Data anda tersimpan');
            ->with('success','Data anda tersimpan');
        }
    }

    public function isi_kandidat_permission()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code', $id->referral_code)->first();
        $provinsi = Provinsi::all();
        $kota = Kota::all();
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();
        $show_negara = Negara::where('negara_id',$kandidat->negara_id)->first();
        if($show_negara == null){
            $negara = null;
        } else {
            $negara = $show_negara->negara;    
        }
        return view('kandidat/modalKandidat/edit_kandidat_permission',compact('kandidat','provinsi','kecamatan','kelurahan','kota','negara'));
    }

    public function simpan_kandidat_permission(Request $request)
    {
        $validated = $request->validate([
            'rt_perizin' => 'required|max:3|min:3',
            'rw_perizin' => 'required|max:3|min:3',
            'nik_perizin' => 'required|max:16|min:16',
            'foto_ktp_izin' => 'mimes:png,jpg,jpeg',
            'no_telp_perizin' => 'min:10|max:13'
        ]);
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        // cek foto ktp izin
        if($request->file('foto_ktp_izin') !== null){
            // $this->validate($request, [
            //     'foto_ktp_izin' => 'required|file|image|mimes:jpeg,png,jpg|max:1024',
            // ]);
            $hapus_foto_ktp_izin = public_path('gambar/Kandidat/'.$kandidat->nama.'/KTP Perizin/').$kandidat->foto_ktp_izin;
            if(file_exists($hapus_foto_ktp_izin)){
                @unlink($hapus_foto_ktp_izin);
            }
            $ktp_izin = $kandidat->nama.time().'.'.$request->foto_ktp_izin->extension();
            $simpan_ktp_izin = $request->file('foto_ktp_izin');
            $simpan_ktp_izin->move('gambar/Kandidat/'.$kandidat->nama.'/KTP Perizin/',$kandidat->nama.time().'.'.$simpan_ktp_izin->extension());
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

        if($kandidat->stats_nikah == "Menikah"){
            $perizin = $kandidat->nama_pasangan;
        } else {
            $perizin = $request->nama_perizin;
        }
        
        Kandidat::where('referral_code', $id->referral_code)->update([
            'nama_perizin' => $perizin,
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
        if($request->confirm == "ya"){
            if($kandidat->no_paspor == null){
                $paspor = 0;
            } else {
                $paspor = $kandidat->no_paspor;
            }
            Kandidat::where('id_kandidat',$kandidat->id_kandidat)->update([
                'no_paspor' => $paspor,
            ]);
            return redirect()->route('paspor')
            // ->with('toast_success',"Data anda tersimpan");
            ->with('success',"Data anda tersimpan");
        } else {
            return redirect()->route('kandidat')->with('success',"Data anda tersimpan");
        }
    }

    public function isi_kandidat_paspor()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $show_negara = Negara::where('negara_id',$kandidat->negara_id)->first();
        if($show_negara == null){
            $negara = null;
        } else {
            $negara = $show_negara->negara;    
        }

        if($kandidat->no_paspor == null){
            return redirect()->route('kandidat');
        } else {
            return view('kandidat/modalKandidat/edit_kandidat_paspor',compact('kandidat','negara'));
        }
    }

    public function simpan_kandidat_paspor(Request $request)
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        if($request->file('foto_paspor') !== null){
            // $this->validate($request, [
            //     'foto_ktp_izin' => 'required|file|image|mimes:jpeg,png,jpg|max:1024',
            // ]);
            $hapus_paspor = public_path('gambar/Kandidat/'.$kandidat->nama.'/Paspor/').$kandidat->foto_paspor;
            if(file_exists($hapus_paspor)){
                @unlink($hapus_paspor);
            }
            $paspor = $kandidat->nama.time().'.'.$request->foto_paspor->extension();
            $simpan_paspor = $request->file('foto_paspor');  
            $simpan_paspor->move('gambar/Kandidat/'.$kandidat->nama.'/Paspor',$kandidat->nama.time().'.'.$simpan_paspor->extension());
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
            'pemilik_paspor' => $kandidat->nama,
            'tgl_terbit_paspor'=>$request->tgl_terbit_paspor,
            'tgl_akhir_paspor'=>$request->tgl_akhir_paspor,
            'tmp_paspor'=>$request->tmp_paspor,
            'foto_paspor'=>$foto_paspor,
        ]);
        // Alert::success('');
        return redirect('/kandidat')->with('success',"Data anda tersimpan");
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

    public function simpanInfoConnect(Request $request, $nama, $id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        Kandidat::where('id_kandidat',$kandidat->id_kandidat)->update([
            'info' => $request->info,
        ]);
        return redirect()->route('kandidat')->with('success',"Data anda tersimpan");
    }

    public function contactUsKandidat()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $notif = NotifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->limit(3)->get();
        $pembayaran = Pembayaran::where('id_kandidat',$kandidat->id_kandidat)->first();
        return view('kandidat/contact_us',compact('kandidat','notif','pembayaran','pesan'));
    }

    public function videoPelatihan()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $notif = NotifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->limit(3)->get();
        $video = Pelatihan::where('negara_id',$kandidat->negara_id)->get();
        return view('kandidat/video_pelatihan',compact('kandidat','notif','pesan','video'));
    }

    public function lihatVideoPelatihan($id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $notif = NotifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->limit(3)->get();
        $video = Pelatihan::where('id',$id)->first();
        $pelatihan = Pelatihan::where('negara_id',$kandidat->negara_id)->where('id','not like',$id)->get();
        return view('kandidat/lihat_video_pelatihan',compact('kandidat','notif','pesan','video','pelatihan'));
    }
}
