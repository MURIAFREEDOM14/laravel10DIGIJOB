<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LowonganPekerjaan extends Model
{
    use HasFactory;
    protected $table = 'lowongan_pekerjaan';
    protected $guarded = [];
    protected $casts = [
        'updated_at' => 'datetime', 'created_at' => 'datetime'
    ];
}
