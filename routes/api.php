<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthControllerAPI;
use App\Http\Controllers\API\PelatihanControllerAPI;

// Route untuk menampilkan semua data ikan


Route::group(['middleware' => ['auth']], function () {

   
        Route::get('/', [AuthControllerAPI::class, 'index']);
        Route::post('/create', [AuthControllerAPI::class,'store']);
        Route::get('/{id}', [AuthControllerAPI::class, 'show']);
        Route::put('/{id}', [AuthControllerAPI::class,'update']);
        Route::delete('/{id}', [AuthControllerAPI::class,'delete']);
   

    Route::prefix('pelatihan')->group(function () {
        Route::get('/', [PelatihanControllerAPI::class, 'index']);
        Route::post('/create', [PelatihanControllerAPI::class,'store']);
        Route::get('/{id}', [PelatihanControllerAPI::class, 'show']);
    });
});


    
