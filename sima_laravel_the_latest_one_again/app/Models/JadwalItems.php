<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JadwalItems extends Model
{
    use HasFactory;
    protected $table = 'jadwal_items';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_jadwal',
        'kode_mk',
        'kode_ruang',
        'waktu_mulai',
        'waktu_selesai',
        'hari'
    ];
}
