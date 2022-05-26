@extends('layouts.default')

@section('title', 'Register')

@section('heading')
    <h1>This is register page</h1>
@endsection

@section('content')
    <form action="{{ route('register') }}" method="post">
        @csrf
        
        <label for="firstname">Firstname *</label><br>
        <input type="text" id="firstname" name="firstname" value={{ old('firstname') }}>
        @include('auth.temp.error-message', ['name' => 'firstname'])
        <br><br>

        <label for="lastname">Lastname *</label><br>
        <input type="text" id="lastname" name="lastname" value={{ old('lastname') }}>
        @include('auth.temp.error-message', ['name' => 'lastname'])
        <br><br>

        <label for="id">Student ID *</label><br>
        <input type="text" id="id" name="id" value={{ old('id') }}>
        @include('auth.temp.error-message', ['name' => 'id'])
        <br><br>

        <label for="email">Email *</label><br>
        <input type="text" id="email" name="email" value={{ old('email') }}>
        @include('auth.temp.error-message', ['name' => 'email'])
        <br><br>

        <label for="username">Username *</label><br>
        <input type="text" id="username" name="username" value={{ old('username') }}>
        @include('auth.temp.error-message', ['name' => 'username'])
        <br><br>

        <label for="password">Password *</label><br>
        <input type="password" id="password" name="password">
        @include('auth.temp.error-message', ['name' => 'password'])
        <br><br>

        <label for="password_confirmation">Password confirmation *</label><br>
        <input type="password" id="password_confirmation" name="password_confirmation">
        @include('auth.temp.error-message', ['name' => 'password_confirmation'])
        <br><br>

        <button type="submit">
            Sign me up
        </button>
    </form>
    <hr>
    <a href="{{ route('login') }}">
        Login
    </a>
    <hr>
    @include('auth.temp.session-message')
@endsection