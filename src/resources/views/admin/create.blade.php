@extends('layouts.admin.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/create.css') }}">
@endsection

@section('content')
    <h2 class="form__title">OwnerStore</h2>
    <form class="form" action="/admin/owner/create" method="POST">
        @csrf
        <div class="form__group">
       <label>
            <img src="{{ asset('images/user.png') }}" alt="ユーザーアイコン">
            </label>
            <input type="text" name="name" placeholder="Username">
            <div class="form__error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
        </div>
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
        <input type="hidden" name="role" value="owner">
        <div class="form__button">
            <button class="form__button--submit">登録</button>
        </div>
    </form>
@endsection