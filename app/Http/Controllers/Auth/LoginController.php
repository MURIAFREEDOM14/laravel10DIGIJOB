<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Verification;
use App\Mail\VerifyPassword;
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

    // halaman login / masuk semua pengguna
    public function loginSemua()
    {
        return view('auth/login_semua');
    }

    // sistem authentikasi login semua pengguna
    public function AuthenticateLogin(Request $request)
    {      
        // sistem validasi  
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'captcha' => 'required',
        ]);
        
        // memanggil data-data pengguna yang telah daftar
        $pengguna = User::where('type','not like',3)->get();
        foreach ($pengguna as $key){
            // melakukan pengecekan data apabila sama
            $check = User::where('email',$request->email)->first();
            if($check){
                $email = $request->email;
                $password = $request->password;
            } else {
                return back()->with('info',"Akun anda belum terdaftar. Harap Daftar");
            }
        }

        // mencari data pengguna
        $user = User::where('email',$email)->where('password',$password)->first();        
        // melakukan validasi / pengecekan data yang diinputkan
        // apabila cocok / terbukti ada
        if(Auth::attempt(['email'=>$email,'password'=>$password]))
        {
            User::where('email',$email)->update([
                'check_password' => $password,
            ]);
            // menuju halaman pengguna tergantung daftar
            return redirect()->route('laman')->with('success',"selamat datang");
        // apabila cara ke 2 cocok
        } elseif($user !== null) {
            if($user->type == 3){
                return back()->with('error',"Maaf akun tersebut tidak terdaftar");
            }
            // pengguna login
            Auth::login($user);
            User::where('email',$email)->update([
                'check_password' => $password,
            ]);
            // menuju halaman pengguna tergantung pilihan daftar
            return redirect()->route('laman')->with('success',"selamat datang");
        // apabila tidak cocok
        } else {            
            // apabila salah password / email lebih dari 3x untuk kandidat
            if($check->counter >= 3 && $check->type == 0){
                // menuju halaman lupa password
                return redirect('/forgot_password/kandidat')->with('error',"Maaf anda sudah salah password 3 kali");
            // apabila salah password / email lebih dari 3x untuk akademi
            } elseif($check->counter >= 3 && $check->type == 1) {
                // menuju halaman lupa password
                return redirect('/forgot_password/akademi')->with('error',"Maaf anda sudah salah password 3 kali");                
            // apabila salah password / email lebih dari 3x untuk perusahaan
            } elseif($check->counter >= 3 && $check->type == 2) {
                // menuju halaman lupa password
                return redirect('/forgot_password/perusahaan')->with('error',"Maaf anda sudah salah password 3 kali");
            // apabila salah password dibawah 3x
            } else {
                $counter = $check->counter + 1;
                User::where('email',$email)->update([
                    'counter' => $counter,
                ]);
                // mengarahkan kembali ke halaman sebelumnya
                return redirect('/login')->with('error',"Maaf password anda salah");
            }
        }
    }

    // LUPA PASSWORD KANDIDAT //
    public function forgotPasswordKandidat()
    {
        return view('auth/passwords/forgot_password_kandidat');
    }

    // konfirmasi data kandidat lupa password
    public function confirmAccountKandidat(Request $request)
    {
        // mencari data pengguna
        $user = User::where('name',$request->name)
        ->where('email',$request->email)->first();
        // apabila ada
        if($user !== null){
            // memberi 32 huruf secara acak
            $token = Str::random(32).$user->no_telp;
            // menampilan kode verifikasi
            $text = $user->referral_code;
            // menghapus data
            User::where('email',$request->email)->update([
                'token'=>$token,
                'password'=>null,
                'verify_confirmed'=>null,
            ]);
            // mengirimkan pesan verifikasi email lupa password
            Mail::mailer('verification')->to($request->email)->send(new VerifyPassword($request->name, 'no-reply@ugiport.com', $token, $text, 'Verifikasi Lupa Password'));
            // aktivasi kondisi login / sudah masuk
            Auth::login($user);
            return redirect()->route('verifikasi')->with('success',"Anda akan segera mendapat Email verifikasi");
        } else {
            return back()->with('error',"Maaf data anda belum ada. Harap register");
        }
    }

    // LUPA PASSWORD AKADEMI //
    public function forgotPasswordAkademi()
    {
        return view('auth/passwords/forgot_password_akademi');
    }

    // konfirmasi data akademi lupa password
    public function confirmAccountAkademi(Request $request)
    {
        // mencari data pengguna
        $user = User::where('name_akademi',$request->name)
        ->where('email',$request->email)->first();
        // apabila ada
        if($user !== null){
            // memberi 32 huruf secara acak
            $token = Str::random(32).$user->no_nis;
            // menampilan kode verifikasi
            $text = $user->referral_code;
            User::where('email',$request->email)->update([
                'token'=>$token,
                'password'=>null,
                'verify_confirmed'=>null,
            ]);
            Mail::mailer('verification')->to($request->email)->send(new VerifyPassword($request->name, 'no-reply@ugiport.com', $token, $text, 'Verifikasi Lupa Password'));
            Auth::login($user);
            return redirect()->route('verifikasi')->with('success',"Anda akan segera mendapat Email verifikasi");
        } else {
            return redirect()->back()->with('error',"Maaf data anda belum ada. Harap register");
        }
    }
    
    // LUPA PASSWORD PERUSAHAAN //
    public function forgotPasswordPerusahaan()
    {
        return view('auth/passwords/forgot_password_perusahaan');
    }

    // konfirmasi data perusahaan lupa password
    public function confirmAccountPerusahaan(Request $request)
    {
        $user = User::where('name_perusahaan',$request->name)
        ->where('email',$request->email)->first();
        if($user !== null){
            $token = Str::random(32).$user->no_nib;
            $text = $user->referral_code;
            User::where('email',$request->email)->update([
                'token'=>$token,
                'password'=>null,
                'verify_confirmed'=>null,
            ]);
            Mail::mailer('verification')->to($request->email)->send(new VerifyPassword($request->name, 'no-reply@ugiport.com', $token, $text, 'Verifikasi Lupa Password'));
            Auth::login($user);
            return redirect()->route('verifikasi')->with('success',"Anda akan segera mendapat Email verifikasi");
        } else {
            return redirect()->back()->with('error',"Maaf data anda belum ada. Harap register");
        }
    }

    // memuat ulang kode captcha
    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }

    // aktivasi akun bila sudah ada
    public function loginMigration()
    {
        $user = null;
        return view('/auth/login_migration',compact('user'));
    }

    // cek apabila data kandidat masih kosong
    public function checkLoginMigration(Request $request)
    {
        $kandidat = Kandidat::where('email',$request->email)->where('nik',$request->nik)->first();
        // bila data kandidat ada
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

    public function confirmLoginMigration(Request $request)
    {
        $kandidat = Kandidat::where('email',$request->email)->first();
        $token = Str::random(32).$request->no_telp;
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

    // sistem log out / keluar
    public function logout()
    {
        Auth::logout();
        return redirect()->route('laman');
    }
}
