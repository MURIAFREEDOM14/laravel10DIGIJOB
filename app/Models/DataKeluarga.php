<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKeluarga extends Model
{
    use HasFactory;
    protected $table = 'data_keluargas';
    protected $guarded = [];
    protected $casts = ['created_at'=>'datetime', 'updated_at'=>'datetime'];
}