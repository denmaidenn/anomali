<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'prodi',
        'kelas',
        'jenis_kelamin',
    ];

    
}
