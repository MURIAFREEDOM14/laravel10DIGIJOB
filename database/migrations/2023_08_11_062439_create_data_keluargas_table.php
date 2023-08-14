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
        Schema::create('data_keluargas', function (Blueprint $table) {
            $table->id('id_keluarga');
            $table->integer('id_kandidat')->nullable();
            $table->string('nama_kandidat')->nullable();
            $table->integer('anak_ke')->nullable();
            $table->enum('jenis_kelamin',['M','F'])->nullable();
            $table->date('tgl_lahir_anak')->nullable();
            $table->integer('usia')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_keluargas');
    }
};
