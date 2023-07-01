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
        Mail::send('mail.mail', ['token' => $user->token], function($message) use($user){
            $message->to($user->email);
            $message->subject('Email Verification Mail');
        });

        return redirect()->route('verifikasi');
    }

    public function verifyAccount($token)
    {
        $verifyUser = User::where('token',$token)->first();
        if(!is_null($verifyUser) ){
            $user = $verifyUser->id;
            if($user) {
                dd($user);
                User::where('token',$token)->update([
                    'verify_confirmed' => 'Terverifikasi',
                ]);
                $kandidat = Kandidat::where('referral_code',$verifyUser->referral_code)->first(); 
                $data['id_kandidat'] = $kandidat->id_kandidat;
                $data['isi'] = "Harap lengkapi data profil anda";
                $data['pengirim'] = "Admin";
                $data['url'] = ('/isi_kandidat_personal');
                notifyKandidat::create($data);
                return redirect()->route('kandidat')->with('success',"Selamat Datang");
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        } else {
            return redirect('/laman');
        }
    }
    public function verifyAccountAkademi($token)
    {
        $verifyUser = User::where('token',$token)->first();
        if(!is_null($verifyUser) ){
            $user = $verifyUser->id;
            if($user) {
                User::where('token',$token)->update([
                    'verify_confirmed' => 'Terverifikasi',
                ]);
                $akademi = Akademi::where('referral_code',$verifyUser->referral_code)->first(); 
                $data['id_akademi'] = $akademi->id_akademi;
                $data['isi'] = "Harap lengkapi data profil anda";
                $data['pengirim'] = "Admin";
                $data['url'] = ('/akademi/isi_akademi_data');
                notifyAkademi::create($data);
                return redirect()->route('akademi')->with('success',"Selamat Datang");
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        } else {
            return redirect('/laman');
        }
    }
    public function verifyAccountPerusahaan($token)
    {
        $verifyUser = User::where('token',$token)->first();
        if(!is_null($verifyUser) ){
            $user = $verifyUser->id;
            if($user) {
                User::where('token',$token)->update([
                    'verify_confirmed' => 'Terverifikasi',
                ]);
                $perusahaan = Perusahaan::where('referral_code',$verifyUser->referral_code)->first(); 
                $data['id_perusahaan'] = $perusahaan->id_perusahaan;
                $data['isi'] = "Harap lengkapi data profil anda";
                $data['pengirim'] = "Admin";
                $data['url'] = ('/perusahaan/isi_perusahaan_data');
                notifyPerusahaan::create($data);        
                return redirect()->route('perusahaan')->with('success',"Selamat Datang");
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        } else {
            return redirect('/laman');
        }
    }

}
