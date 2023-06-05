<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('akademi_kandidat', function (Blueprint $table) {
            $table->id('id_kandidat');

            //personal
            $table->string('nama')->nullable();
            $table->enum('jenis_kelamin',['M','F'])->nullable();
            $table->string('tmp_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('referral_code');
            $table->string('no_telp')->unique()->nullable();
            $table->enum('agama',['islam','kristen','katolik','hindu','buddha','konghucu', 'aliran_kepercayaan'])->nullable();
            $table->bigInteger('nik')->nullable();
            $table->integer('berat')->nullable();
            $table->integer('tinggi')->nullable();
            $table->string('email')->unique()->nullable();
            $table->enum('pendidikan',['SD', 'SMP', 'SMA', 'Diploma', 'Sarjana', 'Tidak_sekolah'])->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('foto_kk')->nullable();
            $table->string('foto_set_badan')->nullable();
            $table->string('foto_4x6')->nullable();
            $table->string('foto_ket_lahir')->nullable();
            $table->string('foto_ijazah')->nullable();
            $table->enum('stats_nikah',['Menikah', 'Single', 'Cerai_hidup', 'Cerai_mati'])->nullable();

            //address
            $table->text('alamat')->nullable();
            $table->integer('rt')->nullable();
            $table->integer('rw')->nullable();
            $table->string('dusun')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('stats_negara')->nullable();

            //vaksin
            $table->enum('vaksin1',['ASTRA ZENECA', 'PFIZER', 'SINOVAC', 'SINOPHARM', 'CORONAVAC', 'MODERNA', 'JOHNSONS & JOHNSONS'])->nullable();
            $table->integer('no_batch_v1')->nullable();
            $table->date('tgl_vaksin1')->nullable();
            $table->string('sertifikat_vaksin1')->nullable();
            $table->enum('vaksin2',['ASTRA ZENECA', 'PFIZER', 'SINOVAC', 'SINOPHARM', 'CORONAVAC', 'MODERNA', 'JOHNSONS & JOHNSONS'])->nullable();
            $table->integer('no_batch_v2')->nullable();
            $table->date('tgl_vaksin2')->nullable();
            $table->string('sertifikat_vaksin2')->nullable();
            $table->enum('vaksin3',['ASTRA ZENECA', 'PFIZER', 'SINOVAC', 'SINOPHARM', 'CORONAVAC', 'MODERNA', 'JOHNSONS & JOHNSONS'])->nullable();
            $table->integer('no_batch_v3')->nullable();
            $table->date('tgl_vaksin3')->nullable();
            $table->string('sertifikat_vaksin3')->nullable();

            //Parent
            $table->string('nama_ayah')->default("-");
            $table->string('umur_ayah')->default("-");
            $table->string('nama_ibu')->default("-");
            $table->string('umur_ibu')->default("-");
            $table->integer('jml_sdr_lk')->default(0);
            $table->integer('jml_sdr_pr')->default(0);
            $table->integer('anak_ke')->default(1);

            //Family
            $table->string('foto_buku_nikah')->nullable();
            $table->string('nama_pasangan')->nullable();
            $table->string('umur_pasangan')->nullable();
            $table->string('pekerjaan_pasangan')->nullable();
            $table->integer('jml_anak_lk')->nullable();
            $table->integer('umur_anak_lk')->nullable();
            $table->integer('jml_anak_pr')->nullable();
            $table->integer('umur_anak_pr')->nullable();
            $table->string('foto_cerai')->nullable();
            $table->string('foto_kematian_pasangan')->nullable();

            //Company
            $table->string('nama_perusahaan1')->nullable();
            $table->text('alamat_perusahaan1')->nullable();
            $table->string('jabatan1')->nullable();
            $table->string('periode_awal1')->nullable();
            $table->string('periode_akhir1')->nullable();
            $table->string('alasan1')->nullable();
            $table->string('video_kerja1')->nullable();

            $table->string('nama_perusahaan2')->nullable();
            $table->text('alamat_perusahaan2')->nullable();
            $table->string('jabatan2')->nullable();
            $table->string('periode_awal2')->nullable();
            $table->string('periode_akhir2')->nullable();
            $table->string('alasan2')->nullable();
            $table->string('video_kerja2')->nullable();

            $table->string('nama_perusahaan3')->nullable();
            $table->text('alamat_perusahaan3')->nullable();
            $table->string('jabatan3')->nullable();
            $table->string('periode_awal3')->nullable();
            $table->string('periode_akhir3')->nullable();
            $table->string('alasan3')->nullable();
            $table->string('video_kerja3')->nullable();

            //Permission
            $table->string('nama_perizin')->nullable();
            $table->string('nik_perizin')->nullable();
            $table->text('alamat_perizin')->nullable();
            $table->string('tmp_lahir_perizin')->nullable();
            $table->date('tgl_lahir_perizin')->nullable();
            $table->string('hubungan')->nullable();
            $table->integer('rt_perizin')->nullable();
            $table->integer('rw_perizin')->nullable();
            $table->string('dusun_perizin')->nullable();
            $table->string('kelurahan_perizin')->nullable();
            $table->string('kecamatan_perizin')->nullable();
            $table->string('kabupaten_perizin')->nullable();
            $table->string('provinsi_perizin')->nullable();
            $table->string('negara_perizin')->nullable();
            $table->string('no_telp_perizin')->nullable();
            $table->string('foto_ktp_izin')->nullable();
            $table->enum('penempatan',['dalam negeri','luar negeri'])->nullable();
            $table->string('negara_id')->nullable();
            $table->integer('id_pekerjaan')->nullable();
            // $table->string('referral_token')->unique();
            // $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akademi_kandidat');
    }
};
