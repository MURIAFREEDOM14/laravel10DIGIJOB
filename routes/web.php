<?php

// use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Akademi\AkademiController;
use App\Http\Controllers\Akademi\AkademiKandidatController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\Manager\Kandidat\ManagerKandidatController;
use App\Http\Controllers\Manager\ContactUsController;
use App\Http\Controllers\Manager\NegaraController;
use App\Http\Controllers\Kandidat\KandidatPerusahaanController;
use App\Http\Controllers\Kandidat\KandidatController;
use App\Http\Controllers\Kandidat\FileUploadController;
use App\Http\Controllers\Perusahaan\PerusahaanController;
use App\Http\Controllers\Perusahaan\PerusahaanRecruitmentController;
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
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MessagerController;
use PHPUnit\TextUI\Configuration\Group;
use App\Http\Controllers\CaptchaController;
use App\Models\User;

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

// DATA MANAGER //
Route::controller(ManagerController::class)->group(function() {
    Route::get('/manager_access', 'login')->name('manager_access')->middleware('guest');
    Route::post('/manager_access', 'authenticate');
    Route::get('/manager', 'index')->middleware('manager')->name('manager');
    Route::get('/manager/surat_izin','suratIzin')->middleware('manager');
    Route::get('/manager/buat_surat_izin','buatSuratIzin')->middleware('manager');
    Route::post('/manager/buat_surat_izin','simpanSuratIzin');
    
    Route::get('/manager/kandidat/cetak_surat/{id}','cetakSurat')->middleware('manager');
    Route::get('/manager/kandidat/surat_izin_waris','cetakSuratKosong');

    Route::get('/manager/search_email','searchEmail')->middleware('manager');
    Route::get('/manager/email_verify/{id}','emailVerify')->middleware('manager');
    Route::post('/manager/email_verify/{id}','sendEmailVerify');
    
    // DATA KANDIDAT // 
    Route::get('/manager/kandidat/lihat_profil/{id}','lihatProfil')->middleware('manager');
    Route::get('/manager/kandidat/galeri_kandidat/{id}','galeriKandidat')->middleware('manager');
    Route::get('/manager/kandidat/lihat_galeri_kandidat/{id}/{type}','lihatGaleriKandidat')->middleware('manager');

    Route::get('/manager/kandidat/pelatihan','pelatihan')->middleware('manager');
    Route::post('/manager/kandidat/tambah_tema_pelatihan','simpanTemaPelatihan');
    Route::get('/manager/kandidat/lihat_video_pelatihan/{id}','lihatVideoPelatihan')->middleware('manager');
    Route::get('/manager/kandidat/edit_tema_pelatihan/{id}','editTemaPelatihan')->middleware('manager');
    Route::post('/manager/kandidat/edit_tema_pelatihan/{id}','updateTemaPelatihan');
    Route::get('/manager/kandidat/hapus_tema_pelatihan/{id}','hapusTemaPelatihan')->middleware('manager');
    Route::get('/manager/kandidat/tambah_video_pelatihan/{tema}/{id}','tambahVideoPelatihan')->middleware('manager');
    Route::post('/manager/kandidat/tambah_video_pelatihan/{tema}/{id}','simpanVideoPelatihan');
    Route::get('/manager/kandidat/edit_video_pelatihan/{tema}/{id}','editVideoPelatihan')->middleware('manager');
    Route::post('/manager/kandidat/edit_video_pelatihan/{tema}/{id}','updateVideoPelatihan');
    Route::get('/manager/kandidat/hapus_video_pelatihan/{temaid}/{id}','hapusVideoPelatihan')->middleware('manager');

    Route::get('/manager/pembayaran/kandidat','pembayaranKandidat')->middleware('manager');
    Route::get('/manager/cek_pembayaran/kandidat/{id}','cekPembayaranKandidat')->middleware('manager');
    Route::post('/manager/cek_pembayaran/kandidat/{id}','cekConfirmKandidat');

    Route::get('/manager/permohonan_staff','permohonanStaff');
    Route::get('/manager/lihat/permohonan_staff/{id}','lihatPermohonanStaff');
    Route::post('/manager/lihat/permohonan_staff/{id}','simpanPermohonanStaff');

    Route::get('/manager/pilih/permohonan_staff','pilihPermohonanStaff');
    Route::post('/manager/pilih/permohonan_staff','kirimPermohonanStaff');

    // DATA AKADEMI //
    Route::get('/manager/akademi/list_akademi','akademi')->middleware('manager');
    Route::get('/manager/akademi/lihat_profil/{id}','lihatProfilAkademi')->middleware('manager');

    // DATA PERUSAHAAN //
    Route::get('/manager/perusahaan/list_perusahaan','perusahaan')->middleware('manager');
    Route::get('/manager/perusahaan/lihat_profil/{id}','lihatProfilPerusahaan')->middleware('manager');
    Route::get('/manager/perusahaan/lihat_lowongan/{id}','lihatLowonganPekerjaan')->middleware('manager');
    Route::get('/manager/perusahaan/pembuatan_id_pmi','IDPMI');
    Route::post('/manager/perusahaan/pembuatan_id_pmi','buatIDPMI');
    Route::post('/manager/perusahaan/simpan_id_pmi','simpanIDPMI');
    Route::get('/manager/perusahaan/lihat_pmi_id/{id}','lihatIDPMI');
    Route::get('/manager/perusahaan/cetak_pmi_id/{id}','cetakIDPMI');
    Route::get('/manager/pembayaran/perusahaan','pembayaranPerusahaan')->middleware('manager');
    Route::get('/manager/cek_pembayaran/perusahaan/{id}','cekPembayaranPerusahaan')->middleware('manager');
    Route::post('/manager/cek_pembayaran/perusahaan/{id}','cekConfirmPerusahaan');

});

