<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PrototypeController extends Controller
{
    public function test2()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code', $id->referral_code)->first();
        return view('prototype2', compact('kandidat'));
    }
    public function test3()
    {
        return view('prototype3');
    }

    public function tgl()
    {
        $umur = "";
        return view('prototype',compact('umur'));
    }

    public function umur(Request $request)
    {
        $umur = Carbon::parse($request->tgl)->age;
        return view('prototype',compact('umur'));
    }
}
