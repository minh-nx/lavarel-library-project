<x-layouts.default-layout title="Forgot password">
    <x-slot:links>
        <link rel="stylesheet" href="{{ asset('css/auth-style.css') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
    </x-slot>

    <x-slot:content id="home">
        {{-- Body zone: Edit every body part here --}}
        <div class="page-body page-background-img height-600px margin-auto">
            <div class="middle-box sign-in-height">
                <form action="{{ route('password.update') }}" method="post">
                    <span class = "text-align confirmation-content">
                        <h1>Reset Password </h1>
                    </span>

                    @csrf
                    <input id="token" type="hidden" name="token" value="{{ $token }}"/>
                    <input id="email" type="hidden" name="email" value="{{ $email }}"/>

                    <div class="form-control">
                        <label for="username">New password</label>
                        <input type="password" id="password" name="password">
                        <x-auth.input-error-message name="password"/>
                    </div>
                    <div class="form-control">
                        <label for="password_confirmation">New password confirmation</label>
                        <input type="password" id="password_confirmation" name="password_confirmation">
                        <x-auth.input-error-message name="password_confirmation"/>
                    </div>

                    <div class="form-control text-align">
                        <button type="submit" class="submit-btn sign-in-btn">
                            Reset Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>
</x-layouts.default-layout>