<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use App\Models\Kecamatan;
use App\Models\Negara;
use App\Models\Kota;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
}
