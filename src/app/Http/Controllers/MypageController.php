<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Reservation;
use App\Models\Shop;

class MypageController extends Controller
{
    public function mypageView()
    {
        $user = Auth::user();

        $now = Carbon::now();

        $page = request()->query('page', 'reservation');

        if ($page === 'reservation') {
            $reservations = Reservation::with('shop')->where('user_id', $user->id)->where('checked_in', false)->get();
        } elseif ($page === 'visited') {
            $reservations = Reservation::with('shop.area', 'shop.genre')->where('user_id', $user->id)->where('checked_in', true)->get();
        }

        $shops = Shop::whereHas('likedByUsers', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        return view('mypage', compact('user', 'reservations', 'shops', 'page'));
    }
}
