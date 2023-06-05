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
        Schema::create('notify', function (Blueprint $table) {
            $table->id('id_notify');
            $table->text('isi');
            $table->text('pengirim_notifikasi');
            $table->integer('id_kandidat');
            $table->integer('id_perusahaan');
            $table->integer('id_akademi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notify');
    }
};
