<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ShopListController;
use App\Http\Controllers\ShopReservationController;
use App\Http\Controllers\Auth\MyCustomRegisteredUserController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\OwnerController;
use App\Http\Controllers\Owner\ShopController;
use App\Http\Controllers\Owner\ReservationController;
use App\Http\Controllers\Owner\OwnerMailController;

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

Route::middleware('auth', 'verified')->group(function () {
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

Route::get('/email/verift', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill(); // 認証完了
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/admin/login', function () {
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
    Route::get('/owner/shop/detail/{shop_id}/reservation', [ReservationController::class, 'list'])->name('owner.reservation.list');
    Route::post('/owner/shop/detail/{shop_id}/reservation', [OwnerMailController::class, 'showMailForm'])->name('owner.mail.form');
    Route::post('/owner/reservation/mail', [OwnerMailController::class, 'send'])->name('owner.mail.send');
});