Route::controller(ManagerKandidatController::class)->group(function() {
    Route::get('/manager/kandidat/kandidat_baru','kandidatBaru')->middleware('manager');
    Route::get('/manager/kandidat/dalam_negeri','dalamNegeri')->middleware('manager');
    Route::get('/manager/kandidat/luar_negeri','luarNegeri')->middleware('manager');

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

    Route::get('/manager/kandidat/pelamar_lowongan','pelamarLowongan');
    Route::get('/manager/kandidat/lihat_lowongan_pelamar/{id}','lihatPelamarLowongan');

    Route::get('/manager/kandidat/penolakan_kandidat','penolakanKandidat');
    Route::get('/manager/kandidat/lihat/penolakan_kandidat/{id}','lihatPenolakanKandidat');

    Route::get('/manager/kandidat/penghapusan_kandidat','penghapusanKandidat')->middleware('manager');
    Route::get('/manager/kandidat/confirm_penghapusan/{id}','confirmPenghapusanKandidat');

    Route::get('/manager/kandidat/laporan_kandidat','laporanKandidat')->middleware('manager');
    Route::get('/manager/kandidat/lihat_laporan_kandidat/{id}','lihatLaporanKandidat')->middleware('manager');

    Route::get('/manager/kandidat/lihat_video/{id}','lihatVideoKandidat');
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

    Route::get('/manager/verification_kandidat','verifyKandidatList')->middleware('contact.service');
    Route::get('/manager/lihat/verifikasi_kandidat/{id}','lihatVerifyKandidat')->middleware('contact.service');
    Route::post('/manager/lihat/verifikasi_kandidat/{id}','confirmVerifyKandidat');
});

