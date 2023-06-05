<?php

// use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\AkademiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\ManagerController;
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
Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();
// Auth::routes(['verify' => true]);

// DATA MANAGER //
Route::controller(ManagerController::class)->group(function() {
    Route::get('/manager_access', 'login')->name('manager_access');
    Route::post('/manager_access', 'authenticate');
    Route::get('/manager', 'index')->middleware('manager')->name('manager');
    
    // DATA KANDIDAT // 
    Route::get('/manager/kandidat/lihat_profil/{id}','lihatProfil');
    Route::get('/manager/kandidat/dalam_negeri','dalam_negeri');
    Route::get('/manager/kandidat/luar_negeri','luar_negeri');
    {
        Route::get('/manager/edit/kandidat/personal/{id}','isi_personal');
        Route::post('/manager/edit/kandidat/personal/{id}','simpan_personal');
        
        Route::get('/manager/edit/kandidat/document/{id}','isi_document');
        Route::post('/manager/edit/kandidat/document/{id}','simpan_document');
        
        Route::get('/manager/edit/kandidat/family/{id}','isi_family');
        Route::post('/manager/edit/kandidat/family/{id}','simpan_family');
        
        Route::get('/manager/edit/kandidat/vaksin/{id}','isi_vaksin');
        Route::post('/manager/edit/kandidat/vaksin/{id}','simpan_vaksin');
        
        Route::get('/manager/edit/kandidat/parent/{id}','isi_parent');
        Route::post('/manager/edit/kandidat/parent/{id}','simpan_parent');
        
        Route::get('/manager/edit/kandidat/company/{id}','isi_company');
        Route::post('/manager/edit/kandidat/company/{id}','simpan_company');
        
        Route::get('/manager/edit/kandidat/permission/{id}','isi_permission');
        Route::post('/manager/edit/kandidat/permission/{id}','simpan_permission');
        
        Route::get('/manager/edit/kandidat/paspor/{id}','isi_paspor');
        Route::post('/manager/edit/kandidat/paspor/{id}','simpan_paspor');
        
        Route::get('/manager/edit/kandidat/placement/{id}','isi_placement');
        Route::post('/manager/edit/kandidat/placement/{id}','simpan_placement');
        
        Route::get('/manager/edit/kandidat/job/{id}','isi_job');
        Route::post('/manager/edit/kandidat/job/{id}','simpan_job');
    }
    Route::get('/manager/pembayaran/kandidat','pembayaranKandidat');
    Route::get('/manager/cek_pembayaran/kandidat/{id}','cekPembayaranKandidat');
    Route::post('/manager/cek_pembayaran/kandidat/{id}','cekConfirmKandidat');
    Route::get('/manager/surat_izin','suratIzin');
    Route::get('/manager/buat_surat_izin','buatSuratIzin');
    Route::post('/manager/buat_surat_izin','simpanSuratIzin');
    Route::get('/manager/kandidat/cetak_surat/{id}','cetakSurat');


    // DATA PERUSAHAAN //
    Route::get('/manager/pembayaran/perusahaan','pembayaranPerusahaan');
    Route::get('/manager/cek_pembayaran/perusahaan/{id}','cekPembayaranPerusahaan');
    Route::post('/manager/cek_pembayaran/perusahaan/{id}','cekConfirmPerusahaan');

    // Route::get('/dibayar/kandidat/{id}','dibayarKandidat');
    // Route::get('/dibayar/perusahaan/{id}','dibayarPerusahaan');
    // Route::get('/riwayat/kandidat','riwayatKandidat');
    // Route::get('/riwayat/perusahaan','riwayatPerusahaan');
    // Route::get('/list_akademi','akademi');
});

