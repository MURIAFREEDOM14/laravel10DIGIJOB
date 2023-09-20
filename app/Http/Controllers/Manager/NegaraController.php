<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Negara;
use App\Models\User;

class NegaraController extends Controller
{
    // halaman semua data negara
    public function index()
    {
        $auth = Auth::user();
        $manager = User::where('type',3)->first();
        $negara = Negara::all();
        return view('manager/negara/negara',compact('negara','manager'));
    }

    // halaman lihat informasi negara
    public function lihatNegara($id)
    {
        $auth = Auth::user();
        $manager = User::where('type',3)->first();
        $negara = Negara::where('negara_id',$id)->first();
        return view('manager/negara/lihat_negara',compact('negara','manager'));
    }

    // halaman tambah data negara
    public function tambahNegara()
    {
        $auth = Auth::user();
        $manager = User::where('type',3)->first();
        return view('manager/negara/tambah_negara',compact('manager'));
    }

    // sistem simpan data negara
    public function simpanNegara(Request $request)
    {
        $auth = Auth::user();
        $manager = User::where('type',3)->first();
        // simpan file foto negara ke dalam aplikasi
        if($request->file('gambar') !== null){
            $gambar = $request->file('gambar');
            $simpan_gambar = $request->negara.time().'.'.$gambar->extension();  
            $gambar->move('gambar/Manager/Foto/Icon/Negara',$simpan_gambar); 
        } else {
            $simpan_gambar = null;
        }

        // buat data negara
        Negara::create([
            'negara' => $request->negara,
            'kode_negara' => $request->kode_negara,
            'syarat_umur' => $request->syarat_umur,
            'deskripsi' => $request->deskripsi,
            'gambar' => $simpan_gambar,
        ]);
        return redirect('/manager/negara_tujuan')->with('success',"Data berhasil ditambahkan");
    }

    // halaman edit data negara
    public function editNegara($id)
    {
        $auth = Auth::user();
        $manager = User::where('type',3)->first();
        $negara = Negara::where('negara_id',$id)->first();
        return view('manager/negara/edit_negara',compact('manager','negara'));
    }

    // ubah data negara
    public function ubahNegara(Request $request, $id)
    {
        $auth = Auth::user();
        $manager = User::where('type',3)->first();
        $negara = Negara::where('negara_id',$id)->first();
        // cek file gambar
        // apabila ada input
        if($request->file('gambar') !== null){
            // mencari file sebelumnya dan menghapusnya bila ada
            $hapus_icon = public_path('/gambar/Manager/Foto/Icon/Negara').$negara->gambar;
            if(file_exists($hapus_icon)){
                @unlink($hapus_icon);
            }
            // menambahkan gambar ke dalam aplikasi
            $gambar = $request->file('gambar');
            $simpan_gambar = $request->negara.time().'.'.$gambar->extension();  
            $gambar->move('gambar/Manager/Foto/Icon/Negara/',$simpan_gambar);
        } else {
            if($negara->gambar !== null){
                $simpan_gambar = $negara->gambar;
            } else {
                $simpan_gambar = null;
            }
        }

        if ($simpan_gambar !== null) {
            $foto = $simpan_gambar;
        } else {
            $foto = null;
        }

        // menambahkan data negara
        Negara::where('negara_id',$id)->update([
            'negara' => $request->negara,
            'kode_negara' => $request->kode_negara,
            'syarat_umur' => $request->syarat_umur,
            'deskripsi' => $request->deskripsi,
            'gambar' => $foto,
        ]);
        return redirect('/manager/negara_tujuan')->with('success',"Data berhasil diubah");
    }

    // sistem menghapus data negara
    public function hapusNegara($id)
    {
        Negara::where('negara_id',$id)->delete();
        return redirect('/manager/negara_tujuan')->with('success',"Data berhasil dihapus");
    }
}