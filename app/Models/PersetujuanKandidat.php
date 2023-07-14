<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersetujuanKandidat extends Model
{
    use HasFactory;
    protected $table = 'persetujuan_kandidat';
    protected $guarded = [];
    public $timestamps = false;
}