// DATA LAMAN //
Route::controller(LamanController::class)->group(function() {
    Route::get('/laman', 'index')->name('laman');    
    
    Route::get('/login/kandidat', 'login_kandidat');
    Route::get('/login/akademi', 'login_akademi');
    Route::get('/login/perusahaan', 'login_perusahaan');

    Route::get('/register/kandidat',  'register_kandidat')->name('register_kandidat');
    Route::get('/register/akademi',  'register_akademi')->name('register_akademi');
    Route::get('/register/perusahaan',  'register_perusahaan')->name('register_perusahaan');

    Route::get('/login_gmail',  'login_gmail')->name('login_gmail');
    Route::get('/login_referral',  'login_referral');
    Route::get('/login_info',  'login_info');
    Route::post('/login_info',  'info');

    Route::get('/contact_us','contact');
    Route::get('/about_us','about');
});

// DATA AKADEMI //
Route::controller(AkademiController::class)->group(function() {
    Route::get('/akademi', 'index')->name('akademi')->middleware(('verify'));

    Route::get('/isi_akademi_data','isi_akademi_data')->middleware('verify');
    Route::post('/isi_akademi_data','simpan_akademi_data');

    Route::get('/isi_akademi_operator','isi_akademi_operator')->middleware('verify');
    Route::post('/isi_akademi_operator','simpan_akademi_operator');

    Route::get('/list_kandidat','listKandidat')->middleware('verify');
});

// DATA PERUSAHAAN //
Route::controller(PerusahaanController::class)->group(function(){
    // DATA PERUSAHAAN //
    Route::get('/perusahaan','index')->name('perusahaan')->middleware('verify');
    Route::get('/perusahaan/isi_perusahaan_data','isi_perusahaan_data')->name('perusahaan.data');
    Route::post('/perusahaan/isi_perusahaan_data','simpan_perusahaan_data');
    Route::get('/perusahaan/isi_perusahaan_alamat','isi_perusahaan_alamat')->name('perusahaan.alamat');
    Route::post('/perusahaan/isi_perusahaan_alamat','simpan_perusahaan_alamat');
    Route::get('/perusahaan/isi_perusahaan_operator','isi_perusahaan_operator')->name('perusahaan.operator');
    Route::post('/perusahaan/isi_perusahaan_operator','simpan_perusahaan_operator');
    Route::get('/perusahaan/lihat/perusahaan','lihatProfilPerusahaan');    

    // DATA KANDIDAT //
    Route::get('/perusahaan/list/kandidat','kandidat');
    Route::post('/perusahaan/list/kandidat','cariKandidat');
    Route::post('/perusahaan/pilih/kandidat','pilihKandidat');
    Route::get('/perusahaan/lihat/kandidat/{id}','lihatProfilKandidat');
    Route::get('/perusahaan/interview','JadwalInterview');
    Route::get('/perusahaan/jadwal_interview','tentukanJadwal');
    Route::post('/perusahaan/jadwal_interview','simpanJadwal');
    Route::get('/perusahaan/payment','payment');
    Route::post('/perusahaan/payment','paymentCheck');

    //  DATA AKADEMI //
    Route::get('/perusahaan/list/akademi','akademi');
    Route::post('/perusahaan/cari_akademi','cariAkademi');
    // Route::post('/perusahaan/cari_kandidat','temukanKandidat');
    Route::get('/perusahaan/cari_kandidat/experience','cariKandidatExperience');
    Route::post('/perusahaan/cari_kandidat/experience','temukanKandidatExperience');
        
    Route::post('/perusahaan/interview','TambahJadwal');
    Route::get('/perusahaan/hapus/kandidat/interview/{id}','deleteKandidatInterview');
});

