<?php

namespace App\Http\Controllers\Auth;

use App\Mail\DemoMail;
use App\Mail\Verification;
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
use App\Models\PerusahaanCabang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Notification;
use App\Models\Notification;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Payment;
use RealRashid\SweetAlert\Facades\Alert;

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

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    // protected function create(array $data)
    // {
    //     $password = Hash::make($data['password']);
    //     if($data !== null)
    //     {
    //         return User::create([
    //             'name_perusahaan' => $data['name'],
    //             'email' => $data['email'],
    //             'no_nib' => $data['no_nib'],
    //             'type' => 2,
    //             'password' => $password,
    //             'check_password' => $data['password'],
    //         ]);
    //     } else {
    //         return redirect()->route('laman');
    //     }
    // }

    // DATA KANDIDAT //
    protected function kandidat(Request $request)
    {        
        // Data Kandidat //
        $kandidat = Kandidat::where('email',$request->email)->where('nik',$request->nik)->first();
        // Semua Data Kandidat //
        $data_register = Kandidat::all();
        // Mencari Usia //
        $tgl = Carbon::parse($request->tgl)->age;        
        
        // Apabila sudah punya akun //
        if($kandidat !== null){
            return redirect('/login/migration')->with('warning',"Data anda sudah ada, Harap aktifkan akun");
        }
        // Apabila password dengan password confirm tidak sama //
        if($request->password !== $request->passwordConfirm){
            return back()->with('error',"Maaf konfirmasi password anda salah");
        }
        // Apabila nama panggilan sudah digunakan
        foreach($data_register as $key) {
            if($key->nama_panggilan == $request->nama_panggilan){
                return back()->with('info',"Maaf nama panggilan ini sudah digunakan. Gunakan mana lain anda.");
            }    
        }
        // Apabila usia pendaftar kurang dari 18 tahun //
        if($tgl < 18){
            return back()->with('warning',"Maaf umur anda belum cukup, syarat umur ialah 18 thn keatas");
        }

        // sistem validasi data
        $validated = $request->validate([
            'name' => 'required|max:255',
            'nik' => 'required|max:16|min:16|unique:kandidat',
            'email' => 'required|unique:users|max:255',
            'no_telp' => 'required|unique:users|min:10|max:13',
            'nama_panggilan' => 'required|unique:kandidat|max:20',
            'password' => 'required|min:8',
            'captcha' => 'required',
        ]);

        // menampilkan 32 huruf secara acak
        $token = Str::random(32).$request->no_telp;
        
        // sistem hashing data password menjadi data kode acak
        $password = Hash::make($request->password);
        
        // membuat data pengguna
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'number_phone' => $request->no_telp,
            'password' => $password,
            'check_password' => $request->password,
            'token' => $token,
        ]);

        // mengambil data user id
        $id = $user->id;
        
        // sistem membuat kode kunci dari data id + no telp (tipe data integer / angka)
        $userId = \Hashids::encode($id.$request->no_telp);

        // menambahkan kode ke dalam data pengguna yang baru dibuat
        User::where('id',$id)->update([
            'referral_code' => $userId
        ]);

        // membuat data kandidat baru
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

        // mengirim pesan email kepada kandidat
        Mail::mailer('verification')->to($request->email)->send(new Verification($request->name, $token, 'Email Verifikasi', 'no-reply@ugiport.com'));
        
        // aktivasi login / masuk akun sbg pengguna
        Auth::login($user);
        
        // menuju halaman verifikasi
        return redirect()->route('verifikasi')->with('success',"Email verifikasi telah terkirim ke Email anda");
    }

    // DATA AKADEMI //
    protected function akademi(Request $request)
    {
        // apabila password dan password verifikasi tidak sama
        if($request->password !== $request->passwordConfirm){
            // kembali menuju halaman sebelumnya
            return back()->with('error',"Maaf konfirmasi password anda salah");
        }
        // sistem validasi / pengecekan
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'no_nis' => 'required|unique:users|max:40',
            'password' => 'required|min:8',
            'captcha' => 'required',
        ]);

        // membuat data huruf secara acak sebanyak 32
        $token = Str::random(32).$request->no_nis;
        // mengubah password yang dimasukkan menjadi bentuk kode acak
        $password = Hash::make($request->password);
        // membuat data pengguna
        $user = User::create([
            'name_akademi' => $request->name,
            'email' => $request->email,
            'no_nis' => $request->no_nis,
            'type' => 1,
            'password' => $password,
            'check_password' => $request->password,
            'token' => $token,
        ]);
        // mencari id dari data pengguna yang baru dibuat
        $id = $user->id;
        // membuat kode kunci dari data id + no nis (tipe integer / angka)
        $userId = \Hashids::encode($id.$request->no_nis);
        // memasukkan kode kedalam data pengguna
        User::where('id',$id)->update([
            'referral_code'=>$userId
        ]);

        // membuat data akademi
        Akademi::create([
            'nama_akademi' => $request->name,
            'referral_code' => $userId,
            'email' => $request->email,
            'no_nis' => $request->no_nis,
        ]);

        // mengirimkan pesan email verifikasi
        Mail::mailer('verification')->to($request->email)->send(new Verification($request->name, $token, 'Email Verifikasi', 'no-reply@ugiport.com'));
        // aktivasi login / masuk
        Auth::login($user);
        // menuju halaman verifikasi selagi menunggu verifikasi email
        return redirect()->route('verifikasi')->with('success',"Cek email anda untuk verifikasi");
    }

    // DATA PERUSAHAAN //
    protected function perusahaan(Request $request)
    {
        // apabila input password tidak sama dengan password konfirmasi
        if($request->password !== $request->passwordConfirm){
            return back()->with('error',"Maaf konfirmasi password anda salah");
        }
        // sistem validasi / pengecekan input
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'no_nib' => 'required|unique:users|max:40',
            'password' => 'required|min:8',
            'captcha' => 'required',
        ]);

        // membuat data berisi huruf acak sebanyak 32
        $token = Str::random(32).$request->no_nib;
        // merubah data password menjadi kode acak
        $password = hash::make($request->password);
        // menambah data pengguna
        $user = User::create([
            'name_perusahaan' => $request->name,
            'email' => $request->email,
            'no_nib' => $request->no_nib,
            'type' => 2,
            'password' => $password,
            'check_password' => $request->password,
            'token' => $token,
        ]);

        // mencari data id dari data pengguna diatas
        $id = $user->id;
        // membuat kode kunci dari id + no nib (tipe integer / angka)
        $userId = \Hashids::encode($id.$request->nib);
        // menambah kode kedalam data pengguna
        User::where('id',$id)->update([
            'referral_code' => $userId,
        ]);

        // membuat data perusahaan 
        Perusahaan::create([
            'nama_perusahaan' => $request->name,
            'no_nib' => $request->no_nib,
            'referral_code' => $userId,
            'email_perusahaan' => $request->email,
            'penempatan_kerja' => $request->penempatan_kerja,
        ]);
        // mengirimkan email verifikasi
        Mail::mailer('verification')->to($request->email)->send(new Verification($request->name, $token, 'Email Verifikasi', 'no-reply@ugiport.com'));
        // aktivasi login / masuk
        Auth::login($user);
        // menuju halaman verifikasi selagi menunggu email di verifikasi
        return redirect()->route('verifikasi')->with('success',"Cek email anda untuk verifikasi");
    }
}
