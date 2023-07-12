<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class PengalamanKerja extends Model
{
    use HasFactory;
    // use softDeletes;
    protected $table = 'pengalaman_kerja';
    protected $guarded = [];
    public $timestamps = false;
}
