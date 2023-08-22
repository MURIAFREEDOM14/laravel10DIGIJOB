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
        Schema::create('interview', function (Blueprint $table) {
            $table->integer('id_interview')->autoIncrement();
            $table->text('id_kandidat')->nullable();
            $table->date('jadwal_interview_awal')->nullable();
            $table->date('jadwal_interview_akhir')->nullable();
            $table->enum('status',['pilih','terjadwal','dimulai','berakhir'])->nullable();
            $table->integer('id_perusahaan')->nullable();
            $table->integer('id_lowongan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interview');
    }
};
