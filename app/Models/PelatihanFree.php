<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelatihanFree extends Model
{
    protected $table = 'pelatihanfree';

    // Kolom yang bisa diisi melalui mass assignment
    protected $fillable = [
        'id_user',
        'judul',
        'video_pelatihan',
        'gambar_pelatihan',
        'deskripsi_pelatihan',
    ];

    /**
     * Relasi ke model User.
     * Menghubungkan pelatihan ke pengguna yang membuatnya.
     */
    public function user()
    {
        return $this->belongsTo(Pelatih::class, 'id_user');
    }}
