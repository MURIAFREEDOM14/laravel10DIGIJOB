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
    // halaman verifikasi
    public function verifikasi()
    {
        return view('verifikasi');
    }

    // sistem kirim ulang email verifikasi
    public function ulang_verifikasi()
    {
        $user = Auth::user();
        // apabila token kosong
        if($user->token == null){
            $token = Str::random(32).$user->no_telp;
            User::where('referral_code',$user->referral_code)->update([
                'token' => $token,
            ]);
            $newUser = User::where('referral_code',$user->referral_code)->first();
            $newToken = $newUser->token;
        // apabila token sebaliknya
        } else {
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
            Mail::mailer('verification')->to($user->email)->send(new VerifyPassword($nama, 'no-reply@ugiport.com', $newToken, $text, 'Verifikasi Lupa Password'));
        } else {
            Mail::mailer('verification')->to($user->email)->send(new Verification($nama, $newToken, 'Email Verifikasi', 'no-reply@ugiport.com'));
        }
        return redirect()->route('verifikasi')->with('success',"pesan email dikirim ulang");
    }

    // pengecekan verifikasi email dari pesan email / Gmail
    public function verifyAccount($token)
    {
        // mencari pengguna
        $verifyUser = User::where('token',$token)->first();
        
        // apabila data tidak kosong / ada
        if(!is_null($verifyUser)){
            // apabila pengguna = kandidat
            if($verifyUser->type == 0) {
                // membuat kode baru
                $newKode = \Hashids::encode($verifyUser->id.$verifyUser->no_telp);
                User::where('token',$token)->update([
                    'verify_confirmed' => $newKode,
                    'referral_code' => $newKode,
                ]);
                Kandidat::where('id',$verifyUser->id)->update([
                    'referral_code' => $newKode,
                ]);
                $kandidat = Kandidat::where('referral_code',$verifyUser->referral_code)->first(); 
                $user = Auth::user();
                // kondisi kandidat lupa password
                if($user->password == null){
                    $data['id_kandidat'] = $kandidat->id_kandidat;
                    $data['pesan'] = "Selamat datang kembali ".$user->name;
                    $data['pengirim'] = "Admin";
                    $data['kepada'] = $user->name;
                    messageKandidat::create($data);
                    return redirect('/user_code_id')->with('success',"Akun anda teridentifikasi");
                // kondisi kandidat baru daftar
                } else {
                    $data['id_kandidat'] = $kandidat->id_kandidat;
                    $data['pesan'] = "Harap lengkapi data profil anda";
                    $data['pengirim'] = "Admin";
                    $data['kepada'] = $user->name;
                    messageKandidat::create($data);
                    return redirect()->route('kandidat')->with('success',"Selamat Datang");
                }
            // apabila pengguna = akademi
            } elseif($verifyUser->type == 1) {
                $newKode = \Hashids::encode($verifyUser->id.$verifyUser->no_nis);
                User::where('token',$token)->update([
                    'verify_confirmed' => $newKode,
                    'referral_code' => $newKode,
                ]);
                $akademi = Akademi::where('referral_code',$verifyUser->referral_code)->first(); 
                $user = Auth::user();
                // kondisi akademi lupa password
                if($user->password == null){
                    $data['id_akademi'] = $akademi->id_akademi;
                    $data['pesan'] = "Selamat datang kembali ".$user->name_akademi;
                    $data['pengirim'] = "Admin";
                    $data['kepada'] = $user->name_akademi;
                    messageAkademi::create($data);    
                    return redirect('/user_code_id')->with('success',"Akun akademi teridentifikasi");
                // kondisi akademi baru daftar
                } else {
                    $data['id_akademi'] = $akademi->id_akademi;
                    $data['pesan'] = "Harap lengkapi data profil akademi";
                    $data['pengirim'] = "Admin";
                    $data['kepada'] = $user->name_akademi;
                    messageAkademi::create($data);
                    return redirect()->route('akademi')->with('success',"Selamat Datang");
                }
            // apabila pengguna = perusahaan 
            } elseif($verifyUser->type == 2){    
                $newKode = \Hashids::encode($verifyUser->id.$verifyUser->no_telp);
                User::where('token',$token)->update([
                    'verify_confirmed' => $newKode,
                    'referral_code' => $newKode,
                ]);
                $perusahaan = Perusahaan::where('referral_code',$verifyUser->referral_code)->first(); 
                $user = Auth::user();
                // kondisi perusahaan lupa password
                if($user->password == null){
                    $data['id_perusahaan'] = $perusahaan->id_perusahaan;
                    $data['pesan'] = "Selamat datang kembali ".$user->name_perusahaan;
                    $data['pengirim'] = "Admin";
                    $data['kepada'] = $user->name_perusahaan;    
                    messagePerusahaan::create($data);
                    return redirect('/user_code_id')->with('success',"Akun akademi teridentifikasi");
                // kondisi perusahaan baru daftar
                } else {
                    $data['id_perusahaan'] = $perusahaan->id_perusahaan;
                    $data['pesan'] = "Harap lengkapi data profil perusahaan";
                    $data['pengirim'] = "Admin";
                    $data['kepada'] = $user->name_perusahaan;
                    messagePerusahaan::create($data);
                    return redirect()->route('perusahaan')->with('success',"Selamat Datang");
                }
            } else {
                return redirect()->route('verifikasi')->with('warning',"Maaf Email Anda Belum Terverifikasi, Harap Hubungi Admin");
            }
        } else {
            return redirect()->route('laman');
        }
    }

    // halaman isi kode kandidat / akademi / perusahaan
    public function userCodeID()
    {
        $user = Auth::user();
        return view('auth/passwords/confirm_code_id',compact('user'));
    }

    // sistem konfirmasi kode kandidat / akademi / perusahaan
    public function confirmUserCodeID(Request $request)
    {
        $user = Auth::user();
        $data = User::where('referral_code',$request->referral_code)->first();
        if($data->referral_code == $user->referral_code){
            return view('auth/new_password',compact('user'));
        } else {
            return back()->with('error',"Maaf Kode ini tidak ada");
        }
    }

    public function confirmVerifikasiDiri(Request $request)
    {
        $user = Auth::user();
        $foto = $user->name.time().'.'.$request->photo_id->extension();
        $simpan_foto = $request->file('photo_id');
        $simpan_foto->move('gambar/Kandidat/'.$user->name.'/Verifikasi Diri/',$user->name.time().'.'.$simpan_foto->extension());
        VerifikasiDiri::create([
            'id'=>$user->id,
            'email'=>$user->email,
            'foto_diri_ktp'=>$foto, 
        ]);
        $kandidat = Kandidat::where('referral_code',$user->referral_code)->first();
        ContactUsKandidat::create([
            'dari'=>$user->name,
            'isi'=>"Kandidat telah mengirimkan Verifikasi Diri karena lupa password, harap segera konfirmasi kandidat tersebut",
            'balas'=>"belum dibaca",
            'id_kandidat'=>$kandidat->id_kandidat,
        ]);
        auth::logout($user);
        return redirect('/login')->with('success',"Terima kasih atas konfirmasi anda. Kami akan menghubungi anda kembali melalui email. Pastikan anda untuk memeriksa email anda");
    }

    // apabila telah selesai mengatur password baru
    public function confirmPassword(Request $request)
    {
        $check = Auth::user();
        if($request->password == $check->check_password){
            return back()->with('warning',"Anda tidak bisa menggunakan password anda sebelumnya");
        }
        $password = Hash::make($request->password); 
        $user = User::where('email',$check->email)->update([
            'password' => $password,
            'check_password' => $request->password,
            'counter' => null,
        ]);
        return redirect('/')->with('success',"Selamat Datang Kembali");
    }
}
