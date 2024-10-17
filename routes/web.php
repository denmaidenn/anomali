<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\DashboardController;

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

//untuk menampilkan view pelatihan
Route::get('/pelatihan', [])
//untuk menampilkan view fishpedia

//untuk menampilkan view fishmart


//Edit Form User
Route::get('/edituser', [UserController::class,'edituser']);






