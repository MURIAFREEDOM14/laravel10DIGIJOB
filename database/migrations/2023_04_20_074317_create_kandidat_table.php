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
        Schema::create('kandidat', function (Blueprint $table) {
            $table->id('id_kandidat');
            $table->bigInteger('id');
            $table->string('referral_code');
            $table->string('email')->unique()->nullable();

            //Personal
            $table->string('nama')->nullable();
            $table->string('nama_panggilan')->nullable();
            $table->enum('jenis_kelamin',['M','F'])->nullable();
            $table->string('tmp_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->integer('usia')->nullable();
            $table->string('no_telp')->unique()->nullable();
            $table->enum('agama',['islam','kristen','katolik','hindu','buddha','konghucu', 'aliran_kepercayaan'])->nullable();
            $table->integer('berat')->nullable();
            $table->integer('tinggi')->nullable();

            //Document
            $table->bigInteger('nik')->nullable();
            $table->enum('pendidikan',['SD', 'SMP', 'SMA', 'Diploma', 'Sarjana', 'Tidak_sekolah'])->nullable();
            $table->integer('rt')->nullable();
            $table->integer('rw')->nullable();
            $table->string('dusun')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('foto_kk')->nullable();
            $table->string('foto_set_badan')->nullable();
            $table->string('foto_4x6')->nullable();
            $table->string('foto_ket_lahir')->nullable();
            $table->string('foto_ijazah')->nullable();
            // $table->string('stats_negara')->nullable();

            //Family
            $table->enum('stats_nikah',['Menikah', 'Single', 'Cerai hidup', 'Cerai mati'])->nullable();
            $table->string('foto_buku_nikah')->nullable();
            $table->string('nama_pasangan')->nullable();
            $table->string('umur_pasangan')->nullable();
            $table->date('tgl_lahir_pasangan')->nullable();
            $table->string('pekerjaan_pasangan')->nullable();
            $table->integer('jml_anak_lk')->nullable();
            $table->integer('umur_anak_lk')->nullable();
            $table->integer('jml_anak_pr')->nullable();
            $table->integer('umur_anak_pr')->nullable();
            $table->string('foto_cerai')->nullable();
            $table->string('foto_kematian_pasangan')->nullable();

            //Vaksin
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
            $table->string('nama_ayah')->nullable();
            $table->string('umur_ayah')->nullable();
            $table->date('tgl_lahir_ayah')->nullable();
            $table->tetx('tmp_lahir_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('umur_ibu')->nullable();
            $table->date('tgl_lahir_ibu')->nullable();
            $table->text('tmp_lahir_ibu')->nullable();
            $table->integer('jml_sdr_lk')->default(0);
            $table->integer('jml_sdr_pr')->default(0);
            $table->integer('rt_parent')->nullable();
            $table->integer('rw_parent')->nullable();
            $table->string('dusun_parent')->nullable();
            $table->string('kelurahan_parent')->nullable();
            $table->string('kecamatan_parent')->nullable();
            $table->string('kabupaten_parent')->nullable();
            $table->string('provinsi_parent')->nullable();
            $table->integer('anak_ke')->default(1);
            
            //Company
            $table->text('pengalaman_kerja')->nullable();

            //Permission
            $table->string('nama_perizin')->nullable();
            $table->string('nik_perizin')->nullable();
            $table->string('tmp_lahir_perizin')->nullable();
            $table->date('tgl_lahir_perizin')->nullable();
            $table->string('hubungan_perizin')->nullable();
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

            // paspor //
            $table->string('no_paspor')->nullable();
            $table->string('pemilik_paspor')->nullable();
            $table->date('tgl_terbit_paspor')->nullable();
            $table->date('tgl_akhir_paspor')->nullable();
            $table->text('tmp_paspor')->nullable();
            $table->text('foto_paspor')->nullable();

            // placement //
            $table->enum('penempatan',['dalam negeri','luar negeri'])->nullable();
            $table->string('negara_id')->nullable();
            $table->string('kontrak')->nullable();
            $table->string('jabatan_kandidat')->nullable();

            // connecting //
            $table->integer('id_akademi')->nullable();
            $table->integer('id_perusahaan')->nullable();
            $table->enum('stat_pemilik',['belum diambil','diambil'])->nullable();
            $table->text('info')->nullable();

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
        Schema::dropIfExists('kandidat');
    }
};
