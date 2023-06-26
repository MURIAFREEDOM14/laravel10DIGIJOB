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
        Schema::create('contact_us_perusahaan', function (Blueprint $table) {
            $table->id('id_contact_perusahaan');
            $table->string('dari');
            $table->text('isi');
            $table->string('balas');
            $table->integer('id_perusahaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_us_perusahaan');
    }
};
