<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopListController;
use App\Http\Controllers\ShopReservationController;

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

Route::get('/', [ShopListController::class, 'shopListView'])->name('shop.list');
Route::get('/detail/{shop_id}', [ShopReservationController::class, 'detail'])->name('shop.detail');
Route::get('/thanks', [ShopListController::class, 'thanksView']);

Route::middleware('auth')->group(function () {
    Route::post('/detail/{shop_id}', [ShopReservationController::class, 'reservation']);
    Route::get('/done', [ShopReservationController::class, 'done']);
});
