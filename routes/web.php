<?php

use App\Http\Controllers\Akademi\AkademiController;
use App\Http\Controllers\Akademi\AkademiKandidatController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifikasiController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\Manager\ManagerPaymentController;
use App\Http\Controllers\Manager\Kandidat\ManagerKandidatController;
use App\Http\Controllers\Manager\ContactUsController;
use App\Http\Controllers\Manager\NegaraController;
use App\Http\Controllers\Kandidat\KandidatPerusahaanController;
use App\Http\Controllers\Kandidat\KandidatController;
use App\Http\Controllers\Perusahaan\PerusahaanController;
use App\Http\Controllers\Perusahaan\PerusahaanRecruitmentController;
use App\Http\Controllers\OutputController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PrioritasController;
use App\Http\Controllers\NotifikasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessagerController;
use PHPUnit\TextUI\Configuration\Group;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Auth::routes();
// Auth::routes(['verify' => true]);

// MIDDLEWARE //
// manager = hanya dapat diakses oleh manager
// kandidat = hanya dapat diakses oleh kandidat
// akademi = hanya dapat diakses oleh akademi
// perusahaan = hanya dapat diakses oleh perusahaan
// payment = hanya dapat diakses oleh manager bagian pembayaran
// contact.service = hanya dapat diakses oleh manager bagian contact service
// guest = hanya dapat diakses oleh pengguna yang belum login


// DATA MANAGER //
Route::controller(ManagerController::class)->group(function() {
    // route login manager
    Route::view('/manager_access', 'manager/manager_access')->name('manager_access')->middleware('guest');
    Route::post('/manager_access', 'authenticate');
    Route::get('/manager', 'index')->middleware('manager')->name('manager');

    // route pengiriman verifikasi email ulang dari manager
    Route::get('/manager/search_email','searchEmail')->middleware('manager');
    Route::get('/manager/email_verify/{id}','emailVerify')->middleware('manager');
    Route::post('/manager/email_verify/{id}','sendEmailVerify');
    
    // route data disnaker
    Route::get('/manager/disnaker_list','disnakerList')->middleware('manager');
    Route::post('/manager/disnaker_list','simpanDisnaker');
    Route::get('/manager/hapus_disnaker/{id}','hapusDisnaker')->middleware('manager');

    // DATA KANDIDAT //
    {
        // route lihat data kandidat 
        Route::get('/manager/kandidat/lihat_profil/{id}','lihatProfilKandidat')->middleware('manager');
        Route::get('/manager/kandidat/galeri_kandidat/{id}','galeriKandidat')->middleware('manager');
        Route::get('/manager/kandidat/lihat_galeri_kandidat/{id}/{type}','lihatGaleriKandidat')->middleware('manager');

        // route tema video pelatihan kandidat
        Route::get('/manager/kandidat/pelatihan','pelatihan')->middleware('manager');        
        Route::post('/manager/kandidat/tambah_tema_pelatihan','simpanTemaPelatihan');
        Route::get('/manager/kandidat/lihat_video_pelatihan/{id}','lihatVideoPelatihan')->middleware('manager');
        Route::get('/manager/kandidat/edit_tema_pelatihan/{id}','editTemaPelatihan')->middleware('manager');
        Route::post('/manager/kandidat/edit_tema_pelatihan/{id}','updateTemaPelatihan');
        Route::get('/manager/kandidat/hapus_tema_pelatihan/{id}','hapusTemaPelatihan')->middleware('manager');
        
        // route video pelatihan kandidat
        Route::get('/manager/kandidat/tambah_video_pelatihan/{tema}/{id}','tambahVideoPelatihan')->middleware('manager');
        Route::post('/manager/kandidat/tambah_video_pelatihan/{tema}/{id}','simpanVideoPelatihan');
        Route::get('/manager/kandidat/edit_video_pelatihan/{tema}/{id}','editVideoPelatihan')->middleware('manager');
        Route::post('/manager/kandidat/edit_video_pelatihan/{tema}/{id}','updateVideoPelatihan');
        Route::get('/manager/kandidat/hapus_video_pelatihan/{temaid}/{id}','hapusVideoPelatihan')->middleware('manager');

        // route surat izin dari manager
        Route::get('/manager/surat_izin','suratIzin')->middleware('manager');
        Route::get('/manager/buat_surat_izin','buatSuratIzin')->middleware('manager');
        Route::post('/manager/buat_surat_izin','simpanSuratIzin');    
        Route::get('/manager/kandidat/cetak_surat/{id}','cetakSurat')->middleware('manager');
        Route::get('/manager/kandidat/surat_izin_waris','cetakSuratKosong');
    }
        
    // DATA AKADEMI //
    {
        // route lihat data akademi
        Route::get('/manager/akademi/list_akademi','akademi')->middleware('manager');
        Route::get('/manager/akademi/lihat_profil/{id}','lihatProfilAkademi')->middleware('manager');
    }

    // DATA PERUSAHAAN //
    {
        // route lihat data perusahaan
        Route::get('/manager/perusahaan/list_perusahaan','perusahaan')->middleware('manager');
        Route::get('/manager/perusahaan/lihat_profil/{id}','lihatProfilPerusahaan')->middleware('manager');
        
        // route lowongan perusahaan
        Route::get('/manager/perusahaan/lihat_lowongan/{id}','lihatLowonganPekerjaan')->middleware('manager');
        
        // route pembuatan PMI ID
        Route::get('/manager/perusahaan/pembuatan_id_pmi','IDPMI');
        Route::post('/manager/perusahaan/pembuatan_id_pmi','buatIDPMI');
        Route::post('/manager/perusahaan/simpan_id_pmi','simpanIDPMI');
        Route::get('/manager/perusahaan/lihat_pmi_id/{id}','lihatIDPMI');
        Route::get('/manager/perusahaan/cetak_pmi_id/{id}','cetakIDPMI');
    } 
});

