<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ReservationNotice;
use App\Mail\AllUsersMail;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Shop;
use App\Http\Requests\MailRequest;
use Illuminate\Support\Facades\Mail;

class OwnerMailController extends Controller
{
    public function storeTargets($shop_id, Request $request)
    {
        $allUsers = $request->input('all_users', 0);
        $shop = Shop::find($shop_id);

        if ($allUsers) {
            session([
                'mail_targets' => [
                    'type' => 'all',
                    'shop_id' => $shop_id,
                ],
            ]);
        } else {
            session([
                'mail_targets' => [
                    'type' => 'reservation',
                    'reservation_ids' => $request->input('reservation_ids', []),
                    'shop_id' => $shop_id,
                ],
            ]);
        }

        return redirect()->route('owner.mail.form', ['shop_id' => $shop->id]);
    }

    public function showMailForm($shop_id)
    {
        $targets = session('mail_targets');
        $shop = Shop::find($shop_id);

        if (!$targets) {
            return redirect()->back()->with('error', '送信対象が見つかりません。');
        }

        $allUsers = $targets['type'] === 'all';

        if ($allUsers) {
            $users = User::where('role', 'user')->get();
            return view('owner.mail_form', compact('users', 'allUsers', 'shop'));
        } else {
            $reservations = Reservation::with('user', 'shop')->whereIn('id', $targets['reservation_ids'])->get();
            return view('owner.mail_form', compact('reservations', 'allUsers', 'shop'));
        }
    }

    public function send(MailRequest $request)
    {
        $targets = session('mail_targets');
        $message = '';

        if ($targets['type'] === 'reservation') {
            $reservations = Reservation::with('user', 'shop')->whereIn('id', $targets['reservation_ids'])->get();

            foreach ($reservations as $reservation) {
                Mail::to($reservation->user->email)->send(new ReservationNotice(
                    $reservation,
                    $request->subject,
                    $request->body,
                ));
            }

            $message = '選択した予約の利用者にメールを送信しました';

        } else {
            $users = User::where('role', 'user')->get();
            $shop = Shop::find($targets['shop_id']);

            foreach ($users as $user) {
                Mail::to($user->email)->send(new AllUsersMail(
                    $user,
                    $shop,
                    $request->subject,
                    $request->body,
                ));
            }

            $message = '全ユーザーにメールを送信しました';
        }
        
        session()->forget('mail_targets');

        return redirect()->route('owner.reservation.list', ['shop_id' => $targets['shop_id']])->with('success', $message);
    }
}
