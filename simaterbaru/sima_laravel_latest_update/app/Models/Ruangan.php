<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ruangan extends Model
{
    use HasFactory;
    protected $table = 'ruang';
    protected $primaryKey = 'kode_ruang';
    protected $fillable = [
        'kode_ruangan','nama','kapasitas','gedung_id'
    ];
}
