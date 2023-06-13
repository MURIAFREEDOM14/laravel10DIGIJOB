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
        Schema::create('message_kandidat', function (Blueprint $table) {
            $table->id();
            $table->integer('id_kandidat')->nullable();
            $table->integer('id_perusahaan')->nullable();
            $table->text('pesan')->nullable();
            $table->string('pengirim')->nullable();
            $table->string('kepada')->nullable();
            $table->integer('id_interview')->nullable();
            $table->integer('id_akademi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_kandidat');
    }
};
