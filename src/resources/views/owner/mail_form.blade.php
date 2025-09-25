@extends('layouts.owner.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/owner/mail_form.css') }}">
@endsection

@section('content')
    <div class="container">
        <h1 class="form__title">MailForm</h1>

        <form class="form" action="{{ route('owner.mail.send') }}" method="POST">
            @csrf
            <div class="form__group">
                <label for="subject">件名</label>
                <input type="text" name="subject">
            </div>

            <div class="form__group--textarea">
                <label for="body">本文</label>
                <textarea name="body" rows="5"></textarea>
            </div>

            @if($allUsers)
                @foreach($users as $user)
                    <input type="hidden" name="user_ids[]" value="{{ $user->id }}">
                    <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                @endforeach
            @else
                @foreach($reservations as $reservation)
                    <input type="hidden" name="reservation_ids[]" value="{{ $reservation->id }}">
                @endforeach
            @endif
            <button class="form__button" type="submit">送信</button>
        </form>
    </div>
@endsection