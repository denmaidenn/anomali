<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fish extends Model
{
    use HasFactory;

    protected $table = 'fishes';

    protected $fillable = [
        'name', 
        'scientific_name', 
        'category', 'origin', 
        'size', 
        'characteristics', 
        'aquarium_size', 
        'temperature', 
        'ph', 
        'salinity', 
        'lighting'];
}


