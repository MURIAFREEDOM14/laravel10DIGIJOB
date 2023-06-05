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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->string('id_kandidat')->nullable();
            $table->string('nik')->nullable();
            $table->string('id_perusahaan')->nullable();
            $table->string('nib')->nullable();
            $table->string('nama_pembayaran')->nullable();
            $table->string('nominal_pembayaran')->nullable();
            $table->string('foto_pembayaran')->nullable();
            $table->enum('stats_pembayaran',['belum dibayar','sudah dibayar'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
