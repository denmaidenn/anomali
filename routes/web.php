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



Route::group(['middleware' => ['auth']], function () {

    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');


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
    Route::get('/pelatihan/create', [PelatihanController::class, 'create'])->name('pelatihan.create');
    Route::post('/pelatihan', [PelatihanController::class, 'store'])->name('pelatihan.store');
    Route::resource('pelatihan', PelatihanController::class);
    Route::get('/pelatihan/{id}/edit', [PelatihanController::class, 'edit'])->name('pelatihan.edit');


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

    Route::get('/search', [SearchController::class, 'search'])->name('search');


