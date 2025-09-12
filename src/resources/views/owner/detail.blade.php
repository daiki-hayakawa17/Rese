@extends('layouts.owner.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner/detail.css') }}">
@endsection

@section('content')
    <form class="form" action="/owner/shop/detail/{{$shop->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form__input--image">
            <span class="form__input--label">店舗画像</span>
            <div class="image__content">
                <label class="output__label" for="shop__image">
                    <output id="image" class="image__output"></output>
                </label>
                <label class="image__input--label" for="shop__image"><img src="{{ asset($shop->image) }}" alt="お店画像"></label>
                <input type="file" id="shop__image" name="shop__image" accept="image/*">
            </div>
        </div>
        <div class="shop__area">
            <span class="form__input--label">店舗エリア</span>
            <div class="form__input--area">
                @foreach($areas as $area)
                <label>
                    <input type="radio" name="area_id" value="{{ $area->id }}" {{ $area->id === $shop->area->id ? 'checked' : '' }}>
                    <span>{{ $area->name }}</span>
                </label>
                @endforeach
            </div>
        </div>
        <div class="shop__genre">
            <span class="form__input--label">ジャンル</span>
            <div class="form__input--genre">
                @foreach($genres as $genre)
                <label>
                    <input type="radio" name="genre_id" value="{{ $genre->id }}" {{ $genre->id === $shop->genre->id ? 'checked' : '' }}>
                    <span>{{ $genre->content }}</span>
                </label>
                @endforeach
            </div>
        </div>
        <span class="form__input--label">店舗名</span>
        <input class="input__name" type="text" name="name" value="{{ $shop->name }}">
        <span class="form__input--label">店舗概要</span>
        <textarea class="textarea" rows="10" cols="40" name="description">{{ $shop->description }}</textarea>
        <div class="button__group">
            <a class="shop__reservation--link" href="/owner/shop/detail/{{ $shop->id }}/reservation">予約情報</a>
            <div class="line"></div>
            <button class="form__button">更新</button>
        </div>
    </form>
@endsection

@section('script')
<script>
    document.getElementById('shop__image').onchange = function(event){

        initializeFiles();

        var files = event.target.files;

        for (var i = 0, f; f = files[i]; i++) {
            var reader = new FileReader;
            reader.readAsDataURL(f);

            reader.onload = (function(theFile) {
                return function (e) {
                    var div = document.createElement('div');
                    div.className = 'reader_file';
                    div.innerHTML += '<img class="reader_image" src="' + e.target.result + '" />';
                    document.getElementById('image').insertBefore(div, null);
                }
            })(f);
        }

        var inputLabel = document.querySelector('.image__input--label');
        if (inputLabel) {
            inputLabel.style.display = 'none';
        }
    };

    function initializeFiles() {
        document.getElementById('image').innerHTML = '';
    }
</script>
@endsection