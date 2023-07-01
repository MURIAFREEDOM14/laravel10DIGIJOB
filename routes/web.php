<?php

// use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Akademi\AkademiController;
use App\Http\Controllers\Akademi\AkademiKandidatController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\Manager\Kandidat\ManagerKandidatController;
use App\Http\Controllers\Manager\ContactUsController;
use App\Http\Controllers\Manager\NoreplyController;
use App\Http\Controllers\Kandidat\KandidatPerusahaanController;
use App\Http\Controllers\CaptureController;
use App\Http\Controllers\OutputController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\PrioritasController;
use App\Http\Controllers\PrototypeController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LamanController;
use App\Http\Livewire\Location;
use App\Http\Livewire\LocationPermission;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KandidatController;
use App\Http\Controllers\NegaraController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\MessagerController;
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
// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();
// Auth::routes(['verify' => true]);

// DATA MANAGER //
Route::controller(ManagerController::class)->group(function() {
    Route::get('/manager_access', 'login')->name('manager_access')->middleware('guest');
    Route::post('/manager_access', 'authenticate');
    Route::get('/manager', 'index')->middleware('manager')->name('manager');
    Route::get('/manager/surat_izin','suratIzin')->middleware('manager');
    Route::get('/manager/buat_surat_izin','buatSuratIzin')->middleware('manager');
    Route::post('/manager/buat_surat_izin','simpanSuratIzin');
    Route::get('/manager/kandidat/cetak_surat/{id}','cetakSurat')->middleware('manager');

    Route::get('/manager/beta_tester','betaTester')->middleware('manager');
    Route::post('/manager/beta_tester','simpanBetaTester');

    // DATA KANDIDAT // 
    Route::get('/manager/kandidat/lihat_profil/{id}','lihatProfil')->middleware('manager');
    
    Route::get('/manager/kandidat/pelatihan','pelatihan')->middleware('manager');
    Route::get('/manager/kandidat/tambah_pelatihan','tambahPelatihan')->middleware('manager');
    Route::post('/manager/kandidat/tambah_pelatihan','simpanPelatihan');
    Route::get('/manager/kandidat/edit_pelatihan/{id}','editPelatihan')->middleware('manager');
    Route::post('/manager/kandidat/edit_pelatihan/{id}','updatePelatihan');
    Route::get('/manager/kandidat/hapus_pelatihan/{id}','hapusPelatihan')->middleware('manager');

    Route::get('/manager/pembayaran/kandidat','pembayaranKandidat')->middleware('manager');
    Route::get('/manager/cek_pembayaran/kandidat/{id}','cekPembayaranKandidat')->middleware('manager');
    Route::post('/manager/cek_pembayaran/kandidat/{id}','cekConfirmKandidat');

    // DATA AKADEMI //
    Route::get('/manager/akademi/list_akademi','akademi')->middleware('manager');
    Route::get('/manager/akademi/lihat_profil/{id}','lihatProfilAkademi')->middleware('manager');

    // DATA PERUSAHAAN //
    Route::get('/manager/perusahaan/list_perusahaan','perusahaan')->middleware('manager');
    Route::get('/manager/perusahaan/lihat_profil/{id}','lihatProfilPerusahaan')->middleware('manager');
    Route::get('/manager/pembayaran/perusahaan','pembayaranPerusahaan')->middleware('manager');
    Route::get('/manager/cek_pembayaran/perusahaan/{id}','cekPembayaranPerusahaan')->middleware('manager');
    Route::post('/manager/cek_pembayaran/perusahaan/{id}','cekConfirmPerusahaan');

});

