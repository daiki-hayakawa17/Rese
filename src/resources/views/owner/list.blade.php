@extends('layouts.owner.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner/list.css') }}">
@endsection

@section('content')
    <form class="search__form" action="/owner/shop/list" method="GET">
        <div class="input__group">
            <div class="search__icon">
                <img src="{{ asset('images/search.png') }}" alt="虫眼鏡アイコン">
            </div>
            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Search">
        </div>
    </form>
    <div class="shop__contents">
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
                    <a href="/owner/shop/detail/{{$shop->id}}" class="detail__link">
                        店舗詳細
                    </a>
                    <div class="review">
                        <p class="review__star">★</p>
                        <p class="review__number">{{ number_format($shop->average_rating, 1) }}</p>
                    </div>
                </form>
            </div>
        @endforeach
    </div>
@endsection