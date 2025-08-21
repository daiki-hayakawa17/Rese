@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css')}}">   
@endsection

@section('content')
    <div class="detail__content">
        <div class="left__content">
            <div class="shop__title">
                <a class="back__button" href= "/">
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
        <form class="right__content" action="/detail/{{$shop->id}}" method="POST">
            @csrf
            <h2 class="form__title">予約</h2>
            <input type="date" name="date" class="date__input" id="date">
            <input type="time" name="time" class="time__input" id="time">
            <select class="number__select" name="number" id="number">
                @for ($i = 1; $i <=100; $i++)
                    <option value="{{ $i }}">{{ $i }}人</option>
                @endfor
            </select>
            <table class="shop__information">
                <tr>
                    <th>Shop</th>
                    <td>{{ $shop->name }}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td id="date__output"></td>
                </tr>
                <tr>
                    <th>Time</th>
                    <td id="time__output"></td>
                </tr>
                <tr>
                    <th>Numer</th>
                    <td id="number__output">1人</td>
                </tr>
            </table>
            <button class="form__button">予約する</button>
        </form>
    </div>
@endsection

@section('script')
    <script>
        const dateInput = document.getElementById("date");
        const dateOutput = document.getElementById("date__output");

        dateInput.addEventListener("input", () => {
            dateOutput.textContent = dateInput.value;
        });

        const timeInput = document.getElementById("time");
        const timeOutput = document.getElementById("time__output");

        timeInput.addEventListener("input", () => {
            timeOutput.textContent = timeInput.value;
        });

        const select = document.getElementById("number");
        const numberOutput = document.getElementById("number__output");

        select.addEventListener("change", () => {
            numberOutput.textContent = select.value + "人";
        });
    </script>
@endsection