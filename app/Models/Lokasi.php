<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $table = 'lokasi';
    protected $fillable = [
        'lokasi',
        'provinsi'
    ];
    use HasFactory;
}