// DATA MANAGER KANDIDAT //
Route::controller(ManagerKandidatController::class)->group(function() {
    // route data kandidat
    Route::get('/manager/kandidat/kandidat_baru','kandidatBaru')->middleware('manager');
    Route::get('/manager/kandidat/dalam_negeri','dalamNegeri')->middleware('manager');
    Route::get('/manager/kandidat/luar_negeri','luarNegeri')->middleware('manager');

    // route edit kandidat personal / diri manager
    Route::get('/manager/edit/kandidat/personal/{id}','isi_personal')->middleware('manager');
    Route::post('/manager/edit/kandidat/personal/{id}','simpan_personal');
    
    // route edit kandidat document / dokumen manager
    Route::get('/manager/edit/kandidat/document/{id}','isi_document')->middleware('manager');
    Route::post('/manager/edit/kandidat/document/{id}','simpan_document');
    
    // route edit kandidat family / keluarga manager
    Route::get('/manager/edit/kandidat/family/{id}','isi_family')->middleware('manager');
    Route::post('/manager/edit/kandidat/family/{id}','simpan_family');
        
    // route edit kandidat parent / orang tua / wali manager
    Route::get('/manager/edit/kandidat/parent/{id}','isi_parent')->middleware('manager');
    Route::post('/manager/edit/kandidat/parent/{id}','simpan_parent');
        
    // route edit kandidat permission / perizinan / kontak darurat manager
    Route::get('/manager/edit/kandidat/permission/{id}','isi_permission')->middleware('manager');
    Route::post('/manager/edit/kandidat/permission/{id}','simpan_permission');
    
    // route edit kandidat paspor / passport manager
    Route::get('/manager/edit/kandidat/paspor/{id}','isi_paspor')->middleware('manager');
    Route::post('/manager/edit/kandidat/paspor/{id}','simpan_paspor');
    
    // route edit kandidat placement / penempatan manager
    Route::get('/manager/edit/kandidat/placement/{id}','isi_placement')->middleware('manager');
    Route::post('/manager/edit/kandidat/placement/{id}','simpan_placement');
    
    // route lihat kandidat melamar
    Route::get('/manager/kandidat/pelamar_lowongan','pelamarLowongan');
    Route::get('/manager/kandidat/lihat_lowongan_pelamar/{id}','lihatPelamarLowongan');

    // route penolakan kandidat
    Route::get('/manager/kandidat/penolakan_kandidat','penolakanKandidat');
    Route::get('/manager/kandidat/lihat/penolakan_kandidat/{id}','lihatPenolakanKandidat');

    // route penghapusan data kandidat
    Route::get('/manager/kandidat/penghapusan_kandidat','penghapusanKandidat')->middleware('manager');
    Route::get('/manager/kandidat/confirm_penghapusan/{id}','confirmPenghapusanKandidat');

    // route data laporan kandidat
    Route::get('/manager/kandidat/laporan_kandidat','laporanKandidat')->middleware('manager');
    Route::get('/manager/kandidat/lihat_laporan_kandidat/{id}','lihatLaporanKandidat')->middleware('manager');

    // route lihat video kandidat
    Route::get('/manager/kandidat/lihat_video/{id}','lihatVideoKandidat');

    // route lihat penerimaan kandidat dari perusahaan
    Route::get('/manager/kandidat/penerimaan_perusahaan','penerimaanPerusahaan')->middleware('manager');
    Route::get('/manager/kandidat/lihat_penerimaan_perusahaan/{id}','lihatPenerimaanPerusahaan')->middleware('manager');
    Route::post('/manager/kandidat/cari_penerimaan_perusahaan/{id}','cariPenerimaanPerusahaan');
    Route::post('/manager/kandidat/lihat_penerimaan_perusahaan/{id}','konfirmasiPenerimaanPerusahaan')->middleware('manager');
});

