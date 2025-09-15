@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/email.css') }}">
@endsection

@section('content')
    <div class="thanks__content">
        <p class="thanks__message">
            送信されたメールからメール認証を完了してください    
        </p>
        @if (session('status') == 'verification-link-sent')
            <p class="resend__message">新しい確認メールを送信しました</p>
        @endif
        <form class="resend__button" method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="resend__button--submit">認証メールを再送信</button>
        </form>
    </div>    
@endsection