<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = 'jadwal';
    protected $primaryKey = 'id_jadwal';
    protected $fillable = [
        'kelas',
        'tahun_ajaran',
        'semester',
        'status',
        'id_prodi'
    ];
}
