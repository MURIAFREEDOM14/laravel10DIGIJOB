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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->bigInteger('id_jadwal');
            $table->date('tanggal_jadwal')->nullable();
            $table->string('kandidat_baru')->nullable();
            $table->string('akademi_baru')->nullable();
            $table->string('perusahaan_baru')->nullable();
            $table->string('kandidat_login')->nullable();
            $table->string('kandidat_id')->nullable();
            $table->string('akademi_login')->nullable();
            $table->string('akademi_id')->nullable();
            $table->string('perusahaan_login')->nullable();
            $table->string('perusahaan_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