Route::controller(ManagerKandidatController::class)->group(function() {
    Route::get('/manager/kandidat/dalam_negeri','dalam_negeri')->middleware('manager');
    Route::get('/manager/kandidat/luar_negeri','luar_negeri')->middleware('manager');

    Route::get('/manager/edit/kandidat/personal/{id}','isi_personal')->middleware('manager');
    Route::post('/manager/edit/kandidat/personal/{id}','simpan_personal');
    
    Route::get('/manager/edit/kandidat/document/{id}','isi_document')->middleware('manager');
    Route::post('/manager/edit/kandidat/document/{id}','simpan_document');
    
    Route::get('/manager/edit/kandidat/family/{id}','isi_family')->middleware('manager');
    Route::post('/manager/edit/kandidat/family/{id}','simpan_family');
    
    Route::get('/manager/edit/kandidat/vaksin/{id}','isi_vaksin')->middleware('manager');
    Route::post('/manager/edit/kandidat/vaksin/{id}','simpan_vaksin');
    
    Route::get('/manager/edit/kandidat/parent/{id}','isi_parent')->middleware('manager');
    Route::post('/manager/edit/kandidat/parent/{id}','simpan_parent');
    
    Route::get('/manager/edit/kandidat/company/{id}','isi_company')->middleware('manager');
    Route::post('/manager/edit/kandidat/company/{id}','simpan_company');
    
    Route::get('/manager/edit/kandidat/permission/{id}','isi_permission')->middleware('manager');
    Route::post('/manager/edit/kandidat/permission/{id}','simpan_permission');
    
    Route::get('/manager/edit/kandidat/paspor/{id}','isi_paspor')->middleware('manager');
    Route::post('/manager/edit/kandidat/paspor/{id}','simpan_paspor');
    
    Route::get('/manager/edit/kandidat/placement/{id}','isi_placement')->middleware('manager');
    Route::post('/manager/edit/kandidat/placement/{id}','simpan_placement');
    
    Route::get('/manager/edit/kandidat/job/{id}','isi_job')->middleware('manager');
    Route::post('/manager/edit/kandidat/job/{id}','simpan_job');

    Route::get('/manager/reset_kandidat','resetKandidat');
    Route::post('/manager/reset_kandidat','resetDataKandidat');
});

Route::controller(ContactUsController::class)->group(function() {
    Route::get('/manager/contact_us_admin','contactUsAdmin')->middleware('manager');
    Route::post('/manager/contact_us_admin','tambahContactUsAdmin');
    Route::get('/manager/hapus_contact_us_admin','hapusContactUsAdmin');

    Route::get('/manager/contact_us','contactUs')->middleware('contact.service')->name('cs');
    Route::post('/manager/contact_us','sendContactUs');
    
    Route::get('/manager/contact_us_guest','contactUsGuestList')->middleware('contact.service');
    Route::get('/manager/lihat/contact_guest/{id}','contactUsGuestLihat')->middleware('contact.service');
    Route::post('/manager/contact_jawab_guest/{id}','contactUsGuestJawab');

    Route::get('/manager/contact_us_kandidat','contactUsKandidatList')->middleware('contact.service');
    Route::get('/manager/lihat/contact_kandidat/{id}','contactUsKandidatLihat')->middleware('contact.service');
    Route::post('/manager/lihat/contact_kandidat/{id}','contactUsKandidatJawab');
    
    Route::get('/manager/contact_us_akademi','contactUsAkademiList')->middleware('contact.service');
    Route::get('/manager/lihat/contact_akademi/{id}','contactUsAkademiLihat')->middleware('contact.service');
    Route::post('/manager/lihat/contact_akademi/{id}','contactUsAkademiJawab');
    
    Route::get('/manager/contact_us_perusahaan','contactUsPerusahaanList')->middleware('contact.service');
    Route::get('/manager/lihat/contact_perusahaan/{id}','contactUsPerusahaanLihat')->middleware('contact.service');
    Route::post('/manager/lihat/contact_perusahaan/{id}','contactUsPerusahaanJawab');
});

Route::controller(NoreplyController::class)->group(function(){
    Route::get('/manager/noreply','noreply');
});

