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
        Schema::create('laporan_pekerja', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kandidat')->nullable();
            $table->integer('id_kandidat')->nullable();
            $table->text('tmp_bekerja')->nullable();
            $table->string('jabatan')->nullable();
            $table->date('tgl_kerja')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_pekerja');
    }
};