// DATA MANAGER PEMBAYARAN //
Route::controller(ManagerPaymentController::class)->group(function() {
    // DATA MANAGER //
    {
        Route::get('/manager/payment','index')->middleware('payment')->name('payment');
    }    

    // DATA KANDIDAT //
    {
        Route::get('/manager/payment/kandidat','kandidatPayment')->middleware('payment');
        Route::get('/manager/lihat/payment/kandidat/{id}','lihatKandidatPayment');
        Route::post('/manager/lihat/payment/kandidat/{id}','confirmKandidatPayment');    
    }
    
    // DATA PERUSAHAAN //
    {
        Route::get('/manager/payment/perusahaan','perusahaanPayment')->middleware('payment');
        Route::get('/manager/lihat/payment/perusahaan/{id}','lihatPerusahaanPayment');
        Route::post('/manager/lihat/payment/perusahaan/{id}','confirmPerusahaanPayment');    
    }
});

// DATA MANAGER CONTACT US //
Route::controller(ContactUsController::class)->group(function() {
    // route manager contact us
    Route::get('/manager/contact_us','contactUs')->middleware('contact.service')->name('cs');
    Route::post('/manager/contact_us','sendContactUs');
    
    // route manager contact us kandidat
    Route::get('/manager/contact_us_kandidat','contactUsKandidatList')->middleware('contact.service');
    Route::get('/manager/lihat/contact_kandidat/{id}','contactUsKandidatLihat')->middleware('contact.service');
    Route::post('/manager/lihat/contact_kandidat/{id}','contactUsKandidatJawab');
    
    // route manager contact us akademi
    Route::get('/manager/contact_us_akademi','contactUsAkademiList')->middleware('contact.service');
    Route::get('/manager/lihat/contact_akademi/{id}','contactUsAkademiLihat')->middleware('contact.service');
    Route::post('/manager/lihat/contact_akademi/{id}','contactUsAkademiJawab');
    
    // route manager contact us perusahaan
    Route::get('/manager/contact_us_perusahaan','contactUsPerusahaanList')->middleware('contact.service');
    Route::get('/manager/lihat/contact_perusahaan/{id}','contactUsPerusahaanLihat')->middleware('contact.service');
    Route::post('/manager/lihat/contact_perusahaan/{id}','contactUsPerusahaanJawab');
});

// DATA LAMAN //
    {
        // route halaman awal
        Route::view('/', 'laman')->name('laman')->middleware('guest');    
        Route::view('/laman', 'laman')->middleware('guest');
        
        // route syarat dan ketentuan register
        Route::view('/syarat_ketentuan/kandidat','laman/persyaratan_kandidat')->middleware('guest');
        Route::view('/syarat_ketentuan/akademi','laman/persyaratan_akademi')->middleware('guest');
        Route::view('/syarat_ketentuan/perusahaan','laman/persyaratan_perusahaan')->middleware('guest');

        // Route::get('/login_gmail',  'login_gmail')->name('login_gmail')->middleware('guest');
        // Route::get('/login_referral',  'login_referral')->middleware('guest');
        // Route::get('/login_info',  'login_info')->middleware('guest');
        // Route::post('/login_info',  'info');
        
        // route halaman awal
        Route::view('/digijob_system','digijob_system')->middleware('guest');
        Route::view('/benefits','benefits')->middleware('guest');
        Route::view('/features','features')->middleware('guest');
        Route::view('/hubungi_kami','contact_us')->middleware('guest');
        Route::view('/about_us','about_us')->middleware('guest');
    }
    
// DATA LOGIN //
Route::controller(LoginController::class)->group(function() {
    // route halaman awal login
    Route::get('/login','loginSemua')->middleware('guest');
    Route::post('/login','AuthenticateLogin');
    
    // route kandidat lupa password
    Route::view('/forgot_password/kandidat','auth/passwords/forgot_password_kandidat')->middleware('guest');
    Route::post('/forgot_password/kandidat','confirmAccountKandidat');
    
    // route akademi lupa password
    Route::view('/forgot_password/akademi','auth/passwords/forgot_password_akademi')->middleware('guest');
    Route::post('/forgot_password/akademi','confirmAccountAkademi');
    
    // route perusahaan lupa password
    Route::view('/forgot_password/perusahaan','auth/passwords/forgot_password_perusahaan')->middleware('guest');
    Route::post('/forgot_password/perusahaan','confirmAccountPerusahaan');

    // route  akun yang sudah ada di dalam
    Route::get('/login/migration','loginMigration')->middleware('guest');
    Route::post('/login/migration','checkLoginMigration');
    Route::post('/login/migration/confirm', 'confirmLoginMigration');
    
    // route log out / keluar aplikasi
    Route::get('/logout','logout')->name('logout');
});

