<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Negara;
use App\Models\User;

class NegaraController extends Controller
{
    public function index()
    {
        $auth = Auth::user();
        $manager = User::where('type',3)->first();
        $negara = Negara::all();
        return view('manager/negara/negara',compact('negara','manager'));
    }

    public function lihatNegara($id)
    {
        $auth = Auth::user();
        $manager = User::where('type',3)->first();
        $negara = Negara::where('negara_id',$id)->first();
        return view('manager/negara/lihat_negara',compact('negara','manager'));
    }

    public function tambahNegara()
    {
        $auth = Auth::user();
        $manager = User::where('type',3)->first();
        return view('manager/negara/tambah_negara',compact('manager'));
    }

    public function simpanNegara(Request $request)
    {
        $auth = Auth::user();
        $manager = User::where('type',3)->first();
        if($request->file('gambar') !== null){
            $foto = $request->negara.time().'.'.$request->gambar->extension();  
            $simpan_gambar = $request->file('gambar');
            $simpan_gambar->move('gambar/Manager/Foto/Icon',$request->negara.time().'.'.$simpan_gambar->extension()); 
            
        } else {
            $foto = null;
        }

        Negara::create([
            'negara' => $request->negara,
            'kode_negara' => $request->kode_negara,
            'syarat_umur' => $request->syarat_umur,
            'deskripsi' => $request->deskripsi,
            'gambar' => $foto,
        ]);
        return redirect('/manager/negara_tujuan')->with('success',"Data berhasil ditambahkan");
    }

    public function editNegara($id)
    {
        $auth = Auth::user();
        $manager = User::where('type',3)->first();
        $negara = Negara::where('negara_id',$id)->first();
        return view('manager/negara/edit_negara',compact('manager','negara'));
    }

    public function ubahNegara(Request $request, $id)
    {
        $auth = Auth::user();
        $manager = User::where('type',3)->first();
        $negara = Negara::where('negara_id',$id)->first();

        if($request->file('gambar') !== null){
            $hapus_icon = public_path('/gambar/Manager/Foto/Icon').$negara->gambar;
            if(file_exists($hapus_icon)){
                @unlink($hapus_icon);
            }
            $gambar = $request->negara.time().'.'.$request->gambar->extension();  
            $simpan_gambar = $request->file('gambar');
            $simpan_gambar->move('gambar/Manager/Foto/Icon/',$request->negara.time().'.'.$simpan_gambar->extension());
        } else {
            if($negara->gambar !== null){
                $gambar = $negara->gambar;
            } else {
                $gambar = null;
            }
        }

        if ($gambar !== null) {
            $foto = $gambar;
        } else {
            $foto = null;
        }

        Negara::where('negara_id',$id)->update([
            'negara' => $request->negara,
            'kode_negara' => $request->kode_negara,
            'syarat_umur' => $request->syarat_umur,
            'deskripsi' => $request->deskripsi,
            'gambar' => $foto,
        ]);
        return redirect('/manager/negara_tujuan')->with('success',"Data berhasil diubah");
    }

    public function hapusNegara($id)
    {
        Negara::where('negara_id',$id)->delete();
        return redirect('/manager/negara_tujuan')->with('success',"Data berhasil dihapus");
    }
}