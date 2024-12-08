<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dosen extends Model
{
    use HasFactory;
    protected $table = 'dosen';
    protected $primaryKey = 'nip';
    protected $fillable = [
        'nip',
        'nama',
        'id_prodi',
        'user_id'
    ];
}