// DATA REGISTER //
Route::controller(RegisterController::class)->group(function() {
    // route halaman register
    Route::view('/register','auth/register_semua')->middleware('guest');
    
    // route register kandidat
    Route::view('/register/kandidat', 'auth/register_kandidat')->middleware('guest');
    Route::post('/register/kandidat', 'kandidat');
    
    // Route::get('/kandidat_umur/{nama}','umurKandidat')->middleware('guest');
    Route::post('/kandidat_umur/{nama}','syaratUmur');
    
    // route register akademi
    Route::view('/register/akademi', 'auth/register_akademi')->middleware('guest');
    Route::post('/register/akademi', 'akademi');
    
    // route register perusahaan
    Route::view('/register/perusahaan', 'auth/register_perusahaan')->middleware('guest');
    Route::post('/register/perusahaan', 'perusahaan');
});

// DATA VERIFIKASI PENDAFTAR / PENGGUNA //
Route::controller(VerifikasiController::class)->group(function(){
    // route kirim email verifikasi pengguna
    Route::view('/verifikasi','auth/verifikasi')->name('verifikasi')->middleware('verify');
    Route::get('/ulang_verifikasi','ulang_verifikasi')->middleware('verify');
    Route::get('/verify_account/{token}','verifyAccount')->name('users_verification')->middleware('verify');    

    // route sistem konfirmasi verifikasi pengguna
    Route::get('/user_code_id','userCodeID')->name('nomorID');
    Route::post('/user_code_id','confirmUserCodeID');
    Route::post('/kirim_verifikasi_diri','confirmVerifikasiDiri');
    Route::post('/new_password','confirmPassword');
});

