<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Carbon\Carbon;

class CheckinController extends Controller
{
    public function verify($reservation_id)
    {
        $reservation = Reservation::with('shop')->find($reservation_id);

        if ($reservation->checked_in) {
            return view('owner.result', [
                'message' => 'この予約はすでにチェックイン済みです。',
                'status' => 'already'
            ]);
        }

        $reservation->update([
            'checked_in' => true,
            'checked_in_at' => Carbon::now(),
        ]);

        return view('owner.result', [
            'message' => "{$reservation->shop->name}の予約がチェックイン完了しました。",
            'status' => 'success'
        ]);
    }
}
