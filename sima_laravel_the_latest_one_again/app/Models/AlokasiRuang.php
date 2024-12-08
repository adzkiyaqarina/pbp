<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AlokasiRuang extends Model
{
    use HasFactory;
    protected $table = 'alokasi_ruang';
    protected $fillable = [
        'id_fakultas','id_prodi','status'
    ];
}
