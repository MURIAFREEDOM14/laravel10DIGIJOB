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
        Schema::create('manager', function (Blueprint $table) {
            $table->integer('type')->default(3);
            $table->integer('id_kandidat')->nullable();
            $table->text('isi_pesan_Kandidat')->nullable();
            $table->integer('id_perusahaaan')->nullable();
            $table->text('isi_pesan_perusahaan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manager');
    }
};
