<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditPerusahaan extends Model
{
    use HasFactory;
    protected $table = 'credit_perusahaan';
    protected $guarded = [];
    public $timestamps = false;
}
