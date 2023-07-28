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
        Schema::create('pengalaman_kerja', function (Blueprint $table) {
            $table->id('pengalaman_kerja_id');
            $table->string('nama_perusahaan')->nullable();
            $table->text('alamat_perusahaan')->nullable();
            $table->string('jabatan')->nullable();
            $table->date('periode_awal')->nullable();
            $table->date('periode_akhir')->nullable();
            $table->text('alasan_berhenti')->nullable();
            $table->text('video_pengalaman_kerja')->nullable();
            $table->text('foto_pengalaman_kerja')->nullable();
            $table->integer('id_kandidat')->nullable();
            $table->string('nama_kandidat')->nullable();
            $table->integer('lama_kerja')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengalaman_kerja');
    }
};
