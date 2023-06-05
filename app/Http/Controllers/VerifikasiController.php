<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Kandidat;
use App\Models\Notification;
use App\Mail\DemoMail;
use Illuminate\Support\Facades\Mail;

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
        $pengirim = [
            'name'=>$user->name,
            'user_referral'=>$user->referral_code,
        ];
        Mail::to($user->email)->send(new DemoMail($pengirim));
        return redirect()->route('verifikasi');
    }
}
