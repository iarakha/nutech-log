<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenTask extends Model
{
    protected $table = 'wo';
    protected $fillable = [
        'id_lokasi',
        'id_perangkat',
        'id_part',
        'id_masalah',
        'kode_wo',
        'jenis_laporan',
        'project',
        'penyebab',
        'solusi',
        'sumber',
        'status',
        'tanggal_masalah',
        'jam_masalah',
        'tanggal_selesai',
        'jam_selesai',
        'keterangan',
    ];
    use HasFactory;
}


