<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPekerja extends Model
{
    use HasFactory;
    protected $table = 'laporan_pekerja';
    protected $guarded = [];
    protected $casts = ['created_at' => 'datetime', 'updated_at' => 'datetime'];
}
