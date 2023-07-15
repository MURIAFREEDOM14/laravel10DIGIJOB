<?php

namespace App\Http\Controllers;

use App\Models\Negara;
use Illuminate\Http\Request;
use App\Models\Kandidat;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Stevebauman\Location\Facades\Location;
use App\Models\PMIID;

class OutputController extends Controller
{
    public function index()
    {
        // dd(location::get());
        // $ip = '103.111.137.82';
        // $tmp_user = Location::get($ip);
        
        $calendar = "2023-05-09";
        $print = Carbon::create($calendar)->isoFormat('D MMM Y');
        $tgl_print = Carbon::now()->isoFormat('D MMM Y');
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        if($kandidat->negara_id == null)
        {
            return redirect('/isi_kandidat_personal');
        }
        if ($kandidat->negara == "loc") {
            $negara = "Indonesia";
        }
        $tgl_user = Carbon::create($kandidat->tgl_lahir)->isoFormat('D MMM Y');
        $tgl_perizin = Carbon::create($kandidat->tgl_lahir_perizin)->isoFormat('D MMM Y');
        // dd($tmp_user->cityName);
        $negara = Negara::join(
            'kandidat', 'ref_negara.negara_id','=','kandidat.negara_id'
        )
        ->where('referral_code',$id->referral_code)
        ->first();
        if ($kandidat->periode_awal1 !== null) {
            $periode_awal1 = Carbon::create($kandidat->periode_awal1)->isoFormat('D MMM Y');
            $periode_akhir1 = Carbon::create($kandidat->periode_akhir1)->isoFormat('D MMM Y');
        } else {
            $periode_awal1 = null;
            $periode_akhir1 = null;
        }
        if ($kandidat->periode_awal2 !== null) {
            $periode_awal2 = Carbon::create($kandidat->periode_awal2)->isoFormat('D MMM Y');
            $periode_akhir2 = Carbon::create($kandidat->periode_akhir2)->isoFormat('D MMM Y');
        } else {
            $periode_awal2 = null;
            $periode_akhir2 = null;
        }
        if ($kandidat->periode_awal3 !== null){
            $periode_awal3 = Carbon::create($kandidat->periode_awal3)->isoFormat('D MMM Y');
            $periode_akhir3 = Carbon::create($kandidat->periode_akhir3)->isoFormat('D MMM Y');    
        } else {
            $periode_awal3 = null;
            $periode_akhir3 = null;
        }
        return view('Output/output',compact(
            'kandidat',
            'tgl_print',
            'print',
            'tgl_user',
            'tgl_perizin',
            'negara',
            'periode_awal1',
            'periode_awal2',
            'periode_awal3',
            'periode_akhir1',
            'periode_akhir2',
            'periode_akhir3',
        ));
    }