// DATA LAMAN //
Route::controller(LamanController::class)->group(function() {
    Route::get('/laman', 'index')->name('laman')->middleware('guest');    
    
    Route::get('/login','loginSemua')->middleware('guest');
    Route::get('/login/kandidat', 'login_kandidat')->middleware('guest');
    Route::get('/login/akademi', 'login_akademi')->middleware('guest');
    Route::get('/login/perusahaan', 'login_perusahaan')->middleware('guest');

    Route::get('/register/kandidat',  'register_kandidat')->name('register_kandidat')->middleware('guest');
    Route::get('/register/akademi',  'register_akademi')->name('register_akademi')->middleware('guest');
    Route::get('/register/perusahaan',  'register_perusahaan')->name('register_perusahaan')->middleware('guest');

    Route::get('/login_gmail',  'login_gmail')->name('login_gmail')->middleware('guest');
    Route::get('/login_referral',  'login_referral')->middleware('guest');
    Route::get('/login_info',  'login_info')->middleware('guest');
    Route::post('/login_info',  'info');

    Route::get('/digijob_system','digijobSystem')->middleware('guest');
    Route::get('/benefits','benefits')->middleware('guest');
    Route::get('/features','features')->middleware('guest');
    Route::get('/hubungi_kami','contact')->middleware('guest');
    Route::get('/about_us','about')->middleware('guest');
});

// DATA AKADEMI //
Route::controller(AkademiController::class)->group(function() {
    Route::get('/akademi', 'index')->name('akademi')->middleware('akademi');
    Route::get('/akademi/lihat/profil','lihatProfilAkademi')->middleware('akademi');
    Route::get('/contact_us_akademi','contactUsAkademi')->middleware('akademi');
    Route::get('/akademi/edit/profil', 'editProfilAkademi')->middleware('akademi');

    Route::get('/akademi/isi_akademi_data','isi_akademi_data')->middleware('akademi')->name('akademi.data');
    Route::post('/akademi/isi_akademi_data','simpan_akademi_data');

    Route::get('/akademi/isi_akademi_operator','isi_akademi_operator')->middleware('akademi')->name('akademi.operator');
    Route::post('/akademi/isi_akademi_operator','simpan_akademi_operator');

    // DATA KANDIDAT //
    Route::get('/akademi/list_kandidat','listKandidat')->middleware('akademi')->middleware('akademi');
    Route::get('/akademi/kandidat/lihat_profil/{nama}/{id}','lihatProfilKandidat')->middleware('akademi');

    // DATA PERUSAHAAN //
    Route::get('/akademi/lihat/profil_perusahaan/{id}','lihatProfilPerusahaan')->middleware('akademi');

});

Route::controller(AkademiKandidatController::class)->group(function() {
    Route::get('/akademi/tambah_kandidat', 'tambahKandidat')->middleware('akademi');
    Route::post('/akademi/tambah_kandidat', 'simpanKandidat');
    
    Route::get('/akademi/isi_kandidat_personal/{nama}/{id}', 'isi_personal')->middleware('akademi');
    Route::post('/akademi/isi_kandidat_personal/{nama}/{id}', 'simpan_personal');
    
    Route::get('/akademi/isi_kandidat_document/{nama}/{id}', 'isi_document')->middleware('akademi');
    Route::post('/akademi/isi_kandidat_document/{nama}/{id}', 'simpan_document');

    Route::get('/akademi/isi_kandidat_vaksin/{nama}/{id}', 'isi_vaksin')->middleware('akademi');
    Route::post('/akademi/isi_kandidat_vaksin/{nama}/{id}', 'simpan_vaksin');

    Route::get('/akademi/isi_kandidat_parent/{nama}/{id}', 'isi_parent')->middleware('akademi');
    Route::post('/akademi/isi_kandidat_parent/{nama}/{id}', 'simpan_parent');

    Route::get('/akademi/isi_kandidat_permission/{nama}/{id}', 'isi_permission')->middleware('akademi');
    Route::post('/akademi/isi_kandidat_permission/{nama}/{id}', 'simpan_permission');

    Route::get('/akademi/isi_kandidat_placement/{nama}/{id}', 'isi_placement')->middleware('akademi');
    Route::post('/akademi/isi_kandidat_placement/{nama}/{id}', 'simpan_placement');

    Route::get('/akademi/isi_kandidat_job/{nama}/{id}', 'isi_job')->middleware('akademi');
    Route::post('/akademi/isi_kandidat_job/{nama}/{id}', 'simpan_job');
});

