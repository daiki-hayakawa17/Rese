@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
    <h2 class="form__title">Registration</h2>
    <form class="register__form" action="/register" method="POST">
        <div class="form__group">
            <label>
                <img src="{{ asset('images/user.png') }}" alt="ユーザーアイコン">
            </label>
            <input type="text" name="name" placeholder="Username">
        </div>
        <div class="form__group">
            <label>
                <img src="{{ asset('images/email.png') }}" alt="メールアイコン">
            </label>
            <input type="text" name="email" placeholder="Email">
        </div>
        <div class="form__group">
            <label>
                <img src="{{ asset('images/lock.png') }}">
                <input type="text" name="password" placeholder="Password">
            </label>
        </div>
        <div class="form__button">
            <button class="form__button--submit">登録</button>
        </div>
    </form>
@endsection