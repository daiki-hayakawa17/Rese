@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/thanks.css') }}">
@endsection

@section('content')
    <div class="thanks__content">
        <p class="thanks__message">
            会員登録ありがとうございます    
        </p>
        <div class="login__link">
            <a href="/login">ログインする</a>
        </div>
    </div>    
@endsection