// DATA PERUSAHAAN //
Route::controller(PerusahaanController::class)->group(function(){
    Route::get('/perusahaan','index')->name('perusahaan')->middleware('perusahaan');
    
    Route::get('/perusahaan/isi_perusahaan_data','isi_perusahaan_data')->name('perusahaan.data')->middleware('perusahaan');
    Route::post('/perusahaan/isi_perusahaan_data','simpan_perusahaan_data');
    
    Route::get('/perusahaan/isi_perusahaan_alamat','isi_perusahaan_alamat')->name('perusahaan.alamat')->middleware('perusahaan');
    Route::post('/perusahaan/isi_perusahaan_alamat','simpan_perusahaan_alamat');
    
    Route::get('/perusahaan/isi_perusahaan_operator','isi_perusahaan_operator')->name('perusahaan.operator')->middleware('perusahaan');
    Route::post('/perusahaan/isi_perusahaan_operator','simpan_perusahaan_operator');
    
    Route::get('/perusahaan/lihat/perusahaan','profil')->middleware('perusahaan');    
    Route::get('/contact_us_perusahaan','contactUsPerusahaan')->middleware('perusahaan');
    
    Route::get('/perusahaan/list/lowongan','lowonganPekerjaan')->middleware('perusahaan');
    Route::get('/perusahaan/buat_lowongan','tambahLowongan')->middleware('perusahaan');
    Route::post('/perusahaan/buat_lowongan','simpanLowongan');
    Route::get('/perusahaan/lihat_lowongan/{id}','lihatLowongan')->middleware('perusahaan');
    Route::get('/perusahaan/edit_lowongan/{id}','editLowongan')->middleware('perusahaan');
    Route::post('/perusahaan/edit_lowongan/{id}','updateLowongan');
    Route::get('/perusahaan/hapus_lowongan/{id}','hapusLowongan')->middleware('perusahaan');
    Route::get('/perusahaan/list_permohonan_lowongan','listPermohonanLowongan');
    Route::get('/perusahaan/permohonan_lowongan_pekerjaan/{id}','permohonanLowonganPekerjaan');
    Route::post('/perusahaan/permohonan_lowongan_pekerjaan/{id}','confirmLowonganPekerjaan');

    Route::get('/perusahaan/list/pmi_id','listPmiID')->middleware('perusahaan');
    Route::get('/perusahaan/pembuatan_pmi_id','pembuatanPmiID')->middleware('perusahaan');
    Route::post('/perusahaan/pembuatan_pmi_id','selectKandidatID')->middleware('perusahaan');
    Route::post('/perusahaan/simpan_pembuatan_pmi_id','simpanPembuatanPmiID')->middleware('perusahaan');
    Route::get('/perusahaan/lihat_pmi_id/{id}','lihatPmiID')->middleware('perusahaan');
    Route::get('/perusahaan/cetak_pmi_id/{id}','cetakPmiID')->middleware('perusahaan');
    Route::get('/perusahaan/edit_pmi_id/{id}','editPmiID')->middleware('perusahaan');
    Route::post('/perusahaan/edit_pmi_id/{id}','updatePmiID')->middleware('perusahaan');
    Route::get('/perusahaan/hapus_pmi_id/{id}','hapusPmiID')->middleware('perusahaan');

    Route::get('/perusahaan/list/pembayaran','pembayaran')->middleware('perusahaan');
    Route::get('/perusahaan/payment/{id}','payment')->middleware('perusahaan');
    Route::post('/perusahaan/payment/{id}','paymentCheck');

    // DATA KANDIDAT //
    Route::get('/perusahaan/list/kandidat','kandidat')->middleware('perusahaan');
    Route::post('/perusahaan/list/kandidat','cariKandidat');
    Route::post('/perusahaan/pilih/kandidat','pilihKandidat');
    Route::get('/perusahaan/lihat/kandidat/{id}','lihatProfilKandidat')->middleware('perusahaan');
    Route::get('/perusahaan/lihat/video_kandidat/{id}','lihatVideoKandidat')->middleware('perusahaan');
    Route::get('/perusahaan/interview','JadwalInterview')->middleware('perusahaan');
    Route::get('/perusahaan/jadwal_interview','tentukanJadwal')->middleware('perusahaan');
    Route::post('/perusahaan/jadwal_interview','simpanJadwal');

    //  DATA AKADEMI //
    Route::get('/perusahaan/list/akademi','akademi')->middleware('perusahaan');
    Route::post('/perusahaan/cari_akademi','cariAkademi');
    Route::get('/perusahaan/lihat/akademi/{id}','lihatProfilAkademi')->middleware('perusahaan');
    // Route::post('/perusahaan/cari_kandidat','temukanKandidat');
    Route::get('/perusahaan/cari_kandidat/experience','cariKandidatExperience')->middleware('perusahaan');
    Route::post('/perusahaan/cari_kandidat/experience','temukanKandidatExperience');
        
    Route::post('/perusahaan/interview','TambahJadwal');
    Route::get('/perusahaan/hapus/kandidat/interview/{id}','deleteKandidatInterview');
});