// DATA KANDIDAT //
Route::controller(KandidatController::class)->group(function() {
    // route data diri kandidat
    Route::get('/kandidat','index')->middleware('kandidat')->name('kandidat');
    Route::get('/profil_kandidat','profil')->middleware('kandidat');
    Route::get('/galeri_pengalaman_kerja/{id}', 'Galeri')->middleware('kandidat');
    Route::get('/lihat_galeri_pengalaman_kerja/{id}/{type}','lihatGaleri')->middleware('kandidat');
    
    // contact us kandidat
    Route::get('/contact_us_kandidat','contactUsKandidat')->middleware('kandidat');

    // route informasi aplikasi ini didapat
    Route::post('/info_connect/{nama}/{id}','simpanInfoConnect');

    // route isi data personal
    Route::get('/isi_kandidat_personal', 'isi_kandidat_personal')->middleware('kandidat')->name('personal');
    Route::post('/isi_kandidat_personal', 'simpan_kandidat_personal');
    
    // route edit data password
    Route::get('/edit_kandidat_password','edit_kandidat_password');
    Route::post('/edit_password_confirm', 'edit_password_confirm');
    Route::post('/ubah_kandidat_password', 'ubah_kandidat_password');

    // route edit data no telp
    // Route::view('/edit_kandidat_no_telp','kandidat/modalKandidat/edit_no_telp');
    // Route::post('/edit_kandidat_no_telp','ubah_kandidat_noTelp');
    
    // route konfirmasi kode otp no telp
    // Route::post('/confirm_otp_code','confirmOTP');
    // Route::post('/confirm_kandidat_otp_telp','confirm_kandidat_OTP_Telp');

    // route isi data document / dokumen
    Route::get('/isi_kandidat_document', 'isi_kandidat_document')->middleware('kandidat')->name('document');
    Route::post('/isi_kandidat_document', 'simpan_kandidat_document');

    // route isi data family / keluarga (apabila pernah berkeluarga)
    Route::get('/isi_kandidat_family', 'isi_kandidat_family')->middleware('kandidat')->name('family');
    Route::post('/isi_kandidat_anak', 'simpan_kandidat_anak');
    Route::post('/isi_kandidat_family', 'simpan_kandidat_family');    

    // route isi data vaksin
    Route::get('/isi_kandidat_vaksin', 'isi_kandidat_vaksin')->middleware('kandidat')->name('vaksin');
    Route::post('/isi_kandidat_vaksin', 'simpan_kandidat_vaksin');

    // route isi data parent / keluarga
    Route::get('/isi_kandidat_parent', 'isi_kandidat_parent')->middleware('kandidat')->name('parent');
    Route::post('/isi_kandidat_parent', 'simpan_kandidat_parent');

    // route isi data company / perusahaan
    Route::get('/isi_kandidat_company', 'isi_kandidat_company')->middleware('kandidat')->name('company');
    Route::post('/isi_kandidat_company', 'simpan_kandidat_company');
    
    // route tambah + simpan data pengalaman kerja
    Route::post('/simpan_kandidat_pengalaman_kerja', 'tambahPengalamanKerja');
    
    // route lihat pengalaman kerja + portofolio pengalaman kerja
    Route::get('/lihat_kandidat_pengalaman_kerja/{id}','lihatPengalamanKerja')->middleware('kandidat');
    Route::get('/tambah_portofolio_pengalaman_kerja/{id}/{type}','tambahPortofolio')->middleware('kandidat');
    Route::post('/tambah_portofolio_pengalaman_kerja/{id}/{type}','simpanPortofolio');
    Route::get('/edit_portofolio_pengalaman_kerja/{id}/{type}','editPortofolio')->middleware('kandidat');
    Route::post('/edit_portofolio_pengalaman_kerja/{id}/{type}','ubahPortofolio');
    Route::get('/hapus_portofolio_pengalaman_kerja/{id}/{type}','hapusPortofolio');

    // route edit pengalaman kerja + portofolio
    Route::get('/edit_kandidat_pengalaman_kerja/{id}','editPengalamanKerja')->middleware('kandidat');
    Route::post('/update_kandidat_pengalaman_kerja/{id}','updatePengalamanKerja');
    Route::get('/hapus_kandidat_pengalaman_kerja/{id}','hapusPengalamanKerja');

    // route isi kandidat permission / perizinan / kontak darurat
    Route::get('/isi_kandidat_permission', 'isi_kandidat_permission')->middleware('kandidat')->name('permission');
    Route::post('/isi_kandidat_permission', 'simpan_kandidat_permission');

    // route isi kandidat passport / paspor (jika sudah memiliki)
    Route::get('/isi_kandidat_paspor', 'isi_kandidat_paspor')->middleware('kandidat')->name('paspor');
    Route::post('/isi_kandidat_paspor', 'simpan_kandidat_paspor');    

    // route penentuan penempatan kerja kandidat
    Route::get('/penempatan', 'placement');
    Route::post('/isi_kandidat_placement', 'simpan_kandidat_placement');

    // route video pelatihan kandidat
    Route::get('/video_pelatihan','videoPelatihan')->middleware('kandidat');
    Route::get('/lihat_video_pelatihan/{id}','lihatVideoPelatihan')->middleware('kandidat');
    
    // route hub. kami / bantuan kandidat
    // Route::get('/contact_us','contactUsKandidat');
    // Route::post('/contact_us','sendContactUsKandidat');
});

// DATA KANDIDAT PERUSAHAAN //
Route::controller(KandidatPerusahaanController::class)->group(function() {    
    // route lihat profil perusahaan
    Route::get('/profil_perusahaan/{id}','perusahaan')->middleware('kandidat');
        
    // route lowongan perusahaan 
    Route::get('/list_lowongan_pekerjaan','listLowonganPekerjaan')->middleware('kandidat');
    Route::get('/lihat_lowongan_pekerjaan/{id}','lowonganPekerjaan')->middleware('kandidat'); 
    
    // route permohonan melamar lowongan perusahaan
    Route::get('/permohonan_lowongan/{id}','permohonanLowongan')->middleware('kandidat');
    Route::post('/permohonan_lowongan/{id}','kirimPermohonan');
    
    // route keluar perusahaan / batal lowongan
    Route::get('/keluar_perusahaan/{id}','keluarPerusahaan')->middleware('kandidat');
    
    // route konfirmasi persetujuan kandidat
    Route::post('/persetujuan_kandidat/{nama}/{id}','persetujuanKandidat');

    // route undangan interview
    Route::get('/interview_perusahaan','interviewPerusahaan')->middleware('kandidat');
});


