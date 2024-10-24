<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fish extends Model
{
    use HasFactory;

    // Nama tabel jika tidak mengikuti konvensi penamaan (plural)
    protected $table = 'fishes';

    // Atribut yang dapat diisi
    protected $fillable = [
        'name',
        'scientific_name',
        'category',
        'origin',
        'size',
        'characteristics',
        'aquarium_size',
        'temperature',
        'ph',
        'salinity',
        'lighting',
    ];

    // Jika Anda menggunakan timestamps (created_at dan updated_at)
    public $timestamps = true;

    // Anda juga bisa mendefinisikan relasi dengan model lain jika perlu
    // Contoh:
    // public function user() {
    //     return $this->belongsTo(User::class);
    // }
}