// DATA LAMAN //
Route::controller(LamanController::class)->group(function() {
    Route::get('/', 'index')->name('laman')->middleware('guest');    
    
    Route::get('/login','loginSemua')->middleware('guest');
    Route::get('/login/kandidat', 'login_kandidat')->middleware('guest');
    Route::get('/login/akademi', 'login_akademi')->middleware('guest');
    Route::get('/login/perusahaan', 'login_perusahaan')->middleware('guest');

    Route::view('/register','auth/register_semua')->middleware('guest');
    Route::view('/register/kandidat','auth/register_kandidat')->name('register_kandidat')->middleware('guest');
    Route::view('/register/akademi','auth/register_akademi')->name('register_akademi')->middleware('guest');
    Route::view('/register/perusahaan','auth/register_perusahaan')->name('register_perusahaan')->middleware('guest');

    Route::view('/syarat_ketentuan/kandidat','laman/persyaratan_kandidat')->middleware('guest');
    Route::view('/syarat_ketentuan/akademi','laman/persyaratan_akademi')->middleware('guest');
    Route::view('/syarat_ketentuan/perusahaan','laman/persyaratan_perusahaan')->middleware('guest');

    Route::get('/login_gmail',  'login_gmail')->name('login_gmail')->middleware('guest');
    Route::get('/login_referral',  'login_referral')->middleware('guest');
    Route::get('/login_info',  'login_info')->middleware('guest');
    Route::post('/login_info',  'info');

    Route::view('/digijob_system','digijob_system')->middleware('guest');
    Route::view('/benefits','benefits')->middleware('guest');
    Route::view('/features','features')->middleware('guest');
    Route::view('/hubungi_kami','contact_us')->middleware('guest');
    Route::view('/about_us','about_us')->middleware('guest');
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
    Route::get('/perusahaan/ganti/cabang_perusahaan/{id}','gantiPerusahaan')->middleware('perusahaan');

    Route::get('/perusahaan/isi_perusahaan_data','isi_perusahaan_data')->name('perusahaan.data')->middleware('perusahaan');
    Route::post('/perusahaan/isi_perusahaan_data','simpan_perusahaan_data');
    
    Route::get('/perusahaan/isi_perusahaan_alamat','isi_perusahaan_alamat')->name('perusahaan.alamat')->middleware('perusahaan');
    Route::post('/perusahaan/isi_perusahaan_alamat','simpan_perusahaan_alamat');
    
    Route::get('/perusahaan/isi_perusahaan_operator','isi_perusahaan_operator')->name('perusahaan.operator')->middleware('perusahaan');
    Route::post('/perusahaan/isi_perusahaan_operator','simpan_perusahaan_operator');

    Route::get('/perusahaan/tambah/cabang_data','tambahCabangData')->name('cabang.data');
    Route::post('/perusahaan/tambah/cabang_data','simpanCabangData');
    
    Route::get('/perusahaan/tambah/cabang_alamat','tambahCabangAlamat')->name('cabang.alamat');
    Route::post('/perusahaan/tambah/cabang_alamat','simpanCabangAlamat');
    
    Route::get('/perusahaan/tambah/cabang_operator','tambahCabangOperator')->name('cabang.operator');
    Route::post('/perusahaan/tambah/cabang_operator','simpanCabangOperator');

    Route::get('/perusahaan/lihat/perusahaan','profil')->middleware('perusahaan');    
    Route::get('/contact_us_perusahaan','contactUsPerusahaan')->middleware('perusahaan');

    Route::get('/perusahaan/list/pmi_id','listPmiID')->middleware('perusahaan');
    Route::get('/perusahaan/pembuatan_pmi_id','pembuatanPmiID')->middleware('perusahaan');
    Route::post('/perusahaan/pembuatan_pmi_id','selectKandidatID')->middleware('perusahaan');
    Route::post('/perusahaan/simpan_pembuatan_pmi_id','simpanPembuatanPmiID')->middleware('perusahaan');
    Route::get('/perusahaan/lihat_pmi_id/{id}','lihatPmiID')->middleware('perusahaan');
    Route::get('/perusahaan/edit_pmi_id/{id}','editPmiID')->middleware('perusahaan');
    Route::post('/perusahaan/edit_pmi_id/{id}','updatePmiID')->middleware('perusahaan');
    Route::get('/perusahaan/hapus_pmi_id/{id}','hapusPmiID')->middleware('perusahaan');

    Route::get('/perusahaan/list/pembayaran','pembayaran')->middleware('perusahaan');
    Route::get('/perusahaan/payment/{id}','payment')->middleware('perusahaan');
    Route::post('/perusahaan/payment/{id}','paymentCheck');

    // DATA KANDIDAT //
    Route::get('/perusahaan/list/kandidat','kandidat')->middleware('perusahaan');
    // Route::post('/perusahaan/list/kandidat','cariKandidat');
    Route::get('/perusahaan/cari/kandidat','pencarianKandidat')->middleware('perusahaan');
    Route::post('/perusahaan/cari/kandidat','cariKandidat');
    Route::post('/perusahaan/pilih/kandidat','pilihKandidat');
    Route::get('/perusahaan/lihat/kandidat/{id}','lihatProfilKandidat')->middleware('perusahaan');
    Route::get('/perusahaan/galeri_kandidat/{id}','galeriKandidat')->middleware('perusahaan');
    Route::get('/perusahaan/lihat/galeri_kandidat/{id}/{type}','lihatGaleriKandidat')->middleware('perusahaan');
    Route::get('/perusahaan/interview','JadwalInterview')->middleware('perusahaan');
    Route::get('/perusahaan/jadwal_interview','tentukanJadwal')->middleware('perusahaan');
    Route::post('/perusahaan/jadwal_interview','simpanJadwal');
    Route::get('/perusahaan/edit/kandidat/interview/{id}','editJadwalInterview');
    Route::post('/perusahaan/edit/kandidat/interview/{id}','ubahJadwalInterview');
    Route::get('/perusahaan/hapus/kandidat/interview/{id}','deleteJadwalInterview');

    //  DATA AKADEMI //
    Route::get('/perusahaan/list/akademi','akademi')->middleware('perusahaan');
    Route::post('/perusahaan/cari_akademi','cariAkademi');
    Route::get('/perusahaan/lihat/akademi/{id}','lihatProfilAkademi')->middleware('perusahaan');
    // Route::post('/perusahaan/cari_kandidat','temukanKandidat');
    Route::get('/perusahaan/cari_kandidat/experience','cariKandidatExperience')->middleware('perusahaan');
    Route::post('/perusahaan/cari_kandidat/experience','temukanKandidatExperience');
        
    // Route::post('/perusahaan/interview','TambahJadwal');
});

