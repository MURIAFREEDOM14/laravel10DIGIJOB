<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Noreply;
use App\Mail\Verification;
use App\Mail\VerifyPassword;
use App\Models\ContactUsKandidat;
use App\Models\VerifikasiDiri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Kandidat;
use App\Models\Akademi;
use App\Models\Perusahaan;
use App\Models\Notification;
use App\Mail\DemoMail;
use Illuminate\Support\Facades\Mail;
use App\Models\messageAkademi;
use App\Models\messageKandidat;
use App\Models\messagePerusahaan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class VerifikasiController extends Controller
{
    // sistem kirim ulang email verifikasi
    public function ulang_verifikasi()
    {
        $user = Auth::user();
        // apabila token / kode kosong
        if($user->token == null){
            // membuat kode / token
            $token = Str::random(32).$user->no_telp;
            // menambahkan token ke dalam data pengguna
            User::where('referral_code',$user->referral_code)->update([
                'token' => $token,
            ]);
            // mencari data pengguna      
            $newUser = User::where('referral_code',$user->referral_code)->first();
            // mengambi data token / kode dari data pengguna
            $newToken = $newUser->token;
        // apabila token / kode ada
        } else {
            // mengambil dari data pengguna
            $newToken = $user->token;   
        }
        $text = $user->referral_code;
        // cek apabila pengguna = kandidat
        if($user->type == 0){
            $nama = $user->name;
        // cek apabila pengguna = akademi
        } elseif($user->type == 1){
            $nama = $user->name_perusahaan;
        // cek apabila pengguna = perusahaan
        } elseif($user->type == 2){
            $nama = $user->name_perusahaan;
        // cek apabila pengguna selain ket. diatas
        } else {
            $nama = null;
        }
        
        // apabila password pengguna kosong
        if($user->password == null){
            // mengirim data email verifikasi password
            Mail::mailer('verification')->to($user->email)->send(new VerifyPassword($nama, 'no-reply@ugiport.com', $newToken, $text, 'Verifikasi Lupa Password'));
            // mengirim data email verifilasi
        } else {
            Mail::mailer('verification')->to($user->email)->send(new Verification($nama, $newToken, 'Email Verifikasi', 'no-reply@ugiport.com'));
        }
        // menuju halaman verifikasi selagi menunggu pesan email terverifikasi
        return redirect()->route('verifikasi')->with('success',"pesan email dikirim ulang");
    }

    // pengecekan verifikasi email dari pesan email / Gmail
    public function verifyAccount($token)
    {
        // mencari pengguna
        $verifyUser = User::where('token',$token)->first();
        
        // apabila data tidak kosong / ada
        if(!is_null($verifyUser)){
            // apabila pengguna adalah kandidat
            if($verifyUser->type == 0) {
                // membuat kode baru
                $newKode = \Hashids::encode($verifyUser->id.$verifyUser->no_telp);
                // menambahkan kode ke dalam data pengguna
                User::where('token',$token)->update([
                    'verify_confirmed' => $newKode,
                    'referral_code' => $newKode,
                ]);
                // menambahkan kode ke dalam data kandidat
                Kandidat::where('id',$verifyUser->id)->update([
                    'referral_code' => $newKode,
                ]);
                // mencari data kandidat
                $kandidat = Kandidat::where('referral_code',$verifyUser->referral_code)->first(); 
                // mencari data pengguna yang sedang login / masuk
                $user = Auth::user();
                // kondisi kandidat lupa password
                if($user->password == null){
                    // mengirimkan pesan aplikasi
                    $data['id_kandidat'] = $kandidat->id_kandidat;
                    $data['pesan'] = "Selamat datang kembali ".$user->name;
                    $data['pengirim'] = "Admin";
                    $data['kepada'] = $user->name;
                    messageKandidat::create($data);
                    // menuju halaman untuk verifikasi kode dan membuat password baru
                    return redirect('/user_code_id')->with('success',"Akun anda teridentifikasi");
                // kondisi kandidat baru daftar
                } else {
                    // // mengirimkan pesan aplikasi
                    $data['id_kandidat'] = $kandidat->id_kandidat;
                    $data['pesan'] = "Harap lengkapi data profil anda";
                    $data['pengirim'] = "Admin";
                    $data['kepada'] = $user->name;
                    messageKandidat::create($data);
                    // menuju halaman kandidat
                    return redirect()->route('kandidat')->with('success',"Selamat Datang");
                }
            // apabila pengguna adalah akademi
            } elseif($verifyUser->type == 1) {
                // membuat kode kunci (tipe integer / angka)
                $newKode = \Hashids::encode($verifyUser->id.$verifyUser->no_nis);
                // menambahkan kode ke dalam data pengguna
                User::where('token',$token)->update([
                    'verify_confirmed' => $newKode,
                    'referral_code' => $newKode,
                ]);
                // mencari data akademi
                $akademi = Akademi::where('referral_code',$verifyUser->referral_code)->first(); 
                // mencari data pengguna yang sedang login / masuk
                $user = Auth::user();
                // kondisi akademi lupa password
                if($user->password == null){
                    // membuat pesan aplikasi
                    $data['id_akademi'] = $akademi->id_akademi;
                    $data['pesan'] = "Selamat datang kembali ".$user->name_akademi;
                    $data['pengirim'] = "Admin";
                    $data['kepada'] = $user->name_akademi;
                    messageAkademi::create($data);    
                    // menuju halaman untuk memasukkan kode dan membuat password baru
                    return redirect('/user_code_id')->with('success',"Akun akademi teridentifikasi");
                // kondisi akademi baru daftar
                } else {
                    // membuat pesan aplikasi
                    $data['id_akademi'] = $akademi->id_akademi;
                    $data['pesan'] = "Harap lengkapi data profil akademi";
                    $data['pengirim'] = "Admin";
                    $data['kepada'] = $user->name_akademi;
                    messageAkademi::create($data);
                    // menuju halaman akademi
                    return redirect()->route('akademi')->with('success',"Selamat Datang");
                }
            // apabila pengguna adalah perusahaan 
            } elseif($verifyUser->type == 2){    
                // membuat kode unik
                $newKode = \Hashids::encode($verifyUser->id.$verifyUser->no_telp);
                // menambahkan kode ke dalam data pengguna
                User::where('token',$token)->update([
                    'verify_confirmed' => $newKode,
                    'referral_code' => $newKode,
                ]);
                // mencari data perusahaan
                $perusahaan = Perusahaan::where('referral_code',$verifyUser->referral_code)->first(); 
                // mencari data pengguna yang sedang login / masuk
                $user = Auth::user();
                // kondisi perusahaan lupa password
                if($user->password == null){
                    // membuat pesan aplikasi
                    $data['id_perusahaan'] = $perusahaan->id_perusahaan;
                    $data['pesan'] = "Selamat datang kembali ".$user->name_perusahaan;
                    $data['pengirim'] = "Admin";
                    $data['kepada'] = $user->name_perusahaan;    
                    messagePerusahaan::create($data);
                    // menuju halaman untuk memasukkan kode dan membuat password baru
                    return redirect('/user_code_id')->with('success',"Akun akademi teridentifikasi");
                // kondisi perusahaan baru daftar
                } else {
                    // membuat pesan aplikasi
                    $data['id_perusahaan'] = $perusahaan->id_perusahaan;
                    $data['pesan'] = "Harap lengkapi data profil perusahaan";
                    $data['pengirim'] = "Admin";
                    $data['kepada'] = $user->name_perusahaan;
                    messagePerusahaan::create($data);
                    // menuju halaman perusahaan
                    return redirect()->route('perusahaan')->with('success',"Selamat Datang");
                }
            // apabila belum verifikasi email
            } else {
                // menuju halaman verifikasi
                return redirect()->route('verifikasi')->with('warning',"Maaf Email Anda Belum Terverifikasi, Harap Hubungi Admin");
            }
        // apabila data tidak ada
        } else {
            // menuju halaman utama
            Auth::logout();
            return redirect()->route('laman');
        }
    }

    // halaman isi kode kandidat / akademi / perusahaan
    public function userCodeID()
    {
        // mencari data pengguna yang sedang login / masuk
        $user = Auth::user();
        // menuju halaman konfirmasi kode
        return view('auth/passwords/confirm_code_id',compact('user'));
    }

    // sistem konfirmasi kode kandidat / akademi / perusahaan
    public function confirmUserCodeID(Request $request)
    {
        // mencari pengguna yang sedang login / masuk
        $user = Auth::user();
        // mencari data pengguna
        $data = User::where('referral_code',$request->referral_code)->first();
        // apabila data pengguna sama dengan data pengguna yang login / masuk
        if($data->referral_code == $user->referral_code){
            // menuju halaman untuk membuat password
            return view('auth/new_password',compact('user'));
            // apabila tidak
        } else {
            // kembali ke halaman sebelumnya
            return back()->with('error',"Maaf Kode ini tidak ada");
        }
    }

    // konfirmasi verifikasi diri
    // public function confirmVerifikasiDiri(Request $request)
    // {
    //     $user = Auth::user();
    //     $foto = $user->name.time().'.'.$request->photo_id->extension();
    //     $simpan_foto = $request->file('photo_id');
    //     $simpan_foto->move('gambar/Kandidat/'.$user->name.'/Verifikasi Diri/',$user->name.time().'.'.$simpan_foto->extension());
    //     VerifikasiDiri::create([
    //         'id'=>$user->id,
    //         'email'=>$user->email,
    //         'foto_diri_ktp'=>$foto, 
    //     ]);
    //     $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
    //     ContactUsKandidat::create([
    //         'dari'=>$user->name,
    //         'isi'=>"Kandidat telah mengirimkan Verifikasi Diri karena lupa password, harap segera konfirmasi kandidat tersebut",
    //         'balas'=>"belum dibaca",
    //         'id_kandidat'=>$kandidat->id_kandidat,
    //     ]);
    //     auth::logout($user);
    //     return redirect('/login')->with('success',"Terima kasih atas konfirmasi anda. Kami akan menghubungi anda kembali melalui email. Pastikan anda untuk memeriksa email anda");
    // }

    // apabila telah selesai mengatur password baru
    public function confirmPassword(Request $request)
    {
        // mencari data pengguna yang sedang login / masuk
        $check = Auth::user();
        // apabila password sama dengan password sebelumnya
        if($request->password == $check->check_password){
            // kembali ke halaman sebelumnya
            return back()->with('warning',"Anda tidak bisa menggunakan password anda sebelumnya");
        }
        // mengubah data password menjadi kode acak
        $password = Hash::make($request->password); 
        // menambahkan data password ke dalam data pengguna
        $user = User::where('email',$check->email)->update([
            'password' => $password,
            'check_password' => $request->password,
            'counter' => null,
        ]);
        // menuju halaman beranda tergantung pilihan daftar
        return redirect('/')->with('success',"Selamat Datang Kembali");
    }
}
