@extends('layouts.default')

@section('title', 'Login')

@section('heading')
    <h1>This is login page</h1>
@endsection

@section('content')
    <form action="{{ route('login') }}" method="post">
        @csrf

        <label for="username">Username or Email:</label><br>
        <input type="text" id="username" name="username" value={{ old('name') }}>
        @include('auth.temp.error-message', ['name' => 'username'])
        <br>

        <label for="username">Password:</label><br>
        <input type="password" id="password" name="password">
        @include('auth.temp.error-message', ['name' => 'password'])
        <br>

        <label>
            <input type="checkbox" id="remember-me" name="remember-me" value="1"> remember me
        </label>
        <br>

        <button type="submit">
            Login
        </button>
        <br>

        <a href="{{ route('password.forgot') }}">
            Forgot password?
        </a>
        <br>
    
        <a href="{{ route('register') }}">
            Register
        </a>
    </form>
    <hr>
    @include('auth.temp.session-message')
@endsection