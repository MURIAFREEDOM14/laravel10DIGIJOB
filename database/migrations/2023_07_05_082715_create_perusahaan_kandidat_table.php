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
        Schema::create('perusahaan_kandidat', function (Blueprint $table) {
            $table->id('id_pekerja_perusahaan');
            $table->integer('id_kandidat')->nullable();
            $table->integer('id_perusahaan')->nullable();
            $table->string('nama_pekerjaan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaan_kandidat');
    }
};
