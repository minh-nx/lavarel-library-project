<x-layouts.default-layout title="Forgot password">
    <x-slot:links>
        <link rel="stylesheet" href="{{ asset('css/auth-style.css') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
    </x-slot>

    <x-slot:content id="home">
        {{-- Body zone: Edit every body part here --}}
        <div class="page-body page-background-img height-600px">
            <div class="middle-box margin-auto height-forgot-password">
                <form action="{{ route('password.email') }}" method="post">
                    <h1 class="text-align confirmation-content">Find your account</h1>

                    @csrf
                    <div class="form-control">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" value="{{ old('email') }}">
                        <x-auth.input-error-message name="email"/>
                    </div>
                    <div>
                        <p class="form-control sent-notice">
                            {{-- <span class="notice">Notice:</span> We have sent email to your email, please check your mail box to go to the reset password page. --}}
                            <x-auth.session-message/>
                        </p>
                    </div>

                    <div class="form-control text-align">
                        <button type="submit" class="submit-btn">
                            Send password reset link
                        </button>
                    </div>

                    <h4 class="margin-top text-align">
                        Back to <a href="{{ route('login') }}"><span class="link-btn" style="color:blue">login</span></a>
                    </h4>
                </form>
            </div>
        </div>
    </x-slot>
</x-layouts.default-layout>