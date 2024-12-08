<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MataKuliah extends Model
{
    use HasFactory;
    protected $table = 'mata_kuliah';
    protected $fillable = [
        'kode_mk',
        'nama',
        'sks',
        'nip_dosen',
        'id_prodi',
        'tahun_ajaran',
        'semester'
    ];
}
