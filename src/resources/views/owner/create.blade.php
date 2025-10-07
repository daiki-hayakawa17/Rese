@extends('layouts.owner.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner/create.css') }}">
@endsection

@section('content')
    <form class="form" action="/owner/shop/create" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form__input--image">
            <span class="form__input--label">店舗画像</span>
            <div class="image__content">
                <label class="output__label" for="shop__image">
                    <output id="image" class="image__output"></output>
                </label>
                <label class="image__input--label" for="shop__image">画像を選択する</label>
                <input type="file" id="shop__image" name="shop__image" accept="image/*">
            </div>
            <div class="form__error--image">
                @error('shop__image')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="shop__area">
            <span class="form__input--label">店舗エリア</span>
            <div class="form__input--area">
                @foreach($areas as $area)
                <label>
                    <input type="radio" name="area_id" value="{{ $area->id }}">
                    <span>{{ $area->name }}</span>
                </label>
                @endforeach
            </div>
            <div class="form__error">
                @error('area_id')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="shop__genre">
            <span class="form__input--label">ジャンル</span>
            <div class="form__input--genre">
                @foreach($genres as $genre)
                <label>
                    <input type="radio" name="genre_id" value="{{ $genre->id }}">
                    <span>{{ $genre->content }}</span>
                </label>
                @endforeach
            </div>
            <div class="form__error">
                @error('genre_id')
                {{ $message }}
                @enderror
            </div>
        </div>
        <span class="form__input--label">店舗名</span>
        <input class="input__name" type="text" name="name" placeholder="店舗名を入力してください">
        <div class="form__error">
            @error('name')
            {{ $message }}
            @enderror
        </div>
        <span class="form__input--label">店舗概要</span>
        <textarea class="textarea" rows="10" cols="40" placeholder="店舗概要を入力してください" name="description"></textarea>
        <div class="form__error">
            @error('description')
            {{ $message }}
            @enderror
        </div>
        <button class="form__button">作成</button>
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