Route::controller(PerusahaanRecruitmentController::class)->group(function() {
    Route::get('/perusahaan/negara_tujuan','negaraTujuan')->name('perusahaan.negara')->middleware('perusahaan');
    Route::get('/perusahaan/tambah/negara','tambahNegaraTujuan');
    Route::post('/perusahaan/tambah/negara','simpanNegaraTujuan');
    
    Route::get('/perusahaan/pekerjaan/{id}/{nama}','lihatPerusahaanJob')->name('perusahaan.pekerjaan')->middleware('perusahaan');
    Route::get('/perusahaan/tambah/pekerjaan/{id}/{nama}','tambahPerusahaanJob');
    Route::post('/perusahaan/tambah/pekerjaan/{id}/{nama}','simpanPerusahaanJob');
    Route::get('/perusahaan/edit/pekerjaan/{kerjaid}/{id}','editPerusahaanJob');
    Route::post('/perusahaan/edit/pekerjaan/{kerjaid}/{id}','ubahPerusahaanJob');
    Route::get('/perusahaan/hapus/pekerjaan/{kerjaid}','hapusPerusahaanJob');

    Route::get('/perusahaan/cari_kandidat_staff','cariKandidatStaff');
    Route::post('/perusahaan/cari_kandidat_staff','pencarianKandidatStaff');

    Route::get('/perusahaan/list/lowongan','lowonganPekerjaan')->middleware('perusahaan');
    Route::get('/perusahaan/buat_lowongan','tambahLowongan')->middleware('perusahaan');
    Route::get('/lowongan_negara','lowonganNegara');
    Route::post('/perusahaan/buat_lowongan','simpanLowongan');
    Route::get('/perusahaan/lihat_lowongan/{id}','lihatLowongan')->middleware('perusahaan');
    Route::get('/perusahaan/edit_lowongan/{id}','editLowongan')->middleware('perusahaan');
    Route::post('/perusahaan/edit_lowongan/{id}','updateLowongan');
    Route::get('/perusahaan/hapus_lowongan/{id}','hapusLowongan')->middleware('perusahaan');

    Route::get('/perusahaan/list_permohonan_lowongan','listPermohonanLowongan')->middleware('perusahaan');
    Route::get('/perusahaan/lihat_permohonan_lowongan/{id}','lihatPermohonanLowongan')->middleware('perusahaan');
    Route::post('/perusahaan/lihat_permohonan_lowongan/{id}','confirmPermohonanLowongan');
    Route::get('/perusahaan/permohonan_lowongan_pekerjaan/{id}','permohonanLowonganPekerjaan')->middleware('perusahaan');
    Route::post('/perusahaan/permohonan_lowongan_pekerjaan/{id}','confirmLowonganPekerjaan');    
    Route::get('/perusahaan/persetujuan_kandidat','persetujuanKandidat')->middleware('perusahaan');
    Route::post('/perusahaan/persetujuan_kandidat','confirmPersetujuanKandidat');

});

