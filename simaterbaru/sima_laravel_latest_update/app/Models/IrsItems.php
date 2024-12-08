<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IrsItems extends Model
{
    use HasFactory;
    protected $table = 'irs_items';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_irs',
        'id_mata_kuliah',
    ];
}
