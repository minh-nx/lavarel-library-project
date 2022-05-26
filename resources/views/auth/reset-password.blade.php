@extends('layouts.default')

@section('title', 'Reset Password')

@section('heading')
    <h1>This is reset password page</h1>
@endsection

@section('content')
    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input id="token" type="hidden" name="token" value="{{ $token }}"/>

        <input id="email" type="hidden" name="email" value="{{ $email }}"/>

        <label for="password">New password *</label><br>
        <input type="password" id="password" name="password">
        @include('auth.temp.error-message', ['name' => 'password'])
        <br><br>
    
        <label for="password_confirmation">New password confirmation *</label><br>
        <input type="password" id="password_confirmation" name="password_confirmation">
        @include('auth.temp.error-message', ['name' => 'password_confirmation'])
        <br><br>

        <button type="submit">
            Submit
        </button>
    </form>
    <hr>
    @include('auth.temp.session-message')
@endsection