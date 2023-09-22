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
use App\Models\ContactUsAkademi;

class AkademiController extends Controller
{
    // halaman beranda / dashboard akademi
    public function index()
    {
        $id = Auth::user();
        $akademi = Akademi::where('referral_code',$id->referral_code)->first();
        $perusahaan = Perusahaan::whereNotNull('email_operator')->get();
        $pesan = messageAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $notif = notifyAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->limit(3)->get();
        $akademi_kandidat = Kandidat::where('id_akademi',$akademi->id_akademi)->limit(10)->get();
        $notifiA = notifyAkademi::where('created_at','<',Carbon::now()->subDays(14))->delete();
        // mereset ulang kesalahan saat login di data pengguna
        User::where('referral_code',$akademi->referral_code)->update([
            'counter' => null,
        ]);
        return view('/akademi/index',compact('akademi','perusahaan','akademi_kandidat','pesan','notif'));
    } 

    // halaman lihat profil akademi
    public function lihatProfilAkademi()
    {
        $user = Auth::user();
        $akademi = Akademi::where('referral_code',$user->referral_code)->first();
        $pesan = messageAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $notif = notifyAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->limit(3)->get();
        // apabila nama kepala akademi masih kosong
        if($akademi->nama_kepala_akademi == null){
            // menuju halaman beranda akademi
            return redirect()->route('akademi')->with('warning',"Harap lengkapi profil akademi terlebih dahulu");
        } else {
            // menuju profil akademi
            return view('akademi/lihat_profil_akademi',compact('akademi','pesan','notif'));
        }
    }

    // halaman isi akademi data
    public function isi_akademi_data()
    {
        $id = Auth::user();
        $akademi = Akademi::where('referral_code',$id->referral_code)->first();
        return view('akademi/modalAkademi/isi_akademi_data',compact('akademi'));
    }

    // sistem simpan data akademi
    public function simpan_akademi_data(Request $request)
    {
        $id = Auth::user();
        $akademi = Akademi::where('referral_code',$id->referral_code)->first();
        // cek foto akademi
        // apabila ada inputan
        if($request->file('foto_akademi') !== null){
            // pengecekan data foto sebelumnya dan hapus jika ada
            $hapus_foto_akademi = public_path('/gambar/Akademi/'.$akademi->nama_akademi.'/Foto Akademi/').$akademi->foto_akademi;
            if(file_exists($hapus_foto_akademi)){
                @unlink($hapus_foto_akademi);
            }
            // memasukkan data file foto ke dalam aplikasi
            $foto_akademi = $request->file('foto_akademi');
            $simpan_foto_akademi = $akademi->nama_akademi.time().'.'.$foto_akademi->extension();  
            $foto_akademi->move('gambar/Akademi/'.$akademi->nama_akademi.'/Foto Akademi/',$akademi->nama_akademi.time().'.'.$simpan_foto_akademi);
        } else {
            // pengecekan data foto ada atau tidak
            if($akademi->foto_akademi !== null){
                $simpan_foto_akademi = $akademi->foto_akademi;                
            } else {
                $simpan_foto_akademi = null;                        
            }
        }
        // cek logo akademi
        if($request->file('logo_akademi') !== null){
            // pengecekan data foto sebelumnya dan hapus jika ada
            $hapus_logo_akademi = public_path('/gambar/Akademi/'.$akademi->nama_akademi.'/Logo Akademi/').$akademi->logo_akademi;
            if(file_exists($hapus_logo_akademi)){
                @unlink($hapus_logo_akademi);
            }
            // memasukkan data file foto ke dalam aplikasi
            $logo_akademi = $request->file('logo_akademi');
            $simpan_logo_akademi = $akademi->nama_akademi.time().'.'.$request->logo_akademi->extension();  
            $logo_akademi->move('gambar/Akademi/'.$akademi->nama_akademi.'/Logo Akademi/',$simpan_logo_akademi);
        } else {
            if($akademi->logo_akademi !== null){
                $simpan_logo_akademi = $akademi->logo_akademi;                
            } else {
                $simpan_logo_akademi = null;                        
            }
        }
        // cek data foto ada atau kosong
        if ($simpan_foto_akademi !== null) {
            $photo_akademi = $simpan_foto_akademi;
        } else {
            $photo_akademi = null;
        }

        if ($simpan_logo_akademi !== null) {
            $logos_akademi = $simpan_logo_akademi;
        } else {
            $logos_akademi = null;
        }
        // mencari alamat dengan id
        $prov = Provinsi::where('id',$request->provinsi_id)->first();
        $kota = Kota::where('id',$request->kota_id)->first();
        $kec = Kecamatan::where('id',$request->kecamatan_id)->first();
        $kel = Kelurahan::where('id',$request->kelurahan_id)->first();

        // menambah data akademi
        $akademi = Akademi::where('referral_code',$id->referral_code)->update([
            'no_surat_izin' => $request->no_surat_izin,
            'alamat_akademi' => $request->alamat_akademi,
            'no_telp_akademi' => $request->no_telp_akademi,
            'foto_akademi' => $photo_akademi,
            'logo_akademi' => $logos_akademi,
            'provinsi' => $prov->provinsi,
            'kota' => $kota->kota,
            'kecamatan' => $kec->kecamatan,
            'kelurahan' => $kel->kelurahan,
        ]);

        return redirect()->route('akademi.operator')
        // ->with('toast_success',"Data anda tersimpan");
        ->with('success',"Data anda tersimpan");
    }

