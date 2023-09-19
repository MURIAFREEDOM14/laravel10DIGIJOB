<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class LamanController extends Controller
{
    // halaman awal aplikasi
    public function index()
    {
        return view('laman');
    }

    // refresh captcha
    protected function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img('flat')]);
    } 

    // sistem login dengan Google (masih belum selesai)
    // public function login_gmail()
    // {
    //     return view('login_gmail');
    // }

    // public function login_referral()
    // {
    //     if (Auth::user()) {
    //         $referral_code = Auth::user()->referral_code;
    //     }
    //     else {
    //         $referral_code = null;
    //     }
    //     return view('login_referral', ['referral_code'=>$referral_code]);
    // }

    // public function login_info(Request $request)
    // {
    //     $pengirim = [
    //         'pengirim' => $request->name,
    //         'user_referral' => $request->referral_code
    //     ];

    //     Mail::to($$request->email)->send(new DemoMail($pengirim));

    //     return view('login_info');
    // }

    // public function info(Request $request, $id)
    // {
    //     // dd($id);
    //     $validator = Validator::make($request->all(), [
    //         'nik' => 'required|numeric|between:1100000000000001,9300000000000000001',
    //     ]);
    //         User::where('id', $id)->update([
    //             'name' => $request->name,
    //             'NIK' => $request->nik,
    //             'email' => $request->email,
    //             'referral_code' => $request->referral_code
    //         ]);
    //     $pengirim = [
    //         'pengirim' => $request->name,
    //         'user_referral' => $request->referral_code
    //     ];

    //     Mail::to($request->email)->send(new DemoMail($pengirim));
    //     return redirect('login_info');
    // }
}
