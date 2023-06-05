<?php

namespace App\Http\Controllers;

use App\Models\Akademi;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AkademiController extends Controller
{
    public function index()
    {
        $id = Auth::user();
        $akademi = Akademi::where('referral_code',$id->referral_code)->first();
        return view('/akademi/akademi_index',compact('akademi'));
    } 

    public function isi_akademi_data()
    {
        $id = Auth::user();
        $akademi = Akademi::where('referral_code',$id->referral_code)->first();
        return view('akademi/isi_akademi_data',compact('akademi'));
    }

    public function simpan_akademi_data(Request $request)
    {
        $id = Auth::user();
        $akademi = Akademi::where('referral_code',$id->referral_code)->first();
        if($request->file('foto_akademi') !== null){
            // $this->validate($request, [
            //     'foto_ktp_izin' => 'required|file|image|mimes:jpeg,png,jpg|max:1024',
            // ]);
            $foto_akademi = time().'.'.$request->foto_akademi->extension();  
            $request->foto_akademi->move(public_path('/gambar/Foto Akademi'), $foto_akademi);
        } else {
            if($akademi->foto_akademi !== null){
                $foto_akademi = $akademi->foto_akademi;                
            } else {
                $foto_akademi = null;                        
            }
        }

        if ($foto_akademi !== null) {
            $photo_akademi = $foto_akademi;
        } else {
            $photo_akademi = null;
        }

        $akademi = Akademi::where('referral_code',$id->referral_code)->update([
            'nama' => $request->nama,
            'no_nis' => $request->no_nis,
            'email' => $request->email,
            'no_surat_izin' => $request->no_surat_izin,
            'alamat_akademi' => $request->alamat_akademi,
            'no_telp_akademi' => $request->no_telp_akademi,
            'foto_akademi' => $photo_akademi,
        ]);

        User::where('referral_code',$id->referral_code)->update([
            'name_akademi'=>$request->nama,
            'no_nis' => $request->no_nis,
            'email' => $request->email,
        ]);
        return redirect('/isi_akademi_operator');
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
        ]);
        return redirect('/');
    }
}
