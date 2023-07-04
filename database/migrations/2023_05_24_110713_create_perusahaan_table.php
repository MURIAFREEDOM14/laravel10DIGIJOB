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
        Schema::create('perusahaan', function (Blueprint $table) {
            $table->id('id_perusahaan');
            $table->string('nama_perusahaan');
            $table->integer('no_nib');
            $table->string('email_perusahaan');
            $table->string('referral_code')->nullable();
            $table->string('nama_pemimpin')->nullable();
            $table->string('no_telp_perusahaan')->nullable();
            $table->string('nama_operator')->nullable();
            $table->string('no_telp_operator')->nullable();
            $table->string('email_operator')->nullable();
            $table->text('foto_perusahaan')->nullable();
            $table->text('logo_perusahaan')->nullable();
            $table->text('company_profile')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kota')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->enum('tmp_perusahaan',['Dalam negeri','Luar negeri'])->nullable();
            $table->enum('penempatan_kerja',['Dalam negeri','Luar negeri'])->nullable();
            $table->integer('negara_id')->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaan');
    }
};
