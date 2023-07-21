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
        Schema::create('verifikasi_diri', function (Blueprint $table) {
            $table->id('verify_id');
            $table->integer('id')->nullable();
            $table->string('email')->nullable();
            $table->text('foto_diri_ktp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifikasi_diri');
    }
};
