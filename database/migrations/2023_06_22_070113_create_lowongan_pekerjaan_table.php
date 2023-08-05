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
        Schema::create('lowongan_pekerjaan', function (Blueprint $table) {
            $table->id('id_lowongan');
            $table->string('negara')->nullable();
            $table->integer('negara_id')->nullable();
            $table->string('usia_min')->nullable();
            $table->string('usia_maks')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('pendidikan')->nullable();
            $table->enum('jenis_kelamin',['M','F','MF'])->nullable();
            $table->text('pengalaman_kerja')->nullable();
            $table->integer('berat_min')->nullable();
            $table->integer('berat_maks')->nullable();
            $table->integer('tinggi')->nullable();
            $table->string('pencarian_tmp')->nullable();
            $table->integer('id_perusahaan')->nullable();
            $table->text('isi')->nullable();
            $table->date('ttp_lowongan')->nullable();
            $table->text('gambar_lowongan')->nullable();
            $table->string('lvl_pekerjaan')->nullable();
            $table->text('isi')->nullable();
            $table->string('mata_uang')->nullable();
            $table->string('gaji_minimum')->nullable();
            $table->string('gaji_maksimum')->nullable();
            $table->text('benefit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongan_pekerjaan');
    }
};
