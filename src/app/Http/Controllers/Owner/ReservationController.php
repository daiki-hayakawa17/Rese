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
        $page = request()->query('page', 'reservation');

        $shop = Shop::with(['reservations.user'])->find($shop_id);

        if ($page === 'reservation') {
            $reservations = $shop->reservations()->where('checked_in', false)->get();
        } elseif ($page === 'visited') {
            $reservations = $shop->reservations()->where('checked_in', true)->get();
        }

        return view('owner.reservation', compact('shop', 'reservations', 'page'));
    }
}
