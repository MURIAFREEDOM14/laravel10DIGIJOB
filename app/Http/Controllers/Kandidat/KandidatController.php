<?php

namespace App\Http\Controllers\Kandidat;

use App\Http\Controllers\Controller;
use App\Models\Pendidikan;
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
use App\Models\Interview;
use App\Models\Portofolio;
use App\Models\VideoKerja;
use App\Models\FotoKerja;
use App\Models\DataKeluarga;
use App\Models\KandidatInterview;
use App\Models\ContactUsKandidat;

class KandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // halaman beranda kandidat
     public function index()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('kandidat.referral_code',$id->referral_code)->first();
        $notif = notifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $pembayaran = Pembayaran::where('id_kandidat',$kandidat->id_kandidat)->first();
        $notifyK = notifyKandidat::orderBy('created_at','desc')->limit(30)->get();
        $pendidikan = Pendidikan::where('pendidikan','like','%'.$kandidat->pendidikan.'%')->first();

        // menampilkan lowongan pekerjaan + perusahaan + pendidikans dan filterisasi dengan data kandidat     
        $lowongan = LowonganPekerjaan::join(
            'perusahaan', 'lowongan_pekerjaan.id_perusahaan','=','perusahaan.id_perusahaan'
        )->join(
            'pendidikans', 'lowongan_pekerjaan.pendidikan','=','pendidikans.pendidikan'
        )
        ->where('perusahaan.penempatan_kerja','like','%'.$kandidat->penempatan.'%')
        ->where('lowongan_pekerjaan.jenis_kelamin','like','%'.$kandidat->jenis_kelamin.'%')
        ->get();
        
        $cari_perusahaan = null;
        $perusahaan_semua = Perusahaan::whereNotNull('email_operator')->where('penempatan_kerja','like','%'.$kandidat->penempatan.'%')->get();
        
        // apabila kandidat memiliki hub dengan perusahaan
        if($kandidat->id_perusahaan !== null){
            $perusahaan = Perusahaan::where('id_perusahaan',$kandidat->id_perusahaan)->first();
        } else {
            $perusahaan = null;
        }
        // menampilkan data persetujuan kandidat + perusahaan + lowongan pekerjaan
        $persetujuan_kandidat = PersetujuanKandidat::join(
            'perusahaan', 'persetujuan_kandidat.id_perusahaan','=','perusahaan.id_perusahaan'
        )
        ->join(
            'lowongan_pekerjaan', 'persetujuan_kandidat.id_lowongan','=','lowongan_pekerjaan.id_lowongan'
        )
        ->where('persetujuan_kandidat.nama_kandidat',$kandidat->nama)->where('persetujuan_kandidat.id_kandidat',$kandidat->id_kandidat)->first();
        // menampilkan data kandidat interview + kandidat
        $kandidat_interview = KandidatInterview::join(
            'kandidat','kandidat_interviews.id_kandidat','=','kandidat.id_kandidat'
        )
        ->join(
            'lowongan_pekerjaan','kandidat_interviews.id_lowongan','=','lowongan_pekerjaan.id_lowongan'
        )
        ->where('kandidat.id_kandidat',$kandidat->id_kandidat)->where('kandidat_interviews.status','like',"terjadwal")
        ->where('kandidat_interviews.persetujuan','like','ya')->first();
        // apabila data persetujuan kandidat tidak kosong
        if($persetujuan_kandidat !== null){
            // apabila persetujuan kandidat di bagian persetujuan kosong
            if($persetujuan_kandidat->persetujuan == null){
                $persetujuan = $persetujuan_kandidat;
            } else {
                $persetujuan = null;
            }
        } else {
            $persetujuan = null;
        }
        // apabila kandidat interview ada
        if($kandidat_interview){
            $interview = $kandidat_interview;
        } else {
            $interview = null;
        }
        
        // sistem pembatasan data pesan kandidat hanya 30 pesan
        $allMessage = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->get();
        $total = 30;
        if ($allMessage->count() > $total) {
            $operator = $allMessage->count() - $total;
            messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('id','asc')->limit($operator)->delete();
        }

        // sistem reset catatan data kesalahan dalam login
        User::where('referral_code',$kandidat->referral_code)->update([
            'counter' => null,
        ]);
        return view('kandidat/index',compact('kandidat','notif','perusahaan_semua',
        'perusahaan','pembayaran','pesan','lowongan','cari_perusahaan','persetujuan',
        'interview','pendidikan'));
    }
    
    // halaman profil kandidat    
    public function profil()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        // menampilkan data negara + kandidat
        $negara = Negara::join(
            'kandidat', 'ref_negara.negara_id','=','kandidat.negara_id'
        )
        ->where('referral_code',$id->referral_code)
        ->first();
        $usia = Carbon::parse($kandidat->tgl_lahir)->age;
        // meng update data usia kandidat
        Kandidat::where('id_kandidat',$kandidat->id_kandidat)->update([
            'usia' => $usia,
        ]);
        $pembayaran = Pembayaran::where('id_kandidat',$kandidat->id_kandidat)->first();
        $tgl_user = Carbon::create($kandidat->tgl_lahir)->isoFormat('D MMM Y');
        $pengalaman_kerja = PengalamanKerja::where('id_kandidat',$kandidat->id_kandidat)->get();
        $notif = notifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->where('check_click',"n")->get();
        // apabila hub. perizin / kontak darurat kosong
        if($kandidat->hubungan_perizin == null){
            return redirect()->route('kandidat')->with('warning',"Harap lengkapi profil anda terlebih dahulu");
        // apabila negara tujuan kosong
        } elseif($kandidat->negara_id == null) {
            return redirect()->route('kandidat')->with('warning',"Harap tentukan tempat kerja anda");
        } else {
            return view('kandidat/profil_kandidat',compact(
                'kandidat','negara','tgl_user',
                'usia','notif','pesan','pembayaran',
                'pengalaman_kerja',
            ));    
        }
    }

    // halaman galeri kandidat
    public function galeri($id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $notif = NotifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $pengalaman_kerja = PengalamanKerja::where('pengalaman_kerja_id',$id)->first();
        $video = VideoKerja::where('pengalaman_kerja_id',$id)->get();
        $foto = FotoKerja::where('pengalaman_kerja_id',$id)->get();
        return view('kandidat/modalKandidat/galeri',compact('kandidat','notif','pesan','pengalaman_kerja','video','foto'));
    }

    // halaman lihat isi galeri kandidat
    public function lihatGaleri($id,$type)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $notif = NotifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->get();
        
        // jika video
        if($type == "video"){
            $video = VideoKerja::where('video_kerja_id',$id)->first();
            $video_pengalaman = VideoKerja::where('pengalaman_kerja_id',$video->pengalaman_kerja_id)->get();
            $foto_pengalaman = FotoKerja::where('pengalaman_kerja_id',$video->pengalaman_kerja_id)->get();
            $pengalaman = PengalamanKerja::where('pengalaman_kerja_id',$video->pengalaman_kerja_id)->first();
            return view('kandidat/modalKandidat/lihat_galeri',compact('kandidat','type','id','video_pengalaman','video','foto_pengalaman','pesan','notif','pengalaman'));
        // jika foto
        } elseif($type == "foto"){
            $foto = FotoKerja::where('foto_kerja_id',$id)->first();
            $foto_pengalaman = FotoKerja::where('pengalaman_kerja_id',$foto->pengalaman_kerja_id)->get();
            $video_pengalaman = VideoKerja::where('pengalaman_kerja_id',$foto->pengalaman_kerja_id)->get();
            $pengalaman = PengalamanKerja::where('pengalaman_kerja_id',$foto->pengalaman_kerja_id)->first();
            return view('kandidat/modalKandidat/lihat_galeri',compact('kandidat','type','id','foto_pengalaman','foto','video_pengalaman','pesan','notif','pengalaman'));
        }
    }
    
    // sistem simpan data informasi aplikasi ini didapat 
     public function simpanInfoConnect(Request $request, $nama, $id)
     {
         $user = Auth::user();
         $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
         // simpan data info ke kandidat
         Kandidat::where('id_kandidat',$kandidat->id_kandidat)->update([
             'info' => $request->info,
         ]);
         return redirect()->route('kandidat')->with('success',"Data anda tersimpan");
    }

    // halaman isi data kandidat personal
     public function isi_kandidat_personal()
    {
        $timeNow = Carbon::now();
        $id = Auth::user();
        $user = User::where('id',$id->id)->first();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        return view('kandidat/modalKandidat/edit_kandidat_personal',compact('timeNow','user','kandidat'));
    }

    // sistem simpan data kandidat personal
    public function simpan_kandidat_personal(Request $request)
    {
        $usia = Carbon::parse($request->tgl_lahir)->age;
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        
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

        // Alert::toast('Data anda tersimpan','success');
        return redirect('/isi_kandidat_document')
        ->with('success',"Data anda tersimpan");
        // ->with('toast_success',"Data anda tersimpan");
    }

    // halaman edit data kandidat password
    public function edit_kandidat_password()
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $password = null;
        return view('kandidat/modalKandidat/edit_kandidat_password',compact('kandidat','password'));
    }

    // sistem pengecekan konfirmasi kandidat password
    public function edit_password_confirm(Request $request)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $password = User::where('email',$request->email)->where('check_password',$request->password)->where('referral_code',$kandidat->referral_code)->first();
        // apabila data pengguna email dan password dan data input sama
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'referral_code' => $kandidat->referral_code])){
            return view('kandidat/modalKandidat/edit_kandidat_password',compact('kandidat','password'));
        // apabila data pengguna email dan password dan data input sama
        } elseif ($password !== null) {
            return view('kandidat/modalKandidat/edit_kandidat_password',compact('kandidat','password'));
        } else {
            return redirect()->back()->with('error',"Maaf Email atau Password anda salah. Silahkan coba lagi");
        }
    }

    // sistem simpan & ubah data kandidat password
    public function ubah_kandidat_password(Request $request)
    {
        $auth = Auth::user();
        $kandidat = Kandidat::where('referral_code',$auth->referral_code)->first();
        $user = User::where('email',$kandidat->email)->first();
        // apabila inputan password dengan konfirmasi password tidak sama
        if ($request->password_new !== $request->password_confirm) {
            return redirect('/edit_kandidat_password')->with('error',"Maaf, Password baru dengan Password konfirmasi anda tidak cocok. Harap teliti kembali.");
        // apabila password data pengguna dengan inputan password sama 
        } elseif($user->check_password == $request->password_new) {
            return redirect('/edit_kandidat_password')->with('error',"Maaf anda tidak bisa membuat password baru dengan password lama anda.");            
        } else {
            // merubah input password menjadi kode acak
            $hast = Hash::make($request->password_new);
            // memasukkan kode dan password baru ke data pengguna
            User::where('email',$kandidat->email)->update([
                'password' => $hast,
                'check_password' => $request->password_new,
            ]);
        }
        return redirect('isi_kandidat_personal')->with('success',"Password anda berhasil diperbarui.");
    }

    // halaman edit data kandidat no telp
    // public function ubah_kandidat_noTelp(Request $request)
    // {
    //     $id = Auth::user();
    //     $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
    //     User::where('referral_code',$id->referral_code)->update([
    //         'number_phone'=>$request->no_telp,
    //     ]);
    //     $verifyOTP = $this->confirmOTP($request->no_telp);

    //     $locate = "+62";
    //     $no_telp = $locate.$request->no_telp;

    //     // Your Account SID and Auth Token from console.twilio.com
    //     $sid = "ACb06a8933697ab7c78fb43bcb61277dda";
    //     $token = "bb18df3cb8e369ee635189c9fd3e0a22";

    //     $client = new Client($sid, $token);
    //     // Use the Client to make requests to the Twilio REST API
    //     $message = $client->messages->create(
    //         // The number you'd like to send the message to
    //         $no_telp,
    //         [
    //             // A Twilio phone number you purchased at https://console.twilio.com
    //             'from' => '+12294045420',
    //             // The body of the text message you'd like to send
    //             'body' => $verifyOTP->otp,
    //         ]
    //     );

    //     return view('kandidat/modalKandidat/otp_code',compact('kandidat'));
    // }

    // sistem pembuatan kode otp untuk no telp kandidat
    // public function confirmOTP()
    // {
    //     $id = Auth::user();
    //     $user = User::where('no_telp',$id->no_telp)->where('number_phone',$id->number_phone)->first();
    //     $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
    //     $verifyOTP = VerifyOTP::where('id',$user->id)->latest()->first();

    //     $now = Carbon::now();
    //     if($verifyOTP && $now->isBefore($verifyOTP->expire_at)){
    //         return $verifyOTP;
    //     }

    //     return VerifyOTP::create([
    //         'id' => $user->id,
    //         'otp' => rand(123456789, 999999),
    //         'expire_at' => Carbon::now()->addMinutes(10),
    //     ]);
    // }

    // sistem konfirmasi kode otp no telp
    // public function confirm_kandidat_OTP_Telp(Request $request)
    // {
    //     $id = Auth::user();
    //     $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
    //     $verifyOTP = VerifyOTP::where('id',$id->id)->where('otp',$request->otp)->first();
    //     $now = Carbon::now();
    //     if($verifyOTP && $now->isAfter($verifyOTP->expire_at)){
    //         return back()->with('error',"Masa berlaku Kode OTP telah habis");
    //     }

    //     $user = User::whereId($id->id)->first();
    //     return redirect()->route('document')->with('success',"No Telp anda diperbarui");
    // }

    // halaman isi data kandidat document / dokumen
    public function isi_kandidat_document()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code', $id->referral_code)->first();
        $kelurahan = Kelurahan::all();
        $kecamatan = Kecamatan::all();
        $kota = Kota::all();
        $provinsi = Provinsi::all();
        return view('kandidat/modalKandidat/edit_kandidat_document',compact('kandidat','kelurahan','kecamatan','kota','provinsi'));
    }

    // sistem simpan data document / dokumen
    public function simpan_kandidat_document(Request $request)
    {
        // sistem validasi input
        $validated = $request->validate([
            'rt' => 'required|max:3|min:3',
            'rw' => 'required|max:3|min:3',
            'foto_ktp' => 'image',
            'foto_kk' => 'image',
            'foto_set_badan' => 'image',
            'foto_4x6' => 'image',
            'foto_ket_lahir' => 'image',
            'foto_ijazah' => 'image',
        ]);
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code', $id->referral_code)->first();  
        // cek foto ktp
        // apabila ada input
        if($request->file('foto_ktp') !== null){
            // mencari data foto dan menghapus bila data foto ada
            $hapus_ktp = public_path('gambar/Kandidat/'.$kandidat->nama.'/KTP/').$kandidat->foto_ktp;
            if(file_exists($hapus_ktp)){
                @unlink($hapus_ktp);
            }
            // menyimpan file foto ke dalam aplikasi
            $ktp = $request->file('foto_ktp');  
            $simpan_ktp = $kandidat->nama.time().'.'.$ktp->extension();
            $ktp->move('gambar/Kandidat/'.$kandidat->nama.'/KTP/',$simpan_ktp);           
        } else {
            if($kandidat->foto_ktp !== null){
                $simpan_ktp = $kandidat->foto_ktp;
            } else {
                $simpan_ktp = null;
            }
        }
        // cek foto kk
        // apabila ada input
        if ($request->file('foto_kk') !== null) {    
            // mencari data foto dan menghapus bila data foto ada
            $hapus_kk = public_path('gambar/Kandidat/'.$kandidat->nama.'/KK/').$kandidat->foto_kk;
            if(file_exists($hapus_kk)){
                @unlink($hapus_kk);
            }
            // menyimpan file foto ke dalam aplikasi
            $kk = $request->file('foto_kk');
            $simpan_kk = $kandidat->nama.time().'.'.$kk->extension();  
            $kk->move('gambar/Kandidat/'.$kandidat->nama.'/KK/',$simpan_kk);
        } else {
            if ($kandidat->foto_kk !== null) {
                $simpan_kk = $kandidat->foto_kk;
            } else {
                $simpan_kk = null;
            }
        }
        // cek foto set badan
        // apabila ada input
        if($request->file('foto_set_badan') !== null){
            // mencari data foto dan menghapus bila data foto ada
            $hapus_set_badan = public_path('gambar/Kandidat/'.$kandidat->nama.'/Set_badan/').$kandidat->foto_set_badan;
            if(file_exists($hapus_set_badan)){
                @unlink($hapus_set_badan);
            }
            // menyimpan file foto ke dalam aplikasi
            $set_badan = $request->file('foto_set_badan');
            $simpan_set_badan = $kandidat->nama.time().'.'.$set_badan->extension();
            $set_badan->move('gambar/Kandidat/'.$kandidat->nama.'/Set_badan/',$simpan_set_badan);
        } else {
            if ($kandidat->foto_set_badan !== null) {
                $simpan_set_badan = $kandidat->foto_set_badan;   
            } else {
                $simpan_set_badan = null;    
            }
        }
        // cek foto 4x6
        // apabila ada input
        if($request->file('foto_4x6') !== null){
            // mencari data foto dan menghapus bila data foto ada
            $hapus_4x6 = public_path('gambar/Kandidat/'.$kandidat->nama.'/4x6/').$kandidat->foto_4x6;
            if(file_exists($hapus_4x6)){
                @unlink($hapus_4x6);
            }
            // menyimpan file foto ke dalam aplikasi
            $foto_4x6 = $request->file('foto_4x6');
            $simpan_foto_4x6 = $kandidat->nama.time().'.'.$foto_4x6->extension();  
            $foto_4x6->move('gambar/Kandidat/'.$kandidat->nama.'/4x6/',$simpan_foto_4x6);
        } else {
            if ($kandidat->foto_4x6 !== null) {
                $simpan_foto_4x6 = $kandidat->foto_4x6;
            } else {
                $simpan_foto_4x6 = null;
            }
        }
        // cek foto ket lahir
        // apabila ada input
        if($request->file('foto_ket_lahir') !== null){
            // mencari data foto dan menghapus bila data foto ada
            $hapus_ket_lahir = public_path('gambar/Kandidat/'.$kandidat->nama.'/Ket_lahir/').$kandidat->foto_ket_lahir;
            if(file_exists($hapus_ket_lahir)){
                @unlink($hapus_ket_lahir);
            }
            // menyimpan file foto ke dalam aplikasi
            $ket_lahir = $request->file('foto_ket_lahir');
            $simpan_ket_lahir = $kandidat->nama.time().'.'.$ket_lahir->extension();  
            $ket_lahir->move('gambar/Kandidat/'.$kandidat->nama.'/Ket_lahir/',$simpan_ket_lahir);
        } else {
            if ($kandidat->foto_ket_lahir !== null) {
                $simpan_ket_lahir = $kandidat->foto_ket_lahir;    
            } else {
                $simpan_ket_lahir = null;
            }
        }
        // cek foto ijazah
        // apabila ada input
        if($request->file('foto_ijazah') !== null){
            // mencari data foto dan menghapus bila data foto ada
            $hapus_ijazah = public_path('gambar/Kandidat/'.$kandidat->nama.'/Ijazah/').$kandidat->foto_ijazah;
            if(file_exists($hapus_ijazah)){
                @unlink($hapus_ijazah);
            }
            // menyimpan file foto ke dalam aplikasi
            $ijazah = $request->file('foto_ijazah');  
            $simpan_ijazah = $kandidat->nama.time().'.'.$ijazah->extension();
            $ijazah->move('gambar/Kandidat/'.$kandidat->nama.'/Ijazah',$simpan_ijazah);            
        } else {
            if ($kandidat->foto_ijazah !== null) {
                $simpan_ijazah = $kandidat->foto_ijazah;
            } else {
                $simpan_ijazah = null;                   
            }
        }
        // cek foto ktp jika ada
        if ($simpan_ktp !== null) {
            $foto_ktp = $simpan_ktp;
        } else {
            $foto_ktp = null;
        }
        // cek foto kk jika ada
        if ($simpan_kk !== null) {
            $foto_kk = $simpan_kk;
        } else {
            $foto_kk = null;
        }
        // cek foto set badan jika ada
        if ($simpan_set_badan !== null) {
            $foto_set_badan = $simpan_set_badan;
        } else {
            $foto_set_badan = null;
        }
        // cek foto 4x6 jika ada
        if ($simpan_foto_4x6 !== null) {
            $photo_4x6 = $simpan_foto_4x6;
        } else {
            $photo_4x6 = null;
        }
        // cek foto ket lahir jika ada
        if ($simpan_ket_lahir !== null) {
            $foto_ket_lahir = $simpan_ket_lahir;
        } else {
            $foto_ket_lahir = null;
        }
        // cek foto ijazah jika ada
        if ($simpan_ijazah !== null) {
            $foto_ijazah = $simpan_ijazah;
        } else {
            $foto_ijazah = null;
        }
        
        // mencari nama alamat dari inputan id 
        $provinsi = Provinsi::where('id',$request->provinsi_id)->first();
        $kota = Kota::where('id',$request->kota_id)->first();
        $kecamatan = Kecamatan::where('id',$request->kecamatan_id)->first();
        $kelurahan = kelurahan::where('id',$request->kelurahan_id)->first();

        // menambahkan ke data kandidat
        Kandidat::where('referral_code',$id->referral_code)->update([
            'pendidikan' => $request->pendidikan,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'dusun' => $request->dusun,
            'kelurahan' => $kelurahan->kelurahan,
            'kecamatan' => $kecamatan->kecamatan,
            'kabupaten' => $kota->kota,
            'provinsi' => $provinsi->provinsi,
            'foto_ktp' => $foto_ktp,
            'foto_kk' => $foto_kk,
            'foto_set_badan' => $foto_set_badan,
            'foto_4x6' => $photo_4x6,
            'foto_ket_lahir' =>$foto_ket_lahir,
            'foto_ijazah' => $foto_ijazah,
            'stats_nikah' => $request->stats_nikah
        ]);

        // apabila memilih menikah / kawin
        if ($request->stats_nikah == "Menikah") {
            return redirect()->route('family')
            // ->with('toast_success',"Data anda tersimpan");
            ->with('success',"Data anda tersimpan");
        
        // apabila memilih cerai hidup
        } elseif($request->stats_nikah == "Cerai hidup"){
            
            // mereset data keluarga / family sebelumnya 
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
            // mereset data keluarga / family sebelumnya 
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
            // mereset data keluarga / family sebelumnya 
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

    // halaman isi data kandidat keluarga / family
    public function isi_kandidat_family()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $keluarga = DataKeluarga::where('id_kandidat',$kandidat->id_kandidat)->get();
        
        // update data usia anak
        if($keluarga->count() !== 0){
            foreach($keluarga as $key){
                $usia = Carbon::parse($key->tgl_lahir_anak)->age;
                DataKeluarga::where('id_keluarga',$key->id_keluarga)->update([
                    'usia' => $usia,
                ]);
            }
        }
        if ($kandidat->stats_nikah == null) {
            return redirect()->route('vaksin');
        } elseif($kandidat->stats_nikah !== "Single") {
            return view('kandidat/modalKandidat/edit_kandidat_family',compact('kandidat','keluarga'));    
        } else {
            return redirect('/isi_kandidat_vaksin');
        }
    }

    // sistem tambah & simpan data kandidat anak (jika sudah punya)
    public function simpan_kandidat_anak(Request $request)
    {
        // mencari data pengguna yang saat ini login / masuk
        $user = Auth::user();
        // mencari data kandidat
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        // mencari data anak dengan input tanggal lahir
        $age = Carbon::parse($request->tgl_lahir_anak)->age;

        // membuat data keluarga
        DataKeluarga::create([
            'id_kandidat' => $kandidat->id_kandidat,
            'nama_kandidat' => $kandidat->nama,
            'anak_ke' => $request->anak_ke,
            'jenis_kelamin' => $request->jk,
            'tgl_lahir_anak' => $request->tgl_lahir_anak,
            'usia' => $age,    
        ]);
        return redirect()->back()->with('success',"Data ditambahkan");
    }

    // sistem simpan data kandidat family / keluarga
    public function simpan_kandidat_family(Request $request)
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $keluarga = DataKeluarga::where('id_kandidat',$kandidat->id_kandidat)->get();
        $id_anak = $request->id_anak;
        $tgl_anak = $request->tgl_anak;
        $anak_lk = 0;
        $anak_pr = 0;

        // menghitung data anak kandidat
        foreach($keluarga as $data){
            if($data->jenis_kelamin == "M"){
                $data_lk = DataKeluarga::where('jenis_kelamin',"M")->where('id_kandidat',$kandidat->id_kandidat)->get();
                $anak_lk = count($data_lk);
            } elseif($data->jenis_kelamin == "F") {
                $data_pr = DataKeluarga::where('jenis_kelamin',"F")->where('id_kandidat',$kandidat->id_kandidat)->get();
                $anak_pr = count($data_pr);
            }
        }
        // cek buku nikah
        // apabila ada input
        if($request->file('foto_buku_nikah') !== null){
            // cek foto sebelumnya dan hapus jika ada
            $hapus_buku_nikah = public_path('gambar/Kandidat/'.$kandidat->nama.'/Buku Nikah/').$kandidat->foto_buku_nikah;
            if(file_exists($hapus_buku_nikah)){
                @unlink($hapus_buku_nikah);
            }
            // memasukkan file ke dalam aplikasi
            $buku_nikah = $request->file('foto_buku_nikah');  
            $simpan_buku_nikah = $kandidat->nama.time().'.'.$buku_nikah->extension();
            $buku_nikah->move('gambar/Kandidat/'.$kandidat->nama.'/Buku Nikah/',$simpan_buku_nikah);
        } else {
            if($kandidat->foto_buku_nikah !== null){
                $simpan_buku_nikah = $kandidat->foto_buku_nikah;
            } else {
                $simpan_buku_nikah = null;
            }
        }
        // cek buku cerai hidup
        // apabila ada input
        if($request->file('foto_cerai') !== null){
            // cek foto sebelumnya dan hapus jika ada
            $hapus_foto_cerai = public_path('gambar/Kandidat/'.$kandidat->nama.'/Cerai/').$kandidat->foto_cerai;
            if(file_exists($hapus_foto_cerai)){
                @unlink($hapus_foto_cerai);
            }
            // memasukkan file ke dalam aplikasi
            $cerai = $request->file('foto_cerai');  
            $simpan_cerai = $kandidat->nama.time().'.'.$cerai->extension();
            $cerai->move('gambar/Kandidat/'.$kandidat->nama.'/Cerai/',$simpan_cerai);
        } else {
            if($kandidat->foto_cerai !== null){
                $simpan_cerai = $kandidat->foto_cerai;
            } else {
                $simpan_cerai = null;
            }
        }
        // cek buku foto kematian pasangan
        // apabila ada input
        if($request->file('foto_kematian_pasangan') !== null){
            // cek foto sebelumnya dan hapus jika ada
            $hapus_kematian_pasangan = public_path('gambar/Kandidat/'.$kandidat->nama.'/Kematian Pasangan/').$kandidat->foto_kematian_pasangan;
            if(file_exists($hapus_kematian_pasangan)){
                @unlink($hapus_kematian_pasangan);
            }
            // memasukkan file ke dalam aplikasi
            $kematian_pasangan = $request->file('foto_kematian_pasangan');  
            $simpan_kematian_pasangan = $kandidat->nama.time().'.'.$kematian_pasangan->extension();
            $kematian_pasangan->move('gambar/Kandidat/'.$kandidat->nama.'/Kematian Pasangan/',$simpan_kematian_pasangan);
        } else {
            if($kandidat->foto_kematian_pasangan !== null){
                $simpan_kematian_pasangan = $kandidat->foto_kematian_pasangan;
            } else {
                $simpan_kematian_pasangan = null;
            }
        }
        // cek buku nikah jika sudah ada
        if($simpan_buku_nikah !== null){
            $foto_buku_nikah = $simpan_buku_nikah;
        } else {
            $foto_buku_nikah = null;
        }
        // cek buku cerai jika sudah ada        
        if($simpan_cerai !== null){
            $foto_cerai = $simpan_cerai;
        } else {
            $foto_cerai = null;
        }
        // cek buku kematian pasangan jika sudah ada
        if($simpan_kematian_pasangan !== null){
            $foto_kematian_pasangan = $simpan_kematian_pasangan;
        } else {
            $foto_kematian_pasangan = null;
        }
        // mencari umur pasangan melalui tgl lahir pasangan
        $umur = Carbon::parse($request->tgl_lahir_pasangan)->age;

        // menambahkan ke data kandidat
        Kandidat::where('referral_code', $id->referral_code)->update([
            'foto_buku_nikah' => $foto_buku_nikah,
            'nama_pasangan' => $request->nama_pasangan,
            'umur_pasangan' => $umur,
            'tgl_lahir_pasangan' => $request->tgl_lahir_pasangan,
            'pekerjaan_pasangan' => $request->pekerjaan_pasangan,
            'jml_anak_lk' => $anak_lk,
            'umur_anak_lk' => $request->umur_anak_lk,
            'jml_anak_pr' => $anak_pr,
            'umur_anak_pr' => $request->umur_anak_pr,
            'foto_cerai' => $foto_cerai,
            'foto_kematian_pasangan' => $foto_kematian_pasangan,
        ]);
        //update data usia anak
        if($id_anak !== null){
            for($a = 0; $a < count($id_anak); $a++){
                $usia = Carbon::parse($tgl_anak[$a])->age;
                DataKeluarga::where('id_keluarga',$id_anak[$a])->update([
                    'usia' => $usia,
                ]);
            }
        }
        return redirect('/isi_kandidat_vaksin')
        // ->with('toast_success',"Data anda tersimpan");
        ->with('success',"Data anda tersimpan");
    }

    // halaman isi data kandidat vaksin
    public function isi_kandidat_vaksin()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code', $id->referral_code)->first(); 
        return view('kandidat/modalKandidat/edit_kandidat_vaksinasi',['kandidat'=>$kandidat]);
    }

    // sistem simpan data kandidat vaksin
    public function simpan_kandidat_vaksin(Request $request)
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        // cek vaksin1
        // apabila ada input
        if($request->file('sertifikat_vaksin1') !== null){
            // cek foto sebelumnya dan hapus jika ada
            $hapus_sertifikat_vaksin1 = public_path('gambar/Kandidat/'.$kandidat->nama.'/Vaksin Pertama/').$kandidat->sertifikat_vaksin1;
            if(file_exists($hapus_sertifikat_vaksin1)){
                @unlink($hapus_sertifikat_vaksin1);
            }
            // memasukkan file ke dalam aplikasi
            $sertifikat_vaksin1 = $request->file('sertifikat_vaksin1');  
            $simpan_sertifikat_vaksin1 = $kandidat->nama.time().'.'.$sertifikat_vaksin1->extension();
            $sertifikat_vaksin1->move('gambar/Kandidat/'.$kandidat->nama.'/Vaksin Pertama/',$simpan_sertifikat_vaksin1);
        } else {
            if($kandidat->sertifikat_vaksin1 !== null){
                $simpan_sertifikat_vaksin1 = $kandidat->sertifikat_vaksin1;
            } else {
                $simpan_sertifikat_vaksin1 = null;
            }
        }
        // cek vaksin2
        // apabila ada input
        if($request->file('sertifikat_vaksin2') !== null){
            // cek foto sebelumnya dan hapus jika ada
            $hapus_sertifikat_vaksin2 = public_path('gambar/Kandidat/'.$kandidat->nama.'/Vaksin Kedua/').$kandidat->sertifikat_vaksin2;
            if(file_exists($hapus_sertifikat_vaksin2)){
                @unlink($hapus_sertifikat_vaksin2);
            }
            // memasukkan file ke dalam aplikasi
            $sertifikat_vaksin2 = $request->file('sertifikat_vaksin2');  
            $simpan_sertifikat_vaksin2 = $kandidat->nama.time().'.'.$sertifikat_vaksin2->extension();
            $sertifikat_vaksin2->move('gambar/Kandidat/'.$kandidat->nama.'/Vaksin Kedua/',$simpan_sertifikat_vaksin2);    
        } else {
            if($kandidat->sertifikat_vaksin2 !== null){
                $simpan_sertifikat_vaksin2 = $kandidat->sertifikat_vaksin2;
            } else {
                $simpan_sertifikat_vaksin2 = null;
            }
        }
        // cek vaksin3
        // apabila ada input
        if($request->file('sertifikat_vaksin3') !== null){
            // cek foto sebelumnya dan hapus jika ada
            $hapus_sertifikat_vaksin3 = public_path('gambar/Kandidat/'.$kandidat->nama.'/Vaksin Ketiga/').$kandidat->sertifikat_vaksin3;
            if(file_exists($hapus_sertifikat_vaksin3)){
                @unlink($hapus_sertifikat_vaksin3);
            }
            // memasukkan file ke dalam aplikasi
            $sertifikat_vaksin3 = $request->file('sertifikat_vaksin3');  
            $simpan_sertifikat_vaksin3 = $kandidat->nama.time().'.'.$sertifikat_vaksin3->extension();
            $sertifikat_vaksin3->move('gambar/Kandidat/'.$kandidat->nama.'/Vaksin Ketiga/',$simpan_sertifikat_vaksin3);
        } else {
            if($kandidat->sertifikat_vaksin3 !== null){
                $simpan_sertifikat_vaksin3 = $kandidat->sertifikat_vaksin3;
            } else {
                $simpan_sertifikat_vaksin3 = null;
            }
        }
        // cek jika foto ada atau tidak
        if($simpan_sertifikat_vaksin1 !== null){
            $foto_sertifikat_vaksin1 = $simpan_sertifikat_vaksin1;
        } else {
            $foto_sertifikat_vaksin1 = null;
        }
        // cek jika foto ada atau tidak
        if($simpan_sertifikat_vaksin2 !== null){
            $foto_sertifikat_vaksin2 = $simpan_sertifikat_vaksin2;
        } else {
            $foto_sertifikat_vaksin2 = null;
        }
        // cek jika foto ada atau tidak
        if($simpan_sertifikat_vaksin3 !== null){
            $foto_sertifikat_vaksin3 = $simpan_sertifikat_vaksin3;
        } else {
            $foto_sertifikat_vaksin3 = null;
        }
        // mencari data pengguna yang saat ini login / masuk
        $id = Auth::user();
        // menambahkan ke data kandidat
        Kandidat::where('referral_code', $id->referral_code)->update([
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
        return redirect('/isi_kandidat_parent')
        // ->with('toast_success',"Data anda tersimpan");
        ->with('success',"Data anda tersimpan");
    }

    // halaman isi data kandidat parent / orang tua
    public function isi_kandidat_parent()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code', $id->referral_code)->first();
        return view('kandidat/modalKandidat/edit_kandidat_parent',['kandidat'=>$kandidat]);
    }

    // sistem simpan data kandidat parent / orang tua
    public function simpan_kandidat_parent(Request $request)
    {
        // sistem validasi inputan
        $validated = $request->validate([
            'rt' => 'required|max:3|min:3',
            'rw' => 'required|max:3|min:3',
        ]);
        $id = Auth::user();

        $provinsi = Provinsi::where('id',$request->provinsi_id)->first();
        $kota = Kota::where('id',$request->kota_id)->first();
        $kecamatan = Kecamatan::where('id',$request->kecamatan_id)->first();
        $kelurahan = kelurahan::where('id',$request->kelurahan_id)->first();

        // mencari umur ayah melalui tgl lahir
        if($request->ket_keadaan_ayah == "hidup"){
            $tgl_lahir_ayah = $request->tgl_lahir_ayah;
            $umurAyah = Carbon::parse($request->tgl_lahir_ayah)->age;
        } else {
            $tgl_lahir_ayah = null;
            $umurAyah = null;
        }

        // mencari umur ayah melalui tgl lahir
        if($request->ket_keadaan_ibu == "hidup"){
            $tgl_lahir_ibu = $request->tgl_lahir_ibu;
            $umurIbu = Carbon::parse($request->tgl_lahir_ibu)->age;
        } else {
            $tgl_lahir_ibu = null;
            $umurIbu = null;
        }

        Kandidat::where('referral_code', $id->referral_code)->update([
            'nama_ayah' => $request->nama_ayah,
            'umur_ayah' => $umurAyah,
            'tgl_lahir_ayah' => $tgl_lahir_ayah,
            'tmp_lahir_ayah' => $request->tmp_lahir_ayah,
            'nama_ibu' => $request->nama_ibu,
            'umur_ibu' => $umurIbu,
            'tgl_lahir_ibu' => $tgl_lahir_ibu,
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

    // halaman isi data kandidat company / pengalaman kerja
    public function isi_kandidat_company()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code', $id->referral_code)->first();
        $pengalaman_kerja = PengalamanKerja::where('id_kandidat',$kandidat->id_kandidat)->get();
        return view('kandidat/modalKandidat/edit_kandidat_company', [
            'kandidat'=>$kandidat,
            'pengalaman_kerja'=>$pengalaman_kerja,
        ]);
    }

    // sistem tambah pengalaman kerja
    public function tambahPengalamanKerja(Request $request)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $jabatan = $request->jabatan;
        $video_kandidat = PengalamanKerja::where('id_kandidat',$kandidat->id_kandidat)->first();
        
        // simpan data video jika ada
        if($request->file('video') !== null){
            $video = $request->file('video');
            $simpan_video = $kandidat->nama.$jabatan.$video->getClientOriginalName();
            $video->move('gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/',$simpan_video);
        } else {
            $simpan_video = null;
        }
        // pengecekan jika data video ada
        if($simpan_video !== null){
            $video_pengalaman = $simpan_video;
        } else {
            $video_pengalaman = null;
        }

        // simpan data foto jika ada
        if($request->file('foto') !== null){
            $foto = $request->file('foto');  
            $simpan_foto = $kandidat->nama.time().'.'.$foto->extension();
            $foto->move('gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/',$simpan_foto);
        } else {            
            $simpan_foto = null;
        }
        // pengecekan jika data foto ada
        if($simpan_foto !== null){
            $foto_pengalaman = $simpan_foto;
        } else {
            $foto_pengalaman = null;
        }
        // mencari interval bekerja dari awal tahun sampai akhir tahun
        $periodeAwal = new \Datetime($request->periode_awal);
        $periodeAkhir = new \DateTime($request->periode_akhir);
        $tahun = $periodeAkhir->diff($periodeAwal)->y;

        // membuat data pengalaman kerja
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

        // sistem simpan data video (jika terdeteksi)
        // if($request->type == "video"){
        //     VideoKerja::create([
        //         'video' => $video_pengalaman,
        //         'pengalaman_kerja_id' => $pengalaman->id,
        //         'jabatan' => $request->jabatan,
        //     ]);
        // sistem simpan data foto (jika terdeteksi)
        // } elseif($request->type == "foto") {
        //     FotoKerja::create([
        //         'foto'=> $foto_pengalaman,
        //         'pengalaman_kerja_id' => $pengalaman->id,
        //         'jabatan'=>$request->jabatan,
        //     ]);
        // }
        
        return redirect()->route('company')
        // ->with('toast_success',"Data anda tersimpan");
        ->with('success',"Data anda tersimpan");
    }

    // halaman lihat pengalaman kerja
    public function lihatPengalamanKerja($id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $pengalaman = PengalamanKerja::where('pengalaman_kerja_id',$id)->first();
        $video = VideoKerja::where('pengalaman_kerja_id',$id)->get();
        $foto = FotoKerja::where('pengalaman_kerja_id',$id)->get();
        return view('kandidat/modalKandidat/lihat_pengalaman_kerja',compact('kandidat','pengalaman','id','video','foto'));
    }

    // halaman tambah video / foto, portofolio
    public function tambahPortofolio($id, $type)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $code = "tambah";
        // apabila inputan berisi "video"
        if($type == "video"){
            return view('kandidat/modalKandidat/video_kerja',compact('kandidat','code','id'));
        // apabila inputan berisi "foto"
        } elseif($type == "foto") {
            return view('kandidat/modalKandidat/foto_kerja',compact('kandidat','code','id'));
        } 
    }

    // sistem simpan data portofolio
    public function simpanPortofolio(Request $request,$id,$type)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $pengalaman = PengalamanKerja::where('pengalaman_kerja_id',$id)->first(); 
        // apabila terdeteksi file video
        if($type == "video"){
            if($request->file('video') !== null){
                $validated = $request->validate([
                    'video' => 'mimes:mp4,mov,ogg,qt',
                ]);
                $video_kerja = $request->file('video');
                $simpan_kerja = $kandidat->nama.$pengalaman->jabatan.$video_kerja->getClientOriginalName();
                $video_kerja->move('gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/',$simpan_kerja);
            } else {
                $simpan_kerja = null;
            }
    
            if($simpan_kerja !== null){
                $video = $simpan_kerja;
            } else {
                $video = null;
            }
            // membuat data video
            VideoKerja::create([
                'video' => $video,
                'pengalaman_kerja_id' => $pengalaman->pengalaman_kerja_id,
                'jabatan' => $pengalaman->jabatan,
            ]);
        // apabila terdeteksi file foto
        } elseif($type == "foto"){
            if($request->file('foto') !== null){
                $foto_kerja = $request->file('foto');  
                $simpan_foto_kerja = $kandidat->nama.time().'.'.$request->foto->extension();
                $foto_kerja->move('gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/',$simpan_foto_kerja);
            } else {            
                $simpan_foto_kerja = null;
            }
    
            if($simpan_foto_kerja !== null){
                $foto = $simpan_foto_kerja;
            } else {
                $foto = null;
            }
            // membuat data foto
            FotoKerja::create([
                'foto' => $foto,
                'pengalaman_kerja_id' => $pengalaman->pengalaman_kerja_id,
                'jabatan' => $pengalaman->jabatan,
            ]);
        }
        return redirect('/lihat_kandidat_pengalaman_kerja/'.$id)->with('success',"Portofolio ditambahkan");      
    }

    // halaman edit data portofolio
    public function editPortofolio($id,$type)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $foto = FotoKerja::where('foto_kerja_id',$id)->first();
        $video = VideoKerja::where('video_kerja_id',$id)->first();
        $code = "edit";
        // apabila inputan berisi "video"
        if($type == "video"){
            return view('kandidat/modalKandidat/video_kerja',compact('kandidat','video','code'));
        // apabila inputan berisi "foto"
        } elseif($type == "foto") {
            return view('kandidat/modalKandidat/foto_kerja',compact('kandidat','foto','code'));
        } else {
            return back();
        }
    }

    // sistem edit data file portofolio
    public function ubahPortofolio(Request $request,$id,$type)
    {   
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        // apabila video
        if($type == "video"){
            $video = VideoKerja::where('video_kerja_id',$id)->first();
            if($request->file('video') !== null){
                $validated = $request->validate([
                    'video' => 'mimes:mp4,mov,ogg,qt',
                ]);
                // cek data sebelumnya dan hapus jika ada
                $hapus_video_kerja = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/').$video->video;
                if(file_exists($hapus_video_kerja)){
                    @unlink($hapus_video_kerja);
                }
                // masukkan data di aplikasi
                $video_kerja = $request->file('video');
                $simpan_kerja = $kandidat->nama.$video_kerja->getClientOriginalName();
                $video_kerja->move('gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/',$simpan_kerja);
            } else {
                if($video->video !== null){
                    $simpan_kerja = $video->video;
                } else {
                    $simpan_kerja = null;
                }
            }
            // pengecekan data file
            if($simpan_kerja !== null){
                $video_pengalaman = $simpan_kerja;
            } else {
                $video_pengalaman = null;
            }
            // merubah data video lama dengan yang baru
            VideoKerja::where('video_kerja_id',$id)->update([
                'video'=>$video_pengalaman,
            ]);
            return redirect('/lihat_kandidat_pengalaman_kerja/'.$video->pengalaman_kerja_id)->with('success',"Data diubah");
        // apabila foto
        } elseif($type == "foto"){
            $foto = FotoKerja::where('foto_kerja_id',$id)->first();
            if($request->file('foto') !== null){
                // cek data sebelumnya dan hapus jika ada
                $hapus_foto = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/').$foto->foto;
                if(file_exists($hapus_foto)){
                    @unlink($hapus_foto);
                }
                // memasukkan data file ke aplikasi
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
            // merubah data foto lama dengan yang baru
            FotoKerja::where('foto_kerja_id',$id)->update([
                'foto'=>$foto_pengalaman,
            ]);
            return redirect('/lihat_kandidat_pengalaman_kerja/'.$foto->pengalaman_kerja_id)->with('success',"Data diubah");
        }
    }

    // hapus portofolio
    public function hapusPortofolio($id,$type)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        // apabila inputan berisi "video"
        if($type == "video"){
            // mencari video kerja melalui id
            $video = VideoKerja::where('video_kerja_id',$id)->first();
            // mencari id pengalaman kerja dari data video
            $pengalaman = PengalamanKerja::where('pengalaman_kerja_id',$video->pengalaman_kerja_id)->first();
            // mencari file dan menghapus bila file ada
            $hapus_video_kerja = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/').$video->video;
                if(file_exists($hapus_video_kerja)){
                    @unlink($hapus_video_kerja);
                }
            // menghapus data video dengan id
            VideoKerja::where('video_kerja_id',$id)->delete();
        // apabila inputan berisi "foto"
        } elseif($type == "foto"){
            // mencari foto kerja melalui id
            $foto = FotoKerja::where('foto_kerja_id',$id)->first();
            // mencari id pengalaman kerja dari data video
            $pengalaman = PengalamanKerja::where('pengalaman_kerja_id',$foto->pengalaman_kerja_id)->first();
            // mencari file dan menghapus bila file ada
            $hapus_foto = public_path('/gambar/Kandidat/'.$kandidat->nama.'/Pengalaman Kerja/').$foto->foto;
                if(file_exists($hapus_foto)){
                    @unlink($hapus_foto);
                }
            // menghapus data video dengan id
            FotoKerja::where('foto_kerja_id',$id)->delete();
        }
        return redirect('/lihat_kandidat_pengalaman_kerja/'.$pengalaman->pengalaman_kerja_id)->with('success',"Data Telah dihapus");
    }

    // halaman edit data pengalaman kerja
    public function editPengalamanKerja($id)
    {
        $pengalaman_kerja = PengalamanKerja::where('pengalaman_kerja_id',$id)->first();
        return view('kandidat/modalKandidat/edit_pengalaman_kerja', compact('pengalaman_kerja'));
    }

    // sistem ubah data pengalaman kerja
    public function updatePengalamanKerja(Request $request, $id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $video_kandidat = PengalamanKerja::where('id_kandidat',$kandidat->id_kandidat)->first();

        // mencari interval bekerja dari awal tahun sampai akhir tahun
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

    // hapus pengalaman kerja
    public function hapusPengalamanKerja($id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $pengalaman = PengalamanKerja::where('pengalaman_kerja_id',$id)->first();
        
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
        // mengapus data video kerja dari id pengalaman kerja
        VideoKerja::where('pengalaman_kerja_id',$pengalaman->pengalaman_kerja_id)->delete();
        // mengapus data foto kerja dari id pengalaman kerja
        FotoKerja::where('pengalaman_kerja_id',$pengalaman->pengalaman_kerja_id)->delete();    
        // mengapus data pengalaman kerja dengan id
        PengalamanKerja::where('pengalaman_kerja_id',$id)->delete();
        return redirect()->route('company')->with('success',"Data berhasi dihapus");
    }

    // sistem simpan data pengalaman kerja
    public function simpan_kandidat_company(Request $request)
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $jabatan = $request->jabatan;
        $lama_kerja = $request->lama_kerja;
        // merubah data array menjadi string
        if($jabatan !== null){
            $jabatanValues = implode(", ",$jabatan);
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

    // halaman isi data kandidat permission / kontak darurat
    public function isi_kandidat_permission()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code', $id->referral_code)->first();
        $provinsi = Provinsi::all();
        $kota = Kota::all();
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();
        // mendeteksi data kandidat apabila memiliki anak di atas 17 thn
        $hubungan_anak = DataKeluarga::where('id_kandidat',$kandidat->id_kandidat)->where('usia','>=',17)->first();
        if($hubungan_anak){
            $anak = $hubungan_anak;
        } else {
            $anak = null;
        }
        return view('kandidat/modalKandidat/edit_kandidat_permission',compact('kandidat','provinsi','kecamatan','kelurahan','kota','anak'));
    }

    // sistem simpan data kandidat permission / kontak darurat
    public function simpan_kandidat_permission(Request $request)
    {
        $validated = $request->validate([
            'rt_perizin' => 'required|max:3|min:3',
            'rw_perizin' => 'required|max:3|min:3',
            'nik_perizin' => 'required|max:16|min:16',
            'foto_ktp_izin' => 'image',
            'no_telp_perizin' => 'min:10|max:13'
        ]);
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        // cek foto ktp izin
        if($request->file('foto_ktp_izin') !== null){

            $hapus_foto_ktp_izin = public_path('gambar/Kandidat/'.$kandidat->nama.'/KTP Perizin/').$kandidat->foto_ktp_izin;
            if(file_exists($hapus_foto_ktp_izin)){
                @unlink($hapus_foto_ktp_izin);
            }

            $ktp_izin = $request->file('foto_ktp_izin');
            $simpan_ktp_izin = $kandidat->nama.time().'.'.$ktp_izin->extension();
            $ktp_izin->move('gambar/Kandidat/'.$kandidat->nama.'/KTP Perizin/',$simpan_ktp_izin);
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
            'rt_perizin' => $request->rt_perizin,
            'rw_perizin' => $request->rw_perizin,
            'dusun_perizin' => $request->dusun_perizin,
            'kelurahan_perizin' => $kelurahan->kelurahan,
            'kecamatan_perizin' => $kecamatan->kecamatan,
            'kabupaten_perizin' => $kota->kota,
            'provinsi_perizin' => $provinsi->provinsi,
            'negara_perizin' => "Indonesia",
            'foto_ktp_izin' => $foto_ktp_izin,
            'hubungan_perizin' => $request->hubungan_perizin
        ]);
        // apabila kandidat memiliki passport
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

    // halaman isi data kandidat passport
    public function isi_kandidat_paspor()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();

        if($kandidat->no_paspor == null){
            return redirect()->route('kandidat');
        } else {
            return view('kandidat/modalKandidat/edit_kandidat_paspor',compact('kandidat'));
        }
    }

    // sistem simpan data kandidat passport
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
        return redirect('/kandidat')->with('success',"Data anda tersimpan");
    }

    // Ajax seleksi penempatan negara luar negeri
    public function placement(Request $request)
    {
        $data = Negara::where('negara_id','not like',2)->get();
        return response()->json($data);
    }

    // sistem simpan data kandidat penempatan negara tujuan bekerja
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

    // halaman hub. kami / bantuan bagian kandidat
    public function contactUsKandidat()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $notif = NotifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $pembayaran = Pembayaran::where('id_kandidat',$kandidat->id_kandidat)->first();
        return view('kandidat/contact_us',compact('kandidat','notif','pembayaran','pesan'));
    }

    // proses kirim pesan contact us kandidat
    public function sendContactUsKandidat(Request $request)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        ContactUsKandidat::create([
            'id_kandidat' => $kandidat->id_kandidat,
            'dari' => $kandidat->nama,
            'isi' => $request->isi,
            'balas' => "belum dibaca",
        ]);
        return redirect('/contact_us_kandidat')->with('success',"Pesan telah terkirim");
    }

    // halaman data video pelatihan untuk kandidat
    public function videoPelatihan()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $notif = NotifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $video = Pelatihan::where('negara_id',$kandidat->negara_id)->get();
        return view('kandidat/video_pelatihan',compact('kandidat','notif','pesan','video'));
    }

    // halaman lihat video pelatihan kandidat
    public function lihatVideoPelatihan($id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $notif = NotifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $video = Pelatihan::where('id',$id)->first();
        $pelatihan = Pelatihan::where('negara_id',$kandidat->negara_id)->where('id','not like',$id)->get();
        return view('kandidat/lihat_video_pelatihan',compact('kandidat','notif','pesan','video','pelatihan'));
    }

    // halaman data pesan kandidat
    public function messageKandidat()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $semua_pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->get();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $notif = notifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->where('check_click',"n")->get();
        return view('kandidat/semua_pesan',compact('kandidat','pesan','semua_pesan','notif'));
    }

    // halaman lihat pesan kandidat
    public function sendMessageKandidat($id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $notif = NotifyKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('created_at','desc')->where('check_click',"n")->get();
        messageKandidat::where('id',$id)->update([
            'check_click' => 'y',
        ]);
        $pengirim = messageKandidat::where('id',$id)->first();
        $pesan = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->where('pengirim','not like',$kandidat->nama)->orderBy('created_at','desc')->where('check_click',"n")->get();
        return view('kandidat/lihat_pesan',compact('kandidat','pesan','notif','pengirim','id'));
    }

    // sistem hapus pesan kandidat
    public function deleteMessageKandidat($id)
    {
        $user = Auth::user();
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        $hapus_pesan = messageKandidat::where('id',$id)->delete();
        return redirect('/semua_pesan')->with('success',"Pesan telah dihapus");
    }

    // halaman surat izin & ahli waris
    public function izinWaris()
    {
        $tgl_print = Carbon::now()->isoFormat('D MMM Y');
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $perusahaan = Perusahaan::where('id_perusahaan',$kandidat->id_perusahaan)->first();
        if($kandidat->penempatan == null)
        {
            return redirect('/kandidat');
        }
        $tgl_user = Carbon::create($kandidat->tgl_lahir)->isoFormat('D MMM Y');
        $tgl_perizin = Carbon::create($kandidat->tgl_lahir_perizin)->isoFormat('D MMM Y');
        // dd($tmp_user->cityName);
        $negara = Negara::join(
            'kandidat', 'ref_negara.negara_id','=','kandidat.negara_id'
        )
        ->where('kandidat.referral_code',$id->referral_code)
        ->first();
        return view('kandidat/output_izin_waris',compact(
            'kandidat',
            'tgl_print',
            'tgl_user',
            'tgl_perizin',
            'negara',
            'perusahaan',
        ));
    }
}
