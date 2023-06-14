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
        Schema::create('notify_akademi', function (Blueprint $table) {
            $table->id('id_notify');
            $table->integer('id_akademi')->nullable();
            $table->integer('id_kandidat')->nullable();
            $table->text('isi')->nullable();
            $table->text('url')->nullable();
            $table->text('pengirim')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notify_akademi');
    }
};
