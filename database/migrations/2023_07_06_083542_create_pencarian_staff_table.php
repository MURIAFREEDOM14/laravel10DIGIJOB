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
        Schema::create('pencarian_staff', function (Blueprint $table) {
            $table->id('pencarian_staff_id');
            $table->integer('id_perusahaan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->integer('usia')->nullable();
            $table->enum('syarat_kelamin',['M','F','MF'])->nullable();
            $table->string('pendidikan')->nullable();
            $table->integer('tinggi')->nullable();
            $table->integer('berat')->nullable();
            $table->text('domisili')->nullable();
            $table->string('lama_pengalaman')->nullable();
            $table->integer('jml_kebutuhan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pencarian_staff');
    }
};
