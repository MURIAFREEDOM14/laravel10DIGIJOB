<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportUserIn extends Model
{
    use HasFactory;
    protected $table = 'v_laporan_pengguna_masuk';
    protected $guarded = [];
    public $timestamps = false;
}
