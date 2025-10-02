<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Reservation;
use App\Models\Course;
use App\Http\Requests\ReservationRequest;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class ShopReservationController extends Controller
{
    public function detail($shop_id)
    {
        $shop = Shop::with(['area', 'genre', 'reviews'])->find($shop_id);

        $reviews = $shop->reviews;

        $courses = Course::all();

        return view('detail', compact('shop', 'reviews', 'courses'));
    }

    public function reservation($shop_id, ReservationRequest $request)
    {
        $user = Auth::user();

        $reservation = Reservation::create([
            'user_id' => $user->id,
            'shop_id' => $shop_id,
            'course_id' => $request->course,
            'date' => $request->date,
            'time' => $request->time,
            'number' => $request->number,
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $course = $reservation->course;

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $course->name,
                    ],
                    'unit_amount' => $course->price,
                ],
                'quantity' => $reservation->number,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success'),
            'cancel_url' => route('shop.list'),
            ]);

        return redirect($session->url);
    }

    public function done()
    {
        return view('done');
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
