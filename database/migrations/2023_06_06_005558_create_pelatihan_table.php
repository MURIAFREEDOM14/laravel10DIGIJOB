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
        Schema::create('pelatihan', function (Blueprint $table) {
            $table->id('id');
            $table->string('judul')->nullable();
            $table->string('url')->nullable();
            $table->string('thumbnail')->nullable();
            $table->text('video')->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('negara_id')->nullable();
            $table->string('tema')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelatihan');
    }
};
