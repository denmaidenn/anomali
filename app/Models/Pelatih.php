<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatih extends Model
{
    use HasFactory;

    protected $table = 'pelatih';

    protected $fillable = [
        'nama',
        'email',
        'no_telp',
        'alamat'
    ];

    public function pelatihans()
    {
        return $this->hasMany(Pelatihan::class, 'id_user');
    }
}
