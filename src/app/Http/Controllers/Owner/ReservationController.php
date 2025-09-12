<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Shop;

class ReservationController extends Controller
{
    public function list($shop_id)
    {
        $shop = Shop::with(['reservations.user'])->find($shop_id);

        $reservations = $shop->reservations;

        return view('owner.reservation', compact('shop', 'reservations'));
    }
}
