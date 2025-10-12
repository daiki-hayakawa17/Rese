@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/qr.css') }}">
@endsection

@section('content')
    <div class="qr__page">
        <h2 class="qr__page--title">{{ $reservation->shop->name }}の来店QRコード</h2>

        <div class="qr__box">
            {!! $qr !!}
        </div>

        <a href="{{ $url }}" target="_blank">{{ $url }}</a>

        <p class="qr__text">※お店のスタッフにこの画面をお見せください。</p>

        <a href="{{ route('mypage') }}" class="mypage__link">マイページに戻る</a>
    </div>
@endsection