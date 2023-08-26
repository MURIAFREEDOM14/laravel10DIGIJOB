<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\KandidatInterview;
use App\Models\Pembayaran;
use App\Models\PersetujuanKandidat;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\notifyPerusahaan;
use App\Models\messagePerusahaan;
use App\Models\Interview;
use App\Models\notifyKandidat;

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
        $riwayat = Pembayaran::whereNotNull('id_kandidat')->where('stats_pembayaran',"sudah dibayar")->get();
        return view('manager/payment/kandidat_payment',compact('manager','pembayaran','riwayat'));
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
            'pesan' => "Selamat pembayaran anda telah dikonfirmasi. Harap tunggu hingga waktu interview tiba",
            'pengirim' => "Admin",
            'kepada' => $pembayaran->nama_perusahaan,
        ]);
        $interview = Interview::where('id_interview',$pembayaran->id_interview)->first();
        $kandidat = KandidatInterview::where('id_interview',$interview->id_interview)->get();
        foreach($kandidat as $key) {
            PersetujuanKandidat::create([
                'id_kandidat' => $key->id_kandidat,
                'nama_kandidat' => $key->nama,
                'id_perusahaan' => $key->id_perusahaan,
            ]);

            notifyKandidat::create([
                'id_kandidat' => $key->id_kandidat,
                'isi' => "Anda mendapat sebuah undangan interview.",
                'pengirim' => "Sistem",
                'url' => '/kandidat',
            ]);
        }
        return redirect('/manager/payment/perusahaan')->with('success',"Pembayaran Terverifikasi");
    }
}
