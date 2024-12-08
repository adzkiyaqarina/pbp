<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AlokasiRuangItems extends Model
{
    use HasFactory;
    protected $table = 'alokasi_ruang_item';
    protected $fillable = [
        'id_alokasi','id_gedung','id_ruang'
    ];
    public $timestamps = false;
}