// DATA AKADEMI //
Route::controller(AkademiController::class)->group(function() {
    // DATA AKADEMI //
    {
        // route data akademi
        Route::get('/akademi', 'index')->name('akademi')->middleware('akademi');
        Route::get('/akademi/lihat/profil','lihatProfilAkademi')->middleware('akademi');
        
        // route hub. kami / bantuan akademi
        // Route::get('/contact_us_akademi','contactUsAkademi')->middleware('akademi');
        
        // route isi data akademi
        Route::get('/akademi/isi_akademi_data','isi_akademi_data')->middleware('akademi')->name('akademi.data');
        Route::post('/akademi/isi_akademi_data','simpan_akademi_data');

        // route isi data akademi operator
        Route::get('/akademi/isi_akademi_operator','isi_akademi_operator')->middleware('akademi')->name('akademi.operator');
        Route::post('/akademi/isi_akademi_operator','simpan_akademi_operator');
    }
    
    // DATA KANDIDAT //
    {
        // route list kandidat dalam akademi
        Route::get('/akademi/list_kandidat','listKandidat')->middleware('akademi')->middleware('akademi');
        Route::get('/akademi/kandidat/lihat_profil/{nama}/{id}','lihatProfilKandidat')->middleware('akademi');    
    }
});

// DATA AKADEMI KANDIDAT //
Route::controller(AkademiKandidatController::class)->group(function() {
    // route tambah data kandidat akademi
    Route::get('/akademi/tambah_kandidat', 'tambahKandidat')->middleware('akademi');
    Route::post('/akademi/tambah_kandidat', 'simpanKandidat');
    
    // route isi kandidat personal akademi
    Route::get('/akademi/isi_kandidat_personal/{nama}/{id}', 'isi_personal')->middleware('akademi');
    Route::post('/akademi/isi_kandidat_personal/{nama}/{id}', 'simpan_personal');
    
    // route isi kandidat document / dokument
    Route::get('/akademi/isi_kandidat_document/{nama}/{id}', 'isi_document')->middleware('akademi');
    Route::post('/akademi/isi_kandidat_document/{nama}/{id}', 'simpan_document');

    // route isi kandidat vaksin
    Route::get('/akademi/isi_kandidat_vaksin/{nama}/{id}', 'isi_vaksin')->middleware('akademi');
    Route::post('/akademi/isi_kandidat_vaksin/{nama}/{id}', 'simpan_vaksin');

    // route isi kandidat parent / orang tua
    Route::get('/akademi/isi_kandidat_parent/{nama}/{id}', 'isi_parent')->middleware('akademi');
    Route::post('/akademi/isi_kandidat_parent/{nama}/{id}', 'simpan_parent');

    // route isi kandidat permission / kontak darurat / perizinan
    Route::get('/akademi/isi_kandidat_permission/{nama}/{id}', 'isi_permission')->middleware('akademi');
    Route::post('/akademi/isi_kandidat_permission/{nama}/{id}', 'simpan_permission');

    // route isi kandidat placement / penempatan
    Route::get('/akademi/isi_kandidat_placement/{nama}/{id}', 'isi_placement')->middleware('akademi');
    Route::post('/akademi/isi_kandidat_placement/{nama}/{id}', 'simpan_placement');
});

// DATA PERUSAHAAN //
Route::controller(PerusahaanController::class)->group(function(){
    // DATA PERUSAHAAN //
    {
        // route data perusahaan
        Route::get('/perusahaan','index')->name('perusahaan')->middleware('perusahaan');
        Route::get('/perusahaan/lihat/perusahaan','profil')->middleware('perusahaan');    

        // route isi data perusahaan
        Route::get('/perusahaan/isi_perusahaan_data','isi_perusahaan_data')->name('perusahaan.data')->middleware('perusahaan');
        Route::post('/perusahaan/isi_perusahaan_data','simpan_perusahaan_data');
        
        // route isi data perusahaan alamat
        Route::get('/perusahaan/isi_perusahaan_alamat','isi_perusahaan_alamat')->name('perusahaan.alamat')->middleware('perusahaan');
        Route::post('/perusahaan/isi_perusahaan_alamat','simpan_perusahaan_alamat');
        
        // route isi data perusahaan operator
        Route::get('/perusahaan/isi_perusahaan_operator','isi_perusahaan_operator')->name('perusahaan.operator')->middleware('perusahaan');
        Route::post('/perusahaan/isi_perusahaan_operator','simpan_perusahaan_operator');
        
        // route hub. kami / bantuan bagian perusahaan
        // Route::get('/contact_us_perusahaan','contactUsPerusahaan')->middleware('perusahaan');

        // route pembayaran perusahaan
        Route::get('/perusahaan/list/pembayaran','pembayaran')->middleware('perusahaan');
        Route::get('/perusahaan/payment/{id}','payment')->middleware('perusahaan');
        Route::post('/perusahaan/payment/{id}','paymentCheck');
    }

    // DATA KANDIDAT //
    {
        // route data kandidat perusahaan
        Route::get('/perusahaan/semua/kandidat','semuaKandidat')->middleware('perusahaan');
        Route::get('/perusahaan/list/kandidat/lowongan/{id}','listKandidatLowongan')->middleware('perusahaan');
        Route::post('/perusahaan/list/kandidat/lowongan/{id}','cariKandidatLowongan');
        
        // route lihat data kandidat
        Route::get('/perusahaan/lihat/kandidat/{id}','lihatProfilKandidat')->middleware('perusahaan');
        Route::get('/perusahaan/galeri_kandidat/{id}','galeriKandidat')->middleware('perusahaan');
        Route::get('/perusahaan/lihat/galeri_kandidat/{id}/{type}','lihatGaleriKandidat')->middleware('perusahaan');
               
        // route sistem mengeluarkan kandidat
        Route::get('/perusahaan/keluarkan_kandidat_perusahaan/{id}/{nama}','keluarkanKandidatPerusahaan')->middleware('perusahaan');
    }
});

