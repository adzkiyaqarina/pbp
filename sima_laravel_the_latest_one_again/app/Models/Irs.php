<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Irs extends Model
{
    use HasFactory;
    protected $table = 'irs';
    protected $primaryKey = 'id_irs';
    protected $fillable = [
        'nim',
        'tahun_ajaran',
        'semester',
        'nip_dosen_wali',
        'catatan',
        'status',
        'sks',
        'maks_sks',
        'status_lock_irs'
    ];
}
