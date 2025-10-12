@extends('layouts.owner.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/owner/result.css') }}">
@endsection

@section('content')
    <div class="container">
        <h1>CheckinResult</h1>

        @if ($status === 'success')
            <p class="success__message">{{ $message }}</p>
        @else
            <p class="false__message">{{ $message }}</p>
        @endif

        <a href="/owner/shop/list" class="btn">戻る</a>
    </div>
@endsection