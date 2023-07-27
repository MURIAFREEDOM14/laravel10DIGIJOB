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
        Schema::create('credit_perusahaan', function (Blueprint $table) {
            $table->id('credit_id');
            $table->integer('id_perusahaan')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->string('no_nib')->nullable();
            $table->integer('credit')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_perusahaan');
    }
};
