<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AuthModel extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = [
        'name','email','password','role'
    ];
}
