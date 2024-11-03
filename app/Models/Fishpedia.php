<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fishpedia extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika berbeda dari konvensi plural
    protected $table = 'fishpedias';

    // Menentukan atribut yang dapat diisi (fillable)
    protected $fillable = [
        'asal',
        'jenis',
        'deskripsi',
        'nama',
        'id_ikan',
        'harga_pasar',
        'gambar_ikan',
    ];
}
