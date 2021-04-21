<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\WineController;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Rutas Usuarios
Route::resource('users',UserController::class);
Route::get('perfil',[UserController::class,'profile'])->name('profile');
Route::post('user/edit', [UserController::class,'update'])->name('user.update');
Route::get('user/avatar/{filename}',[UserController::class,'getImage'])->name('user.avatar');

//Ruta Productos
Route::resource('wines',WineController::class);
Route::get('wine/image/{filename}',[WineController::class,'getImage'])->name('wine.image');

//Google login
Route::get('login/google',[LoginController::class,'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback',[LoginController::class,'handleGoogleCallback']);
