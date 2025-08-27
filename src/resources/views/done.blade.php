@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
    <div class="done__content">
        <p class="done__message">
            ご予約ありがとうございます    
        </p>
        <div class="back__link">
            <a href="/">戻る</a>
        </div>
    </div>
@endsection