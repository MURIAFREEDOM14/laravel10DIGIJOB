<?php

namespace App\Http\Controllers\Akademi;

use App\Http\Controllers\Controller;
use App\Models\Akademi;
use App\Models\AkademiKandidat;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Kota;
use App\Models\LowonganPekerjaan;
use App\Models\Negara;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Perusahaan;
use App\Models\Kandidat;
use App\Models\messageAkademi;
use App\Models\notifyAkademi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AkademiController extends Controller
{
    public function index()
    {
        $id = Auth::user();
        $akademi = Akademi::where('referral_code',$id->referral_code)->first();
        $perusahaan = Perusahaan::whereNotNull('email_operator')->get();
        $pesan = messageAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->limit(3)->get();
        $notif = notifyAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->limit(3)->get();
        $akademi_kandidat = Kandidat::where('id_akademi',$akademi->id_akademi)->limit(10)->get();
        $notifiA = notifyAkademi::where('created_at','<',Carbon::now()->subDays(14))->delete();
        User::where('referral_code',$akademi->referral_code)->update([
            'counter' => null,
        ]);
        return view('/akademi/index',compact('akademi','perusahaan','akademi_kandidat','pesan','notif'));
    } 

    public function isi_akademi_data()
    {
        $id = Auth::user();
        $akademi = Akademi::where('referral_code',$id->referral_code)->first();
        return view('akademi/isi_akademi_data',compact('akademi'));
    }

    public function simpan_akademi_data(Request $request)
    {
        // dd($request);
        $id = Auth::user();
        $akademi = Akademi::where('referral_code',$id->referral_code)->first();
        if($request->file('foto_akademi') !== null){
            // $this->validate($request, [
            //     'foto_ktp_izin' => 'required|file|image|mimes:jpeg,png,jpg|max:1024',
            // ]);
            $hapus_foto_akademi = public_path('/gambar/Akademi/'.$akademi->nama_akademi.'/Foto Akademi/').$akademi->foto_akademi;
            if(file_exists($hapus_foto_akademi)){
                @unlink($hapus_foto_akademi);
            }
            $foto_akademi = $akademi->nama_akademi.time().'.'.$request->foto_akademi->extension();  
            $simpan_foto_akademi = $request->file('foto_akademi');
            $simpan_foto_akademi->move('gambar/Akademi/'.$akademi->nama_akademi.'/Foto Akademi/',$akademi->nama_akademi.time().'.'.$simpan_foto_akademi->extension());
        } else {
            if($akademi->foto_akademi !== null){
                $foto_akademi = $akademi->foto_akademi;                
            } else {
                $foto_akademi = null;                        
            }
        }
        
        if($request->file('logo_akademi') !== null){
            // $this->validate($request, [
            //     'foto_ktp_izin' => 'required|file|image|mimes:jpeg,png,jpg|max:1024',
            // ]);
            $hapus_logo_akademi = public_path('/gambar/Akademi/'.$akademi->nama_akademi.'/Logo Akademi/').$akademi->logo_akademi;
            if(file_exists($hapus_logo_akademi)){
                @unlink($hapus_logo_akademi);
            }
            $logo_akademi = $akademi->nama_akademi.time().'.'.$request->logo_akademi->extension();  
            $simpan_logo_akademi = $request->file('logo_akademi');
            $simpan_logo_akademi->move('gambar/Akademi/'.$akademi->nama_akademi.'/Logo Akademi/',$akademi->nama_akademi.time().'.'.$simpan_logo_akademi->extension());
        } else {
            if($akademi->logo_akademi !== null){
                $logo_akademi = $akademi->logo_akademi;                
            } else {
                $logo_akademi = null;                        
            }
        }

        if ($foto_akademi !== null) {
            $photo_akademi = $foto_akademi;
        } else {
            $photo_akademi = null;
        }

        if ($logo_akademi !== null) {
            $logos_akademi = $logo_akademi;
        } else {
            $logos_akademi = null;
        }

        $akademi = Akademi::where('referral_code',$id->referral_code)->update([
            'no_surat_izin' => $request->no_surat_izin,
            'alamat_akademi' => $request->alamat_akademi,
            'no_telp_akademi' => $request->no_telp_akademi,
            'foto_akademi' => $photo_akademi,
            'logo_akademi' => $logos_akademi,
        ]);

        // User::where('referral_code',$id->referral_code)->update([
        //     'name_akademi'=>$request->nama,
        //     'no_nis' => $request->no_nis,
        //     'email' => $request->email,
        // ]);
        return redirect()->route('akademi.operator')
        // ->with('toast_success',"Data anda tersimpan");
        ->with('success',"Data anda tersimpan");
    }

    public function isi_akademi_operator()
    {
        $id = Auth::user();
        $akademi = Akademi::where('referral_code',$id->referral_code)->first();
        return view('akademi/isi_akademi_operator',compact('akademi'));
    }

    public function simpan_akademi_operator(Request $request)
    {
        $id = Auth::user();
        $akademi = Akademi::where('referral_code',$id->referral_code)->update([
            'nama_kepala_akademi' => $request->nama_kepala_akademi,
            'nama_operator' => $request->nama_operator,
            'email_operator' => $request->email_operator,
            'no_telp_operator' => $request->no_telp_operator,
        ]);
        return redirect('/akademi')->with('success',"Data anda tersimpan");
    }

    public function contactUsAkademi()
    {
        $id = Auth::user();
        $akademi = Akademi::where('referral_code',$id->referral_code)->first();
        $pesan = messageAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->limit(3)->get();
        $notif = notifyAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->limit(3)->get();
        return view('akademi/contact_us',compact('akademi','pesan','notif'));
    }

    public function lihatProfilAkademi()
    {
        $user = Auth::user();
        $akademi = Akademi::where('referral_code',$user->referral_code)->first();
        $pesan = messageAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->limit(3)->get();
        $notif = notifyAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->limit(3)->get();
        if($akademi->nama_kepala_akademi == null){
            return redirect()->route('akademi')->with('warning',"Harap lengkapi profil akademi terlebih dahulu");
        } else {
            return view('akademi/lihat_profil_akademi',compact('akademi','pesan','notif'));
        }
    }

    public function editProfilAkademi()
    {
        return redirect()->route('akademi.data');
    }

    public function lihatProfilPerusahaan($id)
    {
        $user = Auth::user();
        $akademi = Akademi::where('referral_code',$user->referral_code)->first();
        $perusahaan = Perusahaan::where('id_perusahaan',$id)->first();
        $pesan = messageAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->limit(3)->get();
        $notif = notifyAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->limit(3)->get();
        $lowongan = LowonganPekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        return view('akademi/lihat_profil_perusahaan',compact('akademi','perusahaan','pesan','notif','lowongan'));
    }

    public function listKandidat()
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $kandidat = Kandidat::where('id_akademi',$akademi->id_akademi)->get();
        $pesan = messageAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->limit(3)->get();
        $notif = notifyAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->limit(3)->get();
        return view('akademi/list_kandidat',compact('akademi','kandidat','pesan','notif'));
    }

    public function lihatProfilKandidat($nama, $id)
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $kandidat = Kandidat::where('id',$id)->where('nama',$nama)->first();
        $tgl_user = Carbon::create($kandidat->tgl_lahir)->isoFormat('D MMM Y');
        $pesan = messageAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->limit(3)->get();
        $notif = notifyAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->limit(3)->get();
        $negara = Negara::join(
            'akademi_kandidat','ref_negara.negara_id','=','akademi_kandidat.negara_id'
        )
        ->first();
        return view('akademi/kandidat/profil_kandidat',compact('akademi','kandidat','negara','tgl_user','pesan','notif'));
    }
}
