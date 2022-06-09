<x-layouts.default-layout title="Sign in" id="home">
    <x-slot:links>
        <link rel="stylesheet" href="{{ asset('css/auth-style.css') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
    </x-slot>

    <x-slot:content>
        {{-- Body zone: Edit every body part here --}}
        <div class="page-body page-background-img sign-in-page">
            <div class="middle-box sign-in-height">
                <form action="{{ route('login') }}" method="post">
                    <span class = "sign-up">
                        <h1>Sign In</h1>
                    </span>

                    @csrf
                    <div class="form-control">
                        <label for="username">Username or email</label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}">
                        <x-auth.input-error-message name="username"/>
                    </div>
                    <div class="form-control">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password">
                        <x-auth.input-error-message name="password"/>
                    </div>

                    {{--
                    <div class="form-control">
                        <input type="checkbox" id="remember-me" name="remember-me">
                        <label for="remember-me">remember me</label>
                    </div>    
                    --}}

                    <div class="form-control text-align">
                        <button type="submit" class="submit-btn sign-in-btn">Sign in</button>
                    </div>

                    <div class="form-control">
                        <x-auth.session-message/>
                    </div>

                    <h4 class="margin-top text-align">
                        Forgot your password? <a href="{{ route('password.forgot') }}"><span class="link-btn" style="color:blue">Click here</span></a>
                    </h4>
                    <h4 class="margin-top text-align">
                        Don't have an account? <a href="{{ route('register') }}"><span class="link-btn" style="color:blue">Sign up here</span></a>
                    </h4>
                </form>
            </div>
        </div>
    </x-slot>
</x-layouts.default-layout>