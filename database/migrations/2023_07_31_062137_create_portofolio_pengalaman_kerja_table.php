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
        Schema::create('portofolio_pengalaman_kerja', function (Blueprint $table) {
            $table->bigInteger('portofolio_id')->autoIncrement();
            $table->text('foto_pengalaman_kerja')->nullable();
            $table->text('video_pengalaman_kerja')->nullable();
            $table->integer('batas')->nullable();
            $table->integer('pengalaman_kerja_id')->nullable();
            $table->string('jabatan')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portofolio_pengalaman_kerja');
    }
};