// DATA KANDIDAT //
Route::controller(KandidatController::class)->group(function() {
    Route::get('/kandidat','index')->middleware('kandidat')->name('kandidat');
    Route::get('/profil_kandidat','profil')->middleware('kandidat');
    Route::get('/edit_profil','edit')->name('edit_profil')->middleware('kandidat');
    Route::get('/galeri_pengalaman_kerja/{id}', 'Galeri')->middleware('kandidat');
    Route::get('/lihat_galeri_pengalaman_kerja/{id}/{type}','lihatGaleri')->middleware('kandidat');
    Route::get('/contact_us_kandidat','contactUsKandidat')->middleware('kandidat');

    Route::get('/isi_kandidat_personal', 'isi_kandidat_personal')->middleware('kandidat')->name('personal');
    Route::post('/isi_kandidat_personal', 'simpan_kandidat_personal');
    Route::view('/edit_kandidat_no_telp','kandidat/modalKandidat/edit_no_telp');
    Route::post('/edit_kandidat_no_telp','ubah_kandidat_noTelp');
    Route::post('/confirm_otp_code','confirmOTP');
    Route::post('/confirm_kandidat_otp_telp','confirm_kandidat_OTP_Telp');

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
    Route::get('/lihat_kandidat_pengalaman_kerja/{id}','lihatPengalamanKerja')->middleware('kandidat');
    
    Route::get('/tambah_portofolio_pengalaman_kerja/{id}/{type}','tambahPortofolio')->middleware('kandidat');
    Route::post('/tambah_portofolio_pengalaman_kerja/{id}/{type}','simpanPortofolio');
    Route::get('/edit_portofolio_pengalaman_kerja/{id}/{type}','editPortofolio')->middleware('kandidat');
    Route::post('/edit_portofolio_pengalaman_kerja/{id}/{type}','ubahPortofolio');
    Route::get('/hapus_portofolio_pengalaman_kerja/{id}/{type}','hapusPortofolio');

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

    Route::get('/video_pelatihan','videoPelatihan')->middleware('kandidat');
    Route::get('/lihat_video_pelatihan/{id}','lihatVideoPelatihan')->middleware('kandidat');
    // Route::get('/contact_us','contactUsKandidat');
    // Route::post('/contact_us','sendContactUsKandidat');
    // DATA PERUSAHAAN //
});

Route::controller(KandidatPerusahaanController::class)->group(function() {
    // Route::get('/list_informasi_perusahaan','listPerusahaan')->middleware('kandidat');
    // Route::post('/list_informasi_perusahaan','cari_perusahaan');
    Route::get('/profil_perusahaan/{id}','perusahaan')->middleware('kandidat');
    
    Route::get('/lihat/perusahaan/pekerjaan/{negaraid}/{nama}','lihatPekerjaanPerusahaan');
    Route::get('/detail_pekerjaan_perusahaan/{kerjaid}/{nama}','detailPekerjaanPerusahaan');
    Route::post('/detail_pekerjaan_perusahaan/{kerjaid}/{nama}','terimaPekerjaanPerusahaan');
    
    Route::get('/lihat_lowongan_pekerjaan/{id}','lowonganPekerjaan')->middleware('kandidat'); 
    Route::get('/permohonan_lowongan/{id}','permohonanLowongan')->middleware('kandidat');
    Route::post('/permohonan_lowongan/{id}','kirimPermohonan');
    Route::get('/keluar_perusahaan/{id}','keluarPerusahaan')->middleware('kandidat');
    Route::post('/persetujuan_kandidat/{nama}/{id}','persetujuanKandidat');
});

// data akun prioritas
Route::controller(PrioritasController::class)->group(function(){
    Route::get('/info_prioritas','prioritas_info')->middleware('prioritas');
    Route::get('/kandidat/prioritas','prioritas')->middleware('prioritas')->name('prioritas');
    Route::get('/pelatihan_interview','interview')->middleware('prioritas');
});

