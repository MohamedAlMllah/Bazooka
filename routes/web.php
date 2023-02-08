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

Route::get('/tables/{table}/management', [App\Http\Controllers\TableController::class, 'management'])->name('management')->middleware('can:isOwnerOrEmployee');
Route::get('/tables/{table}/order-check', [App\Http\Controllers\TableController::class, 'orderCheck'])->name('orderCheck')->middleware('can:isOwnerOrEmployee');
Route::get('/tables/{table}/items-list', [App\Http\Controllers\TableController::class, 'itemsList'])->name('itemsList')->middleware('can:isOwnerOrEmployee');
Route::get('/tables/{table}/send-order-items', [App\Http\Controllers\OrderItemController::class, 'sendOrderItems'])->name('sendOrderItems')->middleware('can:isOwnerOrEmployee');

Route::get('/shops/{shop}/tables/{table}/pricing', [App\Http\Controllers\TableController::class, 'pricing'])->name('pricing')->middleware('can:isOwner');
Route::post('/shops/{shop}/tables/{table}/pricing', [App\Http\Controllers\TableController::class, 'updatePricing'])->name('updatePricing')->middleware('can:isOwner');
Route::get('/shops/{shop}/employment', [App\Http\Controllers\ShopController::class, 'employment'])->name('employment')->middleware('can:isOwner');
Route::post('/shops/{shop}/hire', [App\Http\Controllers\ShopController::class, 'hire'])->name('hire')->middleware('can:isOwner');
Route::post('/shops/{shop}/users/{user}/fire', [App\Http\Controllers\ShopController::class, 'fire'])->name('fire')->middleware('can:isOwner');
Route::get('/shops/{shop}/menu', [App\Http\Controllers\ShopController::class, 'menu'])->name('menu')->middleware('can:isOwner');

Route::get('/users-managment', [App\Http\Controllers\HomeController::class, 'usersManagment'])->name('usersManagment')->middleware('can:isAdmin');
Route::post('/find-user', [App\Http\Controllers\HomeController::class, 'findUser'])->name('findUser')->middleware('can:isAdmin');

Route::resource('shops', 'App\Http\Controllers\ShopController')->only(['edit', 'update', 'show'])->middleware('can:isOwner');
Route::resource('shops', 'App\Http\Controllers\ShopController')->only(['create', 'store', 'destroy'])->middleware('can:isAdmin');
Route::resource('shops.tables', 'App\Http\Controllers\TableController')->middleware('can:isOwner');
Route::resource('shops.categories', 'App\Http\Controllers\CategoryController')->middleware('can:isOwner');
Route::resource('shops.categories.items', 'App\Http\Controllers\ItemController')->middleware('can:isOwner');
Route::resource('tables.items.orderItems', 'App\Http\Controllers\OrderItemController')->middleware('can:isOwnerOrEmployee');
Route::resource('tables.periods', 'App\Http\Controllers\PeriodController')->middleware('can:isOwnerOrEmployee');
