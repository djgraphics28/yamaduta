<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;

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

Route::get('/', function () {
    return view('yamaduta.index');
});

Route::get('/shop', [FrontendController::class, 'shop'])->name('shop');
Route::get('/about-us', [FrontendController::class, 'aboutUs'])->name('aboutUs');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');

Route::get('/product/{product}', [FrontendController::class, 'show'])->name('show.product');


Route::post('/cart', [FrontendController::class, 'addToCart'])->name('cart.store');
Route::get('/cart', [FrontendController::class, 'cartList'])->name('cart.list');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
