@extends('layouts.default')

@section('title', 'Verify Email')

@section('heading')
    <h1>This is verify email page</h1>
@endsection

@section('content')
    <form method="post" action="{{ route('verification.resend') }}">
        @csrf

        <button type="submit">
            Resend link
        </button>
    </form>
    <hr>
    @include('auth.temp.session-message')
@endsection