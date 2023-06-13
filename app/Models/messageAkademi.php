<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class messageAkademi extends Model
{
    use HasFactory;
    protected $table = 'message_akademi';
    protected $guarded = [];
    protected $casts = [
        'updated_at' => 'datetime', 'created_at' => 'datetime'
    ];
}
