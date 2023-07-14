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
        Schema::create('persetujuan_kandidat', function (Blueprint $table) {
            $table->id();
            $table->integer('id_kandidat')->nullable();
            $table->string('nama_kandidat')->nullable();
            $table->enum('persetujuan',['tidak','ya'])->nullable();
            $table->text('tmp_bekerja')->nullable();
            $table->string('jabatan')->nullable();
            $table->date('tgl_mulai_kerja')->nullable();
            $table->text('alasan_lain')->nullable();
            $table->integer('id_perusahaan')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persetujuan_kandidat');
    }
};
