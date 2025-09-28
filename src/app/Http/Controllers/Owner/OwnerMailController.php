<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Mail\ReservationNotice;
use App\Mail\AllUsersMail;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OwnerMAilController extends Controller
{
    public function showMailForm($shop_id, Request $request)
    {
        $allUsers = $request->input('all_users', 0);
        $shop = Shop::find($shop_id);

        if ($allUsers) {
            $users = User::all();

            return view('owner.mail_form', compact('users', 'allUsers', 'shop'));
        } else {
            $reservationIds = $request->input('reservation_ids', []);

            $reservations = Reservation::with('user', 'shop')->whereIn('id', $reservationIds)->get();

            return view('owner.mail_form', compact('reservations', 'allUsers'));
        }
    }

    public function send(Request $request)
    {
        if ($request->filled('reservation_ids')) {
            $reservations = Reservation::with('user', 'shop')->whereIn('id', $request->reservation_ids)->get();

            foreach ($reservations as $reservation) {
                Mail::to($reservation->user->email)->send(new ReservationNotice(
                    $reservation,
                    $request->subject,
                    $request->body,
                ));
            }

            $message = '選択した予約の利用者にメールを送信しました';

        } elseif($request->filled('user_ids')) {
            $users = User::whereIn('id', $request->user_ids)->where('role', 'user')->get();
            $shop = Shop::find($request->shop_id);

            foreach ($users as $user) {
                Mail::to($user->email)->send(new AllUsersMail(
                    $user,
                    $shop,
                    $request->subject,
                    $request->body,
                ));
            }

            $message = '全ユーザーにメールを送信しました';

        } else {
            $message = '送信先が選択されていません。';
        }
        

        return back()->with('success', $message);
    }
}
