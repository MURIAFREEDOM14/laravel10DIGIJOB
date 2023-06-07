<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use App\Models\Kecamatan;
use App\Models\Negara;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PrototypeController extends Controller
{
    public function test()
    {
        $data = Provinsi::get();
        return view('/prototype',compact('data'));
    }

    public function cek(Request $request)
    {
        $data = Kecamatan::where("provinsi_id", $request->country_id)
        ->get();
  
        return response()->json($data);
    }
}
