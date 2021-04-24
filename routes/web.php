<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\WineController;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('home', [HomeController::class, 'index'])->name('home');


//Rutas Usuarios
Route::resource('users',UserController::class);
Route::get('perfil',[UserController::class,'profile'])->name('profile');
Route::post('user/edit', [UserController::class,'update'])->name('user.update');
Route::get('user/avatar/{filename}',[UserController::class,'getImage'])->name('user.avatar');

//Ruta Productos
Route::get('wines',[WineController::class,'index']);
Route::resource('wines',WineController::class)->middleware('auth');
Route::get('wine/image/{filename}',[WineController::class,'getImage'])->name('wine.image');

//Ruta Comentarios
Route::post('comments/save', [CommentController::class,'save'])->name('comment.save');
Route::resource('comments',CommentController::class);

//Google login
Route::get('login/google',[LoginController::class,'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback',[LoginController::class,'handleGoogleCallback']);

