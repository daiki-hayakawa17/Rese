@extends('layouts.owner.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/owner/reservation.css') }}">
@endsection

@section('content')
    <h2 class="reservation__title">{{ $shop->name }}の予約状況</h2>
    <div class="reservation__contents">
        @foreach($reservations as $reservation)
            <div class="reservation__content">
                <table class="reservation__information">
                <tr>
                    <th>User</th>
                    <td>{{ $reservation->user->name }}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ $reservation->date }}</td>
                </tr>
                <tr>
                    <th>Time</th>
                    <td>{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</td>
                </tr>
                <tr>
                    <th>Numer</th>
                    <td>{{ $reservation->number }}人</td>
                </tr>
            </table>
            </div>
        @endforeach
    </div>
@endsection