// DATA KANDIDAT //
Route::controller(KandidatController::class)->group(function() {
    Route::get('/kandidat','index')->middleware('kandidat')->name('kandidat');
    Route::get('/profil_kandidat','profil')->middleware('kandidat');
    Route::get('/edit_profil','edit')->name('edit_profil')->middleware('kandidat');
    Route::get('/lihat_video_pengalaman_kerja/{id}', 'lihatVideo')->middleware('kandidat');
    Route::get('/contact_us_kandidat','contactUsKandidat')->middleware('kandidat');

    Route::get('/isi_kandidat_personal', 'isi_kandidat_personal')->middleware('kandidat')->name('personal');
    Route::post('/isi_kandidat_personal', 'simpan_kandidat_personal');
    
    Route::get('/isi_kandidat_document', 'isi_kandidat_document')->middleware('kandidat')->name('document');
    Route::post('/isi_kandidat_document', 'simpan_kandidat_document');

    Route::get('/isi_kandidat_vaksin', 'isi_kandidat_vaksin')->middleware('kandidat')->name('vaksin');
    Route::post('/isi_kandidat_vaksin', 'simpan_kandidat_vaksin');

    Route::get('/isi_kandidat_parent', 'isi_kandidat_parent')->middleware('kandidat')->name('parent');
    Route::post('/isi_kandidat_parent', 'simpan_kandidat_parent');

    Route::get('/isi_kandidat_family', 'isi_kandidat_family')->middleware('kandidat')->name('family');
    Route::post('/isi_kandidat_family', 'simpan_kandidat_family');

    Route::get('/isi_kandidat_company', 'isi_kandidat_company')->middleware('kandidat')->name('company');
    Route::post('/isi_kandidat_company', 'simpan_kandidat_company');
    Route::get('/tambah_kandidat_pengalaman_kerja', 'tambahPengalamanKerja')->middleware('kandidat');
    Route::post('/simpan_kandidat_pengalaman_kerja', 'simpanPengalamanKerja');
    Route::get('/edit_kandidat_pengalaman_kerja/{id}','editPengalamanKerja')->middleware('kandidat');
    Route::post('/update_kandidat_pengalaman_kerja/{id}','updatePengalamanKerja');
    Route::get('/hapus_kandidat_pengalaman_kerja/{id}','hapusPengalamanKerja');

    Route::get('/isi_kandidat_permission', 'isi_kandidat_permission')->middleware('kandidat')->name('permission');
    Route::post('/isi_kandidat_permission', 'simpan_kandidat_permission');

    Route::get('/isi_kandidat_paspor', 'isi_kandidat_paspor')->middleware('kandidat')->name('paspor');
    Route::post('/isi_kandidat_paspor', 'simpan_kandidat_paspor');    

    Route::get('/isi_kandidat_placement', 'isi_kandidat_placement')->middleware('kandidat')->name('placement');
    Route::get('/penempatan', 'placement');
    Route::get('/deskripsi','deskripsiNegara');
    Route::post('/isi_kandidat_placement', 'simpan_kandidat_placement');

    Route::get('/isi_kandidat_job', 'isi_kandidat_job')->middleware('kandidat')->name('job');
    Route::post('/isi_kandidat_job', 'simpan_kandidat_job');

    Route::post('/info_connect/{nama}/{id}','simpanInfoConnect');

    // Route::get('/contact_us','contactUsKandidat');
    // Route::post('/contact_us','sendContactUsKandidat');
    // DATA PERUSAHAAN //
});

