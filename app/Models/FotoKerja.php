<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoKerja extends Model
{
    use HasFactory;
    protected $table = 'foto_pengalaman_kerja';
    protected $guarded = [];
    public $timestamps = false;
}