    // halaman isi data akademi operator
    public function isi_akademi_operator()
    {
        $id = Auth::user();
        $akademi = Akademi::where('referral_code',$id->referral_code)->first();
        return view('akademi/modalAkademi/isi_akademi_operator',compact('akademi'));
    }

    // sistem simpan data akademi operator
    public function simpan_akademi_operator(Request $request)
    {
        $id = Auth::user();
        // menambah data operator
        $akademi = Akademi::where('referral_code',$id->referral_code)->update([
            'nama_kepala_akademi' => $request->nama_kepala_akademi,
            'nama_operator' => $request->nama_operator,
            'email_operator' => $request->email_operator,
            'no_telp_operator' => $request->no_telp_operator,
        ]);
        return redirect('/akademi')->with('success',"Data anda tersimpan");
    }

    // halaman hub. kami / bantuan bagian akademi
    public function contactUsAkademi()
    {
        $id = Auth::user();
        $akademi = Akademi::where('referral_code',$id->referral_code)->first();
        $pesan = messageAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $notif = notifyAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->limit(3)->get();
        return view('akademi/contact_us',compact('akademi','pesan','notif'));
    }

    // proses kirim pesan contact us akademi
    public function sendContactUsAkademi(Request $request)
    {
        $user = Auth::user();
        $akademi = Akademi::where('referral_code',$user->referral_code)->first();
        ContactUsAkademi::create([
            'id_akademi' => $akademi->id_akademi,
            'dari' => $akademi->nama_akademi,
            'isi' => $request->isi,
            'balas' => "belum dibaca",
        ]);
        return redirect('/akademi/contact_us_akademi')->with('success',"Pesan telah terkirim");
    }

    // halaman data kandidat dalam akademi
    public function listKandidat()
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $kandidat = Kandidat::where('id_akademi',$akademi->id_akademi)->get();
        $pesan = messageAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $notif = notifyAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->limit(3)->get();
        return view('akademi/list_kandidat',compact('akademi','kandidat','pesan','notif'));
    }

    // halaman lihat profil kandidat
    public function lihatProfilKandidat($nama, $id)
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $kandidat = Kandidat::where('id',$id)->where('nama',$nama)->first();
        $tgl_user = Carbon::create($kandidat->tgl_lahir)->isoFormat('D MMM Y');
        $pesan = messageAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $notif = notifyAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->limit(3)->get();
        // menampilkan data negara + kandidat akademi
        $negara = Negara::join(
            'akademi_kandidat','ref_negara.negara_id','=','akademi_kandidat.negara_id'
        )
        ->first();
        return view('akademi/kandidat/profil_kandidat',compact('akademi','kandidat','negara','tgl_user','pesan','notif'));
    }

    // halaman data pesan akademi
    public function messageAkademi()
    {
        $user = Auth::user();
        $akademi = Akademi::where('referral_code',$user->referral_code)->first();
        $pesan = messageAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $semua_pesan = messageAkademi::where('id_akademi',$akademi->id_akademi)->get();
        $notif = notifyAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->where('check_click',"n")->get();
        return view('akademi/semua_pesan',compact('akademi','pesan','semua_pesan','notif'));
    }

    // halaman lihat pesan akademi
    public function sendMessageAkademi($id)
    {
        $auth = Auth::user();
        $akademi = akademi::where('referral_code',$auth->referral_code)->first();
        $notif = notifyAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $pesan = messageAkademi::where('id_akademi',$akademi->id_akademi)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $pengirim = messageakademi::where('id',$id)->first();
        return view('akademi/lihat_pesan',compact('akademi','pesan','notif','pengirim','id'));
    }

    // sistem hapus pesan akademi
    public function deleteMessageAkademi($id)
    {
        $user = Auth::user();
        $akademi = Akademi::where('referral_code',$user->referral_code)->first();
        $hapus_pesan = messageAkademi::where('id',$id)->delete();
        return redirect('/akademi/semua_pesan')->with('success',"Pesan telah dihapus");
    }
}
