<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Psy\Readline\Hoa\ProtocolNodeLibrary;

class VideoKerja extends Model
{
    use HasFactory;
    Protected $table = 'video_pengalaman_kerja';
    protected $guarded = [];
    public $timestamps = false;
}
