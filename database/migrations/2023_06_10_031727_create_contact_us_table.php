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
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id('id');
            $table->string('dari');
            $table->string('kepada');
            $table->text('isi');
            $table->integer('id_kandidat')->nullable();
            $table->integer('id_akademi')->nullable();
            $table->integer('id_perusahaan')->nullable();
            $table->text('gambar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_us');
    }
};
