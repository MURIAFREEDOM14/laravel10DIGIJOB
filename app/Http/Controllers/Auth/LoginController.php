<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Kandidat;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

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

    public function loginSemua()
    {
        return view('auth/login_semua');
    }

    public function forgotPasswordKandidat()
    {
        return view('auth/passwords/forgot_password_kandidat');
    }

    public function confirmAccountKandidat(Request $request)
    {
        $user = User::where('name',$request->name)
        ->where('email',$request->email)->first();
        if($user !== null){
            $token = Str::random(64).$user->no_telp;
            $text = $user->referral_code;
            User::where('email',$request->email)->update([
                'token'=>$token,
                'password'=>null,
                'verify_confirmed'=>null,
            ]);
            Mail::send('mail.verify',['token'=>$token,'nama'=>$request->name,'text'=>$text], function($message) use($request){
                $message->to($request->email);
                $message->subject('Email Verification Mail');
            });
            Auth::login($user);
            return redirect()->route('verifikasi')->with('success',"Anda akan segera mendapat Email verifikasi");
        } else {
            return back()->with('error',"Maaf data anda belum ada. Harap register");
        }
    }
    public function forgotPasswordAkademi()
    {
        return view('auth/passwords/forgot_password_akademi');
    }

    public function confirmAccountAkademi(Request $request)
    {
        $user = User::where('name_akademi',$request->name)
        ->where('email',$request->email)->first();
        if($user !== null){
            $token = Str::random(64).$user->no_nis;
            User::where('email',$request->email)->update([
                'token'=>$token,
                'password'=>null,
                'verify_confirmed'=>null,
            ]);
            Mail::send('mail.mail',['token' => $token,'nama' => $request->name], function($message) use($request){
                $message->to($request->email);
                $message->subject('Email Verification Mail');
            });
            Auth::login($user);
            return redirect()->route('verifikasi')->with('success',"Anda akan segera mendapat Email verifikasi");
        } else {
            return redirect()->back()->with('error',"Maaf data anda belum ada. Harap register");
        }
    }
    public function forgotPasswordPerusahaan()
    {
        return view('auth/passwords/forgot_password_perusahaan');
    }

    public function confirmAccountPerusahaan(Request $request)
    {
        $user = User::where('name_perusahaan',$request->name)
        ->where('email',$request->email)->first();
        if($user !== null){
            $token = Str::random(64).$user->no_nib;
            User::where('email',$request->email)->update([
                'token'=>$token,
                'password'=>null,
                'verify_confirmed'=>null,
            ]);
            Mail::send('mail.mail',['token' => $token,'nama' => $request->name], function($message) use($request){
                $message->to($request->email);
                $message->subject('Email Verification Mail');
            });
            Auth::login($user);
            return redirect()->route('verifikasi')->with('success',"Anda akan segera mendapat Email verifikasi");
        } else {
            return redirect()->back()->with('error',"Maaf data anda belum ada. Harap register");
        }
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }

    // public function loginKandidat()
    // {
    //     return view('/auth/login_kandidat');
    // }
    // public function loginAkademi()
    // {
    //     return view('/auth/login_akademi');
    // }
    // public function loginPerusahaan()
    // {
    //     return view('/auth/login_perusahaan');
    // }

    public function AuthenticateLogin(Request $request)
    {        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'captcha' => 'required',
        ]);
        
        $pengguna = User::where('type','not like',3)->get();
        foreach ($pengguna as $key){
            $check = User::where('email',$request->email)->first();
            if($check){
                $email = $request->email;
                $password = $request->password;
            } else {
                return back()->with('no_found',"Akun anda belum terdaftar. Harap Daftar");
            }
        }

        $user = User::where('email',$email)->where('password',$password)->first();        
        if(Auth::attempt(['email'=>$email,'password'=>$password]))
        {
            User::where('email',$email)->update([
                'check_password' => $password,
            ]);
            return redirect()->route('laman')->with('success',"selamat datang");
        } elseif($user !== null) {
            Auth::login($user);
            User::where('email',$email)->update([
                'check_password' => $password,
            ]);
            return redirect()->route('laman')->with('success',"selamat datang");
        } else {            
            if($check->counter >= 3 && $check->type == 0){
                return redirect('/forgot_password/kandidat')->with('error',"Maaf anda sudah salah password 3 kali");
            } elseif($check->counter >= 3 && $check->type == 1) {
                return redirect('/forgot_password/akademi')->with('error',"Maaf anda sudah salah password 3 kali");                
            } elseif($check->counter >= 3 && $check->type == 2) {
                return redirect('/forgot_password/perusahaan')->with('error',"Maaf anda sudah salah password 3 kali");
            } else {
                $counter = $check->counter + 1;
                User::where('email',$email)->update([
                    'counter' => $counter,
                ]);
                return redirect('/login')->with('error',"Maaf password anda salah");
            }
        }
    }

    public function loginMigration()
    {
        $user = null;
        return view('/auth/login_migration',compact('user'));
    }

    public function checkLoginMigration(Request $request)
    {
        $kandidat = Kandidat::where('email',$request->email)->where('nik',$request->nik)->first();
        if($kandidat !== null){
            $user = User::where('email',$request->email)->first();
            if($user == null){
                return view('/auth/login_find_migration',compact('kandidat'));
            } else {
                return redirect('/login')->with('warning',"Maaf Data anda sudah ada. Harap Login");
            }
        } else {
            return redirect('/register/kandidat')->with('error',"Maaf anda belum terdaftar. Harap Register");
        }
    }

    public function tambahLoginMigration()
    {
        return redirect()->back();
    }

    public function confirmLoginMigration(Request $request)
    {
        $kandidat = Kandidat::where('email',$request->email)->first();
        $token = Str::random(64).$request->no_telp;
        $password = Hash::make($request->password);
        $user = User::create([
            'name' => $kandidat->nama,
            'no_telp' => $kandidat->no_telp,
            'email' => $kandidat->email,
            'password' => $password,
            'check_password' => $request->password,
            'token' => $token,
        ]);

        $id = $user->id;
        $userId = \Hashids::encode($id.$request->no_telp);
        
        User::where('id',$id)->update([
            'referral_code' => $userId,
        ]);

        Kandidat::where('email',$kandidat->email)->update([
            'id' => $id,
            'referral_code' => $userId,
        ]);
        Mail::send('mail.mail',['token' => $token, 'nama' => $kandidat->nama], function($message) use($request){
            $message->to($request->email);
            $message->subject('Email Verification Mail');
        });
        Auth::login($user);
        return redirect()->route('verifikasi')->with('success',"Cek email anda untuk verifikasi");
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
        return redirect()->route('laman');
    }
}
