<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Reservation;
use App\Http\Requests\ReservationRequest;

class ShopReservationController extends Controller
{
    public function detail($shop_id)
    {
        $shop = Shop::with(['area', 'genre'])->find($shop_id);

        return view('detail', compact('shop'));
    }

    public function reservation($shop_id, ReservationRequest $request)
    {
        $user = Auth::user();

        $Reservation = Reservation::create([
            'user_id' => $user->id,
            'shop_id' => $shop_id,
            'date' => $request->date,
            'time' => $request->time,
            'number' => $request->number,
        ]);

        session(['reserved_shop_id' => $Reservation->shop_id]);

        return redirect('/done');
    }

    public function done()
    {
        $shop_id = session('reserved_shop_id');
        return view('done', compact('shop_id'));
    }

    public function destroy($reservation_id)
    {
        $reservation = Reservation::find($reservation_id)->delete();

        return redirect('/mypage');
    }

    public function update($reservation_id, ReservationRequest $request)
    {
        Reservation::find($reservation_id)->update([
            'date' => $request->date,
            'time' => $request->time,
            'number' => $request->number,
        ]);

        return redirect('/mypage');
    }
}