    public function card()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $negara = Negara::join(
            'kandidat', 'ref_negara.negara_id','=','kandidat.negara_id'
        )
        ->where('referral_code',$id->referral_code)
        ->first();
        $tgl_user = Carbon::create($kandidat->tgl_lahir)->isoFormat('D MMM Y');
        if ($kandidat->periode_awal1 !== null) {
            $periode_awal1 = Carbon::create($kandidat->periode_awal1)->isoFormat('D MMM Y');
            $periode_akhir1 = Carbon::create($kandidat->periode_akhir1)->isoFormat('D MMM Y');
        } else {
            $periode_awal1 = null;
            $periode_akhir1 = null;
        }
        if ($kandidat->periode_awal2 !== null) {
            $periode_awal2 = Carbon::create($kandidat->periode_awal2)->isoFormat('D MMM Y');
            $periode_akhir2 = Carbon::create($kandidat->periode_akhir2)->isoFormat('D MMM Y');
        } else {
            $periode_awal2 = null;
            $periode_akhir2 = null;
        }
        if ($kandidat->periode_awal3 !== null){
            $periode_awal3 = Carbon::create($kandidat->periode_awal3)->isoFormat('D MMM Y');
            $periode_akhir3 = Carbon::create($kandidat->periode_akhir3)->isoFormat('D MMM Y');    
        } else {
            $periode_awal3 = null;
            $periode_akhir3 = null;
        }
        return view('Output/output_card',compact('kandidat',
            'negara',
            'tgl_user',
            'periode_awal1',
            'periode_awal2',
            'periode_awal3',
            'periode_akhir1',
            'periode_akhir2',
            'periode_akhir3',
        ));
    }

    public function cetak($id)
    {
        $kandidat = Kandidat::join(
            'ref_negara', 'kandidat.negara_id','=','ref_negara.negara_id'
        )
        ->where('id_kandidat',$id)->first();
        $tgl_print = Carbon::now()->isoFormat('D MMM Y');
        if ($kandidat->negara == "loc") {
            $negara = "Indonesia";
        }
        $tgl_user = Carbon::create($kandidat->tgl_lahir)->isoFormat('D MMM Y');
        $tgl_perizin = Carbon::create($kandidat->tgl_lahir_perizin)->isoFormat('D MMM Y');
        // dd($tmp_user->cityName);
        if ($kandidat->periode_awal1 !== null) {
            $periode_awal1 = Carbon::create($kandidat->periode_awal1)->isoFormat('D MMM Y');
            $periode_akhir1 = Carbon::create($kandidat->periode_akhir1)->isoFormat('D MMM Y');
        } else {
            $periode_awal1 = null;
            $periode_akhir1 = null;
        }
        if ($kandidat->periode_awal2 !== null) {
            $periode_awal2 = Carbon::create($kandidat->periode_awal2)->isoFormat('D MMM Y');
            $periode_akhir2 = Carbon::create($kandidat->periode_akhir2)->isoFormat('D MMM Y');
        } else {
            $periode_awal2 = null;
            $periode_akhir2 = null;
        }
        if ($kandidat->periode_awal3 !== null){
            $periode_awal3 = Carbon::create($kandidat->periode_awal3)->isoFormat('D MMM Y');
            $periode_akhir3 = Carbon::create($kandidat->periode_akhir3)->isoFormat('D MMM Y');    
        } else {
            $periode_awal3 = null;
            $periode_akhir3 = null;
        }
        return view('Output/cetak', compact(
            'kandidat',
            'tgl_print',
            'tgl_user',
            'tgl_perizin',
            'periode_awal1',
            'periode_awal2',
            'periode_awal3',
            'periode_akhir1',
            'periode_akhir2',
            'periode_akhir3',
        ));
    }

    public function izinWaris()
    {
        $tgl_print = Carbon::now()->isoFormat('D MMM Y');
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $perusahaan = Perusahaan::where('id_perusahaan',$kandidat->id_perusahaan)->first();
        if($kandidat->penempatan == null)
        {
            return redirect('/kandidat');
        }
        $tgl_user = Carbon::create($kandidat->tgl_lahir)->isoFormat('D MMM Y');
        $tgl_perizin = Carbon::create($kandidat->tgl_lahir_perizin)->isoFormat('D MMM Y');
        // dd($tmp_user->cityName);
        $negara = Negara::join(
            'kandidat', 'ref_negara.negara_id','=','kandidat.negara_id'
        )
        ->where('kandidat.referral_code',$id->referral_code)
        ->first();
        return view('Output/output_izin_waris',compact(
            'kandidat',
            'tgl_print',
            'tgl_user',
            'tgl_perizin',
            'negara',
            'perusahaan',
        ));
    }

    public function suratIzinWaris()
    {
        return view('output/surat_izin_waris');
    }

    public function cetakPmiID($id)
    {
        $pmi_id = PMIID::join(
            'kandidat', 'perusahaan_kebutuhan.id_kandidat','kandidat.id_kandidat'
        )
        ->join(
            'ref_negara', 'perusahaan_kebutuhan.negara_id','ref_negara.negara_id'
        )
        ->where('perusahaan_kebutuhan.pmi_id',$id)->first();
        $berlaku = Carbon::create($pmi_id->berlaku)->isoformat('d MMM Y');
        $habis_berlaku = Carbon::create($pmi_id->habis_berlaku)->isoformat('d MMM Y');
        return view('Output/cetak_pmi_id',compact('pmi_id','berlaku','habis_berlaku'));
    }
}
