<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\notifyPerusahaan;
use App\Models\messagePerusahaan;

class ManagerPaymentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->where('type',5)->first();
        $data_kandidat = Pembayaran::whereNotNull('id_kandidat')->where('stats_pembayaran','not like','%sudah dibayar%')->count();
        $data_perusahaan = Pembayaran::whereNotNull('id_perusahaan')->where('stats_pembayaran','not like','%sudah dibayar%')->count();
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
        $riwayat = Pembayaran::whereNotNull('id_perusahaan')->where('stats_pembayaran',"sudah dibayar")->get();
        return view('manager/payment/perusahaan_payment',compact('manager','pembayaran','riwayat'));
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
        Pembayaran::where('id_pembayaran',$id)->update([
            'stats_pembayaran' => $request->stats_pembayaran,
        ]);
        $pembayaran = Pembayaran::join(
            'perusahaan', 'pembayaran.id_perusahaan','=','perusahaan.id_perusahaan'
        )
        ->where('pembayaran.id_pembayaran',$id)->first();
        notifyPerusahaan::create([
            'id_perusahaan' => $pembayaran->id_perusahaan,
            'isi' => "Anda mendapat pesan masuk",
            'pengirim' => "Sistem",
            'url' => '/perusahaan/semua_pesan',
        ]);
        messagePerusahaan::create([
            'id_perusahaan' => $pembayaran->id_perusahaan,
            'pesan' => "Selamat pembayaran anda telah dikonfirmasi. Untuk selanjutnya silahkan anda untuk menentukan waktu interview",
            'pengirim' => "Admin",
            'kepada' => $pembayaran->nama_perusahaan,
        ]);
        return redirect('/manager/payment/perusahaan')->with('success',"Pembayaran Terverifikasi");
    }
}
