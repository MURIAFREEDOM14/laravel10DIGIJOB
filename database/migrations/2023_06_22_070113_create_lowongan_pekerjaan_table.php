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
            $table->string('nama_lowongan');
            $table->string('usia')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('jenis_kelamin');
            $table->string('pengalaman_kerja')->nullable();
            $table->string('berat')->nullable();
            $table->string('tinggi')->nullable();
            $table->string('pencarian_tmp')->nullable();
            $table->integer('id_perusahaan');
            $table->text('isi')->nullable();
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
