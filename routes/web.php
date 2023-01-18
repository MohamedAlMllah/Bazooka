<?php

use App\Models\Shop;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/shops/{shop}/tables/{table}/pricing', [App\Http\Controllers\TableController::class, 'pricing'])->name('pricing');
Route::post('/shops/{shop}/tables/{table}/pricing', [App\Http\Controllers\TableController::class, 'updatePricing'])->name('updatePricing');
Route::get('/shops/{shop}/employment', [App\Http\Controllers\ShopController::class, 'employment'])->name('employment');
Route::post('/shops/{shop}/hire', [App\Http\Controllers\ShopController::class, 'hire'])->name('hire');
Route::post('/shops/{shop}/users/{user}/fire', [App\Http\Controllers\ShopController::class, 'fire'])->name('fire');
Route::get('/shops/{shop}/menu', [App\Http\Controllers\ShopController::class, 'menu'])->name('menu');

Route::get('/users-managment', [App\Http\Controllers\HomeController::class, 'usersManagment'])->name('usersManagment');
Route::post('/find-user', [App\Http\Controllers\HomeController::class, 'findUser'])->name('findUser');

Route::resource('shops', 'App\Http\Controllers\ShopController')->only(['edit', 'update', 'show'])->middleware('can:isOwner');
Route::resource('shops', 'App\Http\Controllers\ShopController')->only(['create', 'store', 'destroy'])->middleware('can:isAdmin');
Route::resource('shops.tables', 'App\Http\Controllers\TableController')->middleware('can:isOwner');
Route::resource('shops.categories', 'App\Http\Controllers\CategoryController')->middleware('can:isOwner');
Route::resource('shops.categories.items', 'App\Http\Controllers\ItemController')->middleware('can:isOwner');
