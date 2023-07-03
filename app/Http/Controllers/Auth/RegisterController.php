<?php

namespace App\Http\Controllers\Auth;

use App\Mail\DemoMail;
use App\Models\Kandidat;
use App\Models\notifyAkademi;
use App\Models\notifyKandidat;
use App\Models\notifyPerusahaan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Akademi;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Notification;
use App\Models\Notification;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    public function showRegistrationForm(Request $request)
    {
        if ($request->has('ref')) {
            session(['referrer' => $request->query('ref')]);
        }

        return view('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => ['required', 'string', 'max:255'],
            // // 'username' => ['required', 'string', 'unique:users', 'alpha_dash', 'min:5', 'max:30'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string'],
            // 'no_telp' => ['required', 'unique:users', 'max:12']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $password = Hash::make($data['password']);
        if($data !== null)
        {
            return User::create([
                'name_perusahaan' => $data['name'],
                'email' => $data['email'],
                'no_nib' => $data['no_nib'],
                'type' => 2,
                'password' => $password,
            ]);
        } else {
            return redirect('/laman');
        }
    }

    public function kandidat(Request $request)
    {
        // $user = User::all();
        // foreach ($user as $key) {
        //     if($key->email == $request->email && $key->password == null){
        //         return redirect('register/kandidat/pindahan');       
        //     }
        // }

        $validated = $request->validate([
            'name' => 'required|max:255',
            'nik' => 'required|max:16|min:16|unique:kandidat',
            'email' => 'required|unique:users|max:255',
            'no_telp' => 'required|unique:users|min:10|max:13',
            'nama_panggilan' => 'required|unique:kandidat|min:5|max:20',
            'password' => 'required|min:8',
        ]);
        
        $tgl = Carbon::parse($request->tgl)->age;
        if($tgl < 18){
            return redirect('/register/kandidat')->with('warning',"Maaf umur anda belum cukup, syarat umur ialah 18 thn keatas");
        }

        $token = Str::random(64).$request->no_telp;
        $password = Hash::make($request->password);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'password' => $password,
            'token' => $token,
        ]);

        $id = $user->id;
        $userId = \Hashids::encode($id.$request->no_telp);

        User::where('id',$id)->update([
            'referral_code' => $userId
        ]);

        Kandidat::create([
            'id' => $id,
            'nama' => $request->name,
            'referral_code' => $userId,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'tgl_lahir' => $request->tgl,
            'usia' => $tgl,
            'nama_panggilan' => $request->nama_panggilan,
            'nik' => $request->nik,
        ]);

        Mail::send('mail.mail', ['token' => $token,'nama' => $request->name], function($message) use($request){
            $message->to($request->email);
            $message->subject('Email Verification Mail');
        });
        Auth::login($user);       
        return redirect()->route('verifikasi')->with('success',"Selamat Datang");
    }

    protected function akademi(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'no_nis' => 'required|unique:users|max:40',
            'password' => 'required|min:8',
        ]);

        $token = Str::random(64).$request->no_nis;
        $password = Hash::make($request->password);

        $user = User::create([
            'name_akademi' => $request->name,
            'email' => $request->email,
            'no_nis' => $request->no_nis,
            'type' => 1,
            'password' => $password,
            'token' => $token,
        ]);

        $id = $user->id;
        $userId = \Hashids::encode($id.$request->no_nis);

        User::where('id',$id)->update([
            'referral_code'=>$userId
        ]);

        Akademi::create([
            'nama_akademi' => $request->name,
            'referral_code' => $userId,
            'email_akademi' => $request->email,
            'no_nis' => $request->no_nis,
        ]);

        Mail::send('mail.mail', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Email Verification Mail');
        });
        Auth::login($user);
        return redirect()->route('verifikasi')->with('success',"Selamat Datang");
    }

    protected function perusahaan(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'no_nib' => 'required|unique:users|max:40',
            'password' => 'required|min:8',
        ]);

        $token = Str::random(64).$request->no_nib;
        $password = hash::make($request->password);

        $user = User::create([
            'name_perusahaan' => $request->name,
            'email' => $request->email,
            'no_nib' => $request->no_nib,
            'type' => 2,
            'password' => $password,
            'token' => $token,
        ]);

        $id = $user->id;
        $userId = \Hashids::encode($id.$request->nib);

        User::where('id',$id)->update([
            'referral_code' => $userId,
        ]);

        Perusahaan::create([
            'nama_perusahaan'=>$request->name,
            'no_nib'=>$request->no_nib,
            'referral_code'=>$userId,
            'email_perusahaan'=>$request->email,
        ]);

        Mail::send('mail.mail', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Email Verification Mail');
        });
        Auth::login($user);
        return redirect()->route('verifikasi')->with('success',"Selamat Datang");
    }
}