// DATA PERUSAHAAN RECRUITMENT // 
Route::controller(PerusahaanRecruitmentController::class)->group(function() {
    // route cari kandidat staff perusahaan
    Route::get('/perusahaan/cari_kandidat_staff','cariKandidatStaff');
    Route::post('/perusahaan/cari_kandidat_staff','pencarianKandidatStaff');

    // route lowongan pekerjaan
    Route::get('/perusahaan/list/lowongan/{type}','lowonganPekerjaan')->middleware('perusahaan');
    Route::get('/perusahaan/buat_lowongan/{type}','tambahLowongan')->middleware('perusahaan');
    Route::get('/lowongan_negara','lowonganNegara');
    Route::get('/benefit','lowonganBenefit');
    Route::get('/fasilitas','lowonganFasilitas');
    Route::post('/perusahaan/buat_lowongan/{type}','simpanLowongan');
    Route::get('/perusahaan/lihat_lowongan/{id}/{type}','lihatLowongan')->middleware('perusahaan');
    Route::get('/perusahaan/edit_lowongan/{id}/{type}','editLowongan')->middleware('perusahaan');
    Route::post('/perusahaan/edit_lowongan/{id}/{type}','updateLowongan');
    Route::get('/perusahaan/hapus_lowongan/{id}/{type}','hapusLowongan')->middleware('perusahaan');

    // route list permohonan lowongan dari kandidat ke perusahaan
    Route::get('/perusahaan/list_permohonan_lowongan','listPermohonanLowongan')->middleware('perusahaan');
    Route::get('/perusahaan/kandidat_lowongan_dipilih/{id}','kandidatLowonganDipilih')->middleware('perusahaan');
    Route::get('/perusahaan/lowongan_kandidat_sesuai/{id}','lowonganKandidatSesuai')->middleware('perusahaan');
    Route::get('/perusahaan/lihat_permohonan_lowongan/{id}','lihatPermohonanLowongan')->middleware('perusahaan');
    Route::post('/perusahaan/terima_permohonan_lowongan/{id}','confirmPermohonanLowongan');
    Route::post('/perusahaan/kandidat_dipilih_interview/{id}','kandidatDipilihInterview');
    Route::get('/perusahaan/batal_kandidat_lowongan/{id}','cancelKandidatLowongan');
    Route::post('/perusahaan/batal_kandidat_lowongan/{id}','confirmCancelKandidatLowongan');

    // route jadwal interview kandidat
    Route::get('/perusahaan/jadwal_interview/{id}','jadwalInterview')->middleware('perusahaan');
    Route::post('/perusahaan/jadwal_interview/{id}','confirmJadwalInterview');    
    Route::post('/perusahaan/waktu_interview/{id}','confirmWaktuInterview');
    Route::post('/perusahaan/konfirmasi_interview/{id}','konfirmasiInterview');
    Route::post('/perusahaan/pembayaran_interview/{id}','pembayaranInterview');
    
    // route seleksi kandidat interview
    Route::get('/perusahaan/lihat_jadwal_interview/{id}','lihatJadwalInterview')->middleware('perusahaan');
    Route::get('/perusahaan/seleksi_kandidat/{id}','seleksiKandidat')->middleware('perusahaan');
    Route::post('/perusahaan/seleksi_kandidat/{id}','terimaSeleksiKandidat');
    Route::get('/perusahaan/tolak_seleksi_kandidat/{id}','tolakSeleksiKandidat')->middleware('perusahaan');
});

// DATA KANDIDAT PRIORITAS //
Route::controller(PrioritasController::class)->group(function(){
    Route::get('/info_prioritas','prioritas_info')->middleware('prioritas');
    Route::get('/kandidat/prioritas','prioritas')->middleware('prioritas')->name('prioritas');
    Route::get('/pelatihan_interview','interview')->middleware('prioritas');
});

