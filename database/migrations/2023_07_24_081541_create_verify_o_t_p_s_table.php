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
        Schema::create('verify_o_t_p_s', function (Blueprint $table) {
            $table->id('verify_otp_id');
            $table->bigInteger('id')->nullable();
            $table->string('otp')->nullable();
            $table->timestamp('expire_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verify_o_t_p_s');
    }
};
