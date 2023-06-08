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
    public function index()
    {
        return view('laman');
    }

    public function loginSemua()
    {
        return view('auth/login_semua');
    }

    public function login_kandidat()
    {
        return view('auth/login_kandidat');
    }

    public function login_akademi()
    {
        return view('auth/login_akademi');
    }

    public function login_perusahaan()
    {
        return view('auth/login_perusahaan');
    }

    public function register_kandidat()
    {
        return view('auth/register_kandidat');
    }

    public function register_akademi()
    {
        return view('auth/register_akademi');
    }

    public function register_perusahaan()
    {
        return view('auth/register_perusahaan');
    }

    public function login_gmail()
    {
        return view('login_gmail');
    }

    public function login_referral()
    {
        if (Auth::user()) {
            $referral_code = Auth::user()->referral_code;
        }
        else {
            $referral_code = null;
        }
        return view('login_referral', ['referral_code'=>$referral_code]);
    }

    public function login_info(Request $request)
    {
        $pengirim = [
            'pengirim' => $request->name,
            'user_referral' => $request->referral_code
        ];

        Mail::to($$request->email)->send(new DemoMail($pengirim));

        return view('login_info');
    }

    public function info(Request $request, $id)
    {
        // dd($id);
        $validator = Validator::make($request->all(), [
            'nik' => 'required|numeric|between:1100000000000001,9300000000000000001',
        ]);
            User::where('id', $id)->update([
                'name' => $request->name,
                'NIK' => $request->nik,
                'email' => $request->email,
                'referral_code' => $request->referral_code
            ]);
        $pengirim = [
            'pengirim' => $request->name,
            'user_referral' => $request->referral_code
        ];

        Mail::to($request->email)->send(new DemoMail($pengirim));
        return redirect('login_info');
    }

    public function digijobSystem()
    {
        return view('digijob_system');
    }

    public function benefits()
    {
        return view('benefits');
    }

    public function features()
    {
        return view('features');
    }

    public function contact()
    {
        return view('contact_us');
    }

    public function about()
    {
        return view('about_us');
    }
}
