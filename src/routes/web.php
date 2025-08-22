<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopListController;
use App\Http\Controllers\ShopReservationController;
use App\Http\Controllers\Auth\MyCustomRegisteredUserController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MypageController;

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

Route::get('/', [ShopListController::class, 'index'])->name('shop.list');
Route::get('/detail/{shop_id}', [ShopReservationController::class, 'detail'])->name('shop.detail');
Route::get('/thanks', [MyCustomRegisteredUserController::class, 'thanksView']);

Route::middleware('auth')->group(function () {
    Route::post('/detail/{shop_id}', [ShopReservationController::class, 'reservation']);
    Route::get('/done', [ShopReservationController::class, 'done']);
    Route::post('/like/{shop_id}', [LikeController::class, 'like']);
    Route::post('/unlike/{shop_id}', [LikeController::class, 'unlike']);
    Route::get('/mypage', [MypageController::class, 'mypageView']);
    Route::post('/delete/{reservation_id}', [ShopReservationController::class, 'destroy']);
    Route::post('/update/{reservation_id}', [ShopReservationController::class, 'update']);
});