// DATA KANDIDAT //
Route::controller(KandidatController::class)->group(function() {
    Route::get('/kandidat','index')->middleware('kandidat')->name('kandidat');
    Route::get('/profil_kandidat','profil')->middleware('kandidat');
    Route::get('/edit_profil','edit')->name('edit_profil');

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

    Route::get('/isi_kandidat_permission', 'isi_kandidat_permission')->middleware('kandidat')->name('permission');
    Route::post('/isi_kandidat_permission', 'simpan_kandidat_permission');

    Route::get('/isi_kandidat_paspor', 'isi_kandidat_paspor')->middleware('kandidat')->name('paspor');
    Route::post('/isi_kandidat_paspor', 'simpan_kandidat_paspor');    

    Route::get('/isi_kandidat_placement', 'isi_kandidat_placement')->middleware('kandidat')->name('placement');
    Route::post('/isi_kandidat_placement', 'simpan_kandidat_placement');

    Route::get('/isi_kandidat_job', 'isi_kandidat_job')->middleware('kandidat')->name('job');
    Route::post('/isi_kandidat_job', 'simpan_kandidat_job');

    Route::get('/contact_us','contactUsKandidat');
    Route::post('/contact_us','sendContactUsKandidat');
    // DATA PERUSAHAAN //
    Route::get('/profil_perusahaan/{id}','perusahaan');

});

// data akun prioritas
Route::controller(PrioritasController::class)->group(function(){
    Route::get('/info_prioritas','prioritas_info')->middleware('prioritas');
    Route::get('/kandidat/prioritas','prioritas')->middleware('prioritas')->name('prioritas');
    Route::get('/pelatihan_interview','interview')->middleware('prioritas');
});


// data notifikasi
Route::controller(NotifikasiController::class)->group(function() {
    Route::get('/semua_notif','notifyKandidat')->middleware('verify');
    Route::get('/perusahaan/semua_notif','notifyPerusahaan')->middleware('verify');
});

// data login
Route::controller(LoginController::class)->group(function() {
    Route::get('/login/kandidat','loginKandidat');
    Route::get('/login/akademi','loginAkademi');
    Route::get('/login/perusahaan','loginPerusahaan');
    Route::post('/login/kandidat','AuthenticateKandidat');
    Route::post('/login/akademi','AuthenticateAkademi');
    Route::post('/login/perusahaan','AuthenticatePerusahaan');
    Route::get('/logout','logout')->name('logout');
});

// data registrasi
Route::controller(RegisterController::class)->group(function() {
    Route::post('/register/kandidat', 'kandidat');
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
});

// data pekerjaan
Route::controller(PekerjaanController::class)->group(function() {
    Route::get('/manager/pekerjaan','index')->middleware('verify');
    Route::post('/manager/pekerjaan','pencarian');
    Route::get('/manager/tambah_pekerjaan', 'create')->middleware('verify');
    Route::post('/manager/tambah_pekerjaan', 'store');
    Route::get('/manager/edit_pekerjaan/{id}', 'edit')->middleware('verify');
    Route::post('/manager/edit_pekerjaan/{id}', 'update');
    Route::get('/manager/hapus_pekerjaan/{id}', 'delete')->middleware('verify');
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
    Route::get('/semua_pesan','messageKandidat');
    Route::get('/kirim_balik/{id}','sendMessageKandidat');
    Route::post('/kirim_balik/{id}','sendMessageConfirmKandidat');

    // DATA PERUSAHAAN //
    Route::get('perusahaan/semua_pesan','messagePerusahaan');
    // Route::get('/kirim_pesan_perusahaan','sendMessagePerusahaan');
    // Route::post('/kirim_pesan_perusahaan','sendMessageConfirmPerusahaan');

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
Route::middleware(['auth', 'verified',])->group(function () {
    Route::get('/tulis_pesan', [HomeController::class, 'tulis_pesan']);
    Route::get('/', [HomeController::class, 'managerHome'])->name('manager_home');
});





Route::get('webcam', [CaptureController::class, 'index']);
Route::post('webcam', [CaptureController::class, 'store'])->name('webcam.capture');

Route::controller(PrototypeController::class)->group(function(){
    Route::get('/prototype','tgl');
    Route::post('/prototype','umur');
});

Route::get('/linewire',Location::class)->middleware('verify');
Route::get('/linewire_permission',LocationPermission::class)->middleware('verify');


Route::view('/perbaikan','dalam_proses');
Route::view('/mail', 'mail');