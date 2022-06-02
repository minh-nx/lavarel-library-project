<x-layouts.default-layout title="Sign up" id="home">
    <x-slot:links>
        <link rel="stylesheet" href="{{ asset('css/auth-style.css') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
    </x-slot>

    <x-slot:content>
    {{-- Body zone: Edit every body part here --}}
    <div class="page-body page-background-img">
        {{-- <img class= "background-img" src="./img/signup-background-img.jpg" alt="background-image"> --}}
        <div class = "middle-box"> 
            <form action="{{ route('register') }}" method="post">
                <span class = "sign-up">
                    <h1>Sign Up</h1> 
                </span>

                @csrf
                <div class="form-control">
                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname" name="firstname" value="{{ old('firstname') }}">
                    <x-auth.input-error-message name="firstname"/>
                </div>
                <div class = "form-control">
                    <label for="lastname">Last Name</label>
                    <input type="text" id="lastname" name="lastname" value="{{ old('lastname') }}">
                    <x-auth.input-error-message name="lastname"/>
                </div>
                <div class="form-control">
                    <label for="id">Student ID</label>
                    <input type="text" id="id" name="id" value="{{ old('id') }}">
                    <x-auth.input-error-message name="id"/>
                </div>
                <div class="form-control">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" value="{{ old('email') }}">
                    <x-auth.input-error-message name="email"/>
                </div>
                <div class="form-control">
                    <label for="username">Username (at least 6 characters)</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}">
                    <x-auth.input-error-message name="username"/>
                </div>
                <div class="form-control">
                    <label for="password">Password (at least 6 characters)</label>
                    <input type="password" id="password" name="password"> 
                    <x-auth.input-error-message name="password"/>
                </div>
                <div class="form-control">
                    <label for="password_confirmation">Password Confirmation</label>
                    <input type="password" id="password_confirmation" name="password_confirmation">
                    <x-auth.input-error-message name="password_confirmation"/>
                </div>
                <div class="form-control text-align middle-margin">
                    <button class="submit-btn" type="submit">
                        Sign Me Up
                    </button>
                </div>
            </form>
          </div>
        </div>
    </x-slot>
</x-layouts.default-layout>