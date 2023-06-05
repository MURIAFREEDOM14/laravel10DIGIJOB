<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\Guard;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = 'prt_kecamatan';
    protected $guarded = [];
    public $timestamps = false;
}
