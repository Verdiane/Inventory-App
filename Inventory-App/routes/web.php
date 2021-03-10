<?php

use Illuminate\Support\Facades\Route;
use App\Models\Inventory;
use App\Models\Order;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;

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

Route::resource('/inventories', 'InventoryController');

Route::get('/inventories', 'InventoryController@index')->name('inventories.index');

Route::resource('/orders', 'OrderController');

Route::get('/order', 'InventoryController@order')->name('inventories.order');