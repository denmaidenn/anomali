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
Route::get('/signin' , [SignController::class,'in'])->name('login');
Route::post('/signin' , [SignController::class,'in']);
Route::get('/dashboard', [DashboardController::class,'index'])->middleware('auth');


//untuk logout
Route::post('/logout', [SignController::class,'logout'])->middleware('auth');


//untuk mengirim form data user ke view userdata 
Route::get('/formuser', [UserController::class,'formuser'])->middleware('auth');
Route::post('/formuser', [FormController::class,'submitForm'])->middleware('auth');
Route::get('/userpages', [UserController::class,'index'])->middleware('auth');

//Untuk edit Form data User
Route::get('/edituser', [UserController::class,'edituser'])->middleware('auth');

//untuk menampilkan view pelatihan
Route::get('/pelatihan', [PelatihanController::class,'index'])->middleware('auth');
//untuk menampilkan view fishpedia
Route::get('/fishpedia', [FishpediaController::class,'index'])->middleware('auth');
//untuk menampilkan view fishmart
Route::get('/fishmart', [FishmartController::class,'index'])->middleware('auth');










