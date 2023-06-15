<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
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

class ContactUsController extends Controller
{
    public function contactUs()
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $contact_us = ContactUs::all();
        return view('manager/contact_us',compact('manager','contact_us'));
    }
    
    public function lihatContactUs($id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $contact_us = ContactUs::where('id',$id)->first();
        return view('manager/lihat_contact_us',compact('manager','contact_us'));
    }

    public function responseContactUs(Request $request, $id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $contact_us = ContactUs::where('id',$id)->first();
        if($contact_us->id_perusahaan !== null){
            messagePerusahaan::create([
                'id_perusahaan' => $contact_us->id_perusahaan,
                'pesan' => $request->balas,
                'pengirim' => "Admin",
            ]);
            notifyPerusahaan::create([
                'id_perusahaan' => $contact_us->id_perusahaan,
                'isi' => "Anda mendapat pesan masuk",
                'pengirim' => "Admin",
                'url' => ('/perusahaan/semua_pesan'),
            ]);
            ContactUs::where('id',$id)->update([
                'balas' => "dibaca",
            ]);
        } elseif($contact_us->id_akademi !== null){
            messageAkademi::create([
                'id_akademi' => $contact_us->id_akademi,
                'pesan' => $request->balas,
                'pengirim' => "Admin",
            ]);
            notifyAkademi::create([
                'id_akademi' => $contact_us->id_akademi,
                'isi' => "Anda mendapat pesan masuk",
                'pengirim' => "Admin",
                'url' => ('/akademi/semua_pesan'),
            ]);
            ContactUs::where('id',$id)->update([
                'balas' => "dibaca",
            ]);
        } elseif($contact_us->id_kandidat !== null){
            messageKandidat::create([
                'id_kandidat' => $contact_us->id_kandidat,
                'pesan' => $request->balas,
                'pengirim' => "Admin",
            ]);
            notifyKandidat::create([
                'id_kandidat' => $contact_us->id_kandidat,
                'isi' => "Anda mendapat pesan masuk",
                'pengirim' => "Admin",
                'url' => '/semua_pesan',
            ]);
            ContactUs::where('id',$id)->update([
                'balas' => "dibaca",
            ]);
        } else {
            dd($contact_us->email,$contact_us->no_telp);
        }
        return redirect('/manager/contact_us');
    }

    public function sendContactUs(Request $request)
    {
        $dari = $request->dari;
        $isi = $request->isi;
        $id_kandidat = $request->id_kandidat;
        $id_akademi = $request->id_akademi;
        $id_perusahaan = $request->id_perusahaan;
        $email = $request->email;
        $no_telp = $request->no_telp;

        ContactUs::create([
            'dari' => $dari,
            'isi' => $isi,
            'id_kandidat' => $id_kandidat,
            'id_akademi' => $id_akademi,
            'id_perusahaan' => $id_perusahaan,
            'email' => $email,
            'no_telp' => $no_telp,
            'balas' => "belum dibaca",
        ]);
        if(Auth::user() == null)
        {
            return redirect('/hubungi_kami')->with('success',"Pesan berhasil terkirim");
        } else {
            return redirect('/')->with('success',"Pesan berhasil terkirim");
        }
    }

    public function contactUsKandidatList()
    {

    }

    public function contactUsKandidatlihat()
    {

    }

    public function contactUsKandidatJawab(Request $request)
    {

    }
    public function contactUsAkademiList()
    {

    }

    public function contactUsAkademilihat()
    {

    }

    public function contactUsAkademiJawab(Request $request)
    {

    }
    public function contactUsPerusahaanList()
    {

    }

    public function contactUsPerusahaanlihat()
    {

    }

    public function contactUsPerusahaanJawab(Request $request)
    {

    }
}
