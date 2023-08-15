<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ManagerPaymentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->where('type',5)->first();
        $data_kandidat = Pembayaran::whereNotNull('id_kandidat')->count();
        $data_perusahaan = Pembayaran::whereNotNull('id_perusahaan')->count();
        return view('manager/payment/index',compact('manager','data_kandidat','data_perusahaan'));
    }

    public function kandidatPayment()
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->where('type',5)->first();
        $pembayaran = Pembayaran::whereNotNull('id_kandidat')->get();
        return view('manager/payment/kandidat_payment',compact('manager','pembayaran'));
    }

    public function lihatKandidatPayment($id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->where('type',5)->first();
        $pembayaran = Pembayaran::where('id_pembayaran',$id)->first();
        return view('manager/payment/lihat_kandidat_payment',compact('manager','pembayaran'));
    }

    public function confirmKandidatPayment(Request $request, $id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->where('type',5)->first();
        return redirect('/manager/payment/kandidat')->with('success',"Successfully");
    }

    public function perusahaanPayment()
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->where('type',5)->first();
        $pembayaran = Pembayaran::whereNotNull('id_perusahaan')->get();
        return view('manager/payment/perusahaan_payment',compact('manager','pembayaran'));
    }

    public function lihatPerusahaanPayment($id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->where('type',5)->first();
        $pembayaran = Pembayaran::where('id_pembayaran',$id)->first();
        return view('manager/payment/lihat_perusahaan_payment',compact('manager','pembayaran'));
    }

    public function confirmPerusahaanPayment(Request $request, $id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->where('type',5)->first();
    }
}
