<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class ShopReservationController extends Controller
{
    public function detail($shop_id)
    {
        $shop = Shop::with(['area', 'genre'])->find($shop_id);

        // dd($shop);

        return view('detail', compact('shop'));
    }
}
