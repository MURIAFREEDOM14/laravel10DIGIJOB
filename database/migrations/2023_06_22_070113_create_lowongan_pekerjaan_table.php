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
            $table->string('usia')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('pendidikan')->nullable();
            $table->enum('jenis_kelamin',['M','F','MF'])->nullable();
            $table->text('pengalaman_kerja')->nullable();
            $table->integer('berat')->nullable();
            $table->integer('tinggi')->nullable();
            $table->string('pencarian_tmp')->nullable();
            $table->integer('id_perusahaan')->nullable();
            $table->text('isi')->nullable();
            $table->string('ttp_lowongan')->nullable();
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
