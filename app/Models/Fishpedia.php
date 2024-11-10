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
        'nama_ilmiah',
        'kategori',
        'asal',
        'ukuran',
        'karakteristik',
        'akuarium',
        'suhu_ideal',
        'ph_air',
        'salinitas',
        'pencahayaan',
        'gambar_ikan'
    ];

}
