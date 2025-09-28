@extends('layouts.admin.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/mail_form.css') }}">
@endsection

@section('content')
    <div class="container">
        <h1 class="form__title">MailForm</h1>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form class="form" action="{{ route('admin.mail.send') }}" method="POST">
            @csrf
            <div class="form__group">
                <label for="subject">件名</label>
                <input type="text" name="subject">
            </div>

            <div class="form__group--textarea">
                <label for="body">本文</label>
                <textarea name="body" rows="5"></textarea>
            </div>
            
            <button class="form__button" type="submit">送信</button>
        </form>
    </div>
@endsection