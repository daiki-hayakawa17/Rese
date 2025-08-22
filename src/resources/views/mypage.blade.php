@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
    <h2 class="user__name">{{ $user->name }}さん</h2>
    <div class="mypage__content">
        <div class="reservation__information">
            <h3 class="information__title">予約状況</h3>
            @foreach ($reservations as $reservation)
                <div class="information__inner">
                    @csrf
                    <form  class="information__inner--header" action="/delete/{{ $reservation->id }}" method="post">
                        <img src="{{ asset('images/clock.png') }}" class="clock__image">
                        <p class="inner__header--text">予約{{ $loop->iteration }}</p>
                        <button class="delete__button" type="submit" name="action_type" value="">
                            <img src="{{ asset('images/close.png') }}" class="close__image">
                        </button>
                    </form>
                    <form class="update__form" action="/update/{{ $reservation->id }}" method="post">
                        @csrf
                        <table class="shop__information">
                            <tr>
                                <th>Shop</th>
                                <td>{{ $reservation->shop->name }}</td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td><input type="date" name="date" value="{{ $reservation->date }}"></td>
                            </tr>
                            <tr>
                                <th>Time</th>
                                <td><input type="time" name="time" value="{{ $reservation->time }}"></td>
                            </tr>
                            <tr>
                                <th>Numer</th>
                                <td>
                                    <select class="number__select" name="number">
                                        @for ($i = 1; $i <=100; $i++)
                                            <option value="{{ $i }}" {{ $reservation->number == $i ? 'selected' : '' }}>{{ $i }}人</option>
                                        @endfor
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <div class="update__button">
                            <button class="update__button--submit">変更</button>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
        <div class="liked__shops">
            <h3 class="liked__shops--title">お気に入り店舗</h3>
            <div class="liked__shop--cards">
                @foreach ($shops as $shop)
                    <div class="shop__card">
                        <img src="{{ asset($shop->image) }}" alt="お店画像">
                        <p class="shop__name">
                            {{ $shop->name }}
                        </p>
                        <p class="shop__tag">
                            #{{ $shop->area->name }} #{{ $shop->genre->content }}
                        </p>
                        <form class="flex" action="/unlike/{{$shop->id}}" method="post">
                            @csrf
                            <a href="/detail/{{$shop->id}}" class="detail__link">
                                詳しくみる
                            </a>
                            <button class="favorite__button">
                                <img src="{{ asset('images/favorite_red.png')}}">
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection