<?php

namespace App\Http\Controllers;

use App\Models\Akademi;
use App\Models\AkademiKandidat;
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

    public function listKandidat()
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        $kandidat = AkademiKandidat::where('id_akademi',$akademi->id_akademi)->get();
        return view('akademi/list_kandidat',compact('akademi','kandidat'));
    }

    public function isi_personal()
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        // $kandidat = AkademiKandidat::where()->first();
        return view('akademi/kandidat/isi_personal',compact('akademi'));
    }

    public function simpan_personal(Request $request)
    {
        $validate = $request->validate([
            'no_telp' => 'required|unique:users|min:10|max:13',
            'email' => 'required|unique:users|max:255',
        ]);

        AkademiKandidat::create([
            'nama'=>$request->nama,
            'nama_panggilan'=>$request->nama_panggilan,
            'jenis_kelamin'=>$request->jenis_kelamin,
            'tmp_lahir'=>$request->tmp_lahir,
            'tgl_lahir'=>$request->tgl_lahir,
            'no_telp'=>$request->no_telp,
            'agama'=>$request->agama,
            'berat'=>$request->berat,
            'tinggi'=>$request->tinggi,
            'email'=>$request->email,
            'penempatan'=>$request->penempatan,
        ]);
        return redirect('/akademi/isi_kandidat_document');
    }

    public function isi_document()
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        return view('akademi/kandidat/isi_document',compact('akademi'));
    }

    public function simpan_document(Request $request)
    {
        dd($request);
        $kandidat = AkademiKandidat::where()->first();
        AkademiKandidat::where()->update([]);
    }

    public function isi_vaksin()
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        return view('akademi/kandidat/isi_vaksin',compact('akademi'));
    }

    public function simpan_vaksin()
    {

    }

    public function isi_parent()
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        return view('akademi/kandidat/isi_parent',compact('akademi'));
    }

    public function simpan_parent()
    {

    }

    public function isi_permission()
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        return view('akademi/kandidat/isi_permission',compact('akademi'));
    }

    public function simpan_permission()
    {

    }

    public function isi_placement()
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        return view('akademi/kandidat/isi_placement',compact('akademi'));
    }

    public function simpan_placement()
    {

    }

    public function isi_job()
    {
        $auth = Auth::user();
        $akademi = Akademi::where('referral_code',$auth->referral_code)->first();
        return view('akademi/kandidat/isi_job',compact('akademi'));
    }

    public function simpan_job()
    {

    }
}
