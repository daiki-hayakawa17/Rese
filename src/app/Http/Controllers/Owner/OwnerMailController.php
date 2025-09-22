<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Mail\ReservationNotice;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OwnerMAilController extends Controller
{
    public function showMailForm(Request $request)
    {
        $reservationIds = $request->input('reservation_ids', []);

        $reservations = Reservation::with('user', 'shop')->whereIn('id', $reservationIds)->get();

        return view('owner.mail_form', compact('reservations'));
    }

    public function send(Request $request)
    {
        $reservations = Reservation::with('user', 'shop')->whereIn('id', $request->reservation_ids)->get();

        foreach ($reservations as $reservation) {
            Mail::to($reservation->user->email)->send(new ReservationNotice(
                $reservation,
                $request->subject,
                $request->body,
            ));
        }

        return back()->with('success', 'メールを送信しました！');
    }
}
