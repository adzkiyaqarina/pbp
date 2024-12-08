<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gedung extends Model
{
    use HasFactory;
    protected $table = 'gedung';
    protected $fillable = [
        'nama'
    ];
}
