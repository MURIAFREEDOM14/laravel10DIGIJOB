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
use App\Models\ContactUsKandidat;
use App\Models\ContactUsPerusahaan;
use App\Models\ContactUsAkademi;
use App\Models\Perusahaan;
use App\Models\Akademi;
use App\Models\Kandidat;

class ContactUsController extends Controller
{
    public function contactUsAdmin()
    {
        $user = Auth::user();
        $manager = User::where('type',3)->first();
        $admin = User::where('type',4)->get();
        return view('manager/contactService/contact_us',compact('manager','admin'));
    }

    public function tambahContactUsAdmin(Request $request)
    {
        $code = "1357924680";
        $user = User::create([
            'name' => $request->admin,
            'email' => $request->email,
            'password' => $request->password,
            'type' =>   4,
        ]);

        $id = $user->id;
        $referral_code = \Hashids::encode($id.$code);
        
        User::where('id',$id)->update([
            'referral_code' => $referral_code,
        ]);
        return redirect('/manager/contact_us_admin')->with('success',"Data ditambahkan");
    }

    public function hapusContactUsAdmin(Request $request)
    {
        $hapus = User::where('referral_code',$request->referral_code)->delete();
        return redirect('/manager/contact_us_admin')->with('success',"Data dihapus");
    }

    public function contactUs()
    {
        $user = Auth::user();
        $manager = User::where('type',3)->first();
        $admin = User::where('type',4)->get();
        return view('manager/contactService/index',compact('manager','admin'));
    }
    
    public function lihatContactUs($id)
    {
        $user = Auth::user();
        $manager = User::where('referral_code',$user->referral_code)->first();
        $contact_us = ContactUs::where('id',$id)->first();
        return view('manager/contactService/lihat_contact_us',compact('manager','contact_us'));
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

        if($id_perusahaan !== null){
            ContactUsPerusahaan::create([
                'id_perusahaan' => $id_perusahaan,
                'dari' => $dari,
                'isi' => $isi,
                'balas' => "belum dibaca",
            ]);
        } elseif($id_akademi !== null){
            ContactUsAkademi::create([
                'id_akademi' => $id_akademi,
                'dari' => $dari,
                'isi' => $isi,
                'balas' => "belum dibaca",
            ]);
        } elseif($id_kandidat !== null){
            ContactUsKandidat::create([
                'id_kandidat' => $id_kandidat,
                'dari' => $dari,
                'isi' => $isi,
                'balas' => "belum dibaca",
            ]);
        } else {
            ContactUs::create([
                'dari' => $dari,
                'isi' => $isi,
                'email' => $email,
                'no_telp' => $no_telp,
                'balas' => "belum dibaca",
            ]);
        }
        if(Auth::user() == null)
        {
            return redirect('/hubungi_kami')->with('success',"Pesan berhasil terkirim");
        } else {
            return redirect('/')->with('success',"Pesan berhasil terkirim");
        }
    }

    public function contactUsGuestList()
    {
        $user = Auth::user();
        $manager = User::where('type',3)->first();
        $semua_guest = ContactUs::where('no_telp','is not null')->where('email','is not null')->get();
        return view('manager/contactService/guest_list',compact('manager','semua_guest'));
    }

    public function contactUsGuestLihat($id)
    {
        $user = Auth::user();
        $manager = User::where('type',3)->first();
        $kandidat = ContactUsKandidat::where('id',$id)->first();           
    }

    public function contactUsKandidatList()
    {
        $user = Auth::user();
        $manager = User::where('type',3)->first();
        $semua_kandidat = ContactUsKandidat::all();
        return view('manager/contactService/kandidat_list',compact('manager','semua_kandidat'));
    }

    public function contactUsKandidatLihat($id)
    {
        $user = Auth::user();
        $manager = User::where('type',3)->first();
        $kandidat = ContactUsKandidat::where('id_contact_kandidat',$id)->first();
        return view('manager/contactService/kandidat_lihat',compact('manager','kandidat'));
    }

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
    public function contactUsAkademiList()
    {
        $user = Auth::user();
        $manager = User::where('type',3)->first();
        $semua_akademi = ContactUsAkademi::all();
        return view('manager/contactService/akademi_list',compact('manager','semua_akademi'));
    }

    public function contactUsAkademiLihat($id)
    {
        $user = Auth::user();
        $manager = User::where('type',3)->first();
        $akademi = ContactUsAkademi::where('id_contact_akademi',$id)->first();
        return view('manager/contactService/akademi_lihat',compact('manager','akademi'));
    }

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
    public function contactUsPerusahaanList()
    {
        $user = Auth::user();
        $manager = User::where('type',3)->first();
        $semua_perusahaan = ContactUsPerusahaan::all();
        return view('manager/contactService/perusahaan_list',compact('manager','semua_perusahaan'));
    }

    public function contactUsPerusahaanLihat($id)
    {
        $user = Auth::user();
        $manager = User::where('type',3)->first();
        $perusahaan = ContactUsPerusahaan::where('id_contact_perusahaan',$id)->first();
        return view('manager/contactService/perusahaan_lihat',compact('manager','perusahaan'));
    }

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
