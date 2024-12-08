<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fakultas extends Model
{
    use HasFactory;
    protected $table = 'fakultas';
    protected $primaryKey = 'id_fakultas';
    protected $fillable = [
        'nama'
    ];
}
