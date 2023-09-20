<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Models\Kandidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Perusahaan;
use App\Models\PerusahaanCabang;
use App\Models\Negara;
use App\Models\Akademi;
use Carbon\Carbon;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Interview;
use App\Models\PengalamanKerja;
use App\Models\Pembayaran;
use App\Models\notifyPerusahaan;
use App\Models\messagePerusahaan;
use App\Models\LowonganPekerjaan;
use App\Models\PermohonanLowongan;
use App\Mail\transfer;
use Illuminate\Support\Facades\Mail;
use App\Models\notifyKandidat;
use App\Models\messageKandidat;
use App\Models\notifyAkademi;
use App\Models\messageAkademi;
use App\Models\CreditPerusahaan;
use App\Models\User;
use App\Models\FotoKerja;
use App\Models\VideoKerja;
use Carbon\CarbonPeriod;
use App\Models\LaporanPekerja;
use App\Models\ContactUsPerusahaan;


class PerusahaanController extends Controller
{
    // halaman awal / dashboard perusahaan
    public function index()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like','%'.$perusahaan->penempatan_kerja.'%')->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $interview = Interview::where('status',"terjadwal")->where('id_perusahaan',$perusahaan->id_perusahaan)->get();        
        $notifyP = notifyPerusahaan::where('created_at','<',Carbon::now()->subDays(14))->delete();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        // menampilkan data negara + pekerjaan
        $penempatan = Negara::join(
            'pekerjaan', 'ref_negara.negara_id','=','pekerjaan.negara_id'
        )
        ->where('pekerjaan.id_perusahaan',$perusahaan->id_perusahaan)->get();
        $lowongan = LowonganPekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        // apabila belum terdaftar memiliki credit
        if(!$credit){
            $credit = CreditPerusahaan::create([
                'id_perusahaan' => $perusahaan->id_perusahaan,
                'nama_perusahaan' => $perusahaan->nama_perusahaan,
                'no_nib' => $perusahaan->no_nib,
            ]);
        } 
        // mereset ulang jumlah kesalahan password
        User::where('no_nib',$perusahaan->no_nib)->update([
            'counter' => null,
        ]);
        return view('perusahaan/index',compact('perusahaan','cabang','notif','interview','pesan','credit','penempatan','lowongan'));
    }

    // halaman data profil perusahaan
    public function profil()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like','%'.$perusahaan->penempatan_kerja.'%')->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $lowongan = LowonganPekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        // jika nama pemimpin perusahaan belum ada
        if($perusahaan->nama_pemimpin == null)
        {
            return redirect()->route('perusahaan')->with('warning',"Harap lengkapi profil perusahaan terlebih dahulu");
        } else {
            return view('perusahaan/profil_perusahaan',compact('cabang','perusahaan','notif','pesan','lowongan','credit'));
        }
    }

    // halaman isi data perusahaan 
    public function isi_perusahaan_data()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/modalPerusahaan/isi_perusahaan_data',compact('perusahaan'));
    }

    // halaman simpan data perusahaan
    public function simpan_perusahaan_data(Request $request)
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        // cek foto perusahaan
        // apabila ada inputan
        if($request->file('foto_perusahaan') !== null){
            // mencari data sebelumnya dan menghapusnya bila ada
            $hapus_foto_perusahaan = public_path('gambar/Perusahaan/'.$perusahaan->nama_perusahaan.'/Foto Perusahaan/').$perusahaan->foto_perusahaan;
            if(file_exists($hapus_foto_perusahaan)){
                @unlink($hapus_foto_perusahaan);
            }
            // memasukkan data file ke aplikasi
            $photo_perusahaan = $request->file('foto_perusahaan');
            $simpan_photo_perusahaan = $perusahaan->nama_perusahaan.time().'.'.$photo_perusahaan->extension();  
            $photo_perusahaan->move('gambar/Perusahaan/'.$perusahaan->nama_perusahaan.'/Foto Perusahaan/',$simpan_photo_perusahaan);
        } else {
            if($perusahaan->foto_perusahaan !== null){
                $simpan_photo_perusahaan = $perusahaan->foto_perusahaan;                
            } else {
                $simpan_photo_perusahaan = null;    
            }
        }
        // cek logo perusahaan
        // apabila ada inputan
        if($request->file('logo_perusahaan') !== null){
            // mencari file sebelumnya dan menghapusnya bila ada
            $hapus_logo_perusahaan = public_path('gambar/Perusahaan/'.$perusahaan->nama_perusahaan.'/Logo Perusahaan/').$perusahaan->logo_perusahaan;
            if(file_exists($hapus_logo_perusahaan)){
                @unlink($hapus_logo_perusahaan);
            }
            // memasukkan file ke dalam aplikasi
            $logo = $request->file('logo_perusahaan');
            $simpan_logo = $perusahaan->nama_perusahaan.time().'.'.$logo->extension();  
            $logo->move('gambar/Perusahaan/'.$perusahaan->nama_perusahaan.'/Logo Perusahaan/',$simpan_logo);
        } else {
            if($perusahaan->logo_perusahaan !== null){
                $simpan_logo = $perusahaan->logo_perusahaan;                
            } else {
                $simpan_logo = null;    
            }
        }
        // cek foto perusahaan bila ada
        if ($simpan_photo_perusahaan !== null) {
            $foto_perusahaan = $simpan_photo_perusahaan;
        } else {
            $foto_perusahaan = null;
        }

        if ($simpan_logo !== null) {
            $logo_perusahaan = $simpan_logo;
        } else {
            $logo_perusahaan = null;
        }

        // seleksi apabila tempat perusahaan = dalam negeri, maka negara = indonesia (2)
        if($request->tmp_perusahaan == "Dalam negeri"){
            $negara_id = 2;
        } else {
            $negara_id = null;
        }
        // menambahkan data perusahaan
        Perusahaan::where('no_nib',$id->no_nib)->update([
            'nama_perusahaan' => $perusahaan->nama_perusahaan,
            'no_nib' => $perusahaan->no_nib,
            'nama_pemimpin' => $request->nama_pemimpin,
            'foto_perusahaan' => $foto_perusahaan,
            'logo_perusahaan' => $logo_perusahaan,
            'tmp_perusahaan' => $request->tmp_perusahaan,
            'negara_id' => $negara_id,
        ]);
        return redirect()->route('perusahaan.alamat')->with('success',"Data anda tersimpan");
    }

    // halaman isi data perusahaan alamat
    public function isi_perusahaan_alamat()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        $negara = Negara::where('negara_id','not like',2)->get();
        return view('perusahaan/modalPerusahaan/isi_perusahaan_alamat',compact('perusahaan','negara'));
    }

    // simpan data perusahaan alamat
    public function simpan_perusahaan_alamat(Request $request)
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        // apabila tempat perusahaan dalam negeri
        if($perusahaan->tmp_perusahaan == "Dalam negeri"){
            // mencari alamat dari id livewire
            $cari_provinsi = Provinsi::where('id',$request->provinsi_id)->first();
            $cari_kota = Kota::where('id',$request->kota_id)->first();
            $cari_kecamatan = Kecamatan::where('id',$request->kecamatan_id)->first();
            $cari_kelurahan = kelurahan::where('id',$request->kelurahan_id)->first();    

            // mengambil data
            $provinsi = $cari_provinsi->provinsi;
            $kota = $cari_kota->kota;
            $kecamatan = $cari_kecamatan->kecamatan;
            $kelurahan = $cari_kelurahan->kelurahan;
            $negara_id = 2;
        // apabila luar negeri
        } else {
            $provinsi = null;
            $kota = null;
            $kecamatan = null;
            $kelurahan = null;
            $negara_id = $request->negara_id;
        }

        // menambah data perusahaan
        Perusahaan::where('no_nib',$id->no_nib)->update([
            'provinsi'=>$provinsi,
            'kota'=>$kota,
            'kecamatan'=>$kecamatan,
            'kelurahan'=>$kelurahan,
            'no_telp_perusahaan'=>$request->no_telp_perusahaan,
            'negara_id' => $negara_id,
            'alamat' => $request->alamat,
        ]);
        return redirect()->route('perusahaan.operator')->with('success',"Data anda tersimpan");
    }

    // halaman isi data perusahaan operator
    public function isi_perusahaan_operator()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        return view('perusahaan/modalPerusahaan/isi_perusahaan_operator',compact('perusahaan'));
    }

    // sistem simpan data perusahaan operator
    public function simpan_perusahaan_operator(Request $request)
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
    
        Perusahaan::where('no_nib',$id->no_nib)->update([
            'nama_operator'=>$request->nama_operator,
            'no_telp_operator'=>$request->no_telp_operator,
            'email_operator'=>$request->email_operator,
            // 'foto_operator'=>$foto_operetor,
            'company_profile'=>$request->company_profile
        ]);
        return redirect()->route('perusahaan')->with('success',"Data anda tersimpan");
    }

    // halaman hub. kami / bantuan perusahaan
    public function contactUsPerusahaan()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like','%'.$perusahaan->penempatan_kerja.'%')->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/contact_us',compact('perusahaan','notif','pesan','cabang','credit'));
    }

    // proses membuat pesan contact us dari perusahaan ke manager contact service
    public function sendContactUsPerusahaan(Request $request)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        // membuat data contact us perusahaan
        ContactUsPerusahaan::create([
            'id_perusahaan' => $perusahaan->id_perusahaan,
            'dari' => $perusahaan->nama_perusahaan,
            'isi' => $request->isi,
            'balas' => "belum dibaca",
        ]);
        return redirect('/perusahaan/contact_us_perusahaan')->with('success',"pesan telah terkirim");
    }

    // DATA KANDIDAT //
    // halaman data semua kandidat yang diterima
    public function semuaKandidat()
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $kandidat = Kandidat::where('id_perusahaan',$perusahaan->id_perusahaan)->where('stat_pemilik','like','%diterima%')->get();
        $isi = $kandidat->count();
        return view('perusahaan/kandidat/kandidat',compact('perusahaan','notif','pesan','credit','kandidat','isi'));
    }

    // halaman lihat kandidat dari lowongan tujuan
    public function listKandidatLowongan($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $semua_lowongan = LowonganPekerjaan::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $lowongan = LowonganPekerjaan::where('id_lowongan',$id)->first();
        $kandidat = Kandidat::where('id_perusahaan',$perusahaan->id_perusahaan)->where('stat_pemilik','diterima')->where('jabatan_kandidat','like','%'.$lowongan->jabatan.'%')->get();        
        $isi = $kandidat->count();
        return view('perusahaan/kandidat/lowongan_kandidat',compact('kandidat','perusahaan','isi','notif','pesan','cabang','credit','lowongan','semua_lowongan','id'));
    }

    // mengarahkan ke pencarian kandidat lowongan tujuan
    public function cariKandidatLowongan(Request $request, $id)
    {
        return redirect('/perusahaan/list/kandidat/lowongan/'.$request->id_lowongan);
    }

    // halaman lihat profil kandidat
    public function lihatProfilKandidat($id)
    {
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$auth->no_nib)->first();
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        $pengalaman_kerja_kandidat = PengalamanKerja::where('id_kandidat',$id)->get();
        $video = VideoKerja::first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $usia = Carbon::parse($kandidat->tgl_lahir)->age;
        $tgl_user = Carbon::create($kandidat->tgl_lahir)->isoFormat('D MMM Y');
        $interview = Interview::where('id_kandidat',$kandidat->id_kandidat)->first();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
                
        return view('perusahaan/kandidat/profil_kandidat',compact(
            'kandidat','pengalaman_kerja_kandidat','perusahaan',
            'usia','tgl_user','pesan',
            'interview','notif','cabang',
            'credit','video',
        ));
    }

    // sistem keluarkan kandidat dari perusahaan
    public function keluarkanKandidatPerusahaan($id, $nama)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        // menjadikan kandidat belum memiliki ikatan dengan perusahaan
        Kandidat::where('id_kandidat',$id)->where('stat_pemilik',"diterima")->where('id_perusahaan',$perusahaan->id_perusahaan)->update([
            'stat_pemilik' => null,
            'id_perusahaan' => null,
            'jabatan_kandidat' => null,
        ]);
        // membuat pesan kepada kandidat
        messageKandidat::create([
            'id_kandidat' => $id,
            'pesan' => "Mohon maaf, Anda telah dikeluarkan dari perusahan ".$perusahaan->nama_perusahaan.". ",
            'pengirim' => $perusahaan->nama_perusahaan,
            'kepada' => $nama,
            'id_perusahaan' => $perusahaan->id_perusahaan,
        ]);
        // membatasi pesan kandidat hanya sebanyak 30
        $allMessage = messageKandidat::where('id_kandidat',$id)->get();
        $total = 30;
        if ($allMessage->count() > $total) {
            $operator = $allMessage->count() - $total;
            messageKandidat::where('id_kandidat',$id)->orderBy('id','asc')->limit($operator)->delete();
        }
        LaporanPekerja::where('id_kandidat',$id)->where('nama_kandidat',$nama)->delete();
        return redirect('/perusahaan/semua/kandidat')->with('success',"Kandidat telah diusir dari perusahaan anda");
    }

    // halaman galeri kandidat
    public function galeriKandidat($id)
    {
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$auth->no_nib)->first();
        $pengalaman_kandidat = PengalamanKerja::where('pengalaman_kerja.pengalaman_kerja_id',$id)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $video = VideoKerja::where('pengalaman_kerja_id',$pengalaman_kandidat->pengalaman_kerja_id)->get();
        $semua_video = VideoKerja::where('pengalaman_kerja_id',$pengalaman_kandidat->pengalaman_kerja_id)->get();
        $foto = FotoKerja::where('pengalaman_kerja_id',$pengalaman_kandidat->pengalaman_kerja_id)->get();
        $pengalaman_kerja = PengalamanKerja::where('id_kandidat',$pengalaman_kandidat->id_kandidat)->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        return view('perusahaan/kandidat/galeri_kandidat',compact('perusahaan','pengalaman_kandidat','pengalaman_kerja','cabang','pesan','notif','credit','video','foto','semua_video'));
    }

    // halaman lihat galeri kandidat
    public function lihatGaleriKandidat($id,$type)
    {
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$auth->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->orderBy('created_at','desc')->where('check_click',"n")->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        // apabila memilih video
        if($type == "video") {
            $video = VideoKerja::where('video_kerja_id',$id)->first();
            $pengalaman = PengalamanKerja::where('pengalaman_kerja_id',$video->pengalaman_kerja_id)->first();
            $semua_video = VideoKerja::where('pengalaman_kerja_id',$pengalaman->pengalaman_kerja_id)->get();    
            $semua_foto = FotoKerja::where('pengalaman_kerja_id',$pengalaman->pengalaman_kerja_id)->get();
            return view('perusahaan/kandidat/lihat_galeri_kandidat',compact('perusahaan','pengalaman','cabang','pesan','notif','credit','video','semua_video','semua_foto','type'));
        // apabila memilih foto
        } else {
            $foto = FotoKerja::where('foto_kerja_id',$id)->first();
            $pengalaman = PengalamanKerja::where('pengalaman_kerja_id',$foto->pengalaman_kerja_id)->first();
            $semua_foto = FotoKerja::where('pengalaman_kerja_id',$pengalaman->pengalaman_kerja_id)->get();    
            $semua_video = VideoKerja::where('pengalaman_kerja_id',$pengalaman->pengalaman_kerja_id)->get();    
            return view('perusahaan/kandidat/lihat_galeri_kandidat',compact('perusahaan','pengalaman','cabang','pesan','notif','credit','foto','semua_video','semua_foto','type'));            
        }
    }

    // halaman edit jadwal interview
    // public function editJadwalInterview($id)
    // {
    //     $auth = Auth::user();
    //     $perusahaan = Perusahaan::where('no_nib',$auth->no_nib)->first();
    //     $interview = Interview::where('id_interview',$id)->first();
    //     $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
    //     $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('check_click',"n")->get();
    //     $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();       
    //     $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
    //     return view('perusahaan/edit_interview',compact('perusahaan','interview','notif','pesan','cabang','credit'));
    // }

    // sistem ubah jadwal interview
    // public function ubahJadwalInterview(Request $request,$id)
    // { 
    //     $auth = Auth::user();
    //     $perusahaan = Perusahaan::where('no_nib',$auth->no_nib)->first();
    //     $interview = Interview::where('id_interview',$id)->first();
    //     $kandidat = Kandidat::where('id_kandidat',$interview->id_kandidat)->first();
    //     if($interview->kesempatan == 1){
    //         return back()->with('warning',"Maaf kesempatan anda mengubah jadwal telah habis. Harap hubungi admin");
    //     }
    //     if($interview->jadwal_interview !== $request->jadwal){
    //         $time = Carbon::create($request->jadwal)->isoformat('D MMM Y | h A');
    //         messageKandidat::create([
    //             'id_kandidat'=>$interview->id_kandidat,
    //             'id_perusahaan'=>$interview->id_perusahaan,
    //             'pesan'=>$perusahaan->nama_perusahaan." mengubah waktu interview anda menjadi ".$time.".",
    //             'pengirim'=>$perusahaan->nama_perusahaan,
    //             'kepada'=>$kandidat->nama,
    //             'id_interview'=>$interview->id_interview,
    //         ]);
    //         $allMessage = messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->get();
    //         $total = 30;
    //         if ($allMessage->count() > $total) {
    //             $operator = $allMessage->count() - $total;
    //             messageKandidat::where('id_kandidat',$kandidat->id_kandidat)->orderBy('id','asc')->limit($operator)->delete();
    //         }
    //     }
    //     Interview::where('id_interview',$id)->update([
    //         'jadwal_interview'=>$request->jadwal,
    //         'kesempatan' => 1,
    //     ]);
    //     return redirect('/perusahaan/interview')->with('success',"Jadwal berhasil diubah");
    // }

    // halaman data pembayaran perusahaan
    public function pembayaran()
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$user->no_nib)->first();
        // menampilkan data pembayaran + lowongan pekerjaan
        $pembayaran = Pembayaran::join(
            'lowongan_pekerjaan','pembayaran.id_lowongan','=','lowongan_pekerjaan.id_lowongan'
        )
        ->where('pembayaran.id_perusahaan',$perusahaan->id_perusahaan)
        ->where('pembayaran.stats_pembayaran',"belum dibayar")->get();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('check_click',"n")->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/pembayaran/list_pembayaran', compact('perusahaan','pembayaran','notif','pesan','cabang','credit'));
    }

    // halaman lihat detail pembayaran perusahaan
    public function Payment($id)
    {
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$auth->no_nib)->first();
        $notif = notifyPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->limit(3)->get();
        $pesan = messagePerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('check_click',"n")->get();
        $cabang = PerusahaanCabang::where('no_nib',$perusahaan->no_nib)->where('penempatan_kerja','not like',$perusahaan->penempatan_kerja)->get();
        // menampilkan data pembayaran + lowongan pekerjaan
        $pembayaran = Pembayaran::join(
            'lowongan_pekerjaan','pembayaran.id_lowongan','=','lowongan_pekerjaan.id_lowongan'
        )
        ->where('pembayaran.id_pembayaran',$id)->first();
        $credit = CreditPerusahaan::where('id_perusahaan',$perusahaan->id_perusahaan)->where('no_nib',$perusahaan->no_nib)->first();
        return view('perusahaan/pembayaran/pembayaran',compact('perusahaan','notif','pembayaran','pesan','cabang','credit'));
    }

    // sistem konfirmasi bukti pembayaran perusahaan
    public function paymentCheck(Request $request, $id)
    {
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('no_nib',$auth->no_nib)->first();
        $interview = Interview::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $foto_pembayaran = $perusahaan->nama_perusahaan.time().'.'.$request->foto_pembayaran->extension();  
        $simpan_pembayaran = $request->file('foto_pembayaran');
        $simpan_pembayaran->move('gambar/Perusahaan/'.$perusahaan->nama_perusahaan.'/Pembayaran/',$foto_pembayaran);
        $pembayaran = Pembayaran::where('id_perusahaan',$perusahaan->id_perusahaan)->where('id_pembayaran',$id)->update([
            'foto_pembayaran'=>$foto_pembayaran,
        ]);
        return redirect('/perusahaan')->with('success','Metode pembayaran sedang diproses mohon tunggu');
    }    
}