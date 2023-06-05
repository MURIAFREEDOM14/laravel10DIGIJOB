<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'notify';
    protected $casts = [
        'updated_at' => 'datetime', 'created_at' => 'datetime'
    ];
}
