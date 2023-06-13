<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class messagePerusahaan extends Model
{
    use HasFactory;
    protected $table = 'message_perusahaan';
    protected $guarded = [];
    protected $casts = [
        'updated_at' => 'datetime', 'created_at' => 'datetime'
    ];
}
