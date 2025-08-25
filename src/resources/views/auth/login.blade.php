@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')
    <h2 class="form__title">Login</h2>
    <form class="login__form" action="/login" method="POST">
        @csrf
        <div class="form__group">
            <label>
                <img src="{{ asset('images/email.png') }}" alt="メールアイコン">
            </label>
            <input type="text" name="email" placeholder="Email">
            <div class="form__error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__group">
            <label>
                <img src="{{ asset('images/lock.png') }}">
            </label>
            <input type="text" name="password" placeholder="Password">
            <div class="form__error">
                @error('password')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__button">
            <button class="form__button--submit">ログイン</button>
        </div>
    </form>
@endsection