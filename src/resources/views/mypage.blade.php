@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
    <h2 class="user__name">{{ $user->name }}さん</h2>
    <div class="mypage__content">
        <div class="reservation__information">
            <div class="information__tab">
                <a class="reservation__tab {{ request('page', 'reservation') === 'reservation' ? 'active' : '' }}" href="{{ route('mypage', ['page' => 'reservation']) }}">予約状況</a>
                <a class="visited__tab {{ request('page') === 'visited' ? 'active' : '' }}" href="{{ route('mypage', ['page' => 'visited']) }}">来店履歴</a>
            </div>
            @if ($page === 'reservation')
                @foreach ($reservations as $reservation)
                    <div class="information__inner">
                        <form  class="information__inner--header" action="/delete/{{ $reservation->id }}" method="post">
                            @csrf
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
                                    <td>
                                        <input type="date" name="date" value="{{ $reservation->date }}">
                                        <div class="form__error">
                                            @error('date')
                                                {{ $message }}   
                                            @enderror
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Time</th>
                                    <td>
                                        <input type="time" name="time" value="{{ $reservation->time }}">
                                        <div class="form__error">
                                            @error('time')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Number</th>
                                    <td>
                                        <select class="number__select" name="number">
                                            @for ($i = 1; $i <=100; $i++)
                                                <option value="{{ $i }}" {{ $reservation->number == $i ? 'selected' : '' }}>{{ $i }}人</option>
                                            @endfor
                                        </select>
                                        <div class="form__error">
                                            @error('number')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <div class="update__button">
                                <button class="update__button--submit">変更</button>
                            </div>
                        </form>
                    </div>
                @endforeach
            @elseif ($page === 'visited')
                @foreach ($reservations as $reservation)
                    <div class="visited__information">
                        <div class="visited__shop--image">
                            <img src="{{ asset($reservation->shop->image) }}" alt="お店画像">
                        </div>
                        <div class="visited__shop--information">
                            <p class="visited__shop--name">{{ $reservation->shop->name }}</p>
                            <p class="visited__shop--area">{{ $reservation->shop->area->name }}</p>
                            <p class="visited__shop--genre">{{ $reservation->shop->genre->content }}</p>
                        </div>
                    </div>
                    <div class="visited__shop--reservation">
                        <p class="visited__reservation--title">予約日時</p>
                        <p class="visited__reservation--datetime">{{ \Carbon\Carbon::parse($reservation->date)->isoformat('YYYY年M月D日(ddd)') }} {{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</p>
                    </div>
                    <div class="visited__shop--number">
                        <p class="visited__number--title">人数</p>
                        <p class="visited__number">{{ $reservation->number }}人</p>
                    </div>
                    <div class="review__link">
                        <a class="review__link--button" href="/review">口コミを投稿する</a>
                    </div>
                @endforeach        
            @endif
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