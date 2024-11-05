<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthControllerAPI;
use App\Http\Controllers\API\PelatihanControllerAPI;
use App\Http\Controllers\API\FishpediaControllerAPI;
use App\Http\Controllers\API\FishmartControllerAPI;
use App\Http\Controllers\API\MobileAuthControllerAPI;




// Route untuk menampilkan semua data ikan


Route::post('/login', [AuthControllerAPI::class, 'in']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::prefix('admin')->group(function () {
        Route::get('/', [AuthControllerAPI::class, 'index']);
        Route::post('/create', [AuthControllerAPI::class,'store']);
        Route::get('/{id}', [AuthControllerAPI::class, 'show']);
        Route::put('/{id}', [AuthControllerAPI::class,'update']);
        Route::delete('/{id}', [AuthControllerAPI::class,'delete']);
    });

    Route::prefix('formuser')->group(function () {
        Route::get('/', [MobileAuthControllerAPI::class, 'index']);
        Route::post('/create', [MobileAuthControllerAPI::class,'store']);
        Route::get('/{id}', [MobileAuthControllerAPI::class, 'show']);
        Route::put('/{id}', [MobileAuthControllerAPI::class,'update']);
        Route::delete('/{id}', [MobileAuthControllerAPI::class,'delete']);
    });

    Route::prefix('pelatihan')->group(function () {
        Route::get('/', [PelatihanControllerAPI::class, 'index']);
        Route::post('/create', [PelatihanControllerAPI::class,'store']);
        Route::get('/{id}', [PelatihanControllerAPI::class, 'show']);
        Route::put('/{id}', [PelatihanController::class, 'update']);
        Route::delete('/{id}', [PelatihanController::class, 'delete']);
    });

    Route::prefix('fishpedia')->group(function () {
        Route::get('/', [FishpediaControllerAPI::class, 'index']);
        Route::post('/create', [FishpediaControllerAPI::class,'store']);
        Route::get('/{id}', [FishpediaControllerAPI::class, 'show']);
        Route::put('/{id}', [FishpediaControllerAPI::class, 'update']);
        Route::delete('/{id}', [FishpediaControllerAPI::class, 'delete']);
    });

    Route::prefix('fishmart')->group(function () {
        Route::get('/', [FishmartControllerAPI::class, 'index']);
        Route::post('/create', [FishmartControllerAPI::class,'store']);
        Route::get('/{id}', [FishmartControllerAPI::class, 'show']);
        Route::put('/{id}', [FishmartControllerAPI::class, 'update']);
        Route::delete('/{id}', [FishmartControllerAPI::class, 'delete']);
    });



});





    