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
            $table->integer('id_interview');
            $table->string('nama_kandidat')->nullable();
            $table->integer('id_kandidat')->nullable();
            $table->datetime('jadwal_interview')->nullable();
            $table->enum('status',['pilih','terjadwal','dimulai','berakhir'])->nullable();
            $table->integer('usia')->nullable();
            $table->enum('jenis_kelamin',['M','F'])->nullable();
            $table->integer('id_perusahaan')->nullable();
            $table->integer('kesempatan')->nullable();
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
