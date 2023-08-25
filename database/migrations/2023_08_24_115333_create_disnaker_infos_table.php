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
        Schema::create('disnaker_infos', function (Blueprint $table) {
            $table->id('disnaker_id');
            $table->string('nama_disnaker')->nullable();
            $table->string('email_disnaker')->nullable();
            $table->string('alamat_disnaker')->nullable();
            $table->integer('kabupaten_id')->nullable();
            $table->integer('provinsi_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disnaker_infos');
    }
};
