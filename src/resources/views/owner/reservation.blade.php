@extends('layouts.owner.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/owner/reservation.css') }}">
@endsection

@section('content')
    <h2 class="reservation__title">{{ $shop->name }}の予約状況</h2>
    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    <div class="information__tab">
        <a class="reservation__tab {{ request('page', 'reservation') === 'reservation' ? 'active' : '' }}" href="{{ route('owner.reservation.list', ['shop_id' => $shop->id, 'page' => 'reservation']) }}">予約状況</a>
        <a class="visited__tab {{ request('page') === 'visited' ? 'active' : '' }}" href="{{ route('owner.reservation.list', ['shop_id' => $shop->id, 'page' => 'visited']) }}">過去の予約</a>
    </div>
    <form action="{{ route('owner.mail.form.store', ['shop_id' => $shop->id]) }}" method="POST">
        @csrf
        <div class="reservation__contents">
            @foreach($reservations as $reservation)
                <div class="reservation__content">
                    <input type="checkbox" name="reservation_ids[]" value="{{ $reservation->id }}" data-user="{{ $reservation->user_id }}" class="reservation-checkbox">
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
        <div class="form__button">
            <button type="submit" class="form__button--submit" name="all_users" value="0">選択したユーザーにメール作成</button>
        </div>
    </form>
    <form action="{{ route('owner.mail.form.store', ['shop_id' => $shop->id]) }}" method="POST" class="all__user--form">
        @csrf
        <button class="all__user--button" name="all_users" value="1">全ユーザーにメール作成</button>
    </form>
@endsection

@section('script')
    <script>
        document.querySelectorAll('.reservation-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    const userId = this.dataset.user;

                    document.querySelectorAll(`.reservation-checkbox[data-user="${userId}"]`).forEach(cb => {
                        if (cb !== this) {
                            cb.checked = false;
                        }
                    });
                }
            });
        });
    </script>
@endsection