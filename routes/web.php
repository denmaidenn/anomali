<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\FishmartController;
use App\Http\Controllers\FishpediaController;

# AUTHENTICATION
//menampilkan view sign
Route::get('/', function () {
    return view('sign.index', ['title' => 'Sign In']);
});

//untuk mengirim data signin lalu ke dashboard
Route::get('/signin' , [SignController::class,'index'])->name('login');
Route::post('/signin' , [SignController::class,'in']);

Route::group(['middleware' => ['auth']], function () {
    
    Route::get('/dashboard', [DashboardController::class,'index']);
    
    
    //untuk logout
    Route::post('/logout', [SignController::class,'logout']);
    
    
    # USER VIEW
    //untuk mengirim form data user ke view userdata 
    Route::get('/formuser', [UserController::class,'formuser_page']);
    Route::post('/formuser', [FormController::class,'submitForm']);
    Route::get('/userpages', [UserController::class,'index'])->name('userpages');
    
    //Untuk edit Form data User
    Route::get('/manageuser/{id}', [UserController::class,'manageuser_page'])->name('manageuser');
    Route::put('/manageuser/{id}', [FormController::class,'update'])->name('updateuser');
    
    //Untuk delete data yang ada di form
    Route::delete('/deleteuser/{id}', [FormController::class,'delete'])->name('deleteuser');
    
    
    # PELATIHAN VIEW
    //untuk menampilkan view pelatihan
    Route::get('/pelatihan', [PelatihanController::class,'index']);
    //untuk menampilkan view fishpedia
    Route::get('/fishpedia', [FishpediaController::class,'index']);
    Route::get('/tambahikan', [FishpediaController::class,'tambahikan_page']);
    Route::post('/fishpedia/store', [FishpediaController::class, 'store'])->name('fish.store');
    Route::get('/fishpedia/manage/{id}', [FishpediaController::class, 'edit'])->name('manageikan');
    Route::put('/fishpedia/update/{id}', [FishpediaController::class, 'update'])->name('updateikan');
    Route::delete('/fishpedia/delete/{id}', [FishpediaController::class, 'destroy'])->name('deleteikan');
    
    //untuk menampilkan view fishmart
    Route::get('/fishmart', [FishmartController::class,'index']);
    });
    
    
    