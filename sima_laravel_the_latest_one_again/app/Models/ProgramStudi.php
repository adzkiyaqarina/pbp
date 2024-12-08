<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramStudi extends Model
{
    use HasFactory;
    protected $table = 'program_studi';
    protected $primaryKey = 'id_prodi';
    protected $fillable = [
        'nama','id_fakultas'
    ];
}
