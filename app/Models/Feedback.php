<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'komentar',
    ];

    // Define relationship to User
    public function user()
    {
        return $this->belongsTo(FormUser::class, 'user_id');
    }
}
