<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KandidatInterview extends Model
{
    use HasFactory;
    protected $table = 'kandidat_interviews';
    protected $guarded = [];
    protected $casts = ['created_at' => 'datetime','updated_at' => 'datetime'];
}
