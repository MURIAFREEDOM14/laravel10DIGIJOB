<?php

namespace App\Http\Controllers;

use App\Mail\Noreply;
use App\Models\Kandidat;
use App\Models\Kecamatan;
use App\Models\Negara;
use App\Models\Kota;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class PrototypeController extends Controller
{
    public function test()
    {
        $prov = Provinsi::get();
        return view('/prototype',compact('prov'));
    }

    public function select(Request $request)
    {
        $data = Kota::where('provinsi_id',$request->id)->get();
        return response()->json($data);
    }

    // public function select1(Request $request)
    // {
    //     $data = Kota::where('provinsi_id',$request->id)->get();
    //     return response()->json($data);
    // }

    public function create()
    {
        return view('prototype/proto_create');
    }

    public function edit($id)
    {
        return view('prototype/proto_edit');
    }

    public function delete()
    {

    }

    public function email()
    {
        $pengirim = [
            $email = "strikefreedomfalken14@gmail.com",
            $isi = "hello Freedom",
        ];
        Mail::to($email)->send(new Noreply($pengirim));
        return redirect('/prototype')->with('success',"TERKIRIM");
    }

    public function cek(Request $request)
    {
        dd($request);
    }
}
