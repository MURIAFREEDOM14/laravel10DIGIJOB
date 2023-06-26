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
use App\Models\PengalamanKerja;
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
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         // 'username' => ['required', 'string', 'unique:users', 'alpha_dash', 'min:3', 'max:30'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         // 'password' => ['required', 'string']
    //         // 'ic_number' => ['required'],
    //         'no_telp' => ['required', 'unique:users', 'max:12']
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    // protected function create(array $data)
    // {
    //     // dd($data);
    //     $no_telp = $data['no_telp'];
    //     $userId = \Hashids::encode($no_telp);

    //     $pengirim = [
    //         'pengirim' => $data['name'],
    //         'user_referral' => $userId
    //     ];
    //     Mail::to($data['email'])->send(new DemoMail($pengirim));

    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'referral_code' => $userId,
    //         'no_telp' => $data['no_telp']
    //     ]);
    // }

    public function kandidat(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'nik' => 'required|max:16|min:16|unique:kandidat',
            'email' => 'required|unique:users|max:255',
            'no_telp' => 'required|unique:users|min:10|max:13',
            'nama_panggilan' => 'required|unique:kandidat|min:5|max:20',
            'password' => 'required',
        ]);
     
        $tgl = Carbon::parse($request->tgl)->age;
        if($tgl < 18){
            return redirect('/register/kandidat')->with('warning',"Maaf umur anda belum cukup, syarat umur ialah 18 thn keatas");
        }

        $password = Hash::make($request->password);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'password' => $password,
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

        Auth::login($user);

        $kandidat = Kandidat::where('referral_code',$userId)->first(); 
        $data['id_kandidat'] = $kandidat->id_kandidat;
        $data['isi'] = "Harap lengkapi data profil anda";
        $data['pengirim'] = "Admin";
        $data['url'] = ('/isi_kandidat_personal');
        notifyKandidat::create($data);
        
        return redirect()->route('kandidat')->with('success',"Selamat Datang");
    }

    // $pengirim = [
        //     'name' => $request->name,
        //     'user_referral' => $userId
        // ];
        // Mail::to($request->email)->send(new DemoMail($pengirim));

    protected function akademi(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'no_nis' => 'required|unique:users|max:40',
            'password' => 'required|min:8',
        ]);

        $password = Hash::make($request->password);

        $user = User::create([
            'name_akademi' => $request->name,
            'email' => $request->email,
            'no_nis' => $request->no_nis,
            'type' => 1,
            'password' => $password,
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

        Auth::login($user);
        $akademi = Akademi::where('referral_code',$userId)->first(); 
        $data['id_akademi'] = $akademi->id_akademi;
        $data['isi'] = "Harap lengkapi data profil anda";
        $data['pengirim'] = "Admin";
        $data['url'] = ('/akademi/isi_akademi_data');
        notifyAkademi::create($data);
        return redirect()->route('akademi')->with('success',"Selamat Datang");
    }

    protected function perusahaan(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'no_nib' => 'required|unique:users|max:40',
            'password' => 'required|min:8',
        ]);

        $password = hash::make($request->password);

        $user = User::create([
            'name_perusahaan' => $request->name,
            'email' => $request->email,
            'no_nib' => $request->no_nib,
            'type' => 2,
            'password' => $password,
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

        Auth::login($user);
        $perusahaan = Perusahaan::where('referral_code',$userId)->first(); 
        $data['id_perusahaan'] = $perusahaan->id_perusahaan;
        $data['isi'] = "Harap lengkapi data profil anda";
        $data['pengirim'] = "Admin";
        $data['url'] = ('/perusahaan/isi_perusahaan_data');
        notifyPerusahaan::create($data);
        return redirect()->route('perusahaan')->with('success',"Selamat Datang");
    }
}
