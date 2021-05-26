<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\WineController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
//use App\Http\Controllers\PaymentController;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('home', [HomeController::class, 'index'])->name('home');


//Rutas Usuarios
Route::resource('users',UserController::class);
Route::get('perfil',[UserController::class,'profile'])->name('profile');
Route::post('user/edit', [UserController::class,'update'])->name('user.update');
Route::get('user/{user_id}',[UserController::class,'destroy'])->name('user.delete');
Route::get('user/avatar/{filename}',[UserController::class,'getImage'])->name('user.avatar');


//Rutas Vinos
Route::get('wines',[WineController::class,'index']);
Route::resource('wines',WineController::class)->middleware('auth');
Route::get('wine/image/{filename}',[WineController::class,'getImage'])->name('wine.image');
Route::get('tintos',[WineController::class,'tintos'])->name('wine.tintos');
Route::get('rosados',[WineController::class,'rosados'])->name('wine.rosados');
Route::get('blancos',[WineController::class,'blancos'])->name('wine.blancos');
Route::get('topUsers',[WineController::class,'topUsers'])->name('topUsers');

//Rutas Comentarios
Route::post('comments/save', [CommentController::class,'save'])->name('comment.save');
Route::resource('comments',CommentController::class);

// Rutas Likes
Route::get('like/{wine_id}',[LikeController::class,'like'])->name('like.save');
Route::get('dislike/{wine_id}',[LikeController::class,'dislike'])->name('like.delete');


//Rutas Favoritos
Route::get('favourite/{wine_id}',[FavouriteController::class,'favourite'])->name('favourite.save');
Route::get('quitfavourite/{wine_id}',[FavouriteController::class,'quitFavourite'])->name('favourite.delete');
Route::get('favourites',[FavouriteController::class,'showFavourites'])->name('favourites');
Route::get('topSumiller',[FavouriteController::class,'favouritesSumiller'])->name('topSumiller');

//Rutas Carrito
Route::post('/cart-add',[CartController::class,'add'])->name('cart.add');
Route::get('/cart-checkout',[CartController::class,'checkout'])->name('cart.checkout');
Route::post('/cart-delete',[CartController::class,'delete'])->name('cart.delete');
Route::post('/cart-removeproduct',[CartController::class,'removeproduct'])->name('cart.removeproduct');
Route::post('/cart/procesopedido',[CartController::class,'procesopedido'])->name('cart.procesopedido');

//Ruta Pedidos
Route::get('orders',[OrderController::class,'index']);
Route::get('orders/{order_id}',[OrderController::class,'details'])->name('details');

//Ruta de contacto
Route::get('/contact',[ContactController::class,'index'])->name('contact.index')->middleware('auth');
Route::post('/contact',[ContactController::class,'store'])->name('contact.store')->middleware('auth');

//Google login
Route::get('login/google',[LoginController::class,'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback',[LoginController::class,'handleGoogleCallback']);

//Paypal
//Route::get('/paypal/pay',[PaymentController::class,'payWithPaypal']);
//Route::get('/paypal/status',[PaymentController::class,'payPaypalStatus']);
