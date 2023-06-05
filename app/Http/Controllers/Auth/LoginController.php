<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginKandidat()
    {
        return view('/auth/login_kandidat');
    }
    public function loginAkademi()
    {
        return view('/auth/login_akademi');
    }
    public function loginPerusahaan()
    {
        return view('/auth/login_perusahaan');
    }
    public function AuthenticateKandidat(Request $request)
    {
        $kandidat = User::where('no_telp', $request->no_telp)->where('email', $request->email)->where('type',0)->first();
        if ($kandidat) {
            Auth::login($kandidat);
            return redirect('/');
        } else {
            return redirect('/login/kandidat')->with('error',"Maaf anda masih belum terdaftar");
        }
    }

    public function AuthenticateAkademi(Request $request)
    {
        $akademi = User::where('no_nis', $request->nis)->where('email', $request->email)->where('type',1)->first();
        if ($akademi) {
            Auth::login($akademi);
            return redirect('/');
        } else {
            return redirect('/login/akademi')->with('error',"Maaf anda masih belum terdaftar");
        }
    }

    public function AuthenticatePerusahaan(Request $request)
    {
        $perusahaan = User::where('no_nib', $request->nib)->where('email', $request->email)->where('type',2)->first();
        if ($perusahaan) {
            Auth::login($perusahaan);
            return redirect('/');
        } else {
            return redirect('/login/perusahaan')->with('error',"Maaf anda masih belum terdaftar");
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/laman');
    }
}
