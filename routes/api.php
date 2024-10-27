<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\FishpediaController;

// Route untuk menyimpan data ikan
Route::post('/fishes', [FishpediaController::class, 'store']);

// Route untuk menampilkan semua data ikan
Route::get('/fishes', [FishpediaController::class, 'index'])->name('fish.store');
