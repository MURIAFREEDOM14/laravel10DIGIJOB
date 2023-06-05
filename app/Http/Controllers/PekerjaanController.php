<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pekerjaan;
use App\Models\Negara;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PekerjaanController extends Controller
{
    public function index()
    {
        $id_pekerjaan = "";
        $negara_id = "";
        $negara = Negara::all();
        $manager = Auth::user();
        $data_kerja = Pekerjaan::join(
            'ref_negara','pekerjaan.negara_id','=','ref_negara.negara_id'
        )
        ->where('pekerjaan.id_pekerjaan','like',"%".$id_pekerjaan."%")
        ->where('pekerjaan.negara_id','like',"%".$negara_id."%")->get();    
        $pekerjaan = Pekerjaan::join(
            'ref_negara', 'pekerjaan.negara_id','=','ref_negara.negara_id'
        )->get();
        return view('manager/pekerjaan/pekerjaan',compact(
            'pekerjaan','id_pekerjaan',
            'negara','negara_id','data_kerja',
            'manager'
        ));
    }

    public function pencarian(Request $request)
    {
        // dd($request);
        $id_pekerjaan = $request->id_pekerjaan;
        $negara_id = $request->negara_id;
        $manager = Auth::user();
        $pekerjaan = Pekerjaan::all();
        $data_kerja = Pekerjaan::join(
            'ref_negara','pekerjaan.negara_id','=','ref_negara.negara_id'
        )
        ->where('pekerjaan.id_pekerjaan','like','%'.$id_pekerjaan.'%')
        ->where('pekerjaan.negara_id','like','%'.$negara_id.'%')->get();
        $negara = Negara::all();
        return view('manager/pekerjaan/pekerjaan',compact(
            'pekerjaan','id_pekerjaan','negara','negara_id',
            'manager','data_kerja'
        ));
    }    

    public function create()
    {
        $negara = Negara::all();
        $manager = Auth::user();
        return view('manager/pekerjaan/tambah_pekerjaan',compact('negara','manager'));
    }

    public function store(Request $request)
    {
        Pekerjaan::create([
            'nama_pekerjaan' => $request->nama_pekerjaan,
            'syarat_umur' => $request->syarat_umur,
            'syarat_kelamin' => $request->syarat_kelamin,
            'negara_id' => $request->negara_id
        ]);
        return redirect('/manager/pekerjaan');
    }

    public function edit($id)
    {
        $negara = Negara::all();
        $pekerjaan = Pekerjaan::where('id_pekerjaan',$id)->first();
        $manager = Auth::user();
        return view('manager/pekerjaan/edit_pekerjaan',compact('negara','pekerjaan','manager'));
    }

    public function update(Request $request, $id)
    {
        Pekerjaan::where('id_pekerjaan',$id)->update([
            'nama_pekerjaan' => $request->nama_pekerjaan,
            'syarat_umur' => $request->syarat_umur,
            'syarat_kelamin' => $request->syarat_kelamin,
            'negara_id' => $request->negara_id
        ]);
        return redirect('/manager/pekerjaan');
    }

    public function delete($id)
    {
        Pekerjaan::where('id_pekerjaan',$id)->delete();
        return redirect('/manager/pekerjaan');
    }
}
