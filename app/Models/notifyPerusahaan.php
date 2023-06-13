<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notifyPerusahaan extends Model
{
    use HasFactory;
    protected $table = 'notify_perusahaan';
    protected $guarded = [];
    protected $casts = [
        'updated_at' => 'datetime', 'created_at' => 'datetime'
    ];
}