Route::get('/download_file',[FileUploadController::class,'downloadFile']);
Route::get('/send_email_kandidat',[FileUploadController::class, 'sendEmailFile']);

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
    
    Route::get('/forgot_password/kandidat','forgotPasswordKandidat')->middleware('guest');
    Route::post('/forgot_password/kandidat','confirmAccountKandidat');
    Route::get('/forgot_password/akademi','forgotPasswordAkademi')->middleware('guest');
    Route::post('/forgot_password/akademi','confirmAccountAkademi');
    Route::get('/forgot_password/perusahaan','forgotPasswordPerusahaan')->middleware('guest');
    Route::post('/forgot_password/perusahaan','confirmAccountPerusahaan');

    Route::get('/login/migration','loginMigration')->middleware('guest');
    Route::post('/login/migration','checkLoginMigration');
    Route::get('/login/migration/confirm', 'tambahLoginMigration');
    Route::post('/login/migration/confirm', 'confirmLoginMigration');
    
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
    Route::get('/output', 'index')->name('output');
    Route::get('/output_izin_waris', 'izinWaris')->middleware('kandidat');
    Route::get('/surat_izin_waris', 'suratIzinWaris');
    Route::get('/cetak/{id}', 'cetak')->name('cetak');
    Route::get('/perusahaan/cetak_pmi_id/{id}','cetakPmiID')->middleware('perusahaan');
    Route::get('/manager/perusahaan/cetak_pmi_id/{id}','cetakPmiID')->middleware('manager');
});

// data verifikasi
Route::controller(VerifikasiController::class)->group(function(){
    Route::get('/verifikasi','verifikasi')->name('verifikasi')->middleware('verify');
    Route::post('/verifikasi','masukVerifikasi');
    Route::get('/ulang_verifikasi','ulang_verifikasi')->middleware('verify');
    Route::get('/verify_account/{token}','verifyAccount')->name('users_verification')->middleware('verify');
    Route::get('/identify_account/{token}','identifyAccount')->name('identify_account');
    Route::get('/identify_id','identifyID');
    Route::post('/identify_id','confirmIdentifyID');
    Route::get('/nomor_id','nomorID')->name('nomorID');
    Route::post('/nomor_id','confirmNomorID');
    Route::post('/kirim_verifikasi_diri','confirmVerifikasiDiri');
    Route::post('/new_password','confirmPassword');
    Route::view('/confirm_alternative_id','auth/passwords/confirm_alternative_id');
    Route::post('/kirim_verifikasi_diri','confirmVerifikasiDiri');
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
    Route::post('/payment', 'kandidatConfirm')->middleware('kandidat');

    Route::view('/pembayaran','mail/pembayaran');
    Route::view('check_mail_verify','mail/verify');
    // USER AKADEMI //
    
    // USER PERUSAHAAN //
    Route::view('/transfer','mail/transfer');

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

Route::controller(MailController::class)->group(function() {
    Route::get('send_email','sendEmail');
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

Route::get('/laman', [HomeController::class, 'managerHome'])->name('manager_home')->middleware('guest');

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
    Route::get('/prototype4','delete');
    Route::post('/proto_mail','email');
    Route::view('/prototype3','prototype3');
    
    Route::get('/webcam','takePhoto');
    Route::post('/webcam','store')->name('webcam.capture');

    Route::get('/video/chat', function() {
        $users = User::where('id','<>', Auth::id())->get();
        return view('prototype/webcam',['users'=>$users]);
    });

    Route::post('/video/call-user','callingUser');
    Route::post('/video/accept-call','confirmCalling');

    Route::get('/make_captcha','captcha')->name('make.captcha');

    Route::view('/kirim_sms','prototype/sms');
    Route::post('/kirim_sms','sendSMS');
});

Route::controller(CaptchaController::class)->group(function() {
Route::get('/sliding-puzzle', [CaptchaController::class, 'showSlidingPuzzle']);
Route::post('/sliding-puzzle/verify', [CaptchaController::class, 'verifySlidingPuzzle'])->name('sliding-puzzle.verify');
});

Route::get('/linewire',Location::class)->middleware('verify');
Route::get('/linewire_permission',LocationPermission::class)->middleware('verify');

Route::view('/perbaikan','dalam_proses');
Route::view('/mail', 'mail/mail');