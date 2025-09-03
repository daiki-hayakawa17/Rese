@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')
    <div class="detail__content">
        <div class="left__content">
            <div class="shop__title">
                <a class="back__button" href= "{{ url()->previous() }}">
                    <img src="{{ asset('images/arrow_left.png') }}" alt="戻るボタン">
                </a>
                <h2 class="shop__name">{{ $shop->name }}</h2>
            </div>
            <img src="{{ asset($shop->image) }}" alt="お店画像" class="shop__image">
            <p class="shop__tag">#{{$shop->area->name}} #{{$shop->genre->content}}</p>
            <p class="shop__description">
                {{ $shop->description }}
            </p>
        </div>
        <form class="right__content" action="/review/{{$shop->id}}" method="POST">
            @csrf
            <h2 class="content__title">評価とレビュー</h2>
            <div class="rating">
                <h3 class="rating__title">評価</h3>
                <input type="radio" id="star5" name="rating" value="5">
                <label for="star5">★</label>
                <input type="radio" id="star4" name="rating" value="4">
                <label for="star4">★</label>
                <input type="radio" id="star3" name="rating" value="3">
                <label for="star3">★</label>
                <input type="radio" id="star2" name="rating" value="2">
                <label for="star2">★</label>
                <input type="radio" id="star1" name="rating" value="1">
                <label for="star1">★</label>
            </div>
            <div class="review">
                <h3 class="review__title">レビュー</h3>
                <textarea name="comment" rows="10" cols="40"></textarea>
            </div>
            <div class="form__button">
                <button class="form__button--submit">投稿する</button>
            </div>
        </form>
    </div>
@endsection