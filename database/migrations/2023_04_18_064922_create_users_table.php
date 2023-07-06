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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_telp')->unique()->nullable();
            $table->string('no_nis')->nullable()->unique();
            $table->string('no_nib')->nullable()->unique();
            $table->string('name')->nullable();
            $table->string('name_akademi')->nullable();
            $table->string('name_perusahaan')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('check_password');
            $table->string('referral_code')->nullable()->unique();
            // $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('type')->default(0);
            // users: 0 => User, 1 => Admin, 2 => Manager 
            $table->string('verify_confirmed')->nullable();
            $table->string('token')->nullable();
            $table->enum('penempatan_kerja',['Dalam negeri','Luar negeri'])->nullable();
            // $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
