<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\PelatihanfreeController;
use App\Http\Controllers\FishmartController;
use App\Http\Controllers\FishpediaController;
use App\Http\Controllers\PelatihController;
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



Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');


    //untuk Edit Data Admin dan Update
    Route::prefix('admin')->group(function () {
        Route::get('/{id}/show', [SignController::class, 'show'])->name('sign.show');
        Route::get('/{id}/edit', [SignController::class, 'edit'])->name('sign.edit');
        Route::put('/{id}/update', [SignController::class, 'update'])->name('sign.update');
        Route::delete('/{id}/delete', [SignController::class, 'delete'])->name('sign.delete');
    });
    
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
        Route::get('/{id}/show', [UserController::class,'show'])->name('user.show');
    
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
        Route::get('/{id}/show', [PelatihanController::class,'show'])->name('pelatihan.show');
    
    });

    Route::prefix('pelatihanfree')->group(function () {
        Route::get('/', [PelatihanfreeController::class,'index'])->name('pelatihanfree.index');
        Route::get('/create', [PelatihanfreeController::class, 'create'])->name('pelatihanfree.create');
        Route::post('/store', [PelatihanfreeController::class, 'store'])->name('pelatihanfree.store');
        Route::get('/{id}/edit', [PelatihanfreeController::class, 'edit'])->name('pelatihanfree.edit');
        Route::put('/{id}/update', [PelatihanfreeController::class,'update'])->name('pelatihanfree.update');
        Route::delete('/{id}/delete', [PelatihanfreeController::class,'destroy'])->name('pelatihanfree.destroy');
        Route::get('/{id}/show',[ PelatihanfreeController::class,'show'])->name('pelatihanfree.show');
    
    });

    # FISHPEDIA VIEW
    //untuk menampilkan view fishpedia

    Route::prefix('fishpedia')->group(function () {
        Route::get('/', [FishpediaController::class,'index'])->name('fishpedia.index');
        Route::get('/create', [FishpediaController::class,'create'])->name('fishpedia.create');
        Route::post('/store', [FishpediaController::class, 'store'])->name('fishpedia.store');
        Route::get('/{id}/edit', [FishpediaController::class, 'edit'])->name('fishpedia.edit');
        Route::put('/{id}/update', [FishpediaController::class, 'update'])->name('fishpedia.update');
        Route::delete('/{id}/delete', [FishpediaController::class, 'destroy'])->name('fishpedia.delete');
        Route::get('/{id}/show', [FishpediaController::class, 'show'])->name('fishpedia.show');
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

    Route::prefix('feedback')->group(function () {
        Route::get('/', [FeedbackController::class,'index'])->name('feedback.index');
        Route::get('/create', [FeedbackController::class,'create'])->name('feedback.create');
        Route::post('/store', [FeedbackController::class, 'store'])->name('feedback.store');
        Route::get('/{id}/edit', [FeedbackController::class, 'edit'])->name('feedback.edit');
        Route::put('/{id}/update', [FeedbackController::class, 'update'])->name('feedback.update');
        Route::delete('/{id}/delete', [FeedbackController::class, 'destroy'])->name('feedback.delete');
        Route::get('/{id}/show', [FeedbackController::class, 'show'])->name('feedback.show');
    
    });

    Route::prefix('pelatih')->group(function () {
        Route::get('/', [PelatihController::class,'index'])->name('pelatih.index');
        Route::get('/create', [PelatihController::class,'create'])->name('pelatih.create');
        Route::post('/store', [PelatihController::class, 'store'])->name('pelatih.store');
        Route::get('/{id}/edit', [PelatihController::class, 'edit'])->name('pelatih.edit');
        Route::put('/{id}/update', [PelatihController::class, 'update'])->name('pelatih.update');
        Route::delete('/{id}/delete', [PelatihController::class, 'destroy'])->name('pelatih.delete');
        Route::get('/{id}/show', [PelatihController::class, 'show'])->name('pelatih.show');
    
    });


});

    Route::get('/search', [SearchController::class, 'search'])->name('search');


