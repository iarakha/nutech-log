<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masalah extends Model
{
    protected $table = 'jenis_masalah';
    protected $fillable = [
        'nama',
    ];
    
    use HasFactory;
}
