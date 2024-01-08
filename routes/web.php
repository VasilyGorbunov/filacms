<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', \App\Http\Controllers\HomeController::class)->name('home');
Route::get('/cart', \App\Http\Controllers\CartController::class)->name('cart');
Route::get('/article/{post:slug}', \App\Http\Controllers\PostController::class)->name('post.show');
Route::get('/products/{product:slug}', \App\Http\Controllers\ProductShowController::class)->name('product.show');
Route::get('/categories/{category:slug}', \App\Http\Controllers\CategoryController::class)->name('category.show');
