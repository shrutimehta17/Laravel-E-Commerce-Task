<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('login-page');

Route::get('/sign-up', function () {
    return view('sign_up');
})->name('sign-up');

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/user-sign-up', [LoginController::class, 'signUp'])->name('user-sign-up');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add-to-cart');
});
