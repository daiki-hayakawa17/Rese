@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/list.css') }}">
@endsection

@section('content')
    <form class="search__form" action="/" method="GET">
        <select name="area_id">
            <option value="">All area</option>
            @foreach ($areas as $area)
                <option value="{{ $area->id }}" {{ request('area_id') == $area->id ? 'selected' : '' }}>    
                    {{ $area->name }}
                </option>
            @endforeach
        </select>
        <select name="genre_id">
            <option value="">All genre</option>
            @foreach ($genres as $genre)
                <option value="{{ $genre->id }}" {{ request('genre_id') == $genre->id ? 'selected' : '' }}>
                    {{ $genre->content }}
                </option>
            @endforeach
        </select>
        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Search">
    </form>
    <div class="shop__contents">
        @foreach ($shops as $shop)
        @php
            $liked = $shop->likedByUsers->contains('id', Auth::id())
        @endphp
            <div class="shop__card">
                <img src="{{ asset($shop->image) }}" alt="お店画像">
                <p class="shop__name">
                    {{ $shop->name }}
                </p>
                <p class="shop__tag">
                    #{{ $shop->area->name }} #{{ $shop->genre->content }}
                </p>
                @if ($liked)
                    <form class="flex" action="/unlike/{{$shop->id}}" method="post">
                        @csrf
                        <a href="/detail/{{$shop->id}}" class="detail__link">
                            詳しくみる
                        </a>
                        <button class="favorite__button">
                            <img src="{{ asset('images/favorite_red.png')}}">
                        </button>
                    </form>
                @else
                    <form class="flex" action="/like/{{$shop->id}}" method="post">
                        @csrf
                        <a href="/detail/{{$shop->id}}" class="detail__link">
                            詳しくみる
                        </a>
                        <button class="favorite__button">
                            <img src="{{ asset('images/favorite.png')}}">
                        </button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
@endsection