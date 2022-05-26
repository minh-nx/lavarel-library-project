@extends('layouts.default')

@section('title', 'Forgot Password')

@section('heading')
    <h1>This is forgot password page</h1>
@endsection

@section('content')
    <form action="{{ route('password.email') }}" method="post">
        @csrf

        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" value={{ old('email') }}>
        @include('auth.temp.error-message', ['name' => 'email'])
        <br><br>

        <button>
            <a href="{{ route('login') }}">
                Back
            </a>
        </button>

        <button type="submit">
            Send link
        </button>
        <br>
    </form>
    <hr>
    @include('auth.temp.session-message')
@endsection