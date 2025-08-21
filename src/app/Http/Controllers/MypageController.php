<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Shop;

class MypageController extends Controller
{
    public function mypageView()
    {
        $user = Auth::user();

        $reservations = Reservation::with('shop')->where('user_id', $user->id)->get();

        $shops = Shop::whereHas('likedByUsers', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        return view('mypage', compact('user', 'reservations', 'shops'));
    }
}
