<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\FishmartController;
use App\Http\Controllers\FishpediaController;

//menampilkan view sign
Route::get('/', function () {
    return view('sign.index', ['title' => 'Sign In']);
});

//untuk mengirim data signin lalu ke dashboard
Route::post('/signin' , [SignController::class,'in']);
Route::get('/dashboard', [DashboardController::class,'index']);



//untuk mengirim form data user ke view userdata 
Route::get('/formuser', [UserController::class,'formuser']);
Route::post('/formuser', [FormController::class,'submitForm']);
Route::get('/userpages', [UserController::class,'index']);
//Untuk edit Form data User
Route::get('/edituser{id}', [UserController::class,'edituser'])->name('edituser');
Route::post('/updateuser{id}', [UserController::class,'update'])->name('updateuser');



//untuk menampilkan view pelatihan
Route::get('/pelatihan', [PelatihanController::class,'index']);
//untuk menampilkan view fishpedia
Route::get('/fishpedia', [FishpediaController::class,'index']);

//untuk menampilkan view fishmart
Route::get('/fishmart', [FishmartController::class,'index']);










