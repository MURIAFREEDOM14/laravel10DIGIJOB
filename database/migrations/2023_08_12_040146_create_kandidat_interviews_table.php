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
        Schema::create('kandidat_interviews', function (Blueprint $table) {
            $table->id();
            $table->integer('id_interview')->nullable();
            $table->integer('id_kandidat')->nullable();
            $table->integer('id_lowongan')->nullable();
            $table->integer('id_perusahaan')->nullable();
            $table->string('nama')->nullable();
            $table->integer('usia')->nullable();
            $table->enum('jenis_kelamin',['M','F'])->nullable();
            $table->integer('kesempatan')->nullable();
            $table->date('jadwal_interview')->nullable();
            $table->time('waktu_interview_awal')->nullable(); 
            $table->time('waktu_interview_akhir')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kandidat_interviews');
    }
};
