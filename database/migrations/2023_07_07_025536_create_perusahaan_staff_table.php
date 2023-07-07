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
        Schema::create('perusahaan_staff', function (Blueprint $table) {
            $table->id('id_staff_perusahaan');
            $table->integer('id_kandidat')->nullable();
            $table->string('nama_kandidat')->nullable();
            $table->integer('id_perusahaan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaan_staff');
    }
};
