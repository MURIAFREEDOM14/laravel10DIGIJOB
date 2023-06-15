<?php

namespace App\Http\Controllers;

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
        Negara::create([
            'negara' => $request->negara,
            'kode_negara' => $request->kode_negara,
            'syarat_umur' => $request->syarat_umur,
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
        Negara::where('negara_id',$id)->update([
            'negara' => $request->negara,
            'kode_negara' => $request->kode_negara,
            'syarat_umur' => $request->syarat_umur,
        ]);
        return redirect('/manager/negara_tujuan')->with('success',"Data berhasil diubah");
    }

    public function hapusNegara($id)
    {
        Negara::where('negara_id',$id)->delete();
        return redirect('/manager/negara_tujuan')->with('success',"Data berhasil dihapus");
    }
}