<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Mail\Noreply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\notifyAkademi;
use App\Models\notifyKandidat;
use App\Models\notifyPerusahaan;
use App\Models\messageAkademi;
use App\Models\messageKandidat;
use App\Models\messagePerusahaan;
use App\Models\ContactUs;
use App\Models\ContactUsKandidat;
use App\Models\ContactUsPerusahaan;
use App\Models\ContactUsAkademi;
use App\Models\Perusahaan;
use App\Models\Akademi;
use App\Models\Kandidat;
use App\Models\VerifikasiDiri;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    // halaman beranda Manager Contact Us
    public function contactUs()
    {
        $user = Auth::user();
        $admin = User::where('type',4)->first();
        $notifCK = ContactUsKandidat::where('balas',"belum dibaca")->limit(20)->get();
        $notifCA = ContactUsAkademi::where('balas',"belum dibaca")->limit(20)->get();
        $notifCP = ContactUsPerusahaan::where('balas',"belum dibaca")->limit(20)->get();
        return view('manager/contactService/index',compact('admin','notifCK','notifCA','notifCP'));
    }

    // halaman data pesan kandidat
    public function contactUsKandidatList()
    {
        $user = Auth::user();
        $admin = User::where('type',4)->first();
        $semua_kandidat = ContactUsKandidat::all();
        return view('manager/contactService/kandidat_list',compact('admin','semua_kandidat'));
    }

    // halaman lihat pesan kandidat
    public function contactUsKandidatLihat($id)
    {
        $user = Auth::user();
        $admin = User::where('type',4)->first();
        $kandidat = ContactUsKandidat::where('id_contact_kandidat',$id)->first();
        return view('manager/contactService/kandidat_lihat',compact('admin','kandidat'));
    }

    // sistem kirim pesan ke kandidat
    public function contactUsKandidatJawab(Request $request,$id)
    {
        $contact_kandidat = ContactUsKandidat::where('id_contact_kandidat',$id)->first();
        messageKandidat::create([
            'id_kandidat' => $contact_kandidat->id_kandidat,
            'pesan' => $request->balas,
            'pengirim' => "Admin",
        ]);
        notifyKandidat::create([
            'id_kandidat' => $contact_kandidat->id_kandidat,
            'isi' => "Anda mendapat pesan masuk",
            'pengirim' => "Admin",
            'url' => '/semua_pesan',
        ]);
        ContactUsKandidat::where('id',$id)->update([
            'balas' => "dibaca",
        ]);
        return redirect('/manager/lihat/contact_kandidat/'.$id)->with('success',"Pesan Terkirim");
    }

    // halaman data pesan akademi
    public function contactUsAkademiList()
    {
        $user = Auth::user();
        $admin = User::where('type',4)->first();
        $semua_akademi = ContactUsAkademi::all();
        return view('manager/contactService/akademi_list',compact('admin','semua_akademi'));
    }

    // halaman lihat pesan akademi
    public function contactUsAkademiLihat($id)
    {
        $user = Auth::user();
        $admin = User::where('type',4)->first();
        $akademi = ContactUsAkademi::where('id_contact_akademi',$id)->first();
        return view('manager/contactService/akademi_lihat',compact('admin','akademi'));
    }

    // sistem kirim pesan ke akademi
    public function contactUsAkademiJawab(Request $request,$id)
    {
        $contact_akademi = ContactUsAkademi::where('id_contact_akademi',$id)->first();
        messageAkademi::create([
            'id_akademi' => $contact_akademi->id_akademi,
            'pesan' => $request->balas,
            'pengirim' => "Admin",
        ]);
        notifyAkademi::create([
            'id_akademi' => $contact_akademi->id_akademi,
            'isi' => "Anda mendapat pesan masuk",
            'pengirim' => "Admin",
            'url' => ('/akademi/semua_pesan'),
        ]);
        ContactUsAkademi::where('id_contact_akadmei',$id)->update([
            'balas' => "dibaca",
        ]);
        return redirect('/manager/lihat/contact_akademi/'.$id)->with('success',"Pesan Terkirim");
    }

    // halaman data pesan perusahaan
    public function contactUsPerusahaanList()
    {
        $user = Auth::user();
        $admin = User::where('type',4)->first();
        $semua_perusahaan = ContactUsPerusahaan::all();
        return view('manager/contactService/perusahaan_list',compact('admin','semua_perusahaan'));
    }

    // halaman lihat pesan perusahaan
    public function contactUsPerusahaanLihat($id)
    {
        $user = Auth::user();
        $admin = User::where('type',4)->first();
        $perusahaan = ContactUsPerusahaan::where('id_contact_perusahaan',$id)->first();
        return view('manager/contactService/perusahaan_lihat',compact('admin','perusahaan'));
    }

    // sistem kirim pesan ke perusahaan
    public function contactUsPerusahaanJawab(Request $request, $id)
    {
        $contact_perusahaan = ContactUsPerusahaan::where('id_contact_perusahaan',$id)->first();
        messagePerusahaan::create([
            'id_perusahaan' => $contact_perusahaan->id_perusahaan,
            'pesan' => $request->balas,
            'pengirim' => "Admin",
        ]);
        notifyPerusahaan::create([
            'id_perusahaan' => $contact_perusahaan->id_perusahaan,
            'isi' => "Anda mendapat pesan masuk",
            'pengirim' => "Admin",
            'url' => ('/perusahaan/semua_pesan'),
        ]);
        ContactUsPerusahaan::where('id_contact_perusahaan',$id)->update([
            'balas' => "dibaca",
        ]);
        return redirect('/manager/lihat/contact_perusahaan/'.$id)->with('success',"Pesan Terkirim");
    }
}