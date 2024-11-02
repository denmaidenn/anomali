<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\FishmartController;
use App\Http\Controllers\FishpediaController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SearchController; 
//menampilkan view sign
Route::get('/', function () {
    return view('sign.index', ['title' => 'Sign In']);
});

    //untuk register membuat data akun
    Route::get('/register',[SignController::class,'showRegisterForm'])->name('register');
    Route::post('/register',[SignController::class,'register']);

    //untuk mengirim data signin lalu ke dashboard
    Route::get('/signin' , [SignController::class,'index'])->name('login');
    Route::post('/signin' , [SignController::class,'in']);



Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');


    //untuk logout
    Route::post('/logout', [SignController::class,'logout']);


    # USER VIEW
    //untuk mengirim form data user ke view userdata

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class,'index'])->name('user.index');
        Route::get('/create', [UserController::class,'create'])->name('user.create');
        Route::post('/store', [FormController::class,'store'])->name('user.store');
        Route::get('/{id}/edituser', [UserController::class,'edit'])->name('user.edit');
        Route::put('/{id}/manageuser', [FormController::class,'update'])->name('user.update');
        Route::delete('/{id}/deleteuser', [FormController::class,'delete'])->name('user.delete');
    
    });



    # PELATIHAN VIEW
    //untuk menampilkan view pelatihan


    Route::prefix('pelatihan')->group(function () {
        Route::get('/', [PelatihanController::class,'index'])->name('pelatihan.index');
        Route::get('/create', [PelatihanController::class, 'create'])->name('pelatihan.create');
        Route::post('/store', [PelatihanController::class, 'store'])->name('pelatihan.store');
        Route::get('/{id}/edit', [PelatihanController::class, 'edit'])->name('pelatihan.edit');
        Route::put('/{id}/update', [PelatihanController::class,'update'])->name('pelatihan.update');
        Route::delete('/{id}/delete', [PelatihanController::class,'destroy'])->name('pelatihan.destroy');
    
    });

    # FISHPEDIA VIEW
    //untuk menampilkan view fishpedia

    Route::prefix('fishpedia')->group(function () {
        Route::get('/', [FishpediaController::class,'index'])->name('fishpedia.index');
        Route::get('/create', [FishpediaController::class,'create'])->name('fishpedia.create');
        Route::post('/store', [FishpediaController::class, 'store'])->name('fishpedia.store');
        Route::get('/manage/{id}', [FishpediaController::class, 'edit'])->name('fishpedia.edit');
        Route::put('/update/{id}', [FishpediaController::class, 'update'])->name('fishpedia.update');
        Route::delete('/delete/{id}', [FishpediaController::class, 'destroy'])->name('fishpedia.delete');
    
    });

    # FISHMART VIEW 
    //untuk menampilkan view fishmart

    Route::prefix('fishmart')->group(function () {
        Route::get('/', [FishmartController::class,'index'])->name('fishmart.index');
        Route::get('/create', [FishmartController::class,'create'])->name('fishmart.create');
        Route::post('/store', [FishmartController::class,'store'])->name('fishmart.store');
        Route::get('/{id}/edit', [FishmartController::class,'edit'])->name('fishmart.edit');
        Route::put('/{id}/update', [FishmartController::class,'update'])->name('fishmart.update');
        Route::delete('/{id}/delete', [FishmartController::class,'destroy'])->name('fishmart.destroy');
        Route::get('/{id}/show', [FishmartController::class,'show'])->name('fishmart.show');
    
    });


});

    Route::get('/search', [SearchController::class, 'search'])->name('search');


