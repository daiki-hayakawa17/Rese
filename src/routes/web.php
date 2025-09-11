<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopListController;
use App\Http\Controllers\ShopReservationController;
use App\Http\Controllers\Auth\MyCustomRegisteredUserController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\OwnerController;
use App\Http\Controllers\Owner\ShopController;

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
    Route::get('/mypage', [MypageController::class, 'mypageView'])->name('mypage');
    Route::post('/delete/{reservation_id}', [ShopReservationController::class, 'destroy']);
    Route::post('/update/{reservation_id}', [ShopReservationController::class, 'update']);
    Route::get('/review/{shop_id}', [ReviewController::class, 'createView']);
    Route::post('/review/{shop_id}', [ReviewController::class, 'store']);
});

Route::get('admin/login', function () {
    return view('admin.login');
})->name('admin.login');


Route::middleware('admin')->group(function () {
    Route::get('/admin/owner/create', [OwnerController::class, 'create']);
    Route::post('/admin/owner/create', [OwnerController::class, 'store']);
});

Route::get('/owner/login', function () {
    return view('owner.login');
})->name('owner.login');

Route::middleware('owner')->group(function () {
    Route::get('/owner/shop/create', [ShopController::class, 'create']);
    Route::post('/owner/shop/create', [ShopController::class, 'store']);
    Route::get('/owner/shop/list', [ShopController::class, 'list']);
    Route::get('/owner/shop/detail/{shop_id}', [ShopController::class, 'detail']);
    Route::post('/owner/shop/detail/{shop_id}', [ShopController::class, 'update']);
});