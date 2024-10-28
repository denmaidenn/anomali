<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FishpediaController;

// Route untuk menampilkan semua data ikan
Route::get('/fishes', [FishpediaController::class, 'index'])->name('fish.index');

// Route untuk menyimpan data ikan
Route::post('/fishes', [FishpediaController::class, 'store'])->name('fish.store');

// Route untuk menampilkan detail data ikan


// Route untuk mengupdate data ikan
Route::put('/fishes/{id}', [FishpediaController::class, 'update'])->name('fish.update');

// Route untuk menghapus data ikan
Route::delete('/fishes/{id}', [FishpediaController::class, 'destroy'])->name('fish.destroy');