// DATA  NOTIFIKASI //
Route::controller(NotifikasiController::class)->group(function() {
    // DATA KANDIDAT //
    {
        Route::get('/semua_notif','notifyKandidat')->middleware('kandidat');
        Route::get('/lihat_notif_kandidat/{id}','lihatNotifKandidat')->middleware('kandidat');    
    }
    
    // DATA AKADEMI
    {
        Route::get('/akademi/semua_notif','notifyAkademi')->middleware('akademi');
        Route::get('/akademi/lihat_notif_akademi/{id}','lihatNotifAkademi')->middleware('akademi');    
    }

    // DATA PERUSAHAAN
    {
        Route::get('/perusahaan/semua_notif','notifyPerusahaan')->middleware('perusahaan');
        Route::get('/perusahaan/lihat_notif_perusahaan/{id}','lihatNotifPerusahaan')->middleware('perusahaan');    
    }
});

// DATA PESAN //
Route::controller(MessagerController::class)->group(function() {
    // DATA KANDIDAT //
    {
        Route::get('/semua_pesan','messageKandidat')->middleware('kandidat')->name('semuaPesan');
        Route::get('/kirim_balik/{id}','sendMessageKandidat')->middleware('kandidat');
        Route::post('/kirim_balik/{id}','sendMessageConfirmKandidat');
        Route::get('/hapus_pesan/{id}','deleteMessageKandidat')->middleware('kandidat');    
    }

    // DATA AKADEMI //
    {
        Route::get('/akademi/semua_pesan','messageAkademi')->middleware('akademi')->name('akademi.semuaPesan');
        Route::get('/akademi/kirim_balik/{id}','sendMessageAkademi')->middleware('akademi');
        Route::post('/akademi/kirim_balik/{id}','sendMessageConfirmAkademi');
        Route::get('/akademi/hapus_pesan/{id}','deleteMessageAkademi')->middleware('akademi');    
    }

    // DATA PERUSAHAAN //
    {
        Route::get('/perusahaan/semua_pesan','messagePerusahaan')->middleware('perusahaan')->name('perusahaan.semuaPesan');
        Route::get('/perusahaan/kirim_balik/{id}','sendMessagePerusahaan')->middleware('perusahaan');
        Route::post('/perusahaan/kirim_balik/{id}','sendMessageConfirmPerusahaan');
        Route::get('/perusahaan/hapus_pesan/{id}','deleteMessagePerusahaan')->middleware('perusahaan');    
    }
});

// CETAK DATA //
Route::controller(OutputController::class)->group(function() {
    // route cetak data dari kandidat
    Route::get('/output_izin_waris', 'izinWaris')->middleware('kandidat');
    
    // route cetak data
    Route::get('/surat_izin_waris', 'suratIzinWaris');
    Route::get('/cetak/{id}', 'cetak')->name('cetak');
    
    // route cetak data dari manager
    Route::get('/manager/perusahaan/cetak_pmi_id/{id}','cetakPmiID')->middleware('manager');
});

// DATA NEGARA TUJUAN //
Route::controller(NegaraController::class)->group(function() {
    // route negara tujuan
    Route::get('/manager/negara_tujuan','index')->middleware('manager')->name('negara');
    Route::get('/manager/lihat_negara/{id}','lihatNegara')->middleware('manager');
    Route::get('/manager/tambah_negara','tambahNegara')->middleware('manager');
    Route::post('/manager/tambah_negara','simpanNegara');
    Route::get('/manager/edit_negara/{id}','editNegara')->middleware('manager');
    Route::post('/manager/edit_negara/{id}','ubahNegara');
    Route::get('/manager/hapus_negara/{id}','hapusNegara')->middleware('manager');
});

// data pembayaran
Route::controller(PaymentController::class)->group(function(){
    // DATA KANDIDAT //
    {
        Route::get('/payment','paymentKandidat')->middleware('kandidat');
        Route::post('/payment', 'kandidatConfirm')->middleware('kandidat');    
    }

    // DATA PERUSAHAAN //
    {
        Route::view('/transfer','mail/pembayaran');
        Route::get('/perusahaan/payment_confirm/{token}','paymentConfirm')->middleware('perusahaan')->name('payment.confirm');    
    }

    Route::view('/pembayaran','mail/pembayaran');
    Route::view('check_mail_verify','mail/verify');
});

Route::view('/pembayaran','mail.pembayaran')->middleware('manager');

Route::view('/perbaikan','dalam_proses');
Route::view('/mail', 'mail/mail');