<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Kandidat;
use App\Models\Akademi;
use App\Models\Perusahaan;
use App\Models\Notification;
use App\Mail\DemoMail;
use Illuminate\Support\Facades\Mail;
use App\Models\notifyAkademi;
use App\Models\notifyKandidat;
use App\Models\notifyPerusahaan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class VerifikasiController extends Controller
{
    public function verifikasi()
    {
        return view('verifikasi');
    }

    public function masukVerifikasi(Request $request)
    {
        $verifikasi = User::where('referral_code', $request->verification_code)->first();
        if ($verifikasi) {
            User::where('referral_code',$verifikasi->referral_code)->update([
                'verify_confirmed' => $request->verification_code,
            ]);
            $kandidat = Kandidat::where('referral_code',$verifikasi->referral_code)->first();
            $notifikasi = Notification::where('id_kandidat',$kandidat->id_kandidat)->first();
            if ($notifikasi == null) {
                Notification::create([
                    'id_kandidat'=>$kandidat->id_kandidat,
                    'pengirim_notifikasi'=>"System",
                    'isi'=>"Selamat Datang",
                ]);    
            } else {
            }
            
            if (Auth::user()->type == 2) {
                return redirect('/perusahaan');
            } elseif (Auth::user()->type == 1) {
                return redirect('/isi_akademi_data');
            } else {
                return redirect('/isi_kandidat_personal');
            }
        }
        else
        {
            return redirect('verifikasi');
        }
    }

    public function ulang_verifikasi()
    {
        $user = Auth::user();
        if($user->token == null){
            $token = Str::random(64).$user->no_telp;
            User::where('referral_code',$user->referral_code)->update([
                'token' => $token,
            ]);
            $newUser = User::where('referral_code',$user->referral_code)->first();
            $newToken = $newUser->token;
        } else {
            $newToken = $user->token;   
        }

        if($user->type == 0){
            $nama = $user->name;
        } elseif($user->type == 1){
            $nama = $user->name_perusahaan;
        } elseif($user->type == 2){
            $nama = $user->name_perusahaan;
        } else {
            $nama = null;
        }

        Mail::send('mail.mail', ['token' => $newToken, 'nama' => $nama], function($message) use($user){
            $message->to($user->email);
            $message->subject('Email Verification Mail');
        });
        return redirect()->route('verifikasi');
    }

    public function verifyAccount($token)
    {
        $verifyUser = User::where('token',$token)->first();
        if(!is_null($verifyUser) ){
            if($verifyUser->type == 0) {
                User::where('token',$token)->update([
                    'verify_confirmed' => $verifyUser->referral_code,
                ]);
                $kandidat = Kandidat::where('referral_code',$verifyUser->referral_code)->first(); 
                $user = Auth::user();
                if($user->password == null){
                    $data['id_kandidat'] = $kandidat->id_kandidat;
                    $data['isi'] = "Selamat datang kembali ".$user->name;
                    $data['pengirim'] = "Admin";
                    // notifyKandidat::create($data);
                    return redirect('/kandidat')->with('succes',"Email anda terverifikasi");
                } else {
                    $data['id_kandidat'] = $kandidat->id_kandidat;
                    $data['isi'] = "Harap lengkapi data profil anda";
                    $data['pengirim'] = "Admin";
                    $data['url'] = ('/isi_kandidat_personal');
                    notifyKandidat::create($data);
                    return redirect()->route('kandidat')->with('success',"Selamat Datang");
                }
            
            } elseif($verifyUser->type == 1) {
                User::where('token',$token)->update([
                    'verify_confirmed' => $verifyUser->referral_code,
                ]);
                $akademi = Akademi::where('referral_code',$verifyUser->referral_code)->first(); 
                $data['id_akademi'] = $akademi->id_akademi;
                $data['isi'] = "Harap lengkapi data profil akademi";
                $data['pengirim'] = "Admin";
                $data['url'] = ('/akademi/isi_akademi_data');
                notifyAkademi::create($data);
                return redirect()->route('akademi')->with('success',"Selamat Datang");
            
            } elseif($verifyUser->type == 2){    
                User::where('token',$token)->update([
                    'verify_confirmed' => $verifyUser->referral_code,
                ]);
                $perusahaan = Perusahaan::where('referral_code',$verifyUser->referral_code)->first(); 
                $data['id_perusahaan'] = $perusahaan->id_perusahaan;
                $data['isi'] = "Harap lengkapi data profil perusahaan";
                $data['pengirim'] = "Admin";
                $data['url'] = ('/perusahaan/isi_perusahaan_data');
                notifyperusahaan::create($data);
                return redirect()->route('perusahaan')->with('success',"Selamat Datang");
            
            } else {
                return redirect()->route('verifikasi')->with('warning',"Maaf Email Anda Belum Terverifikasi, Harap Hubungi Admin");
            }
        } else {
            return redirect('/laman');
        }
    }

    public function nomorID()
    {
        $user = Auth::user();
        return view('auth/passwords/confirm_nomor_id',compact('user'));
    }

    public function confirmNomorID(Request $request)
    {
        $user = Auth::user();
        $kandidat = User::where('no_telp',$request->no)->where('type',0)->first();
        $akademi = User::where('no_nis',$request->no)->where('type',1)->first();
        $perusahaan = User::where('no_nib',$request->no)->where('type',2)->first();
        if($perusahaan || $akademi || $kandidat){
            return view('auth/new_password',compact('user'));
        } else {
            return back()->with('error',"Maaf No. ini tidak ada");
        }
    }

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
