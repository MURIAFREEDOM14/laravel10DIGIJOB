<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Kandidat;
use App\Models\Negara;
use App\Models\Notification;
use App\Models\Pembayaran;
use App\Models\Interview;

class PrioritasController extends Controller
{
    public function Prioritas()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $negara = Negara::join(
            'kandidat', 'ref_negara.negara_id','=','kandidat.negara_id'
        )
        ->where('referral_code',$id->referral_code)
        ->first();
        $usia = Carbon::parse($kandidat->tgl_lahir)->age;
        $notif = Notification::where('id_kandidat',$kandidat->id_kandidat)->get();
        $pembayaran = Pembayaran::where('id_kandidat',$kandidat->id_kandidat)->first();
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

        if(Auth::user()->type == 3){
            return redirect('/manager');
        } elseif(Auth::user()->type == 2) {
            return redirect('/perusahaan');
        } elseif(Auth::user()->type == 1) {
            return redirect('/akademi');
        } else {
            if ($kandidat->penempatan == null) {
                return redirect('/isi_kandidat_personal')->with('toast_warning','Harap Lengkapi Data Personal Dahulu');
            } elseif($kandidat->nik == null) {
                return redirect('/isi_kandidat_document')->with('toast_warning','Harap Isi Data Document Dahulu');
            } elseif($kandidat->negara_id == null) {
                return redirect('/isi_kandidat_placement')->with('toast_warning','Harap Tentukan negara Tujuan Kerja');
            } else {
                if($pembayaran == null){
                    return redirect('/kandidat');
                } else {
                    return view('kandidat/prioritas/kandidat_prioritas',compact(
                        'kandidat',
                        'negara',
                        'tgl_user',
                        'usia',
                        'notif',
                        'pembayaran',
                        'periode_awal1',
                        'periode_awal2',
                        'periode_awal3',
                        'periode_akhir1',
                        'periode_akhir2',
                        'periode_akhir3',
                    ));
                } 
            }
        }
    }

    public function prioritas_info()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $notif = Notification::where('id_kandidat',$kandidat->id_kandidat)->get();
        return view('kandidat/info_prioritas',compact('kandidat','notif'));
    }

    public function interview()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $notif = Notification::where('id_kandidat',$kandidat->id_kandidat)->get();
        $interview = Interview::all();
        $pembayaran = Pembayaran::where('id_kandidat',$kandidat->id_kandidat)->first();
        return view('kandidat/prioritas/interview_training',compact('kandidat','notif','interview'));
    }
}
