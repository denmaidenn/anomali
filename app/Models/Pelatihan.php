<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    use HasFactory;

    protected $table = 'pelatihan';

    protected $fillable = [
        'user_id',
        'video_pelatihan',
        'deskripsi_pelatihan',
        'harga',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