Route::controller(KandidatPerusahaanController::class)->group(function() {
    Route::get('/list_informasi_perusahaan','listPerusahaan')->middleware('kandidat');
    Route::post('/list_informasi_perusahaan','cari_perusahaan');
    Route::get('/profil_perusahaan/{id}','perusahaan')->middleware('kandidat');
    
    Route::get('/list_lowongan_pekerjaan','listLowonganPekerjaan')->middleware('kandidat');
    Route::get('/lihat_lowongan_pekerjaan/{id}','lowonganPekerjaan')->middleware('kandidat'); 
    Route::get('/permohonan_lowongan/{id}','permohonanLowongan')->middleware('kandidat');
    Route::post('/permohonan_lowongan/{id}','kirimPermohonan');
});

// data akun prioritas
Route::controller(PrioritasController::class)->group(function(){
    Route::get('/info_prioritas','prioritas_info')->middleware('prioritas');
    Route::get('/kandidat/prioritas','prioritas')->middleware('prioritas')->name('prioritas');
    Route::get('/pelatihan_interview','interview')->middleware('prioritas');
});


// data notifikasi
Route::controller(NotifikasiController::class)->group(function() {
    Route::get('/semua_notif','notifyKandidat')->middleware('kandidat');
    Route::get('/akademi/semua_notif','notifyAkademi')->middleware('akademi');
    Route::get('/perusahaan/semua_notif','notifyPerusahaan')->middleware('perusahaan');
});

// data login
Route::controller(LoginController::class)->group(function() {
    Route::get('/login','loginSemua')->middleware('guest');
    Route::post('/login','AuthenticateLogin');
    Route::get('/login/kandidat','loginKandidat')->middleware('guest');
    Route::get('/login/akademi','loginAkademi')->middleware('guest');
    Route::get('/login/perusahaan','loginPerusahaan')->middleware('guest');
    Route::post('/login/kandidat','AuthenticateKandidat');
    Route::post('/login/akademi','AuthenticateAkademi');
    Route::post('/login/perusahaan','AuthenticatePerusahaan');
    Route::get('/logout','logout')->name('logout');
});

// data registrasi
Route::controller(RegisterController::class)->group(function() {
    Route::post('/register/kandidat', 'kandidat');
    
    // Route::get('/kandidat_umur/{nama}','umurKandidat')->middleware('guest');
    Route::post('/kandidat_umur/{nama}','syaratUmur');
    Route::post('/register/akademi', 'akademi');
    Route::post('/register/perusahaan', 'perusahaan');
});

// data output
Route::controller(OutputController::class)->group(function() {
    Route::get('/output', 'index')->middleware('kandidat')->name('output');
    Route::get('/output_izin_waris', 'izinWaris')->middleware('kandidat');
    Route::get('/cetak/{id}', 'cetak')->middleware('manager')->name('cetak');
});

// data verifikasi
Route::controller(VerifikasiController::class)->group(function(){
    Route::get('/verifikasi','verifikasi')->name('verifikasi');
    Route::post('/verifikasi','masukVerifikasi');
    Route::get('/ulang_verifikasi','ulang_verifikasi');

    Route::get('/verify_account/{token}','verifyAccount')->name('users_verification');
});

Route::controller(NegaraController::class)->group(function() {
    Route::get('/manager/negara_tujuan','index')->middleware('manager')->name('negara');
    Route::get('/manager/lihat_negara/{id}','lihatNegara')->middleware('manager');
    Route::get('/manager/tambah_negara','tambahNegara')->middleware('manager');
    Route::post('/manager/tambah_negara','simpanNegara');
    Route::get('/manager/edit_negara/{id}','editNegara')->middleware('manager');
    Route::post('/manager/edit_negara/{id}','ubahNegara');
    Route::get('/manager/hapus_negara/{id}','hapusNegara')->middleware('manager');
});

