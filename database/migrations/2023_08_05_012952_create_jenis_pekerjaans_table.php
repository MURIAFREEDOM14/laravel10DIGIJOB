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
        Schema::create('jenis_pekerjaan', function (Blueprint $table) {
            $table->id('jenis_kerja_id');
            $table->string('judul')->nullable();
            $table->string('code')->nullable();
            $table->text('nama')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_pekerjaans');
    }
};
