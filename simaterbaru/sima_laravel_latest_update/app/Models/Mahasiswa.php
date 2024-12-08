<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa';
    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'nim',
        'email',
        'jenis_kelamin',
        'id_fakultas','id_prodi',
        'alamat',
        'telepon',
        'angkatan',
        'status',
        'ipk',
        'wali_dosen',
        'semester'
    ];
}