// data pekerjaan
Route::controller(PekerjaanController::class)->group(function() {
    Route::get('/manager/pekerjaan','index')->middleware('manager');
    Route::post('/manager/pekerjaan','pencarian');
    Route::get('/manager/tambah_pekerjaan', 'create')->middleware('manager');
    Route::post('/manager/tambah_pekerjaan', 'store');
    Route::get('/manager/edit_pekerjaan/{id}', 'edit')->middleware('manager');
    Route::post('/manager/edit_pekerjaan/{id}', 'update');
    Route::get('/manager/hapus_pekerjaan/{id}', 'delete')->middleware('manager');
});

// data pembayaran
Route::controller(PaymentController::class)->group(function(){
    // USER KANDIDAT //
    Route::get('/payment','paymentKandidat')->middleware('kandidat');
    Route::post('/payment', 'paymentKandidatCheck')->middleware('kandidat');

    // USER AKADEMI //
    
    // USER PERUSAHAAN //

    // USER MANAGER //
    

});

Route::controller(GoogleController::class)->group(function(){
    Route::get('/auth/google', 'redirectToGoogle')->name('google.login');
    Route::get('/auth/google/callback', 'handleGoogleCallback')->name('google.callback');
});

Route::controller(MessagerController::class)->group(function() {
    // DATA KANDIDAT //
    Route::get('/semua_pesan','messageKandidat')->middleware('kandidat')->name('semuaPesan');
    Route::get('/kirim_balik/{id}','sendMessageKandidat')->middleware('kandidat');
    Route::post('/kirim_balik/{id}','sendMessageConfirmKandidat');

    // DATA AKADEMI //
    Route::get('/akademi/semua_pesan','messageAkademi')->middleware('akademi')->name('akademi.semuaPesan');
    Route::get('/akademi/kirim_balik/{id}','sendMessageAkademi')->middleware('akademi');
    Route::post('/akademi/kirim_balik/{id}','sendMessageConfirmAkademi');

    // DATA PERUSAHAAN //
    Route::get('/perusahaan/semua_pesan','messagePerusahaan')->middleware('perusahaan')->name('perusahaan.semuaPesan');
    Route::get('/perusahaan/kirim_balik/{id}','sendMessagePerusahaan')->middleware('perusahaan');
    Route::post('/perusahaan/kirim_balik/{id}','sendMessageConfirmPerusahaan');

    // DATA MANAGER //
});

Route::post('/kirim_email', [MailController::class, 'index']);
Route::get('/user_referral', [ReferralController::class, 'user_referral'])->middleware('verify')->name('user_referral');

// user routes
Route::middleware(['auth', 'user-access:0'])->group(function () {
    Route::get('/isi_data_diri', [HomeController::class, 'index'])->name('isi_data_diri');
});

// admin routes
Route::middleware(['auth', 'user-access:1'])->group(function () {
    Route::get('/admin_home', [HomeController::class, 'adminHome'])->name('admin_home');
});

// // manager routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/tulis_pesan', [HomeController::class, 'tulis_pesan']);
});

Route::get('/', [HomeController::class, 'managerHome'])->name('manager_home');


Route::get('webcam', [CaptureController::class, 'index']);
Route::post('webcam', [CaptureController::class, 'store'])->name('webcam.capture');

Route::controller(PrototypeController::class)->group(function(){
    Route::get('/prototype','test')->name('prototype');
    Route::get('/select1','select');
    Route::post('/prototype','cek');
    Route::get('/proto_create','create');
    Route::get('/proto_store','store');
    Route::get('/proto_edit','edit');
    Route::get('/proto_update','update');
    Route::get('/proto_delete','delete');

    Route::post('/proto_mail','email');

});

Route::get('/linewire',Location::class)->middleware('verify');
Route::get('/linewire_permission',LocationPermission::class)->middleware('verify');

Route::view('/perbaikan','dalam_proses');
Route::view('/mail', 'mail/mail');