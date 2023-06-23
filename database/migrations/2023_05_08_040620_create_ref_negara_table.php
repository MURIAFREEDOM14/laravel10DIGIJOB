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
        Schema::create('ref_negara', function (Blueprint $table) {
            $table->id('negara_id');
            $table->string('negara');
            $table->string('kode_negara');
            $table->integer('syarat_umur')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('gambar')->nullable();
            $table->string('mata_uang')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_negara');
    }
};
