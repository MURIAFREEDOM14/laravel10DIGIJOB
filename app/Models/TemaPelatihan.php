<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemaPelatihan extends Model
{
    use HasFactory;
    protected $table = 'tema_pelatihan';
    protected $guarded = [];
    protected $casts = [
        'updated_at' => 'datetime', 'created_at' => 'datetime'
    ];
}
