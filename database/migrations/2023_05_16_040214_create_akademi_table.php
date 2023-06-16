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
        Schema::create('akademi', function (Blueprint $table) {
            $table->id('id_akademi');
            $table->string('referral_code')->nullable();
            $table->string('nama_akademi');
            $table->string('no_nis');
            $table->string('no_surat_izin')->nullable();
            $table->text('alamat_akademi')->nullable();
            $table->string('email');
            $table->string('no_telp_akademi')->nullable();
            $table->string('nama_kepala_akademi')->nullable();
            $table->string('nama_operator')->nullable();
            $table->string('email_operator')->nullable();
            $table->string('no_telp_operator')->nullable();
            $table->text('foto_akademi')->nullable();
            $table->text('logo_akademi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akademi');
    }
};
