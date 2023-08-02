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
        Schema::create('video_pengalaman_kerja', function (Blueprint $table) {
            $table->id('video_kerja_id');
            $table->integer('pengalaman_kerja_id')->nullable();
            $table->string('jabatan')->nullable();
            $table->text('video')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_pengalaman_kerja');
    }
};
