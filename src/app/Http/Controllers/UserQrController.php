<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserQrController extends Controller
{
    public function show($reservation_id)
    {
        $reservation = Reservation::with('shop')->find($reservation_id);
        $url = route('checkin.verify', ['reservation_id' => $reservation->id]);
        $qr = QrCode::size(200)->generate($url);

        return view('qr', compact('reservation', 'qr', 'url'));
    }
}
