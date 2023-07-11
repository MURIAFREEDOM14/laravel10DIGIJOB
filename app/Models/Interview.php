<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'interview';
    protected $casts = [
        'updated_at' => 'datetime', 'created_at' => 'datetime'
    ];   
}
