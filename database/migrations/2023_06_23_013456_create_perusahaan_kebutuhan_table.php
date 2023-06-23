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
        Schema::create('perusahaan_kebutuhan', function (Blueprint $table) {
            $table->id();
            $table->text('isi')->nullable();
            $table->string('agency')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('sektor_usaha')->nullable();
            $table->integer('nominal')->nullable();
            $table->integer('no_paspor')->nullable();
            $table->date('berlaku')->nullable();
            $table->date('habis_berlaku')->nullable();
            $table->integer('id_perusahaan')->nullable();
            $table->integer('id_kandidat')->nullable();
            $table->integer('negara_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaan_kebutuhan');
    }
};
